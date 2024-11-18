<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
</script>
<template>
    <MemberLayout>
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

            <!-- Cart Items (Semua Item Dalam 1 Div) -->
            <div class="bg-white shadow-lg p-4 rounded-lg space-y-6">
                <!-- Cart Item 1 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img
                            src="../images/Blouse/Blouse1.png"
                            alt="Product 1"
                            class="w-20 h-20 object-cover rounded-md"
                        />
                        <div>
                            <h3 class="text-lg font-semibold">Product Name</h3>
                            <p class="text-gray-500 text-sm">
                                Size: M | Color: Red
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700 font-semibold">$30.00</span>
                        <div class="flex items-center space-x-2">
                            <button
                                class="bg-gray-200 text-gray-700 rounded-md px-3 py-1"
                            >
                                -
                            </button>
                            <span class="text-gray-700">1</span>
                            <button
                                class="bg-gray-200 text-gray-700 rounded-md px-3 py-1"
                            >
                                +
                            </button>
                        </div>
                    </div>
                    <button class="text-red-500 font-semibold">Remove</button>
                </div>

                <!-- Cart Item 2 -->
                <div class="flex items-center justify-between pt-5">
                    <div class="flex items-center space-x-4">
                        <img
                            src="../images/Blouse/Blouse2.png"
                            alt="Product 2"
                            class="w-20 h-20 object-cover rounded-md"
                        />
                        <div>
                            <h3 class="text-lg font-semibold">Product Name</h3>
                            <p class="text-gray-500 text-sm">
                                Size: L | Color: Blue
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700 font-semibold">$45.00</span>
                        <div class="flex items-center space-x-2">
                            <button
                                class="bg-gray-200 text-gray-700 rounded-md px-3 py-1"
                            >
                                -
                            </button>
                            <span class="text-gray-700">2</span>
                            <button
                                class="bg-gray-200 text-gray-700 rounded-md px-3 py-1"
                            >
                                +
                            </button>
                        </div>
                    </div>
                    <button class="text-red-500 font-semibold">Remove</button>
                </div>

                <!-- Total Price Section -->
                <div
                    class="flex items-center justify-between bg-white shadow-lg p-4 rounded-lg mt-6"
                >
                    <h3 class="text-xl font-semibold">Total</h3>
                    <span class="text-2xl font-bold">$120.00</span>
                </div>

                <!-- Checkout Button -->
                <div class="mt-6 flex justify-center">
                    <button
                        class="bg-green-500 text-white py-2 px-6 rounded-lg shadow-lg hover:bg-green-600"
                    >
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
