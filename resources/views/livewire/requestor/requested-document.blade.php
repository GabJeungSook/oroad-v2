<div>
    <div class="rubik-300 text-3xl text-gray-600">
        <h1>Request Form</h1>
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
                        <input wire:click="document_selected({{$item->id}})" type="checkbox" class="sm:p-12 lg:p-2 mx-2 appearance-none border-2 rounded-md w-6 h-6 border-gray-400">
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
                    <p class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">₱ {{number_format($document->amount, 2)}}</p>
                  </div>
                </div>
                <div class="flex space-x-4">
                  <div class="flex flex-col items-center gap-x-4">
                      <label for="selectedDocuments.{{$document->id}}.quantity" class="block text-sm font-medium leading-6 text-gray-800 rubik-400">Quantity</label>
                      <select wire:key="{{$key}}" wire:model="selectedDocuments.{{$document->id}}.quantity" id="selectedDocuments.{{$document->id}}.quantity" name="selectedDocuments.{{$document->id}}.quantity" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option selected>1</option>
                        <option >2</option>
                        <option >3</option>
                        <option >4</option>
                        <option >5</option>
                      </select>
                    </div>
                    <div class="flex flex-col items-center gap-x-4">
                      <label for="selectedDocuments.{{$document->id}}.authenticated" class="block text-sm font-medium leading-6 text-gray-800 rubik-400">With Authentication</label>
                      <select wire:key="{{$key}}" wire:model="selectedDocuments.{{$document->id}}.authenticated" id="selectedDocuments.{{$document->id}}.authenticated" name="selectedDocuments.{{$document->id}}.authenticated" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="1">Yes</option>
                        <option selected value="0">No</option>
                      </select>
                    </div>
                </div>
              </li>
            @endforeach
          </ul>
          <div class="mt-5 divide-y divide-gray-100 px-5 border-2 border-gray-300 rounded-md">
            <h1 class="rubik-300 text-xl text-gray-600 mb-4 py-4">Request Code : {{$request_number}} </h1>
          </div>
          @else
          <h1 class="rubick-300 text-xl text-center text-gray-500 italic">No document is selected</h1>
          @endif
          <button wire:click="test">test</button>
    </div>
</div>
