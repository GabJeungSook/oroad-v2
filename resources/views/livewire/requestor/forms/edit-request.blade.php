<div>
    <div class="rubik-300 text-3xl text-gray-600">
        <h1>Edit Request</h1>
        <div class="my-3 border-b-2 border-gray-300 w-full" ></div>
        <h1 class="text-xl">Select Documents</h1>
    </div>
    <div class="mt-5">
        <div>
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
                        <input {{ in_array($item->id, $selected_ids) ? 'checked' : '' }} wire:click="document_selected({{$item->id}}, {{$item->amount}})" type="checkbox" class="sm:p-12 lg:p-2 mx-2 appearance-none border-2 rounded-md w-6 h-6 border-gray-400">
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
                      <select id="quantity{{$key}}" wire:model.live="selectedDocuments.{{$key}}.quantity" name="quantity{{$key}}" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="1" @if($selectedDocuments[$key]['quantity'] == 1) selected @endif>1</option>
                        <option value="2" @if($selectedDocuments[$key]['quantity'] == 2) selected @endif>2</option>
                        <option value="3" @if($selectedDocuments[$key]['quantity'] == 3) selected @endif>3</option>
                        <option value="4" @if($selectedDocuments[$key]['quantity'] == 4) selected @endif>4</option>
                        <option value="5" @if($selectedDocuments[$key]['quantity'] == 5) selected @endif>5</option>
                      </select>
                    </div>
                    <div class="flex flex-col items-center gap-x-4">
                      <label for="authenticated{{$key}}" class="block text-sm font-medium leading-6 text-gray-800 rubik-400">With Authentication</label>
                      <select id="authenticated{{$key}}" wire:model.live="selectedDocuments.{{$key}}.authentication" name="authenticated{{$key}}" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
            <div class="mb-4 overflow-hidden bg-white shadow sm:rounded-lg">
                <div>
                  <dl>
                    @foreach ($filteredDocuments as $key => $document)
                    <div class="px-4 py-3 grid grid-cols-3 gap-4">
                      <dt class="text-md font-medium text-gray-900 rubik-300">{{$document->title}}
                        x <span wire:model.live="selectedDocuments.{{$key}}.quantity">{{$selectedDocuments[$key]['quantity']}}</span>
                        @if($selectedDocuments[$key]['authentication'] == '1')
                        <span class="text-sm">
                            (with Authentication)
                        </span>
                        @endif
                        </dt>
                      <dd class="mt-1 text-md leading-6 text-gray-700 col-span-1 col-start-3 text-right rubik-300"><span wire:model.live="selectedDocuments.{{$key}}.amount">
                        @php
                           $sub_total =  $document->amount * $selectedDocuments[$key]['quantity']
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
                            $amount = App\Models\Document::find($document['id'])->amount;
                            $total += $amount * $document['quantity'];
                        }
                    @endphp
                    ₱ {{number_format($total, 2)}}
                    </span>
                </dd>
                    </div>
                </div>
              </div>
            {{-- content end --}}
            <div class="col-span-full ">
                <label for="about" class="block text-md font-medium leading-6 text-gray-900">Purpose of Request <span class="text-red-500 text-lg">*</span></label>
                <div class="mt-2 mb-4">
                  <textarea wire:model="purpose" id="about" name="about" rows="3" class="rubik-300 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"></textarea>
                  @error('purpose') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
              </div>
          </div>
          <div class="flex mt-3 justify-end">
            {{ $this->editAction }}
            <x-filament-actions::modals />
          </div>
          @else
          <h1 class="rubick-300 text-xl text-center text-gray-500 italic">No document is selected</h1>
          @endif
          {{-- <button wire:click="test">test</button> --}}
    </div>
</div>
