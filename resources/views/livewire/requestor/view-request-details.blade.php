<div>
    <div class="rubik-300 text-3xl text-gray-600">
        <div class="flex justify-between">
            <h1>Request Details</h1>
            <div class="flex space-x-4">
                <a wire:navigate href="{{route('dashboard')}}">
                    <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                      </svg>
                      <span class="px-2">Return</span>
                    </button>
                </a>
                <div class="lg:block sm:hidden">
                    <button onclick="printDiv('printarea')" type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                          </svg>
                      <span class="px-2">Print</span>
                    </button>
                </div>

                <button  onclick="printDiv('printarea')" type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M5 4H15V8H19V20H5V4ZM3.9985 2C3.44749 2 3 2.44405 3 2.9918V21.0082C3 21.5447 3.44476 22 3.9934 22H20.0066C20.5551 22 21 21.5489 21 20.9925L20.9997 7L16 2H3.9985ZM10.4999 7.5C10.4999 9.07749 10.0442 10.9373 9.27493 12.6534C8.50287 14.3757 7.46143 15.8502 6.37524 16.7191L7.55464 18.3321C10.4821 16.3804 13.7233 15.0421 16.8585 15.49L17.3162 13.5513C14.6435 12.6604 12.4999 9.98994 12.4999 7.5H10.4999ZM11.0999 13.4716C11.3673 12.8752 11.6042 12.2563 11.8037 11.6285C12.2753 12.3531 12.8553 13.0182 13.5101 13.5953C12.5283 13.7711 11.5665 14.0596 10.6352 14.4276C10.7999 14.1143 10.9551 13.7948 11.0999 13.4716Z">
                    </path>
                    </svg>
                  <span class="px-2">Save as PDF</span>
                </button>
            </div>
        </div>
        <div id="printarea" class="my-3 mx-auto bg-white">
            <div class="border-x-2 border-t-2 border-gray-300 p-4">
                <div class="header flex justify-center items-center">
                    <img src="{{asset('images/sksu_logo.png')}}" alt="Logo" class="mr-4 h-12 w-12">
                    <h2 class="lg:text-3xl sm:text-lg sm:text-center rubik-400 tracking-wider">SULTAN KUDARAT STATE UNIVERSITY<p class="text-sm text-center sm:text-center">EJC Montilla, 9800, Province of Sultan Kudarat, Philippines</p></h2>

                </div>
                <div class="header flex justify-center items-center my-2 ">
                    <h2 class="text-xl rubik-400 tracking-wider ml-12 sm:ml-14">Online Request of Academic Documents</h2>
                </div>
                <div class="flex justify-end text-sm rubik-400 mt-5">
                    Date : {{now()->format('F d, Y')}}
                </div>
            </div>
            <div class="w-full border-x-1 border-gray-300 bg-green-950 text-white">
                <div class="border-r-2 px-3 py-1">
                    <label class="rubik-400 text-lg">Requestor Information</label>
                </div>
            </div>
            <div class="grid grid-cols-2 w-full border-x-1 border-gray-300 bg-white">
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Full Name : {{ucwords($record->user->user_information->first_name.' '.$record->user->user_information->middle_name.' '.$record->user->user_information->last_name)}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Gender : {{strtoupper($record->user->user_information->gender)}}</label>
                </div>
            </div>
            <div class="grid grid-cols-3 w-full border-x-1 border-gray-300 bg-white">
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Birthday : {{Carbon\Carbon::parse($record->user->user_information->birthday)->format('F d, Y')}}</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    @php
                        $birthday = \Carbon\Carbon::parse($record->user->user_information->birthday);
                        $age = $birthday->diffInYears(\Carbon\Carbon::now());
                    @endphp
                    <label class="rubik-400 text-sm">Age : {{$age}}</label>
                </div>

                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Contact Number : {{str_replace(' ', '', $record->user->user_information->contact_number)}}</label>
                </div>
            </div>
            <div class="grid grid-cols-3 w-full border-x-1 border-gray-300 bg-white">
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Campus : {{$record->user->user_information->campus->name}}</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Course : {{$record->user->user_information->campus->courses->first()->name}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Type : {{$record->user->user_information->userType->name}}</label>
                </div>
            </div>
            <div class="grid grid-cols-1 w-full border-x-1 border-gray-300 bg-white">
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Region : {{$record->user->user_information->philippineRegion->region_description}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Province : {{$record->user->user_information->philippineProvince->province_description}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">City/Municipality : {{$record->user->user_information->philippineCity->city_municipality_description}}</label>
                </div>

            </div>
            <div class="grid grid-cols-2 w-full border-x-1 border-gray-300 bg-white">
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Other Details : {{$record->user->user_information->other_address_details}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Postal Code : {{$record->user->user_information->postal_code}}</label>
                </div>
            </div>
            <div class="w-full border-x-1 border-gray-300 bg-green-950 text-white">
                <div class="border-r-2 px-3 py-1">
                    <label class="rubik-400 text-lg">Request Details</label>
                </div>
            </div>
            <div class="grid grid-cols-1 w-full border-x-1 border-gray-300 bg-white">
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Request Code : {{$record->request_number}}</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">Purpose : {{$record->purpose}}</label>
                </div>
            </div>
            <div class="w-full border-x-1 border-gray-300 bg-green-950 text-white">
                <div class="border-r-2 px-3 py-1">
                    <label class="rubik-400 text-lg">Documents</label>
                </div>
            </div>
            <div class="grid grid-cols-4 w-full border-x-1 border-gray-300 bg-white text-center">
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm text-center uppercase">Title</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm text-center uppercase">Quantity</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm text-center uppercase">With Authentication</label>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm text-center uppercase">Amount</label>
                </div>
            </div>
            <div class="grid grid-cols-4 w-full border-x-1 border-gray-300 bg-white text-center">
                @foreach ($record->documents()->get() as $document)
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">{{$document->title}}</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <label class="rubik-400 text-sm">{{$document->pivot->quantity}}</label>
                </div>
                <div class="col-span-1 border-l-2 border-b-2 px-3 py-1">
                    <input type="checkbox" class="p-2 rounded-md checked:text-green-600" disabled {{$document->pivot->is_authenticated ? 'checked' : ''}}>
                </div>
                <div class="col-span-1 border-x-2 border-b-2 px-3 py-1 text-right">
                    <label class="rubik-400 text-sm">₱ {{number_format($document->amount, 2)}}</label>
                </div>
                @endforeach
            </div>
            <div class="grid grid-cols-4 w-full border-x-1 border-gray-300  bg-white">
                <div class="col-span-1 col-start-1 col-end-1 border-l-2 border-b-2 px-3 py-1 text-center">
                    <label class="rubik-500 text-sm font-bold text-center uppercase">Total Payable : </label>
                </div>
                <div class="col-span-3 col-start-2 border-x-2 border-b-2 px-3 py-1 text-right">
                    <label class="rubik-500 text-sm font-semibold text-center uppercase">₱ {{number_format($record->total_amount, 2)}}</label>
                </div>
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
