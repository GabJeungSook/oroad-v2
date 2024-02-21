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
                <button type="button" class="flex text-sm bg-gray-50 hover:bg-gray-200 p-2 font-semibold rounded-md border-2 border-gray-400 leading-6 rubik-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                      </svg>
                  <span class="px-2">Print</span>
                </button>
            </div>
        </div>

        {{-- <div class="my-3 border-b-2 border-gray-300 w-full" ></div> --}}
        <div class="container my-3 mx-auto p-8 bg-white border-2 border-gray-300">
            <div class="header flex justify-center items-center">
                <img src="{{asset('images/sksu_logo.png')}}" alt="Logo" class="mr-4 h-12 w-12">
                <h2 class="lg:bg-blue-500 sm:bg-red-500 rubik-400 tracking-wider">SULTAN KUDARAT STATE UNIVERSITY</h2>
            </div>
            <div class="header flex justify-center items-center mb-8">
                <h2 class="text-lg rubik-400 tracking-wider">Online Request of Academic Documents</h2>
            </div>

            <div class="form-info">
                <div class="mb-4">
                    <label class="font-bold">Name:</label>
                    <span class="ml-2">John Doe</span>
                </div>
                <div class="mb-4">
                    <label class="font-bold">Email:</label>
                    <span class="ml-2">john@example.com</span>
                </div>
                <div class="mb-4">
                    <label class="font-bold">Subject:</label>
                    <span class="ml-2">Request Subject</span>
                </div>
                <div class="mb-4">
                    <label class="font-bold">Message:</label>
                    <p class="ml-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac molestie lacus.</p>
                </div>
            </div>
            <button onclick="window.print()" class="btn-submit bg-green-500 text-white px-4 py-2 rounded-full no-print">Print</button>
        </div>
    </div>

</div>
