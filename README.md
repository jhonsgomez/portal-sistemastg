# Portal Informativo - Facultad de Ingeniería de Sistemas UTS

> Sistema de gestión y publicación de noticias para la Facultad de Ingeniería de Sistemas de las Unidades Tecnológicas de Santander.

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat&logo=bootstrap)

---

## Tabla de Contenidos

- [Descripción](#descripción)
- [Características](#características)
- [Tecnologías](#tecnologías)
- [Requisitos Previos](#requisitos-previos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Uso](#uso)
- [Funcionalidades](#funcionalidades)
- [Seguridad](#seguridad)
- [Licencia](#licencia)
- [Autores](#autores)
- [Contacto](#contacto)
- [Documentación Adicional](#documentación-adicional)


---

## Descripción

Portal web informativo diseñado específicamente para la **Facultad de Ingeniería de Sistemas** de las Unidades Tecnológicas de Santander (UTS). El sistema permite a los administradores y docentes gestionar noticias, eventos y anuncios relevantes para la comunidad universitaria.

### Propósito

- **Portal público**: Información accesible para estudiantes, profesores y visitantes
- **Panel administrativo**: Gestión completa de contenido para personal autorizado
- **Comunicación efectiva**: Mantener informada a la comunidad académica

---

## Características

### Portal Público

- **Página de inicio** moderna y responsiva
- **Sistema de noticias** con vista de tarjetas
- **Diseño responsive** adaptable a todos los dispositivos
- **Modal expandido** para lectura completa de noticias
- **Carga dinámica** de contenido sin recargar página

### Panel Administrativo

- **Sistema de autenticación** (preparado para implementación)
- **CRUD completo de noticias** (Crear, Leer, Actualizar, Eliminar)
- **Upload de imágenes** con drag & drop y preview
- **Búsqueda y filtros** avanzados
- **Paginación** automática
- **Dashboard** con estadísticas
- **Estados de publicación** (Borrador/Publicada)
- **Validación de formularios** completa

---

## Tecnologías

### Backend

- **Laravel 10.x** - Framework PHP
- **PHP 8.1+** - Lenguaje de programación
- **MySQL 9.0+** - Base de datos relacional
- **Eloquent ORM** - Mapeo objeto-relacional para gestión de base de datos

### Frontend

- **Bootstrap 5.3** - Framework CSS
- **Bootstrap Icons** - Iconografía
- **JavaScript** - Interactividad
- **CSS3** - Estilos personalizados
- **Blade** - Motor de plantillas

### Herramientas

- **Composer** - Gestor de dependencias PHP
- **npm/Vite** - Gestor de assets
- **Git** - Control de versiones

---

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP** >= 8.1
- **Composer** >= 2.0
- **MySQL** >= 9.0
- **Git**

### Extensiones PHP Requeridas

```bash
php-mysql
php-mbstring
php-xml
php-curl
php-zip
php-gd
```

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/AlejoM2056/Portal_Informativo_Uts.git
cd proyecto
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar el archivo .env

```bash
cp .env.example .env
```

Edita el archivo `.env` con tus configuraciones:

```env
APP_NAME="Portal UTS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de datos MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=noticia_uts
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Crear la base de datos

Crea una base de datos en MySQL:

```sql
CREATE DATABASE noticia_uts CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Ejecutar las migraciones

```bash
php artisan migrate
```

### 7. Crear las carpetas necesarias

```bash
mkdir -p public/images/noticias
chmod -R 775 storage bootstrap/cache
```

### 8. Iniciar el servidor

```bash
php artisan serve
```

Visita: `http://localhost:8000`

---

## Configuración

### Configuración de la Base de Datos

#### MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=noticia_uts
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### Configuración de Imágenes

Las imágenes de noticias se almacenan en:

```
public/images/noticias/
```

Tamaño máximo permitido: **5MB**

Formatos aceptados: **JPG, PNG, WEBP**

### Permisos de Carpetas

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/images
```

---

## Estructura del Proyecto

```
portal-uts/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       ├── Controller.php
│   │       └── NoticiaController.php
│   └── Models/
│       └── Noticia.php
├── database/
│   └── migrations/
│       └── XXXX_create_noticias_table.php
├── public/
│   ├── css/
│   │   ├── style.css
│   │   ├── admin.css
│   │   └── home.css
│   └── images/
│       └── noticias/
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── admin.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── noticias.blade.php
│       │   ├── crear-noticia.blade.php
│       │   ├── editar-noticia.blade.php
│       │   └── ver-noticia.blade.php
│       ├── home.blade.php
│       └── login.blade.php
└── routes/
    └── web.php
```

---

## Uso

### Portal Público

1. **Visita la página principal**: `http://localhost:8000`
2. **Explora las noticias** publicadas
3. **Filtra por categorías** usando los botones superiores
4. **Lee noticias completas** haciendo clic en "Leer más"

### Panel Administrativo

1. **Accede al dashboard**: `http://localhost:8000/admin/dashboard`
2. **Gestiona noticias**: `http://localhost:8000/admin/noticias`

#### Crear una Noticia

1. Click en **"Nueva Noticia"**
2. Completa el formulario:
   - **Título**: Nombre de la noticia
   - **Categoría**: Selecciona una categoría
   - **Descripción**: Resumen corto (máx. 200 caracteres)
   - **Contenido**: Texto completo de la noticia
   - **Imagen**: Sube una imagen (opcional)
   - **Fecha**: Fecha de publicación
   - **Estado**: Borrador o Publicada
3. Click en **"Guardar Noticia"**

#### Editar una Noticia

1. En la lista de noticias, click en el ícono de **lápiz**
2. Modifica los campos necesarios
3. Click en **"Actualizar Noticia"**

#### Eliminar una Noticia

1. En la lista de noticias, click en el ícono de **papelera**
2. Confirma la eliminación

---

## Funcionalidades

### CRUD de Noticias

| Funcionalidad | Descripción | Estado |
|--------------|-------------|--------|
| Crear | Agregar nuevas noticias con imagen | Completado |
| Leer | Ver listado y detalles de noticias | Completado |
| Actualizar | Editar noticias existentes | Completado |
| Eliminar | Borrar noticias permanentemente | Completado |

### Sistema de Filtrado

- **Búsqueda**: Por título o categoría
- **Estado**: Todas, Publicadas, Borradores
- **Paginación**: 6 noticias por página
- **Categorías**: Eventos, Convenios, Infraestructura, Logros, Académico, Proyectos

### Upload de Imágenes

- Drag & Drop
- Preview antes de subir
- Validación de formato y tamaño
- Eliminación automática al borrar noticia

### Validaciones

- **Título**: Requerido, máximo 255 caracteres
- **Categoría**: Requerida
- **Descripción**: Requerida, máximo 200 caracteres
- **Contenido**: Requerido
- **Fecha**: Requerida
- **Imagen**: Opcional, JPG/PNG/WEBP, máximo 5MB

---

## Seguridad

- Protección CSRF en formularios
- Validación de entrada de datos
- Sanitización de contenido HTML
- Prepared statements (Eloquent ORM)
- Sistema de autenticación (pendiente)

---

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

---

## Autores

**Equipo de Desarrollo**
- Desarrollador Principal - [@AlejoM2056](https://github.com/AlejoM2056)

**Facultad de Ingeniería de Sistemas**
- Unidades Tecnológicas de Santander (UTS)

---

## Contacto

- **Email**: mdiegoalejandro17@gmail.com
- **Ubicación**: Floridablanca, Santander, Colombia

---

## Documentación Adicional

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc)

---

## Quick Start

```bash
# Clonar e instalar
git clone https://github.com/AlejoM2056/Portal_Informativo_Uts.git
cd proyecto
composer install
cp .env.example .env

# Configurar y migrar
php artisan key:generate
php artisan migrate

# Iniciar servidor
php artisan serve
```

---

<div align="center">

**Hecho con cariño para la comunidad UTS**



</div>