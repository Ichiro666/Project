<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, computed } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3"; // Add useForm here

const props = defineProps({
    orders: Array,
});

// Initialize form
const form = useForm({});

// Add updateOrderStatus function
const updateOrderStatus = (orderId, newStatus) => {
    form.patch(
        route("admin.orders.update-status", {
            order: orderId,
            status: newStatus,
        }),
        {
            preserveScroll: true,
            onSuccess: () => {
                alert("Order status updated successfully");
            },
            onError: () => {
                alert("Failed to update order status");
            },
        }
    );
};

// Filter and sort states
const searchQuery = ref("");
const sortField = ref("id");
const sortDirection = ref("desc");
const statusFilter = ref("all");

// Computed property for filtered and sorted orders
const filteredOrders = computed(() => {
    let filtered = props.orders;

    // Apply status filter
    if (statusFilter.value !== "all") {
        filtered = filtered.filter(
            (order) => order.status === statusFilter.value
        );
    }

    // Apply search filter
    if (searchQuery.value) {
        filtered = filtered.filter(
            (order) =>
                order.order_number
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()) ||
                order.shipping_address
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase())
        );
    }

    // Sort orders
    return filtered.sort((a, b) => {
        let modifier = sortDirection.value === "asc" ? 1 : -1;
        if (a[sortField.value] < b[sortField.value]) return -1 * modifier;
        if (a[sortField.value] > b[sortField.value]) return 1 * modifier;
        return 0;
    });
});

// Toggle sort direction
const toggleSort = (field) => {
    if (sortField.value === field) {
        sortDirection.value = sortDirection.value === "asc" ? "desc" : "asc";
    } else {
        sortField.value = field;
        sortDirection.value = "asc";
    }
};
</script>

<template>
    <Head title="Orders Management" />
    <AuthenticatedLayout>
        <div class="p-8 max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Orders Management
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Manage and track all customer orders
                    </p>
                </div>
            </div>

            <!-- Filters -->
            <div class="mb-6 flex gap-4 items-center">
                <div class="flex-1">
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search orders..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <select
                    v-model="statusFilter"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    v-for="(label, field) in {
                                        order_number: 'Order Number',
                                        created_at: 'Date',
                                        total_amount: 'Total Amount',
                                        status: 'Status',
                                        payment_method: 'Payment Method',
                                    }"
                                    :key="field"
                                    @click="toggleSort(field)"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
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
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="order in filteredOrders" :key="order.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ order.order_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{
                                            new Date(
                                                order.created_at
                                            ).toLocaleDateString()
                                        }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        Rp{{
                                            order.total_amount.toLocaleString()
                                        }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        :class="{
                                            'px-2 py-1 text-xs font-medium rounded-full': true,
                                            'bg-yellow-100 text-yellow-800':
                                                order.status === 'pending',
                                            'bg-blue-100 text-blue-800':
                                                order.status === 'processing',
                                            'bg-green-100 text-green-800':
                                                order.status === 'completed',
                                            'bg-red-100 text-red-800':
                                                order.status === 'cancelled',
                                        }"
                                    >
                                        {{ order.status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ order.payment_method }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <Link
                                        :href="
                                            route('admin.orders.show', order.id)
                                        "
                                        class="text-blue-600 hover:text-blue-900 mr-4"
                                    >
                                        View Details
                                    </Link>
                                    <button
                                        v-if="order.status === 'pending'"
                                        @click="
                                            updateOrderStatus(
                                                order.id,
                                                'processing'
                                            )
                                        "
                                        class="text-green-600 hover:text-green-900"
                                    >
                                        Process Order
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
