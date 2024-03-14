<div>
    <div class="flex justify-between">
        <div class="">
            <h1 class="text-lg font-semibold text-gray-700">Update Your Information</h1>
            <p class="text-sm text-gray-700">You can update your information here.</p>
        </div>
        <a wire:navigate href="{{route('requestor.view-user-profile')}}">
            <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
              </svg>
              <span class="px-2">Return</span></button>
        </a>
    </div>

    <form wire:submit="save" class="mt-5">
        {{ $this->form }}

        <div class="mt-5 flex justify-end">
            <x-filament::button type="submit" class="">Update</x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
