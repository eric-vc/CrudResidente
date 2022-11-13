<?php
    include 'encabezado.php';
    include 'conexion.php';
?>

    <?php
        if (isset($_POST['newma'])) {
            # code...
            $nombreg=$_POST['nombre'];
            $clave=$_POST['clave'];
            $grado=$_POST['grado'];

            $coninsert="INSERT INTO Materias(Nombre,Clave,Grado) VALUES('$nombreg','$clave','$grado') ";
            $insert=$conn->query($coninsert);
            if (!$insert) {
                # code...
                echo '
                <div class="container">
                <div class="w3-panel w3-pale-red w3-round w3-leftbar w3-rightbar w3-border-red">
                <h2>ERROR FATAL!</h2>
                <p>No puedes poner una matricula similar a otra materia</p>
                </div> 
                </div>
                ';           
            }
        }

        


        if (isset($_POST['edicion'])) {
            # code...
    
            $idca=$_POST['id'];
            $nombre=$_POST['nombre'];
            $clave=$_POST['clave'];
            $grado=$_POST['grado'];
    
            $Cambiar="UPDATE Materias SET Nombre='$nombre',Clave='$clave',Grado='$grado' WHERE IdMateria='$idca'";
            
            $resultado2=$conn->query($Cambiar);
            
            if (!$resultado2) {
                
                echo 'error al Registrarse '.$conn->error;
            }else{
            }
        }

        if (isset($_GET['del'])) {
            $idb=$_GET['del'];
            $borrar="DELETE FROM Materias where IdMateria='$idb'";
            $eliminar=$conn->query($borrar);
            header('location:Materias.php');
        }

        if (isset($_GET['del1'])) {
            $idb1=$_GET['del1'];
            $borrar1="DELETE FROM MateriasGrupo where IdMateriaG='$idb1'";
            $eliminar1=$conn->query($borrar1);
            header('location:Materias.php');
        }

        //Seccion  para administrar las clases

        if (isset($_POST['addclase'])) {
            # code...
            $matrimg=$_POST['idmg'];
            $materiamg=$_POST['materiap'];
            $docentemg=$_POST['docente'];
            $grupomg=$_POST['grupo1'];
            $insertmg="INSERT INTO MateriasGrupo(IdProfe,IdMaterias,IdGrupo,MatriClas) VALUES('$docentemg','$materiamg','$grupomg','$matrimg')";
            $entrymg=$conn->query($insertmg);
            if (!$entrymg) {
                # code...
                echo '
            <div class="container">
                <div class="w3-panel w3-pale-red w3-round w3-leftbar w3-rightbar w3-border-red">
                <h2>ERROR FATAL!</h2>
                <p>Hubo un erro al registrar la clase: </p>'.$conn->error.'
                </div> 
                </div>
            ';
            }
        }
    ?>
    
    <section class='container mb-5 mt-5'>
    <h2>Lista de materias</h2>
    <?php
        $conmateria='SELECT * FROM Materias';
        $conexionm=$conn->query($conmateria);
    ?>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="row w3-right">
            <div class="col-8">
            <input class="w3-input" type="text" name="matrib" id="matrib" placeholder="Buscar por Clave" required> 
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
                    $bus="SELECT * FROM Materias WHERE Clave='$busqueda'";
                    $resultb=$conn->query($bus);
                    if ($resultb->num_rows >0) {
                        echo '
                    <h2>Registros encontrados</h2>
                    <table class="table">
                    <thead>
                    <th>Clave</th>
                    <th>Nombre</th>
                        
                        <th>Grado</th>
                    </thead>
                    <tbody>
                    ';
                    while ($filarb=$resultb->fetch_array()) {
                        # code...
                        echo "
                        <tr>
                        <td>".$filarb['Clave']."</td>
                        <td>".$filarb['Nombre']."</td>
                            
                            <td>".$filarb['Grado']."</td>
                        </tr>
                        ";
                        
                    }

                    echo '
                        </tbody>
                    </table>
                    ';

                    }else{
                        echo '<br>
                        <div class="alert alert-danger" role="alert">
                        <strong>ERROR DE BUSQUEDA!</strong> No se encontro ninguna Materia con la clave '.$busqueda.'.
                        </div>
                        ';
                    }
                }
            ?>
             </section>

    
    <table class='mt-5 mb-5 table'>
        <thead>
            <th>Todas Las materias</th>
            <th><button class='w3-button w3-round w3-green' name='new' data-bs-toggle="modal" data-bs-target="#addmateria" title='Agregar Nueva Matera'><i class="fas fa-plus"></i></button></th>
        </thead>

        <tbody>
            <?php
                if ($conexionm->num_rows >0){
                    ?>
                    <tr>
                        <th>Id de Materia</th>
                        <th>Nombre</th>
                        <th>Clave</th>
                        <th>Grado</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    
                    <?php
                    while ($fila=$conexionm->fetch_array()) {
                        # code...
                        echo "
                        <tr>
                            <td>".$fila['IdMateria']."</td>
                            <td>".$fila['Nombre']."</td>
                            <td>".$fila['Clave']."</td>
                            <td>".$fila['Grado']."</td>
                            <td><button class='editma w3-blue w3-button w3-round' data-bs-toggle='modal' data-bs-target='#modalEditar' title='Editar Elemento'><i class='far fa-edit'></i></button></td>
                            <td><button onclick='preguntar(".$fila['IdMateria'].")' class='w3-red w3-button w3-round' title='Borrar Elemento'><i class='far fa-trash-alt'></i></button></td>

                        </tr>
                        ";
                    }
                }else{
                    ?>
                       
                    <td colspan="5">no hay ninguna materia registrada</td>
                    <?php
                }
            ?>
        </tbody>
    </table>
    </section>

    <section class='mt-5 mb-5 container'>
        <button class='w3-button w3-round mb-4 mt-4 w3-border w3-hover-purple' data-bs-toggle='modal' data-bs-target='#addmg1'>Agregar Clases</button>
        
        <?php
            $lg='SELECT * FROM MateriasGrupo';
            $conlg=$conn->query($lg);
            
            if ($conlg->num_rows >0) {
                # code...
                while ($filalg=$conlg->fetch_array()) {
                    $doc2="SELECT * FROM Profesor WHERE IdProfe='".$filalg['IdProfe']."'";
                    $gru2="SELECT * FROM Grupos WHERE IdGrupos='".$filalg['IdGrupo']."'";
            $mat2="SELECT * FROM Materias WHERE IdMateria='".$filalg['IdMaterias']."'";
            $codoc2=$conn->query($doc2);
            $cogru2=$conn->query($gru2);
            $comat2=$conn->query($mat2);
                    # code...
                    echo '
                    <p>
                        <button class="w3-block w3-button w3-border" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$filalg['IdMateriaG'].'" aria-expanded="false" aria-controls="collapseExample">
                            '.$filalg['MatriClas'].'
                        </button>
                    </p>
                    <div class="collapse" id="collapse'.$filalg['IdMateriaG'].'">
                        <div class="card card-body">
                        <table class="table">
                        <thead>
                                <th>Id de clase</th>
                                <th>Matricula</th>
                                <th>Nombre de profesor</th>
                                <th>Grupo</th>
                                <th>Pediodo de grupo</th>
                                <th>Materia</th>
                                <th>Acciones</th>
                        </thead>
                        <tbody>
                        <td>'.$filalg["IdMateriaG"].'</td>
                        <td>'.$filalg["MatriClas"].'</td>
                        ';
                        while (($filadoc2=$codoc2->fetch_array())&&($filagru2=$cogru2->fetch_array())&&($filamat2=$comat2->fetch_array())) {
                            # code...
                            echo '
                            <td>'.$filadoc2["NombreP"].'</td>
                            <td>'.$filagru2["NombreGru"].'</td>
                            <td>'.$filagru2["PeriodoGrup"].'</td>
                            <td>'.$filamat2["Nombre"].'</td>
                            

                            ';
                        }
                        echo '
                       <!-- <td><button class="editmag w3-blue w3-button w3-round" data-bs-toggle="modal" data-bs-target="#editarmb" title="Editar Elemento"><i class="far fa-edit"></i></button></td>
                        -->    <td><button onclick="preguntar('.$filalg['IdMateriaG'].')" class="w3-red w3-button w3-round" title="Borrar Elemento"><i class="far fa-trash-alt"></i></button></td>
                        </tbody>
                        </table>
                        </div>
                        </div>
                        ';

                        
            
                    }
            }
        ?>

    

    </section>

    <!-- Modal  que edita clases temporalmente sin funcionar-->
