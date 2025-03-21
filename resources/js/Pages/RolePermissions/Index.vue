<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Layout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    flash: Object,
    role: Object,
    groupedPermissions: Object,
    permissions: Array,
});

// Destructure props for easy access
const { flash, errors, role, groupedPermissions, permissions } = props;

// Initialize the selectedPermissions array with the permissions already assigned to the role
const selectedPermissions = ref([...permissions]);

// Create a form instance using useForm
const form = useForm({
    permissions: selectedPermissions.value,
});

// Update permissions method
const updatePermissions = () => {
    // Update form's permissions to match the current selected permissions array
    form.permissions = selectedPermissions.value;

    // Send form data to backend to update permissions for the role
    form.post(route('roles.permissions.update', { roleName: role.name }), {
        onSuccess: () => {
            // Success handling (flash message will be shown automatically)
        },
        onError: (errors) => {
            // Error handling (e.g., validation errors)
        },
    });
};
</script>

<template>
  <Layout title="Manage Permissions">
    <div class="bg-white min-h-screen">
      <div class="max-w-3xl mx-auto p-6 bg-white">
        <h1 class="text-2xl font-semibold mb-4 ml-6">
          Permissions for Role: {{ role.name.charAt(0).toUpperCase() + role.name.slice(1) }}
        </h1> 
        
        <!-- Flash messages -->
        <div v-if="flash?.success" class="bg-green-500 text-white p-4 mb-4 ml-6 rounded">
          {{ flash.success }}
        </div>
        <div v-if="flash?.error" class="bg-red-500 text-white p-4 mb-4 ml-6 rounded">
          {{ flash.error }}
        </div>

        <!-- Permissions form -->
        <form @submit.prevent="updatePermissions" class="ml-6">
          <table class="w-full border-collapse border border-gray-300">
            <tbody>
              <template v-for="(permissionsGroup, groupName) in groupedPermissions" :key="groupName">
                <tr class="bg-gray-200">
                  <td class="border border-gray-300 px-4 py-2 font-bold" colspan="2">{{ groupName.charAt(0).toUpperCase() + groupName.slice(1) }}</td>
                </tr>
                <tr v-for="permission in permissionsGroup" :key="permission.id">
                  <td class="border-b border-gray-300 px-8 py-2">{{ permission.name.split(' ')[0].charAt(0).toUpperCase() + permission.name.split(' ')[0].slice(1) }}</td>
                  <td class="border-b border-gray-300 px-2 py-2 w-8">
                    <input 
                      type="checkbox" 
                      :value="permission.name" 
                      v-model="selectedPermissions" 
                      class="form-checkbox text-blue-600 focus:ring-blue-500"
                    />
                  </td>
                </tr>
              </template>
            </tbody>
          </table>

          <button
            type="submit"
            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            :disabled="form.processing"
          >
            Save
          </button>
        </form>
      </div>
    </div>
  </Layout>
</template>
