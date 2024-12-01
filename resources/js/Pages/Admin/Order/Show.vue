<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    order: Object,
});

const form = useForm({});

const updateOrderStatus = (status) => {
    form.patch(
        route("admin.orders.update-status", {
            order: props.order.id,
            status: status,
        }),
        {
            preserveScroll: true,
            onSuccess: () => {
                alert("Order status updated successfully");
            },
        }
    );
};
</script>

<template>
    <Head title="Order Details" />
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Order Details
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Order #{{ order.order_number }}
                    </p>
                </div>
                <Link
                    :href="route('admin.orders.index')"
                    class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200"
                >
                    Back to Orders
                </Link>
            </div>

            <!-- Order Information -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Order Details -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 mb-4">
                                Order Information
                            </h2>
                            <dl class="grid grid-cols-2 gap-4">
                                <div>
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Order Date
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{
                                            new Date(
                                                order.created_at
                                            ).toLocaleDateString()
                                        }}
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Status
                                    </dt>
                                    <dd class="mt-1">
                                        <span
                                            :class="{
                                                'px-2 py-1 text-xs font-medium rounded-full': true,
                                                'bg-yellow-100 text-yellow-800':
                                                    order.status === 'pending',
                                                'bg-blue-100 text-blue-800':
                                                    order.status ===
                                                    'processing',
                                                'bg-green-100 text-green-800':
                                                    order.status ===
                                                    'completed',
                                                'bg-red-100 text-red-800':
                                                    order.status ===
                                                    'cancelled',
                                            }"
                                        >
                                            {{ order.status }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Payment Method
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ order.payment_method }}
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Total Amount
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        Rp{{
                                            order.total_amount.toLocaleString()
                                        }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Customer Details -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 mb-4">
                                Customer Information
                            </h2>
                            <dl class="space-y-4">
                                <div>
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Customer Name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ order.user.name }}
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Email
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ order.user.email }}
                                    </dd>
                                </div>
                                <div>
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        Shipping Address
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ order.shipping_address }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Order Items
                    </h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                >
                                    Product
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                >
                                    Size
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                >
                                    Price
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                >
                                    Quantity
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                                >
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="item in order.items" :key="item.id">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img
                                            v-if="item.product.image"
                                            :src="`/storage/${item.product.image}`"
                                            :alt="item.product.name"
                                            class="w-16 h-16 object-cover rounded"
                                        />
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ item.product.name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ item.size }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    Rp{{ item.price.toLocaleString() }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ item.quantity }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    Rp{{
                                        (
                                            item.price * item.quantity
                                        ).toLocaleString()
                                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Update Status -->
            <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Update Order Status
                </h2>
                <div class="flex gap-4">
                    <button
                        v-if="order.status === 'pending'"
                        @click="updateOrderStatus('processing')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                    >
                        Mark as Processing
                    </button>
                    <button
                        v-if="order.status === 'processing'"
                        @click="updateOrderStatus('completed')"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
                    >
                        Mark as Completed
                    </button>
                    <button
                        v-if="['pending', 'processing'].includes(order.status)"
                        @click="updateOrderStatus('cancelled')"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                    >
                        Cancel Order
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
