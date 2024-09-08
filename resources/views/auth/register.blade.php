@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto mt-10">
        <h2 class="text-xl mb-12 text-center text-gray-800">Regisztráció</h2>

        <div class="flex justify-center mb-12">
            <img src="./images/logo.png" alt="Cég logó" class="w-5/6">
        </div>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">E-mail cím:</label>
                <input type="email" name="email" id="email"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="Adja meg az e-mail címét"
                       value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nickname" class="block text-gray-700 text-sm font-bold mb-2">Becenév:</label>
                <input type="text" name="nickname" id="nickname"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="Adja meg a becenevét"
                       value="{{ old('nickname') }}">
                @error('nickname')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="birthdate" class="block text-gray-700 text-sm font-bold mb-2">Születési dátum:</label>
                <input id="birthdate" name="birthdate" datepicker datepicker-format="yyyy-mm-dd" type="text"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="Adja meg születési dátumát"
                       value="{{ old('birthdate') }}">
                @error('birthdate')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Jelszó:</label>
                <input type="password" name="password" id="password"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       placeholder="********">
                @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Regisztráció
                </button>
                <a href="/login"
                   class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Bejelentkezés
                </a>
            </div>

            @if (isset($success))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                    <strong>{{ $success }}</strong>
                </div>
            @endif
        </form>
    </div>
@endsection
