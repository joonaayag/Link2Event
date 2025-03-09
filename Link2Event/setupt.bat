@echo off

:: Crear estructura de carpetas
if not exist "storage\app\public\perfiles" mkdir storage\app\public\perfiles

:: Eliminar enlace si existe y crear nuevo enlace
if exist "public\storage" rmdir /s /q public\storage
php artisan storage:link