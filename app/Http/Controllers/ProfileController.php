<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        if (rand(0, 1) === 0) {
            $data = $user;
            $data["read_from"] = "Adatbázisból";
        } else {
            $data = $this->readFromJson($user->id);
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

        $this->updateJson($user);

        return view('profile', [
            'success' => 'Profil frissítve',
            'user' => $user
        ]);
    }

    private function readFromJson($userId)
    {
        $jsonPath = storage_path('app/users.json');

        if (file_exists($jsonPath)) {
            $jsonContent = json_decode(file_get_contents($jsonPath), true);

            foreach ($jsonContent as $jsonUser) {
                if ($jsonUser['id'] == $userId) {
                    return (new \App\Models\User())->fill($jsonUser);
                }
            }
        }

        return Auth::user();
    }


    private function updateJson($user)
    {
        $jsonPath = storage_path('app/users.json');

        if (file_exists($jsonPath)) {
            $jsonContent = json_decode(file_get_contents($jsonPath), true);

            foreach ($jsonContent as $index => $jsonUser) {
                if ($jsonUser['id'] == $user->id) {
                    $jsonContent[$index]['nickname'] = $user->nickname;
                    $jsonContent[$index]['email'] = $user->email;
                    $jsonContent[$index]['birthdate'] = $user->birthdate;
                    break;
                }
            }

            file_put_contents($jsonPath, json_encode($jsonContent, JSON_PRETTY_PRINT));
        } else {
            $newData = [
                [
                    'id' => $user->id,
                    'nickname' => $user->nickname,
                    'email' => $user->email,
                    'birthdate' => $user->birthdate,
                    'password' => $user->password,
                ]
            ];

            file_put_contents($jsonPath, json_encode($newData, JSON_PRETTY_PRINT));
        }
    }
}
