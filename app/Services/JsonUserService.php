<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;

class JsonUserService
{
    public function saveUserToJson(User $user, array $users): void
    {
        $userData = [
            'id' => $user->id,
            'email' => $user->email,
            'nickname' => $user->nickname,
            'birthdate' => Carbon::parse($user->birthdate)->format('Y-m-d'),
            'password' => $user->password,
        ];

        $users[] = $userData;

        // JSON fájl frissítése
        Storage::put('users.json', json_encode($users, JSON_PRETTY_PRINT));
    }

    public function getUsersFromJson(): array
    {
        if (Storage::exists('users.json')) {
            $jsonData = Storage::get('users.json');

            if (!empty($jsonData)) {
                $users = json_decode($jsonData, true);

                if (is_array($users)) {
                    return $users;
                }
            }
        }

        return [];
    }

    public function readFromJson(int $userId): ?User
    {
        $users = $this->getUsersFromJson();

        foreach ($users as $jsonUser) {
            if ($jsonUser['id'] == $userId) {
                return (new User())->forceFill($jsonUser);
            }
        }

        return null;
    }

    public function updateJson(User $user): void
    {
        $users = $this->getUsersFromJson();

        foreach ($users as $index => $jsonUser) {
            if ($jsonUser['id'] == $user->id) {
                $users[$index]['nickname'] = $user->nickname;
                $users[$index]['email'] = $user->email;
                $users[$index]['birthdate'] = Carbon::parse($user->birthdate)->format('Y-m-d');
                $users[$index]['password'] = $user->password;
                break;
            }
        }

        // JSON fájl frissítése
        Storage::put('users.json', json_encode($users, JSON_PRETTY_PRINT));
    }
}
