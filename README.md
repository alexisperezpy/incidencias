
# Sistema para gestión de Incidencias 
----
* El sistema permite reportar incidencias por cada proyecto, estas incidencias son gestionadas a través de los distintos niveles de atención (ej. Mesa de ayuda, soporte remoto, visita técnica, etc.)

### Demo
- Para ver la demo del proyecto puede ingresar a: http://app-incidencia.herokuapp.com/ 

### Reglas de Negocio aplicables al proyecto

- Proyecto A -> puede tener varios niveles 
    - N1 Mesa de Ayuda (Soporte remoto)  
    - N2 Ayuda por teléfono (Soporte telefónico)
    - N3  Atención Técnica (Vista Técnica)
- Un usuario puede estar en varios niveles pero en un solo nivel por proyecto, es decir; 
    - Usuario A está en el nivel 2 del Proyecto ALFA como "especialista", y también puede estar en el nivel 3 del Proyecto BETA como "Visita técnica"


### Tablas relevadas 
    - Proyectos 
    - Usuarios
    - Niveles
    - Incidencias
    - Categorias
    - ProyectoUsuario
