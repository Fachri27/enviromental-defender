<?php

namespace App\Livewire;

use App\Models\Artikel;
use Livewire\Component;

class ArtikelTable extends Component
{
    public $search;
    public $status;
    public function render()
    {
        $artikels = Artikel::with('translations')
            ->whereHas('translations', function($query) {
                $query->where('title', 'like', '%' .$this->search. '%');

                if($this->status && $this->status !== 'all') {
                    $query->where('status', $this->status);
                }
            })->paginate(10);
        return view('livewire.artikel-table', compact('artikels'))->layout('layouts.app');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        session()->flash('success', 'Artikel berhasil di hapus');
    }
}
