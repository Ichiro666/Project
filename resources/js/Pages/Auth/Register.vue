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
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
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

    form.post(route("register"), {
        preserveScroll: true,
        onFinish: () => {
            form.reset("password", "password_confirmation");
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
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
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

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
