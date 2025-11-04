<?php

namespace App\Livewire\Admin;

use App\Models\Regulasi;
use Livewire\Component;

class RegulasiTable extends Component
{
    public $search;
    public function render()
    {
        $regulasis = Regulasi::with('translations')
            ->whereHas('translations', function($query) {
                $query->where('title', 'like', '%' .$this->search. '%');
            })->paginate(10);
        return view('livewire.admin.regulasi-table', compact('regulasis'))->layout('layouts.app');
    }

    public function destroy(Regulasi $regulasi)
    {
        $regulasi->delete();
        session()->flash('success', 'Regulasi berhasil di hapus');
    }
}
