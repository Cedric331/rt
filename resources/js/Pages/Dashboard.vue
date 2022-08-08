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

            <section class="text-white body-font w-full">
                <div class="container px-5 py-5 mx-auto">
                    <div class="flex flex-wrap -m-4">

                        <div v-for="response in responses" class="p-4 md:w-1/3 h-[25em]">
                            <div class="h-full border-2 bg-gray-800 border-gray-200 rounded-lg overflow-hidden">
                                <div class="w-full">
                                    <div class="w-full flex p-2">
                                        <div class="pl-2 pt-2 ">
                                            <h1 class="font-bold">{{ response.titre }}</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center flex-wrap ">
                                        <p class="inline-flex items-center">{{ response.contenu }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

<!--                <section class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-4 py-12 absolute left-64">-->
<!--                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">-->

<!--                        <div v-for="response in responses">-->
<!--                            <div class="w-full bg-gray-900 rounded-lg sahdow-lg p-12 flex flex-col justify-center items-center">-->
<!--                                <div class="mb-8">-->
<!--                                    <div class="radial-progress bg-accent text-accent-content border-4 border-accent" style="&#45;&#45;size:7rem; &#45;&#45;value: 70">70%</div>-->
<!--                                </div>-->
<!--                                <div class="text-center">-->
<!--                                    <p class="text-xl text-white font-bold mb-2">{{response.titre}}</p>-->
<!--                                    <hr>-->
<!--                                    <p class="text-base text-white font-normal">{{response.contenu}}</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

<!--                    </div>-->
<!--                </section>-->
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
            @closeConfirm="(data) => addRT(data)"
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
            responses: this.$page.props.responseTypes,
            parent_id: null
        }
    },
    methods: {
        addRT (data) {
            this.openModal = false
            this.responses.push(data)
        }
    },
}
</script>
