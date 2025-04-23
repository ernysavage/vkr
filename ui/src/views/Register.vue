<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-50 to-blue-100 px-4">
    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md animate-fade-in">
      <h2 class="text-4xl font-extrabold text-blue-800 text-center mb-8">Регистрация</h2>

      <form @submit.prevent="handleRegister" class="space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-700">Имя</label>
          <input v-model="form.name" type="text" class="w-full px-4 py-3 rounded-lg shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" placeholder="Введите имя" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="form.email" type="email" class="w-full px-4 py-3 rounded-lg shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" placeholder="Введите email" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Пароль</label>
          <input v-model="form.password" type="password" class="w-full px-4 py-3 rounded-lg shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" placeholder="Введите пароль" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Повторите пароль</label>
          <input v-model="form.password_confirmation" type="password" class="w-full px-4 py-3 rounded-lg shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" placeholder="Повторите пароль" />
        </div>

        <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500">Зарегистрироваться</button>
      </form>

      <p class="mt-4 text-center text-sm text-gray-600">
        Уже есть аккаунт? 
        <a @click.prevent="$router.push('/login')" class="text-blue-600 hover:underline cursor-pointer">Войти</a>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from '@/axios'

const router = useRouter()
const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const handleRegister = async () => {
  try {
    await axios.post('/api/register', form.value)
    alert('Регистрация прошла успешно ✅')
    router.push('/login')
  } catch (error) {
    alert('Ошибка регистрации ❌')
    console.error(error.response?.data)
  }
}
</script>

<style>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.5s ease-in-out;
}
</style>
