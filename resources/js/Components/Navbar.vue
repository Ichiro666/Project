<script setup>
import { usePage, Link } from "@inertiajs/vue3";

const { props } = usePage();
const isLoggedIn = props.auth?.user !== null; // Cek apakah user telah login
</script>

<template>
    <main class="mt-[80px]">
        <nav
            class="bg-white px-12 pe-24 w-full h-[80px] fixed top-0 z-50 bg-x-black flex items-center justify-between shadow-md"
        >
            <!-- Bagian Kiri: Logo -->
            <div class="flex items-center pl-4">
                <img
                    src="../Pages/images/orimoza.png"
                    alt="Logo"
                    class="h-8 w-full"
                />
                <span class="ml-2 text-2xl font-bold text-black">
                    <b>Orimoza</b>
                </span>
            </div>

            <!-- Bagian Tengah: Navbar Links -->
            <div class="hidden md:flex space-x-8">
                <a
                    href="/home"
                    class="text-black hover:text-green-500 text-base"
                    >Home</a
                >
                <a
                    href="/shop"
                    class="text-black hover:text-green-500 text-base"
                    >Shop</a
                >
                <a
                    href="/catalog"
                    class="text-black hover:text-green-500 text-base"
                    >Catalog</a
                >
                <a
                    href="/tentang"
                    class="text-black hover:text-green-500 text-base"
                    >About</a
                >
                <a
                    href="/contact"
                    class="text-black hover:text-green-500 text-base"
                    >Contact</a
                >
            </div>

            <!-- Bagian Kanan -->
            <!-- Bagian Kanan -->
            <div class="flex space-x-6 items-center">
                <!-- Tombol Login -->
                <template v-if="!isLoggedIn">
                    <Link
                        href="/login"
                        class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded"
                    >
                        Login
                    </Link>
                </template>

                <!-- Icon setelah Login -->
                <template v-else>
                    <Link
                        href="/cart"
                        class="text-gray-700 hover:text-green-700"
                    >
                        <!-- Cart Icon -->
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
                    </Link>
                    <Link
                        :href="route('profil')"
                        class="text-gray-700 hover:text-green-700"
                    >
                        <!-- Profile Icon -->
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"
                            />
                            <path
                                d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z"
                            />
                        </svg>
                    </Link>
                    <Link
                        :href="route('logout')"
                        method="post"
                        class="text-gray-700 hover:text-green-700 flex items-center"
                        @click.prevent
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <path d="m13 16 5-4-5-4v3H4v2h9z"></path>
                            <path
                                d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"
                            ></path>
                        </svg>
                    </Link>
                </template>
            </div>
        </nav>
    </main>
</template>
