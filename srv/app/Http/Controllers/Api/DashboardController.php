<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TransactionService;

class DashboardController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService,
    ) {}

    public function index(Request $request)
{
    $user = $request->user();

    return response()->json([
        'user' => [
            'name'    => $user->name,
            'email'   => $user->email,
            'balance' => $user->balance,
            'level'   => $user->level,
        ],
        'summary' => $this->transactionService->getSummary($user),
        'achievements' => $user->achievements()->get(['id', 'title', 'description', 'icon']),
        // позже: 'quests', 'lessons'
    ]);
}
}
