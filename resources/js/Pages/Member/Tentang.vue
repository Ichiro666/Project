<script setup>
import MemberLayout from "@/Layouts/MemberLayout.vue";
</script>
<template>
    <MemberLayout>
        <section class="flex flex-col w-full mt-16 justify-center">
            <div class="w-[100%] px-16 mx-auto py-16">
                <img
                    class="w-full rounded-lg shadow-2xl"
                    src="../images/Hero/oriori.jpg"
                />
                <div class="absolute bg-cover bg-left-top">
                    <img
                        class="scale-[90%] -translate-y-20 shadow-lg translate-x-10 rounded-md"
                        src="../images/Hero/orimoz-about.jpeg"
                    />
                </div>
            </div>

            <div
                class="w-[80%] bg-teal-600 mx-auto p-10 mt-20 rounded-md shadow-xl"
            >
                <div class="flex justify-center items-center px-16">
                    <ul>
                        <li class="text-4xl font-bold text-center">About Us</li>
                        <li class="text-lg font-medium text-justify mt-4">
                            Orimoza adalah perusahaan retail yang berbasis di
                            Solo, Jawa Tengah, dengan fokus pada kebutuhan
                            sehari-hari dan produk gaya hidup. Orimoza
                            berkomitmen untuk memberikan pengalaman belanja yang
                            nyaman dan produk berkualitas dengan harga
                            terjangkau. Kami memiliki tiga cabang utama yang
                            tersebar di wilayah Karanganyar, Sragen, dan
                            Sukoharjo, menjangkau pelanggan dari berbagai
                            kalangan.
                        </li>
                        <li class="text-lg font-medium text-justify mt-4">
                            Kami memiliki visi, yakni Menjadi pelopor retail
                            modern di Jawa Tengah yang mengutamakan kepuasan
                            pelanggan dan inovasi dalam layanan.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-full bg-teal-600 rounded-md shadow-xl mt-20">
                <div class="flex justify-center items-center p-16 gap-16">
                    <div class="mx-auto">
                        <ul>
                            <li class="text-3xl font-bold">Misi Kami :</li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Memberikan produk berkualitas dengan harga
                                kompetitif.
                            </li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Memperluas jangkauan pelayanan untuk memenuhi
                                kebutuhan masyarakat loka
                            </li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Mengedepankan teknologi dalam proses operasional
                                dan pengalaman pelanggan.
                            </li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Membangun hubungan yang kuat dengan mitra lokal
                                untuk mendukung pertumbuhan ekonomi daerah.
                            </li>
                        </ul>
                    </div>
                    <div
                        class="shrink-0 w-px border justify-center items-center border-solid mx-16 opacity-40 bg-zinc-500 border-zinc-500 h-[310px]"
                    ></div>
                    <div class="mx-auto">
                        <ul>
                            <li class="text-3xl font-bold">
                                Nilai-nilai Kami :
                            </li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Kualitas: Mengutamakan standar tinggi untuk
                                semua produk.
                            </li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Pelayanan: Memberikan pengalaman belanja yang
                                ramah dan nyaman.
                            </li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Inovasi: Menerapkan teknologi terbaru untuk
                                efisiensi dan kepuasan pelanggan.
                            </li>
                            <li
                                class="list-disc text-lg font-medium text-justify mt-4"
                            >
                                Komunitas: Berkontribusi pada pertumbuhan dan
                                kesejahteraan masyarakat sekitar.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </MemberLayout>
</template>
