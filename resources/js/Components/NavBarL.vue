<template>
    <div class="bg-white overflow-hidden shadow-sm block opacity-90">
        <div class="bg-slate-800">
            <div class="transition ease-in-out delay-4000 w-72 overflow-hidden">
                <div class="flex h-screen flex-col justify-between pt-2">
                    <div class="min-h-[70%] max-h-[70%]">
                        <div class="hover:overflow-y-auto overflow-hidden h-full scroller">
                            <ul class="space-y-2 tracking-wide">
                                <li v-for="structure in this.structures" class="flex justify-between">
                                    <button @click="scrollStructure(structure)" class="flex items-center rounded-full hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path class="fill-current text-cyan-200 group-hover:text-cyan-300" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-3 font-medium">{{ structure.name }}</span>
                                    </button>
                                    <div class="flex justify-end">
                                        <button @click="editStructure(structure)" class="relative flex items-center mr-4 rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-2 py-1 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button v-if="this.$page.props.auth.isAdmin" @click="openConfirm(structure)" class="relative flex items-center mr-4 rounded-full space-x-5 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-2 py-1 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr class="bg-white">
                    </div>
                    <div class="min-h-[30%] max-h-[30%] mt-3">
                        <ul class="tracking-wide">
                            <li class="min-w-max flex justify-center" v-if="this.parent_id !== null">
                                <button @click="retour()" class="relative items-center rounded-full space-x-1 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-2 py-1 text-white">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="font-bold">Revenir </span>
                                    </div>
                                </button>
                                <button @click="reset()" class="relative items-center rounded-full space-x-1 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-2 py-1 text-white">
                                    <div class="flex justify-between">
                                        <span class="font-bold">Home </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                    </div>
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
                </div>
            </div>
        </div>
        <ModalStructure
            v-if="openModal"
            :edit="this.edit"
            :name="this.structure ? this.structure.name : null"
            @saveStructure="(data) => saveStructure(data)"
            @updateStructure="(data) => updateStructure(data)"
            @closeConfirm="this.openModal = false; this.edit = false"
        />
        <ModalConfirm
            v-if="openDel"
            @deleteStructure="deleteStructure()"
            @closeConfirm="this.openDel = false; this.delStructure = null"
        />
    </div>
</template>


<script>
    import {Inertia} from "@inertiajs/inertia";
    import ModalStructure from "@/Components/Modals/ModalStructure.vue";
    import {Link} from "@inertiajs/inertia-vue3";
    import ModalConfirm from "@/Components/Modals/ModalConfirm.vue";

    export default {
    name: "NavBarL",
        components: {
            ModalConfirm,
            ModalStructure,
            Link
        },
        data () {
            return {
            structures: [],
            structure: null,
            delStructure: null,
            parent_id: null,
            openModal: false,
            openDel: false,
            edit: false
        }
    },
        watch: {
            parent_id() {
               this.$emit('parent', this.parent_id);
            }
        },
    methods: {
        editStructure (structure) {
            this.structure = structure
            this.edit = true
            this.openModal = true
        },
        openConfirm (data) {
            this.delStructure = data
            this.openDel = true
        },
        deleteStructure () {
            axios.delete('structure/delete', {
                data: {
                    structure: this.delStructure
                }
            })
            .then(() => {
                this.structures.forEach((element, index) => {
                    if (element.id === this.delStructure.id) {
                        this.structures.splice(index, 1)
                    }
                })
                this.$notify({
                    title: "Structure suprimée avec succès",
                    type: 'success',
                    duration: 3000,
                });
                this.delStructure = null
                this.openDel = false
            })
            .catch(error => {
                console.log(error)
            })
        },
        updateStructure (data) {
            this.openModal = false
            this.edit = false
            axios.patch('structure/update', {
                structure: this.structure,
                element: data
            })
                .then(response => {
                    this.structures.forEach((element, index) => {
                        if (element.id === response.data.id) {
                            this.structures[index] = response.data
                        }
                    })
                    this.$notify({
                        title: "Structure modifiée avec succès",
                        type: 'success',
                        duration: 3000,
                    });
                })
                .catch(error => {
                    console.log(error)
                })
        },
        saveStructure (data) {
            this.edit = false
            axios.post('structure/add', {
                structures: this.structures,
                element: data,
                parent: this.parent_id
            })
                .then(response => {
                    this.$notify({
                        title: "Structure ajoutée avec succès",
                        type: 'success',
                        duration: 3000,
                    });
                this.structures = response.data
                this.openModal = false
            })
                .catch(error => {
                console.log(error)
            })
        },
        retour () {
            axios.post('structure', {
                parent: this.parent_id
            })
                .then(response => {
                    this.structures = response.data.structures
                    this.parent_id = response.data.parent_id
                    this.$emit('updateResponse', response.data.responses)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        reset () {
            this.parent_id = null
            axios.get('structure')
            .then(response => {
                this.structures = response.data.structure
                this.$emit('updateResponse', response.data.responseType)
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
                this.structures = response.data.structures
                this.$emit('updateResponse', response.data.responses)
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
