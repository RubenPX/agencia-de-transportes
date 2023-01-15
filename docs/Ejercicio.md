# Tarea online

## Contenidos

1. Orientación a objetos en PHP.
   1. Características de orientación a objetos en PHP.
   2. Creación de clases.
        - Creación de clases (I).
        - Creación de clases (II).
        - Creación de clases (III).
   3. Utilización de objetos.
        - Utilización de objetos (I).
        - Utilización de objetos (II).
   4. Mecanismos de mantenimiento del estado.
   5. Herencia.
        - Herencia (I).
        - Herencia (II).
   6. Interfaces.
        - Interfaces (I).
   7. Ejemplo de POO en PHP.
        - Ejemplo de POO en PHP (I).
2. Programación en capas.
    1. Namespaces en PHP.
    2. Gestionar Dependencias. Composer.
    3. Separación de la lógica de negocio.
        - Separación de la lógica de negocio (I).
    4. Generación del interface de usuario.

> ## Resultados de aprendizaje
>
> - __RA 5__: Desarrolla aplicaciones Web identificando y aplicando mecanismos para separar el código de presentación de la lógica de negocio.
> - __RA 6__: Desarrolla aplicaciones de acceso a almacenes de datos, aplicando medidas para mantener la seguridad y la integridad de la información.

## 1. Descripción de la tarea

<center>PROYECTO AGENCIA DE TRANSPORTES</center>

El proyecto Agencia de transportes es un proyecto colaborativo que se va a desarrollar en diferentes módulos de los ciclos Desarrollo de Aplicaciones Web. El objetivo de este proyecto es el desarrollo de una aplicación para la gestión de una empresa de transportes.

En este módulo se creará el backend de la aplicación, que permitirá la administración de todos los envios, clientes, repartidores, etc. A continuación, se van a ir presentando las diferentes interfaces que hay que desarrollar y su funcionalidad. Muchas de ellas ya se han realizado en tareas anteriores, pero en esta tarea hay que modificarlas para seguir la POO.

### LOGIN
  
Está página permitirá loguearse tanto al administrador como a los repartidores. Dependiendo del perfil se accederá a una parte de la aplicación o a otra.
  
Primero se va a describir las funcionalidades del administrador y luego se explicarán las de los repartidores.

### PRINCIPAL_ADMINISTRADOR

En esta página se mostrará el menú principal (Clientes, Envíos, Repartidores y Poblaciones). Además, en esta y en __todas las páginas__ de la aplicación se mostrará en todo momento el nombre del usuario y le ofrecerá la opción de cerrar sesión.

### CLIENTES

Desde el menú clientes de la página principal se accedera al listado de clientes. Desde este listado se podrá borrar un cliente, ver sus datos y modificarlos y crear un nuevo cliente.

Un cliente sólo se puede borrar si no ha realizado ningún envío. En el caso de que haya realizado algún envío, el cliente pasará a estar inactivo (activo=0).

Cuando se crea un nuevo cliente, directamente el cliente estará activo (activo=1).

### POBLACIONES

En esta parte se gestionan las poblaciones con las que trabaja nuestra empresa. Se podrá ver todas las poblaciones, ver los datos de una concreta, añadir una nueva, modificar o borrar una población.

Si se desea eliminar una población hay que tener en cuenta que se eliminará esa población del repartidor que la tenga asignada. (Para simplificar la aplicación sólo habrá un repartidor  por población).

Además, al visualizar los datos de una población se podrá ver quien es su repartidor, borrarlo o asignar uno nuevo.

### REPARTIDORES

Gestiona los repartidores: se muestran todos los repartidores de la empresa, se puede añadir uno nuevo, modificar o borrar. Además, al borrar un repartidor se debe eliminar su asignación a la población.

Al consultar los datos de un repartidor se le podrá asignar o borrar una población.

### ENVÍOS

Se gestionan todos los envíos. Permite visualizar todos los envíos, realizar búsquedas de envíos, consultar los datos de un envío (cliente, destinatario, remitente y avisos) y borrar un envío (no puede tener avisos). 

Además, se podrá crear un nuevo envío para un cliente existente (el estado del envío será “recogido”).

### PRINCIPAL_REPARTIDOR

En esta pantalla habrá un botón “Obtener Envíos” que cuando se pulsé se obtendrán aquellos envíos de la población que tenga asignada el repartidor y cuyo estado sea “recogido” o “en reparto” y la fecha anterior a la actual.  Además, se modificará el estado de los envíos cuyo estado sea “recogido” a “en reparto”.

Una vez el repartidor pueda ver todos los envíos que tiene asignados para ese día podrá añadir un aviso a un envío o modificar su estado a entregado.

> El objetivo de esta tarea es el desarrollo de esta aplicación __por parejas__ utilizando los nuevos conceptos aprendidos en la unidad: la programación orientada a objetos, la separación de la lógica de negocio, composer y el __motor de plantillas Blade__.

## 2. Información de interés

> Recursos Necesarios:
>
> - Ordenador con un entorno AMP instalado y correctamente configurado, acceso a internet y un navegador.
> - Xdebug instalado y configurado para PHP.
> - Composer instalado
> - Visual Studio Code instalado con las extensiones que hemos ido viendo, incluida la extensión para Xdebug.

