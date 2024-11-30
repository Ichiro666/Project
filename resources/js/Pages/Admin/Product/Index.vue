<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    products: Array,
});

const form = useForm({});
const sortField = ref("id");
const sortDirection = ref("asc");
const searchQuery = ref("");

const toggleSort = (field) => {
    if (sortField.value === field) {
        sortDirection.value = sortDirection.value === "asc" ? "desc" : "asc";
    } else {
        sortField.value = field;
        sortDirection.value = "asc";
    }
};

const filteredAndSortedProducts = computed(() => {
    let filtered = [...props.products];

    if (searchQuery.value) {
        filtered = filtered.filter(
            (product) =>
                product.name
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()) ||
                product.category
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase())
        );
    }

    return filtered.sort((a, b) => {
        let modifier = sortDirection.value === "asc" ? 1 : -1;
        if (a[sortField.value] < b[sortField.value]) return -1 * modifier;
        if (a[sortField.value] > b[sortField.value]) return 1 * modifier;
        return 0;
    });
});

const deleteProduct = (productId) => {
    if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
        form.delete(route("products.destroy", productId));
    }
};
</script>

<template>
    <Head title="Daftar Produk" />
    <AuthenticatedLayout>
        <div class="p-8 max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Daftar Produk
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">Kelola produk Anda</p>
                </div>
                <Link
                    :href="route('products.create')"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-lg inline-flex items-center gap-2 transition duration-200"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Tambah Produk
                </Link>
            </div>

            <!-- Search Bar -->
            <div class="mb-6">
                <input
                    v-model="searchQuery"
                    type="text"
                    placeholder="Cari produk..."
                    class="w-full md:w-96 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                />
            </div>

            <!-- Table Section -->
            <div
                class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200"
            >
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-50">
                                <th
                                    v-for="(label, field) in {
                                        id: 'ID',
                                        image: 'Gambar',
                                        name: 'Nama Produk',
                                        category: 'Kategori',
                                        price: 'Harga',
                                        stock: 'Stok',
                                    }"
                                    :key="field"
                                    @click="
                                        field !== 'image' && toggleSort(field)
                                    "
                                    :class="[
                                        'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                                        field !== 'image' &&
                                            'cursor-pointer hover:bg-gray-100',
                                    ]"
                                >
                                    {{ label }}
                                    <span
                                        v-if="sortField === field"
                                        class="ml-1"
                                    >
                                        {{
                                            sortDirection === "asc" ? "↑" : "↓"
                                        }}
                                    </span>
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="product in filteredAndSortedProducts"
                                :key="product.id"
                                class="hover:bg-gray-50 transition-colors"
                            >
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ product.id }}
                                </td>
                                <td class="px-6 py-4">
                                    <img
                                        v-if="product.image"
                                        :src="`/storage/${product.image}`"
                                        :alt="product.name"
                                        class="h-16 w-16 object-cover rounded-lg shadow-sm"
                                    />
                                    <div
                                        v-else
                                        class="h-16 w-16 bg-gray-100 rounded-lg flex items-center justify-center"
                                    >
                                        <svg
                                            class="h-8 w-8 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ product.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 text-sm text-green-800 bg-green-100 rounded-full"
                                    >
                                        {{ product.category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    Rp{{ product.price?.toLocaleString() }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ product.stock }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <Link
                                            :href="
                                                route(
                                                    'products.show',
                                                    product.id
                                                )
                                            "
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 transition-colors"
                                        >
                                            Detail
                                        </Link>
                                        <Link
                                            :href="
                                                route(
                                                    'products.edit',
                                                    product.id
                                                )
                                            "
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="deleteProduct(product.id)"
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition-colors"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
