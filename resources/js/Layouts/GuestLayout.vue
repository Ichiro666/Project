<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div>
        <!-- Add CSRF Token meta tag -->
        <meta name="csrf-token" :content="$page.props.csrf_token" />

        <div
            class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
        >
            <div>
                <Link href="/">
                    <ApplicationLogo
                        class="h-20 w-20 fill-current text-gray-500"
                    />
                </Link>
            </div>

            <div
                class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
