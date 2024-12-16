<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    orders: {
        type: Array,
        required: true,
        default: () => [],
    },
});

const form = useForm({});
const ratingForm = useForm({
    rating: 0,
    review: "",
    product_id: null,
    order_id: null,
});

const activeTab = ref("active");
const showRatingModal = ref(false);

const setActiveTab = (tab) => {
    activeTab.value = tab;
};

const hasRated = (item) => {
    return item && item.rating !== undefined && item?.rating !== null;
};

const openRatingModal = (orderId, productId) => {
    ratingForm.rating = 0;
    ratingForm.review = "";
    ratingForm.order_id = orderId;
    ratingForm.product_id = productId;
    showRatingModal.value = true;
};

const submitRating = () => {
    ratingForm.post(route("products.rate", ratingForm.product_id), {
        preserveScroll: true,
        onSuccess: () => {
            showRatingModal.value = false;
            alert("Thank you for your rating!");
            window.location.reload();
        },
        onError: () => {
            alert("Failed to submit rating");
        },
    });
};

// Add updateOrderStatus function
const updateOrderStatus = (orderId, newStatus) => {
    if (
        confirm(
            `Are you sure you want to ${
                newStatus === "completed" ? "accept" : "cancel"
            } this order?`
        )
    ) {
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
            }
        );
    }
};

const getFilteredOrders = (orders, status) => {
    if (!orders) return [];

    switch (status) {
        case "active":
            return orders.filter((order) =>
                ["pending", "processing"].includes(order.status)
            );
        case "completed":
            return orders.filter((order) => order.status === "completed");
        case "cancelled":
            return orders.filter((order) => order.status === "cancelled");
        default:
            return [];
    }
};

