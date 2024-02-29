<div>
    <div class="rubik-300 text-3xl text-gray-600">
    <div class="flex justify-between">
        <h1>Add Payment Details</h1>
        <div class="flex space-x-3">
            <a wire:navigate href="{{route('dashboard')}}">
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                  </svg>
                  <span class="px-2">Return</span></button>
            </a>
        </div>
    </div>
    <div class="my-3 border-b-2 border-gray-300 w-full" ></div>
    <div class="rubik-300 text-lg space-y-2">
        <span>Request Code: {{$record->request_number}}</span>
        <div class="flex justify-between">
            <div>
                <p class="text-sm">Status:
                    <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                        {{$record->status}}
                    </span>
                </p>
            </div>
        </div>
        <div class="my-3 border-b-2 border-gray-300 w-full" ></div>
        <div>
            {{$this->form}}
        </div>
        <div class="flex justify-end">
            {{ $this->saveAction }}

            <x-filament-actions::modals />
        </div>
    </div>
    </div>
</div>
