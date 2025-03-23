<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import NavLink from '@/Components/NavLink.vue';

defineProps({
    title: String,
    isGuest: Boolean,
    canLogin: Boolean,
    canRegister: Boolean,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link href="/">
                                    <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->

                            <div class="space-x-8 sm:-my-px sm:ms-10 flex">
                                <NavLink :href="route('landing.blog.index')" :active="route().current('landing.blog.index')">
                                    Blog
                                </NavLink>
                            </div>

                            <div class="space-x-8 sm:-my-px sm:ms-10 flex">
                                <NavLink :href="route('landing.blog.index')" :active="route().current('landing.blog.index')">
                                    News
                                </NavLink>
                            </div>
                        </div>

                        <!-- Header with login and registration links -->
                        <div class="space-x-8 sm:-my-px sm:ms-10 flex">
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
