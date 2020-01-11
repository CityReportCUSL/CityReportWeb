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

    var map = L.map('mapa').
        setView([37.2655892,-6.9362852],14);
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
        window.location.href = "http://www.cityreport.ga/mapa.php?v1="+id+"&zoom="+zoom;
        
    
        
    }

    function cambiarMapa(lat, lon, idP)
    {
        //layerGroup.clearLayers();
        
        var marker = L.marker([lat, lon]).addTo(markersLayer).on("click",clickMarker.bind(null,idP));
        
        
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
?>
<script>
 $.notify({
        // options
        message: '<img style="width:100%;height:100%; border-radius: 20px; object-fit: cover;" src="<?php echo $foto ?>"/> <br><h2 style="text-align:center;"><?php echo $nombre ?></h2>',
        title: '<h2 class="center-block">Reporte ID: <?php echo $id ?></h2><h3>Fecha: <?php echo $timestamp ?></h3><h3>Estado: <?php echo $estado ?></h3>',
        icon:'' 
    },{
        // settings
        type: 'danger',
        icon_type: 'image',
        delay: 0

    });
    map.setView([<?php echo $Latitud?> ,<?php echo $Longitud?>],<?php echo $zoom ?>);    
 
    
</script> 

<?php
}

?>
<?php
$consulta="SELECT * FROM cityreportBD.reportes";
$res=mysqli_query($conexion,$consulta);

while($mostrar=mysqli_fetch_array($res)){

    ?>
    <script>
    cambiarMapa(<?php echo $mostrar['Latitud'] ?>,<?php echo $mostrar['Longitud'] ?>,<?php echo $mostrar['id'] ?>);
    </script>


<?php } ?>
