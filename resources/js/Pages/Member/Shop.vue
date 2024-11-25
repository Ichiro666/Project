<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
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
                <!-- Contoh Produk -->
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <img
                        src=""
                        alt="Rok"
                        class="w-full h-40 object-cover rounded-md mb-4"
                    />
                    <h3 class="text-lg font-semibold">Rok Cantik</h3>
                    <p class="text-gray-700 mt-2">Rp150,000</p>
                    <div class="flex justify-between">
                        <button
                            class="w-40 bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                        >
                            Checkout
                        </button>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z"
                            ></path>
                            <circle cx="10.5" cy="19.5" r="1.5"></circle>
                            <circle cx="17.5" cy="19.5" r="1.5"></circle>
                        </svg>
                    </div>
                </div>
                <!-- Ulangi komponen ini untuk setiap jenis pakaian -->
            </div>
        </div>
    </MemberLayout>
</template>
