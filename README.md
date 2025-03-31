# 📦 Sistema de Facturación e Inventario para Restaurante

Este es un sistema web desarrollado en **Laravel** con **Jetstream (Livewire)** y **Bootstrap**. Está diseñado para gestionar de forma eficiente la facturación y el control de inventario de un restaurante.

## 🚀 Funcionalidades

- Gestión de productos e inventario
- Registro y control de facturas
- Panel de administración con autenticación
- Interfaz moderna y responsiva con Bootstrap
- Jetstream con Livewire para componentes interactivos

## 🛠️ Tecnologías utilizadas

- Laravel 10+
- Jetstream (Livewire)
- Bootstrap 5
- MySQL (u otro motor de base de datos)
- Git & GitHub

## ⚙️ Requisitos del sistema

- PHP >= 8.1
- Composer
- Node.js y npm
- MySQL o MariaDB
- Laravel CLI

## 🧪 Instalación del proyecto

```bash
# Clonar el repositorio
git clone https://github.com/NC5002/lema.git

cd lema

# Instalar dependencias PHP
composer install

# Instalar dependencias frontend
npm install && npm run dev

# Copiar archivo de entorno y generar clave
cp .env.example .env
php artisan key:generate

# Configurar la base de datos en el archivo .env

# Ejecutar migraciones
php artisan migrate

# (Opcional) Si usas seeders:
php artisan db:seed

# Levantar el servidor local
php artisan serve
```

## 🖼️ Capturas de pantalla

> Puedes agregar aquí imágenes del sistema si deseas

## 👤 Autor

-CTO. Nicole Calvas
- **NC5002** – [@NC5002](https://github.com/NC5002)
- Proyecto para uso interno

## 📝 Licencia

Este proyecto está bajo la licencia MIT.
