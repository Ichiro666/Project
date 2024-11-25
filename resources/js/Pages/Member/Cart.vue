<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
</script>

<template>
    <MemberLayout>
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold text-center mb-6">Your Cart</h2>

            <!-- Cart Items -->
            <div class="bg-white shadow-lg p-6 rounded-lg space-y-6">
                <!-- Cart Item 1 -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0"
                >
                    <div class="flex items-center space-x-4">
                        <img
                            src="../images/Blouse/Blouse1.png"
                            alt="Product 1"
                            class="w-24 h-24 object-cover rounded-md"
                        />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Blouse Red
                            </h3>
                            <p class="text-gray-600 text-sm">
                                <span class="font-semibold">Size:</span> M |
                                <span class="font-semibold">Color:</span> Red
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button
                                class="bg-gray-300 text-gray-800 px-3 py-2 rounded-md hover:bg-gray-400 transition"
                                aria-label="Decrease Quantity"
                            >
                                -
                            </button>
                            <span class="text-gray-800 font-medium">1</span>
                            <button
                                class="bg-gray-300 text-gray-800 px-3 py-2 rounded-md hover:bg-gray-400 transition"
                                aria-label="Increase Quantity"
                            >
                                +
                            </button>
                        </div>
                        <span class="text-gray-800 font-semibold">$30.00</span>
                        <button
                            class="text-red-500 font-semibold hover:underline transition"
                            aria-label="Remove Product"
                        >
                            Remove
                        </button>
                    </div>
                </div>

                <!-- Cart Item 2 -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0"
                >
                    <div class="flex items-center space-x-4">
                        <img
                            src="../images/Blouse/Blouse2.png"
                            alt="Product 2"
                            class="w-24 h-24 object-cover rounded-md"
                        />
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Blouse Blue
                            </h3>
                            <p class="text-gray-600 text-sm">
                                <span class="font-semibold">Size:</span> L |
                                <span class="font-semibold">Color:</span> Blue
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button
                                class="bg-gray-300 text-gray-800 px-3 py-2 rounded-md hover:bg-gray-400 transition"
                                aria-label="Decrease Quantity"
                            >
                                -
                            </button>
                            <span class="text-gray-800 font-medium">2</span>
                            <button
                                class="bg-gray-300 text-gray-800 px-3 py-2 rounded-md hover:bg-gray-400 transition"
                                aria-label="Increase Quantity"
                            >
                                +
                            </button>
                        </div>
                        <span class="text-gray-800 font-semibold">$45.00</span>
                        <button
                            class="text-red-500 font-semibold hover:underline transition"
                            aria-label="Remove Product"
                        >
                            Remove
                        </button>
                    </div>
                </div>

                <!-- Total Price Section -->
                <div
                    class="flex items-center justify-between bg-gray-100 shadow-md p-4 rounded-lg"
                >
                    <h3 class="text-xl font-semibold text-gray-800">Total</h3>
                    <span class="text-2xl font-bold text-green-600"
                        >$120.00</span
                    >
                </div>

                <!-- Checkout Button -->
                <div class="mt-6 flex justify-center">
                    <button
                        href="/checkout"
                        class="bg-green-500 text-white py-3 px-8 rounded-lg shadow-lg hover:bg-green-600 transition text-lg font-semibold"
                    >
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
