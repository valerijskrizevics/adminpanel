<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const { blogPost, users } = defineProps();

const form = useForm({
  title: blogPost.title,
  short_description: blogPost.short_description,
  text: blogPost.text,
  user_id: blogPost.user_id,
});

function submit() {
  form.put(`/blog-posts/${blogPost.id}`, {
    onError: () => {
      // Errors will automatically be populated in form.errors
    },
  });
}
</script>

<template>
  <div>
    <h1 class="text-2xl font-semibold">Edit Blog Post</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="title" class="block">Title</label>
        <input
          v-model="form.title"
          id="title"
          type="text"
          class="w-full border p-2"
          :class="{'border-red-500': form.errors.title}"
        />
        <!-- Display error message if title has an error -->
        <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
          {{ form.errors.title }}
        </div>
      </div>

      <div class="mb-4">
        <label for="short_description" class="block">Short Description</label>
        <input
          v-model="form.short_description"
          id="short_description"
          type="text"
          class="w-full border p-2"
          :class="{'border-red-500': form.errors.short_description}"
        />
        <!-- Display error message if short_description has an error -->
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
          :class="{'border-red-500': form.errors.text}"
        ></textarea>
        <!-- Display error message if text has an error -->
        <div v-if="form.errors.text" class="text-red-500 text-sm mt-1">
          {{ form.errors.text }}
        </div>
      </div>

      <div class="mb-4">
        <label for="user_id" class="block">User</label>
        <select
          v-model="form.user_id"
          id="user_id"
          class="w-full border p-2"
          :class="{'border-red-500': form.errors.user_id}"
        >
          <option value="">Select User</option>
          <option v-for="user in users" :value="user.id" :key="user.id">
            {{ user.name }}
          </option>
        </select>
        <!-- Display error message if user_id has an error -->
        <div v-if="form.errors.user_id" class="text-red-500 text-sm mt-1">
          {{ form.errors.user_id }}
        </div>
      </div>

      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Update Blog Post
      </button>
    </form>
  </div>
</template>
