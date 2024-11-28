@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('Verify Your Email Address') }}</h2>

        <div class="text-gray-700 mb-6">
            @if (session('resent'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-md">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p>{{ __('If you did not receive the email') }}, 
                <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-300 focus:outline-none">
                        {{ __('click here to request another') }}
                    </button>.
                </form>
            </p>
        </div>
    </div>
</div>
@endsection
