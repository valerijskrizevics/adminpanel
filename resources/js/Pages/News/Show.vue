<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Layout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  post: Object,
});
</script>

<template>
  <Layout title="View Blog Post">
    <div class="bg-white min-h-screen">
      <div class="container mx-auto p-6 max-w-2xl">
        <div class="bg-white p-6">
          <!-- Breadcrumbs component -->
          <Breadcrumbs :items="[
            { label: 'Blog', link: route('blog.index') },
            { label: 'View Post', link: '#' }
          ]" />
            
          <img :src="'/photos/' + (post.id % 10) + '.jpg'" class="rounded-md w-full h-60 object-cover">
          <h1 class="text-3xl font-bold mt-4">{{ post.title }}</h1>
          <p class="text-sm text-gray-500 mt-2">
            <strong>{{ post.user.name }}</strong> • {{ new Date(post.created_at).toLocaleDateString('ru-RU') }}
          </p>
        
          <p class="mt-4 text-gray-700 italic">{{ post.short_description }}</p>

          <p v-html="post.text.replace(/\n+/g, '<br>')" class="mt-4 text-gray-700"></p>
        
          <div class="flex justify-start mt-4 sm-ml-6">
            <Link :href="route('blog.index')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
              Back
            </Link>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
