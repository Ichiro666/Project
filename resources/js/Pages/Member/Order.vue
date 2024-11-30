<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { ref } from "vue";

const activeTab = ref("active");

const setActiveTab = (tab) => {
    activeTab.value = tab;
};

// Sample order data (replace with actual data from your backend)
const orders = {
    active: [
        {
            orderNo: "ORD-2024-001",
            orderDate: "2024-01-15",
            estimatedDelivery: "2024-01-20",
            status: "Processing",
            paymentMethod: "Credit Card",
            items: [
                {
                    id: 1,
                    image: "/storage/products/sample-product.jpg",
                    name: "Orimoza Blouse Ruffle",
                    qty: 2,
                    total: 100000,
                },
            ],
        },
    ],
};
</script>

<template>
    <MemberLayout>
        <div class="max-w-6xl mx-auto px-4 py-8">
            <!-- Heading -->
            <h1 class="text-3xl font-bold text-gray-800 mb-8">My Orders</h1>

            <!-- Order Status Tabs -->
            <div class="border-b border-gray-200 mb-8">
                <nav class="flex space-x-8">
                    <button
                        @click="setActiveTab('active')"
                        :class="[
                            'py-4 px-1 border-b-2 font-medium text-sm',
                            activeTab === 'active'
                                ? 'border-green-500 text-green-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                        ]"
                    >
                        Active
                    </button>
                    <button
                        @click="setActiveTab('cancelled')"
                        :class="[
                            'py-4 px-1 border-b-2 font-medium text-sm',
                            activeTab === 'cancelled'
                                ? 'border-green-500 text-green-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                        ]"
                    >
                        Cancelled
                    </button>
                    <button
                        @click="setActiveTab('completed')"
                        :class="[
                            'py-4 px-1 border-b-2 font-medium text-sm',
                            activeTab === 'completed'
                                ? 'border-green-500 text-green-600'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                        ]"
                    >
                        Completed
                    </button>
                </nav>
            </div>

            <!-- Orders List -->
            <div v-if="activeTab === 'active'" class="space-y-6">
                <div
                    v-for="order in orders.active"
                    :key="order.orderNo"
                    class="bg-white rounded-lg shadow-md p-6"
                >
                    <!-- Order Header -->
                    <div
                        class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6 text-sm"
                    >
                        <div>
                            <p class="text-gray-500">Order</p>
                            <p class="font-medium">{{ order.orderNo }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Order Date</p>
                            <p class="font-medium">{{ order.orderDate }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Estimated Delivery</p>
                            <p class="font-medium">
                                {{ order.estimatedDelivery }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Order Status</p>
                            <p class="font-medium text-yellow-600">
                                {{ order.status }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Payment Method</p>
                            <p class="font-medium">{{ order.paymentMethod }}</p>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="border-t pt-6">
                        <div
                            v-for="item in order.items"
                            :key="item.id"
                            class="flex items-center justify-between"
                        >
                            <div class="flex items-center space-x-4">
                                <img
                                    :src="item.image"
                                    :alt="item.name"
                                    class="w-16 h-16 object-cover rounded-md"
                                />
                                <div>
                                    <h4 class="font-medium text-gray-800">
                                        {{ item.name }}
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        Qty: {{ item.qty }}
                                    </p>
                                    <p class="font-medium text-gray-800">
                                        Rp {{ item.total.toLocaleString() }}
                                    </p>
                                </div>
                            </div>

                            <button
                                class="text-green-600 hover:text-green-700 font-medium"
                            >
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty States for other tabs -->
            <div
                v-else-if="activeTab === 'cancelled'"
                class="text-center py-12"
            >
                <p class="text-gray-500">No cancelled orders</p>
            </div>

            <div v-else class="text-center py-12">
                <p class="text-gray-500">No completed orders</p>
            </div>
        </div>
    </MemberLayout>
</template>
