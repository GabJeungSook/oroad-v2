<div>
    <div class="py-">
        <h1 class="text-lg font-semibold text-gray-700">Update Your Information</h1>
        <p class="text-sm text-gray-700">You can update your information here.</p>
    </div>
    <div class="mt-5">
        {{$this->form}}
    </div>
    <div class="mt-5 flex justify-end">
        <x-filament::button wire:click="update" type="button" class="">Update</x-filament::button>
    </div>

</div>
