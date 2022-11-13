
<?php
    include 'encabezado.php';
    include 'conexion.php';
?>

<?php
    if (isset($_GET['del'])) {
        $idb=$_GET['del'];
        $borrar="DELETE FROM Alumnos where IdAlumnos='$idb'";
        $eliminar=$conn->query($borrar);
        header('location:Alumnos.php');
    }
    if (isset($_POST['ingreso'])) {
        # code...
        
        $nombre=$_POST['nombre'];
        $institucion=$_POST['institucion'];
        $tiposerv=$_POST['tiposerv'];
        $direccion=$_POST['direccion'];
        $numcel=$_POST['numcel'];
        $correo=$_POST['correo'];
        $numemerg=$_POST['numemerg'];
        $insertar="INSERT INTO Alumnos(nombre,institucion,direccion,tipoServ,numCel,correo,numEmerg) VALUES ('$nombre','$institucion','$tiposerv','$direccion','$numcel','$correo','$numemerg')";
    
        $resultadp=$conn->query($insertar);
        if (!$resultadp) {
            
            echo 'error al Registrarse '.$conn->error;
        }else{
        
        }
    }

    if (isset($_POST['cambio'])) {
        # code...

        $nombre=$_POST['nombre'];
        $institucion=$_POST['institucion'];
        $tiposerv=$_POST['tiposerv'];
        $direccion=$_POST['direccion'];
        $numcel=$_POST['numcel'];
        $correo=$_POST['correo'];
        $numemerg=$_POST['numemerg'];

        $Cambiar="UPDATE Alumnos SET nombre='$nombre',institucion='$institucion',tipoServ='$tiposerv',direccion='$direccion',numCel='$numcel',correo='$correo',numEmerg='$numemerg'";
        
        $resultado2=$conn->query($Cambiar);
        
        if (!$resultado2) {
            
            echo 'error al Registrarse '.$conn->error;
        }else{
        }
    }

    
?>

<section class='container mb-5 mt-5'>
    <h2 class='mt-5'>Alumnos Registrados</h2>
    <?php
        $coman='SELECT * FROM Alumnos';
        $datos=$conn->query($coman);
    ?>

    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="row w3-right">
            <div class="col-8">
            <input class="w3-input" type="text" name="matrib" id="matrib" placeholder="Buscar por Nombre" required> 
            </div>
            <div class="col">
            <input class="w3-button w3-round w3-blue" type="submit" value="Buscar" name="enviarBus">
            </div>
        </div>
        
       
        
        </form>
    </div>
        <section class='mb-5 mt-5'>
            <?php
                if (isset($_POST['enviarBus'])) {
                    $busqueda =$_POST['matrib'];
                    $bus="SELECT * FROM Alumnos WHERE Nombre='$busqueda'";
                    $resultb=$conn->query($bus);
                    if ($resultb->num_rows >0) {
                        echo '
                    <h2>Registros encontrados</h2>
                    <table class="table">
                    <thead>
                    <th>Nombre</th>
                            <th>Institucion</th>
                            <th>Tipo de Servicio</th>
                            <th>Direccion</th>
                            <th>Numero Celulular</th>
                            <th>Correo</th>
                            <th>Numero Emergencia</th>
                           
                    </thead>
                    <tbody>
                    ';
                    while ($filarb=$resultb->fetch_array()) {
                        # code...
                        echo '
                        <tr>
                        <td>'.$filarb["nombre"].'</td>
                        <td>'.$filarb["institucion"].'</td>
                        <td>'.$filarb["tipoServ"].'</td>   
                        <td>'.$filarb["direccion"].'</td>
                        <td>'.$filarb["numCel"].'</td>
                        <td>'.$filarb["correo"].'</td>
                        <td>'.$filarb["numEmerg"].'</td>
                      
                        </tr>
                        ';
                        
                    }

                    echo '
                        </tbody>
                    </table>
                    ';

                    }else{
                        echo '<br>
                        <div class="alert alert-danger" role="alert">
                        <strong>ERROR DE BUSQUEDA!</strong> No se encontro ningun Alumno con ese Nombre '.$busqueda.'.
                        </div>
                        ';
                    }
                }
            ?>
           
                    
                
        </section>
    
    <table class='table mb-5 mt-5'>
        
        <thead>
            <th colspan="3">Todos los prestadores de Servicio</th>
               <td colspan="6" class='d-flex justify-content-start'> <button class='w3-green w3-button w3-round' title="Agregar Alumno" onclick='document.getElementById("modalAlta").style.display="block"'><i class="fas fa-plus"></i></button></td>
               
        </thead>
            
        <tbody>
            <?php
                $sql="SELECT * FROM Alumnos";
                $re=$conn->query($sql);
                if ($re->num_rows >0){
                    ?>
                    <tr>
                        <td style="visibility: hidden;"></td>
                        <th>Nombre</th>
                        <th>Institucion</th>
                        <th>Tipo de Servico</th>
                        <th>Direccion</th>
                        <th>Numero Cel</th>
                        <th>Correo</th>
                        <th>Numero Emergencia</th>
                    
                        <th colspan="2">Acciones</th>
                    </tr>
                    
                    <?php
                    while ($filal=$re->fetch_array()) {
                        echo '
                        <tr>
                        <td style="visibility:collapse;">'.$filal["IdAlumnos"].'</td>
                        <td>'.$filal["Nombre"].'</td>
                        <td>'.$filal["Institucion"].'</td>
                        <td>'.$filal["TipoServ"].'</td>   
                        <td>'.$filal["Direccion"].'</td>
                        <td>'.$filal["NumCel"].'</td>
                        <td>'.$filal["Correo"].'</td>
                        <td>'.$filal["NumEmerg"].'</td>
                       
                        <td><button type="button" id="editbtn" class="editbtn w3-blue w3-button w3-round" data-bs-toggle="modal" data-bs-target="#ModalEditar"><i class="far fa-edit"></i></button></td>';
                        echo "<td><button onclick='preguntar(".$filal['IdAlumnos'].")' class='w3-button w3-round w3-red' title='Borrar Elemento'><i class='far fa-trash-alt'></i></button></td>
                        </tr>
                        ";
                    }
                    
                } else {
                    echo "<td ROWSPAN='8'>No hay Alumnos registrados</td>";
                }
            ?>
        </tbody>

    </table>

