# 🎲 Registros de Mesa (RDM)

**Registros de Mesa (RDM)** es una aplicación web que permite a los usuarios organizar y participar en encuentros de juegos de mesa. Esta plataforma facilita la conexión entre aficionados, permitiendo registrar partidas, unirse a sesiones existentes y mantener un historial de participación.

---

## 🧩 Características principales

- **Registro y autenticación de usuarios**  
  Crea tu cuenta personal para acceder a todas las funcionalidades.  
  `funciones_usuario.php:6-37`

- **Organización de partidas**  
  Crea encuentros para tus juegos favoritos especificando fecha, lugar y detalles importantes.  
  `funciones_usuario.php:231-282`

- **Participación en encuentros**  
  Únete a partidas organizadas por otros usuarios.  
  `funciones_usuario.php:348-357`

- **Catálogo de juegos**  
  Explora la base de datos de juegos disponibles para organizar partidas.  
  `db.php:19-34`

- **Historial de partidas**  
  Mantén un registro de todas tus partidas pasadas.  
  `db.php:261-302`

- **Gestión de perfil**  
  Actualiza tus datos personales y preferencias.  
  `funciones_usuario.php:155-184`

---

## 🛠️ Tecnologías utilizadas

- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5  
  `index.php:12-15`

- **Backend**: PHP  
  `db.php:1-11`

- **Base de datos**: MySQL  
  `db.php:7`

---

## 📁 Estructura del proyecto

css/
└── custom.css # Estilos personalizados (custom.css:1-5)

js/
└── *.js # Scripts para interacción

php/
├── functions/

  │ ├── db.php # Conexión y consultas a la base de datos (db.php:3-11)

  │ ├── funciones_usuario.php # Funciones de usuario (funciones_usuario.php:5-37)

  │ └── PHPMailer.php # Envío de correos electrónicos

  ├── pages/

  │ └── *.php # Páginas del sistema: login, registro, partidas, etc.

index.php # Página principal (index.php:104-106)

vendor/ # Dependencias instaladas vía Composer


---

## ✨ Funcionalidades destacadas

### Para usuarios no registrados
- Explorar juegos disponibles
- Ver partidas públicas
- Registrarse en la plataforma  
  `index.php:69-78`

### Para usuarios registrados
- Crear y gestionar partidas
- Unirse a partidas creadas por otros
- Ver historial personal de partidas
- Gestionar perfil de usuario  
  `index.php:41-67`

---

## ⚙️ Instalación y configuración

1. Clona este repositorio.
2. Configura un servidor web local con soporte PHP y MySQL.
3. Importa la base de datos desde el archivo SQL (no incluido en este repositorio).
4. Configura los parámetros de conexión en:  
   `php/functions/db.php`  
   (ver líneas `db.php:3-11`)
5. Accede a la aplicación desde el navegador.

---

## 👤 Autor

**Adrián Delgado Tuñón**  
`index.php:144`

📬 Contacto:  
- [LinkedIn](https://www.linkedin.com/in/adriandt) — `@adriandt`  
- [GitHub](https://github.com/Adrian-DT) — `Adrian-DT`  
- [Email](mailto:adriandt_work@outlook.com)  

---

## 📝 Notas

**Registros de Mesa (RDM)** es un proyecto de Trabajo de Fin de Grado (TFG) que facilita el encuentro entre jugadores de juegos de mesa, fomentando la interacción social a través de partidas físicas organizadas desde la web.

---
