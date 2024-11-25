<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
</script>

<template>
    <MemberLayout>
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold text-center mb-6">
                Payment Information
            </h2>

            <form class="bg-white shadow-lg p-6 rounded-lg space-y-6">
                <!-- Full Name -->
                <div>
                    <label
                        for="fullName"
                        class="block text-gray-700 font-semibold mb-2"
                        >Full Name</label
                    >
                    <input
                        type="text"
                        id="fullName"
                        placeholder="Enter your full name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        required
                    />
                </div>

                <!-- Address -->
                <div>
                    <label
                        for="address"
                        class="block text-gray-700 font-semibold mb-2"
                        >Address</label
                    >
                    <textarea
                        id="address"
                        placeholder="Enter your address"
                        rows="3"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        required
                    ></textarea>
                </div>

                <!-- Phone Number -->
                <div>
                    <label
                        for="phone"
                        class="block text-gray-700 font-semibold mb-2"
                        >Phone Number</label
                    >
                    <input
                        type="tel"
                        id="phone"
                        placeholder="Enter your phone number"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        required
                    />
                </div>

                <!-- Payment Method -->
                <div>
                    <label
                        for="paymentMethod"
                        class="block text-gray-700 font-semibold mb-2"
                        >Payment Method</label
                    >
                    <select
                        id="paymentMethod"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        required
                    >
                        <option value="creditCard">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bankTransfer">Bank Transfer</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>

                <!-- Card Details (if Credit Card selected) -->
                <div>
                    <label
                        for="cardNumber"
                        class="block text-gray-700 font-semibold mb-2"
                        >Card Number</label
                    >
                    <input
                        type="text"
                        id="cardNumber"
                        placeholder="Enter your card number"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        required
                    />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="bg-green-500 text-white py-3 px-8 rounded-lg shadow-lg hover:bg-green-600 transition text-lg font-semibold"
                    >
                        Confirm Payment
                    </button>
                </div>
            </form>
        </div>
    </MemberLayout>
</template>
