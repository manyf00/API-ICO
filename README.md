# API-ICO
## ÍNDICE
- [Introducción](#Introducción)
- [Desplegamiento](#Desplegamiento)
    - [Base de datos](#Base-de-datos)
    - [Apache](#Apache)
- [Peticiones API](#Peticiones-API)
    - [GET](#GET)
        - [GET perfil](#GET-perfil)
        - [GET hospital de referencia](#GET-hospital-de-refenrencia)
        - [GET hospitales](#GET-hospitales)
        - [GET hospital provincia](#GET-hospital-provincia)
        - [GET provincias](#GET-provincias)
        - [GET citas](#GET-citas)
        - [GET una cita](#GET-una-cita)
        - [GET medicamentos](#GET-medicamentos)
        - [GET un medicamento](#GET-un-medicamento)
        - [GET preguntas](#GET-preguntas)
        - [GET respuestas](#GET-respuestas)

    - [POST](#POST)
        - [POST pregunta](#POST-pregunta)
         - [POST respuesta](#POST-respuesta)
    - [PUT](#PUT)
        - [PUT perfil](#PUT-perfil)
        - [PUT cita](#PUT-cita)
# Introducción
El proyecto está desarollado con el fremwork Symfony.

Resuelve peticiones API a la base de datos SQL  
# Desplegamiento
Requisitos:

- PHP 7.3 o superior
- Servidor SQL que soporte JSON
- Revisar que modulos de php faltan entrando a la carpeta del proyecto y poniendo este comando: symfony check:requirements

## Base de datos
La base de datos utilizada y da buenos resultados es MySQL 5.7.8 o superior (en nuestro caso es la version 5.7.30)
## Apache
Usamos Apache como servidor web, se puede usar otros como NGINX.

Para desplegar este proyecto necesitamos subir mediante FTP el proyecto al servidor web o git clone del proyecto instalando vendor, composer y la carpeta var (recomendamos crear un proyecto nuevo y migrar el contendio del git dentro)
# Peticiones API
Las peticiones API reciben i devuelven datos en formato JSON.
## GET

### GET perfil

### GET hospital de referencia

### GET hospitales

### GET provincias

### GET citas

### GET una cita

### GET medicamentos

### GET un medicamento

### GET preguntas

### GET respuestas



## POST

### POST pregunta

### POST respuesta

## PUT

### PUT perfil
### PUT cita
