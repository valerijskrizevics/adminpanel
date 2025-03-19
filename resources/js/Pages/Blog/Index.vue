<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import Layout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import Create from '@/Modals/Blog/Create.vue';

const props = defineProps({
  blogPosts: Array,
  users: Array, // Include users from Laravel
  flash: Object,
});

// Modal state
const showCreateModal = ref(false);
const showEditModal = ref(false);
const selectedPost = ref(null);

// Create form
const createForm = useForm({
  title: '',
  short_description: '',
  text: '',
  user_id: '',
});

// Edit form
const editForm = useForm({
  id: '',
  title: '',
  short_description: '',
  text: '',
  user_id: '',
});

// Open Create Blog Post Modal
const openCreateModal = () => {
  createForm.reset();
  showCreateModal.value = true;
};

// Open Edit Blog Post Modal
const openEditModal = (post) => {
  selectedPost.value = post;
  editForm.id = post.id;
  editForm.title = post.title;
  editForm.short_description = post.short_description;
  editForm.text = post.text || ''; // Ensure text is not null
  editForm.user_id = post.user.id;
  showEditModal.value = true;
};

// Handle Create Submission
const submitCreate = () => {
  createForm.post(route('blog.store'), {
    onSuccess: () => {
      showCreateModal.value = false; // Close modal on success
    },
    errorBag; 'createBlogPost',
  });
};

// Handle Edit Submission
const submitEdit = () => {
  editForm.put(route('blog.update', editForm.id), {
    onSuccess: () => {
      showEditModal.value = false; // Close modal on success
    },
    errorBag; 'editBlogPost',
  });
};
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
        <button @click="openCreateModal" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
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
            <td class="px-4 py-2">{{ blogPost.title }}</td>
            <td class="px-4 py-2">{{ blogPost.short_description }}</td>
            <td class="px-4 py-2">{{ blogPost.user.name }}</td>
            <td class="px-4 py-2">
              <button @click="openEditModal(blogPost)" class="text-blue-600">Edit</button>
              |
              <Link :href="`/blog/${blogPost.id}`" class="text-blue-600">View</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Create Blog Post Modal -->
    <Modal :show="showCreateModal" @close="showCreateModal = false">
      <template #default>
        <div class="p-6">
          <h2 class="text-xl font-semibold mb-4">Create Blog Post</h2>
          <form @submit.prevent="submitCreate">
            <div class="mb-4">
              <label for="title" class="block">Title</label>
              <input v-model="createForm.title" id="title" type="text" class="w-full border p-2" />
            </div>

            <div class="mb-4">
              <label for="short_description" class="block">Short Description</label>
              <input v-model="createForm.short_description" id="short_description" type="text" class="w-full border p-2" />
            </div>

            <div class="mb-4">
              <label for="text" class="block">Text</label>
              <textarea v-model="createForm.text" id="text" class="w-full border p-2"></textarea>
            </div>

            <div class="mb-4">
              <label for="user_id" class="block">User</label>
              <select v-model="createForm.user_id" id="user_id" class="w-full border p-2">
                <option value="">Select User</option>
                <option v-for="user in props.users" :value="user.id" :key="user.id">
                  {{ user.name }}
                </option>
              </select>
            </div>

            <div class="flex justify-between mt-4">
              <button @click="showCreateModal = false" type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Cancel
              </button>

              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Save
              </button>
            </div>
          </form>
        </div>
      </template>
    </Modal>

    <!-- Edit Blog Post Modal -->
    <Modal :show="showEditModal" @close="showEditModal = false">
      <template #default>
        <div class="p-6">
          <h2 class="text-xl font-semibold mb-4">Edit Blog Post</h2>
          <form @submit.prevent="submitEdit">
            <div class="mb-4">
              <label for="title" class="block">Title</label>
              <input v-model="editForm.title" id="title" type="text" class="w-full border p-2" />
            </div>

            <div class="mb-4">
              <label for="short_description" class="block">Short Description</label>
              <input v-model="editForm.short_description" id="short_description" type="text" class="w-full border p-2" />
            </div>

            <div class="mb-4">
              <label for="text" class="block">Text</label>
              <textarea v-model="editForm.text" id="text" class="w-full border p-2"></textarea>
            </div>

            <div class="mb-4">
              <label for="user_id" class="block">User</label>
              <select v-model="editForm.user_id" id="user_id" class="w-full border p-2">
                <option value="">Select User</option>
                <option v-for="user in props.users" :value="user.id" :key="user.id">
                  {{ user.name }}
                </option>
              </select>
            </div>

            <div class="flex justify-between mt-4">
              <button @click="showEditModal = false" type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Cancel
              </button>

              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Save
              </button>
            </div>
          </form>
        </div>
      </template>
    </Modal>
  </Layout>
</template>
