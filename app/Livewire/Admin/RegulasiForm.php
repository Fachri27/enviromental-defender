<?php

namespace App\Livewire\Admin;

use App\Models\Regulasi;
use App\Models\RegulasiTranslation;
use Livewire\Component;

class RegulasiForm extends Component
{
    public $regulasiId;
    public $regulasi;
    public $title_id, $title_en, $deskripsi_id, $deskripsi_en, $link;

    public function mount($regulasiId = null)
    {
        if($regulasiId) {
            $this->regulasi = Regulasi::with('translations')->findOrFail($regulasiId);

            // translations
            $idTranslations = $this->regulasi->translations->firstWhere('locale', 'id');
            $enTranslations = $this->regulasi->translations->firstWhere('locale', 'en');

            $this->fill([
                'title_id' => $idTranslations->title ?? '',
                'title_en' => $enTranslations->title ?? '',
                'deskripsi_id' => $idTranslations->deskripsi ?? '',
                'deskripsi_en' => $enTranslations->deskripsi ?? '',
                'link' => $this->regulasi->link,
            ]);

        }
    }

    public function save()
    {
        // dd('save called');
        $regulasi = $this->regulasi ?? new Regulasi;

        $this->validate([
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
        ]);

        $data = [
            'link' => $this->link,
        ];

        $regulasi->fill($data)->save();
        $regulasi->refresh();

        foreach(['id', 'en'] as $locale)
        {
            RegulasiTranslation::updateOrCreate(
                ['regulasi_id' => $regulasi->id, 'locale' => $locale],
                [
                    'title' => $locale === 'id' ? $this->title_id : $this->title_en,
                    'deskripsi' => $locale === 'id' ? $this->deskripsi_id : $this->deskripsi_en,
                ]
            );
        }

        // dd($this->artikel);

        session()->flash('success', 'Regulasi berhasil disimpan.');

        return redirect()->route('regulasi.index.v2');
    }
    public function render()
    {
        return view('livewire.admin.regulasi-form')->layout('layouts.app');
    }
}
