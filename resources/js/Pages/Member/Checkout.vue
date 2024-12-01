<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { ref, onMounted, watch, computed } from "vue";
import { useForm, usePage } from "@inertiajs/vue3"; // Remove session, add usePage

// Add this to handle session
const { session } = usePage().props;

const props = defineProps({
    cartItems: Array,
});

const provinces = ref([]);
const regencies = ref([]);
const districts = ref([]);
const villages = ref([]);

const selectedProvince = ref("");
const selectedRegency = ref("");
const selectedDistrict = ref("");

const showPaymentDetails = ref(false);
const form = useForm({
    payment_method: "",
    bank_name: "",
    account_number: "",
    account_holder: "",
    customer_account: "",
    phone: "",
    shipping_address: "",
    province_id: "",
    regency_id: "",
    district_id: "",
    village_id: "",
    detailed_address: "",
    items:
        props.cartItems?.map((item) => ({
            product_id: item.product.id,
            quantity: item.quantity,
            size: item.size,
            price: item.product.price,
        })) || [],
});

// Payment method options with their details
const paymentMethods = {
    bank_transfer: [
        {
            name: "BCA",
            account: "1234567890",
            holder: "PT ORIMOZA FASHION",
            image: "../images/BCA.png",
        },
        {
            name: "BNI",
            account: "0987654321",
            holder: "PT ORIMOZA FASHION",
            image: "../images/BNI.png",
        },
        {
            name: "Mandiri",
            account: "2468135790",
            holder: "PT ORIMOZA FASHION",
            image: "../images/Mandiri.png",
        },
    ],
    cod: {
        note: "Cash payment will be collected upon delivery",
    },
};

// Watch payment method changes
watch(
    () => form.payment_method,
    (newValue) => {
        showPaymentDetails.value = !!newValue;
    }
);

// Computed property for total amount
const totalAmount = computed(() => {
    if (!props.cartItems || !props.cartItems.length) return 0;
    return props.cartItems.reduce((sum, item) => {
        return sum + item.product.price * item.quantity;
    }, 0);
});

// Load provinces on component mount
onMounted(async () => {
    try {
        const response = await fetch("/api/provinces");
        if (!response.ok) throw new Error("Failed to fetch provinces");
        provinces.value = await response.json();
    } catch (error) {
        console.error("Error loading provinces:", error);
    }
});

// Watch province changes to load regencies
watch(selectedProvince, async (provinceId) => {
    if (provinceId) {
        try {
            // Reset dependent fields
            regencies.value = [];
            districts.value = [];
            villages.value = [];
            selectedRegency.value = "";
            selectedDistrict.value = "";
            form.village_id = "";
            form.province_id = provinceId;

            const response = await fetch(
                `/api/provinces/${provinceId}/regencies`
            );
            if (!response.ok) throw new Error("Failed to fetch regencies");
            regencies.value = await response.json();
        } catch (error) {
            console.error("Error loading regencies:", error);
        }
    }
});

// Watch regency changes to load districts
watch(selectedRegency, async (regencyId) => {
    if (regencyId) {
        try {
            // Reset dependent fields
            districts.value = [];
            villages.value = [];
            selectedDistrict.value = "";
            form.village_id = "";
            form.regency_id = regencyId;

            const response = await fetch(
                `/api/regencies/${regencyId}/districts`
            );
            if (!response.ok) throw new Error("Failed to fetch districts");
            districts.value = await response.json();
        } catch (error) {
            console.error("Error loading districts:", error);
        }
    }
});

// Watch district changes to load villages
watch(selectedDistrict, async (districtId) => {
    if (districtId) {
        try {
            // Reset villages
            villages.value = [];
            form.village_id = "";
            form.district_id = districtId;

            const response = await fetch(
                `/api/districts/${districtId}/villages`
            );
            if (!response.ok) throw new Error("Failed to fetch villages");
            villages.value = await response.json();
        } catch (error) {
            console.error("Error loading villages:", error);
        }
    }
});

const submitCheckout = () => {
    // Compile the shipping address
    const shippingAddress = [
        form.detailed_address,
        villages.value.find((v) => v.id === form.village_id)?.name,
        districts.value.find((d) => d.id === form.district_id)?.name,
        regencies.value.find((r) => r.id === form.regency_id)?.name,
        provinces.value.find((p) => p.id === form.province_id)?.name,
    ]
        .filter(Boolean)
        .join(", ");

    form.shipping_address = shippingAddress;

    // Submit the order
    form.post(route("orders.store"), {
        onSuccess: () => {
            // Clear cart after successful order
            session().forget("cart");

            // Show success message
            alert("Order placed successfully!");

            // Redirect to orders page
            window.location.href = route("orders.index");
        },
        onError: (errors) => {
            console.error("Checkout failed:", errors);
            alert("Failed to place order. Please check your input.");
        },
    });
};
</script>

