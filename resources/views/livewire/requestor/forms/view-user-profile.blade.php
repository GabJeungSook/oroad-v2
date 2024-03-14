<div>
    <div>
        <div class="px-4 sm:px-0">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">User Information</h3>
                    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and atttachments.</p>
                </div>
                <div class="flex space-x-3">
                    <div>
                        {{ $this->updateUserAction }}
                        <x-filament-actions::modals />
                    </div>
                </div>
            </div>

        </div>
        <div class="mt-6">
          <dl class="grid grid-cols-1 sm:grid-cols-2">
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->fullName()}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">Gender</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ucwords($record->gender)}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Birthday</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{Carbon\Carbon::parse($record->birthday)->format('F d, Y')}}</dd>
              </div>
              <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Age</dt>
                @php
                 $birthday = Carbon\Carbon::parse($record->birthday);
                 $age = $birthday->diff(Carbon\Carbon::now())->format('%y');
                @endphp
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$age}}</dd>
              </div>
              <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->fullAddress()}}</dd>
              </div>
              <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Postal Code</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->postal_code}}</dd>
              </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->user->email}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">Contact Number</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{str_replace(' ', '', $record->contact_number)}}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Campus</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{strtoupper($record->campus->name)}}</dd>
              </div>
              <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Course</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->course->name}}</dd>
              </div>
              <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Year Graduated</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->year_graduated}}</dd>
              </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
              <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
              <dd class="mt-2 text-sm text-gray-900">
                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                  <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                    <div class="flex w-0 flex-1 items-center">
                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                          </svg>
                      <div class="ml-4 flex min-w-0 flex-1 gap-2">
                        <span class="truncate font-medium">Valid I.D</span>
                      </div>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <a href="{{ Storage::disk('public')->url($record->valid_id_path) }}" target="_blank" class="mx-3 font-semibold text-green-700 hover:text-green-700 hover:underline flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>
                          View
                        </a>
                      </div>
                  </li>
                  <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                    <div class="flex w-0 flex-1 items-center">
                      <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                      </svg>
                      <div class="ml-4 flex min-w-0 flex-1 gap-2">
                        <span class="truncate font-medium">Campus Clearance</span>
                      </div>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        @if ($record->campus_clearance_path === null)
                        <div>
                            {{ $this->uploadClearanceAction }}
                        </div>
                        @else
                        <div class="flex space-x-3">
                            <div class="ml-4 flex-shrink-0">
                                <a href="{{ Storage::disk('public')->url($record->campus_clearance_path) }}" target="_blank" class="mx-3 font-semibold text-green-700 hover:text-green-700 hover:underline flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                      </svg>
                                  View
                                </a>
                              </div>
                              <div>
                                {{ $this->updateClearanceAction }}
                              </div>
                        </div>

                        @endif
                      {{-- <a href="#" class="font-medium text-green-600 hover:text-green-500">View</a> --}}
                    </div>
                  </li>
                </ul>
              </dd>
            </div>
          </dl>
        </div>
      </div>

      <div>
        <div class="px-4 sm:px-0">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Representative Information</h3>
                    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Representative name and valid id.</p>
                </div>
                <div class="flex space-x-3">
                    @if ($record->representative !== null)
                    <div>
                        {{ $this->updateRepresentativeAction }}
                    </div>
                    @else
                    <div>
                        {{ $this->addRepresentative }}
                    </div>
                    @endif
                    <x-filament-actions::modals />
                </div>
            </div>
        </div>
        @if ($record->representative !== null)
        <div class="mt-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2">
              <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{$record->representative->fullName()}}</dd>
              </div>
              <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
                <dd class="mt-2 text-sm text-gray-900">
                  <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                      <div class="flex w-0 flex-1 items-center">
                          <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                            </svg>
                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                          <span class="truncate font-medium">Valid I.D</span>
                        </div>
                      </div>
                      <div class="ml-4 flex-shrink-0">
                          <a href="{{ Storage::disk('public')->url($record->representative->representative_valid_id_path) }}" target="_blank" class="mx-3 font-semibold text-green-700 hover:text-green-700 hover:underline flex items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            View
                          </a>
                        </div>
                    </li>
                  </ul>
                </dd>
              </div>
            </dl>
          </div>
        @endif

      </div>

</div>
