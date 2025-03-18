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
    <Layout title="Manage Role Permissions">
        <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-bold mb-4">Manage Permissions for Role: {{ role.name }}</h2>

            <!-- Flash messages -->
            <div v-if="flash?.success" class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ flash.success }}
            </div>
            <div v-if="flash?.error" class="bg-red-500 text-white p-4 mb-4 rounded">
                {{ flash.error }}
            </div>

            <!-- Permissions form -->
            <form @submit.prevent="updatePermissions">
                <div v-for="(permissionsGroup, groupName) in groupedPermissions" :key="groupName" class="mb-6">
                    <h3 class="text-lg font-semibold">{{ groupName.charAt(0).toUpperCase() + groupName.slice(1) }} Permissions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        <div
                            v-for="permission in permissionsGroup"
                            :key="permission.id"
                            class="flex items-center"
                        >
                            <input
                                type="checkbox"
                                :id="permission.name"
                                :value="permission.name"
                                v-model="selectedPermissions"
                                class="form-checkbox text-blue-600 focus:ring-blue-500"
                            />
                            <label :for="permission.name" class="ml-2 text-gray-800">
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>
                </div>

                <button
                    type="submit"
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    :disabled="form.processing"
                >
                    Update Permissions
                </button>
            </form>
        </div>
    </Layout>
</template>
