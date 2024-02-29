<div>
    <div class="border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
          <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->first_name . ' '
            . $record->middle_name . ' '
            . $record->last_name;}}</dd>
        </div>
        <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
          <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{
             $record->other_address_details.', '
            .$record->philippineCity->city_municipality_description.', '
            .$record->philippineCity->province->province_description.', '
            .$record->philippineCity->province->region->region_description
          }}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
            <dt class="text-sm font-medium leading-6 text-gray-900">Birthday</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{\Carbon\Carbon::parse($record->birthday)->format('F d, Y')}}</dd>
        </div>
        <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
            <dt class="text-sm font-medium leading-6 text-gray-900">Age</dt>
            @php
            $birthday = \Carbon\Carbon::parse($record->birthday);
            $age = $birthday->diffInYears(\Carbon\Carbon::now());
            @endphp
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$age}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
            <dt class="text-sm font-medium leading-6 text-gray-900">Gender</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ucwords($record->gender)}}</dd>
        </div>
        <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
            <dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->user->email}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
          <dt class="text-sm font-medium leading-6 text-gray-900">Contact Number</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{str_replace(' ', '', $record->contact_number)}}</dd>
        </div>
        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-3">
          <dt class="text-sm font-medium leading-6 text-gray-900">Campus</dt>
          <dd class=" text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->course->campus->name}}</dd>
          <dt class="text-sm font-medium leading-6 text-gray-900">Course</dt>
          <dd class=" text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->course->name}}</dd>
          <dt class="text-sm font-medium leading-6 text-gray-900">Type</dt>
          <dd class=" text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->userType->name}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
          <dt class="text-sm font-medium leading-6 text-gray-900">Valid I.D</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
            <a href="{{ Storage::disk('public')->url($record->valid_id_path) }}" target="_blank">
                <img src="{{ Storage::disk('public')->url($record->valid_id_path) }}" alt="Valid ID">
            </a>
          </dd>
        </div>
      </dl>
    </div>
  </div>
