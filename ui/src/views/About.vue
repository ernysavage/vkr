<template>
    <div class="min-h-screen bg-white text-gray-800 relative">
      <!-- Кнопка Назад -->
      <button
  @click="$router.push('/dashboard')"
  class="absolute top-6 left-6 bg-indigo-50 text-indigo-700 px-4 py-2 rounded shadow hover:bg-indigo-100 transition-all duration-300"
>
  ← Назад
</button>

  
      <!-- Контент -->
      <div class="max-w-4xl mx-auto py-12 px-6 animate-fade-in-up">
        <h1 class="text-4xl font-bold text-indigo-800 mb-6">О проекте «Дофин»</h1>
  
        <p class="text-lg text-gray-700 leading-relaxed mb-4">
          <strong>«Дофин»</strong> — это современное веб-приложение для людей, которые хотят научиться управлять своими финансами, сформировать полезные привычки и начать путь к финансовой независимости. Мы соединили полезное с увлекательным: здесь финансы становятся игрой, а прогресс — наградой.
        </p>
  
        <h2 class="text-2xl font-semibold text-indigo-700 mt-6 mb-2">Цель проекта</h2>
        <p class="text-base text-gray-700 leading-relaxed mb-4">
          Помочь пользователям контролировать доходы и расходы, развивать финансовую дисциплину и делать это легко, интересно и ненавязчиво. Мы ориентируемся как на подростков и студентов, так и на взрослых, у которых ещё нет твёрдой финансовой системы.
        </p>
  
        <h2 class="text-2xl font-semibold text-indigo-700 mt-6 mb-2">Что вы можете делать в «Дофин»</h2>
        <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base">
          <li><strong>Вести учёт расходов и доходов</strong> — с простой и быстрой системой ввода данных</li>
          <li><strong>Получать достижения</strong> — за регулярность, цели, экономию и другие действия</li>
          <li><strong>Проходить квесты</strong> — мотивационные мини-задачи, которые делают учёт интересным</li>
          <li><strong>Изучать модули обучения</strong> — короткие и доступные тексты по финансовой грамотности</li>
          <li><strong>Визуализировать финансы</strong> — графики и резюме по тратам за день, месяц, категории</li>
        </ul>
  
        <h2 class="text-2xl font-semibold text-indigo-700 mt-6 mb-2">Особенности</h2>
        <ul class="list-disc pl-6 space-y-2 text-gray-700 text-base">
          <li>Простой интерфейс — всё ясно и без перегрузки</li>
          <li>Геймификация — финансы, но в стиле достижений и наград</li>
          <li>Мотивация через визуальный прогресс</li>
          <li>Без рекламы и лишних функций</li>
        </ul>
  
        <h2 class="text-2xl font-semibold text-indigo-700 mt-6 mb-2">Почему «Дофин»?</h2>
        <p class="text-base text-gray-700 leading-relaxed">
          Название «Дофин» — это сочетание слов <strong>«дофамин»</strong> и <strong>«финансы»</strong>. Мы хотим, чтобы вы испытывали удовольствие от прогресса, даже в сфере учёта трат. Финансовая грамотность — это не скучно, если подойти к ней с правильным подходом.
        </p>
  
        <p class="text-sm text-gray-500 mt-10">
          Спасибо, что выбрали наш сервис. Вперёд — к финансовой осознанности и свободе 💪
        </p>
      </div>
    </div>
  </template>
  
  <script setup>
  </script>
  