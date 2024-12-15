<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

// Available sizes with stock information
const availableSizes = [
    { name: "S", label: "Small", inStock: true },
    { name: "M", label: "Medium", inStock: true },
    { name: "L", label: "Large", inStock: true },
    { name: "XL", label: "Extra Large", inStock: true },
    { name: "XXL", label: "Double XL", inStock: true },
];

const selectedSize = ref("");
const form = useForm({
    product_id: props.product?.id,
    quantity: 1,
    size: "",
});

const addToCart = () => {
    if (!selectedSize.value) {
        alert("Please select a size");
        return;
    }

    form.size = selectedSize.value;
    form.post(route("cart.add"), {
        onSuccess: () => {
            alert("Product added to cart successfully!");
        },
        onError: (errors) => {
            console.error("Failed to add to cart:", errors);
        },
    });
};

const formatRating = (rating) => {
    const numRating = Number(rating);
    return isNaN(numRating) ? "0.0" : numRating.toFixed(1);
};

// Format date helper
const formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};
</script>

<template>
    <MemberLayout>
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Left Side - Product Image -->
                <div class="md:w-1/2">
                    <img
                        v-if="product?.image"
                        :src="`/storage/${product.image}`"
                        :alt="product.name"
                        class="w-full h-[600px] object-cover rounded-lg shadow-lg"
                    />
                </div>

                <!-- Right Side - Product Details -->
                <div class="md:w-1/2 space-y-6">
                    <!-- Product Name -->
                    <h1 class="text-3xl font-bold text-gray-800">
                        {{ product.name }}
                    </h1>

                    <!-- Rating -->
                    <div class="flex items-center space-x-2">
                        <div class="flex">
                            <template v-for="i in 5" :key="i">
                                <svg
                                    class="w-5 h-5"
                                    :class="
                                        i <= Math.round(Number(product.rating))
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
                            ({{ product.reviews_count || 0 }} reviews)
                        </span>
                    </div>
                    <!-- Price -->
                    <div class="text-2xl font-bold text-green-600">
                        Rp{{ product.price?.toLocaleString() }}
                    </div>

                    <!-- Size Selection -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">
                            Select Size
                        </label>
                        <div class="grid grid-cols-5 gap-2">
                            <button
                                v-for="size in availableSizes"
                                :key="size.name"
                                @click="selectedSize = size.name"
                                :disabled="!size.inStock"
                                :class="[
                                    'px-4 py-3 border rounded-lg text-sm font-medium transition-colors',
                                    selectedSize === size.name
                                        ? 'bg-green-600 text-white border-green-600'
                                        : size.inStock
                                        ? 'border-gray-300 hover:border-green-500 text-gray-700'
                                        : 'border-gray-200 text-gray-400 cursor-not-allowed bg-gray-50',
                                ]"
                            >
                                <span class="block text-base">{{
                                    size.name
                                }}</span>
                                <span class="block text-xs mt-1">{{
                                    size.label
                                }}</span>
                                <span
                                    v-if="!size.inStock"
                                    class="block text-xs mt-1 text-red-500"
                                >
                                    Out of stock
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <h3 class="text-lg font-medium text-gray-900">
                            Description
                        </h3>
                        <p class="text-gray-600">
                            {{
                                product.description ||
                                "No description available"
                            }}
                        </p>
                    </div>

                    <!-- Add to Cart Button -->
                    <button
                        @click="addToCart"
                        :disabled="!selectedSize"
                        class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-300 disabled:bg-gray-400 disabled:cursor-not-allowed"
                    >
                        {{
                            selectedSize
                                ? "Add to Cart"
                                : "Select Size to Continue"
                        }}
                    </button>

                    <!-- Reviews Section -->
                    <div class="max-w-4xl mx-auto mt-16 px-4">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">
                            Customer Reviews
                            <span class="text-lg font-normal text-gray-600">
                                ({{ product.reviews_count || 0 }})
                            </span>
                        </h2>

                        <!-- Overall Rating -->
                        <div class="flex items-center mb-8">
                            <div class="flex items-center">
                                <div class="flex">
                                    <template v-for="i in 5" :key="i">
                                        <svg
                                            class="w-5 h-5"
                                            :class="
                                                i <=
                                                Math.round(
                                                    Number(product.rating)
                                                )
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
                                <span class="ml-2 text-xl font-bold">
                                    {{ formatRating(product.rating) }}
                                </span>
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="text-gray-600">
                                    {{ product.reviews_count || 0 }} reviews
                                </span>
                            </div>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="space-y-8">
                            <template v-if="product.ratings?.length">
                                <div
                                    v-for="review in product.ratings"
                                    :key="review.id"
                                    class="border-b border-gray-200 pb-8"
                                >
                                    <div class="flex items-center mb-4">
                                        <div class="flex items-center">
                                            <!-- Star Rating -->
                                            <div class="flex">
                                                <template
                                                    v-for="i in 5"
                                                    :key="i"
                                                >
                                                    <svg
                                                        class="w-4 h-4"
                                                        :class="
                                                            i <= review.rating
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
                                            class="ml-4 text-sm font-medium text-gray-900"
                                        >
                                            {{ review.user?.name }}
                                        </p>
                                        <time
                                            class="ml-4 text-sm text-gray-500"
                                        >
                                            {{ formatDate(review.created_at) }}
                                        </time>
                                    </div>
                                    <p
                                        v-if="review.review"
                                        class="text-gray-600"
                                    >
                                        {{ review.review }}
                                    </p>
                                </div>
                            </template>

                            <!-- No Reviews Message -->
                            <div v-else class="text-center py-8 text-gray-500">
                                No reviews yet for this product.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
