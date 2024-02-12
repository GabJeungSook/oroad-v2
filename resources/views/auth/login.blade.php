<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf





        <!-- Email Address -->
        <div>
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}
            <button class="items-center px-4 py-2 bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-600 active:bg-green-600 transition ease-in-out duration-150 w-full">
                <span class="text-center">LOG IN</span>
            </button>

        </div>
        <div class="flex items-center my-4">
            <div class="flex-1 border-t border-gray-300"></div>
            <div class="mx-4 text-gray-500 font-normal">or</div>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>
        <a class="inline-flex items-center w-full py-2 mt-2 text-xs font-semibold tracking-widest uppercase transition border rounded-md border-primary-600 bg-primary-600 from-primary-bg-alt to-secondary-bg hover:bg-primary-500 hover:text-primary-text active:bg-green-300 focus:outline-none focus:border-green-300 focus:ring-1 focus:ring-green-300 disabled:opacity-25"
        href="{{route('google-auth')}}">
         <span class="inline-flex m-auto text-center"><img class="inline h-6 mx-0 px-auto" src="https://img.icons8.com/color/48/000000/google-logo.png" /> <span
                   class="pl-2 my-auto font-light text-gray-600 text-md">Login with Google</span>
         </span>
        </a>
    </form>
</x-guest-layout>
