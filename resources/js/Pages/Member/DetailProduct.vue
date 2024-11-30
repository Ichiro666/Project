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

                    <!-- Price -->
                    <div class="text-2xl font-bold text-green-600">
                        Rp{{ product.price?.toLocaleString() }}
                    </div>

                    <!-- Size Guide Button -->
                    <button
                        @click="showSizeGuide = true"
                        class="text-sm text-green-600 hover:text-green-700 underline"
                    >
                        View Size Guide
                    </button>

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

                    <!-- Size Information -->
                    <div class="text-sm text-gray-500">
                        <p>Size Guide:</p>
                        <ul class="list-disc ml-5 mt-2">
                            <li>S: Bust 86-90cm, Length 65cm</li>
                            <li>M: Bust 90-94cm, Length 66cm</li>
                            <li>L: Bust 94-98cm, Length 67cm</li>
                            <li>XL: Bust 98-102cm, Length 68cm</li>
                            <li>XXL: Bust 102-106cm, Length 69cm</li>
                        </ul>
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
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
