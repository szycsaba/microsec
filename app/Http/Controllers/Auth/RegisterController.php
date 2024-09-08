<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (Storage::exists('users.json')) {
            $jsonData = Storage::get('users.json');
            $users = json_decode($jsonData, true); // Konvertálás PHP tömbbe
        } else {
            $users = [];
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'nickname' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'email.required' => 'E-mail mező kitöltése kötelező!',
            'email.email' => 'Hibás e-mail formátum!',
            'email.max' => 'E-mail max 50 karakter lehet!',
            'email.unique' => 'Ezzel a címmel már regisztráltak!',
            'nickname.required' => 'Becenév kitöltése kötelező!',
            'nickname.string' => 'Becenév formátumának szövegesnek kell lennie!',
            'nickname.max' => 'Becenév max 255 karakter lehet!',
            'birthdate.required' => 'Születési dátum megadása kötelező',
            'birthdate.date' => 'Nem megfelelő dátumforma',
            'password.required' => 'Jelszó megadása kötelező!',
            'password.string' => 'Jelszónak nem szöveges a formátuma!',
            'password.min' => 'Jelszó legalább 8 karakter legyen!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $user = User::create([
            'email' => $validated['email'],
            'nickname' => $validated['nickname'],
            'birthdate' => $validated['birthdate'],
            'password' => $validated['password'],
        ]);

        $userData = [
            'id' => $user->id,
            'email' => $user->email,
            'nickname' => $user->nickname,
            'birthdate' => $user->birthdate,
            'password' => $user->password,
        ];
        $users[] = $userData;

        $jsonData = json_encode($userData);
        Storage::put('users.json', json_encode($users, JSON_PRETTY_PRINT));

        return view('auth.register', ['success' => 'Sikeres regisztráció!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
