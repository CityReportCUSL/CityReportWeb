<!doctype html>
<?php
    include "funcionesphp/conexionbd.php";

    if(empty($_GET)){
        $order='id';
    }else{
        $order=$_GET['order'];
    }

?>

<html lang="en">

    <?php include 'fragmentos/cabecera.php'?> 
    <div id="txtHint">
    
 <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">

                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="reportes.php">Reportes</a>
                </div>
                <div class="collapse navbar-collapse">
                   


                </div>
            </div>
        </nav>
        <?php
        
            $consulta="SELECT * FROM cityreportBD.reportes ORDER BY '".$order."'";
            $res=mysqli_query($conexion,$consulta);
        ?>
         

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Listado de Reportes</h4>
                                <p class="category">Haz click en un reporte para ver al detalle</p>
                            </div>
                           
                            <div class="content table">
                                <table class="table table-hover table-striped">
                                    <thead  >
                                        <th class="col-md-2 col-xs-4">Foto</th>
                                        <th  class="col-md-1 col-xs-2"><button class="btn btn-outline-light" onclick="ordenar('id')">ID</button></th>
                                    	<th  class="col-md-4 hidden-xs"><button class="btn btn-outline-light" onclick="ordenar('nombre')">Descripción</button></th>
                                    	<th  class="col-md-3 hidden-xs"><button class="btn btn-outline-light" onclick="ordenar('timestamp')">Fecha</button></th>
                                    	<th class="col-md-2 col-xs-6"><button class="btn btn-outline-light" onclick="ordenar('estado')" >Estado</button></th>
                                    </thead>
                                    <tbody>
                                        <?php $cont = 76; while($mostrar=mysqli_fetch_array($res)){?> 
                                        <tr onclick="document.location = 'mapa.php?v1=<?php echo $mostrar['id'] ?>&zoom=16&marker=<?php echo $cont?>';"><div class="row">
                                        	<td class="col-md-2 col-xs-4"><img src="<?php echo $mostrar['miniatura'] ?>" style="width:100%;height:100px; border-radius: 10px; object-fit: cover;" ></td>
                                        	<td class="col-md-1 col-xs-2"><?php echo $mostrar['id'] ?></td>
                                        	<td class="col-md-4 hidden-xs"><?php echo $mostrar['nombre'] ?></td>
                                        	<td class="col-md-3 hidden-xs"><?php echo $mostrar['timestamp'] ?></td>
                                        	<td class="col-md-2 col-xs-6"><?php echo $mostrar['estado'] ?></td>
                                            </div>
                                        </tr>
                                        <?php $cont+=2; } ?>   
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    </div>                                     

    <?php include 'fragmentos/pie.php'?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script>
        function ordenar(e) {
            
            if (e == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","fragmentos/report.php?order="+e,true);
                xmlhttp.send();
            }
        }        
    </script>
    

</body>


</html>
