<template>
    <Head title="Tableau de bord" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div>
                <NavBar></NavBar>
            </div>
        </template>

        <div class="-order-1 flex max-h-[54rem] relative">

            <NavBarL @parent="(data) => this.parent_id = data"></NavBarL>

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
            <div class="flex mr-4 items-center fixed bottom-3 right-3">
                <button @click="openModal = true" aria-label="dashboard" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm relative flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    <span class="-mr-1 font-medium">Ajouter une RT</span>
                </button>
            </div>
        </div>
        <ModalCreateResponse
            v-if="openModal"
            :parent_id = "this.parent_id"
            @closeConfirm="this.openModal = false"
        />
    </BreezeAuthenticatedLayout>
</template>


<script>
import {Inertia} from "@inertiajs/inertia";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import NavBar from "@/Components/NavBar.vue";
import NavBarL from "@/Components/NavBarL.vue";
import ModalCreateResponse from "@/Components/Modals/ModalCreateResponse.vue";

export default {
    components: {
        ModalCreateResponse,
        BreezeAuthenticatedLayout,
        NavBarL,
        NavBar,
        Head
    },
    data () {
        return {
            openModal: false,
            parent_id: null
        }
    },
    methods: {
    },
}
</script>
