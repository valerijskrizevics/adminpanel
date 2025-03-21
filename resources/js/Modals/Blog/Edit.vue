<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';  // Import axios
import Modal from '@/Components/Modal.vue';

const props = defineProps({
  show: Boolean,
  blogPostId: Number, // Pass only ID instead of full object
});

const emit = defineEmits(['close', 'success']);
const blogPost = ref(null);
const loading = ref(false);

const form = useForm({
  title: '',
  short_description: '',
  text: '',
});

const fetchBlogPost = async () => {
  if (!props.blogPostId) return;
  
  loading.value = true;

  try {
    const response = await axios.get(`/blog/${props.blogPostId}/edit`, {
      headers: {
        'X-Inertia': 'true',  // Ensure the request is treated as an Inertia request
        'Accept': 'application/json',  // Ensure JSON response
      },
    });
    
    blogPost.value = response.data.blogPost; // Adjust to match your API response structure
    form.title = response.data.blogPost.title;
    form.short_description = response.data.blogPost.short_description;
    form.text = response.data.blogPost.text ?? '';
    form.errors = null;
  } catch (error) {
    console.error('Error fetching blog post:', error);
  } finally {
    loading.value = false;
  }
};

watch([() => props.show, () => props.blogPostId], ([newShow, newId]) => {
  if (newShow && newId) {
    fetchBlogPost();
  }
});

function submit() {
  form.put(`/blog/${props.blogPostId}`, {
    onSuccess: () => {
      emit('success'); // Refresh list after update
      emit('close'); // Close modal
    },
    onError: (errors) => {
      // Handle errors (display validation messages)
    },
  });
}
</script>

<template>
  <Modal :show="show" @close="emit('close')">
    <template #default>
      <div v-if="loading" class="p-6">Loading...</div>
      <div v-else class="p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Blog Post</h2>
        <form @submit.prevent="submit">
          <div class="mb-4">
            <label for="title" class="block">Title</label>
            <input
              v-model="form.title"
              id="title"
              type="text"
              class="w-full border p-2"
              :class="{ 'border-red-500': form.errors?.title }"
            />
            <div v-if="form.errors?.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
          </div>

          <div class="mb-4">
            <label for="short_description" class="block">Short Description</label>
            <input
              v-model="form.short_description"
              id="short_description"
              type="text"
              class="w-full border p-2"
              :class="{ 'border-red-500': form.errors?.short_description }"
            />
            <div v-if="form.errors?.short_description" class="text-red-500 text-sm mt-1">
              {{ form.errors.short_description }}
            </div>
          </div>

          <div class="mb-4">
            <label for="text" class="block">Text</label>
            <textarea
              v-model="form.text"
              id="text"
              class="w-full border p-2"
              :class="{ 'border-red-500': form.errors?.text }"
            ></textarea>
            <div v-if="form.errors?.text" class="text-red-500 text-sm mt-1">{{ form.errors.text }}</div>
          </div>

          <div class="flex justify-between mt-4">
            <button type="button" @click="emit('close')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
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
</template>
