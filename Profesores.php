<?php
    include 'encabezado.php';
    include 'conexion.php';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
    if (isset($_POST['addp'])) {
        # code...
        $nombrei=$_POST["nombre"];
        $correoi=$_POST["correo"];
        $generoi=$_POST["genero"];
        $insert="INSERT INTO Profesor(NombreP,CorreoP,Genero) VALUES ('$nombrei','$correoi','$generoi')";
        $entry=$conn->query($insert);
        if (!$entry) {
            # code...
            echo '
            <div class="container">
                <div class="w3-panel w3-pale-red w3-round w3-leftbar w3-rightbar w3-border-red">
                <h2>ERROR FATAL!</h2>
                <p>Hubo un erro al registrar al profesor: </p>'.$conn->error.'
                </div> 
                </div>
            ';
        }
    }



    if (isset($_GET['del'])) {
        $idb=$_GET['del'];
        $borrar="DELETE FROM Profesor where IdProfe='$idb'";
        $eliminar=$conn->query($borrar);
        header('location:Profesores.php');
    }
?>

<section class='container mb-5 mt-5'>
    <h2>Lista de profesores</h2>

    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="row w3-right">
            <div class="col-8">
            <input class="w3-input" type="text" name="matrib" id="matrib" placeholder="Buscar por id Clave" required> 
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
                    $bus="SELECT * FROM Profesor WHERE IdProfe='$busqueda'";
                    $resultb=$conn->query($bus);
                    if ($resultb->num_rows >0) {
                        echo '
                    <h2>Registros encontrados</h2>
                    <table class="table">
                    <thead>
                    <th>Id</th>
                        <th>Profesor</th>
                        <th>Correo</th>
                        <th>Genero</th>
                    </thead>
                    <tbody>
                    ';
                    while ($filarb=$resultb->fetch_array()) {
                        # code...
                        echo '
                        <tr>
                        <td>'.$filarb["IdProfe"].'</td>
                        <td>'.$filarb["NombreP"].'</td>
                        <td>'.$filarb["CorreoP"].'</td>
                        <td>'.$filarb["Genero"].'</td>
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
                        <strong>ERROR DE BUSQUEDA!</strong> No se encontro ningun Docente con la clave '.$busqueda.'.
                        </div>
                        ';
                    }
                }
            ?>
             </section>

    <table class='table'>
        <thead>
            <tr>
                <th>Docentes</th>
                <th><button class='w3-button w3-round w3-green' name='new' data-bs-toggle="modal" data-bs-target="#addmg" title='Agregar Nueva Matera'><i class="fas fa-plus"></i></button></th>
                
            </tr>
        </thead>

        <tbody>
            <?php
                $pr="SELECT * FROM Profesor";
                $conp=$conn->query($pr);
                if ($conp->num_rows > 0){
                    ?>
                    <tr>
                        <th>Id</th>
                        <th>Profesor</th>
                        <th>Correo</th>
                        <th>Genero</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    
                    <?php
                    while ($filal=$conp->fetch_array()) {
                        echo '
                        <tr>
                        <td>'.$filal["IdProfe"].'</td>
                        <td>'.$filal["NombreP"].'</td>
                        <td>'.$filal["CorreoP"].'</td>
                        <td>'.$filal["Genero"].'</td>
                        <td><button type="button" id="editbtn" class="editbtn w3-blue w3-button w3-round" data-bs-toggle="modal" data-bs-target="#ModalEditar"><i class="far fa-edit"></i></button></td>';
                        echo "<td><button onclick='preguntar(".$filal['IdProfe'].")' class='w3-button w3-round w3-red' title='Borrar Elemento'><i class='far fa-trash-alt'></i></button></td>

                        </tr>
                        ";
                    }
                    
                } else {
                    echo "<td ROWSPAN='8'>No hay profesores</td>";
                }
            ?>
        </tbody>
    </table>
</section>

<!-- Modal para agregar-->
<div class="modal fade" id="addmg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profesor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="">Nombre Completo del Docente: </label> 
                    <input class='w3-input mb-2 mt-2' name='nombre' type="text" placeholder="Nombre Completo" required>
                    <label for="email">CorreoP</label>
                    <input class='w3-input mb-2 mt-2' name='correo' type="email" placeholder="Correo Electronico" required>
                    <label for="">Genero: </label>
                    <select class='w3-select mb-2 mt-2' name="genero" required>
                        <option value="Mujer">Fenenino</option>
                        <option value="Hombre">Masculino</option>
                        <option value="Indefinido">Otro</option>
                    </select>
        
      <div class="modal-footer">
        <button type="button" class="w3-button w3-round w3-border" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit" name='addp' class='w3-button w3-blue w3-round' value="Agregar Docente">
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar-->
<div class="modal fade" id="ModalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Datos del Docente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name='idca' id='update_id'>
                <label for="">Nombre Completo del Docente: </label> 
                <input class='w3-input mb-2 mt-2' id='nombre' name='nombre' type="text" placeholder="Nombre Completo" required>
                <label for="email">CorreoP</label>
                <input class='w3-input mb-2 mt-2' id='correo' name='correo' type="email" placeholder="Correo Electronico" required>
                <label for="">Genero: </label>
                <select class='w3-select mb-2 mt-2' name="genero" id="Genero" required>
                    <option value="Mujer">Fenenino</option>
                    <option value="Hombre">Masculino</option>
                    <option value="Indefinido">Otro</option>
                </select>
        
      <div class="modal-footer">
        <button type="button" class="w3-button w3-round w3-border" data-bs-dismiss="modal">Cerrar</button>
        <input type="submit" name='cambio' class='w3-button w3-blue w3-round' value="Guardar Cambios">
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
        $('#nombre').val(datos[1]);
        $('#correo').val(datos[2]);
        $('#Genero').val(datos[3]);
        
    })
</script>


<!--Comando para confirmar el borrado de un registro y posteriormente borrarlo-->
<script>
    function preguntar(IdProfe){
        if(confirm('¿Estas seguro que quieres Eliminar este alumno?.')){
            window.location.href='Profesores.php?del='+IdProfe;
        }
    }
</script>

<?php
    include 'pie.php';
?>