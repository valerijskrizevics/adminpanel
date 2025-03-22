<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Layout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    roles: Array
});

</script>

<template>
    <Layout title="Manage Roles">
      <div class="bg-white min-h-screen">
        <div class="max-w-3xl mx-auto p-6 bg-white">
          
          <!-- Breadcrumbs component -->
          <Breadcrumbs :items="[
            { label: 'Permissions', link: route('roles.index') }
          ]" />

          <h1 class="text-2xl font-semibold mb-4 sm-ml-6">Roles Available</h1>
          
          <div class="mb-4 sm-ml-6">
            <Link :href="route('user.roles.edit')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
              My Roles
            </Link>
          </div>
          
          <table class="min-w-full bg-white border border-gray-300 sm-ml-6">
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
      </div>
    </Layout>
</template>
