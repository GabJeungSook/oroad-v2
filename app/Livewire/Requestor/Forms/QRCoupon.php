<?php

namespace App\Livewire\Requestor\Forms;

use Livewire\Component;

class QRCoupon extends Component
{
    public $record;
    public function render()
    {
        return view('livewire.requestor.forms.q-r-coupon');
    }
}
