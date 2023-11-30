@extends('auth.guest')

            <form method="POST" action="{{ route('login') }}">
                @csrf
                Login
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                
                @error('email') {{ $message }} @enderror
                @error('password') {{ $message }} @enderror
                
                <button>
                    Login
                </button>
            </form>
            <br>
            <a href="{{ url('/register') }}">Register</a>
