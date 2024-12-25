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
                    <span class="ml-3 text-xl font-semibold text-gray-800">
                        Admin Dashboard
                    </span>
                </Link>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-2">
                <!-- Dashboard Link -->
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                    class="nav-link"
                    :class="{ 'bg-gray-100': route().current('dashboard') }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="nav-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </NavLink>

                <!-- Products Link -->
                <NavLink
                    :href="route('products.index')"
                    :active="route().current('products.index')"
                    class="nav-link"
                    :class="{
                        'bg-gray-100': route().current('products.index'),
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="nav-icon"
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

                <!-- Orders Link -->
                <NavLink
                    :href="route('admin.orders.index')"
                    :active="route().current('admin.orders.index')"
                    class="nav-link"
                    :class="{
                        'bg-gray-100': route().current('admin.orders.index'),
                    }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="nav-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                        />
                    </svg>
                    <span class="font-medium">Orders</span>
                </NavLink>

                <!-- Profile Link -->
                <NavLink
                    :href="route('profile.edit')"
                    :active="route().current('profile.edit')"
                    class="nav-link mt-4"
                    :class="{ 'bg-gray-100': route().current('profile.edit') }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="nav-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
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
        <div class="ml-64 flex-1">
            <slot />
        </div>
    </div>
</template>

<style scoped>
.nav-link {
    @apply flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors;
}

.nav-icon {
    @apply w-5 h-5 mr-3;
}
</style>
