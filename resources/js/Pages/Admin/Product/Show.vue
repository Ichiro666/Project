<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: Object,
});
// Menggunakan useForm untuk menangani input data
</script>

<template>
    <Head title="Show Products" />
    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-xl font-bold">Show Product</h5>
                <Link
                    :href="route('products.index')"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Back
                </Link>
            </div>
            <!-- Form -->

            <!-- Name Field -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="name"
                >
                    Name
                </label>
                <p>
                    {{ product.name }}
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
                    {{ product.category }}
                </p>
            </div>

            <!-- Price Field -->
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="price"
                >
                    Price
                </label>
                <p>
                    {{ product.price }}
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
