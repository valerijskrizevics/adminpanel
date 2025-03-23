<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Layout from '@/Layouts/AppLayout.vue';

defineProps({
    canViewBlog: Boolean,
    canViewNews: Boolean,
});

const form = useForm({
  title: '',
  short_description: '',
  text: '',
});

function submit() {
  form.post(route('blog.store'), {
    onSuccess: () => {
      form.reset();
    },
  });
}
</script>

<template>
  <Layout title="New Blog Post" :canViewBlog="canViewBlog" :canViewNews="canViewNews">
    <div class="bg-white min-h-screen">
      <div class="max-w-3xl mx-auto p-6 bg-white">

        <!-- Breadcrumbs component -->
        <Breadcrumbs :items="[
          { label: 'Blog', link: route('blog.index') },
          { label: 'New Post', link: '#' }
        ]" />

        <h1 class="text-2xl font-semibold mb-4 sm-ml-6">New Blog Post</h1>

        <form @submit.prevent="submit" class="sm-ml-6">
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
            
            <Link :href="route('blog.index')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
              Back
            </Link>
            
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
          
          </div>
        </form>
      </div>
    </div>
  </Layout>
</template>
