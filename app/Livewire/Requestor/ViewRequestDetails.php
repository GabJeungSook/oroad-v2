<?php

namespace App\Livewire\Requestor;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class ViewRequestDetails extends Component
{
    public $record;

    public function render()
    {
        return view('livewire.requestor.view-request-details');
    }
}
