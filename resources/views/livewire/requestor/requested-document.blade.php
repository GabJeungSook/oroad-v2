<div>
    <div class="rubik-300 text-3xl text-gray-600">
        <div class="flex justify-between">
            <h1>Request Form</h1>
            <div>
                <a wire:navigate href="{{route('dashboard')}}">
                    <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                      </svg>
                      <span class="px-2">Return</span></button>
                </a>
            </div>
        </div>
        @if (auth()->user()->user_information->campus_clearance_path === null)
        <div class="mt-5 bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
              <div class="py-1">
                  <svg class="h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                  </svg>

            </div>
              <div>
                <p class="font-bold">No Campus Clearance Uploaded</p>
                <p class="text-sm">Before you can make your first request. You must upload your campus clearance first.
                    <a href="{{route('requestor.view-user-profile')}}" class="font-semibold hover:underline">
                        Upload Here</a>
                </p>
              </div>
            </div>
          </div>
        @elseif(auth()->user()->user_information->year_graduated <= 2005)
        <div class="mt-5 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
              <div class="py-1">
                  <svg class="h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                  </svg>
            </div>
              <div>
                <p class="font-bold">You graduated last {{auth()->user()->user_information->year_graduated}}</p>
                <p class="text-sm">Please proceed to your campus registrar to handle your request personally.</p>
              </div>
            </div>
          </div>
        @else
        <div class="my-3 border-b-2 border-gray-300 w-full" ></div>
        <div class="">
            <h1 class="text-xl">Select Receiver</h1>
            <p class="text-sm">Choose the receiver of the requested documents.</p>
        </div>
        <div class="p-4 space-y-4">
            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input wire:model.live="selectedReceiver" id="bordered-radio-1" type="radio" value="me" name="bordered-radio" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-white  focus:ring-0">
                    <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm rubik-500 text-gray-900 dark:text-gray-300">Owner
                    <span id="helper-radio-text" class="ml-2 text-xs font-normal text-gray-500 dark:text-gray-300"> - You will receive the requested document(s).</span></label>
            </div>
            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input wire:model.live="selectedReceiver" id="bordered-radio-2" type="radio" value="representative" name="bordered-radio" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-white  focus:ring-0">
                    <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm rubik-500 text-gray-900 dark:text-gray-300">My Representative
                    <span id="helper-radio-text" class="ml-2 text-xs font-normal text-gray-500 dark:text-gray-300"> - Your representative will receive the requested document(s).</span></label>
            </div>
        </div>
        <div>
            @if ($receiver_name == '')
            <div class="flex space-x-4">
                <span class="ml-4 text-xl">You don't have a representative added. Do you want to add now? </span>
                {{ $this->addRepresentativeAction }}
                <x-filament-actions::modals />
            </div>
            @else
            <span class="ml-4 text-xl font-mono">Receiver: {{$receiver_name}}</span>
            @if ($selectedReceiver === 'representative')
                {{ $this->updateRepresentativeAction }}
                <x-filament-actions::modals />
            @endif

            @endif

        </div>
        </div>
    <div class="mt-5">
        <div>
            <div class="my-3 border-b-2 border-gray-300 w-full" ></div>
            <h1 class="rubik-300 text-xl text-gray-600">Select Documents</h1>
            @if ($documents)
            <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-1 sm:gap-6 lg:grid-cols-2">
                @foreach ($documents as $item)
                <li class="col-span-1 flex rounded-md shadow-sm">
                    <div class="flex w-16 flex-shrink-0 items-center justify-center  bg-green-700 rounded-l-md text-sm font-medium text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                          </svg>
                    </div>
                    <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                      <div class="flex-1 truncate px-4 py-4 text-sm">
                        <a href="#" class="font-medium text-gray-900 tex-md rubick-300">{{$item->title}}</a>
                        <p class="whitespace-nowrap rubik-300 pt-1">Amount: ₱ {{number_format($item->amount, 2)}}</time></p>
                      </div>
                      <div class="flex-shrink-0 pr-2">
                        <input wire:click="document_selected({{$item->id}}, {{$item->amount}})" type="checkbox" class="lg:p-3 sm:p-4 mx-2 appearance-none border-2 rounded-md w-6 h-6 border-gray-400">
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            @else
            <h1 class="rubick-300 text-xl text-center text-gray-500 italic">There is no available document to request right now</h1>
            @endif
          </div>
          <div class="mt-6 my-3 border-b-2 border-gray-300 w-full" ></div>
          <h1 class="rubik-300 text-xl text-gray-600 mb-4">Document Summary</h1>
          @if($selectedDocuments)
          <ul role="list" class="divide-y divide-gray-100 px-5 border-2 border-gray-300 rounded-md">
            @foreach ($filteredDocuments as $key => $document)
            <li class="flex items-center justify-between gap-x-6 py-5">
                <div class="min-w-0">
                  <div class="flex items-start gap-x-3">
                    <p class="text-sm font-normal leading-6 text-gray-900 rubik-400">{{$document->title}}</p>
                    {{-- <p class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">₱ {{number_format($document->amount, 2)}}</p> --}}
                  </div>
                </div>
                <div class="flex space-x-4">
                  <div class="flex flex-col items-center gap-x-4">
                      <label for="quantity{{$key}}" class="block text-sm font-medium leading-6 text-gray-800 rubik-400">Quantity</label>
                      <select id="quantity{{$key}}" wire:model.live="selectedDocuments.{{$key}}.quantity" name="quantity{{$key}}" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 lg:text-md lg:leading-6 sm:text-sm">
                        <option value="1" @if($selectedDocuments[$key]['quantity'] == 1) selected @endif>1</option>
                        <option value="2" @if($selectedDocuments[$key]['quantity'] == 2) selected @endif>2</option>
                        <option value="3" @if($selectedDocuments[$key]['quantity'] == 3) selected @endif>3</option>
                        <option value="4" @if($selectedDocuments[$key]['quantity'] == 4) selected @endif>4</option>
                        <option value="5" @if($selectedDocuments[$key]['quantity'] == 5) selected @endif>5</option>
                      </select>
                    </div>
                    <div class="flex flex-col items-center gap-x-4">
                      <label for="authenticated{{$key}}" class="block text-sm font-medium leading-6 text-gray-800 rubik-400">With Authentication</label>
                      <select id="authenticated{{$key}}" wire:model.live="selectedDocuments.{{$key}}.authentication" name="authenticated{{$key}}" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 lg:text-md lg:leading-6 sm:text-sm">
                        <option value="1" @if($selectedDocuments[$key]['authentication'] == '1') selected @endif>Yes</option>
                        <option value="0" @if($selectedDocuments[$key]['authentication'] == '0') selected @endif>No</option>
                      </select>
                    </div>
                </div>
              </li>
            @endforeach
          </ul>
          <div class="mt-5 px-5 border-2 border-gray-300 rounded-md">
            <h1 class="rubik-300 text-xl text-gray-600 pt-3 pb-2">Request Code : <span class="rubik-400">{{$request_number}}</span> </h1>
            <div class="mb-4 border-b-2 border-gray-300 w-full" ></div>
            {{-- content --}}
            <div class="mb-4 overflow-hidden bg-white shadow lg:rounded-lg">
                <div>
                  <dl>
                    @foreach ($filteredDocuments as $key => $document)
                    <div class="px-4 py-3 grid grid-cols-3 gap-4">
                      <dt class="text-md font-medium text-gray-900 rubik-300">{{$document->title}}
                        x <span wire:model.live="selectedDocuments.{{$key}}.quantity">{{$selectedDocuments[$key]['quantity']}}
                        </span>
                        @if($selectedDocuments[$key]['authentication'] == '1')
                        <span class="text-sm">
                            (with Authentication)
                        </span>
                        @endif
                        </dt>
                      <dd class="mt-1 text-md leading-6 text-gray-700 col-span-1 col-start-3 text-right rubik-300"><span wire:model.live="selectedDocuments.{{$key}}.amount">
                        @php
                           $sub_total =  $selectedDocuments[$key]['amount'] * $selectedDocuments[$key]['quantity']
                        @endphp
                        ₱ {{number_format($sub_total, 2)}}
                        </span>
                    </dd>
                    </div>
                    @endforeach

                  </dl>
                  <div class="px-4 py-3 grid grid-cols-3 gap-4">
                  <dt class="text-lg font-medium text-gray-900 rubik-400">
                    Total
                    </dt>
                  <dd class="mt-1 text-lg leading-6 text-gray-700 col-span-1 col-start-3 text-right rubik-400"><span wire:model.live="total_amount">
                    @php
                        $total = 0;
                        foreach ($selectedDocuments as $key => $document) {
                            $total += $document['amount'] * $document['quantity'];
                        }
                    @endphp
                    ₱ {{number_format($total, 2)}}
                    </span>
                </dd>
                    </div>
                </div>
              </div>
            {{-- content end --}}
            <div class="col-span-full mb-4">
                <label for="purpose_select" class="block text-md font-medium leading-6 text-gray-900">Purpose of Request <span class="text-red-500 text-lg">*</span></label>
                <select wire:model.live="selected_purpose" id="purpose_select" name="purpose_type" class="block w-full rounded-md border-gray-300 py-2 px-3 text-gray-700 shadow-sm focus:outline-none focus:ring-1 focus:ring-green-600 focus:border-green-600 sm:text-sm">
                  @if ($selected_purpose === '' || $selected_purpose === null)
                  <option value="">-- Select Purpose --</option>
                  @endif
                  @foreach ($purposes as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach

                </select>
                @if ($selected_purpose === "7")
                <div class="mt-3">
                  <label for="purpose" class="block text-md font-medium leading-6 text-gray-900">Other Purpose <span class="text-red-500 text-lg">*</span></label>
                  <div class=" mb-4">
                    <input wire:model="other_purpose" id="about" name="about" type="text" class="rubik-300 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 lg:text-md lg:leading-6 sm:text-sm">
                    @error('purpose') <span class="text-red-600">{{ $message }}</span> @enderror
                  </div>
                </div>
                @endif
              </div>
          </div>
          <div class="flex mt-3 justify-end">
            {{ $this->saveAction }}
            <x-filament-actions::modals />
          </div>
          @else
          <h1 class="rubick-300 text-xl text-center text-gray-500 italic">No document is selected</h1>
          @endif
          {{-- <button wire:click="test">test</button> --}}
    </div>
        @endif

</div>