<template>
    <MemberLayout>
        <div class="min-h-screen bg-gray-50 py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left Column - Shipping Details -->
                    <div class="space-y-8">
                        <div class="bg-white p-8 rounded-2xl shadow-sm">
                            <h2
                                class="text-xl font-semibold text-gray-800 mb-6"
                            >
                                Shipping Address
                            </h2>

                            <!-- Address Selection -->
                            <div class="space-y-6">
                                <!-- Province Selection -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Province
                                    </label>
                                    <select
                                        v-model="selectedProvince"
                                        class="w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                        required
                                    >
                                        <option value="">
                                            Select Province
                                        </option>
                                        <option
                                            v-for="province in provinces"
                                            :key="province.id"
                                            :value="province.id"
                                        >
                                            {{ province.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Regency Selection -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        City/Regency
                                    </label>
                                    <select
                                        v-model="selectedRegency"
                                        class="w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                        required
                                        :disabled="!selectedProvince"
                                    >
                                        <option value="">
                                            Select City/Regency
                                        </option>
                                        <option
                                            v-for="regency in regencies"
                                            :key="regency.id"
                                            :value="regency.id"
                                        >
                                            {{ regency.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- District Selection -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        District
                                    </label>
                                    <select
                                        v-model="selectedDistrict"
                                        class="w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                        required
                                        :disabled="!selectedRegency"
                                    >
                                        <option value="">
                                            Select District
                                        </option>
                                        <option
                                            v-for="district in districts"
                                            :key="district.id"
                                            :value="district.id"
                                        >
                                            {{ district.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Village Selection -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Village
                                    </label>
                                    <select
                                        v-model="form.village_id"
                                        class="w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                        required
                                        :disabled="!selectedDistrict"
                                    >
                                        <option value="">Select Village</option>
                                        <option
                                            v-for="village in villages"
                                            :key="village.id"
                                            :value="village.id"
                                        >
                                            {{ village.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Street Address -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Street Address
                                    </label>
                                    <textarea
                                        v-model="form.detailed_address"
                                        rows="3"
                                        class="w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                        placeholder="Enter your complete address"
                                        required
                                    ></textarea>
                                </div>

                                <!-- Phone Number -->
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Phone Number
                                    </label>
                                    <input
                                        type="tel"
                                        v-model="form.phone"
                                        class="w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                        placeholder="Enter your phone number"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Order Summary & Payment -->
                    <div class="space-y-6">
                        <!-- Order Summary -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm">
                            <h2
                                class="text-xl font-semibold text-gray-800 mb-6"
                            >
                                Order Summary
                            </h2>

                            <!-- Cart Items -->
                            <div class="space-y-4 mb-6">
                                <div
                                    v-for="item in cartItems"
                                    :key="item.key"
                                    class="flex items-center space-x-4"
                                >
                                    <img
                                        v-if="item.product.image"
                                        :src="`/storage/${item.product.image}`"
                                        :alt="item.product.name"
                                        class="w-20 h-20 object-cover rounded-lg"
                                    />
                                    <div>
                                        <h3 class="font-medium">
                                            {{ item.product.name }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Qty: {{ item.quantity }} × Rp{{
                                                item.product.price.toLocaleString()
                                            }}
                                        </p>
                                    </div>
                                    <div class="ml-auto">
                                        <p class="font-medium">
                                            Rp{{
                                                (
                                                    item.product.price *
                                                    item.quantity
                                                ).toLocaleString()
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="border-t pt-4">
                                <div
                                    class="flex justify-between text-base font-medium text-gray-900"
                                >
                                    <p>Subtotal</p>
                                    <p>Rp{{ totalAmount.toLocaleString() }}</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">
                                    Shipping calculated at next step
                                </p>
                            </div>
                        </div>

                        <!-- Payment Method Section -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm">
                            <h2
                                class="text-xl font-semibold text-gray-800 mb-6"
                            >
                                Payment Method
                            </h2>

                            <!-- Payment Method Selection -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <button
                                    @click="
                                        form.payment_method = 'bank_transfer'
                                    "
                                    :class="[
                                        'p-4 border rounded-lg flex items-center justify-center gap-3 transition-colors',
                                        form.payment_method === 'bank_transfer'
                                            ? 'border-green-500 bg-green-50 text-green-700'
                                            : 'border-gray-200 hover:border-green-500',
                                    ]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                        />
                                    </svg>
                                    <span class="font-medium"
                                        >Bank Transfer</span
                                    >
                                </button>
                                <button
                                    @click="form.payment_method = 'cod'"
                                    :class="[
                                        'p-4 border rounded-lg flex items-center justify-center gap-3 transition-colors',
                                        form.payment_method === 'cod'
                                            ? 'border-green-500 bg-green-50 text-green-700'
                                            : 'border-gray-200 hover:border-green-500',
                                    ]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
                                        />
                                    </svg>
                                    <span class="font-medium"
                                        >Cash on Delivery</span
                                    >
                                </button>
                            </div>

                            <!-- Bank Transfer Details -->
                            <div
                                v-if="form.payment_method === 'bank_transfer'"
                                class="space-y-6"
                            >
                                <!-- Bank Selection Section -->
                                <div
                                    v-if="
                                        form.payment_method === 'bank_transfer'
                                    "
                                    class="space-y-6"
                                >
                                    <div class="bg-gray-50 p-6 rounded-lg">
                                        <h3
                                            class="text-lg font-medium text-gray-900 mb-4"
                                        >
                                            Select Bank
                                        </h3>
                                        <div class="space-y-4">
                                            <div
                                                v-for="bank in paymentMethods.bank_transfer"
                                                :key="bank.name"
                                                :class="[
                                                    'flex items-center justify-between p-4 border rounded-lg bg-white transition-colors',
                                                    form.bank_name === bank.name
                                                        ? 'border-green-500 ring-1 ring-green-500'
                                                        : 'border-gray-200',
                                                ]"
                                            >
                                                <div
                                                    class="flex items-center gap-4"
                                                >
                                                    <!-- Updated img src -->
                                                    <img
                                                        :src="bank.image"
                                                        :alt="bank.name"
                                                        class="h-8 w-auto object-contain"
                                                    />
                                                    <div>
                                                        <p
                                                            class="font-medium text-gray-900"
                                                        >
                                                            {{ bank.account }}
                                                        </p>
                                                        <p
                                                            class="text-sm text-gray-500"
                                                        >
                                                            a.n
                                                            {{ bank.holder }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <button
                                                    @click="
                                                        () => {
                                                            form.bank_name =
                                                                bank.name;
                                                            form.account_number =
                                                                bank.account;
                                                            form.account_holder =
                                                                bank.holder;
                                                        }
                                                    "
                                                    :class="[
                                                        'px-4 py-2 rounded-md text-sm font-medium transition-colors',
                                                        form.bank_name ===
                                                        bank.name
                                                            ? 'bg-green-600 text-white'
                                                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
                                                    ]"
                                                >
                                                    Select
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Customer Bank Details -->
                                <div
                                    v-if="form.bank_name"
                                    class="bg-gray-50 p-6 rounded-lg"
                                >
                                    <h3
                                        class="text-lg font-medium text-gray-900 mb-4"
                                    >
                                        Your Bank Information
                                    </h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700"
                                                >Your Bank Account Number</label
                                            >
                                            <input
                                                type="text"
                                                v-model="form.customer_account"
                                                class="mt-1 w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                                placeholder="Enter your account number"
                                                required
                                            />
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700"
                                                >Account Holder Name</label
                                            >
                                            <input
                                                type="text"
                                                v-model="form.account_holder"
                                                class="mt-1 w-full px-4 py-3 rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 bg-white shadow-sm"
                                                placeholder="Enter account holder name"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="mt-4 p-4 bg-yellow-50 rounded-lg"
                                    >
                                        <p class="text-sm text-yellow-800">
                                            Please make sure the account details
                                            are correct. Transfer proof will be
                                            required after placing the order.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- COD Details -->
                            <div
                                v-if="form.payment_method === 'cod'"
                                class="space-y-4"
                            >
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <h3
                                        class="text-lg font-medium text-gray-900 mb-2"
                                    >
                                        Cash on Delivery
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ paymentMethods.cod.note }}
                                    </p>

                                    <div
                                        class="mt-4 p-4 bg-yellow-50 rounded-lg"
                                    >
                                        <p class="text-sm text-yellow-800">
                                            Please prepare the exact amount when
                                            the delivery arrives. Our courier
                                            will verify the payment upon
                                            delivery.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button
                            @click="submitCheckout"
                            type="button"
                            class="w-full bg-green-600 text-white py-4 rounded-lg hover:bg-green-700 transition-colors duration-300 font-medium"
                            :disabled="
                                !form.village_id ||
                                !form.payment_method ||
                                !form.phone ||
                                !form.detailed_address ||
                                (form.payment_method === 'bank_transfer' &&
                                    (!form.bank_name ||
                                        !form.customer_account ||
                                        !form.account_holder))
                            "
                        >
                            <span v-if="form.processing">Processing...</span>
                            <span v-else>
                                {{
                                    !form.village_id || !form.payment_method
                                        ? "Complete Address and Payment Method"
                                        : form.payment_method ===
                                              "bank_transfer" && !form.bank_name
                                        ? "Select Bank Account"
                                        : "Place Order"
                                }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </MemberLayout>
</template>
