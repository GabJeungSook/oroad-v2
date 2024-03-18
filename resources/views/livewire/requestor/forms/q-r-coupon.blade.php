<div>
   <style>
    .printable-border {
    border-style: dotted;
    border-color: green;
    border-width: 2px; /* Adjust width as needed */
    }
   </style>
    <div class="rubik-300 text-3xl text-gray-600">
        <div class="flex justify-between">
            <h1>Claims Stub
                <p class="text-xs">Present this claims stub to your campus registrar to claim your documents.</p>
            </h1>
            <div class="flex space-x-3">
                <a wire:navigate href="{{route('dashboard')}}">
                    <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                      </svg>
                      <span class="px-2">Return</span></button>
                </a>
                <div class="lg:block">
                    <button onclick="printDiv('printarea')" type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                          </svg>
                      <span class="px-2">Print</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="my-3 border-b-2 border-gray-300 w-full" ></div>
        <div id="printarea" class="my-3 mx-auto bg-white">
            <div class="border-x-2 border-t-2 border-gray-300 px-4 pt-4 pb-2">
                <div>
                    <div>
                        <div class="header flex justify-center items-center">
                            <img src="{{asset('images/sksu_logo.png')}}" alt="Logo" class="mr-4 h-16 w-16">
                            <h2 class="lg:text-3xl sm:text-lg sm:text-center rubik-400 tracking-wider">SULTAN KUDARAT STATE UNIVERSITY<p class="text-sm text-center sm:text-center">EJC Montilla, 9800, Province of Sultan Kudarat, Philippines</p></h2>
                        </div>
                        <div class="header flex justify-center items-center my-2 ">
                            <h2 class="text-xl rubik-400 tracking-wider ml-12 sm:ml-14">Online Request of Academic Documents</h2>
                        </div>
                        <div class="mt-5 flex justify-center mb-2">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{$record->request_number}}" alt="QR CODE">
                        </div>
                        <p class="text-center text-xs font-mono">{{$record->request_number}}</p>
                    </div>
                </div>
                <div class="flex justify-end text-sm rubik-400 mt-5">
                     {{now()->format('F d, Y')}}
                </div>
            </div>
            <div class="w-full border-x-1 border-gray-300 bg-green-950 text-white">
                <div class="border-r-2 px-3 py-1">
                    <label class="rubik-400 text-lg">Claims Stub</label>
                </div>
            </div>
            <div class="grid grid-cols-1 w-full border-x-1 border-gray-300 bg-white">
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Requested Date : {{Carbon\Carbon::parse($record->created_at)->format('F d, Y - h:i:s A')}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Claim Date : {{Carbon\Carbon::parse($record->claimed_at)->format('F d, Y - h:i:s A')}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Remarks : {{$record->remarks}}</label>
                </div>
            </div>
            <div class="w-full border-x-1 border-gray-300 bg-green-950 text-white">
                <div class="border-r-2 px-3 py-1">
                    <label class="rubik-400 text-lg">Documents</label>
                </div>
            </div>
            <div class="grid grid-cols-3 w-full border-x-1 border-gray-300 bg-white text-center">
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm text-center uppercase">Title</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm text-center uppercase">Quantity</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm text-center uppercase">With Authentication</label>
                </div>
            </div>
            <div class="grid grid-cols-3 w-full border-x-1 border-gray-300 bg-white text-center">
                @foreach ($record->documents()->get() as $document)
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">{{$document->title}}</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">{{$document->pivot->quantity}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <input type="checkbox" class="p-2 rounded-md checked:text-green-600" disabled {{$document->pivot->is_authenticated ? 'checked' : ''}}>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                    <div class="rubik-300 text-lg space-y-2 p-4 border-b-2 border-dashed">
                    </div>

            </div>
            </div>


    </div>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</div>
