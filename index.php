<!doctype html >
<html lang="es">
<?php include 'fragmentos/cabecera.php'?> 


<?php 
    include 'funcionesphp/conexionbd.php';

    $consulta="SELECT COUNT(*) FROM cityreportBD.reportes where ESTADO LIKE 'pendiente'";
    $res=mysqli_query($conexion,$consulta);
    $pendiente=mysqli_fetch_row($res)[0];

    $consulta="SELECT COUNT(*) FROM cityreportBD.reportes where ESTADO LIKE 'revisado'";
    $res=mysqli_query($conexion,$consulta);
    $revisado=mysqli_fetch_row($res)[0];
    
    $consulta="SELECT COUNT(*) FROM cityreportBD.reportes where ESTADO LIKE 'finalizado'";
    $res=mysqli_query($conexion,$consulta);
    $finalizado=mysqli_fetch_row($res)[0];
        
?>

<?php 
    $pendientes=array();
    $revisados=array();
    $finalizados=array();
    for ($i = 1; $i <= 12; $i++) {
        
        $consulta="SELECT COUNT(*) FROM cityreportBD.reportes where ESTADO LIKE 'pendiente' and TIMESTAMP<='2019-$i-01 00:00:01'";
        $res=mysqli_query($conexion,$consulta);
        $pendiente1=mysqli_fetch_row($res)[0];

        $consulta="SELECT COUNT(*) FROM cityreportBD.reportes where ESTADO LIKE 'revisado'and TIMESTAMP<='2019-$i-01 00:00:01'";
        $res=mysqli_query($conexion,$consulta);
        $revisado1=mysqli_fetch_row($res)[0];
        
        $consulta="SELECT COUNT(*) FROM cityreportBD.reportes where ESTADO LIKE 'finalizado'and TIMESTAMP<='2019-$i-01 00:00:01'";
        $res=mysqli_query($conexion,$consulta);
        $finalizado1=mysqli_fetch_row($res)[0];

        array_push($pendientes,$pendiente1);
        array_push($revisados,$revisado1);
        array_push($finalizados,$finalizado1);
    }

        
?>
    <div class="main-panel">

        
    
        <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">Inicio</a>
                    </div>
                    <div class="collapse navbar-collapse">

                    </div>
                </div>
            </nav>
        


        <div class="content">
            <div class="container-fluid">
            
            <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Reportes</h4>
                                <p class="category">Según estado</p>
                            </div>
                            <div id="cambiante">
                                <canvas id="doughnutChart"></canvas>
                            </div>
                            <div id="cambios">
                                <a id="bgrafica1"class="btn btn-light" aria-disabled="true"><i class="fa fa-pie-chart" style="font-size:18px"></i></a>
                                
                                <a id="bgrafica2"class="btn btn-light" aria-disabled="true"><i class="fa fa-bar-chart" style="font-size:18px"></i></a>
                            </div>
                               
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Total Reportes</h4>
                                <p class="category">Acumulados según estado y fecha </p>
                            </div>
                            <div id="cambiante2">
                                <canvas id="lineChart"></canvas>
                            </div>
                            <br><br>
                           
                        </div>
                    </div>
                



            


            </div>

   
            </div>
        </div>     

       
    <?php include 'fragmentos/pie.php'?> 

</body>


</html>

<script>
 var graf1=0;
 var graf2=0;
$( document ).ready(function() {
    if(graf2==0){
        var pendientesJS=<?php echo json_encode($pendientes);?>;
        var revisadosJS=<?php echo json_encode($revisados);?>;
        var finalizadosJS=<?php echo json_encode($finalizados);?>;

        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
        labels: ["Enero", "Febrero", "Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        datasets: [{
        label: "Pendientes",
        data: pendientesJS,
        backgroundColor: [
            "#F7464A33",
        ],
        borderColor: [
            "#FF5A5E",
        ],
        borderWidth: 2
        },
        {
        label: "Revisados",
        data: revisadosJS,
        backgroundColor: [
            "#FDB45C33",
        ],
        borderColor: [
            "#FFC870",
        ],
        borderWidth: 2
        },
        {
        label: "Finalizados",
        data: finalizadosJS,
        backgroundColor: [
            "rgba(107, 255, 66, 0.2)",
        ],
        borderColor: [
            "#82ff47",
        ],
        borderWidth: 2
        }
        ]
        },
        options: {
        responsive: true
        }
        });
    }
    if(graf1==0){
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
    labels: ["Finalizado", "Pendiente", "Revisado"],
    datasets: [{
    data: [<?php echo $finalizado;?>, <?php echo $pendiente;?>, <?php echo $revisado;?>],
    backgroundColor: [  "#82ff47","#F7464A","#FDB45C"],
    hoverBackgroundColor: [ "#24ff24","#FF5A5E", "#FFC870"]
    }]
    },
    options: {
    responsive: true
    }});
    graf1=1;
    }
    $("#bgrafica1").on( "click", function() {
        if(graf1==2){
            $("#cambiante").html(' <canvas id="doughnutChart"></canvas>')
            var ctxD = document.getElementById("doughnutChart").getContext('2d');
            var myLineChart = new Chart(ctxD, {
            type: 'doughnut',
            data: {
            labels: ["Finalizado", "Pendiente", "Revisado"],
            datasets: [{
            data: [<?php echo $finalizado;?>, <?php echo $pendiente;?>, <?php echo $revisado;?>],
            backgroundColor: [  "#82ff47","#F7464A","#FDB45C"],
            hoverBackgroundColor: [ "#24ff24","#FF5A5E", "#FFC870"]
            }]
            },
            options: {
            responsive: true
            }});
            graf1=1;
        }
    });

    $("#bgrafica2").on( "click", function() {
        if(graf1==1){
            $("#cambiante").html(' <canvas id="doughnutChart"></canvas>')
            var ctxD = document.getElementById("doughnutChart").getContext('2d');
            var myLineChart = new Chart(ctxD, {
            type: 'bar',
            data: {
            labels: ["Finalizado", "Pendiente", "Revisado"],
            datasets: [{
            label: 'Reportes',
            data: [<?php echo $finalizado;?>, <?php echo $pendiente;?>, <?php echo $revisado;?>],
            backgroundColor: [  "#82ff47","#F7464A","#FDB45C"],
            hoverBackgroundColor: [ "#24ff24","#FF5A5E", "#FFC870"]
            }]
            },
            options: {
            scales: {
            yAxes: [{
            ticks: {
            beginAtZero: true
            }
            }]
            }
            }           
            });
            graf1=2;
        }
    });

});


</script>