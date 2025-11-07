<?php

namespace App\Livewire\Admin;

use App\Models\Resource;
use Livewire\Component;

class ResourceTable extends Component
{
    public $search = '';
    public $status;
    public $type;
    public function render()
    {
        $resources = Resource::with('translations')
            ->whereHas('translations', function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%');

                if ($this->status && $this->status !== 'status') {
                    $query->where('status', $this->status);
                }
                if ($this->type && $this->type !== 'type') {
                    $query->where('type', $this->type);
                }
            })->paginate(10);
        return view('livewire.admin.resource-table', compact('resources'))->layout('layouts.app');
    }

    public function destroy(Resource $resource) {
        $resource->delete();
        session()->flash('success', 'Resource berhasil di hapus');
    }
}
