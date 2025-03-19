<script setup>
import { ref, nextTick } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Layout from '@/Layouts/AppLayout.vue';
import Create from '@/Modals/Blog/Create.vue';
import Edit from '@/Modals/Blog/Edit.vue';

const props = defineProps({
  blogPosts: Array,
  users: Array,
  flash: Object,
});

const showCreateModal = ref(false);
const showEditModal = ref(false);
const selectedBlogPost = ref(null);

const openEditModal = async (blogPost) => {
  selectedBlogPost.value = blogPost;
  await nextTick(); // Ensures Vue processes the change before opening the modal
  showEditModal.value = true;
};

const deletePost = (id) => {
  if (confirm("Are you sure you want to delete this post?")) {
    router.delete(route('blog.destroy', id))
  }
}
</script>

<template>
  <Layout title="Manage Blog Posts">
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
      <h1 class="text-2xl font-semibold">Blog Posts</h1>

      <div v-if="flash?.success" class="bg-green-500 text-white p-4 mb-4 rounded">
        {{ flash.success }}
      </div>

      <div class="mb-4">
        <button @click="showCreateModal = true" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Create Blog Post
        </button>
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
            <td class="text-left align-top px-4 py-2">
              <Link :href="`/blog/${blogPost.id}`" class="text-blue-600">
                {{ blogPost.title }}
              </Link>
            </td>
            <td class="text-left align-top px-4 py-2">{{ blogPost.short_description }}</td>
            <td class="text-left align-top px-4 py-2 whitespace-nowrap">{{ blogPost.user.name }}</td>
            <td class="text-left align-top px-4 py-2 whitespace-nowrap">
              <button @click="openEditModal(blogPost)" class="text-blue-600">Edit</button>
              |
              <button @click.prevent="deletePost(blogPost.id)" class="text-red-600">X</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Create :show="showCreateModal" :users="users" @close="showCreateModal = false" />
    <Edit v-if="selectedBlogPost" :show="showEditModal" :blogPost="selectedBlogPost" :users="users" @close="showEditModal = false" />
  </Layout>
</template>
