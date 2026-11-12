# Biblioteca Digital

Sistema de gestión de libros y préstamos (Laravel + PostgreSQL).

## Requisitos
- PHP 8.3 o superior
- Composer
- Node.js y npm
- PostgreSQL

## Instalación
1. git clone https://github.com/lissealzate/biblioteca-digital.git
2. cd biblioteca-digital
3. composer install
4. npm install
5. copy .env.example .env
6. php artisan key:generate
7. Configurar la base de datos en .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
8. php artisan migrate --seed
9. npm run build
10. php artisan serve

Abrir: http://127.0.0.1:8000/biblioteca

## Endpoints principales
- GET /api/libros (público)
- GET /api/libros/{id} (público)
- GET /api/prestamos (público)
- POST /api/prestamos (requiere token Sanctum)