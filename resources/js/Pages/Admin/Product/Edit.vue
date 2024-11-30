<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const imagePreview = ref(null);
const oldImage = props.product?.image || "";

const form = useForm({
    name: props.product?.name || "",
    image: null,
    category: props.product?.category || "",
    price: props.product?.price || "",
    description: props.product?.description || "",
    stock: props.product?.stock || 0,
    _method: "PUT",
});

const handleFileChange = (event) => {
    const file = event.target.files[0];
    form.image = file;

    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const updateProduct = () => {
    form.post(route("products.update", props.product?.id), {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            alert("Product updated successfully!");
        },
        onError: (errors) => {
            console.error("Update failed:", errors);
        },
    });
};
</script>

<template>
    <Head title="Edit Product" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold text-gray-900">
                            Edit Product
                        </h1>
                    </div>

                    <form @submit.prevent="updateProduct" class="space-y-6">
                        <!-- Name -->
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
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            />
                            <div
                                v-if="form.errors.name"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label
                                for="category"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Category
                            </label>
                            <input
                                v-model="form.category"
                                type="text"
                                id="category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            />
                            <div
                                v-if="form.errors.category"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ form.errors.category }}
                            </div>
                        </div>

                        <!-- Price -->
                        <div>
                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Price
                            </label>
                            <input
                                v-model="form.price"
                                type="number"
                                step="0.01"
                                id="price"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            />
                            <div
                                v-if="form.errors.price"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ form.errors.price }}
                            </div>
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
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            />
                            <div
                                v-if="form.errors.stock"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ form.errors.stock }}
                            </div>
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
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            ></textarea>
                            <div
                                v-if="form.errors.description"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ form.errors.description }}
                            </div>
                        </div>

                        <!-- Image -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                            >
                                Product Image
                            </label>
                            <div class="mt-1 flex items-center space-x-4">
                                <div
                                    v-if="imagePreview || oldImage"
                                    class="w-32 h-32"
                                >
                                    <img
                                        :src="
                                            imagePreview ||
                                            `/storage/${oldImage}`
                                        "
                                        class="w-full h-full object-cover rounded-lg"
                                    />
                                </div>
                                <input
                                    type="file"
                                    @change="handleFileChange"
                                    accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                />
                            </div>
                            <div
                                v-if="form.errors.image"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ form.errors.image }}
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                            >
                                {{
                                    form.processing
                                        ? "Updating..."
                                        : "Update Product"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
