<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";
import Layout from "@/Layouts/AppLayout.vue";
import Modal from "@/Components/Modal.vue"; // Import your custom modal

const { users } = defineProps();

const form = useForm({
  title: "",
  short_description: "",
  text: "",
  user_id: "",
});

const showModal = ref(false); // Modal visibility state

function submit() {
  form.post("/blog", {
    onSuccess: () => {
      showModal.value = false; // Close modal on success
    },
    onError: () => {
      // Errors are automatically populated in form.errors
    },
  });
}
</script>

<template>
  <Layout title="Manage Blog Posts">
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
      <h1 class="text-2xl font-semibold">Blog Posts</h1>

      <!-- Button to Open Modal -->
      <button @click="showModal = true" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Create Blog Post
      </button>

      <!-- Use the custom Modal component -->
      <Modal :show="showModal" maxWidth="2xl" @close="showModal = false">
        <div class="p-6">
          <h2 class="text-xl font-semibold mb-4">Create Blog Post</h2>

          <form @submit.prevent="submit">
            <div class="mb-4">
              <label for="title" class="block">Title</label>
              <input
                v-model="form.title"
                id="title"
                type="text"
                class="w-full border p-2"
                :class="{ 'border-red-500': form.errors.title }"
              />
              <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
            </div>

            <div class="mb-4">
              <label for="short_description" class="block">Short Description</label>
              <input
                v-model="form.short_description"
                id="short_description"
                type="text"
                class="w-full border p-2"
                :class="{ 'border-red-500': form.errors.short_description }"
              />
              <div v-if="form.errors.short_description" class="text-red-500 text-sm mt-1">
                {{ form.errors.short_description }}
              </div>
            </div>

            <div class="mb-4">
              <label for="text" class="block">Text</label>
              <textarea
                v-model="form.text"
                id="text"
                class="w-full border p-2"
                :class="{ 'border-red-500': form.errors.text }"
              ></textarea>
              <div v-if="form.errors.text" class="text-red-500 text-sm mt-1">{{ form.errors.text }}</div>
            </div>

            <div class="mb-4">
              <label for="user_id" class="block">User</label>
              <select
                v-model="form.user_id"
                id="user_id"
                class="w-full border p-2"
                :class="{ 'border-red-500': form.errors.user_id }"
              >
                <option value="">Select User</option>
                <option v-for="user in users" :value="user.id" :key="user.id">
                  {{ user.name }}
                </option>
              </select>
              <div v-if="form.errors.user_id" class="text-red-500 text-sm mt-1">{{ form.errors.user_id }}</div>
            </div>

            <div class="flex justify-between">
              <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Cancel
              </button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Create Blog Post
              </button>
            </div>
          </form>
        </div>
      </Modal>
    </div>
  </Layout>
</template>
