# PromoCatálogo · Catálogo de productos en promoción (PHP MVC)

Aplicación PHP con arquitectura **Modelo-Vista-Controlador**, sin frameworks, lista para XAMPP.

## Instalación (XAMPP)

1. Copia la carpeta `catalogo-ap` dentro de `C:\xampp\htdocs\`.
2. Enciende **Apache** y **MySQL** en el panel de XAMPP.
3. En phpMyAdmin importa `sql/database.sql` (crea la base `catalogo_db`, las tablas y los datos de prueba).
   > ⚠️ El script recrea las tablas: borra los usuarios que existieran antes.
4. Abre <http://localhost/catalogo-ap/>

Si tu MySQL tiene otra contraseña o usuario, cámbialo en `app/config/config.php`.

## Credenciales de prueba

| Rol           | Correo                 | Contraseña    |
|---------------|------------------------|---------------|
| Administrador | `admin@catalogo.com`   | `Admin123*`   |
| Usuario       | `usuario@catalogo.com` | `Usuario123*` |

Se muestran en la pantalla de login (clic para autocompletar) mientras `modo_demo` sea `true`
en `app/config/config.php`. Si las cuentas no existen en la base, se crean solas al abrir el login.
**Antes de publicar en producción, pon `modo_demo => false`.**

## Estructura

```
catalogo-ap/
├── index.php                  ← Front Controller (único punto de entrada: index.php?r=ruta)
├── app/
│   ├── config/config.php      ← Base de datos, modo demo y cuentas de prueba
│   ├── core/                  ← Núcleo: App, Router, Controller base, Database (PDO), Session, helpers
│   ├── models/                ← Usuario, Producto, Ubicacion (ciudades de Colombia y España)
│   ├── controllers/           ← Home, Auth (login/registro/logout), Catalogo, Admin, Error
│   └── views/                 ← layouts/, partials/, home/, auth/, catalogo/, admin/, errors/
├── assets/
│   ├── css/app.css
│   └── js/                    ← form-utils, login, registro (autocompletado), catalogo, admin
├── sql/database.sql
```

## Rutas

| Ruta                       | Controlador@acción                    | Acceso         |
|----------------------------|---------------------------------------|----------------|
| `index.php`                | `HomeController@index`                | Invitados      |
| `index.php?r=login`        | `AuthController@login`                | Invitados      |
| `index.php?r=registro`     | `AuthController@registro`             | Invitados      |
| `index.php?r=logout`       | `AuthController@logout` (POST)        | Autenticados   |
| `index.php?r=catalogo`     | `CatalogoController@index`            | Autenticados   |
| `index.php?r=admin`        | `AdminController@index`               | Solo admin     |
| `index.php?r=admin/producto` | `AdminController@cambiarEstadoProducto` (POST) | Solo admin |

## Registro: Colombia y España

- Al escribir la ciudad aparece un autocompletado (sin importar tildes ni mayúsculas).
- Si la ciudad es conocida, **el país se completa y se bloquea**. El botón «Cambiar ciudad» lo libera.
- Ciudades que existen en ambos países (p. ej. *Cartagena*) se resuelven eligiendo la sugerencia o el país.
- Si la ciudad no está en la lista, el usuario puede elegir el país a mano.
- El documento se adapta al país: **Cédula** (6–10 dígitos) en Colombia y **DNI/NIE** en España.
- El servidor repite todas las validaciones (`Usuario::validarRegistro`), así que no dependen del JavaScript.

Las ciudades están en `app/models/Ubicacion.php`; para agregar más, edita ese archivo.

## Seguridad incluida

Contraseñas con `password_hash`, consultas preparadas (PDO), token CSRF en todos los formularios,
`session_regenerate_id` al iniciar sesión, escape de salida con `e()`, mensajes de login genéricos
y carpetas `app/` y `sql/` bloqueadas al navegador mediante `.htaccess`.
