<template>
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div role="alert" class="container mt-10 mx-auto w-7/12">
            <div @click="this.$emit('closeConfirm')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <div class="relative py-8 px-5 md:px-10 bg-gray-800 shadow-md rounded border border-gray-400">
                <h1 class="text-white font-bold text-center text-xl mb-4">
                    Création d'un nouvel utilisateur
                </h1>
                <div class="relative">
                    <input v-model="name" type="text" id="name" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="name" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Nom</label>
                </div>
                <span v-if="notifmsg && notifmsg.errors.name" class="text-red-600">{{ notifmsg.errors.name[0] }}</span>
                <div class="relative mt-5">
                    <input v-model="email" type="text" id="email" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="email" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Email</label>
                </div>
                <span v-if="notifmsg && notifmsg.errors.mail" class="text-red-600">{{ notifmsg.errors.mail[0] }}</span>
                <div class="relative mt-5">
                    <input v-model="password" type="password" id="password" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="password" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Mot de passe</label>
                </div>
                <span v-if="notifmsg && notifmsg.errors.password" class="text-red-600">{{ notifmsg.errors.password[0] }}</span>

                <div class="relative mt-5">
                    <input v-model="password_confirmation" type="password" id="password_confirmation" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="password_confirmation" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Confirmer le mot de passe</label>
                </div>

                <div class="flex items-center justify-between w-full mt-5">
                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 ml-3 bg-red-600 transition duration-150 text-white ease-in-out hover:border-red-800 border rounded px-8 py-2 text-sm" @click="this.$emit('closeConfirm')">Annuler</button>
                    <button @click="save()" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-700 transition duration-150 ease-in-out hover:bg-cyan-600 bg-sky-600 rounded text-white px-8 py-2 text-sm">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalAddUser",
    data () {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            notifmsg: ''
        }
    },
    methods: {
        save () {
            axios.post('user', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
                .then(response => {
                    this.$emit('addNewUser', response.data)
                    this.$notify({
                        title: 'Utilisateur crée avec succès',
                        type: 'success',
                        duration: 3000,
                    });
                })
                .catch(error => {
                    this.notifmsg = error.response.data
                    console.log(error)
                })
        }
    }
}
</script>

<style scoped>

</style>
