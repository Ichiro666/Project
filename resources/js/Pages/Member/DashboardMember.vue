<script setup>
import { ref, computed } from "vue";
import MemberLayout from "@/Layouts/MemberLayout.vue";
import { Link } from "@inertiajs/vue3";

// Define props untuk menerima data produk dari controller
const props = defineProps({
    products: Array,
});

// Predefined categories
const categories = [
    { id: "blouse", name: "Blouse / Kemeja" },
    { id: "tunik", name: "Tunik" },
    { id: "rok", name: "Rok / Skirt" },
    { id: "jaket", name: "Jaket / Rompi" },
    { id: "celana", name: "Celana" },
];

// Computed property untuk popular items (berdasarkan total_sold)
const popularItems = computed(() => {
    if (!props.products) return [];

    return [...props.products]
        .sort((a, b) => (b.total_sold || 0) - (a.total_sold || 0))
        .slice(0, 3); // Ambil 3 produk terlaris
});

// Computed property untuk recommended items (berdasarkan rating)
const recommendedItems = computed(() => {
    if (!props.products) return [];

    return [...props.products]
        .sort((a, b) => (Number(b.rating) || 0) - (Number(a.rating) || 0))
        .slice(0, 3); // Ambil 3 produk dengan rating tertinggi
});

// Format rating function
const formatRating = (rating) => {
    const numRating = Number(rating);
    return isNaN(numRating) ? "0.0" : numRating.toFixed(1);
};

const showFullDescription = ref(false);
</script>

<template>
    <MemberLayout>
        <div class="w-full overflow-hidden h-full">
            <!-- Hero Section -->
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

            <!-- Categories Section -->
            <div class="flex justify-center px-10 py-12">
                <div class="flex space-x-4">
                    <Link
                        v-for="category in categories"
                        :key="category.id"
                        :href="route('catalog', { category: category.id })"
                        class="px-6 py-3 bg-gray-100 rounded-lg text-gray-700 hover:bg-green-500 hover:text-white transition-colors"
                    >
                        {{ category.name }}
                    </Link>
                </div>
            </div>

            <!-- Our Popular Items Section -->
            <div class="flex px-6 py-3 mt-8">
                <h1 class="text-xl mb-5 font-semibold">Our Popular Items</h1>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-5 py-10 bg-white"
            >
                <div
                    v-for="product in popularItems"
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
                            class="h-64 w-full bg-gray-200 flex items-center justify-center"
                        >
                            <span class="text-gray-400">No image</span>
                        </div>
                    </Link>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ product.name }}
                    </h3>
                    <div class="flex items-center mb-2">
                        <span class="text-sm text-gray-600 mr-2">
                            Terjual: {{ product.total_sold || 0 }}
                        </span>
                    </div>
                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp{{ product.price?.toLocaleString() }}
                    </p>
                    <div class="flex justify-between">
                        <Link
                            :href="route('detail', product.id)"
                            class="w-40 bg-green-700 text-white py-2 rounded-md hover:bg-green-600 transition duration-300 text-center"
                        >
                            View Details
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Rekomendasi Section -->
            <div class="flex px-6 py-3 mt-8">
                <h1 class="text-xl mb-5 font-semibold">Rekomendasi</h1>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-5 py-10 bg-white"
            >
                <div
                    v-for="product in recommendedItems"
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
                            class="h-64 w-full bg-gray-200 flex items-center justify-center"
                        >
                            <span class="text-gray-400">No image</span>
                        </div>
                    </Link>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ product.name }}
                    </h3>
                    <div class="flex items-center mb-2">
                        <div class="flex">
                            <template v-for="i in 5" :key="i">
                                <svg
                                    class="w-4 h-4"
                                    :class="
                                        i <= (Number(product.rating) || 0)
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
                        <span class="text-sm text-gray-600 ml-2">
                            {{ formatRating(product.rating) }}
                        </span>
                    </div>

                    <p class="text-lg text-green-700 font-bold mb-4">
                        Rp{{ product.price?.toLocaleString() }}
                    </p>

                    <div class="flex justify-between">
                        <Link
                            :href="route('detail', product.id)"
                            class="w-40 bg-green-700 text-white py-2 rounded-md hover:bg-green-600 transition duration-300 text-center"
                        >
                            View Details
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Store Description -->
            <div class="flex px-6 py-3 mt-8">
                <h1 class="text-xl mb-5 font-semibold">Deskripsi Toko</h1>
            </div>
            <div class="px-6">
                <p class="text-gray-700 leading-relaxed">
                    <span v-if="showFullDescription">
                        Orimoza adalah toko fashion yang berfokus pada pakaian
                        berkualitas tinggi dengan harga terjangkau. Kami
                        menyediakan berbagai macam produk fashion yang
                        up-to-date dengan tren terkini, mulai dari pakaian
                        kasual hingga formal. Setiap produk dirancang dengan
                        cermat untuk memberikan kenyamanan dan kepercayaan diri
                        kepada para pelanggan. Di Orimoza, kami berkomitmen
                        untuk memberikan pengalaman belanja yang mudah,
                        menyenangkan, dan memuaskan. Kami selalu berusaha
                        menjadi pilihan utama bagi pelanggan yang mencari
                        pakaian stylish dan modern.
                    </span>
                    <span v-else>
                        Orimoza adalah toko fashion yang berfokus pada pakaian
                        berkualitas tinggi dengan harga terjangkau. Kami
                        menyediakan berbagai macam produk fashion...
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
