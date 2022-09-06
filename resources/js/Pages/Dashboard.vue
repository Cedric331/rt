<template>
    <Head title="RT Gujan" />
    <VideoComponent :src="urlVideo" :key="keyComponent"></VideoComponent>

    <BreezeAuthenticatedLayout class="relative">

        <template #header>
            <div>
                <NavBar class="fixed z-10"
                        @refreshBackground="this.refreshVideo()"
                        @search="(data, bool) => search(data, bool)"
                        @openChart="this.openChart = true"
                        @openTeam="this.openTeam = true">
                </NavBar>
            </div>
        </template>

        <div class="-order-1 flex max-h-[54rem] z-20">
            <NavBarL class="fixed top-0 z-20"
                     @updateResponse="(data) => updateResponse(data)"
                     @parent="(data) => this.parent_id = data">
            </NavBarL>
            <section class="text-white w-9/12 absolute left-80 top-16">
                <div class="container px-5 py-5 mx-auto">
                    <div class="flex flex-wrap -m-4">

                        <div v-for="response in responses" class="p-4 md:w-1/3 h-[25em] hover:drop-shadow-2xl">
                            <div class="h-full border-2 bg-gray-800 border-gray-20 rounded-lg overflow-y-auto">
                                <div class="w-full flex justify-between">
                                    <div class="w-full flex p-2">
                                        <div class="pl-2 pt-2">
                                            <h1 class="font-bold text-xl text-center">{{ response.titre }}</h1>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">

                                        <button @click="updateRt(response)" aria-label="dashboard" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button @click="this.confirmDelete = true; this.dataRt = response" aria-label="dashboard" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                                <hr>
                                <div @click="copyText(response)" class="p-4 h-5/6">
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
            <div v-if="this.parent_id !== null" class="flex mr-4 items-center fixed bottom-3 right-10 animate-bounce">
                <button @click="openModalRt()" aria-label="dashboard" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto ease-in duration-300 hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm relative flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    <span class="-mr-1 font-medium">Ajouter une RT</span>
                </button>
            </div>
        </div>

        <ModalTeam
            v-if="openTeam"
            @closeConfirm="this.openTeam = false"
        />

        <ModalChart v-if="openChart"
                    @closeConfirm="this.openChart = false"
        />

        <ModalConfirm v-if="confirmDelete"
                      @deleteStructure="deleteRt()"
                      @closeConfirm="this.dataRt = null; this.confirmDelete = false"
        />
        <ModalCreateResponse
            v-if="openModal"
            :response="this.response"
            :parent_id = "this.parent_id"
            @closeConfirm="(data, isUpdate) => addRT(data, isUpdate)"
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
import ModalConfirm from "@/Components/Modals/ModalConfirm.vue";
import ModalChart from "@/Components/Modals/ModalChart.vue";
import ModalTeam from "@/Components/Modals/ModalTeam.vue";
import VideoComponent from "@/Components/VideoComponent.vue";

export default {
    components: {
        ModalTeam,
        ModalConfirm,
        ModalCreateResponse,
        BreezeAuthenticatedLayout,
        NavBarL,
        NavBar,
        ModalChart,
        VideoComponent,
        Head
    },
    data () {
        return {
            confirmDelete: false,
            openModal: false,
            openChart: false,
            openTeam: false,
            dataRt: null,
            readText: '',
            responses: this.$page.props.responseTypes.data,
            saveResponse: this.$page.props.responseTypes.data,
            newResponse: [],
            response: null,
            urlVideo: 'storage/video/background'+ Math.floor(Math.random() * 8) +'.mp4',
            keyComponent: 0,
            parent_id: null
        }
    },
    methods: {
        refreshPage () {
            Inertia.reload({ only: ['users'] })
        },
        refreshVideo () {
            this.urlVideo = 'storage/video/background'+ Math.floor(Math.random() * 8)+'.mp4'
            this.keyComponent++
        },
        openModalRt () {
            this.response = null
            this.openModal = true
        },
        updateRt (data) {
            this.response = data
            this.openModal = true
        },
        deleteRt () {
            axios.delete('response/' + this.dataRt.id)
                .then(() => {
                    this.responses.forEach((item, index) => {
                        if (item.id === this.dataRt.id) {
                            this.responses.splice(index, 1)
                        }
                    })
                    this.$notify({
                        title: "RT supprimée avec succès",
                        type: 'success',
                        duration: 3000,
                    });
                })
                .catch(error => {
                    this.$notify({
                        title: "Oups petit problème !! :)",
                        type: 'warn',
                        duration: 3000,
                    });
                    console.log(error)
                })
            .finally(() => {
                this.dataRt = null;
                this.confirmDelete = false
            })
        },
        updateResponse (data = null) {
            if (data) {
                this.responses = data
                this.saveResponse = data
            } else {
                Inertia.reload()
                this.responses = this.$page.props.responseTypes
            }
        },
        traitementText (data) {
            const text = data.contenu.split('\n')
            let textFormated = ''
            text.forEach(line => {
                textFormated += line + '\n'
            })
            return textFormated
        },
         copyText (data) {
            const text = this.traitementText(data)
            if (this.readText !== text) {
                this.readText = text
                navigator.clipboard.writeText(text)

                this.$notify({
                    title: "Copie effectuée avec succès",
                    type: 'success',
                    duration: 3000,
                });

                axios.put('response/rating', {
                    id: data.id
                })
                    .then(() => {
                    })
                    .catch(error => {
                        console.log(error)
                    })
            } else {
                navigator.clipboard.writeText(this.readText)
                this.$notify({
                    title: "Copie effectuée avec succès",
                    type: 'success',
                    duration: 3000,
                });
            }
        },
        search (data, bool) {
            this.responses = this.saveResponse
            this.newResponse = []
            if (bool && data) {
                const texte = data.trim()
                const words = texte.split(' ')
                    if (words.length > 1) {
                        this.$page.props.responseTypes.data.forEach(item => {
                            words.forEach(text => {
                                if (item.itemSearch.toString().match(text.toLowerCase())) {
                                    this.newResponse.push(item)
                                }
                            })
                        })
                        words.forEach(text => {
                            this.newResponse = this.newResponse.filter(item => item.itemSearch.toString().match(text.toLowerCase()))
                        })
                        this.newResponse = this.newResponse.filter((element, index) => {
                            return this.newResponse.indexOf(element) === index;
                        });
                    } else {
                        this.$page.props.responseTypes.data.forEach(item => {
                            if (item.itemSearch.toString().match(texte.toLowerCase()) ) {
                                this.newResponse.push(item)
                            }
                        })
                    }
                this.responses = this.newResponse
                this.newResponse = []
            } else {
                this.responses = this.saveResponse
            }
        },
        addRT (data, isUpdate) {
            if (data && isUpdate) {
                this.responses.forEach((item, index) => {
                    if (item.id === data[0].id) {
                        this.responses[index] = data[0]
                    }
                })
            }
            if (data && !isUpdate) {
                this.responses.push(data[0])
            }
            this.openModal = false
            this.response = null
        }
    }
}
</script>
