<div>
    <div class="py-">
        <h1 class="text-lg font-semibold text-gray-700">Add Your Information</h1>
        <p class="text-sm text-gray-700">Please add your information first before you can make a request.</p>
    </div>
    <div class="mt-5">
        {{$this->form}}
    </div>
    <div class="mt-5 flex justify-end">
        <x-filament::button wire:click="create" type="button" class="">Submit</x-filament::button>
    </div>

</div>
