<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const page = usePage()
const visit = page.props.visits

const InitialValues = {
    name: visit.name,
    email: visit.email,
    latitude: visit.latitude,
    longitude: visit.longitude
}
const form = useForm(InitialValues)

const sendForm = () => {
    form.put(route('visits.update',visit),{
        onSuccess: (e) => {
            console.log(e)
        }
    })
}

</script>

<template>
    <Head title="Editar visita" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between">
                        <h2 class="m-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Editar visita</h2>
                        <Link :href="route('visitas.index')">Lista de visitas</Link>
                    </div>

                    <div class="flex justify-center">
                    <form @submit.prevent="sendForm">

                        <!-- <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Información actualizada correctamente.</p>
                        </Transition> -->

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
                                Editar
                            </PrimaryButton>
                        </div>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>