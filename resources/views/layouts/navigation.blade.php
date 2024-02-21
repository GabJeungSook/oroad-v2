<nav x-data="{ OpenMobile: false }" @click.away="OpenMobile = false" class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 lg:px-6 sm:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex">
          <div class="flex flex-shrink-0 items-center space-x-2">
            <img class="h-12 w-auto " src="{{asset('images/sksu_logo.png')}}" alt="Your Company">
            <img class="h-12 w-auto " src="{{asset('images/oroad_logo.png')}}" alt="Your Company">
          </div>
          @php
              $user = App\Models\User::where('id', auth()->user()->id)->first();
          @endphp
          @if ($user->user_information)
          <div class="hidden lg:ml-28 lg:flex lg:space-x-8">
            <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
            <a href="{{route('dashboard')}}" wire:navigate class="{{ request()->routeIs('dashboard') ? 'inline-flex items-center border-b-4 rounded-sm border-green-600 px-1 pt-1 text-md font-semibold text-gray-900 rubik-400' : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-md font-semibold text-gray-500 hover:border-green-600 hover:text-gray-700 rubik-400'}} ">Request History</a>
            <a href="{{route('requestor.request-document')}}" wire:navigate class="{{ request()->routeIs('requestor.request-document') ? 'inline-flex items-center border-b-4 rounded-sm border-green-600 px-1 pt-1 text-md font-semibold text-gray-900 rubik-400' : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-md font-semibold text-gray-500 hover:border-green-600 hover:text-gray-700 rubik-400'}}">Request Documents</a>
            <a href="{{route('requestor.update-user-information')}}" wire:navigate class="{{ request()->routeIs('requestor.update-user-information') ? 'inline-flex items-center border-b-4 rounded-sm border-green-600 px-1 pt-1 text-md font-semibold text-gray-900 rubik-400' : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-md font-semibold text-gray-500 hover:border-green-600 hover:text-gray-700 rubik-400'}}">Update Information</a>
            <a href="#" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-md font-semibold text-gray-500 hover:border-green-600 hover:text-gray-700 rubik-400">Helpdesk</a>
          </div>
          @endif

        </div>
        <div class="hidden lg:ml-6 lg:flex lg:items-center">
          {{-- <button type="button" class="relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
          </button> --}}

          <!-- Profile dropdown -->
          <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="relative ml-3">
            <div>
              <button @click="isOpen = !isOpen" type="button" class="relative flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img class="h-10 w-10 rounded-full" src="{{auth()->user()->profile_photo_path}}" alt="">
              </button>
            </div>

            <!--
              Dropdown menu, show/hide based on menu state.

              Entering: "transition ease-out duration-200"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
            <div x-cloak x-show.transition.origin.top.right.duration.200="isOpen" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-green-600 ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <!-- Active: "bg-gray-100", Not Active: "" -->
              <form action="{{route('logout')}}" method="POST">
                @csrf
              <button class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Log out</button>
              </form>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex items-center lg:hidden">
          <!-- Mobile menu button -->
          <button @click="OpenMobile = !OpenMobile" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.

              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
              Icon when menu is open.

              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-cloak x-show.transition.origin.top.right.duration.200="OpenMobile" class="lg:hidden" id="mobile-menu">
        @if ($user->user_information)
      <div class="space-y-1 pb-3 pt-2">
        <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
        <a href="{{route('dashboard')}}" wire:navigate class="{{request()->routeIs('dashboard') ? 'block border-l-4 border-green-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-green-700' : 'block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700'}}">Request History</a>
        <a href="{{route('requestor.request-document')}}" wire:navigate class="{{request()->routeIs('requestor.request-document') ? 'block border-l-4 border-green-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-green-700' : 'block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700'}}">Request Documents</a>
        <a href="{{route('requestor.update-user-information')}}" wire:navigate class="{{request()->routeIs('requestor.update-user-information') ? 'block border-l-4 border-green-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-green-700' : 'block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700'}}">Update Information</a>
        <a href="#" wire:navigate class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">Helpdesk</a>
      </div>
      @endif
      <div class="border-t border-gray-200 pb-3 pt-4">
        <div class="flex items-center px-4">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="{{auth()->user()->profile_photo_path}}" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-gray-800">{{auth()->user()->name}}</div>
            <div class="text-sm font-medium text-gray-500">{{auth()->user()->email}}</div>
          </div>
        </div>
        <div class="mt-3 space-y-1">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Log out</button>
            </form>

        </div>
      </div>
    </div>
  </nav>
