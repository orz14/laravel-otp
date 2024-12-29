@extends('layout')
@section('content')
    <div class="w-full max-w-xs">
        @if (session('status'))
            <div class="mb-2 text-center {{ session('status')['type'] == 'success' ? 'text-green-600' : 'text-red-600' }}">
                {{ session('status')['message'] }}
            </div>
        @endif

        <div class="space-y-4">
            <h1 class="text-xl font-semibold text-center">Dashboard Page</h1>

            <div class="text-center">
                Name : {{ auth()->user()->name }}
            </div>

            <form action="{{ route('otp.setting') }}" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit" class="w-full text-center border border-black hover:bg-black hover:text-white"
                    onclick="return confirm('Are you sure you want to {{ auth()->user()->with_otp ? 'Disable' : 'Enable' }} 2FA?')">
                    {{ auth()->user()->with_otp ? 'Disable 2FA' : 'Enable 2FA' }}
                </button>
            </form>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="w-full text-center border border-black hover:bg-black hover:text-white">Logout</button>
            </form>
        </div>
    </div>
@endsection
