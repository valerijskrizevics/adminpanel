<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/LandingLayout.vue';

defineProps({ 
  posts: Object,
  isGuest: Boolean,
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <Layout :title="News" :isGuest="isGuest" :canLogin="canLogin" :canRegister="canRegister">
    <div class="bg-white min-h-screen">
      <div class="container mx-auto p-6">
    `   <h1 class="text-3xl font-bold mb-6">News</h1>
    
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">  
          <div v-for="post in posts.data" :key="post.id" class="bg-white rounded-lg shadow-lg p-4">        
            <Link :href="route('landing.news.show', post.id)">
              <img :src="'/photos/' + (post.id % 10) + '.jpg'" class="rounded-md w-full h-40 object-cover">
              <h2 class="mt-3 text-lg font-semibold">{{ post.title }}</h2>

              <p class="text-sm text-gray-500">
                <strong>{{ post.user.name }}</strong> • {{ new Date(post.created_at).toLocaleDateString('ru-RU') }}
              </p>
              <p class="mt-2 text-gray-700">{{ post.short_description }}</p>
            </Link>
          </div>
  `     </div>
      </div>
    </div>
  </Layout>
</template>
