<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const InitialValues = {
    name: "",
    email: "",
    latitude: "",
    longitude: ""
}
const form = useForm(InitialValues)

const sendForm = () => {
    form.post(route('visits.store'))
}

</script>

<template>
    <Head title="Crear visita" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between">
                        <h2 class="m-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Crear visita</h2>
                        <Link class="m-8 inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150" :href="route('visitas.index')" as="button" type="button">Lista de visitas</Link>
                    </div>

                    <div class="flex justify-center">
                    <form @submit.prevent="sendForm" >
                        <div class="mt-4 min-w-80">
                            <InputLabel for="name" value="Nombre" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                autofocus
                                autocomplete="name"
                                placeholder="Pepito Perez"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                placeholder="pepito@gmail.com"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="latitude" value="Latitud" />

                            <TextInput
                                id="latitude"
                                type="number"
                                step="any"
                                class="mt-1 block w-full"
                                v-model="form.latitude"
                                placeholder="-54.45740"
                            />

                            <InputError class="mt-2" :message="form.errors.latitude" />
                        </div>

                        <div class="mt-4 mb-8">
                            <InputLabel for="longitude" value="Longitud" />

                            <TextInput
                                id="longitude"
                                type="number"
                                step="any"
                                class="mt-1 block w-full"
                                v-model="form.longitude"
                                placeholder="-105.30467"
                            />

                            <InputError class="mt-2" :message="form.errors.longitude" />
                        </div>
                        <div class="flex justify-center mb-8">
                            <PrimaryButton>
                                Guardar
                            </PrimaryButton>
                        </div>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>