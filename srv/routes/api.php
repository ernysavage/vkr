<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\QuestController;
use App\Http\Controllers\Admin\AdminQuestController;

// Аутентификация
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Приватные маршруты
Route::middleware('auth:api')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Транзакции
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
    Route::get('/transactions/summary', [TransactionController::class, 'summary']);

    // Достижения
     Route::get('/achievements', [AchievementsController::class, 'index']);
    

    // Квесты (текущие пользователя)
    Route::get('/quests', [QuestController::class, 'index']);

    // Админка
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::apiResource('quests', AdminQuestController::class);
        // при необходимости: Route::apiResource('achievements', AdminAchievementController::class);
    });
});
