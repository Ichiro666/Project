<!-- resources/js/Pages/Member/Cart.vue -->
<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const cartItems = ref([]);
const form = useForm({
    items: [],
    payment_method: "",
    shipping_address: "",
});

const checkout = () => {
    form.items = cartItems.value.map((item) => ({
        product_id: item.id,
        quantity: item.quantity,
        size: item.size,
    }));

    form.post(route("orders.store"), {
        onSuccess: () => {
            // Clear cart after successful checkout
            cartItems.value = [];
            localStorage.removeItem("cart");
        },
    });
};
</script>

<template>
    <MemberLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

            <!-- Cart Items -->
            <div v-if="cartItems.length > 0">
                <div
                    v-for="item in cartItems"
                    :key="item.id"
                    class="mb-4 p-4 border rounded"
                >
                    <!-- Cart item display -->
                </div>

                <!-- Checkout Form -->
                <form @submit.prevent="checkout" class="mt-8">
                    <!-- Payment and shipping inputs -->
                    <button
                        type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded"
                    >
                        Proceed to Checkout
                    </button>
                </form>
            </div>

            <div v-else class="text-center py-8">Your cart is empty</div>
        </div>
    </MemberLayout>
</template>
