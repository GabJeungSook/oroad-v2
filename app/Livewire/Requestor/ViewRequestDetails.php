<?php

namespace App\Livewire\Requestor;

use Livewire\Component;

class ViewRequestDetails extends Component
{
    public $record;
    public function render()
    {
        return view('livewire.requestor.view-request-details');
    }
}
