<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    products: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    product_id: null,
    quantity: 1,
    size: "M", // Default size
});

const formatRating = (rating) => {
    const numRating = Number(rating);
    return isNaN(numRating) ? "0.0" : numRating.toFixed(1);
};

const addToCart = (product) => {
    form.product_id = product.id;

    form.post(route("cart.add"), {
        preserveScroll: true,
        onSuccess: () => {
            alert("Product added to cart successfully!");
        },
        onError: (errors) => {
            console.error("Failed to add to cart:", errors);
        },
    });
};
</script>

<template>
    <MemberLayout>
        <div class="px-8 py-12">
            <h2 class="text-3xl font-semibold text-center mb-8">
                Shop Women's Clothing
            </h2>

            <!-- Products Grid -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <!-- Product Card -->
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200"
                >
                    <!-- Image Container -->
                    <div class="relative overflow-hidden">
                        <Link :href="route('detail', product.id)" class="block">
                            <img
                                v-if="product.image"
                                :src="`/storage/${product.image}`"
                                :alt="product.name"
                                class="w-full h-64 object-cover rounded-t-lg"
                            />
                            <div
                                v-else
                                class="h-72 w-full bg-gray-200 flex items-center justify-center"
                            >
                                <span class="text-gray-400">No image</span>
                            </div>
                        </Link>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <h3
                            class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-green-600 transition-colors"
                        >
                            {{ product.name }}
                        </h3>

                        <!-- Rating Section -->
                        <div class="flex items-center space-x-1 mb-3">
                            <div class="flex">
                                <template v-for="i in 5" :key="i">
                                    <svg
                                        class="w-4 h-4"
                                        :class="
                                            i <= Number(product.rating)
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
                            <span class="text-sm text-gray-600">
                                {{ formatRating(product.rating) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                ({{ product.reviews_count || 0 }})
                            </span>
                        </div>

                        <!-- Price and Actions -->
                        <div class="flex items-center justify-between mt-4">
                            <p class="text-xl font-bold text-green-600">
                                Rp{{ product.price?.toLocaleString() }}
                            </p>
                            <div class="flex items-center gap-2">
                                <button
                                    @click="addToCart(product)"
                                    class="bg-green-600 text-white p-2 rounded-full hover:bg-green-700 transition-colors"
                                    title="Add to Cart"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                                        />
                                    </svg>
                                </button>
                                <Link
                                    :href="route('detail', product.id)"
                                    class="bg-gray-100 text-gray-700 p-2 rounded-full hover:bg-gray-200 transition-colors"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
