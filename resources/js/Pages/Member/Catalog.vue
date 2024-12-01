<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

// Terima props products dari controller
const props = defineProps({
    products: Array,
});

// Active category state
const activeCategory = ref("all");

// Computed property untuk filter produk berdasarkan kategori
const filteredProducts = computed(() => {
    if (activeCategory.value === "all") {
        return props.products;
    }
    return props.products.filter(
        (product) =>
            product.category.toLowerCase() ===
            activeCategory.value.toLowerCase()
    );
});
</script>

<template>
    <MemberLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-900">
                    Our Collections
                </h1>
                <p class="mt-4 text-gray-600">
                    Discover our latest fashion collections
                </p>
            </div>

            <!-- Category Navigation -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button
                    v-for="category in [
                        'all',
                        'blouse',
                        'tunik',
                        'rok',
                        'jaket',
                        'celana',
                    ]"
                    :key="category"
                    @click="activeCategory = category"
                    :class="[
                        'px-6 py-2 rounded-full font-medium transition-colors',
                        activeCategory === category
                            ? 'bg-green-600 text-white'
                            : 'bg-gray-100 text-gray-700 hover:bg-green-50 hover:text-green-600',
                    ]"
                >
                    {{
                        category === "all"
                            ? "All Products"
                            : category.charAt(0).toUpperCase() +
                              category.slice(1)
                    }}
                </button>
            </div>

            <!-- Products Grid -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <div
                    v-for="product in filteredProducts"
                    :key="product.id"
                    class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100"
                >
                    <!-- Product Image -->
                    <div class="relative overflow-hidden aspect-w-1 aspect-h-1">
                        <Link :href="route('detail', product.id)">
                            <img
                                v-if="product.image"
                                :src="`/storage/${product.image}`"
                                :alt="product.name"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300"
                            />
                            <div
                                v-else
                                class="w-full h-full bg-gray-200 flex items-center justify-center"
                            >
                                <span class="text-gray-400">No image</span>
                            </div>
                        </Link>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <!-- Category Badge -->
                        <span
                            class="inline-block px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full mb-2"
                        >
                            {{ product.category }}
                        </span>

                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            {{ product.name }}
                        </h3>

                        <!-- Rating -->
                        <div class="flex items-center space-x-1 mb-2">
                            <div class="flex">
                                <template v-for="i in 5" :key="i">
                                    <svg
                                        class="w-4 h-4"
                                        :class="
                                            i <= (product.rating || 0)
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
                                {{
                                    product.rating
                                        ? `${product.rating.toFixed(1)}`
                                        : "0"
                                }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <p class="text-lg font-bold text-green-600">
                                Rp{{ product.price?.toLocaleString() }}
                            </p>
                            <Link
                                :href="route('detail', product.id)"
                                class="text-green-600 hover:text-green-700"
                            >
                                View Details →
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
