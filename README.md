# 🗡️ Knife Sheath Store (E-commerce & Artisan Management System)

[English](#english) | [Español](#español)

---

<a name="english"></a>
## 🇬🇧 English

### Overview
**Knife Sheath Store** is a specialized e-commerce web application designed for artisan craftsmanship. It combines a robust **Laravel backend** with a modern, dynamic frontend experience driven by custom **AJAX scripts** and **Vite**, simulating a Single Page Application (SPA) feel without the overhead of heavy SPA frameworks.

### Key Features
* **Artisan Dashboard (CRUD):** Secure administrative panel to create, update, manage prices, descriptions, and multiple product images dynamically.
* **Hybrid Architecture (MVC + SPA-like UX):** Server-side routing via Laravel controllers paired with asynchronous AJAX workflows (`carrito-ajax.js`, `pedido-whatsapp.js`) for seamless, real-time cart interactions and order management.
* **WhatsApp Inquiry & Order System:** Modal-based ordering system that instantly bundles product items, shipping details, and client notes into a formatted WhatsApp message.
* **Dual-Layer Security:** 
  * *Server-side:* Strict Laravel validation rules (`$request->validate()`) and output sanitization (`strip_tags`). Built-in protection against SQL Injection via Eloquent ORM (Prepared Statements).
  * *Client-side:* Regex input sanitization and real-time form validation.
* **Asset Optimization:** Compiled with **Vite** for fast asset bundling and lightning-fast local development loops.

### Tech Stack
* **Backend:** PHP 8+, Laravel Framework (MVC, Eloquent ORM, Blade Templates)
* **Frontend:** JavaScript (ES6+), Bootstrap 5, Custom CSS (`--color-fondo-crema`, Custom Artisan Theme)
* **Build Tool:** Vite
* **Database:** MySQL / SQLite (configured via Laravel Migrations)
* **Version Control:** Git

---

<a name="español"></a>
## 🇪🇸 Español

### Resumen
**Knife Sheath Store** es una aplicación web de comercio electrónico especializada en marroquinería y cuchillería artesanal. Combina un **backend robusto en Laravel** con una experiencia de usuario moderna y dinámica gestionada mediante scripts de **AJAX personalizados** y **Vite**, logrando una fluidez similar a una Single Page Application (SPA).

### Características Principales
* **Panel de Administración (CRUD):** Interfaz segura para gestionar productos, actualizar precios, descripciones y subir hasta tres imágenes por artículo de forma dinámica.
* **Arquitectura Híbrida (MVC + UX tipo SPA):** Controladores de Laravel combinados con flujos asíncronos en JavaScript (`carrito-ajax.js`, `pedido-whatsapp.js`) que permiten interactuar con el carrito en tiempo real sin recargas innecesarias.
* **Sistema de Pedidos por WhatsApp:** Módulo interactivo que recopila los datos de envío, notas y productos seleccionados para generar y disparar un mensaje directo estructurado hacia el taller.
* **Seguridad de Doble Capa:**
  * *En el Servidor:* Validación estricta con Laravel (`$request->validate()`), limpieza de etiquetas con `strip_tags()` y protección nativa contra inyecciones SQL mediante Eloquent ORM.
  * *En el Cliente:* Validación de formularios en tiempo real mediante Expresiones Regulares (Regex).
* **Optimización de Activos:** Empaquetado de recursos ultrarrápido gracias a **Vite**.

### Tecnologías Usadas
* **Backend:** PHP 8+, Framework Laravel (MVC, Eloquent ORM, Plantillas Blade)
* **Frontend:** JavaScript (ES6+), Bootstrap 5, CSS Personalizado
* **Empaquetador:** Vite
* **Base de Datos:** MySQL / SQLite
* **Control de Versiones:** Git

---

### ⚙️ Quick Start / Inicio Rápido

1. **Clone the repository / Clonar el repositorio:**
   ```bash
   git clone [https://github.com/your-username/knife-sheath-store.git](https://github.com/your-username/knife-sheath-store.git)
   cd knife-sheath-store
   ```
 
   Install PHP dependencies / Instalar dependencias de PHP:

 ```bash
composer install  
 ```
Install JavaScript dependencies / Instalar dependencias de JS:
 ```bash
npm install
 ```
Environment setup / Configurar entorno:
```bash
cp .env.example .env
php artisan key:generate
 ```
(Configure your database credentials in the .env file)

Run migrations / Ejecutar migraciones:
```bash
php artisan migrate
 ```
Start development servers / Iniciar servidores de desarrollo:
```bash
# Terminal 1 (Vite assets)
npm run dev

# Terminal 2 (Laravel server)
php artisan serve
 ```
