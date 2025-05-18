<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('achievements')->insert([
            [
                'title' => 'Первый шаг',
                'description' => 'Совершите первую запись',
                'icon' => '🥇',
            ],
            [

                'title' => '7 дней подряд',
                'description' => 'Ведите учёт 7 дней без перерыва',
                'icon' => '🔥',
            ],
            [
                'title' => 'Финансовая дисциплина',
                'description' => 'Не тратить больше, чем заработал за 7 дней',
                'icon' => '⚖️',
            ],
            [
                'title' => 'Первая цель',
                'description' => 'Завершите первый квест',
                'icon' => '🎯',
            ],
            [
                'title' => '10 000 ₽ накоплено',
                'description' => 'Совокупно накопите 10 000 ₽',
                'icon' => '💰',
            ],
            [
                'title' => 'Пройдено 5 уроков',
                'description' => 'Пройдите минимум 5 обучающих модулей',
                'icon' => '📚',
            ],
        ]);
    }
}