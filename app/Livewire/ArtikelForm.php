<?php

namespace App\Livewire;

use App\Models\Artikel;
use App\Models\ArtikelTranslation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArtikelForm extends Component
{
    use WithFileUploads;
    public $artikel;
    public $artikelId;
    public $title_id, $title_en, $deskripsi_id, $deskripsi_en, $content_id, $content_en;
    public $slug, $type, $status = 'draft', $image, $old_image, $published_at;


    public function mount($artikelId = null) 
    {
        if($artikelId) {
            $this->artikel = Artikel::with('translations')->findOrFail($artikelId);

            // translations
            $idTranslations = $this->artikel->translations->firstWhere('locale', 'id');
            $enTranslations = $this->artikel->translations->firstWhere('locale', 'en');

            $this->fill([
                'title_id' => $idTranslations->title ?? '',
                'title_en' => $enTranslations->title ?? '',
                'slug' => $this->artikel->slug,
                'type' => $this->artikel->type,
                'status' => $this->artikel->status,
                'image' => $this->artikel->image,
                'published_at' => $this->artikel->published_at,
                'content_id' => $idTranslations->content ?? '',
                'content_en' => $enTranslations->content ?? '',
                'deskripsi_id' => $idTranslations->deskripsi ?? '',
                'deskripsi_en' => $enTranslations->deskripsi ?? '',
            ]);

            $this->old_image = $this->artikel->image;
            $this->image = null;
        }
    }

    public function save()
    {
        // dd('save called');
        $artikel = $this->artikel ?? new Artikel;

        $this->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'published_at' => 'required|date',
            'type' => 'required|in:action,case,alerta',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,PNG,webp|max:5048',
            'status' => 'required|in:draft,publish',
        ]);

        $data = [
            'slug' => Str::slug($this->title_id),
            'type' => $this->type,
            'status' => $this->status,
            'published_at' => $this->published_at,
            'user_id' => auth()->id(),
        ];

        // ✅ Upload & buat meta image
        if ($this->image instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {

            // Hapus gambar lama
            if ($this->old_image && Storage::disk('public')->exists($this->old_image)) {
                Storage::disk('public')->delete($this->old_image);
            }

            // Simpan gambar baru
            $filename = Str::slug($this->title_id).'-'.time().'.'.$this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('artikel', $filename, 'public');

            // Resize untuk meta
            $metaDir = storage_path('app/public/artikel/meta');
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

        $artikel->fill($data)->save();
        $artikel->refresh();

        foreach(['id', 'en'] as $locale)
        {
            ArtikelTranslation::updateOrCreate(
                ['artikel_id' => $artikel->id, 'locale' => $locale],
                [
                    'title' => $locale === 'id' ? $this->title_id : $this->title_en,
                    'deskripsi' => $locale === 'id' ? $this->deskripsi_id : $this->deskripsi_en,
                    'content' => $locale === 'id' ? $this->content_id : $this->content_en,
                ]
            );
        }

        // dd($this->artikel);

        session()->flash('success', 'Artikel berhasil disimpan.');

        return redirect()->route('artikel.index');
    }



    public function render()
    {
        return view('livewire.artikel-form')->layout('layouts.app');
    }
}
