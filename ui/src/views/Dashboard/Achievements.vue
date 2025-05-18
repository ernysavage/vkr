<template>
  <div class="min-h-screen bg-white py-12 px-6">
    <h1 class="text-3xl font-bold text-indigo-800 mb-10">🏆 Ваши достижения</h1>

    <!-- Показываем сообщение, если список пуст -->
    <div v-if="achievements.length === 0" class="text-gray-500">
      Достижения пока не загружены.
    </div>

    <!-- Все достижения -->
    <div v-else>
      <h2 class="text-xl font-semibold text-indigo-800 mb-4">🎯 Все достижения</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
        <div
          v-for="a in achievements"
          :key="a.id"
          class="p-5 bg-white rounded-xl shadow border-l-4 relative transition"
          :class="a.received ? 'border-green-500' : 'border-gray-300 opacity-50'"
        >
          <div class="text-4xl mb-2">{{ a.icon }}</div>
          <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ a.title }}</h2>
          <p class="text-sm text-gray-600">{{ a.description }}</p>

          <p v-if="a.received" class="text-green-500 font-medium text-sm mt-2">
            ✅ Получено
          </p>
          <p v-else class="text-gray-500 italic text-sm mt-2">
            🔒 Подсказка: {{ a.hint }}
          </p>

          <p v-if="a.progress" class="text-indigo-500 text-sm mt-1">
            📈 Прогресс: {{ a.progress.text }}
          </p>

          <p v-if="a.unlocked_at" class="text-xs text-gray-400 mt-1">
            🕒 Получено: {{ formatDate(a.unlocked_at) }}
          </p>
        </div>
      </div>

      <!-- Полученные достижения -->
      <h2 class="text-xl font-semibold text-green-700 mb-4">✅ Полученные</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div
          v-for="a in achievements.filter(a => a.received)"
          :key="a.id"
          class="p-5 bg-green-50 rounded-xl shadow border-l-4 border-green-500"
        >
          <div class="text-4xl mb-2">{{ a.icon }}</div>
          <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ a.title }}</h2>
          <p class="text-sm text-gray-600">{{ a.description }}</p>
          <p class="text-green-500 font-medium text-sm mt-2">✅ Получено</p>
          <p v-if="a.unlocked_at" class="text-xs text-gray-400 mt-1">
            🕒 Получено: {{ formatDate(a.unlocked_at) }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from '@/axios' // обязательно: путь к axios.js

const achievements = ref([])

onMounted(async () => {
  try {
    console.log('🎯 Выполняется запрос на /api/achievements')
    const response = await axios.get('/achievements')
    achievements.value = response.data
    console.log('✅ Получены достижения:', achievements.value)
  } catch (error) {
    console.error('❌ Ошибка при загрузке достижений:', error)
  }
})

function formatDate(dateString) {
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString('ru-RU', options)
}
</script>
