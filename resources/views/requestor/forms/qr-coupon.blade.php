<x-layouts.main-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(App\Models\UserInformation::where('user_id', Auth::user()->id)->exists())
                    <livewire:requestor.forms.q-r-coupon :record="$record"/>
                    @else
                        @if (!auth()->user()->is_verified)
                        <livewire:requestor.forms.verify-requestor-email />
                        @else
                        <livewire:requestor.forms.add-user-information />
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>
