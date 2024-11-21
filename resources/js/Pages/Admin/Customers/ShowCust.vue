<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    customer: Object,
});
</script>

<template>
    <Head title="Show Customer" />
    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-xl font-bold">Show Customer</h5>
                <Link
                    :href="route('customers.index')"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Back
                </Link>
            </div>

            <!-- Name Field -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="name"
                >
                    Name
                </label>
                <p>
                    {{ customer.name }}
                </p>
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="email"
                >
                    Email
                </label>
                <p>
                    {{ customer.email }}
                </p>
            </div>

            <!-- Category Field -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="category"
                >
                    Category
                </label>
                <p>
                    {{ customer.category }}
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
