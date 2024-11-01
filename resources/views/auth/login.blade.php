


<x-guest-layout>
        {{-- login error show  --}}
        @if ($errors->any())
        <div class="alert alert-danger" style="padding:10px;width:100%;display:block;margin-top:10px;margin-bottom:10px;text-align:center;color:rgb(250, 5, 5);border-radius:10px">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        {{-- login error show  --}}


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        {{-- solical login route is start here  --}}
        <div>
            <a href="{{route('auth.redirection','google')}}" style="background: red;padding:10px;width:100%;display:block;margin-top:10px;text-align:center;color:white;border-radius:10px">Login with Google </a>
            <a href="{{route('auth.redirection','facebook')}}" style="background: rgb(55, 0, 255);padding:10px;width:100%;display:block;margin-top:10px;text-align:center;color:white;border-radius:10px">Login with Facebook </a>
        </div>
        {{-- solical login route is end  here  --}}

    </form>
</x-guest-layout>
