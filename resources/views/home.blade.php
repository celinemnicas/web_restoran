@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <div class="w-full max-w-3xl p-8 bg-white rounded-lg shadow-xl">
        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-center text-gray-800">{{ __('Dashboard') }}</h2>
        </div>

        <div class="space-y-4">
            @if (session('status'))
                <div class="p-4 bg-green-100 text-green-800 border-l-4 border-green-600 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="text-center text-lg text-gray-700">
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
@endsection
