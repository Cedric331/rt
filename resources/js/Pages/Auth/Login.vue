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
                    <img  class="object-fill h-full w-full" loading="lazy" :src="'images/image-'+ this.rand + '.jpg'" alt="Image de l'accueil">
                </div>

                <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">

                    <div class="flex-1">
                        <div class="flex w-full justify-center h-full bg-gray-900 bg-opacity-40">
                            <h1 class="text-4xl font-bold text-white">Gestion des RT</h1>
                        </div>

                        <div class="mt-8">
                            <form @submit.prevent="submit">
                                <div>
                                    <BreezeLabel for="email" value="Email" class="text-white" />
                                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <BreezeLabel for="password" value="Mot de passe" class="text-white"/>
                                    <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                                </div>

                                <div class="block mt-4">
                                    <label class="flex items-center">
                                        <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                                        <span class="ml-2 text-sm text-gray-600 text-white">Se souvenir de moi</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-white underline text-sm hover:text-slate-400">
                                        Mot de passe oublié ?
                                    </Link>

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
    status: String,
});

const rand = Math.floor(Math.random() * 4)

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
