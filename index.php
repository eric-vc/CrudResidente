<?php
    include 'conexion.php';
    include 'encabezado.php';
    
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <section class='container p-4 mb-5 mt-5'>
        <div class='row align-items-center gx-5'>

            <div class='col'>
                <table class='table'>
                    <thead>
                        <th>Numero de Alumnos registrados</th>
                    </thead>
                    <tbody>

                <?php
                    $al1='SELECT * FROM Alumnos';
                    $conla=$conn->query($al1);
                        # code...
                        echo '<th>'.$conla->num_rows.' Registrados actualemente</th>';
                    
                ?>
                    

                    </tbody> 
                </table>
                <a href="AlumnosPdf.php"><button class='w3-button  w3-round w3-border w3-hover-purple'><i class="fas fa-file-pdf"></i> Imprimir listado de alumnos detallado</button></a>
                <table class='mt-5 table'>
                    <thead>
                        <th>Grupos</th>
                        <th>Periodos</th>
                        <th colspan='2'>Acciones</th>
                    </thead>
                    <tbody>

                       
                    </tbody>
                </table>
            </div>
 
            <div class='col justify-content-center' align='center' >
                <canvas id='myChart' ></canvas><br>
                
            </div>

        </div>
    </section>

    <section class='container mt-5 mb-5'>
        <div class='row gx-5 '>
            
            <div class='col'>
                <table class="table">
                    <thead>
                        <th>Servicios Disponibles</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            
            <div class='col'>
                <table class="table">
                    <thead>
                        <th>Docentes</th>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>

        </div>
    </section>
   
    

    <script>
        
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            <?php
                $la='SELECT * FROM Grupos';
                $conla=$conn->query($la);
                while ($filaA=$conla->fetch_array()) {
                    # code...
                   ?>
                    '<?php echo $filaA['NombreGru'].' '.$filaA['PeriodoGrup'] ?>',
                    <?php
                }
                ?>
                
        ],
        datasets: [{
            label: 'Cantidad de Alumnos por grupo',
            data:[
            <?php
                    $grg='SELECT * FROM Grupos';
                    $cgrg=$conn->query($grg);
                    
                        
                    while ($filag=$cgrg->fetch_array()) {
                        $gr="SELECT * FROM Alumnos WHERE IdGrupo='$filag[IdGrupos]'";
                        $cgr=$conn->query($gr);
                            # code...
                            
                                # code...
                            
                            $filac=$cgr->num_rows;
                            ?>
                            
                            <?php echo $filac; ?>,
                    
                    
                <?php
                            
                    }
                
                ?>    
                ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(44,217,221,0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(44,217,221,0.2)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


 

 
</script>
<?php
    include 'pie.php';
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Rajdhani:wght@300;400;500&display=swap');
    *{
        font-family: 'Montserrat', sans-serif;

font-family: 'Rajdhani', sans-serif;
    }
</style>