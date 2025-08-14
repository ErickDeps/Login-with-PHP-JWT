# Sistema de Autenticación de Usuarios con PHP y JWT

Este proyecto implementa un sistema de **autenticación de usuarios** usando **PHP**, **MySQL** y **JSON Web Tokens (JWT)**, con buenas prácticas de seguridad y validación de datos.  
Permite registrar, iniciar sesión y proteger rutas mediante validación de tokens JWT almacenados en cookies seguras.

---

## Tecnologías utilizadas

- **HTML**
- **JavaScript**
- **PHP 8+** (patrón MVC)
- **MySQL**
- **Firebase JWT PHP Library**

## Características

- **Autenticación con JWT**

  - Generación de tokens firmados usando el algoritmo `HS256`.
  - Inclusión de fecha de expiración (`exp`) para mayor seguridad.
  - Decodificación y validación del token antes de acceder a rutas protegidas.

- **Base de datos MySQL**

  - Uso de un modelo `User` para gestionar la consulta de usuarios.
  - Búsqueda por email y verificación segura de contraseñas (`password_verify`).

- **Validaciones y seguridad**

  - Sanitización de entradas (`filter_var`, `mb_strtolower`, `trim`).
  - Validación de formato de email (`FILTER_VALIDATE_EMAIL`).
  - Hash seguro de contraseñas (`password_hash`).
  - Uso de cookies HTTP-only con `SameSite=Strict`.
  - Separación clara entre controladores, helpers y modelos.

- **Protección de rutas**
  - Middleware con `sessionValidateIn()` y `sessionValidateOut()` para redirigir si el usuario no está autenticado o si ya tiene sesión activa.
  - Redirección automática a login o dashboard según el estado del token.

---

## Instalación

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/ErickDeps/Login-with-PHP-JWT.git
   cd proyecto-jwt

   ```

2. **Instalar dependencias**

   - Ejecutar: `composer install`

3. **Configurar variables de entorno (.env)**

   - `DB_CONNECTION=`
   - `DB_HOST=`
   - `DB_PORT=`
   - `DB_DATABASE=`
   - `DB_USERNAME=`
   - `DB_PASSWORD=`
   - `JWT_SECRET_KEY=`

4. **Configurar archivo config/config.php**
   - `define('URL_BASE', 'http://domain.com');`

---

## Seguridad implementada

- JWT con clave secreta (`$_ENV['JWT_SECRET_KEY']`).
- Expiración de token para sesiones temporales.
- Cookies HTTP-only para prevenir ataques XSS.
- SameSite=Strict para mitigar ataques CSRF.
- Verificación de token en cada acceso a rutas privadas.
- Hash de contraseñas con `password_hash` y verificación con `password_verify`.
