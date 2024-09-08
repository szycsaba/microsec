@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">{{ $user->nickname }} profil szerkesztése</h1>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <h6 class="text-base font-bold mb-6 text-center">Adatok beolvasva: {{ $user->read_from }}</h6>

            <!-- Név mező -->
            <div class="mb-4">
                <label for="nickname" class="block text-gray-700 font-medium">Becenév</label>
                <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $user->nickname) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
                @error('nickname')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- E-mail mező -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">E-mail cím</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" disabled>
            </div>

            <!-- Születési dátum mező -->
            <div class="mb-4">
                <label for="birthdate" class="block text-gray-700 font-medium">Születési dátum</label>
                <input id="birthdate" name="birthdate" datepicker datepicker-format="yyyy-mm-dd" value="{{ old('birthdate', $user->birthdate) }}" type="text"  class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
                @error('birthdate')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jelszó mező -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Új jelszó</label>
                <input type="password" id="password" name="password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" placeholder="Hagyd üresen, ha nem akarod megváltoztatni">
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mentés gomb -->
            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">Mentés</button>
            </div>
        </form>

        <!-- Kijelentkezés gomb -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4 text-center">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 focus:ring focus:ring-red-300">
                Kijelentkezés
            </button>
        </form>

        @if (isset($success))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                <strong>{{ $success }}</strong>
            </div>
        @endif
    </div>
@endsection
