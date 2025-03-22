<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Layout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  blogPost: Object,
});
</script>

<template>
  <Layout title="View Blog Post">
    <div class="bg-white min-h-screen">
      <div class="max-w-3xl mx-auto p-6 bg-white">

        <!-- Breadcrumbs component -->
        <Breadcrumbs :items="[
          { label: 'Blog', link: route('blog.index') },
          { label: 'View Post', link: '#' }
        ]" />

        <h1 class="text-2xl font-semibold mb-4 sm-ml-6">{{ blogPost.title }}</h1>
        
        <p class="text-gray-500 sm-ml-6">By {{ blogPost.user?.name }} on {{ blogPost.created_at.split('T')[0] }}</p>
      
        <div class="mb-4 sm-ml-6">
          <p><em>{{ blogPost.short_description }}</em></p>
        </div>

        <div class="mb-4 sm-ml-6">
          <p v-html="blogPost.text.replace(/\n+/g, '<br>')"></p>
        </div>

        <div class="flex justify-start mt-4 sm-ml-6">
          <Link :href="route('blog.index')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Back
          </Link>
        </div>
      </div>
    </div>
  </Layout>
</template>
