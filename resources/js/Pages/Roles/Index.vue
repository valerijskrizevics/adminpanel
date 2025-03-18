<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    roles: Array
});

</script>

<template>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Roles List</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2 text-left">Role name</th>
                    <th class="border px-4 py-2 text-left">Role key</th>
                    <th class="border px-4 py-2 text-left"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles" :key="role.id">
                    <td class="border px-4 py-2">{{ role.name }}</td>
                    <td class="border px-4 py-2">{{ role.name.toLowerCase() }}</td>
                    <td class="border px-4 py-2">
                        <Link :href="route('roles.permissions', role.name.toLowerCase())" class="text-blue-600 hover:underline">
                            Permissions
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
