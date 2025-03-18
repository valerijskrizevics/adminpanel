<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';  // Inertia's usePage hook
import Layout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    user: Object,
    roles: Array,
    errors: Object, // Make sure to accept errors as props
});

const form = useForm({
    roles: props.user.current_roles || [],
});

// Use Inertia's usePage to get flash data, default to empty object if not defined
const { flash = {} } = usePage();

const updateRoles = () => {
    form.post(route('user.roles.update'), {
        onSuccess: () => {
            // Redirecting after success and automatically showing flash messages
        },
        onError: (errors) => {
            // Handle errors here if necessary
        },
    });
};
</script>

<template>
    <Layout title="Manage Your Roles">
        <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-bold mb-4">Manage Your Roles</h2>

            <!-- Flash message for success -->
            <div v-if="flash?.success" class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ flash.success }}
            </div>

            <!-- Flash message for error -->
            <div v-if="flash?.error" class="bg-red-500 text-white p-4 mb-4 rounded">
                {{ flash.error }}
            </div>

            <!-- Display validation errors passed via props -->
            <div v-if="errors.roles" class="bg-red-500 text-white p-4 mb-4 rounded">
                {{ errors.roles }}
            </div>

            <form @submit.prevent="updateRoles">
                <label class="block font-medium text-gray-700 mb-2">Select Your Roles:</label>

                <div v-for="role in roles" :key="role.id" class="flex items-center gap-2 mb-2">
                    <input
                        type="checkbox"
                        :id="role.name"
                        :value="role.name"
                        v-model="form.roles"
                        class="form-checkbox text-blue-600 focus:ring-blue-500"
                    />
                    <label :for="role.name" class="text-gray-800">
                        {{ role.name.charAt(0).toUpperCase() + role.name.slice(1) }}
                    </label>
                </div>

                <button
                    type="submit"
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    :disabled="form.processing"
                >
                    Update Roles
                </button>
            </form>
        </div>
    </Layout>
</template>
