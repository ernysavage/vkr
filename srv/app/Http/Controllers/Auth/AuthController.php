<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use srv\App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        return $this->authService->register($request->validated());
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->validated());
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
}
