@extends('layout')
@section('content')
    <div class="w-full max-w-xs">
        <form action="{{ route('register.store') }}" class="space-y-4" method="POST" autocomplete="off">
            @csrf

            <h1 class="text-xl font-semibold text-center">Register Page</h1>

            <div>
                <label for="name" class="block text-xs">Name</label>
                <input type="text" name="name" id="name" class="w-full border border-black" />
            </div>

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
                    class="w-full text-center border border-black hover:bg-black hover:text-white">Register</button>
            </div>
        </form>

        <div class="mt-5 text-center">
            <a href="{{ route('login') }}" class="underline">Login</a>
        </div>
    </div>
@endsection
