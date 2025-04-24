<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-100 to-indigo-100 px-4">
    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md animate-fade-in">
      <h2 class="text-4xl font-extrabold text-indigo-800 text-center mb-8">Вход</h2>

      <form @submit.prevent="handleLogin" class="space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="form.email" type="email" class="w-full px-4 py-3 rounded-lg shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Введите email" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Пароль</label>
          <input v-model="form.password" type="password" class="w-full px-4 py-3 rounded-lg shadow-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200" placeholder="Введите пароль" />
        </div>

        <button type="submit" class="w-full py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">Войти</button>
      </form>

      <p class="mt-4 text-center text-sm text-gray-600">
        Нет аккаунта? 
        <a @click.prevent="$router.push('/register')" class="text-indigo-600 hover:underline cursor-pointer">Зарегистрироваться</a>
      </p>
    </div>
  </div>
</template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from '@/axios'
  import { useRouter } from 'vue-router'
  
  const router = useRouter()
  
  const form = ref({
    email: '',
    password: ''
  })
  
  const handleLogin = async () => {
    try {
      const response = await axios.post('/api/login', form.value)
      localStorage.setItem('token', response.data.token)
      alert('Вход выполнен успешно!')
      router.push('/dashboard')
    } catch (error) {
      console.error(error)
      alert('Ошибка входа. Проверьте email и пароль.')
    }
  }
  </script>
  