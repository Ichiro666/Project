<!-- AdminLayout.vue -->
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-300"
            :class="[isSidebarOpen ? 'w-64' : 'w-20']"
        >
            <!-- Sidebar Content -->
            <div class="flex flex-col flex-1 min-h-0 bg-gray-900">
                <!-- Logo Section -->
                <div
                    class="flex items-center justify-between h-16 px-4 bg-gray-800"
                >
                    <Link
                        :href="route('admin.dashboard')"
                        class="flex items-center"
                    >
                        <ApplicationLogo class="w-8 h-8 text-white" />
                        <span
                            v-show="isSidebarOpen"
                            class="ml-3 text-xl font-semibold text-white transition-opacity"
                        >
                            Admin Panel
                        </span>
                    </Link>
                    <button
                        @click="toggleSidebar"
                        class="p-1 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 19l-7-7 7-7m8 14l-7-7 7-7"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard -->
                    <Link
                        :href="route('admin.dashboard')"
                        class="flex items-center px-4 py-3 text-gray-300 transition-colors rounded-lg hover:bg-gray-800 hover:text-white group"
                        :class="{
                            'bg-gray-800 text-white':
                                route().current('admin.dashboard'),
                        }"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />
                        </svg>
                        <span v-show="isSidebarOpen" class="ml-3"
                            >Dashboard</span
                        >
                    </Link>

                    <!-- Products -->
                    <Link
                        :href="route('admin.products')"
                        class="flex items-center px-4 py-3 text-gray-300 transition-colors rounded-lg hover:bg-gray-800 hover:text-white group"
                        :class="{
                            'bg-gray-800 text-white':
                                route().current('admin.products'),
                        }"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                            />
                        </svg>
                        <span v-show="isSidebarOpen" class="ml-3"
                            >Products</span
                        >
                    </Link>

                    <!-- Orders -->
                    <Link
                        :href="route('admin.orders')"
                        class="flex items-center px-4 py-3 text-gray-300 transition-colors rounded-lg hover:bg-gray-800 hover:text-white group"
                        :class="{
                            'bg-gray-800 text-white':
                                route().current('admin.orders'),
                        }"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                            />
                        </svg>
                        <span v-show="isSidebarOpen" class="ml-3">Orders</span>
                    </Link>
                </nav>

                <!-- Profile Section -->
                <div class="p-4 bg-gray-800">
                    <Link
                        :href="route('profile.edit')"
                        class="flex items-center px-4 py-3 text-gray-300 transition-colors rounded-lg hover:bg-gray-700 hover:text-white group"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                        <span v-show="isSidebarOpen" class="ml-3">Profile</span>
                    </Link>

                    <form @submit.prevent="logout" class="mt-2">
                        <button
                            type="submit"
                            class="flex items-center w-full px-4 py-3 text-gray-300 transition-colors rounded-lg hover:bg-gray-700 hover:text-white group"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                            <span v-show="isSidebarOpen" class="ml-3"
                                >Logout</span
                            >
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main
            class="transition-all duration-300"
            :class="[isSidebarOpen ? 'ml-64' : 'ml-20']"
        >
            <div class="p-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<style scoped>
.overflow-y-auto {
    scrollbar-width: thin;
    scrollbar-color: #4b5563 #1f2937;
}

.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #1f2937;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background-color: #4b5563;
    border-radius: 3px;
}
</style>
