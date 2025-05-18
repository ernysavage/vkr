<template>
    <header
      class="sticky top-0 z-50 bg-gradient-to-r from-indigo-100 via-white to-sky-100 shadow-md px-6 h-[160px] flex items-center justify-between animate-fade-in-down transition-all duration-500"
    >
      <!-- Логотип -->
      <img
        src="@/assets/logo.png"
        alt="Дофин"
        class="h-[150px] w-auto object-contain cursor-pointer hover:scale-105 transition-transform duration-300"
        @click="$router.push('/dashboard')"
      />
  
      <!-- Кнопка "О нас" -->
      <button
        @click="$router.push('/about')"
        class="text-indigo-700 font-semibold text-lg hover:text-indigo-900 hover:underline transition-all duration-300"
      >
        О нас
      </button>
    </header>
  </template>
  
  <script setup>
  </script>
  