<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $service
    ) {}

    /**
     * Получить все транзакции пользователя
     */
    public function index(Request $request): JsonResponse
    {
        $transactions = $this->service->getByUser($request->user());
        return response()->json($transactions);
    }

    /**
     * Сохранить новую транзакцию
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $transaction = $this->service->store($request->user(), $request->validated());
        return response()->json($transaction, 201);
    }

    /**
     * Удалить транзакцию
     */
    public function destroy(string $id, Request $request): JsonResponse
    {
        $this->service->delete($id, $request->user());
        return response()->json(['message' => 'Удалено']);
    }

    /**
     * Получить финансовое резюме
     */
    public function summary(Request $request): JsonResponse
    {
        $summary = $this->service->getSummary($request->user());
        return response()->json($summary);
    }
}
