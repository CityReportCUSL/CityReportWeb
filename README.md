# CityReportWeb
Aplicación web para la gestión de incidencias y recolección de estadísticas.

### Live Demo: http://www.cityreport.ga

## Contribuidores
- @pquina [código PHP base para crear la miniatura thumbnail.](https://gist.github.com/pqina/7a42bf0833d988dd81d3c9438009da21)
- @pointhi [imágenes para los marcadores de colores.](https://github.com/pointhi/leaflet-color-markers)

## Mapa
<a href="http://cityreport.ga/mapa.php" rel="CityReport.ga" target="_blank">![CityReport.ga](https://gyazo.com/6b1c4e1c31e0ba619f11c392f4231862.jpg)</a>

- En la parte del mapa podremos ver las localizaciones de todos los reportes realizados por los usuarios en un mapa interactivo.
- Además ver el contenido cada reporte haciendo click en su marcador.

## Reportes

<a href="http://cityreport.ga/reportes.php" rel="CityReport.ga Reportes" target="_blank">![CityReport.ga Reportes](https://cityreportnews.files.wordpress.com/2020/01/reportes.png)</a>

- En la sección reportes podremos ver un lista de todos los reportes realizados, así como ordenarlos según los campos: estado, id, descripción o fecha. 

## Inicio

<a href="http://cityreport.ga/inicio.php" rel="CityReport.ga Inicio" target="_blank">![CityReport.ga Inicio](https://cityreportnews.files.wordpress.com/2020/01/captura-1.png)</a>

- En esta sección podremos ver gráficamente estadísticas de los reportes realizados: cuántos están pendientes, revisados o finalizados, así como la progresión de reportes a lo largo del año en un gráfico acumulativo.


## Acerca de

<a href="http://cityreport.ga/acercade.php" rel="CityReport.ga Acerca de" target="_blank">![CityReport.ga Acerca de](https://cityreportnews.files.wordpress.com/2020/01/captura3.png)</a>

- Esta sección es meramente informativa, donde brindamos información sobre el proyecto así como información de contacto.


### Notas

- El script conexionbd.php que establece conexion con la base de datos no está subido por motivos de seguridad.
- Todas las secciones que muestran información así como gráficas de los reportes se generan en tiempo real con el contenido de la base de datos rellena con los reportes de colaboración ciudadana.
