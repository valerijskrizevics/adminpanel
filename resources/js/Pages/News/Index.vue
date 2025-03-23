<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import Layout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  posts: Array,
  canViewBlog: Boolean,
  canViewNews: Boolean,
  canManage: Boolean,
  canManageAny: Boolean,
  currentUser: Object,
});

const showConfirmModal = ref(false);
const postToDelete = ref(null);

const confirmDelete = (post) => {
  postToDelete.value = post;
  showConfirmModal.value = true;
};

const deletePost = () => {
  if (postToDelete.value) {
    router.delete(route('news.destroy', postToDelete.value.id));
    showConfirmModal.value = false;
  }
};
</script>

<template>
  <Layout title="Manage News Posts" :canViewBlog="canViewBlog" :canViewNews="canViewNews">
    <div class="bg-white min-h-screen">
      <div class="max-w-3xl mx-auto p-6 bg-white">

        <!-- Breadcrumbs component -->
        <Breadcrumbs :items="[
          { label: 'News', link: '#' }
        ]" />

        <h1 class="text-2xl font-semibold mb-4 sm-ml-6">News Posts</h1>

        <div class="mb-4 sm-ml-6">
          <Link v-if="canManage" :href="route('news.create')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            New
          </Link>
        </div>

        <table class="min-w-full bg-white border border-gray-300 sm-ml-6">
          <thead>
            <tr>
              <th class="text-left px-4 py-2">Title</th>
              <th class="text-left px-4 py-2">User</th>
              <th v-if="canManage" class="text-left px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts" :key="post.id">
              <td class="text-left align-top px-4 py-2">
                <Link :href="route('news.show', post.id)" class="text-blue-600">
                  {{ post.title }}
                </Link>
              </td>
              <td class="text-left align-top px-4 py-2 sm-whitespace-nowrap">{{ post.user.name }}</td>
              <td v-if="canManage && (canManageAny || post.user.id === currentUser.id )" class="text-left align-top px-4 py-2 whitespace-nowrap">
                <Link :href="route('news.edit', post.id)" class="text-blue-600">Edit</Link>
                |
                <button @click.prevent="confirmDelete(post)" class="text-red-600">X</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <ConfirmationModal :show="showConfirmModal" @close="showConfirmModal = false">
      <template #title>
        Delete News Post
      </template>

      <template #content>
        Are you sure you want to delete this post?
      </template>

      <template #footer>
        <button @click="showConfirmModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
        <button @click="deletePost" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 ml-3">Delete</button>
      </template>
    </ConfirmationModal>
  </Layout>
</template>
