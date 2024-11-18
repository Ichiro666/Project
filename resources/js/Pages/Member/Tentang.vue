<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
</script>
<template>
    <MemberLayout>
        <div class="flex justify-center items-center min-h-screen bg-gray-100">
            <!-- Container Utama -->
            <div class="px-6 py-10 bg-white max-w-4xl w-full mx-auto">
                <!-- Tentang Kami -->
                <section class="mb-8 text-center">
                    <h2 class="text-3xl font-semibold text-green-600 mb-6">
                        Tentang Kami
                    </h2>
                    <p
                        class="text-brown-700 leading-relaxed text-lg max-w-3xl mx-auto"
                    >
                        Orimoza adalah perusahaan yang bergerak di bidang
                        e-commerce fashion, menghadirkan produk berkualitas
                        dengan desain menarik untuk memenuhi kebutuhan mode
                        pelanggan kami.
                    </p>
                </section>

                <!-- Visi dan Misi -->
                <section class="mb-8 text-center">
                    <h2 class="text-3xl font-semibold text-green-600 mb-6">
                        Visi dan Misi
                    </h2>
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-green-500">
                            Visi
                        </h3>
                        <p class="text-brown-700 text-lg">
                            Menjadi merek fashion terdepan yang menginspirasi
                            gaya dan kualitas hidup pelanggan kami di seluruh
                            Indonesia.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-green-500">
                            Misi
                        </h3>
                        <ul
                            class="list-disc pl-6 text-brown-700 text-lg inline-block text-left"
                        >
                            <li>
                                Menyediakan produk fashion yang inovatif dan
                                berkualitas tinggi.
                            </li>
                            <li>
                                Membangun hubungan yang kuat dan berkelanjutan
                                dengan pelanggan.
                            </li>
                            <li>
                                Mendukung keberlanjutan dan etika dalam setiap
                                tahap produksi kami.
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Informasi Kontak -->
                <section class="mb-8 text-center">
                    <h2 class="text-3xl font-semibold text-green-600 mb-6">
                        Informasi Kontak
                    </h2>
                    <p class="text-brown-700 text-lg mb-4">
                        <strong>Alamat:</strong> Jl. Fashion No. 123, Jakarta
                    </p>
                    <p class="text-brown-700 text-lg mb-4">
                        <strong>Email:</strong> support@orimoza.com
                    </p>
                    <p class="text-brown-700 text-lg mb-4">
                        <strong>Telepon:</strong> +62 812 3456 7890
                    </p>
                    <div class="flex justify-center">
                        <a
                            href="mailto:support@orimoza.com"
                            class="inline-block bg-brown-700 text-green-700 py-2 px-6 rounded-lg shadow-md hover:bg-brown-800 transition duration-300"
                        >
                            Hubungi Kami
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </MemberLayout>
</template>
