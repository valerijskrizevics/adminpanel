<script setup>
import { defineProps } from 'vue';
import Layout from '@/Layouts/LandingLayout.vue';

defineProps({ 
  post: Object,
  isGuest: Boolean,
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <Layout :title="post.title + ' - News'" :isGuest="isGuest" :canLogin="canLogin" :canRegister="canRegister">
    <div class="bg-white min-h-screen">
      <div class="container mx-auto p-6 max-w-2xl">
        
        <div class="bg-white p-6 mt-4">
          <img :src="'/photos/' + (post.id % 10) + '.jpg'" class="rounded-md w-full h-60 object-cover">
          <h1 class="text-3xl font-bold mt-4">{{ post.title }}</h1>
          <p class="text-sm text-gray-500 mt-2">
            <strong>{{ post.user.name }}</strong> • {{ new Date(post.created_at).toLocaleDateString('ru-RU') }}
          </p>
        
          <p class="mt-4 text-gray-700 italic">{{ post.short_description }}</p>

          <p v-html="post.text.replace(/\n+/g, '<br>')" class="mt-4 text-gray-700"></p>
        
        </div>
      </div>
    </div>
  </Layout>
</template>