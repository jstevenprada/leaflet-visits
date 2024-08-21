<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage()
const visits = ref(page.props.visits)

const onDeleteSuccess = (e) => {
    visits.value = e.props.visits
}

</script>

<template>
    <Head title="Visitas" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard 2</h2>
        </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between">
                        <h2 class="m-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Visitas</h2>
                            <Link class="m-8 inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150" :href="route('visitas.create')" as="button" type="button">Crear visita</Link>
                    </div>
                    <div className="relative overflow-x-auto">
                        <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" className="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Latitud
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Longitud
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="visit in visits" className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ visit.name }}
                                    </th>
                                    <td className="px-6 py-4">
                                        {{ visit.email }}
                                    </td>
                                    <td className="px-6 py-4">
                                        {{ visit.latitude }}
                                    </td>
                                    <td className="px-6 py-4">
                                        {{ visit.longitude }}
                                    </td>
                                    <td className="px-6 py-4">
                                        <div>
                                            <Link class="text-green-500" :href="route('visitas.edit', visit)">
                                                Editar
                                            </Link>
                                            <Link @success="onDeleteSuccess" class="text-red-500 ml-4" :href="route('visits.destroy', visit)" method="delete" as="button">
                                                Eliminar
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>