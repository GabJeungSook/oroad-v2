<div id="printarea"  style="margin-top: 0.75rem; margin-bottom: 0.75rem; margin-left: auto; margin-right: auto; background-color: #fff;">
    <div  style="border-width: 0.125rem 0.25rem; border-style: solid; border-color: #d1d5db #d1d5db #fff #d1d5db; padding-left: 1rem; padding-right: 1rem; padding-top: 1rem; padding-bottom: 0.5rem;">
        {{-- <div  style="display: flex; justify-content: center; align-items: center;">
            <img src="{{asset('images/sksu_logo.png')}}" alt="Logo"  style="margin-right: 1rem; height: 4rem; width: 4rem;">
            <h2  style="font-family: 'Rubik', sans-serif; font-weight: 400; letter-spacing: 0.025em; font-size: 1.875rem; text-align: center;">SULTAN KUDARAT STATE UNIVERSITY<p class="text-sm text-center sm:text-center" style="font-size: 0.875rem; text-align: center;">EJC Montilla, 9800, Province of Sultan Kudarat, Philippines</p></h2>
        </div> --}}


         <div  style="display: flex; justify-content: center; align-items: center;">
            <img src="{{ public_path('images/sksu_logo.png') }}" alt="Logo"  style="margin-right: 1rem; height: 4rem; width: 4rem;">
            <h2  style="font-family: 'Rubik', sans-serif; font-weight: 400; letter-spacing: 0.025em; font-size: 1.875rem; text-align: center;">SULTAN KUDARAT STATE UNIVERSITY<p class="text-sm text-center sm:text-center" style="font-size: 0.875rem; text-align: center;">EJC Montilla, 9800, Province of Sultan Kudarat, Philippines</p></h2>
        </div>

        <div  style="display: flex; justify-content: center; align-items: center; margin-top: 0.5rem;">
            <h2  style="font-family: 'Rubik', sans-serif; font-weight: 400; letter-spacing: 0.025em; font-size: 1.25rem; margin-left: 3rem;">Online Request of Academic Documents</h2>
        </div>
        <div style="display: flex; justify-content: flex-end; font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem; margin-top: 1.25rem;">
             {{now()->format('F d, Y')}}
        </div>
    </div>
    <div style="width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #065f46; color: #fff;">
        <div style="border-right-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 1.125rem;">Requestor Information</label>
        </div>
    </div>
    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff;">
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Full Name : {{ucwords($record->user_information->first_name.' '.$record->user_information->middle_name.' '.$record->user_information->last_name)}}</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Gender : {{ucfirst($record->user_information->gender)}}</label>
        </div>
    </div>
    <div  style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff;">
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Birthday : {{Carbon\Carbon::parse($record->user_information->birthday)->format('F d, Y')}}</label>
        </div>
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            @php
                $birthday = \Carbon\Carbon::parse($record->user_information->birthday);
                $age = $birthday->diffInYears(\Carbon\Carbon::now());
            @endphp
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Age : {{$age}}</label>
        </div>
        <div class="col-span-1 border-x-2 border-b-2 px-3 py-1" style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Contact Number : {{str_replace(' ', '', $record->user_information->contact_number)}}</label>
        </div>
    </div>
    <div  style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff;">
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Campus : {{$record->user_information->campus->name}}</label>
        </div>
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Course : {{$record->user_information->campus->courses->first()->name}}</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Type : {{$record->user_information->userType->name}}</label>
        </div>
    </div>
    <div  style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff;">
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Region : {{$record->user_information->philippineRegion->region_description}}</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Province : {{$record->user_information->philippineProvince->province_description}}</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">City/Municipality : {{$record->user_information->philippineCity->city_municipality_description}}</label>
        </div>
    </div>
    <div  style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff;">
        <div style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Other Details : {{$record->user_information->other_address_details}}</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Postal Code : {{$record->user_information->postal_code}}</label>
        </div>
    </div>
    <div style="width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #065f46; color: #fff;">
        <div  style="border-right-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 1.125rem;">Request Details</label>
        </div>
    </div>
    <div  style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff;">
        <div style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Request Code : {{$record->request_number}}</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Request Date : {{Carbon\Carbon::parse($record->created_at)->format('F d, Y - h:i:s A')}}</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">Purpose : {{$record->purpose->name}}</label>
        </div>
    </div>
    <div class="w-full border-x-1 border-gray-300 bg-green-950 text-white" style="width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #065f46; color: #fff;">
        <div class="border-r-2 px-3 py-1" style="border-right-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label class="rubik-400 text-lg" style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 1.125rem;">Documents</label>
        </div>
    </div>
    <div  style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff; text-align: center;">
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem; text-transform: uppercase;">Title</label>
        </div>
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem; text-transform: uppercase;">Quantity</label>
        </div>
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem; text-transform: uppercase;">With Authentication</label>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem; text-transform: uppercase;">Amount</label>
        </div>
    </div>
    <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff; text-align: center;">
        @foreach ($record->documents()->get() as $document)
        <div style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">{{$document->title}}</label>
        </div>
        <div style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <label style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">{{$document->pivot->quantity}}</label>
        </div>
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem;">
            <input type="checkbox" {{$document->pivot->is_authenticated ? 'checked' : ''}}>
        </div>
        <div  style="grid-column: span 1; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem; text-align: right;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 400; font-size: 0.875rem;">₱ {{number_format($document->pivot->amount, 2)}}</label>
        </div>
        @endforeach
    </div>
    <div  style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); width: 100%; border-width: 0.0625rem; border-style: solid; border-color: #d1d5db; background-color: #fff;">
        <div  style="grid-column: span 1; border-left-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem; text-align: center;">
            <label  style="font-family: 'Rubik', sans-serif; font-weight: 500; font-size: 0.875rem; text-transform: uppercase;">Total Payable : </label>
        </div>
        <div  style="grid-column: span 3; border-right-width: 0.125rem; border-bottom-width: 0.125rem; padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0.25rem; padding-bottom: 0.25rem; text-align: right;">
            <label style="font-family: 'Rubik', sans-serif; font-weight: 500; font-size: 0.875rem; text-transform: uppercase;">₱ {{number_format($record->total_amount, 2)}}</label>
        </div>
    </div>
</div>
