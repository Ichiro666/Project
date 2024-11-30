<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";

const isSidebarCollapsed = ref(false);

const toggleSidebar = () => {
    isSidebarCollapsed.value = !isSidebarCollapsed.value;
};
</script>

<template>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg fixed">
            <!-- Logo Section -->
            <div class="p-4 border-b">
                <Link :href="route('dashboard')" class="flex items-center">
                    <ApplicationLogo class="w-8 h-8" />
                    <span class="ml-3 text-xl font-semibold text-gray-800"
                        >Admin Dashboard</span
                    >
                </Link>
            </div>
            <!-- Navigation Menu -->
            <nav class="p-4 space-y-2">
                <!-- Dashboard Link -->
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                    class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
                    :class="{ 'bg-gray-100': route().current('dashboard') }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            d="M3 6a3 3 0 013-3h2.25a3 3 0 013 3v2.25a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm9.75 0a3 3 0 013-3H18a3 3 0 013 3v2.25a3 3 0 01-3 3h-2.25a3 3 0 01-3-3V6zM3 15.75a3 3 0 013-3h2.25a3 3 0 013 3V18a3 3 0 01-3 3H6a3 3 0 01-3-3v-2.25zm9.75 0a3 3 0 013-3H18a3 3 0 013 3V18a3 3 0 01-3 3h-2.25a3 3 0 01-3-3v-2.25z"
                        />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </NavLink>
                <!-- Products Link -->
                <NavLink
                    :href="route('products.index')"
                    :active="route().current('products.index')"
                    class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
                    :class="{
                        'bg-gray-100': route().current('products.index'),
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z"
                        />
                        <path
                            d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z"
                        />
                    </svg>
                    <span class="font-medium">Products</span>
                </NavLink>

                <!-- Customers Link -->
                <NavLink
                    :href="route('customers.index')"
                    :active="route().current('customers.index')"
                    class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
                    :class="{
                        'bg-gray-100': route().current('customers.index'),
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z"
                        />
                    </svg>
                    <span class="font-medium">Customers</span>
                </NavLink>
                <!-- Profile Section -->
                <NavLink
                    :href="route('profile.edit')"
                    :active="route().current('profile.edit')"
                    class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <span class="font-medium">Profile</span>
                </NavLink>
                <!-- Logout Button -->
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="flex items-center w-full px-4 py-2 mt-6 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9a.75.75 0 01-1.5 0V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <span class="font-medium">Log Out</span>
                </Link>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Page Heading -->
            <header
                class="bg-white shadow ml-64 flex-1 p-4"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="ml-64 flex-1 p-4">
                <slot />
            </main>
        </div>
    </div>
</template>
