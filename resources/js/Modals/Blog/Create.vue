<script setup>
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
  show: Boolean,
  users: Array,
});

const emit = defineEmits(['close', 'success']);

const form = useForm({
  title: '',
  short_description: '',
  text: '',
  user_id: '',
});

function submit() {
  form.post('/blog', {
    onSuccess: () => {
      emit('success'); // Refresh list after creation
      emit('close'); // Close modal
    },
  });
}
</script>

<template>
  <Modal :show="show" @close="emit('close')">
    <template #default>
      <div class="p-6">
        <h2 class="text-xl font-semibold mb-4">Create Blog Post</h2>
        <form @submit.prevent="submit">
          <div class="mb-4">
            <label for="title" class="block">Title</label>
            <input v-model="form.title" id="title" type="text" class="w-full border p-2" />
          </div>

          <div class="mb-4">
            <label for="short_description" class="block">Short Description</label>
            <input v-model="form.short_description" id="short_description" type="text" class="w-full border p-2" />
          </div>

          <div class="mb-4">
            <label for="text" class="block">Text</label>
            <textarea v-model="form.text" id="text" class="w-full border p-2"></textarea>
          </div>

          <div class="mb-4">
            <label for="user_id" class="block">User</label>
            <select v-model="form.user_id" id="user_id" class="w-full border p-2">
              <option value="">Select User</option>
              <option v-for="user in users" :value="user.id" :key="user.id">
                {{ user.name }}
              </option>
            </select>
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