<div class="modal fade" id="editarmb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Materia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php
            $doc='SELECT * FROM Profesor';
            $gru='SELECT * FROM Grupos';
            $mat='SELECT * FROM Materias';
            $codoc=$conn->query($doc);
            $cogru=$conn->query($gru);
            $comat=$conn->query($mat);
          ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
            <input type="hidden" id='update-idclas'>
            <Label>Matricula de la clase:</Label>
            <input type="text" id='matriclas' name='idmg' class='w3-input w3-border mb-2 mt-2' placeholder="Matricula">
            <label for="">Seleciona al Materia:</label>
            <select class='w3-select mt-2 mb-2' id='mateclas' name="materiap" >
            <?php
                while ($filamat=$comat->fetch_array()) {
                    # code...
                ?>
                        <option  value="<?php echo $filamat['IdMateria'] ;?>"><?php echo $filamat['Nombre'] ;?></option>
                <?php    
                }
            ?>
            </select>
            <label for="">Seleciona Docente:</label>
            <select class='w3-select mt-2 mb-2' id='doceclass' name="docente" >
            <?php
                while ($filadoc=$codoc->fetch_array()) {
                    # code...
                ?>
                        <option  value="<?php echo $filadoc['IdProfe'] ;?>"><?php echo $filadoc['NombreP'] ;?></option>
                <?php    
                }
            ?>
            </select>

            <label for="">Seleciona Grupo:</label>
            <select class='w3-select mt-2 mb-2' id='grupclass' name="grupo1" >
            <?php
                while ($filagru=$cogru->fetch_array()) {
                    # code...
                ?>
                        <option  value="<?php echo $filagru['IdGrupos'] ;?>"><?php echo $filagru['NombreGru'].' '.$filagru['PeriodoGrup'] ;?></option>
                <?php    
                }
            ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button w3-border w3-round" data-bs-dismiss="modal">Cancelar</button>
        <input type="submit" name='edicion' class="w3-button w3-blue w3-round" value='Añadir clase'>
        </form>
      </div>
    </div>
  </div>
