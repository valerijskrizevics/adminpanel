<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '@/Layouts/AppLayout.vue';
import { computed } from 'vue';

const props = defineProps({
  blogPost: Object,
});

const form = useForm({
  title: props.blogPost.title,
  short_description: props.blogPost.short_description,
  text: props.blogPost.text ?? '',
});

function submit() {
  form.put(`/blog/${props.blogPost.id}`, {
    onSuccess: () => {
      form.reset();
    },
  });
}
</script>

<template>
  <Layout title="Edit Blog Post">
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-6">
      <h2 class="text-2xl font-semibold mb-4">Edit Blog Post</h2>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="title" class="block font-medium">Title</label>
          <input
            v-model="form.title"
            id="title"
            type="text"
            class="w-full border p-2 rounded"
            :class="{ 'border-red-500': form.errors.title }"
          />
          <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
        </div>

        <div class="mb-4">
          <label for="short_description" class="block font-medium">Short Description</label>
          <input
            v-model="form.short_description"
            id="short_description"
            type="text"
            class="w-full border p-2 rounded"
            :class="{ 'border-red-500': form.errors.short_description }"
          />
          <div v-if="form.errors.short_description" class="text-red-500 text-sm mt-1">
            {{ form.errors.short_description }}
          </div>
        </div>

        <div class="mb-4">
          <label for="text" class="block font-medium">Text</label>
          <textarea
            v-model="form.text"
            id="text"
            class="w-full border p-2 rounded"
            :class="{ 'border-red-500': form.errors.text }"
          ></textarea>
          <div v-if="form.errors.text" class="text-red-500 text-sm mt-1">{{ form.errors.text }}</div>
        </div>

        <div class="flex justify-between mt-4">
          <a href="/blog" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
        </div>
      </form>
    </div>
  </Layout>
</template>