> Recomendaciones:
> 
> - Además del manual online de PHP, se recomienda dar libre acceso a Internet para la búsqueda de información.

## 3. Indicaciones de entrega

Una vez realizada la tarea, se entregará un documento con las pruebas realizadas, un documento con el diagrama de clases y una carpeta con el código de la aplicación. Recordad que el código siempre debe ir comentado.

Todo ello se comprimirá en un fichero que tendrá como nombre:

- nombreGrupo_DWES05_Tarea

El envío se realizará a través de la plataforma moodle. Con que la realice uno de los miembros del equipo es suficiente.

## 4. Evaluación de la tarea

Criterios de evaluación implicados

- RA 5: Desarrolla aplicaciones Web identificando y aplicando mecanismos para separar el código de presentación de la lógica de negocio.

| Descripción                                                                                                            | %      |
| ---------------------------------------------------------------------------------------------------------------------- | ------ |
| Se han identificado las ventajas de separar la lógica de negocio de los aspectos de presentación de la aplicación.     | 0      |
|                                                                                                                        |        |
| Se han analizado tecnologías y mecanismos que permiten realizar esta separación y sus características principales.     |        |
| Crea la estructura correcta del proyecto y se instalan correctamente las dependencias                                  | 0.5    |
| Se han utilizado objetos y controles en el servidor para generar el aspecto visual de la aplicación Web en el cliente. |        |
| Se han creado las vistas de forma correcta y se les pasan los parámetros necesarios                                    | 2.5    |
| Se han utilizado formularios generados de forma dinámica para responder a los eventos de la aplicación Web.            |        |
| Los formularios funcionan correctamente, controlando posibles errores.                                                 | 2.5    |
| Se han identificado y aplicado los parámetros relativos a la configuración de la aplicación Web.                       |        |
| Utiliza correctamente  "namespaces"                                                                                    | 0.5    |
| Se han escrito aplicaciones Web con mantenimiento de estado y separación de la lógica de negocio.                      |        |
| Crea la estructura correcta del proyecto y se instalan correctamente las dependencias                                  | 0.5    |
| Se han aplicado los principios de la programación orientada a objetos.                                                 |        |
| Se han creado las clases correctamente, con los metodos necesarios.                                                    | 2.5    |
| Se ha probado y documentado el código.                                                                                 |        |
| El código está comentado                                                                                               | 1      |
|                                                                                                                        | __10__ |

- RA 6. Desarrolla aplicaciones de acceso a almacenes de datos, aplicando medidas para mantener la seguridad y la integridad de la información.

| Descripción                                                                                                                        | %      |
| ---------------------------------------------------------------------------------------------------------------------------------- | ------ |
| a) Se han analizado las tecnologías que permiten el acceso mediante programación a la información disponible en almacenes de datos | 0      |
| b) Se han creado aplicaciones que establezcan conexiones con bases de datos                                                        | 0      |
| Se ha creado una clase conexion                                                                                                    | 0.25   |
| c) Se ha recuperado información almacenada en bases de datos                                                                       |        |
| Se obtienen los datos de clientes                                                                                                  | 0.25   |
| Se obtinen los datos de repartidores                                                                                               | 0.5    |
| Se obtienen los datos de poblaciones                                                                                               | 0.25   |
| Se obtienen los datos de las envios                                                                                                | 0.5    |
| Se controla el acceso de los usuarios                                                                                              | 0.5    |
| d) Se ha publicado en aplicaciones web la información recuperada                                                                   |        |
| Se muestran los datos recuperados de cliente/s                                                                                     | 0.25   |
| Se muestran los datos recuperados de repartidor/es                                                                                 | 0.25   |
| Se muestran los datos de poblacion/es                                                                                              | 0.25   |
| Se muestran los datos de los aviso/s                                                                                               | 0.5    |
| e) Se han utilizado conjuntos de datos para almacenar la información                                                               |        |
| f) Se han creado aplicaciones web que permitan la actualización y la eliminación de información disponible en una base de datos    |        |
| Se gestionan clientes: nuevos, modificar, borrar, desactivar                                                                       | 0.5    |
| Se gestionan poblaciones: añadir, modificar, borrar, asignar repartidor, borrar repartidor                                         | 1.5    |
| Se gestionan repartidores: añadir, modificar, borrar, asignar poblacion borrar poblacion, obtener envios                           | 1.75   |
| Se gestionan envíos: añadir y borrar                                                                                               | 1.75   |
| g) Se han utilizado transacciones para mantener la consistencia de la información                                                  |        |
| Se utilizan transacciones cuando son necesarias.                                                                                   | 0.5    |
| h) Se han probado y documentado las aplicaciones                                                                                   |        |
| Se entrega manual de pruebas                                                                                                       | 0.5    |
|                                                                                                                                    | __10__ |

> - 80% Resultados de aprendizaje. 
> - 20% Competencias transversales.

> - Trabajo en equipo
> - Creatividad e innovación
> - Tratamiento de la información y competencia digital
> 
> [Rúbrica](https://docs.google.com/spreadsheets/d/1zaeTf7cnXTWHg2-seewchMz7CmB-ObRkbmjNcFJCVFk/edit?usp=sharingpBDuRwVQo/edit?usp=sharing)