<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthService
{
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }

    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверные данные'],
            ]);
        }

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
