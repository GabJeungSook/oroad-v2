<div id="printarea" class="my-3 mx-auto bg-white">
    <div class="border-x-2 border-t-2 border-gray-300 px-4 pt-4 pb-2">
        <div class="header flex justify-center items-center">
            <img src="{{asset('images/sksu_logo.png')}}" alt="Logo" class="mr-4 h-12 w-12">
            <h2 class="lg:text-3xl sm:text-lg sm:text-center rubik-400 tracking-wider">SULTAN KUDARAT STATE UNIVERSITY<p class="text-sm text-center sm:text-center">EJC Montilla, 9800, Province of Sultan Kudarat, Philippines</p></h2>

        </div>
        <div class="header flex justify-center items-center my-2 ">
            <h2 class="text-xl rubik-400 tracking-wider ml-12 sm:ml-14">Online Request of Academic Documents</h2>
        </div>
        <div class="flex justify-end text-sm rubik-400 mt-5">
             {{now()->format('F d, Y')}}
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
            <label class="rubik-400 text-sm">Gender : {{ucfirst($record->user->user_information->gender)}}</label>
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
            <label class="rubik-400 text-sm">Request Date : {{Carbon\Carbon::parse($record->created_at)->format('F d, Y - h:i:s A')}}</label>
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
            <label class="rubik-400 text-sm">₱ {{number_format($document->pivot->amount, 2)}}</label>
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
