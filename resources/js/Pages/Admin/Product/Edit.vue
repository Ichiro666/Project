<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// Menerima props product dari server (hanya akan digunakan saat edit produk)
const props = defineProps({
    product: Object,
});

// Menggunakan useForm untuk menangani data input
const form = useForm({
    name: props.product?.name || "", // Jika ada data produk, gunakan, jika tidak kosong
    image: null, // Set image menjadi null karena kita akan menggunakan input file
    category: props.product?.category || "",
    price: props.product?.price || "",
    description: props.product?.description || "",
    stock: props.product?.stock || 0,
});

// Menampilkan gambar lama jika tidak diganti
const oldImage = props.product?.image || "";

// Fungsi untuk menangani perubahan file gambar
const handleFileChange = (event) => {
    form.image = event.target.files[0]; // Mengambil file yang dipilih dan menyimpannya di form.image
};

// Fungsi untuk memperbarui produk
const updateProduct = () => {
    form.put(route("products.update", props.product?.id), {
        onSuccess: () => {
            alert("Product updated successfully!");
            form.reset(); // Reset form setelah update berhasil
        },
        onError: (errors) => {
            console.error("Update failed:", errors);
            alert("Failed to update product. Please check the input.");
        },
    });
};
</script>

<template>
    <Head title="Edit Product" />
    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-xl font-bold">Edit Product</h5>
                <Link
                    :href="route('products.index')"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Back
                </Link>
            </div>

            <!-- Form -->
            <form
                @submit.prevent="updateProduct"
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

                <!-- Image Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="image"
                    >
                        Image
                    </label>
                    <!-- Menampilkan gambar lama jika ada -->
                    <div v-if="oldImage" class="mb-2">
                        <img
                            :src="oldImage"
                            alt="Current Image"
                            class="w-32 h-32 object-cover rounded-md"
                        />
                    </div>
                    <input
                        type="file"
                        id="image"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        accept="image/*"
                        @change="handleFileChange"
                    />
                    <span
                        v-if="form.errors.image"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.image }}</span
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

                <!-- Description Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="description"
                    >
                        Description
                    </label>
                    <textarea
                        v-model="form.description"
                        id="description"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter product description"
                        rows="3"
                        required
                    ></textarea>
                    <span
                        v-if="form.errors.description"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.description }}</span
                    >
                </div>

                <!-- Stock Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="stock"
                    >
                        Stock
                    </label>
                    <input
                        v-model="form.stock"
                        type="number"
                        id="stock"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter product stock"
                        required
                    />
                    <span
                        v-if="form.errors.stock"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.stock }}</span
                    >
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Update Product
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
