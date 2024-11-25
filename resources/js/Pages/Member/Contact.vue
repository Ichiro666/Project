<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
window.scrollTo(0, 0);
</script>
<template>
    <MemberLayout>
        <section class="flex flex-col mt-20">
            <judul class="mx-8 text-center text-xl font-bold">
                Contact Us
            </judul>
            <judul2 class="mx-8 text-center text-4xl font-bold">
                Let's Start a Conversation
            </judul2>
            <isi
                class="mx-auto mt-4 w-[90%] leading-6 text-center text-slate-500"
            >
                If you have any questions, feedback, or need assistance, we're
                here to help! Feel free to reach out to us via email at
                hrd.orimoza@gmail.com, call us at +62 858-0028-0950, or visit us
                at Jl. Raya Sanggrahan Jl. Watuburik, Geplukan, Wonorejo, Kec.
                Gondangrejo, Kabupaten Karanganyar, Jawa Tengah 57188,
                Indonesia. We value your input and are committed to providing
                you with the best possible service. Let us know how we can
                assist you!
            </isi>

            <input
                type="Name"
                placeholder="Full Name"
                class="mt-8 border-zinc-600 rounded-md border border-solid border-opacity-50 w-full p-8"
            />

            <input
                type="Email"
                placeholder="Your Email"
                class="mt-4 border-zinc-600 rounded-md border border-solid border-opacity-50 w-full p-8"
            />

            <div
                class="mt-4 border-zinc-600 rounded-md border border-solid border-opacity-0 flex flex-shrink gap-4"
            >
                <select
                    id="citySelect"
                    class="border-zinc-600 text-slate-400 rounded-md border border-solid w-full border-opacity-50 p-8"
                >
                    <option value="">Kota</option>
                </select>

                <select
                    id="citySelect"
                    class="border-zinc-600 text-slate-400 rounded-md border border-solid w-full border-opacity-50 p-8"
                >
                    <option value="">Provinsi</option>
                </select>
            </div>

            <input
                type="Message"
                placeholder="Type Message"
                class="mt-4 border-zinc-600 rounded-md border border-solid border-opacity-50 w-full p-8"
            />

            <button
                class="bg-green-500 mt-4 p-4 rounded-md text-2xl font-bold hover:bg-green-600 hover:text-white transition duration-150 ease-in-out"
            >
                Send Message
            </button>
        </section>
    </MemberLayout>
</template>
