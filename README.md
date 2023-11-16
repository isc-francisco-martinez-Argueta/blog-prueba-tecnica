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
- Posteriormente agregamos las credenciales de la bd en la configuracion de punto .env
- Corremos migraciones y seeder: <br>
  php artisan migrate:fresh --seed
- generamos la app-key <br>
  php artisan key:generate

## API CRUD 
- para hacer las pruebas es necesario utilizar postman <br>
- para mayor seguridad, en el archivo .env está las credenciales que se debe configurar en postman:<br>
 API_KEY = el codigo en esta parte se puede utilizar un generador randon de codifo 'JnasdkjJLKJJnRCGG'<br> <br> <br>

en dado caso que la api se utilizara en diferentes proyectos, se puede realizar una tabla para <br>dar de alta los dominios y generarles una key randon para cada uno.<br><br>

En postman: en headers ingresara Blog-API-Key con el valor que tenga API_KEY de la <br>
configuración del archivo .env

## End points
- Listar todos los post <br>
http://blog-prueba-tecnica.test/api/posts/

- Crear un nuevo post <br>
http://blog-prueba-tecnica.test/api/posts

- Obtener un post específico <br>
http://blog-prueba-tecnica.test/api/posts/1

- Actualizar un post existente <br>
http://blog-prueba-tecnica.test/api/posts/1

- Eliminar un post   br
http://blog-prueba-tecnica.test/api/posts/1

## Recursos utilizados
    - php 8.1
    - laravel 10.10
    - laravel/ui: para el sistema de autentificación
    - laravel/livwire: para crear el componente post y dejando dinamicamente toda sus funcionalidades
    - carbon: para transformar fechas
    - bootstrap 5: para la parte visual
    - vite: para la configuracion de las dependencias a utilizar

## Comentarios
como se trata de un blog decidí hacer una tabla que se llama posts, y es ahi <br>
donde se da de alta las entradas, en nuestro caso seria un post.    <br>
hice por aparte los enpoints para consumir los diferente metodos existes, <br>
pero para el funcionamiento de las entradas en el sistema lo hice con livewire.


## Credenciales para iniciar sesion
email: usuario@gmail.com<br>
password: usuario
