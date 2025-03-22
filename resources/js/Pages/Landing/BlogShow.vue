<script setup>
import { defineProps } from 'vue';
import Layout from '@/Layouts/LandingLayout.vue';

defineProps({ 
  blogPost: Object 
});
</script>

<template>
  <Layout :title="blogPost.title + ' - Blog'">
    <div class="bg-white min-h-screen">
      <div class="container mx-auto p-6 max-w-2xl">
        
        <div class="bg-white p-6 mt-4">
          <img :src="'/photos/' + (blogPost.id % 10) + '.jpg'" class="rounded-md w-full h-60 object-cover">
          <h1 class="text-3xl font-bold mt-4">{{ blogPost.title }}</h1>
          <p class="text-sm text-gray-500 mt-2">
            <strong>{{ blogPost.user.name }}</strong> • {{ new Date(blogPost.created_at).toLocaleDateString('ru-RU') }}
          </p>
        
          <p class="mt-4 text-gray-700 italic">{{ blogPost.short_description }}</p>

          <p v-html="blogPost.text.replace(/\n+/g, '<br>')" class="mt-4 text-gray-700"></p>
        
        </div>
      </div>
    </div>
  </Layout>
</template>