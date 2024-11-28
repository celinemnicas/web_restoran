@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="w-full px-4 py-3 text-gray-800 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                
                @error('email')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                <input id="password" type="password" class="w-full px-4 py-3 text-gray-800 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                
                @error('password')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-6 flex items-center">
                <input class="form-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="ml-2 text-sm text-gray-700">{{ __('Remember Me') }}</label>
            </div>

            <!-- Login Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="w-full py-3 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all duration-300">
                    {{ __('Login') }}
                </button>
            </div>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <div class="mt-4 text-center">
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
