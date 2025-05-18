<template>
  <div class="min-h-screen bg-gradient-to-tr from-indigo-100 via-sky-100 to-pink-100 py-12 px-6 font-sans">
    <div class="max-w-6xl mx-auto">
      <h1 class="text-5xl font-bold text-center text-indigo-800 mb-12 animate-fade-in-up">
        Личный Кабинет
      </h1>

      <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Карточки -->
        <Card title="💰 Баланс и Уровень" color="blue">
          <template #content>
            <p class="text-gray-700 mb-1"><strong>Баланс:</strong> 3 250 ₽</p>
            <p class="text-gray-700 mb-2"><strong>Уровень:</strong> Новичок</p>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-blue-500 h-2.5 rounded-full w-[40%]"></div>
            </div>
          </template>
        </Card>

        <Card title="📊 Учёт финансов" color="green">
          <template #content>
            <p class="text-sm text-gray-600 mb-3">Контролируйте расходы и доходы.</p>
            <button @click="$router.push('/dashboard/transactions')" class="text-sm bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
              Перейти к учету
            </button>
          </template>
        </Card>

        <Card title="🏆 Достижения" color="purple">
          <template #content>
            <p class="text-sm text-gray-600 mb-3">Ваши награды за активность.</p>
            <button @click="$router.push('/dashboard/achievements')" class="text-sm bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600">
              Смотреть все
            </button>
          </template>
        </Card>

        <Card title="🎯 Квесты" color="yellow">
          <template #content>
            <p class="text-sm text-gray-600 mb-3">Завершайте задания и получайте бонусы.</p>
            <button @click="$router.push('/dashboard/quests')" class="text-sm bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
              Все квесты
            </button>
          </template>
        </Card>

        <Card title="📚 Обучение" color="rose">
          <template #content>
            <p class="text-sm text-gray-600 mb-3">Изучайте финансовую грамотность.</p>
            <button @click="$router.push('/dashboard/education')" class="text-sm bg-rose-500 text-white px-3 py-1 rounded hover:bg-rose-600">
              Продолжить обучение
            </button>
          </template>
        </Card>
      </div>
    </div>
  </div>
</template>

<script setup>
import Card from '@/components/Card.vue'
</script>
