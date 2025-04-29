# tuMarketPlaceLocal es una aplicación desarrllada por Luis Molina Aguirre, cuyo único propósito es la entrega de una aplicación de tipo web como proyecto de fin de grado del grado superior de desarrollo de aplicaciones web. Teniendo en cuenta esto, a continuación pasamos a detallar los objetivos de la aplicación y el modo de instalación en local:

# Objetivo del proyecto:
# Desarrollar una aplicación web que permita conectar a los clientes con proveedores de servicios locales, facilitando la búsqueda, publicación y contratación de servicios. La aplicación permitirá la búsqueda, publicación y contratación de servicios, mejorando la comunicación entre las partes y optimizando los procesos de contratación mediante el uso de tecnologías web actuales, como PHP 8 en Backend; JavaScript, Bootstrap y AJAX en el Frontend; y MySQL para la gestión de datos. 
# Conceptos relevantes:
#   • Marketplace de servicios locales: Un marketplace es una plataforma que conecta a compradores (clientes) y vendedores (proveedores). En este caso, los vendedores serán personas o empresas que ofrezcan servicios a nivel local. 
#   • Tecnologías web: El desarrollo de aplicaciones web modernas implica el uso de lenguajes y librerías como PHP para el backend, JavaScript parala interactividad y herramientas como Bootstrap para el diseño responsivo y mejora de la experiencia del usuario. 
#   • Bases de datos relacionales: las bases de datos como MySQL permiten almacenar y gestionar grandes volúmenes de datos de manera organizada y eficiente. 
#   • AJAX: Facilita la carga dinámica de contenido sin necesidad de recargar la página completa, mejorando la experiencia del usuario. 
#   • JSON: JSON es ampliamente utilizado para intercambiar datos entre servidores y clientes en aplicaciones web. También es usado para almacenar configuraciones de aplicaciones y sistemas. JSON, además, puede almacenar datos en bases de datos NoSQL como MongoDB. En esta aplicación no se usará MongoDB, pero sí usaremos JSON para almacenar datos (categorías y servicios) y para el módulo de control de palabras no permitidas. 

# Objetivos específicos 
#   1. Diseñar una interfaz amigable y responsiva para los usuarios. 
#   2. Implementar un sistema de registro y autenticación de usuarios (clientes y proveedores). 
#   3. Desarrollar un sistema de búsqueda y filtrado de servicios. 
#   4. Permitir la publicación de perfiles de proveedores con detalles del servicio. 
#   5. Implementar un sistema de mensajes entre usuarios demandantes/ofertantes.
#   6. Integrar funcionalidades de administración de usuarios y gestión de ofertas. 


# Pasos para la intalación correcta de tuMarketPlaceLocal:
# 1. Intalar XAMPP Version: 8.0.30 --> Control Panel Version: 3.3.0
#   1.1. PHP/8.0.30
#   1.2. Apache Version	Apache/2.4.58 (Win64)
#   1.3. OpenSSL/3.1.3
#   1.4. MariaDB: 10.4.32

# 2. Crear Base de datos denominada: "marketplace"
#   2.1. importar "marketplace.sql" que contiene todas las tablas con algunos datos para pruebas
#   2.2. Para aceder a la aplicación crear un usuario nuevo desde el sistema. (Por motivos de seguridad no se permite crear un administrador)

# 3. Enviar correos:
# Esta opción no está habilitada para todos los usuarios, ya que la modificación de sendmail.ini actualmente está con el correo personal del desarrollador lo que implica una brecha de seguridad si se da las claves privadas del correo. Para que funcionase correctamente debería estar corriendo en producción en un host y no es el caso.

# 4. Funcionalidad:
#   4.1. Acceda al entorno local: http://localhost/marketplace/
#   4.2. Desde el Home vaya a "Crear una cuenta".
#   4.3. Cree una cuenta con peril: "Ofrezco servicio".
#   4.4. Navegue por la aplicación, cree ofertas, busque ofertas...
#   4.5. ¡ATENCIÓN!!! El sistema de pagos implementado en el formulario de suscripción es ficticio, no es una pasarela de pagos oficial, por lo que para activar el botón de registro basta con rellenar el IBAN con 24 dígitos o el número de tarjeta con entre 13 y 19 dígitos. El botón Paypal es solo un ejemplo, no está operativo, ya que para que funcion requiere una web en un host, es decir que esté online y no es el caso.

# 5. Fontend pendiente de desarrollo:
# Actualmente las siguientes páginas de la aplicación aún no están desarrolladas:
#   5.1. Acerca de.../Nosotros
#   5.2. Contacto
#   5.3. Lista de usuarios (esta es una función solo del administrador, por lo que en cualquier caso no hay acceso para otros perfiles)

# ¡ATENCIÓN!!! La aplicación está al 25% de las pruebas funcionales, por lo que es posible que existan errores/incidencias, aún no detectadas.