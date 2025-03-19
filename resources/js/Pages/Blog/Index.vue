<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  blogPosts: Array,
  flash: Object,
});

// Destructure props for easy access
const { blogPosts, flash } = props;
</script>

<template>
  <Layout title="Manage Blog Posts">
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
      <h1 class="text-2xl font-semibold">Blog Posts</h1>
  
      <!-- Flash messages -->
      <div v-if="flash?.success" class="bg-green-500 text-white p-4 mb-4 rounded">
          {{ flash.success }}
      </div>
      <div v-if="flash?.error" class="bg-red-500 text-white p-4 mb-4 rounded">
          {{ flash.error }}
      </div>
  
      <div class="mb-4">
        <Link :href="route('blog.create')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Create Blog Post
        </Link>
      </div>
  
      <table class="min-w-full bg-white border border-gray-300">
        <thead>
          <tr>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Short Description</th>
            <th class="px-4 py-2">User</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="blogPost in blogPosts" :key="blogPost.id">
            <td class="px-4 py-2">{{ blogPost.title }}</td>
            <td class="px-4 py-2">{{ blogPost.short_description }}</td>
            <td class="px-4 py-2">{{ blogPost.user.name }}</td>
            <td class="px-4 py-2">
              <Link :href="`/blog-posts/${blogPost.id}/edit`" class="text-blue-600">Edit</Link>
              |
              <Link :href="`/blog-posts/${blogPost.id}`" class="text-blue-600">View</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Layout>
</template>
  