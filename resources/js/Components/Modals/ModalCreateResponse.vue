<template>
    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div role="alert" class="container mt-10 mx-auto w-7/12">
                <div @click="this.$emit('closeConfirm')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <div class="relative py-8 px-5 md:px-10 bg-gray-800 shadow-md rounded border border-gray-400">
                    <h1 class="text-white font-bold text-center text-xl mb-4">
                        Création d'une Réponse Type
                    </h1>
                    <label for="title" class="text-white text-sm font-bold leading-tight tracking-normal">Titre</label>
                    <input required id="title"  class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="James" />

                    <label for="contenu" class="text-white text-sm font-bold leading-tight tracking-normal">Réponse</label>
                    <textarea required cols="30" rows="15" style="resize:none;" id="contenu" name="contenu" class="overflow-y-auto mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="James" />

                    <div class="flex items-center justify-between w-full">
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="this.$emit('closeConfirm')">Annuler</button>
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-700 transition duration-150 ease-in-out hover:bg-cyan-600 bg-sky-600 rounded text-white px-8 py-2 text-sm">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: "ModalCreateResponse"
}
</script>

<style scoped>

</style>
