<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
    isGuest: Boolean,
    canLogin: Boolean,
    canRegister: Boolean,
});

const showingNavigationDropdown = ref(false);
</script>

<template>
  <div>
    <Head :title="title" />

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
  
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
      
              <!-- Logo -->
              <div class="shrink-0 flex items-center mr-4 sm:mr-0">
                <Link href="/">
                  <ApplicationMark class="block h-9 w-auto" />
                </Link>
              </div>

              <!-- Navigation Links -->

              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('landing.news.index')" :active="route().current('landing.news.index')">
                  News
                </NavLink>
              </div>

              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('landing.blog.index')" :active="route().current('landing.blog.index')">
                  Blog
                </NavLink>
              </div>

            </div>

            <!-- Header with login and registration links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
              <NavLink
                v-if="!isGuest"
                :href="route('dashboard')"
                :active="route().current('dashboard')"
              >
                Admin Panel
              </NavLink>

              <template v-else>
                <NavLink
                  :href="route('login')"
                  :active="route().current('login')"                                >
                >
                  Log in
                </NavLink>

                <NavLink
                  v-if="canRegister"
                  :href="route('register')"
                  :active="route().current('register')"
                >
                  Register
                </NavLink>
              </template>
            </div>
            
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
              <button 
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" 
                @click="showingNavigationDropdown = ! showingNavigationDropdown"
              >
                <svg
                  class="size-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('landing.news.index')" :active="route().current('landing.news.index')">
              News
            </ResponsiveNavLink>

            <ResponsiveNavLink :href="route('landing.blog.index')" :active="route().current('landing.blog.index')">
              Blog
            </ResponsiveNavLink>

            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
              Admin Panel
            </ResponsiveNavLink>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
    </div>
</template>
