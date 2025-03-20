<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  blogPost: Object,
});
</script>

<template>
  <Layout title="View Blog Post">
    <div class="p-6">
      <div class="mb-4">
        <h1 class="text-2xl font-semibold">{{ blogPost.title }}</h1>
        <p class="text-gray-500">By {{ blogPost.user?.name }} on {{ blogPost.created_at.split('T')[0] }}</p>
      </div>

      <div class="mb-4">
        <p><em>{{ blogPost.short_description }}</em></p>
      </div>

      <div class="mb-4">
        <p>{{ blogPost.text }}</p>
      </div>

      <div class="flex justify-end mt-4">
        <Link :href="route('blog.index')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
          Back to Blog Posts
        </Link>
      </div>
    </div>
  </Layout>
</template>
