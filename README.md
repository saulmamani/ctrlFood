## ctrlFOOD

Sistema para la venta de comidas y bebidas.

- Registro de usuarios
- CRUD producto
- CRUD clientes
- Registro de ventas
- Lista de ventas realizadas
- Reportes económicos
- Reportes estadísticos

Orientado a restaurants, fondas, pollerias, pensiones, franquicias de comida rápida, etc.

## Instalación

`git clone https://github.com/saulmamani/ctrlFood.git`

`cd ctrlFood`

`composer install`

`cp .env.example .env`

`php artisan key:generate`

Registrar las credenciales de la base de datos, reconpilar, y luego ejecuar las migraciones

`php artisan cache:clear`

`php artisan config:cache`

`php artisan migrate:fresh --seed`

Ejecutar la aplicación web

`php artisan serv`

## Demo

http://ctrlfood.herokuapp.com/

## Documentación

https://www.slideshare.net/luas0_1/aplicacin-de-scrum-y-uml-para-el-desarrollo-de-un-sistema-de-ventas


## Acerca de...

- Desarrollado por: Saul Mamani M.
- Emial: luas0_1@yahoo.es
- Website: [https://saulmamani.github.io](https://saulmamani.github.io/) 
