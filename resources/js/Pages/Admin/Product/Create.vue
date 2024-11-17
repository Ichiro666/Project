<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// Menggunakan useForm untuk menangani input data
const form = useForm({
    name: "",
    category: "",
    price: "",
});

const saveProduct = () => {
    const res = form.post(route("products.store"));
    if (res) {
        form.reset();
    }
};
</script>

<template>
    <Head title="Create Products" />
    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-xl font-bold">Create Product</h5>
                <Link
                    :href="route('products.index')"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Back
                </Link>
            </div>
            <!-- Form -->
            <form
                @submit.prevent="saveProduct()"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
            >
                <!-- Name Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Name
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter product name"
                        required
                    />
                    <span
                        v-if="form.errors.name"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.name }}</span
                    >
                </div>

                <!-- Category Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="category"
                    >
                        Category
                    </label>
                    <input
                        v-model="form.category"
                        type="text"
                        id="category"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter category"
                        required
                    />
                    <span
                        v-if="form.errors.category"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.category }}</span
                    >
                </div>

                <!-- Price Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="price"
                    >
                        Price
                    </label>
                    <input
                        v-model="form.price"
                        type="number"
                        step="0.01"
                        id="price"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter product price"
                        required
                    />
                    <span
                        v-if="form.errors.price"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.price }}</span
                    >
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Submit
                    </button>
                    <Link
                        :href="route('products.index')"
                        class="inline-block align-baseline font-bold text-sm text-red-500 hover:text-red-800"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
