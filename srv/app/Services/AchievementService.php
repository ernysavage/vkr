<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;
use Carbon\Carbon;

class AchievementService
{
    public function checkAndGrant(User $user): void
    {
        $this->grantIf($user, 'Первый шаг', fn() => $user->transactions()->exists());

        $this->grantIf($user, '7 дней подряд', function () use ($user) {
            $dates = $user->transactions()->selectRaw('DATE(created_at) as day')->groupBy('day')->pluck('day')->toArray();
            return $this->hasConsecutiveDays($dates, 7);
        });

        $this->grantIf($user, 'Финансовая дисциплина', function () use ($user) {
            $weekAgo = now()->subDays(7);
            $income = $user->transactions()->where('type', 'income')->where('created_at', '>=', $weekAgo)->sum('amount');
            $expense = $user->transactions()->where('type', 'expense')->where('created_at', '>=', $weekAgo)->sum('amount');
            return $expense <= $income;
        });

        $this->grantIf($user, 'Первая цель', fn() => $user->userQuests()->where('is_completed', true)->exists());

        $this->grantIf($user, '10 000 ₽ накоплено', fn() => $user->transactions()->where('type', 'income')->sum('amount') >= 10000);

        $this->grantIf($user, 'Пройдено 5 уроков', fn() => $user->userLessons()->where('is_completed', true)->count() >= 5);
    }

    protected function grantIf(User $user, string $title, \Closure $condition): void
    {
        $achievement = Achievement::where('title', $title)->first();
        if (!$achievement) return;

        $alreadyHas = $user->achievements()->where('achievement_id', $achievement->id)->exists();

        if (!$alreadyHas && $condition()) {
            $user->achievements()->attach($achievement->id, ['unlocked_at' => now()]);
        }
    }

    protected function hasConsecutiveDays(array $dates, int $days): bool
    {
        return $this->countConsecutiveDays($dates) >= $days;
    }

    protected function countConsecutiveDays(array $dates): int
    {
        $dateSet = collect($dates)->map(fn($d) => Carbon::parse($d)->startOfDay())->unique();
        $sorted = $dateSet->sort()->values();

        $maxStreak = $streak = 1;
        for ($i = 1; $i < $sorted->count(); $i++) {
            if ($sorted[$i]->diffInDays($sorted[$i - 1]) === 1) {
                $streak++;
                $maxStreak = max($maxStreak, $streak);
            } else {
                $streak = 1;
            }
        }

        return $sorted->isEmpty() ? 0 : $maxStreak;
    }

    public function getAchievementsForUser(User $user): array
    {
        $receivedIds = $user->achievements()->pluck('id')->toArray();

        return Achievement::all()->map(function ($a) use ($receivedIds, $user) {
            $received = in_array($a->id, $receivedIds);

            return [
                'id' => $a->id,
                'title' => $a->title,
                'description' => $a->description,
                'icon' => $a->icon,
                'received' => $received,
                'hint' => $received ? null : $this->getHint($a->title),
                'progress' => $received ? null : $this->getProgress($user, $a->title),
                'unlocked_at' => $received
                    ? optional($user->achievements->firstWhere('id', $a->id))->pivot->unlocked_at
                    : null,
            ];
        })->toArray();
    }

    protected function getHint(string $title): string
    {
        return match ($title) {
            'Первый шаг' => 'Сделайте первую запись дохода или расхода',
            '7 дней подряд' => 'Ведите учёт каждый день в течение недели',
            'Финансовая дисциплина' => 'Не тратьте больше, чем зарабатываете за 7 дней',
            'Первая цель' => 'Завершите хотя бы один квест',
            '10 000 ₽ накоплено' => 'Накопите в сумме 10 000 ₽',
            'Пройдено 5 уроков' => 'Пройдите 5 обучающих модулей',
            default => 'Выполните условия для получения достижения',
        };
    }

    protected function getProgress(User $user, string $title): ?array
    {
        return match ($title) {
            '7 дней подряд' => $this->progressConsecutiveDays($user, 7),
            'Финансовая дисциплина' => $this->progressDiscipline($user),
            '10 000 ₽ накоплено' => $this->progressSavedAmount($user, 10000),
            'Пройдено 5 уроков' => $this->progressLessons($user, 5),
            default => null,
        };
    }

    protected function progressConsecutiveDays(User $user, int $target): array
    {
        $dates = $user->transactions()->selectRaw('DATE(created_at) as day')->groupBy('day')->pluck('day')->toArray();
        $days = $this->countConsecutiveDays($dates);

        return [
            'current' => $days,
            'total' => $target,
            'text' => "$days из $target дней подряд"
        ];
    }

    protected function progressSavedAmount(User $user, int $target): array
    {
        $amount = (int) $user->transactions()->where('type', 'income')->sum('amount');

        return [
            'current' => $amount,
            'total' => $target,
            'text' => number_format($amount, 0, ',', ' ') . " ₽ из " . number_format($target, 0, ',', ' ') . " ₽"
        ];
    }

    protected function progressLessons(User $user, int $target): array
    {
        $count = $user->userLessons()->where('is_completed', true)->count();

        return [
            'current' => $count,
            'total' => $target,
            'text' => "$count из $target уроков"
        ];
    }

    protected function progressDiscipline(User $user): array
    {
        $weekAgo = now()->subDays(7);
        $income = $user->transactions()->where('type', 'income')->where('created_at', '>=', $weekAgo)->sum('amount');
        $expense = $user->transactions()->where('type', 'expense')->where('created_at', '>=', $weekAgo)->sum('amount');

        return [
            'current' => $expense,
            'total' => $income,
            'text' => "Расходы $expense ₽ из доходов $income ₽"
        ];
    }
}
