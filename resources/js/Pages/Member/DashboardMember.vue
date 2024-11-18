<script setup>
import { ref } from "vue";
import MemberLayout from "@/Layouts/MemberLayout.vue";

// Define reactivity directly with ref in <script setup>
const showFullDescription = ref(false);
</script>
<template>
    <MemberLayout>
        <div class="w-full overflow-hidden h-full">
            <div class="flex transition-transform duration-700">
                <div class="flex-shrink-0 w-full h-[553px]">
                    <img
                        src=""
                        alt="Gambar 1"
                        class="w-full h-full object-cover"
                    />
                    <div
                        class="absolute inset-0 flex justify-center items-center"
                    >
                        <div class="text-center">
                            <h1
                                class="text-4xl md:text-6xl font-bold text-white mb-4"
                            >
                                Selamat Datang di Orimoza
                            </h1>
                            <p class="text-lg md:text-2xl text-white mb-6">
                                Temukan fashion terbaru dan terbaik hanya untuk
                                Anda!
                            </p>
                            <router-link to="/shop">
                                <button
                                    class="bg-green-700 hover:bg-green-500 text-white font-semibold px-6 py-3 rounded-lg"
                                >
                                    Belanja Sekarang
                                </button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center px-10 py-12">
                <h1 class="text-xl font-semibold">PRODUCT</h1>
            </div>
            <div class="flex justify-center gap-10 mb-10">
                <button
                    href="/catalog"
                    class="bg-green-700 hover:bg-green-500 text-white font-semibold px-10 py-3 rounded-full"
                >
                    Blouse / Kemeja
                </button>
                <button
                    href="/catalog"
                    class="bg-green-700 hover:bg-green-500 text-white font-semibold px-10 py-3 rounded-full"
                >
                    Tunik
                </button>
                <button
                    href="/catalog"
                    class="bg-green-700 hover:bg-green-500 text-white font-semibold px-10 py-3 rounded-full"
                >
                    Rok / Skirt
                </button>
                <button
                    href="/catalog"
                    class="bg-green-700 hover:bg-green-500 text-white font-semibold px-10 py-3 rounded-full"
                >
                    Jaket / Rompi
                </button>
                <button
                    href="/catalog"
                    class="bg-green-700 hover:bg-green-500 text-white font-semibold px-10 py-3 rounded-full"
                >
                    Celana
                </button>
            </div>
            <!-- Our Popular Items -->
            <div class="flex px-6 py-3 mt-8">
                <h1 class="text-xl mb-5 font-semibold">Our Popular Items</h1>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-5 py-10 bg-white"
            >
                <!-- Produk 1 -->
                <div
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <img
                        src=""
                        alt="Rok-1"
                        class="h-64 w-full object-cover rounded-md mb-4"
                    />
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Orimoza Rok Jeans Skirt Theana
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp96.000
                    </p>
                    <button
                        class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                    >
                        Checkout
                    </button>
                </div>

                <!-- Produk 2 -->
                <div
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <img
                        src=""
                        alt="Rok-1"
                        class="h-64 w-full object-cover rounded-md mb-4"
                    />
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Orimoza Rok Jeans Skirt Theana
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp96.000
                    </p>
                    <button
                        class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                    >
                        Checkout
                    </button>
                </div>

                <!-- Produk 3 -->
                <div
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <img
                        src=""
                        alt="Rok-1"
                        class="h-64 w-full object-cover rounded-md mb-4"
                    />
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Orimoza Rok Jeans Skirt Theana
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp96.000
                    </p>
                    <button
                        class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                    >
                        Checkout
                    </button>
                </div>
            </div>
            <div class="flex py-6 px-3 justify-center">
                <button
                    class="mt-5 rounded py-2 px-4 bg-green-700 text-white hover:bg-green-500"
                >
                    Explore More
                </button>
            </div>
            <!-- End Our Popular Items -->

            <!-- Rekomendasi -->
            <div class="flex px-6 py-3 mt-8">
                <h1 class="text-xl mb-5 font-semibold">Rekomendasi</h1>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-5 py-10 bg-white"
            >
                <!-- Produk 1 -->
                <div
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <img
                        src=""
                        alt="Rok-2"
                        class="h-64 w-full object-cover rounded-md mb-4"
                    />
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Orimoza Rok Span Knit Hornet Wanita Renna
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp96.000
                    </p>
                    <button
                        class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                    >
                        Checkout
                    </button>
                </div>

                <!-- Produk 2 -->
                <div
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <img
                        src=""
                        alt="Rok-2"
                        class="h-64 w-full object-cover rounded-md mb-4"
                    />
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Orimoza Rok Span Knit Hornet Wanita Renna
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp96.000
                    </p>
                    <button
                        class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                    >
                        Checkout
                    </button>
                </div>

                <!-- Produk 3 -->
                <div
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <img
                        src=""
                        alt="Rok-2"
                        class="h-64 w-full object-cover rounded-md mb-4"
                    />
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Orimoza Rok Span Knit Hornet Wanita Renna
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp96.000
                    </p>
                    <button
                        class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                    >
                        Checkout
                    </button>
                </div>
            </div>
            <div class="flex py-6 px-3 justify-center">
                <button
                    class="mt-5 rounded py-2 px-4 bg-green-700 text-white hover:bg-green-500"
                >
                    Explore More
                </button>
            </div>
            <!-- End Rekomendasi -->
        </div>
        <div class="flex px-6 py-3 mt-8">
            <h1 class="text-xl mb-5 font-semibold">Deskripsi Toko</h1>
        </div>
        <div class="px-6">
            <p class="text-gray-700 leading-relaxed">
                <span v-if="showFullDescription">
                    Orimoza adalah toko fashion yang berfokus pada pakaian
                    berkualitas tinggi dengan harga terjangkau. Kami menyediakan
                    berbagai macam produk fashion yang up-to-date dengan tren
                    terkini, mulai dari pakaian kasual hingga formal. Setiap
                    produk dirancang dengan cermat untuk memberikan kenyamanan
                    dan kepercayaan diri kepada para pelanggan. Di Orimoza, kami
                    berkomitmen untuk memberikan pengalaman belanja yang mudah,
                    menyenangkan, dan memuaskan. Kami selalu berusaha menjadi
                    pilihan utama bagi pelanggan yang mencari pakaian stylish
                    dan modern.
                </span>
                <span v-else>
                    Orimoza adalah toko fashion yang berfokus pada pakaian
                    berkualitas tinggi dengan harga terjangkau. Kami menyediakan
                    berbagai macam produk fashion...
                </span>
            </p>
            <button
                @click="showFullDescription = !showFullDescription"
                class="mt-3 text-green-500 font-semibold hover:underline"
            >
                {{
                    showFullDescription
                        ? "Tampilkan Lebih Sedikit"
                        : "Lihat Selengkapnya"
                }}
            </button>
        </div>
    </MemberLayout>
</template>
