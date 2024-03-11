<div>
    <div class="py-2">
        <h1 class="text-lg font-semibold text-gray-700">Verify Email</h1>
        <p class="text-sm text-gray-700">We've sent a verification code to your email. Kindly check and enter the code below :</p>
    </div>
    <div class="">
        <div class="mt-5">
            {{$this->form}}
        </div>
        <div class="mt-5 flex justify-end">
            <x-filament::button wire:click="verify" type="button" class="">Submit</x-filament::button>
        </div>
    </div>
</div>
