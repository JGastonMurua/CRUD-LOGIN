<<<<<<< HEAD
# 🏫 Sistema de Gestión Escolar

**Proyecto Final - Curso PHP y MySQL**  
**Tecno 3F - Jorge Gastón Murua**

Un sistema CRUD completo para gestión de estudiantes con autenticación, validación por email y interfaz moderna.

🔗 **URL**: [escuelacrud.alwaysdata.net](https://escuelacrud.alwaysdata.net)

**Credenciales de prueba:**
- **Email**: `admin@admin.com`
- **Contraseña**: `admin123`

## 📋 Descripción

Sistema web desarrollado en PHP para la gestión de estudiantes de una institución educativa. Incluye sistema de autenticación completo, CRUD de estudiantes con subida de imágenes, y una interfaz moderna y responsiva.

## ✨ Características Principales

- 🔐 **Sistema de Autenticación**
  - Registro de usuarios con validación por email
  - Login seguro con verificación de credenciales
  - Sistema de tokens para confirmación de cuentas

- 👨‍🎓 **Gestión de Estudiantes**
  - Crear, leer, actualizar y eliminar estudiantes
  - Subida y gestión de fotografías
  - Campos completos: nombre, apellido, edad, curso, email, teléfono, dirección

- 🎨 **Interfaz de Usuario**
  - Diseño responsive con Bootstrap 5
  - Tablas interactivas con DataTables
  - Alertas animadas con SweetAlert2
  - Iconos emotivos para mejor UX

- 📧 **Notificaciones por Email**
  - Confirmación de registro via PHPMailer
  - Templates HTML personalizados

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 8+** - Lógica del servidor
- **MySQL** - Base de datos
- **PHPMailer** - Envío de correos

### Frontend
- **HTML5 / CSS3** - Estructura y estilos
- **Bootstrap 5.3.3** - Framework CSS
- **JavaScript / jQuery** - Interactividad
- **DataTables** - Tablas modernas
- **SweetAlert2** - Alertas modernas

### Hosting
- **AlwaysData.net** - Servidor web y base de datos

## 🗄️ Estructura de Base de Datos

### Tabla: `usuarios`
```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    token VARCHAR(255) NULL,
    confirmado TINYINT(1) DEFAULT 0
);
```

### Tabla: `estudiantes`
```sql
CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    curso VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    direccion TEXT NOT NULL,
    imagen VARCHAR(255) DEFAULT 'default.png',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
```

## 🚀 Instalación Local (XAMPP)

### 1. Requisitos Previos
- XAMPP (PHP 8+, MySQL, Apache)
- Composer (para PHPMailer)
- Cuenta de Gmail para envío de emails

### 2. Clonar/Descargar Proyecto
```bash
# Colocar el proyecto en la carpeta htdocs de XAMPP
C:/xampp/htdocs/proyecto_crud/
```

### 3. Configurar Base de Datos
```sql
-- Crear base de datos
CREATE DATABASE escuela_crud;
USE escuela_crud;

-- Importar las tablas (estructura mostrada arriba)
```

### 4. Configurar Conexión BD
Editar `includes/db.php`:
```php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'escuela_crud';
```

### 5. Instalar Dependencias
```bash
composer require phpmailer/phpmailer
```

### 6. Configurar Email
Editar `enviar_correo.php` con tus credenciales de Gmail:
```php
$mail->Username   = 'tu_email@gmail.com';
$mail->Password   = 'tu_app_password';
```

### 7. Acceder
```
http://localhost/proyecto_crud
```



## 📱 Funcionalidades Detalladas

### Sistema de Autenticación
- **Registro**: Formulario con validación y confirmación por email
- **Login**: Verificación de credenciales y estado de cuenta
- **Confirmación**: Sistema de tokens únicos vía email
- **Seguridad**: Contraseñas hasheadas con `password_hash()`

### Gestión de Estudiantes
- **Lista**: Tabla paginada con búsqueda en tiempo real
- **Crear**: Formulario modal con subida de imagen
- **Editar**: Modificación inline con preview de imagen
- **Eliminar**: Confirmación con SweetAlert2
- **Imágenes**: Subida, validación y redimensionado automático

### Características UX/UI
- **Responsive**: Adaptable a móviles y tablets
- **DataTables**: Ordenamiento, paginación y búsqueda
- **Alertas**: Notificaciones toast no intrusivas
- **Modales**: Formularios overlay para mejor experiencia
- **Iconos**: Emojis para interfaz más amigable


## 🎯 Casos de Uso

1. **Registro de Nuevo Usuario**
   - Usuario completa formulario → Sistema envía email → Usuario confirma → Acceso habilitado

2. **Gestión de Estudiante**
   - Login → Listar estudiantes → Crear/Editar → Subir foto → Guardar cambios

3. **Búsqueda y Filtrado**
   - Acceder a lista → Usar buscador DataTables → Aplicar filtros → Ver resultados


## 🔐 Seguridad Implementada

- Validación de entrada con `htmlspecialchars()`
- Consultas preparadas (Prepared Statements)
- Verificación de autenticación en cada página
- Tokens únicos para confirmación
- Contraseñas hasheadas con `password_hash()`
- Validación de tipos de archivo para imágenes

## 📚 Recursos de Aprendizaje

Este proyecto implementa conceptos de:
- **Arquitectura MVC** en PHP
- **Operaciones CRUD** completas
- **Autenticación y autorización**
- **Envío de emails** con PHPMailer
- **Subida de archivos** con validación
- **Bases de datos relacionales**
- **Frontend responsivo**

## 👥 Créditos

**Desarrollador**: Jorge Gastón Murua  
**Institución**: Tecno 3F  
**Curso**: PHP y MySQL  
**Año**: 2024


*Proyecto desarrollado como trabajo final del curso de PHP y MySQL en Tecno 3F. Demuestra competencias en desarrollo web full-stack, manejo de bases de datos y implementación de sistemas CRUD.*
=======
# CRUD-LOGIN
>>>>>>> 89ab57939687edcf0414b87759e44826720ebd0e
