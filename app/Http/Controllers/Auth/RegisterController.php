<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\JsonUserService;

class RegisterController extends Controller
{
    protected $jsonUserService;

    public function __construct(JsonUserService $jsonUserService)
    {
        $this->jsonUserService = $jsonUserService;
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

        $users = $this->jsonUserService->getUsersFromJson();

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
            'birthdate' => Carbon::parse($validated['birthdate'])->format('Y-m-d'),
            'password' => $validated['password'],
        ]);

        $this->jsonUserService->saveUserToJson($user, $users);

        return view('auth.register', ['success' => 'Sikeres regisztráció!']);
    }
}
