<?php

namespace App\Livewire\Admin\Layouts;

use Livewire\Component;

class SideNav extends Component
{
    public $dashboard_link;
    public $campus_link;
    public $course_link;
    public $user_type_link;
    public $document_link;
    public $staff_link;
    public $purpose_link;
    public $pending_link;
    public $approved_link;
    public $payment_link;
    public $toclaim_link;
    public $claimed_link;
    public $denied_link;

    public function mount()
    {
        $this->dashboard_link = request()->routeIs('admin.dashboard') ? 'text-green-600 bg-gray-100 mb-5  rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold' : 'mb-5  rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md px-1 py-2 text-sm leading-6 font-semibold';
        $this->campus_link = request()->routeIs('admin.campus') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->course_link = request()->routeIs('admin.course') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->user_type_link = request()->routeIs('admin.user-type') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->document_link = request()->routeIs('admin.document') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->staff_link = request()->routeIs('admin.user') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->purpose_link = request()->routeIs('admin.purpose') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->pending_link = request()->routeIs('admin.pending-request') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->approved_link = request()->routeIs('admin.approved-request') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->payment_link = request()->routeIs('admin.payment-request') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->toclaim_link = request()->routeIs('admin.request-to-claim') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->claimed_link = request()->routeIs('admin.claimed-requests') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
        $this->denied_link = request()->routeIs('admin.request-denied') ? 'text-green-600 bg-gray-100 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold' : 'text-gray-700 rubik-400 hover:text-green-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
    }
    public function render()
    {
        return view('livewire.admin.layouts.side-nav');
    }
}
