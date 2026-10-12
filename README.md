# xPharma

Esqueleto de un sistema de gestión de farmacia (ERP ligero) en Laravel 12 con Inertia, React 19 y TypeScript, pensado como sucesor de [Pharmasys](https://github.com/thealejandro/Pharmasys).

- Estado: **prototipo / experimento** (abril de 2025). Parte del starter kit oficial de Laravel + React y añade el modelo de datos del dominio; la lógica de negocio todavía no está escrita.
- No está desplegado ni en uso.

## Relación con otros repos

| Repo | Qué es |
|---|---|
| [XACodev/PharmasysPreview](https://github.com/XACodev/PharmasysPreview) | Prototipo original de 2019 en PHP plano + jQuery. |
| [thealejandro/Pharmasys](https://github.com/thealejandro/Pharmasys) | Sistema en producción (Laravel 6, privado). |
| [thealejandro/PharmasysApp](https://github.com/thealejandro/PharmasysApp) | Reescritura en Laravel 10 + Livewire, alpha. |
| **thealejandro/xPharma** (este) | Esqueleto en Laravel 12 + React/TypeScript. |

## Qué hay realmente

Funciona lo que trae el starter kit: registro, login, recuperación de contraseña, verificación de correo, panel (`/dashboard`), ajustes de perfil, contraseña y apariencia (tema claro/oscuro), con layouts de barra lateral o cabecera y componentes de shadcn/ui.

Lo propio del proyecto es, por ahora, el diseño de la base de datos en `database/migrations/` (20 tablas de dominio): sucursales (`branches`), clientes, productos y presentaciones (`products`, `presentations`, `product_presentations`), lotes de inventario (`inventory_lots`), proveedores, ventas y detalle (`sales`, `sale_details`), facturas y anulaciones (`invoices`, `canceled_invoices`), devoluciones de venta, compras con ítems y validaciones (`purchases`, `purchase_items`, `purchase_validations`), movimientos de stock y detalle, devoluciones de envíos y bitácora de integridad (`integrity_logs`).

Para cada tabla existe un modelo y un controlador de recurso, pero están vacíos (métodos sin implementar), no hay rutas que los expongan y las páginas React de compras (`resources/js/pages/purchases/`) son marcadores de posición. El seeder `RolesAndPermissionsSeeder` define los roles `Administrador`, `Asistente`, `Encargado` y `Vendedor` con `spatie/laravel-permission`, y `routes/web.php` ya registra el middleware `role:Administrador`.

## Stack

| Componente | Versión |
|---|---|
| PHP | ^8.2 (CI usa 8.4) |
| Laravel | 12.3 (`composer.lock`) |
| Inertia | inertia-laravel 2.0, @inertiajs/react ^2.0 |
| React / TypeScript | 19 / 5.7 |
| UI | Tailwind CSS 4, Radix UI, shadcn/ui, lucide-react |
| Rutas en el front | Ziggy ^2.4 |
| Permisos | spatie/laravel-permission ^6.17 |
| Pruebas y calidad | Pest 3, Pint, ESLint 9, Prettier 3 |
| Base de datos | SQLite por defecto (`DB_CONNECTION=sqlite`) |
| Build | Vite 6 |

## Puesta en marcha local

Requisitos: PHP 8.2+, Composer, Node 22 con npm.

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed --class=RolesAndPermissionsSeeder   # roles y permisos (DatabaseSeeder no lo llama)
npm install
composer dev                   # levanta servidor, cola, logs (pail) y Vite a la vez
```

`composer dev:ssr` hace lo mismo con renderizado del lado del servidor (`npm run build:ssr` + `inertia:start-ssr`). Si se prefiere por separado: `php artisan serve` y `npm run dev`.

## Scripts útiles

| Comando | Para qué |
|---|---|
| `npm run dev` / `npm run build` / `npm run build:ssr` | Vite en desarrollo, build de producción, build con SSR |
| `npm run lint` | ESLint con autocorrección |
| `npm run format` / `npm run format:check` | Prettier sobre `resources/` |
| `npm run types` | `tsc --noEmit` |
| `vendor/bin/pest` | Pruebas (las del starter kit) |
| `vendor/bin/pint` | Formato PHP |

## CI

`.github/workflows/lint.yml` y `tests.yml` corren Pint, Prettier, ESLint, build y Pest, pero están configurados para las ramas `develop`, `main` y `workos`; la única rama del repo es `master`, así que hoy no se ejecutan.

## Estructura

```
app/Http/Controllers/   Auth y Settings (funcionales) + controladores de dominio (vacíos)
app/Models/             Modelos de dominio (vacíos)
database/migrations/    Esquema del dominio
database/seeders/       RolesAndPermissionsSeeder
resources/js/pages/     Páginas Inertia (auth, dashboard, settings, purchases)
resources/js/components/ Componentes de app y de shadcn/ui
resources/js/layouts/   Layouts de app, auth y settings
routes/                 web.php, auth.php, settings.php
```

## Licencia

`composer.json` declara MIT, pero el repo no incluye un archivo `LICENSE`. Mientras no se añada, trátese como software propietario de XACode con todos los derechos reservados.
