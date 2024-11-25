<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    products: Array,
});

const form = useForm({});

const deleteProduct = (productId) => {
    if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
        form.delete(route("products.destroy", productId), {
            onSuccess: () => {
                alert("Produk berhasil dihapus!");
            },
            onError: (errors) => {
                console.error("Gagal menghapus data:", errors);
                alert("Gagal menghapus produk. Silakan coba lagi.");
            },
        });
    }
};
</script>
<template>
    <Head title="Daftar Produk" />
    <AuthenticatedLayout>
        <div class="mt-6 mx-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold text-gray-700">
                    Daftar Produk
                </h1>
                <Link
                    :href="route('products.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Tambah Produk
                </Link>
            </div>
            <div class="overflow-x-auto">
                <table
                    class="w-full border border-gray-200 rounded-lg shadow-md"
                >
                    <thead class="bg-gray-100">
                        <tr>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Id
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Nama
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Gambar
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Kategori
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Harga
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Deskripsi
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Stok
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in products" :key="item.id">
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ item.id }}
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ item.name }}
                            </td>
                            <td class="py-3 px-4 border-b">
                                <img
                                    :src="item.image"
                                    alt="Product Image"
                                    class="h-16 w-16 object-cover rounded"
                                />
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ item.category }}
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                Rp{{ item.price.toLocaleString() }}
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ item.description }}
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ item.stock }}
                            </td>
                            <td class="py-3 px-4 border-b flex gap-2">
                                <Link
                                    :href="route('products.show', item.id)"
                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded text-sm"
                                >
                                    Detail
                                </Link>
                                <Link
                                    :href="route('products.edit', item.id)"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded text-sm"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded text-sm"
                                    @click="deleteProduct(item.id)"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
