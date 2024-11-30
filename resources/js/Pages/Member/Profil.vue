<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { Link, usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>

<template>
    <MemberLayout>
        <div class="flex min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <div class="w-64 min-h-screen bg-white shadow-lg">
                <!-- User Profile Header -->
                <div class="p-6 bg-green-700 text-white">
                    <h2 class="text-xl font-semibold">{{ user.name }}</h2>
                    <p class="text-sm mt-1 text-green-100">
                        Welcome to your account
                    </p>
                </div>

                <!-- Sidebar Navigation -->
                <nav class="mt-6">
                    <div class="px-4 py-2">
                        <Link
                            href="/order"
                            class="flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-3"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                                />
                            </svg>
                            My Orders
                        </Link>

                        <Link
                            href="/info"
                            class="flex items-center px-4 py-3 mt-2 text-gray-600 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-3"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                            My Info
                        </Link>

                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            class="flex items-center px-4 py-3 mt-2 text-gray-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors w-full"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-3"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                            Sign Out
                        </Link>
                    </div>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-8">
                <slot>
                    <!-- Default content or router view can go here -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">
                            My Account Overview
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Profile Information -->
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">
                                    Profile Information
                                </h4>
                                <p class="text-gray-600">
                                    Name: {{ user.name }}
                                </p>
                                <p class="text-gray-600">
                                    Email: {{ user.email }}
                                </p>
                            </div>

                            <!-- Recent Orders -->
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">
                                    Recent Orders
                                </h4>
                                <!-- Add recent orders list here -->
                                <p class="text-gray-500 italic">
                                    No recent orders
                                </p>
                            </div>
                        </div>
                    </div>
                </slot>
            </div>
        </div>
    </MemberLayout>
</template>
