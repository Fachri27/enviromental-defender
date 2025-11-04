<?php

namespace App\Livewire\Admin;

use App\Models\Resource;
use App\Models\ResourceTranslation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class ResourceForm extends Component
{
    use WithFileUploads;
    public $resource;
    public $resourceId;
    public $title_id, $title_en;
    public $deskripsi_id, $deskripsi_en, $type, $status, $link, $image, $old_image, $slug, $file_type, $start_date, $end_date, $old_file_type;

    public function mount($resourceId = null)
    {
        if($resourceId) {
            $this->resource = Resource::with('translations')->findOrFail($resourceId);

            $idTranslations = $this->resource->translations->firstWhere('locale', 'id');
            $enTranslations = $this->resource->translations->firstWhere('locale', 'en');

            $this->fill([
                'title_id' => $idTranslations->title ?? '',
                'title_en' => $enTranslations->title ?? '',
                'slug' => $this->resource->slug,
                'type' => $this->resource->type,
                'status' => $this->resource->status,
                'image' => $this->resource->image,
                'file_type' => $this->resource->file_type,
                'link' => $this->resource->link,
                'start_date' => $this->resource->start_date,
                'end_date' => $this->resource->end_date,
                'deskripsi_id' => $idTranslations->deskripsi ?? '',
                'deskripsi_en' => $enTranslations->deskripsi ?? '',
            ]);

            $this->old_image = $this->resource->image;
            $this->image = null;
            $this->old_file_type = $this->resource->file_type;
            $this->file_type = null;
        }
    }

    public function save() 
    {
        // dd('save called');
        $resource = $this->resource ?? new Resource;

        $this->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'type' => 'required|in:report,database',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,PNG|max:5048',
            'status' => 'required|in:draft,publish',
            'file_type' => 'nullable|file|mimes:docx,pdf|max:10240',
        ]);

        $data = [
            'slug' => Str::slug($this->title_id),
            'type' => $this->type,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'link' => $this->link,
            'user_id' => auth()->id(),
        ];

        if ($this->file_type) {
            $path = $this->file_type->store('resources/import', 'public');
            $data['file_type'] = $path;
        }

        // ✅ Upload & buat meta image
        if ($this->image instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {

            // Hapus gambar lama
            if ($this->old_image && Storage::disk('public')->exists($this->old_image)) {
                Storage::disk('public')->delete($this->old_image);
            }

            // Simpan gambar baru
            $filename = Str::slug($this->title_id).'-'.time().'.'.$this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('resources', $filename, 'public');

            // Resize untuk meta
            $metaDir = storage_path('app/public/resources/meta');
            if (! file_exists($metaDir)) {
                mkdir($metaDir, 0755, true);
            }

            $fullPath = storage_path('app/public/'.$path);
            if (file_exists($fullPath)) {
                $manager = ImageManager::gd()
                    ->read($fullPath)
                    ->resize(1200, 630);
                $manager->save($metaDir.'/'.$filename);
            }

            $data['image'] = $path;

        } else {
            // Tidak upload baru → tetap pakai gambar lama
            $data['image'] = $this->old_image;
        }

        $resource->fill($data)->save();
        $resource->refresh();

        foreach(['id', 'en'] as $locale) {
            ResourceTranslation::updateOrCreate(
                ['resource_id' => $resource->id, 'locale' => $locale],
                [
                    'title' => $locale === 'id' ? $this->title_id : $this->title_en,
                    'deskripsi' => $locale === 'id' ? $this->deskripsi_id : $this->deskripsi_en,
                ]
                );
        }

        // dd($this->resource);

        session()->flash('success', 'Resource berhasil disimpan.');

        return redirect()->route('resource.index');

    }
    public function render()
    {
        return view('livewire.admin.resource-form')->layout('layouts.app');
    }
}
