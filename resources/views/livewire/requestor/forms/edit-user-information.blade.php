<div>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-5 flex justify-end">
            <x-filament::button type="submit" class="">Update</x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