</div>

<!--script para el modal editar clases temporalmente sin funcionar-->
<script>
    $('.editmag').on('click',function(){
        $tr=$(this).closest('tr');
        var datos=$tr.children("td").map(function(){
            return $(this).text();
        });

        $('#update-idclas').val(datos[0]);
        $('#matriclas').val(datos[1]);
        $('#doceclass').val(datos[2]);
        $('#grupclass').val(datos[3]);
        $('#mateclass').val(datos[4]);
        
    })
</script>


<!-- Modal  que inserta materias-->
<div class="modal fade" id="addmateria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Materia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
            <label for="">Materia:</label> 
            <input class='w3-input' name='nombre' type="text" placeholder="Nombre de Materia" required>
            <label for="">Clave:</label>
            <input class='w3-input' name='clave' placeholder="Clave de materia" type="text" required>
            <label for="">Grado: </label>
            <select name="grado" class='w3-select' id="grado" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>

            </select>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button w3-border w3-round" data-bs-dismiss="modal">Cancelar</button>
        <input type="submit" name='newma' class="w3-button w3-blue w3-round" value='Añadir materia'>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal  que edita materias-->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Materia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
            <input type="hidden" id='update_id' name='id'>
            <label for="">Materia:</label> 
            <input class='w3-input' id='nombre' name='nombre' type="text" placeholder="Nombre de Materia" required>
            <label for="">Clave:</label>
            <input class='w3-input' id='clave' name='clave' placeholder="Clave de materia" type="text" required>
            <label for="">Grado: </label>
            <select name="grado" class='w3-select' id="grado" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>

            </select>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button w3-border w3-round" data-bs-dismiss="modal">Cancelar</button>
        <input type="submit" name='edicion' class="w3-button w3-blue w3-round" value='Añadir Materia'>
        </form>
      </div>
    </div>
  </div>