const getStatusBadgeClass = (status) => {
    return {
        "px-2 py-1 text-xs font-medium rounded-full": true,
        "bg-yellow-100 text-yellow-800": status === "pending",
        "bg-blue-100 text-blue-800": status === "processing",
        "bg-green-100 text-green-800": status === "completed",
        "bg-red-100 text-red-800": status === "cancelled",
    };
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
                        Active Orders
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
                </nav>
            </div>

            <!-- Orders List -->
            <div class="space-y-6">
                <div
                    v-for="order in getFilteredOrders(orders, activeTab)"
                    :key="order.id"
                    class="bg-white rounded-lg shadow-md p-6"
                >
                    <!-- Order Header -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div>
                            <p class="text-gray-500">Order Number</p>
                            <p class="font-medium">{{ order.order_number }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Date</p>
                            <p class="font-medium">
                                {{
                                    new Date(
                                        order.created_at
                                    ).toLocaleDateString()
                                }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Status</p>
                            <span :class="getStatusBadgeClass(order.status)">
                                {{ order.status }}
                            </span>
                        </div>
                        <div>
                            <p class="text-gray-500">Total Amount</p>
                            <p class="font-medium">
                                Rp{{ order.total_amount.toLocaleString() }}
                            </p>
                        </div>

                        <!-- Add Action Buttons for Processing Orders -->
                        <div
                            v-if="order.status === 'processing'"
                            class="col-span-full flex justify-end space-x-4"
                        >
                            <button
                                @click="
                                    updateOrderStatus(order.id, 'completed')
                                "
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-300"
                            >
                                Accept Order
                            </button>
                            <button
                                @click="
                                    updateOrderStatus(order.id, 'cancelled')
                                "
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-300"
                            >
                                Cancel Order
                            </button>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="border-t pt-6">
                        <div
                            v-for="item in order.items"
                            :key="item.id"
                            class="flex items-center justify-between py-4"
                        >
                            <div class="flex items-center space-x-4">
                                <img
                                    v-if="item.product.image"
                                    :src="`/storage/${item.product.image}`"
                                    :alt="item.product.name"
                                    class="w-16 h-16 object-cover rounded-md"
                                />
                                <div>
                                    <h4 class="font-medium text-gray-800">
                                        {{ item.product.name }}
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        Size: {{ item.size }} | Qty:
                                        {{ item.quantity }}
                                    </p>
                                    <p class="font-medium text-gray-800">
                                        Rp{{
                                            (
                                                item.price * item.quantity
                                            ).toLocaleString()
                                        }}
                                    </p>
                                </div>
                            </div>
                            <!-- Add Rating Button for Completed Orders -->
                            <div v-if="order.status === 'completed'">
                                <div v-if="!hasRated(item)">
                                    <button
                                        @click="
                                            openRatingModal(
                                                order.id,
                                                item.product.id
                                            )
                                        "
                                        class="px-4 py-2 text-sm bg-yellow-500 text-white rounded-md hover:bg-yellow-600"
                                    >
                                        Rate Product
                                    </button>
                                </div>
                                <div v-else class="flex flex-col">
                                    <div class="flex items-center">
                                        <div class="flex text-yellow-400">
                                            <template v-for="i in 5" :key="i">
                                                <svg
                                                    class="w-5 h-5"
                                                    :class="
                                                        i <= item.rating
                                                            ? 'text-yellow-400'
                                                            : 'text-gray-300'
                                                    "
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    />
                                                </svg>
                                            </template>
                                        </div>
                                    </div>
                                    <p
                                        v-if="item.review"
                                        class="text-sm text-gray-600 mt-2"
                                    >
                                        {{ item.review }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Rating Modal -->
                    <div
                        v-if="showRatingModal"
                        class="fixed inset-0 z-50 overflow-y-auto"
                    >
                        <div
                            class="flex items-center justify-center min-h-screen px-4"
                        >
                            <div
                                class="fixed inset-0 bg-black opacity-50"
                            ></div>
                            <div
                                class="relative bg-white rounded-lg p-8 max-w-md w-full"
                            >
                                <h3 class="text-lg font-medium mb-4">
                                    Rate & Review Product
                                </h3>

                                <!-- Star Rating -->
                                <div class="flex justify-center space-x-2 mb-6">
                                    <template v-for="i in 5" :key="i">
                                        <button
                                            @click="ratingForm.rating = i"
                                            class="focus:outline-none"
                                        >
                                            <svg
                                                class="w-8 h-8"
                                                :class="
                                                    i <= ratingForm.rating
                                                        ? 'text-yellow-400'
                                                        : 'text-gray-300'
                                                "
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                />
                                            </svg>
                                        </button>
                                    </template>
                                </div>

                                <!-- Review Text Area -->
                                <div class="mb-6">
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Your Review
                                    </label>
                                    <textarea
                                        v-model="ratingForm.review"
                                        rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                        placeholder="Write your review here..."
                                    ></textarea>
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-4">
                                    <button
                                        @click="showRatingModal = false"
                                        class="px-4 py-2 text-gray-600 hover:text-gray-800"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        @click="submitRating"
                                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600"
                                        :disabled="!ratingForm.rating"
                                    >
                                        Submit Review
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display reviews in the order items section -->
                    <div v-if="hasRated(item)" class="flex flex-col">
                        <div class="flex items-center">
                            <div class="flex text-yellow-400">
                                <template v-for="i in 5" :key="i">
                                    <svg
                                        class="w-5 h-5"
                                        :class="
                                            i <= item.rating
                                                ? 'text-yellow-400'
                                                : 'text-gray-300'
                                        "
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                        />
                                    </svg>
                                </template>
                            </div>
                            <span class="text-sm text-gray-600 ml-2"
                                >{{ item.rating }}/5</span
                            >
                        </div>
                        <p
                            v-if="item.review"
                            class="text-sm text-gray-600 mt-2"
                        >
                            {{ item.review }}
                        </p>
                    </div>

                    <!-- Empty State -->
                    <div
                        v-if="!getFilteredOrders(orders, activeTab).length"
                        class="text-center py-12"
                    >
                        <p class="text-gray-500">
                            No orders found in this category
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
