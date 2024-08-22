<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="m-8 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
                    <div id="map" class="m-8 min-h-[550px]"></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import leaflet from 'leaflet';
import { onMounted } from 'vue';

const page = usePage()
const user = page.props

let items

let map = leaflet.Map;

const customIcon = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

onMounted(() => {

    axios.get('/api/visits')
    .then(response => {

        items = response.data

        map = leaflet.map('map', {
            center: [4.60971, -74.08175],
            zoom: 11
        });

        leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        items.forEach((item) => {
            leaflet.marker([item.latitude, item.longitude], {
                title: "Cliente BEX",
                icon: customIcon
            }).bindPopup(
                "<div style='display: flex;flex-direction: column;align-items: center;flex-wrap: nowrap;align-content: center;'>"+
                    "<img style='height:40px;width:60px' src='https://bexsoluciones.com/wp-content/uploads/thegem-logos/logo_a2bd75b14cdd7dffdee1dee2864d40dd_1x.png' /><br>"+
                    "<b style='color:#E6633C'>Nombre</b>"+item.name+"<br>"+
                    "<b style='color:#E6633C'>Email</b>"+item.email+"<br>"+
                "</div>"
            ).addTo(map);
        });
        
    })
    .catch(error => {
        console.log(error);
    })
    // .then(function (response) {
    //     // manejar respuesta exitosa
    //     items_data = response.data
    // })
    // .catch(function (error) {
    //     // manejar error
    //     console.log(error);
    // })

    // map = leaflet.map('map', {
    //     center: [4.60971, -74.08175],
    //     zoom: 11
    // });

    // leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     maxZoom: 19,
    //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    // }).addTo(map);

    // console.log(items_data)

    // items?.forEach(element => {
    //     console.log('hola');
    //     console.log(element);
    // });

    // items.forEach( function(valor, indice, array) {
    //     console.log("En el índice " + indice + " hay este valor: " + valor);
    // });

    // items.forEach((item) => {
    //     console.log(item.name)
    // });

    // leaflet.marker([4.645830, -74.078340], {
    //     title: "Cliente BEX",
    //     icon: customIcon
    // }).bindPopup(
    //     `<div style="display: flex;flex-direction: column;align-items: center;flex-wrap: nowrap;align-content: center;">
    //         <img style="height:40px;width:40px" src="https://bexsoluciones.com/wp-content/uploads/thegem-logos/logo_a2bd75b14cdd7dffdee1dee2864d40dd_1x.png" /><br>
    //         <b style="color:#E6633C">Nombre</b> Juan<br>
    //         <b style="color:#E6633C">Email</b> campin@gmail.com<br>
    //     </div>`
    // ).addTo(map);
})

</script>
