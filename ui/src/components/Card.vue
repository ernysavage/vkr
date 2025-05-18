<template>
    <div :class="[
        'bg-white rounded-3xl p-6 shadow-xl border-t-8 transition cursor-pointer',
        `border-${color}-400`,
        'hover:shadow-2xl hover:-translate-y-1'
      ]"
    >
      <h2 :class="['text-2xl font-bold mb-3', `text-${color}-600`]">{{ title }}</h2>
      <slot name="content" />
    </div>
  </template>
  
  <script setup>
  defineProps({
    title: String,
    color: String
  })
  </script>
  