<h1>Sistema de Gestión de Reservas para Centros Deportivos</h1>

Este proyecto es un sistema de gestión de reservas para centros deportivos, desarrollado con Laravel 11 para el backend y Vue.js para el frontend. La aplicación permite la gestión de instalaciones deportivas, reservas de espacios, clientes, clases, entrenadores y equipamiento. Se utiliza MySQL para la base de datos, con migraciones de Laravel para definir las estructuras de las tablas. También se implementan API RESTful en Laravel y se utiliza Axios en Vue.js para las peticiones al backend.

Características
Gestión de Instalaciones Deportivas: Permite la administración de diversas instalaciones dentro del centro deportivo.
Reservas de Espacios: Los usuarios pueden reservar espacios para diferentes actividades deportivas.
Gestión de Clientes: Administración de la información de los clientes que utilizan las instalaciones.
Clases y Entrenadores: Gestión de clases deportivas y asignación de entrenadores.
Equipamiento: Administración del inventario de equipamiento deportivo.

Requisitos
PHP >= 8.0
Composer
MySQL
Node.js y npm (para la parte frontend con Vue.js)

Instalación

Clonar el repositorio:

git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio

composer install

php artisan key:generate
