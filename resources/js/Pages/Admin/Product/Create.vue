<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    category: "",
    price: "",
    image: null,
    description: "",
    stock: 0,
});

const saveProduct = () => {
    form.post(route("products.store"), {
        forceFormData: true,
        onSuccess: () => {
            alert("Product created successfully!");
        },
        onError: (errors) => {
            console.error("Failed to create product:", errors);
        },
    });
};
</script>

<template>
    <Head title="Create Product" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Header -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-semibold text-gray-800">
                                Create New Product
                            </h1>
                            <Link
                                :href="route('products.index')"
                                class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                            >
                                Back to List
                            </Link>
                        </div>
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="saveProduct" class="p-6 space-y-6">
                        <!-- Product Name -->
                        <div>
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Product Name
                            </label>
                            <input
                                v-model="form.name"
                                type="text"
                                id="name"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Enter product name"
                                required
                            />
                            <p
                                v-if="form.errors.name"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.name }}
                            </p>
                        </div>

                        <!-- Category -->
                        <div>
                            <label
                                for="category"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Category
                            </label>
                            <select
                                v-model="form.category"
                                id="category"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                required
                            >
                                <option value="">Select a category</option>
                                <option value="Blouse">Blouse</option>
                                <option value="Tunik">Tunik</option>
                                <option value="Rok">Rok</option>
                                <option value="Celana">Celana</option>
                                <option value="Jaket">Jaket</option>
                            </select>
                            <p
                                v-if="form.errors.category"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.category }}
                            </p>
                        </div>

                        <!-- Price -->
                        <div>
                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Price (Rp)
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                >
                                    <span class="text-gray-500 sm:text-sm"
                                        >Rp</span
                                    >
                                </div>
                                <input
                                    v-model="form.price"
                                    type="number"
                                    id="price"
                                    class="pl-12 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    placeholder="0"
                                    required
                                />
                            </div>
                            <p
                                v-if="form.errors.price"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.price }}
                            </p>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label
                                for="stock"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Stock
                            </label>
                            <input
                                v-model="form.stock"
                                type="number"
                                id="stock"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="0"
                                required
                            />
                            <p
                                v-if="form.errors.stock"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.stock }}
                            </p>
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                            >
                                Product Image
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                            >
                                <div class="space-y-1 text-center">
                                    <svg
                                        class="mx-auto h-12 w-12 text-gray-400"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 48 48"
                                    >
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label
                                            for="image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500"
                                        >
                                            <span>Upload a file</span>
                                            <input
                                                id="image"
                                                type="file"
                                                class="sr-only"
                                                @change="
                                                    (e) =>
                                                        (form.image =
                                                            e.target.files[0])
                                                "
                                                accept="image/*"
                                            />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 10MB
                                    </p>
                                </div>
                            </div>
                            <p
                                v-if="form.errors.image"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.image }}
                            </p>
                        </div>

                        <!-- Description -->
                        <div>
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Description
                            </label>
                            <textarea
                                v-model="form.description"
                                id="description"
                                rows="4"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Enter product description"
                            ></textarea>
                            <p
                                v-if="form.errors.description"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ form.errors.description }}
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-4">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 transition-colors duration-200"
                            >
                                {{
                                    form.processing
                                        ? "Creating..."
                                        : "Create Product"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
