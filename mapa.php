<!doctype html>
<html lang="es">
<?php include 'fragmentos/cabecera.php'?> 

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Mapa</a>
                    </div>
                    <div class="collapse navbar-collapse">

                    </div>
                </div>
            </nav>
        <div class="content">    
            <div class="container-fluid">
            <div id = 'mapa'></div>
            
            <div id="extra" style="display: none">
                <?php 
                    include 'fragmentos/inforeporte.php';
                ?>
            </div>
   
            </div>
        </div>     
    <?php include 'fragmentos/pie.php'?> 
</body>
</html>

<script>
    // ICONOS DE LOS MARCADORES SEGUN ESTADO
    var finalizado = new L.Icon({
        iconUrl: '/assets/img/marker-icon-2x-green.png',
        shadowUrl: '/assets/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var revisado = new L.Icon({
        iconUrl: '/assets/img/marker-icon-2x-orange.png',
        shadowUrl: '/assets/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var pendiente = new L.Icon({
        iconUrl: '/assets/img/marker-icon-2x-red.png',
        shadowUrl: '/assets/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var seleccionado = new L.Icon({
	iconUrl: '/assets/img/marker-icon-2x-blue.png',
	shadowUrl: '/assets/img/marker-shadow.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
});


    var map = L.map('mapa').
        setView([37.2655892,-6.9362852],14); //Huelva
    var layer =L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'CityReport - Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'
        }).addTo(map);
    L.control.scale().addTo(map);
                
    var offset = map.getSize().x*0.15;
    // Then move the map
    map.panBy(new L.Point(-offset, 0), {animate: false});

    //var layerGroup = L.layerGroup().addTo(map);
    var markersLayer = L.featureGroup().addTo(map);

    

    
    function clickMarker(id,event)
    {
        
        var zoom = map.getZoom();
    
        window.location.href = "http://www.cityreport.ga/mapa.php?v1="+id+"&zoom="+zoom+"&marker="+markersLayer.getLayerId(event.target);
        

    }

    function cambiarMapa(lat, lon, idP, estado)
    {
        //layerGroup.clearLayers();

        var marker = L.marker([lat, lon],{icon: estado}).addTo(markersLayer).on("click",clickMarker.bind(null,idP));
        
        
        // map.setView([lat, lon],16);   
    }
            
</script>

<?php include 'funcionesphp/conexionbd.php'?>

<?php
    // comprobar si tenemos los parametros w1 y w2 en la URL
    if (isset($_GET["v1"])) {
    // asignar w1 y w2 a dos variables
   
    $zoom = $_GET["zoom"];
    $id = $_GET["v1"];
    $consulta2="SELECT * FROM cityreportBD.reportes where id=$id";
    $res2=mysqli_query($conexion,$consulta2);
    $mostrar2=mysqli_fetch_array($res2);
    $Latitud=$mostrar2['Latitud'];
    $Longitud=$mostrar2['Longitud'];
    $foto=$mostrar2['foto'];
    $nombre=$mostrar2['nombre'];
    $estado=$mostrar2['estado'];
    $timestamp=$mostrar2['timestamp'];

    $markerId = $_GET["marker"];

?>

<script>
 $.notify({
        // options
        message: '<img style="width:100%;height:100%; border-radius: 20px; object-fit: cover;" src="<?php echo $foto ?>"> <br><h4 style="text-align:center;"><?php echo $nombre ?></h4>',
        title: '<h2 class="center-block">Reporte ID: <?php echo $id ?></h2><h4>Fecha: <?php echo $timestamp ?></h4><h4>Estado: <?php echo $estado ?></h4>',
        icon:'' 
    },{
        // settings
        type:  '<?php if($estado=="pendiente") echo 'danger'; elseif ($estado=="revisado") echo 'warning'; else echo 'success'; ?>',
        icon_type: 'image',
        delay: 0

    });
    map.setView([<?php echo $Latitud?> ,<?php echo $Longitud?>],<?php echo $zoom ?>);   //Centrar la vista en el reporte seleccionado
    
    
    
</script> 

<?php
} //if isset 

?>
<?php
$consulta="SELECT * FROM cityreportBD.reportes";
$res=mysqli_query($conexion,$consulta);

while($mostrar=mysqli_fetch_array($res)){

    ?>
    <script>


    cambiarMapa(<?php echo $mostrar['Latitud'] ?>,<?php echo $mostrar['Longitud'] ?>,<?php echo $mostrar['id'] ?>,<?php echo $mostrar['estado'] ?>);
    </script>


<?php } ?>

<script> //Cambiar el color del marcador seleccionado a azul
     markersLayer.getLayer(<?php echo $markerId ?>).setIcon(seleccionado); 
</script>
