## Diagrama de flujo
<p align="center"><img src="/public/Diagra.png" width="400" alt="Laravel Logo"></p>

## Instalación del pryecto

- composer install.
- npm install
- npm run dev o build


## Cofiguración
- crear copia de .env.example:<br>
  cp .env.example .env

- Crear base de datos en mysql
- Posteriormente agrgeamos las credenciales de la bd en la configuracion de punto .env
- Corremos migraciones y seeder: <br>
  php artisan migrate:fresh --seed

## API CRUD 
- para hacer las pruebas es necesario utilizar postman
- para mayor seguridad en el punto .env esta las credenciales que se debe configurar en postman:
en el .env encontrará :  API_KEY = el codigo en esta parte se puede utilizar un generador randon

en dado caso que la api se utilizara en difentes proyectos, se puede realizar una tabla para dar de alta los dominios y generarles una key randon para cada uno.

En postman: en headers ingresara Blog-API-Key con el valor que tenga API_KEY de la configuración del env

## Recursos utilizados
    - php 8.1
    - laravel 10.10
    - laravel/ui: para el sistema de autentificación
    - laravel/livwire: para crear el componente post y dejando dinamicamente toda sus funcionalidades
    - carbon: para transformar fechas
    - bootstrap 5: para la parte visual
    - vite: para la configuracion de las dependencias a utilizar

## Comentarios
    como se trara de un blog decidi hacer una tabla que se llama posts, y es ahi donde se da de alta las entradas, en nuestro caso seria un post.
    
    hice por aparte los enpoints para consumir los diferente metodos existes, pero para el funcionamiento de las entradas en el sistema lo hice con livewire.
    

## Credenciales para iniciar sesion
email: usuario@gmail.com<br>
password: usuario
