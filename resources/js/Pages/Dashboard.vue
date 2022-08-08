<template>
    <Head title="Tableau de bord" />

    <BreezeAuthenticatedLayout class="relative">
        <template #header>
            <div>
                <NavBar class="fixed z-10"></NavBar>
            </div>
        </template>

        <div class="-order-1 flex max-h-[54rem] z-20">

            <NavBarL class="fixed top-0 z-20" @updateResponse="(data) => updateResponse(data)" @parent="(data) => this.parent_id = data"></NavBarL>

            <section class="text-white w-9/12 absolute left-80 top-16">
                <div class="container px-5 py-5 mx-auto">
                    <div class="flex flex-wrap -m-4">

                        <div v-for="response in responses" class="p-4 md:w-1/3 h-[25em]">
                            <div @click="copyText(response)" class="h-full border-2 bg-gray-800 border-gray-20 rounded-lg overflow-y-auto">
                                <div class="w-full">
                                    <div class="w-full flex p-2 justify-center">
                                        <div class="pl-2 pt-2">
                                            <h1 class="font-bold text-xl text-center">{{ response.titre }}</h1>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="p-4">
                                    <div class="flex items-center flex-wrap">
                                        <p v-for="line in response.contenu.split('\n')" class="text-white font-normal w-full">
                                            {{ line }}<br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <div v-if="this.parent_id !== null" class="flex mr-4 items-center fixed bottom-3 right-3 animate-bounce">
                <button @click="openModal = true" aria-label="dashboard" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto ease-in duration-300 hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm relative flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
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
        updateResponse (data = null) {
            if (data) {
                this.responses = data
            } else {
                this.responses = this.$page.props.responseTypes
            }
        },
         copyText (data) {
            const text = data.contenu.split('\n')
            let textFormated = ''
            text.forEach(line => {
                textFormated += line + '\n\n'
            })
             navigator.clipboard.writeText(textFormated)

             axios.patch('response/rating', {
                 id: data.id
             })
             .then(() => {
                 this.$notify({
                     title: "Copie effectuée avec succès",
                     type: 'success',
                     duration: 3000,
                 });
             })
             .catch(error => {
                 console.log(error)
             })
        },
        addRT (data) {
            if (data) {
                this.responses.push(data)
            }
            this.openModal = false
        }
    },
}
</script>
