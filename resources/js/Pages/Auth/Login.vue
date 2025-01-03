<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const recaptchaSiteKey = ref("");

const form = useForm({
    _token: document.querySelector('meta[name="csrf-token"]')?.content,
    email: "",
    password: "",
    remember: false,
    "g-recaptcha-response": "",
});

// Add reCAPTCHA script
onMounted(() => {
    recaptchaSiteKey.value = import.meta.env.VITE_RECAPTCHA_SITE_KEY;

    if (!document.getElementById("recaptcha-script")) {
        const script = document.createElement("script");
        script.id = "recaptcha-script";
        script.src = "https://www.google.com/recaptcha/api.js";
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
});

const submit = () => {
    if (!form["g-recaptcha-response"]) {
        alert("Please complete the reCAPTCHA verification");
        return;
    }

    form.post(route("login"), {
        preserveScroll: true,
        onFinish: () => {
            form.reset("password");
            grecaptcha.reset();
        },
    });
};

// Global callback function for reCAPTCHA
window.onRecaptchaSuccess = (token) => {
    form["g-recaptcha-response"] = token;
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <!-- Status Message -->
        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <!-- Centered Form -->
        <div class="flex justify-center items-center bg-gray-100">
            <!-- Form with max width to prevent being too wide -->
            <form
                @submit.prevent="submit"
                class="w-full sm:max-w-md bg-white p-6 rounded-lg shadow-lg"
            >
                <h2
                    class="text-2xl font-semibold text-center text-gray-700 mb-6"
                >
                    Log in to Your Account
                </h2>

                <!-- Email Input -->
                <div>
                    <InputLabel
                        for="email"
                        value="Email"
                        class="text-lg text-gray-600"
                    />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError
                        class="mt-2 text-red-500"
                        :message="form.errors.email"
                    />
                </div>

                <!-- Password Input -->
                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="text-lg text-gray-600"
                    />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError
                        class="mt-2 text-red-500"
                        :message="form.errors.password"
                    />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="mt-6 flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-indigo-600 hover:text-indigo-800"
                    >
                        Forgot your password?
                    </Link>
                </div>

                <!-- Add reCAPTCHA before submit button -->
                <div class="mt-4">
                    <div
                        class="g-recaptcha"
                        :data-sitekey="recaptchaSiteKey"
                        data-callback="onRecaptchaSuccess"
                    ></div>
                    <InputError
                        class="mt-2"
                        :message="form.errors['g-recaptcha-response']"
                    />
                </div>

                <!-- Forgot Password Link -->
                <div class="mt-4 flex justify-between items-center">
                    <!-- Register Button -->
                    <Link
                        :href="route('register')"
                        class="px-6 py-3 text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200 ease-in-out mt-4 w-auto"
                    >
                        Register
                    </Link>

                    <!-- Submit Button -->
                    <PrimaryButton
                        class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out mt-4 w-auto"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
