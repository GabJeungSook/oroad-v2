<?php

namespace App\Livewire\Requestor;

use Livewire\Component;
use App\Models\Document;

class RequestedDocument extends Component
{
    public $documents;

    public function mount()
    {
        $this->documents = Document::all();
    }

    public function render()
    {
        return view('livewire.requestor.requested-document');
    }
}
