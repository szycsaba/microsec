@extends('layouts.app')

@section('content')
    <div class="flex flex-col mt-2 mb-5 sm:mt-20 items-center">
        <div class="sm:w-2/3 w-[95vw] bg-white rounded-lg shadow-lg p-10">
            <img src="./images/logo.png" alt="logo" class="mx-auto mb-6 w-2/3 sm:w-1/3">

            <h1 class="text-xl sm:text-2xl font-bold mt-10 mb-4">Microsec Beadandó Projekt</h1>
            <p class="text-gray-600 mt-10 mb-8 px-4 sm:px-0">
                Ezen a weboldalon a Microsec beadandó projektemet dolgozom ki, amelynek keretében különböző felhasználói
                funkciókat valósítok meg, mint például a regisztráció, a bejelentkezés, és az adatok módosítása. A projekt célja,
                hogy egy egyszerű, felhasználóbarát felületet hozzak létre, amely biztonságosan kezeli a felhasználói adatokat.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 mt-16 sm:gap-4 gap-4">
                <div class="flex justify-end">
                    <a href="/login" class="block w-full sm:w-1/3 min-w-[150px] text-center bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Bejelentkezés</a>
                </div>
                <div class="flex justify-start">
                    <a href="/register" class="block w-full sm:w-1/3 min-w-[150px] text-center bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">Regisztráció</a>
                </div>
            </div>

        </div>
    </div>
@endsection
