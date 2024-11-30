<script setup>
import { ref } from "vue";
import MemberLayout from "@/Layouts/MemberLayout.vue";

// Define reactivity directly with ref in <script setup>
const showFullDescription = ref(false);
</script>
<template>
    <MemberLayout>
        <div class="w-full overflow-hidden h-full">
            <div class="flex justify-between items-center relative px-10 pt-10">
                <!-- Container Gambar -->
                <div class="relative w-1/2 h-[553px] flex-shrink-0">
                    <!-- Gambar Herodown -->
                    <img
                        src="../images/Hero/herodown.png"
                        alt="Gambar Down"
                        class="absolute top-0 left-0 w-auto h-auto object-cover z-0"
                    />
                    <!-- Gambar Heroup -->
                    <img
                        src="../images/Hero/heroup.png"
                        alt="Gambar Up"
                        class="absolute top-10 left-10 w-auto h-auto object-cover z-10"
                    />
                </div>

                <!-- Container Teks -->
                <div class="w-1/2 px-8">
                    <h1 class="text-4xl md:text-6xl font-bold text-black mb-4">
                        "
                    </h1>
                    <p class="text-7xl md:text-2xl text-black">
                        I place the notion of creativity at the same level
                        asthat of craftsmanship, but both give way to the human
                        dimension that is at the heart of my work.
                    </p>
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
                <!-- Produk Card -->
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-lg p-6 bg-white transition-transform transform hover:scale-105 duration-300"
                >
                    <Link
                        :href="route('detail', product.id)"
                        class="cursor-pointer block"
                    >
                        <img
                            v-if="product.image"
                            :src="`/storage/${product.image}`"
                            :alt="product.name"
                            class="h-64 w-full object-cover rounded-md mb-4 hover:opacity-80 transition-opacity"
                        />
                        <div
                            v-else
                            class="h-64 w-full bg-gray-200 rounded-md mb-4 flex items-center justify-center"
                        >
                            <span class="text-gray-400">No image</span>
                        </div>
                    </Link>

                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ product.name }}
                    </h3>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp{{ product.price?.toLocaleString() }}
                    </p>
                    <div class="flex justify-between">
                        <button
                            class="w-40 bg-green-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                        >
                            Checkout
                        </button>
                    </div>
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

<style scoped>
.aspect-w-1 {
    position: relative;
    padding-bottom: 100%;
}

.aspect-w-1 > img {
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    object-fit: cover;
}

@media (max-width: 640px) {
    .grid {
        gap: 1rem;
    }
}
</style>
