
# 🍽️ Sistema de Facturación e Inventario - Restaurante

Este proyecto Laravel es un sistema de gestión para restaurantes, que permite controlar productos, recetas, compras, ventas (facturas), clientes y proveedores. Además, incluye gestión de ingredientes, stock y detalles relacionados.

---

## ✅ Funcionalidades Implementadas

### 🧾 Módulos CRUD
- [x] **Clientes**
- [x] **Proveedores**
- [x] **Productos** (con activación/desactivación)
- [x] **Categorías**
- [x] **Ingredientes**
- [x] **Recetas** (incluye acción personalizada `disable`)
- [x] **Compras** y **Detalle de Compras**
- [x] **Facturas** y **Detalle de Facturas**

### 🧩 Lógica implementada
- ✅ Relaciones entre modelos correctamente estructuradas (foreign keys)
- ✅ Vistas completas para `index`, `create`, `edit`, `show` en todos los módulos
- ✅ Validaciones de formularios
- ✅ Paginación en vistas `index`
- ✅ Eliminación protegida por relaciones: las facturas no pueden eliminarse si tienen detalles
- ✅ Vista de Dashboard funcional con autenticación Jetstream + Livewire

---

## ⚙️ Backend (Laravel)

- Laravel v10+
- Jetstream con Livewire (autenticación y layout base)
- Migraciones y seeders configurados
- Relaciones `hasMany`, `belongsTo` entre entidades

---

## 📦 Rutas implementadas

- `web.php` estructurado por controlador
- Rutas personalizadas:
  - `productos/{producto}/cambiar-estado`
  - `recetas/{receta}/disable`
  - Detalles anidados de factura y compra

---

## 🔒 Seguridad

- Autenticación con middleware `auth:sanctum` y `verified`
- Acceso restringido al dashboard y a las operaciones CRUD

---

## 📌 Mejoras sugeridas a futuro

- Cálculo automático de subtotal/IVA
- Control de stock al facturar/comprar
- Reportes PDF (ventas, compras, productos más vendidos)
- Cierre de caja diario
- Control de roles y permisos (ej. administrador, cajero, bodega)

---

## 🛠 Instalación

```bash
git clone https://github.com/tu_usuario/tu_repo.git
cd tu_repo
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 👤 Autores y Colaboradores

- Desarrollado por: Nicole Calvas. CTO
---