</section>
<div class="c modal" tabindex="-1" id='modalAlta'>
    <style>
        .c{
            background-color: rgba(0, 0, 0,0.6);
        }
    </style>
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Añadir Alumno</h5>
        <button type="button" onclick="document.getElementById('modalAlta').style.display='none'" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class='mb-4'>Porfavor, ingrese los datos solicitados.</h4>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="">Nombre Completo del alumno: </label> 
                    <input class='w3-input' name='nombre' type="text" placeholder="Nombre Completo" required>
                    <label for="">Institucion: </label>
                    <input class='w3-input' name='institucion' type="text" required>
                    <label for="">Tipo Servicio: </label>
                    <input class='w3-input' name='tipo de servicio' type="text" placeholder="Servicio" required>
                    <label for="">Direccion: </label>
                    <select class='w3-select' name="genero" id="Genero" required>
                        <option value="Mujer" selected>Fenenino</option>
                        <option value="Hombre">Masculino</option>
                        <option value="Indefinido">Otro</option>
                    </select>
                    <label for="">Numero Celular: </label> 
                    <input class='w3-input' name='numero celular' type="text" placeholder="Numero celular" required>
                    <label for="email">Correo: </label>
                    <input class='w3-input' type="email" name='email' id='email' placeholder="Correo Electronico" required>
                    <label for="">Numero Emergencia: </label>
                    <input class='w3-input' name='numero emergencia' type="text" placeholder="Numero Emergencia" required>
                
                    
            
        
      <div class="modal-footer">
        <button type="button" onclick="document.getElementById('modalAlta').style.display='none'" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit" name='ingreso' class='btn btn-primary' value="Guardar">
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<!--Comando para confirmar el borrado de un registro y posteriormente borrarlo-->
<script>
    function preguntar(IdAlumnos){
        if(confirm('¿Estas seguro que quieres Eliminar este alumno?.')){
            window.location.href='Alumnos.php?del='+IdAlumnos;
        }
    }
</script>




<!-- Modal para editar-->
<div class="modal fade" id="ModalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Datos del Alumno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name='idca' id='update_id'>
                    <label for="">Nombre Completo del alumno: </label> 
                    <input class='w3-input' id='nombre' name='nombre' type="text" placeholder="Nombre Completo" required>
                    <label for="">Institucion: </label>
                    <input class='w3-input' name='institucion' type="text" required>
                    <label for="">Tipo de Servicio: </label>
                    <input class='w3-input' id='TipoServ' name='TipoServ' type="text" placeholder="TipoServ" required>
                    <label for="">Direccion: </label>
                    <select class='w3-select' name="genero" id="Genero" required>
                        <option value="Mujer">Fenenino</option>
                        <option value="Hombre">Masculino</option>
                        <option value="Indefinido">Otro</option>
                    </select>
                    <label for="">Numero celular: </label>
                    <input class='w3-input' name='numero celular' type="text" placeholder="Numero celular" required>
                    <label for="">Correo: </label>
                    <input class='w3-input' type="text" name='email' id='emeil' placeholder="Correo Electronico" required>
                    <label for="">Numero Emergencia: </label>
                    <input class='w3-input' name='numero emergencia' type="text" placeholder="Numero Emergencia" required>
                
                   
                        




                    <!--</select>
                    <label for="">Matricula</label>
                    <input type="text" name='matricula' id='matricula' class="w3-input" placeholder="Matricula"> -->
            
        
      <div class="modal-footer">
        <button type="button" class="w3-button w3-round w3-border" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit" name='cambio' class='w3-button w3-blue w3-round w3-border' value="Guardar Cambios">
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

<!--script para el modal editar-->
<script>
    $('.editbtn').on('click',function(){
        $tr=$(this).closest('tr');
        var datos=$tr.children("td").map(function(){
            return $(this).text();
        });

        $('#update_id').val(datos[0]);
        $('#matricula').val(datos[1]);
        $('#nombre').val(datos[2]);
        $('#fecha').val(datos[3]);
        $('#Ciudad').val(datos[4]);
        $('#Genero').val(datos[5]);
        $('#emeil').val(datos[6]);
        $('#grado').val(datos[7]);
        $('#grupos').val(datos[8]);
    })
</script>
                    

<?php
    include 'pie.php';
?>
<!--
    Lineas de respaldo
    <button class='w3-button w3-round'><i class="fas fa-trash"></i></button>
-->