<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({ 
  posts: Object,
  isGuest: Boolean,
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <div class="container mx-auto p-6">
    
    <!-- Header with login and registration links -->
    <div class="flex justify-end mb-6">
      <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
        <Link
          v-if="!isGuest"
          :href="route('dashboard')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
          Admin Panel
        </Link>

        <template v-else>
          <Link
            :href="route('login')"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
          >
            Log in
          </Link>

          <Link
            v-if="canRegister"
            :href="route('register')"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
          >
            Register
          </Link>
        </template>
      </nav>
    </div>

    <h1 class="text-3xl font-bold mb-6">From the blogs</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      
        <div v-for="post in posts.data" :key="post.id" class="bg-white rounded-lg shadow-lg p-4">
        
          <Link :href="route('landing.blog.show', post.id)">
          
            <img :src="'/photos/' + (post.id % 10) + '.jpg'" class="rounded-md w-full h-40 object-cover">
            
            <h2 class="mt-3 text-lg font-semibold">{{ post.title }}</h2>
            
            <p class="text-sm text-gray-500">
              <strong>{{ post.user.name }}</strong> • {{ new Date(post.created_at).toLocaleDateString('ru-RU') }}
            </p>
            
            <p class="mt-2 text-gray-700">{{ post.short_description }}</p>
            
          </Link>
        
        </div>

    </div>
  </div>
</template>