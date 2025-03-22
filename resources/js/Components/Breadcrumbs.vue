<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  items: {
    type: Array,
    required: true,
  },
});
</script>

<template>
    <nav class="text-sm text-gray-600 mb-4">
      <ul class="flex space-x-2">
        <li v-for="(item, index) in items" :key="index">
          <span v-if="index < items.length - 1">
            <Link :href="item.link" class="hover:text-blue-600">{{ item.label }}</Link>
            <span class="mx-2">/</span>
          </span>
          <span v-else>
            {{ item.label }}
          </span>
        </li>
      </ul>
    </nav>
  </template>