<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { Link, usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>

<template>
    <MemberLayout>
        <div class="flex min-h-screen bg-gray-100">
            <!-- Main Content -->
            <div class="flex-1 p-8">
                <div class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                            My Information
                        </h2>

                        <!-- User Information -->
                        <div class="space-y-4">
                            <!-- Name -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium text-gray-500"
                                    >Name</label
                                >
                                <p class="text-lg text-gray-800">
                                    {{ user?.name }}
                                </p>
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col">
                                <label class="text-sm font-medium text-gray-500"
                                    >Email</label
                                >
                                <p class="text-lg text-gray-800">
                                    {{ user?.email }}
                                </p>
                            </div>

                            <!-- Edit Button -->
                            <div class="mt-6">
                                <Link
                                    :href="route('profile.edit')"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-2"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        />
                                    </svg>
                                    Edit Profile
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
