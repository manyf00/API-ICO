# API-ICO
En este proyecto de GitHub es la aplicacion API Rest mediante Symfony que envia las peticiones API a la [ICOApp](https://github.com/yahyaelk98/IcoApp/).



## Comenzando 🚀

Para poder utilizar esta aplicación se requiere de un servidor donde poder desplegar el proyecto


## Pre-requisitos 📋
 
Para poder realizar evolutivos de esta aplicación o poder desplegarla en modo desarrollo seria necesario tener conocimientos de :

* PHP
* Symfony
* Redes
* Sistemas
* Base de datos (SQL)
* Servidores Web (configuracion y mantenimiento)

```
El proyecto está montado sobre Symfony y composer.
```

## Instalación 🔧

Para poder realizar la instalación de 0 se deben seguir estos pasos:

* Instalar [PHP](https://www.php.net/) 7.2.5 o superior.
* Instalar [Composer](https://getcomposer.org/download/).
* Instalar [Symfony](https://symfony.com/download).

Una vez instalado todo realizamos el siguiente comando para verificar si cumplimos todos los requisitos, en caso de no cumplirlos nos indica que nos falta, la mayoria de oscasiones se debe a que faltan modulos de php, el mismo comando nos mostrara cuales faltan.
```
symfony check:requirements
```
Una vez instalado podremos o crear un proyecto nuevo o **clonar** este en el directorio donde se ha instalado el npm
* Para crear un proyecto de 0:

```
symfony new my_project_name
```

* Para clonarlo :

```
git clone https://github.com/manyf00/API-ICO
```
Requiere instalacion de la carpeta vendor y var

## Probando el funcionamiento ⚙️
Para poder realizar las pruebas en nuestro local levantando un servicio de symfony o desplegarla en un servidor en un entorno de desarrollo
### Si se despliega en local
* Accedemos mediante consola de comandos a la carpeta del proyecto 
* Ejecutar el siguiente comando en el directorio raíz del proyecto, y dara la ip localhost (127.0.0.1) y un puerto, generalmente suele ser el 8000 y superior.

```
symfony server:start
```
* Abrimos un navegador e introducimos 127.0.0.1:8000 o el puerto que nos indique

### Si es un servidor
* Desplegamos el proyecto dentro de nuestro servidor
* Una vez tengamos el proyecto subido dentro del directorio raiz del mismo ejecutamos esta orden para que genere un **.htacces**
```
 composer require symfony/apache-pack
```
* Si nuestro servidor no tiene habilitado **AllowOverride All** hay que hacerlo, si no se puede copiar el contenido y añadilo a la configuracion de Apache.

## Peticiones API 👨🏽‍💻

Las peticiones de la API se gestionan en *./src/Controller/UsuarioController.php* donde usa los objetos de las Entidades de la base de datos que se encuentra en *./src/Entity* y las consultas/querries de la base de datos se realizan el los archivos de *./src/Repository*

Todas las peticiones que realiza el controlador UsuarioController.php usa una ruta que inicia con **/api/**

### GET
* Perfil
```
[servidor]/api/perfil
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "nombre":string,
    "apellidos":string,
    "genero":string,
    "correo":string,
    "telefonos":array,
    "dataNaixement":date,
    "hospital":string
}

``` 

* Hospital de referencia del usuario
```
[servidor]/api/hospital
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "nombre":string,
    "nombreUnidad":string,
    "telefonos":array,
    "diasAbiertos":array,
    "horaInicio":time,
    "horaFinal":time,
    "correo":string,
    "ubicacion":JSON,
    "provincia":string,
    "lineaBus":string,
    "lineasMetro":string
}

``` 

* Todas las citas del usuario
```
[servidor]/api/citas
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "id":integer,
    "nombre":string,
    "fecha":data,
    "hora":time   
}

``` 

* Una cita detallada del usuario por id
```
[servidor]/api/cita/{id}
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "id":integer,
    "nombre":string,
    "fecha":data,
    "hora":time,
    "edificio":string,
    "box":string,
    "indicaciones":string,
    "estado":boolean,
    "hospital":string,
    "ubicacion":JSON
}

``` 

* Todos los medicamentos del usuario
```
[servidor]/api/medicamentos
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "id":integer,
    "nombre":string,
    "usosDiarios":integer,
    "cantidad":string,
    "tipoDeMedicamento":string
}

``` 

* Un medicamento del usuario por id
```
[servidor]/api/medicamento/{id}
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "id":integer,
    "nombre":string,
    "compuestoActivo":string,
    "comprimidosTotales":integer,
    "usosDiarios":integer,
    "dosis":integer,
    "cantidad":string,
    "tipoDeMedicamento":string
}

``` 

* Todos los hospitales
```
[servidor]/api/hospitales
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "nombre":string,
    "nombreUnidad":string,
    "telefonos":array,
    "diasAbiertos":array,
    "horaInicio":time,
    "horaFinal":time,
    "correo":string,
    "ubicacion":JSON,
    "provincia":string,
    "lineaBus":string,
    "lineasMetro":string
}

```

* Todos los hospitales de una provincia
```
[servidor]/api/hospitales/{provincia}

``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "nombre":string,
    "nombreUnidad":string,
    "telefonos":array,
    "diasAbiertos":array,
    "horaInicio":time,
    "horaFinal":time,
    "correo":string,
    "ubicacion":JSON,
    "provincia":string,
    "lineaBus":string,
    "lineasMetro":string
}

```

* Todas las preguntas
```
[servidor]/api/preguntas
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "id":integer,
    "nombre":string,
    "apellido":array,
    "fecha":date,
    "pregunta":string,
}

```

* Todas las respuestas de una pregunta por id
```
[servidor]/api/respuestas/{id}
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "id":integer,
    "nombre":string,
    "apellido":array,
    "fecha":date,
    "pregunta":string,
    "respuesta":array
}

```

* Todas las provincias de la base de datos
```
[servidor]/api/provincias
``` 
Devuelve un JSON con la siguiente estructura:
```
{
    "provincia":string
}

```
### POST

* Pregunta
```
[servidor]/api/pregunta
``` 
Debe enviar un JSON con la siguiente estructura:
```
{
    "pregunta":string,
}

```

* Respuesta a una pregunta por id
```
[servidor]/api/respuesta/{id}
``` 
Debe enviar un JSON con la siguiente estructura:
```
{
    "respuesta":string,
}
```
### PUT
* Perfil
```
[servidor]/api/perfil
``` 
se puede actualizar toda la informacion o parte de ella
```
{
    "nombre":string,
    "apellidos":string,
    "genero":string,
    "correo":string,
    "telefonos":array,
    "dataNaixement":date,
    "hospital":string
}

``` 

## La API se ha construido con 🛠️

* [PHP](https://www.php.net/) - Lenguaje web backend 
* [Symfony](https://symfony.com/) - Framework PHP para desarrollo de Apps Webs y APIs
* [Composer](https://getcomposer.org/) - Gestión de paquetes y entorno de compilación de la API.
* [MySQL](https://www.mysql.com/) - Base de datos
* [PHPMyAdmin](https://developer.android.com/studio) - Gestor web de la base de datos de MySQL



## Wiki 📖

Este proyecto no tiene una wiki especifica que no sean los comentarios dentro del código.

## Autores ✒️

* **Manel Ferrer** - [github](https://github.com/manyf00)
* **Javier Martin** - [github](https://github.com/wachipurry)
* **Yahya El Kajouai** - [github](https://github.com/yahyaelk)



## Licencia 📄

Este proyecto está bajo la **Licencia de software de semi libre**

## Expresiones de Gratitud 🎁

* Gracias al **Institut Pedralbes de Barcelona** y a sus profesores📢.
* Gracias también al **Institut Català d'Oncologia** por ofrecernos el reto 🤓.