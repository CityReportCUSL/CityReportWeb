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
    map.panBy(new L.Point(-offset, 0), {animate: false});

    var markersLayer = L.featureGroup().addTo(map);
    


    function cambiarMapa(lat, lon, idP)
    {
        //layerGroup.clearLayers();
        
        var marker = L.marker([lat, lon]).addTo(markersLayer).on("click",clickMarker.bind(null,idP));
        
        
        // map.setView([lat, lon],16);   
    }
            
</script>

<?php include 'funcionesphp/conexionbd.php'?>

<script>

    map.setView([<?php echo $Latitud?> ,<?php echo $Longitud?>],<?php echo $zoom ?>);    
 
    
</script> 


<?php
    $consulta="SELECT * FROM reportes";
    $res=mysqli_query($conexion,$consulta);

    while($mostrar=mysqli_fetch_array($res)){

?>

<script>
cambiarMapa(<?php echo $mostrar['Latitud'] ?>,<?php echo $mostrar['Longitud'] ?>,<?php echo $mostrar['id'] ?>);
</script>


<?php } ?>
