@extends('layout')
@section('content')
    <div class="w-full max-w-xs">
        @if (session('status'))
            <div class="mb-2 text-center {{ session('status')['type'] == 'success' ? 'text-green-600' : 'text-red-600' }}">
                {{ session('status')['message'] }}
            </div>
        @endif

        <form action="{{ route('otp.store') }}" class="space-y-4" method="POST" autocomplete="off">
            @csrf

            <h1 class="text-xl font-semibold text-center">OTP Page</h1>

            <div>
                <label for="otp" class="block text-xs">OTP Code</label>
                <input type="text" name="otp" id="otp" class="w-full border border-black number-format"
                    autofocus />
                @error('otp')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full text-center border border-black hover:bg-black hover:text-white">Confirm</button>
            </div>
        </form>

        <form action="{{ route('otp.resend') }}" method="POST" class="mt-5">
            @csrf

            <button type="submit" class="w-full text-center underline">Resend
                OTP</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.number-format').forEach(element => {
            element.addEventListener('input', (e) => {
                let inputValue = e.target.value;
                inputValue = inputValue.replace(/[^0-9]/g, '');
                e.target.value = inputValue;
            });
        });
    </script>
@endpush
