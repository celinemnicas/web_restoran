@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Name') }}</label>
                <input id="name" type="text" class="w-full px-4 py-3 text-gray-800 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                
                @error('name')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="w-full px-4 py-3 text-gray-800 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                
                @error('email')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                <input id="password" type="password" class="w-full px-4 py-3 text-gray-800 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                
                @error('password')
                    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-6">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="w-full px-4 py-3 text-gray-800 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" name="password_confirmation" required autocomplete="new-password">
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="w-full py-3 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all duration-300">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
