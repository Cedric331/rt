<template>
    <nav class="w-full border-gray-200 px-2 sm:px-4 py-2.5 rounded bg-slate-800" :class="[openModal ? 'opacity-100' : 'opacity-90']">
        <div v-if="show" @click="show = false" class="fixed inset-0" aria-hidden="true"></div>
        <div class="container flex flex-wrap justify-between items-center mx-auto w-full">
            <div></div>
                <div class="flex ">
                    <div class="hidden relative md:block">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input @focusin="event => eventChange(event)" @input="search" type="text" id="search-navbar" class="block p-2 pl-10 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Recherche...">
                    </div>
                </div>
            <ul class="header__navbar">
                <li class="header__item">
                    <a href="#" class="header__link">
                        <button v-if="show" key="on" @click="show = false" aria-label="open menu" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button v-else key="off" @click="show = true" aria-label="close menu" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </a>
                        <div class="dropdown__menu" v-bind:class="{ active: show }" v-if="show">
                            <ul class="dropdown__menu-nav ">
                                <li class="dropdown__menu-item">
                                    <button @click="this.$emit('openChart')" aria-label="close menu" class="dropdown__menu-link focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 ml-1 rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="dropdown__menu-link">Voir Graphique</span>
                                    </button>

                                    <button @click="openModal = true; show = false" aria-label="close menu" class="dropdown__menu-link focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 ml-1 rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                                        </svg>
                                        <span class="dropdown__menu-link">Modifier mon mot de passe</span>
                                    </button>

                                  <div>
                                    <hr class="bg-white"/>
                                    <button @click="this.$emit('refreshBackground')" aria-label="close menu" class="dropdown__menu-link focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 ml-1 rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                      </svg>
                                      <span class="dropdown__menu-link">Changer le fond</span>
                                    </button>
                                    <button @click="this.$emit('openTeam')" aria-label="close menu" class="dropdown__menu-link focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 ml-1 rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                                        <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                                      </svg>

                                      <span class="dropdown__menu-link">Information équipe</span>
                                    </button>
                                  </div>

                                  <hr class="bg-white"/>
                                    <Link :href="route('logout')" method="post" as="button" aria-label="close menu" class="dropdown__menu-link focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 ml-1 rounded text-white text-xs sm:text-sm relative flex items-center rounded-full space-x-3 hover:bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 20 20" stroke="currentColor" stroke-width="2">
                                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>
                                            Se déconnecter
                                        </span>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                </li>
            </ul>
        </div>
        <ModalUpdatePassword
            class="opacity-100"
            v-if="openModal"
            @closeConfirm="openModal = false"
        />
    </nav>
</template>

<script>

import ModalUpdatePassword from "@/Components/Modals/ModalUpdatePassword.vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "NavBar",
    components: {
        ModalUpdatePassword,
        Link
    },
    props: {
        resetSearch: Number
    },
    data () {
        return {
            openModal: false,
            show: false
        }
    },
    methods: {
      eventChange (event) {
        event.target.value = ''
        this.$emit('search', null, true)
      },
        search: _.debounce(function (e) {
            this.$emit('search', e.target.value, true)
        }, 100),
    }
}
</script>

<style scoped>
:root {
    --font-primary: 'Open Sans', sans-serif;
    --color-gray: #dadce0;
}
   *,
   ::after,
   ::before {
       box-sizing: border-box;
   }

body {
    font-size: 1rem;
    -webkit-text-size-adjust: 100%;
    font-family: var(--font-primary);
    overflow: hidden;
}
hr {
    border: 0;
    height: 1px;
    margin: 5px 0;
    border-top: 1px solid var(--color-gray);
}

   .header {
       padding: 2rem 5rem 2rem 5rem;
&__nav {
     position: relative;
 }
&__navbar {
     display: flex;
     align-items: center;
     justify-content: flex-end;
 }
&__item {
     padding: 1rem;
 }
&--icon {
     width: 1.65rem;
     height: 1.65rem;
 }
&--button {
     top: 0;
     right: 0;
     position: absolute;
     margin: 0;
     padding: 0;
     color: gray;
     cursor: pointer;
     border: 1px solid transparent;
     background-color: transparent;
&:focus {
     outline: 0;
 }
}
}

   .dropdown__menu {
       top: 100%;
       right: 0;
       position: absolute;
       z-index: 10;
       height: auto;
       min-width: 150px;
       margin-top: 0rem;
       margin-right: 1.5rem;
       overflow-y: auto;
       padding: 1rem 1rem;
       border-radius: 12px;
       background-color: rgb(51 65 85);
       border: 1px solid var(--color-gray);
       background-clip: padding-box;
&-link {
     display: flex;
     align-items: center;
     justify-content: flex-start;
     text-decoration: none;
     color: rgba(0, 0, 0, 0.6);
     padding: 0.8rem 0 0.8rem 2rem;
     margin-top: 0.2rem;
     margin-bottom: 0.2rem;
     border-radius: 0 50px 50px 0;
&:hover {
     color: #17bf63;
     background-color: rgba(79, 192, 141, 0.1);
 }
}
}
</style>
