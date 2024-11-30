<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { Link } from "@inertiajs/vue3";

// Define props to receive products data
defineProps({
    products: Array,
});
</script>

<template>
    <MemberLayout>
        <div class="px-8 py-12">
            <h2 class="text-3xl font-semibold text-center mb-8">
                Shop Women's Clothing
            </h2>

            <!-- Products Grid -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
            >
                <!-- Product Card -->
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <Link
                        :href="route('detail', product.id)"
                        class="cursor-pointer block"
                    >
                        <img
                            v-if="product.image"
                            :src="`/storage/${product.image}`"
                            :alt="product.name"
                            class="h-64 w-full object-cover rounded-md mb-4 hover:opacity-80 transition-opacity"
                        />
                        <div
                            v-else
                            class="h-64 w-full bg-gray-200 rounded-md mb-4 flex items-center justify-center"
                        >
                            <span class="text-gray-400">No image</span>
                        </div>
                    </Link>

                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ product.name }}
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp{{ product.price?.toLocaleString() }}
                    </p>
                    <div class="flex justify-between">
                        <button
                            @click="addToCart(product)"
                            class="w-40 bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                        >
                            Checkout
                        </button>
                        <Link
                            :href="route('cart')"
                            class="text-gray-600 hover:text-green-600"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z"
                                />
                                <circle cx="10.5" cy="19.5" r="1.5" />
                                <circle cx="17.5" cy="19.5" r="1.5" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
