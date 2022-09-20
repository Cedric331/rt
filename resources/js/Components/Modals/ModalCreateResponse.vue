<template>
    <div class="fixed z-30 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div role="alert" class="container mt-10 mx-auto w-7/12">
                <div @click="this.$emit('closeConfirm')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <div class="relative py-8 px-5 md:px-10 bg-gray-800 shadow-md rounded border border-gray-400">
                    <h1 class="text-white font-bold text-center text-xl mb-4">
                        Création d'une Réponse Type
                    </h1>
                    <div class="relative">
                        <input v-model="titre" type="text" id="title" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none text-white border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        <label for="title" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Titre</label>
                    </div>
                        <span v-if="notifmsg && notifmsg.errors.titre" class="text-red-600">{{ notifmsg.errors.titre[0] }}</span>
                    <div class="relative mt-5">
                        <textarea v-model="contenu" type="text" id="contenu" cols="30" rows="10" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-white bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        <label for="contenu" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Réponse Type</label>
                    </div>
                    <span v-if="notifmsg && notifmsg.errors.contenu" class="text-red-600">{{ notifmsg.errors.contenu[0] }}</span>
                    <div class="relative mt-5">
                        <input v-model="tags" type="text" id="tag" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-700 border-0 border-b-2 appearance-none text-white border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                        <label for="tag" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Mots-clés</label>
                        <p style="font-size: 0.8em; font-style: italic; color: white">Séparer les Mots-clés par des points-virgule ";"</p>
                    </div>
                    <span v-if="notifmsg && notifmsg.errors.tags" class="text-red-600">{{ notifmsg.errors.tags[0] }}</span>

                    <div class="flex items-center justify-between w-full mt-5">
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 ml-3 bg-red-600 transition duration-150 text-white ease-in-out hover:border-red-800 border rounded px-8 py-2 text-sm" @click="this.$emit('closeConfirm')">Annuler</button>
                        <button @click="this.response ? update() : save()" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-700 transition duration-150 ease-in-out hover:bg-cyan-600 bg-sky-600 rounded text-white px-8 py-2 text-sm">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: "ModalCreateResponse",
    props: {
        parent_id: Number,
        response: Object
    },
    data () {
        return {
            titre: this.response !== null ? this.response.titre : '',
            contenu: this.response !== null ? this.response.contenu : '',
            tags: this.response !== null ? this.formatTag() : '',
            notifmsg: ''
        }
    },
    methods: {
      formatTag () {
        let listeTag = ''
        this.response.tags.forEach(item => {
          if (item.name) {
            listeTag += item.name + ';'
          }
        })
       return listeTag
      },
        save () {
            this.notifmsg = ''
            axios.post('response', {
                titre: this.titre,
                contenu: this.contenu,
                parent_id: this.parent_id,
                tags: this.tags
            })
            .then(response => {
                this.$emit('closeConfirm', response.data)
                this.$notify({
                    title: 'Merci ' + this.$page.props.auth.user.name + ' pour cette nouvelle RT :)',
                    type: 'success',
                    duration: 3000,
                });
            })
            .catch(error => {
                this.notifmsg = error.response.data
                console.log(error)
            })
        },
        update () {
          axios.patch('response/' + this.response.id, {
            titre: this.titre,
            contenu: this.contenu,
            tags: this.tags
          })
            .then(response => {
              this.$emit('closeConfirm', response.data, true)
                this.$notify({
                    title: "RT modifiée avec succès",
                    type: 'success',
                    duration: 3000,
                });
            })
            .catch(error => {
              console.log(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
