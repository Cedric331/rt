<template>
    <div class="relative z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div @click="this.$emit('closeConfirm')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="inline-block align-bottom p-4  bg-gray-700 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-9/12	">

                <div class="w-auto mx-auto">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <button @click="openAddUser = true" aria-label="close menu" class="mt-3 dropdown__menu-link focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 ml-1 rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                            <span>Ajouter un utilisateur</span>
                        </button>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead @click="this.editName = null; this.updateUser = null;this.editMail = null" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Supprimer</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" class=" border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th v-if="editName === user" scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <div class="relative">
                                        <input @change.prevent="this.userUpdate()" v-model="updateUser.name" type="text" class="block rounded-t-lg w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    </div>
                                </th>
                                <th v-else @click="this.editName = user; this.updateUser = user;this.editMail = null" scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ user.name }}
                                </th>
                                <th v-if="editMail === user" scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <div class="relative">
                                        <input @change.prevent="this.userUpdate()" v-model="updateUser.email" type="text" class="block rounded-t-lg w-auto text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    </div>
                                </th>
                                <td v-else @click="this.editMail = user; this.updateUser = user; this.editName = null" class="px-6 py-4">
                                    {{ user.email }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="this.userSelected = user;ModalConfirm = true" class="font-medium text-white rounded-full px-4 py-3 bg-red-500 hover:underline">Supprimer</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <ModalAddUser
        v-if="openAddUser"
        @addNewUser="(data) => addNewUser(data)"
        @closeConfirm="this.openAddUser = false"
    />
    <ModalConfirm
        v-if="ModalConfirm"
        @deleteStructure="deleteUser()"
        @closeConfirm="this.ModalConfirm = false"
    />
</template>

<script>

import ModalConfirm from "@/Components/Modals/ModalConfirm.vue";
import ModalAddUser from "@/Components/Modals/ModalAddUser.vue";
export default {
    name: 'ModalTeam',
    components: {ModalAddUser, ModalConfirm},
    data () {
        return {
            openAddUser: false,
            ModalConfirm: false,
            userSelected: null,
            updateUser: null,
            editName: null,
            editMail: null,
            users: []
        }
    },
    methods: {
        getUser () {
            axios.get('user')
            .then(response => {
                this.users = response.data
            })
            .catch(error => {
                console.log(error)
            })
        },
        userUpdate () {
            axios.patch('user/' + this.updateUser.id, {
                name: this.updateUser.name,
                email: this.updateUser.email
            })
                .then(() => {
                    this.$notify({
                        title: "Utilisateur modifié avec succès",
                        type: 'success',
                        duration: 3000,
                    });
                })
                .catch(error => {
                    console.log(error)
                    this.$notify({
                        title: "Erreur lors de la modification",
                        type: 'warn',
                        duration: 3000,
                    });
                })
                .finally(() => {
                    this.editName = null
                    this.updateUser = null
                    this.editMail = null
                })
        },
        addNewUser (data) {
            this.users.push(data)
            this.openAddUser = false
        },
        deleteUser () {
            this.ModalConfirm = false
            axios.delete('user/' + this.userSelected.id)
                .then(() => {
                    this.users.forEach((item, index) => {
                        if (item.id === this.userSelected.id) {
                            this.users.splice(index, 1)
                        }
                    })
                    this.$notify({
                        title: "Utilisateur supprimé avec succès",
                        type: 'success',
                        duration: 3000,
                    });
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.userSelected = null
                })
        }
    },
    mounted() {
        this.userSelected = null
        this.getUser()
    }
}
</script>
