<template>
    <Head title="Tableau de bord" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div>
                <NavBar></NavBar>
            </div>
        </template>

        <div class="-order-1 flex max-h-[54rem] relative">

            <NavBarL></NavBarL>

                <section class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-4 py-12 absolute left-64">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div
                            class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center"
                        >
                            <div class="mb-8">
                                <div class="radial-progress bg-accent text-accent-content border-4 border-accent" style="--size:7rem; --value: 70">70%</div>
                            </div>
                            <div class="text-center">
                                <p class="text-xl text-white font-bold mb-2">PHP</p>
                                <p class="text-base text-gray-400 font-normal">________________________________________</p>
                            </div>
                        </div>

                        <div
                            class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center"
                        >
                            <div class="mb-8">
                                <div class="radial-progress bg-accent text-accent-content border-4 border-accent" style="--size:7rem; --value: 90">90%</div>
                            </div>
                            <div class="text-center">
                                <p class="text-xl text-white font-bold mb-2">Java</p>
                                <p class="text-base text-gray-400 font-normal">________________________________________</p>
                            </div>
                        </div>

                        <div
                            class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center"
                        >
                            <div class="mb-8">
                                <div class="radial-progress bg-accent text-accent-content border-4 border-accent" style="--size:7rem; --value: 80">80%</div>
                            </div>
                            <div class="text-center">
                                <p class="text-xl text-white font-bold mb-2">JavaScript</p>
                                <p class="text-base text-gray-400 font-normal">________________________________________</p>
                            </div>
                        </div>

                        <div
                            class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center"
                        >
                            <div class="mb-8">
                                <div class="radial-progress bg-accent text-accent-content border-4 border-accent" style="--size:7rem; --value: 60">60%</div>
                            </div>
                            <div class="text-center">
                                <p class="text-xl text-white font-bold mb-2">React</p>
                                <p class="text-base text-gray-400 font-normal">________________________________________</p>
                            </div>
                        </div>

                        <div
                            class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center"
                        >
                            <div class="mb-8">
                                <div class="radial-progress bg-accent text-accent-content border-4 border-accent" style="--size:7rem; --value: 70">70%</div>
                            </div>
                            <div class="text-center">
                                <p class="text-xl text-white font-bold mb-2">VueJS</p>
                                <p class="text-base text-gray-400 font-normal">________________________________________</p>
                            </div>
                        </div>

                        <div
                            class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center"
                        >
                            <div class="mb-8">
                                <div class="radial-progress bg-accent text-accent-content border-4 border-accent" style="--size:7rem; --value: 85">85%</div>
                            </div>
                            <div class="text-center">
                                <p class="text-xl text-white font-bold mb-2">HTML/CSS</p>
                                <p class="text-base text-gray-400 font-normal">________________________________________</p>
                            </div>
                        </div>
                    </div>
                </section>
        </div>
    </BreezeAuthenticatedLayout>
</template>


<script>
import {Inertia} from "@inertiajs/inertia";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import NavBar from "@/Components/NavBar.vue";
import NavBarL from "@/Components/NavBarL.vue";

export default {
    components: {
        BreezeAuthenticatedLayout,
        NavBarL,
        NavBar,
        Head
    },
    data () {
        return {
            //
        }
    },
    methods: {
    },
}
</script>
