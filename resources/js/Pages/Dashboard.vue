<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import NavBar from "@/Components/NavBar.vue";

</script>

<template>
    <Head title="Tableau de bord" />

    <BreezeAuthenticatedLayout>
<!--        <template #header>-->
<!--            -->
<!--        </template>-->
        <div class="flex justify-between">
            <NavBar></NavBar>
            <div class="mx-auto -order-1">
                <div class="bg-white overflow-hidden shadow-sm block">
                    <div class="h-max bg-slate-800">
                        <div class="transition ease-in-out delay-4000 min-h-screen w-[3.35rem] overflow-hidden hover:w-56 hover:shadow-lg">
                            <div class="flex h-screen flex-col justify-between pt-2">
                                <div class="h-3/6">
                                    <div class="w-max p-2.5 mb-4">
                                        <img src="https://tailus.io/images/logo.svg" class="w-32" alt="">
                                    </div>
                                    <div class="overflow-y-auto overflow-x-hidden h-[22.2rem]">
                                        <ul class=" space-y-2 tracking-wide">
                                            <li v-for="structure in this.structures" class="min-w-max">
                                                <button @click="scrollStructure(structure)" class="relative w-full flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="-mr-1 font-medium">{{ structure.name }}</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <ul class=" tracking-wide">
                                        <hr class="bg-white">
                                        <li class="min-w-max" v-if="this.parent_id !== null">
                                            <button @click="reset()" class="relative w-full flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="-mr-1 font-medium">Revenir au début</span>
                                            </button>
                                        </li>
                                        <li class="min-w-max">
                                            <button @click="addStructure()" class="relative w-full flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="-mr-1 font-medium">Ajouter structure</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="w-full hover:bg-gradient-to-r from-sky-600 to-cyan-400">
                                    <div class="w-max group flex items-center space-x-4 rounded-md px-4 py-3 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>
                                           <Link :href="route('logout')" method="post" as="button">
                                                Se déconnecter
                                            </Link>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>


<script>
import {Inertia} from "@inertiajs/inertia";

export default {
    data () {
        return {
            structures: [],
            parent_id: null
        }
    },
    methods: {
        addStructure () {
            axios.post('structure/add', {
                structures: this.structures,
                parent: this.parent_id
            })
                .then(response => {
                    this.structures = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
        reset () {
            this.parent_id = null
            axios.get('structure')
                .then(response => {
                    this.structures = response.data
                })
                .catch(error => {
                    console.log(error)
                })
        },
        scrollStructure (data) {
            this.parent_id = data.id
            axios.post('structure/check', {
                id: data.id
            })
            .then(response => {
                this.structures = response.data
            })
            .catch(error => {
                console.log(error)
            })
        }
    },
    mounted () {
        this.structures = this.$page.props.structures
    }
}
</script>
