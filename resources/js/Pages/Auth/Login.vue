<template>
    <BreezeGuestLayout>
        <Head title="Connexion" />

        <BreezeValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <!-- component -->
        <div class="bg-white dark:bg-gray-900">
            <div class="flex justify-center h-screen">
                <div class="hidden w-full h-full bg-cover lg:block">
                    <img  class="object-fill h-full w-full" loading="lazy" :src="'images/image-'+ rand + '.jpg'" alt="Image de l'accueil">
                </div>

                <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">

                    <div class="flex-1">
                        <div class="flex w-full justify-center h-full bg-gray-900 bg-opacity-40">
                            <h1 class="text-4xl font-bold text-white">Gestion des RT</h1>
                        </div>

                        <div class="mt-8">
                            <form @submit.prevent="submit">
                                <div class="relative mt-5">
                                    <input id="email" type="email" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="form.email" required autocomplete="username"/>
                                    <label for="email" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Email</label>
                                </div>

                                <div class="relative mt-5">
                                    <input id="password" type="password" class="block rounded-t-lg px-2.5 pb-2.5 pt-5 w-full text-sm bg-gray-50 dark:bg-gray-700 border-0 border-b-2 border-gray-300 appearance-none text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " v-model="form.password"  required autocomplete="current-password"/>
                                    <label for="password" class="absolute text-sm text-white duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">Mot de passe</label>
                                </div>

                                <div class="block mt-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" :value="form.remember" v-model="form.remember"  class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-600 text-white">Se souvenir de moi</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
<!--                                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-white underline text-sm hover:text-slate-400">-->
<!--                                        Mot de passe oublié ?-->
<!--                                    </Link>-->

                                    <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Connexion
                                    </BreezeButton>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>

<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';


defineProps({
    canResetPassword: Boolean,
    rand: Number,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
