<template>
    <div class="max-w-md mx-auto mt-12">
        <h2 class="text-2xl font-bold text-center mb-4">Регистрация</h2>
        <form @submit.prevent="handleRegister" class="space-y-4">
            <input v-model="form.name" placeholder="Имя" class="w-full border px-3 py-2" />
            <input v-model="form.email" placeholder="Email" class="w-full border px-3 py-2" />
            <input v-model="form.password" type="password" placeholder="Пароль" class="w-full border px-3 py-2" />
            <input v-model="form.password_confirmation" type="password" placeholder="Подтвердите пароль"
                class="w-full border px-3 py-2" />
            <button type="submit" class="w-full bg-blue-600 text-white py-2">Зарегистрироваться</button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from '@/axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const handleRegister = async () => {
    try {
        await axios.get('/sanctum/csrf-cookie') // нужно для Sanctum
        await axios.post('/register', form.value)
        alert('Успешная регистрация')
        router.push('/dashboard')
    } catch (err) {
        console.error('Ошибка при регистрации:', err)
        alert('Ошибка регистрации')
    }
}
</script>