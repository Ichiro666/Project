<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";

const provinces = ref([]);
const regencies = ref([]);
const districts = ref([]);
const villages = ref([]);

const selectedProvince = ref(null);
const selectedRegency = ref(null);
const selectedDistrict = ref(null);
const selectedVillage = ref(null);

const form = useForm({
    payment_method: "",
    card_number: "",
    shipping_address: "",
    province_id: "",
    regency_id: "",
    district_id: "",
    village_id: "",
    detailed_address: "",
    phone: "",
});

onMounted(async () => {
    // Load provinces on component mount
    const response = await fetch("/api/provinces");
    provinces.value = await response.json();
});

const loadRegencies = async (provinceId) => {
    const response = await fetch(`/api/provinces/${provinceId}/regencies`);
    regencies.value = await response.json();
    form.province_id = provinceId;
    form.regency_id = "";
    form.district_id = "";
    form.village_id = "";
};

const loadDistricts = async (regencyId) => {
    const response = await fetch(`/api/regencies/${regencyId}/districts`);
    districts.value = await response.json();
    form.regency_id = regencyId;
    form.district_id = "";
    form.village_id = "";
};

const loadVillages = async (districtId) => {
    const response = await fetch(`/api/districts/${districtId}/villages`);
    villages.value = await response.json();
    form.district_id = districtId;
    form.village_id = "";
};

const submitCheckout = () => {
    form.post(route("checkout.store"));
};
</script>

<template>
    <MemberLayout>
        <div class="max-w-4xl mx-auto p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>

            <form @submit.prevent="submitCheckout" class="space-y-8">
                <!-- Shipping Address Section -->
                <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        Shipping Address
                    </h2>

                    <!-- Province Selection -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2"
                            >Province</label
                        >
                        <select
                            v-model="selectedProvince"
                            @change="loadRegencies(selectedProvince)"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            required
                        >
                            <option value="">Select Province</option>
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
                        <label class="block text-gray-700 font-medium mb-2"
                            >City/Regency</label
                        >
                        <select
                            v-model="selectedRegency"
                            @change="loadDistricts(selectedRegency)"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            required
                        >
                            <option value="">Select City/Regency</option>
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
                        <label class="block text-gray-700 font-medium mb-2"
                            >District</label
                        >
                        <select
                            v-model="selectedDistrict"
                            @change="loadVillages(selectedDistrict)"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            required
                        >
                            <option value="">Select District</option>
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
                        <label class="block text-gray-700 font-medium mb-2"
                            >Village</label
                        >
                        <select
                            v-model="form.village_id"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            required
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

                    <!-- Detailed Address -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2"
                            >Detailed Address</label
                        >
                        <textarea
                            v-model="form.detailed_address"
                            rows="3"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            placeholder="Street name, building number, etc."
                            required
                        ></textarea>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-2"
                            >Phone Number</label
                        >
                        <input
                            type="tel"
                            v-model="form.phone"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            placeholder="Enter your phone number"
                            required
                        />
                    </div>
                </div>

                <!-- Payment Method Section -->
                <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        Payment Method
                    </h2>

                    <div>
                        <select
                            v-model="form.payment_method"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                            required
                        >
                            <option value="">Select Payment Method</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cod">Cash on Delivery</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-green-600 text-white py-3 px-8 rounded-lg hover:bg-green-700 transition duration-300"
                    >
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </MemberLayout>
</template>
