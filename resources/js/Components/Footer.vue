<script setup>
import { Link } from "@inertiajs/vue3";

const currentYear = new Date().getFullYear();

const collections = [
    {
        name: "Blouse / Kemeja",
        route: "catalog",
        params: { category: "blouse" },
    },
    { name: "Tunik", route: "catalog", params: { category: "tunik" } },
    { name: "Rok / Skirt", route: "catalog", params: { category: "rok" } },
    { name: "Jaket / Rompi", route: "catalog", params: { category: "jaket" } },
    { name: "Celana", route: "catalog", params: { category: "celana" } },
];

const quickLinks = [
    { name: "Home", route: "home" },
    { name: "Shop", route: "shop" },
    { name: "About Us", route: "tentang" },
    { name: "Contact", route: "contact" },
];

const contactInfo = {
    address:
        "Jl. Raya Sanggrahan Jl. Watuburik, Geplukan, Wonorejo, Kec. Gondangrejo, Karanganyar",
    phone: "+62 858-0028-0950",
    email: "hrd.orimoza@gmail.com",
};
</script>

<template>
    <footer class="bg-gray-100 py-10 mt-8 border-t">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Section -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-green-700">
                        About Orimoza
                    </h2>
                    <div class="mb-4">
                        <img
                            src="../Pages/images/orimoza.png"
                            alt="Orimoza Logo"
                            class="h-12 mb-4"
                        />
                        <p class="text-gray-600 text-sm">
                            Orimoza adalah toko fashion yang berfokus pada
                            pakaian berkualitas tinggi dengan harga terjangkau.
                            Menyediakan berbagai macam produk fashion yang
                            up-to-date dengan tren terkini.
                        </p>
                    </div>
                    <Link
                        :href="route('tentang')"
                        class="text-green-600 hover:text-green-700 inline-flex items-center"
                    >
                        Learn More
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 ml-1"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>
                </div>

                <!-- Collections Section -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-green-700">
                        Our Collections
                    </h2>
                    <ul class="space-y-2">
                        <li
                            v-for="collection in collections"
                            :key="collection.name"
                        >
                            <Link
                                :href="
                                    route(collection.route, collection.params)
                                "
                                class="text-gray-600 hover:text-green-600 transition-colors"
                            >
                                {{ collection.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-green-700">
                        Quick Links
                    </h2>
                    <ul class="space-y-2">
                        <li v-for="link in quickLinks" :key="link.name">
                            <Link
                                :href="route(link.route)"
                                class="text-gray-600 hover:text-green-600 transition-colors"
                            >
                                {{ link.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-green-700">
                        Contact Us
                    </h2>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <svg
                                class="h-6 w-6 text-green-600 mt-1"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                            <span class="text-gray-600 text-sm">{{
                                contactInfo.address
                            }}</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg
                                class="h-6 w-6 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                />
                            </svg>
                            <a
                                :href="'tel:' + contactInfo.phone"
                                class="text-gray-600 hover:text-green-600"
                            >
                                {{ contactInfo.phone }}
                            </a>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg
                                class="h-6 w-6 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>
                            <a
                                :href="'mailto:' + contactInfo.email"
                                class="text-gray-600 hover:text-green-600"
                            >
                                {{ contactInfo.email }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <p class="text-center text-gray-500 text-sm">
                    © {{ currentYear }} Orimoza. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</template>
