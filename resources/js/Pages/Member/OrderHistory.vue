<!-- resources/js/Pages/Member/OrderHistory.vue -->
<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";

defineProps({
    orders: Array,
});
</script>

<template>
    <MemberLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">My Orders</h1>

            <div
                v-for="order in orders"
                :key="order.id"
                class="mb-6 bg-white p-6 rounded-lg shadow"
            >
                <div class="flex justify-between mb-4">
                    <div>
                        <h3 class="font-semibold">
                            Order #{{ order.order_number }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ order.created_at }}
                        </p>
                    </div>
                    <div>
                        <span
                            :class="{
                                'px-3 py-1 rounded-full text-sm': true,
                                'bg-yellow-100 text-yellow-800':
                                    order.status === 'pending',
                                'bg-blue-100 text-blue-800':
                                    order.status === 'processing',
                                'bg-green-100 text-green-800':
                                    order.status === 'completed',
                            }"
                        >
                            {{ order.status }}
                        </span>
                    </div>
                </div>

                <!-- Order items -->
                <div
                    v-for="item in order.items"
                    :key="item.id"
                    class="flex items-center py-4 border-t"
                >
                    <!-- Item details -->
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
