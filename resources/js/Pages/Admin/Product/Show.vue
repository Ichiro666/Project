<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    product: Object,
});
</script>

<template>
    <Head title="Detail Produk" />
    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-xl font-bold">Detail Produk</h5>
                <Link
                    :href="route('products.index')"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Kembali
                </Link>
            </div>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <!-- Image Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Gambar Produk
                    </label>
                    <div class="mt-2">
                        <img
                            v-if="product.image"
                            :src="`/storage/${product.image}`"
                            :alt="product.name"
                            class="w-64 h-64 object-cover rounded-lg shadow-md"
                        />
                        <p v-else class="text-gray-500">Tidak ada gambar</p>
                    </div>
                </div>

                <!-- Name Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Nama
                    </label>
                    <p class="text-gray-800">
                        {{ product.name || "Tidak ada data" }}
                    </p>
                </div>

                <!-- Category Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="category"
                    >
                        Kategori
                    </label>
                    <p class="text-gray-800">
                        {{ product.category || "Tidak ada data" }}
                    </p>
                </div>

                <!-- Price Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="price"
                    >
                        Harga
                    </label>
                    <p class="text-gray-800">
                        Rp{{
                            product.price ? product.price.toLocaleString() : "0"
                        }}
                    </p>
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Deskripsi
                    </label>
                    <p class="text-gray-800 whitespace-pre-wrap">
                        {{ product.description || "Tidak ada deskripsi" }}
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
