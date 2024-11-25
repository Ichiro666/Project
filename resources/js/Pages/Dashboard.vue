<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Contoh data statistik penjualan (bisa diganti dengan data API atau props)
const statistics = {
    totalSales: 1234,
    totalRevenue: 56000, // dalam dolar atau sesuai satuan
    totalCustomers: 345,
    totalProductsSold: 789,
};
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Admin Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Statistik Penjualan -->
                <div
                    class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4"
                >
                    <!-- Total Penjualan -->
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6 text-center"
                    >
                        <h3 class="text-gray-600 font-semibold text-lg">
                            Total Penjualan
                        </h3>
                        <p class="text-2xl font-bold text-gray-800 mt-2">
                            {{ statistics.totalSales }}
                        </p>
                    </div>

                    <!-- Total Pendapatan -->
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6 text-center"
                    >
                        <h3 class="text-gray-600 font-semibold text-lg">
                            Total Pendapatan
                        </h3>
                        <p class="text-2xl font-bold text-green-500 mt-2">
                            ${{ statistics.totalRevenue }}
                        </p>
                    </div>

                    <!-- Total Pelanggan -->
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6 text-center"
                    >
                        <h3 class="text-gray-600 font-semibold text-lg">
                            Total Pelanggan
                        </h3>
                        <p class="text-2xl font-bold text-blue-500 mt-2">
                            {{ statistics.totalCustomers }}
                        </p>
                    </div>

                    <!-- Total Produk Terjual -->
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6 text-center"
                    >
                        <h3 class="text-gray-600 font-semibold text-lg">
                            Total Produk Terjual
                        </h3>
                        <p class="text-2xl font-bold text-purple-500 mt-2">
                            {{ statistics.totalProductsSold }}
                        </p>
                    </div>
                </div>

                <!-- Grafik atau Diagram (Placeholder) -->
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg mt-8 p-6"
                >
                    <h3 class="text-gray-600 font-semibold text-lg mb-4">
                        Grafik Penjualan Bulanan
                    </h3>
                    <div
                        class="h-64 bg-gray-200 flex items-center justify-center"
                    >
                        <span class="text-gray-500">[Grafik Placeholder]</span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
