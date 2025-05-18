<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class TransactionService
{
    /**
     * Получить все транзакции пользователя
     */
    public function getByUser(User $user): Collection
    {
        return $user->transactions()->latest()->get();
    }

    /**
     * Создать новую транзакцию и обновить баланс пользователя
     */
    public function store(User $user, array $data): Transaction
    {
        return DB::transaction(function () use ($user, $data) {
            $transaction = $user->transactions()->create($data);

            $amount = $transaction->type === 'income'
                ? $transaction->amount
                : -$transaction->amount;

            $user->update([
                'balance' => $user->balance + $amount,
            ]);

            return $transaction;
        });
    }

    /**
     * Удалить транзакцию и пересчитать баланс
     */
    public function delete(string $id, User $user): void
    {
        $transaction = $user->transactions()->findOrFail($id);

        DB::transaction(function () use ($user, $transaction) {
            $amount = $transaction->type === 'income'
                ? -$transaction->amount
                : $transaction->amount;

            $transaction->delete();

            $user->update([
                'balance' => $user->balance + $amount,
            ]);
        });
    }

    /**
     * Получить одну транзакцию
     */
    public function findById(string $id, User $user): Transaction
    {
        $transaction = $user->transactions()->find($id);

        if (!$transaction) {
            throw new ModelNotFoundException('Транзакция не найдена');
        }

        return $transaction;
    }

    /**
     * Сформировать резюме финансов
     */
    public function getSummary(User $user): array
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        $transactions = $user->transactions;

        $todayExpenses = $transactions->where('type', 'expense')
                                      ->where('created_at', '>=', $today)
                                      ->sum('amount');

        $monthExpenses = $transactions->where('type', 'expense')
                                      ->where('created_at', '>=', $startOfMonth)
                                      ->sum('amount');

        $todayIncome = $transactions->where('type', 'income')
                                    ->where('created_at', '>=', $today)
                                    ->sum('amount');

        $monthIncome = $transactions->where('type', 'income')
                                    ->where('created_at', '>=', $startOfMonth)
                                    ->sum('amount');

        $byCategory = $transactions->where('type', 'expense')
            ->groupBy('category')
            ->map(fn ($group) => $group->sum('amount'))
            ->toArray();

        return [
            'today' => [
                'income' => $todayIncome,
                'expense' => $todayExpenses,
            ],
            'month' => [
                'income' => $monthIncome,
                'expense' => $monthExpenses,
            ],
            'by_category' => $byCategory,
        ];
    }
}
