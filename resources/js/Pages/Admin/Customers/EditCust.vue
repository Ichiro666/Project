<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// Menerima props customer dari server
const props = defineProps({
    customer: Object,
});

// Menggunakan useForm untuk menangani data input
const form = useForm({
    name: props.customer.name || "",
    email: props.customer.email || "",
    category: props.customer.category || "",
});

// Fungsi untuk memperbarui customer
const updateCustomer = () => {
    form.put(route("customers.update", props.customer.id), {
        onSuccess: () => {
            alert("Customer updated successfully!");
            form.reset();
        },
        onError: (errors) => {
            console.error("Update failed:", errors);
            alert("Failed to update customer. Please check the input.");
        },
    });
};
</script>

<template>
    <Head title="Edit Customer" />
    <AuthenticatedLayout>
        <div class="mt-4 mx-4">
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-xl font-bold">Edit Customer</h5>
                <Link
                    :href="route('customers.index')"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Back
                </Link>
            </div>
            <!-- Form -->
            <form
                @submit.prevent="updateCustomer()"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
            >
                <!-- Name Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Name
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter customer name"
                        required
                    />
                    <span
                        v-if="form.errors.name"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.name }}</span
                    >
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="email"
                    >
                        Email
                    </label>
                    <input
                        v-model="form.email"
                        type="email"
                        id="email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter customer email"
                        required
                    />
                    <span
                        v-if="form.errors.email"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.email }}</span
                    >
                </div>

                <!-- Category Field -->
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="category"
                    >
                        Category
                    </label>
                    <input
                        v-model="form.category"
                        type="text"
                        id="category"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter customer category"
                        required
                    />
                    <span
                        v-if="form.errors.category"
                        class="text-red-500 text-sm mt-1"
                        >{{ form.errors.category }}</span
                    >
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Update
                    </button>
                    <Link
                        :href="route('customers.index')"
                        class="inline-block align-baseline font-bold text-sm text-red-500 hover:text-red-800"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
