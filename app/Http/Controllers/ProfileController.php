<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Services\JsonUserService;

class ProfileController extends Controller
{
    protected $jsonUserService;

    public function __construct(JsonUserService $jsonUserService)
    {
        $this->jsonUserService = $jsonUserService;
    }
    public function edit()
    {
        $user = Auth::user();

        if (rand(0, 1) === 0) {
            $data = $user;
            $data["read_from"] = "Adatbázisból";
        } else {
            $data = $this->jsonUserService->readFromJson($user->id) ?? $user;
            $data["read_from"] = "Fájlból";
        }

        return view('profile', ['user' => $data]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nickname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'password' => 'nullable|min:8',
        ],[
            'nickname.required' => 'A becenév megadása kötelező!',
            'nickname.string' => 'A becenévnek karaktereket kell tartalmaznia!',
            'nickname.max' => 'A becenév max 255 karakter lehet!',
            'birthdate.required' => 'A születési dátum megadása kötelező!',
            'birthdate.date' => 'A születési dátum formátuma nem megfelelő!',
            'password.min' => 'A jelszó legalább 8 karakter legyen!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->nickname = $request->input('nickname');
        $user->birthdate = $request->input('birthdate');

        if ($request->filled('password')) {
            $user->password = $request->input('password');
        }
        $user->save();

        $this->jsonUserService->updateJson($user);

        return view('profile', [
            'success' => 'Profil frissítve',
            'user' => $user
        ]);
    }

}
