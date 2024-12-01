<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

defineProps({
    cartItems: Array, // Receive cart items from backend
});

const form = useForm({
    items: [],
    payment_method: "",
    shipping_address: "",
});

const updateCartItem = (itemKey, quantity) => {
    form.patch(route("cart.update", itemKey), {
        quantity: quantity,
    });
};

const removeFromCart = (itemKey) => {
    if (confirm("Are you sure you want to remove this item?")) {
        form.delete(route("cart.remove", itemKey));
    }
};

const checkout = () => {
    form.post(route("checkout"));
};
</script>

<template>
    <MemberLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

            <div class="bg-white rounded-lg shadow">
                <!-- Cart Items -->
                <div v-if="cartItems && cartItems.length > 0">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            Cart Items ({{ cartItems.length }})
                        </h2>
                    </div>

                    <!-- Cart Items List -->
                    <div class="divide-y divide-gray-200">
                        <div
                            v-for="item in cartItems"
                            :key="item.key"
                            class="p-6 flex items-center"
                        >
                            <!-- Product Image -->
                            <div
                                class="flex-shrink-0 w-24 h-24 rounded-md overflow-hidden"
                            >
                                <img
                                    :src="`/storage/${item.product.image}`"
                                    :alt="item.product.name"
                                    class="w-full h-full object-cover"
                                />
                            </div>

                            <!-- Product Details -->
                            <div class="ml-6 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3
                                            class="text-lg font-medium text-gray-900"
                                        >
                                            {{ item.product.name }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Size: {{ item.size }}
                                        </p>
                                    </div>
                                    <p
                                        class="text-lg font-medium text-green-600"
                                    >
                                        Rp{{
                                            (
                                                item.product.price *
                                                item.quantity
                                            ).toLocaleString()
                                        }}
                                    </p>
                                </div>

                                <div
                                    class="mt-4 flex items-center justify-between"
                                >
                                    <!-- Quantity Controls -->
                                    <div
                                        class="flex items-center border rounded-md"
                                    >
                                        <button
                                            type="button"
                                            class="p-2 text-gray-600 hover:text-gray-700"
                                            @click="
                                                updateCartItem(
                                                    item.key,
                                                    Math.max(
                                                        1,
                                                        item.quantity - 1
                                                    )
                                                )
                                            "
                                            :disabled="item.quantity <= 1"
                                        >
                                            <span class="sr-only"
                                                >Decrease quantity</span
                                            >
                                            <svg
                                                class="w-5 h-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M20 12H4"
                                                />
                                            </svg>
                                        </button>
                                        <span class="px-4 py-2 text-gray-900">{{
                                            item.quantity
                                        }}</span>
                                        <button
                                            type="button"
                                            class="p-2 text-gray-600 hover:text-gray-700"
                                            @click="
                                                updateCartItem(
                                                    item.key,
                                                    item.quantity + 1
                                                )
                                            "
                                        >
                                            <span class="sr-only"
                                                >Increase quantity</span
                                            >
                                            <svg
                                                class="w-5 h-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                                />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Remove Button -->
                                    <button
                                        type="button"
                                        class="text-sm font-medium text-red-600 hover:text-red-500"
                                        @click="removeFromCart(item.key)"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="border-t border-gray-200 px-6 py-4">
                        <div
                            class="flex justify-between text-base font-medium text-gray-900"
                        >
                            <p>Subtotal</p>
                            <p>
                                Rp{{
                                    cartItems
                                        .reduce(
                                            (sum, item) =>
                                                sum +
                                                item.product.price *
                                                    item.quantity,
                                            0
                                        )
                                        .toLocaleString()
                                }}
                            </p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">
                            Shipping and taxes calculated at checkout.
                        </p>

                        <!-- Checkout Button -->
                        <div class="mt-6">
                            <Link
                                :href="route('checkout')"
                                class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700"
                            >
                                Proceed to Checkout
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Empty Cart -->
                <div v-else class="px-6 py-12 text-center">
                    <svg
                        class="mx-auto h-12 w-12 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                        />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                        Your cart is empty
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Start shopping to add items to your cart.
                    </p>
                    <div class="mt-6">
                        <Link
                            href="/shop"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700"
                        >
                            Continue Shopping
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
