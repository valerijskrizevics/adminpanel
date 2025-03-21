<script setup>
import { ref, nextTick } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Layout from '@/Layouts/AppLayout.vue';
import Create from '@/Pages/Blog/Create.vue';
import Edit from '@/Pages/Blog/Edit.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';

const props = defineProps({
  blogPosts: Array,
  canManage: Boolean,
  canManageAny: Boolean,
  currentUser: Object,
  flash: Object,
});

const showCreateModal = ref(false);
const showEditModal = ref(false);
const showConfirmModal = ref(false);
const selectedBlogPost = ref(null);
const blogPostToDelete = ref(null);

const openEditModal = async (blogPost) => {
  selectedBlogPost.value = blogPost;
  await nextTick();
  showEditModal.value = true;
};

const confirmDelete = (blogPost) => {
  blogPostToDelete.value = blogPost;
  showConfirmModal.value = true;
};

const deletePost = () => {
  if (blogPostToDelete.value) {
    router.delete(route('blog.destroy', blogPostToDelete.value.id));
    showConfirmModal.value = false;
  }
};
</script>

<template>
  <Layout title="Manage Blog Posts">
    <div class="bg-white min-h-screen">
      <div class="max-w-3xl mx-auto p-6 bg-white">
        <h1 class="text-2xl font-semibold mb-4 ml-6">Blog Posts</h1>

        <div v-if="flash?.success" class="bg-green-500 text-white p-4 mb-4 rounded ml-6">
          {{ flash.success }}
        </div>

        <div class="mb-4 ml-6">
          <Link v-if="canManage" :href="route('blog.create')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            New
          </Link>
        </div>

        <table class="min-w-full bg-white border border-gray-300 ml-6">
          <thead>
            <tr>
              <th class="text-left px-4 py-2">Title</th>
              <th class="text-left px-4 py-2">Short Description</th>
              <th class="text-left px-4 py-2">User</th>
              <th v-if="canManage" class="text-left px-4 py-2">Actions</th>
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
              <td v-if="canManage && (canManageAny || blogPost.user.id === currentUser.id )" class="text-left align-top px-4 py-2 whitespace-nowrap">
                <Link :href="route('blog.edit', blogPost.id)" class="text-blue-600">Edit</Link>
                |
                <button @click.prevent="confirmDelete(blogPost)" class="text-red-600">X</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <Create :show="showCreateModal" @close="showCreateModal = false" />
    <Edit v-if="selectedBlogPost" :show="showEditModal" :blogPostId="selectedBlogPost.id" @close="showEditModal = false" />

    <ConfirmationModal :show="showConfirmModal" @close="showConfirmModal = false">
      <template #title>
        Delete Blog Post
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
