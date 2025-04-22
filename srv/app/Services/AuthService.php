<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return response()->json(['message' => 'Регистрация успешна', 'user' => $user]);
    }

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Неверные данные'], 401);
        }

        return response()->json(['message' => 'Успешный вход', 'user' => Auth::user()]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Выход выполнен']);
    }
}
