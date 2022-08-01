<template>
    <div class="bg-white overflow-hidden shadow-sm block">
        <div class="bg-slate-800">
            <div class="transition ease-in-out delay-4000  w-[3.00rem] overflow-hidden hover:w-56 hover:shadow-lg">
                <div class="flex h-screen flex-col justify-between pt-2">
                    <div class="min-h-[60%] max-h-[60%]">
                        <div class="hover:overflow-y-auto overflow-hidden h-full scroller">
                            <ul class="space-y-2 tracking-wide max-h-max">
                                <li v-for="structure in this.structures" class="min-w-max">
                                    <button @click="scrollStructure(structure)" class="w-full flex items-center rounded-full hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-3 font-medium">{{ structure.name }}</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <hr class="bg-white">
                    </div>
                    <div class="min-h-[20%] max-h-[20%]">
                        <ul class="tracking-wide">
                            <li class="min-w-max" v-if="this.parent_id !== null">
                                <button @click="reset()" class="relative w-full flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="-mr-1 font-medium">Revenir au début</span>
                                </button>
                            </li>
                            <li class="min-w-max">
                                <button @click="this.openModal = true" class="relative w-full flex items-center rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="-mr-1 font-medium">Ajouter structure</span>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full hover:bg-gradient-to-r from-sky-600 to-cyan-400 min-h-[15%] max-h-[15%]">
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
        <ModalStructure
            v-if="openModal"
            :structures="this.structures"
            :parent="this.parent"
            @saveStructure="(data) => saveStructure(data)"
            @closeConfirm="this.openModal = false"
        />
    </div>
</template>


<script>
    import {Inertia} from "@inertiajs/inertia";
    import ModalStructure from "@/Components/Modals/ModalStructure.vue";
    import {Link} from "@inertiajs/inertia-vue3";

    export default {
    name: "NavBarL",
        components: {
            ModalStructure,
            Link
        },
        data () {
            return {
            structures: [],
            parent_id: null,
            openModal: false
        }
},
    methods: {
        saveStructure (data) {
            axios.post('structure/add', {
                structures: this.structures,
                element: data,
                parent: this.parent_id
            })
                .then(response => {
                this.structures = response.data
                this.openModal = false
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

<style scoped>

</style>
