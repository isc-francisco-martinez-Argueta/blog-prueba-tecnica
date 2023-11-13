
<p align="center"><img src="/public/favicon.ico" width="400" alt="Laravel Logo"></p>

## Instalación del pryecto

- composer install.
- npm install
- npm run dev o build


## Cofiguración
- crear copia de .env.example:
  cp .env.example .env

- Crear base de datos en mysql
- Posteriormente agrgeamos las credenciales de la bd en la configuracion de punto .env
- Corremos migraciones y seeder
  php artisan migrate:fresh --seed



email: usuario@gmail.com
password: usuario
