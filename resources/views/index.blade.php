@extends('layout')
@section('content')
    <div class="w-full max-w-xs">
        <form class="space-y-4" autocomplete="off">
            <h1 class="text-xl font-semibold text-center">Login Page</h1>

            <div>
                <label for="email" class="block text-xs">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-black" />
            </div>

            <div>
                <label for="password" class="block text-xs">Password</label>
                <input type="password" name="password" id="password" class="w-full border border-black" />
            </div>

            <div>
                <button type="submit"
                    class="w-full text-center border border-black hover:bg-black hover:text-white">Login</button>
            </div>
        </form>

        <div class="mt-5 text-center">
            <a href="{{ url('/register') }}" class="underline">Register</a>
        </div>
    </div>
@endsection
