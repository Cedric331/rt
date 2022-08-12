<template>
    <div class="fixed z-10 inset-0 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div @click="this.$emit('closeConfirm')" class="fixed inset-0 bg-gray-500 bg-opacity-90 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-white text-center" id="modal-title"><b>Nom de l'élément</b></h3>
                            <div class="mt-2 ">
                                <div class="flex justify-center">
                                    <div class="flex-shrink-0 text-white flex items-center justify-center h-12 w-12 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input v-model="element" class="shadow appearance-none border rounded w-full ml-1 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Technique...">
                                </div>
                            </div>
                            <span v-if="errors" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                Le nom est déjà pris
                            </span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse justify-between">
                    <div v-if="this.edit">
                        <button @click="updateStructure()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Modifier
                        </button>
                    </div>
                    <div v-else>
                        <button @click="addStructure()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Enregistrer
                        </button>
                    </div>
                    <button @click="this.$emit('closeConfirm')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalStructure",
    props: {
      edit: Boolean,
      name: String
    },
    data () {
        return {
            element: null
        }
    },
    methods: {
        closeModal () {
            this.element = null
            this.$emit('closeConfirm')
        },
        addStructure () {
            this.$emit('saveStructure', this.element)
        },
        updateStructure () {
            this.$emit('updateStructure', this.element)
        }
    },
    mounted() {
        if (this.edit) {
            this.element = this.name
        }
    }
}
</script>

<style scoped>

</style>
