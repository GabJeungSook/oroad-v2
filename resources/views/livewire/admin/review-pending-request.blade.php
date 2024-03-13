<div>
    <div class="flex justify-between">
        <div>
            @if($record->status == 'Pending')
            <a wire:navigate href="{{route('admin.pending-request')}}">
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                  </svg>
                  <span class="px-2">Return</span></button>
            </a>
            @elseif($record->status == 'Approved')
            <a wire:navigate href="{{route('admin.approved-request')}}">
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                  </svg>
                  <span class="px-2">Return</span></button>
            </a>
            @elseif($record->status == 'Payment Validation')
            <a wire:navigate href="{{route('admin.payment-request')}}">
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                  </svg>
                  <span class="px-2">Return</span></button>
            </a>
            @elseif($record->status == 'To Claim')
            <a wire:navigate href="{{route('admin.request-to-claim')}}">
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                  </svg>
                  <span class="px-2">Return</span></button>
            </a>
            @elseif($record->status == 'Claimed')
            <a wire:navigate href="{{route('admin.claimed-requests')}}">
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                  </svg>
                  <span class="px-2">Return</span></button>
            </a>
            @elseif($record->status == 'Request Denied' || $record->status == 'Payment Request Denied')
            <a wire:navigate href="{{route('admin.request-denied')}}">
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                  </svg>
                  <span class="px-2">Return</span></button>
            </a>
            @endif
        </div>
    </div>
    <div class="bg-white w-full mt-5 rounded-md shadow-md p-3">
        <div class="rubik-300 text-lg space-y-2">
            <span>Request Code: {{$record->request_number}}</span>
            <div class="flex justify-between">
                <div>
                    <p class="text-sm">Status:
                        <span class="items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                            {{$record->status}}
                        </span>
                    </p>
                </div>
                <div class="flex justify-end gap-x-1">
                    @if ($record->status == 'Pending')
                    {{ $this->approveAction }}
                    {{ $this->denyAction }}
                    @elseif($record->status == 'Payment Validation')
                    {{ $this->approvePaymentAction }}
                    {{ $this->denyPaymentAction }}
                    @elseif($record->status == 'To Claim')
                    {{ $this->markAsClaimedAction }}
                    @endif
                </div>
            </div>
            <x-filament-actions::modals />
        </div>
        <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-5">
            <div class="border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-900">Full name</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-1 sm:mt-0">{{ucwords($full_name)}}</dd>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-1 sm:mt-0 flex justify-end">{{ $this->viewDetailsAction }}</dd>
                  {{-- {{ $this->viewDetailsAction }} --}}
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-900">Date Requested</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{Carbon\Carbon::parse($record->created_at)->format('F d, Y h:i A')}}</dd>
                </div>
                </div>
                @if ($record->status == 'Approved')
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Date Approved</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{Carbon\Carbon::parse($record->approved_at)->format('F d, Y h:i A')}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Approved By</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ucwords($record->approvedBy->name)}}</dd>
                </div>
                @endif
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium text-gray-900">Purpose</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ucwords($record->purpose->name)}}</dd>
                </div>
                @if ($record->status == 'Payment Validation')
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Receipt Number</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->payments->receipt_number}}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Receipt Image</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <a href="{{ Storage::disk('public')->url($record->payments->receipt_path) }}" target="_blank">
                            <img src="{{asset('storage/'.$record->payments->receipt_path)}}" alt="Receipt Image" class="w-48 h-48">
                        </a>
                    </dd>
                </div>
                @endif
                @if ($record->status == 'To Claim')
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Claim Date</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{Carbon\Carbon::parse($record->payments->date_to_claim)->format('F d, Y')}}</dd>
                </div>
                @endif
                @if ($record->status == 'Claimed')
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-900">Date Claimed</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{Carbon\Carbon::parse($record->claimed_at)->format('F d, Y')}}</dd>
                </div>
                @endif
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Requested Documents</dt>
                  <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                        @foreach ($record->documents()->get() as $document)
                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                            <div class="flex w-0 flex-1 items-center">
                              <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                              </svg>
                              <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                <span class="truncate font-medium">{{$document->title}}</span>
                                <span class="flex-shrink-0 text-gray-400">{{$document->pivot->quantity > 1 ? $document->pivot->quantity.' copies' : $document->pivot->quantity.' copy'}}</span>
                                @if ($document->pivot->is_authenticated)
                                <span class="flex-shrink-0 text-gray-400">with authentication</span>
                                @endif
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                              <span href="#" class="font-medium text-gray-400 ">₱ {{$document->pivot->amount}}</span>
                            </div>
                          </li>
                        @endforeach
                        <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                            <div class="flex w-0 flex-1 items-center">
                                  <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                  </svg>
                              <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                <span class="truncate font-medium ">Total: </span>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                              <span href="#" class="font-medium text-green-600 ">₱ {{$record->total_amount}}</span>
                            </div>
                          </li>
                    </ul>
                  </dd>
                </div>
              </dl>
            </div>
          </div>

    </div>
</div>
