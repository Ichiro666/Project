<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    customers: Array,
});

const form = useForm({});

const deleteCustomer = (customerId) => {
    if (confirm("Are you sure you want to delete this customer?")) {
        form.delete(route("customers.destroy", customerId));
    }
};
</script>

<template>
    <Head title="Customers" />
    <AuthenticatedLayout>
        <div class="mt-6 mx-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold text-gray-700">
                    Customer List
                </h1>
                <Link
                    :href="route('customers.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Add Customer
                </Link>
            </div>
            <div class="overflow-x-auto">
                <table
                    class="w-full border border-gray-200 rounded-lg shadow-md"
                >
                    <thead class="bg-gray-100">
                        <tr>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                ID
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Name
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Email
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Category Member
                            </th>
                            <th
                                class="py-3 px-4 text-left text-gray-600 font-medium border-b"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="customer in customers" :key="customer.id">
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ customer.id }}
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ customer.name }}
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ customer.email }}
                            </td>
                            <td class="py-3 px-4 border-b text-gray-700">
                                {{ customer.category }}
                            </td>
                            <td class="py-3 px-4 border-b flex gap-2">
                                <Link
                                    :href="route('customers.show', customer.id)"
                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded text-sm"
                                >
                                    Show
                                </Link>
                                <Link
                                    :href="route('customers.edit', customer.id)"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded text-sm"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded text-sm"
                                    @click="deleteCustomer(customer.id)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
