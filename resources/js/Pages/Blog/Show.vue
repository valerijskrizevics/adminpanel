<script setup>
defineProps({
  blogPost: Object,
})
</script>

<template>
  <div>
    <h1 class="text-2xl font-semibold">{{ blogPost.title }}</h1>
    <p>{{ blogPost.short_description }}</p>
    <div v-html="blogPost.text"></div>
    <p>By: {{ blogPost.user.name }}</p>
  </div>
</template>
