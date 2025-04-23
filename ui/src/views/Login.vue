<template>
    <div class="max-w-md mx-auto mt-12 p-6 bg-white shadow rounded">
      <h2 class="text-2xl font-bold text-center mb-4">Вход</h2>
      <form @submit.prevent="handleLogin" class="space-y-4">
        <div>
          <label class="block mb-1">Email</label>
          <input
            v-model="form.email"
            type="email"
            class="w-full border px-3 py-2 rounded"
            placeholder="Введите email"
          />
        </div>
  
        <div>
          <label class="block mb-1">Пароль</label>
          <input
            v-model="form.password"
            type="password"
            class="w-full border px-3 py-2 rounded"
            placeholder="Введите пароль"
          />
        </div>
  
        <button
          type="submit"
          class="w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-900"
        >
          Войти
        </button>
      </form>
      <p class="text-sm text-center mt-4">
        Нет аккаунта?
        <router-link to="/register" class="text-blue-600 hover:underline">
          Зарегистрироваться
        </router-link>
      </p>
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
  