</div>

<!--script para el modal editar-->
<script>
    $('.editma').on('click',function(){
        $tr=$(this).closest('tr');
        var datos=$tr.children("td").map(function(){
            return $(this).text();
        });

        $('#update_id').val(datos[0]);
        $('#nombre').val(datos[1]);
        $('#clave').val(datos[2]);
        $('#grado').val(datos[3]);
    })
</script>

<!--Comando para confirmar el borrado de un registro y posteriormente borrarlo-->
<script>
    function preguntar(IdMateria){
        if(confirm('¿Estas seguro que quieres Eliminar este alumno?.')){
            window.location.href='Materias.php?del='+IdMateria;
        }
    }
</script>



<!-- Modal  que inserta materias y grupos-->
<div class="modal fade" id="addmg1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enlazar Docente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <?php
            $doc='SELECT * FROM Profesor';
            $gru='SELECT * FROM Grupos';
            $mat='SELECT * FROM Materias';
            $codoc=$conn->query($doc);
            $cogru=$conn->query($gru);
            $comat=$conn->query($mat);
          ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
            <Label>Matricula de la clase:</Label>
            <input type="text" name='idmg' class='w3-input w3-border mb-2 mt-2' placeholder="Matricula">
            <label for="">Seleciona al Materia:</label>
            <select class='w3-select mt-2 mb-2' name="materiap" >
            <?php
                while ($filamat=$comat->fetch_array()) {
                    # code...
                ?>
                        <option  value="<?php echo $filamat['IdMateria'] ;?>"><?php echo $filamat['Nombre'] ;?></option>
                <?php    
                }
            ?>
            </select>
            <label for="">Seleciona Docente:</label>
            <select class='w3-select mt-2 mb-2' name="docente" >
            <?php
                while ($filadoc=$codoc->fetch_array()) {
                    # code...
                ?>
                        <option  value="<?php echo $filadoc['IdProfe'] ;?>"><?php echo $filadoc['NombreP'] ;?></option>
                <?php    
                }
            ?>
            </select>

            <label for="">Seleciona Grupo:</label>
            <select class='w3-select mt-2 mb-2' name="grupo1" >
            <?php
                while ($filagru=$cogru->fetch_array()) {
                    # code...
                ?>
                        <option  value="<?php echo $filagru['IdGrupos'] ;?>"><?php echo $filagru['NombreGru'].' '.$filagru['PeriodoGrup'] ;?></option>
                <?php    
                }
            ?>
            </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button w3-border w3-round" data-bs-dismiss="modal">Cancelar</button>
        <input type="submit" name='addclase' class="w3-button w3-blue w3-round" value='Añadir materia'>
        </form>
      </div>
    </div>
  </div>
</div>

<!--script para confirmar el borrado de clases y posteriormente borrarla-->
<script>
    function preguntar(IdMateriaG){
        if(confirm('¿Estas seguro que quieres Eliminar este alumno?.')){
            window.location.href='Materias.php?del1='+IdMateriaG;
        }
    }
</script>

<?php
    include 'pie.php';
?>