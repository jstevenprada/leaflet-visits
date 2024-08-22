
# Visitas

Proyecto creado con Laravel 10, Vue.js 3 e Inertia.


## Ejecutar localmente

Clonar el proyecto

```bash
git clone https://github.com/jstevenprada/leaflet-visits.git
```

Ir a la carpeta contenedora

```bash
cd leaftlet-visits
```

Instalar dependencias

```bash
composer install
```

```bash
npm install
```

Crear archivo ```.env``` en base a ```.env.example``` tener en cuenta puerto y contraseña de la base de datos.

Inciar el servidor

```bash
npm run dev
```

```bash
php artisan serve
```

Ejecutar migraciones 

```bash
php artisan migrate
```

Abrimos en el navegador de preferencia la ruta dada por el comando ```php artisan serve```

## Laravel Prompt

Ejecutar este comando para la creación de una visita

```bash
php artisan create:visit
```