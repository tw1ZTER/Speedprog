<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/detalle-solicitud.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/header.css">
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/Slider.js"></script>
    <link rel="icon" href="../../img/Speedprogicon.PNG">

    <title>SpeedProg</title>

<body>
<nav class="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo">SpeedProg Asesorias</label>
        <?php 
        //Este detalle de solicitud es utilizado exclusivamente desde la seleccion de una solicitud disponible hecha por un tutor
        if(!isset($_SESSION)){
            session_start();
        };
        if(isset($_SESSION['user'])){
            $mail = $_SESSION['user'];
            include_once '../login/verificacion.php';
        }else{
            header("Location: ../login/loginIndex.php?error_mensaje=0");
            $userName = '';   
            $tipo = '';
        }
          
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            //header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        //realizar webeo de base de datos despues
        ?>
    </nav>

    <section>
<div>
<?php 
        $idSolicitud = $_REQUEST['id_solicitud'];

        if(!isset($idSolicitud)){
            header("Location: ../index/index.php?error_mensaje=1");
            // Intentar entrar por medios alternativos o directamente
        }else if($idSolicitud=='errorTutor1'){
            header("Location: ../index/index.php?error_mensaje=6");
        }
        $idSolicitud = $_REQUEST['id_solicitud'] or die("Error al ingresar a la pagina");
   
        $sqlTest5 = "SELECT * FROM solicitud WHERE id_solicitud='$idSolicitud'";
        
        $registros5 = mysqli_query($conexion, $sqlTest5) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg5 = mysqli_fetch_row($registros5);

        if($reg5[6]==='2'){
            header("Location: ../index/index.php?error_mensaje=2");
        }
        


        $sqlTest0 = "SELECT id_especialidad_fk FROM solicitud WHERE id_solicitud='$idSolicitud'";
        $registros = mysqli_query($conexion, $sqlTest0) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $regIdEspecialidad = mysqli_fetch_row($registros) or die("Problemas en la seleccion.");
        $sql = "SELECT * FROM usuario_especialidad WHERE id_especialidad_fk ='$regIdEspecialidad[0]' AND id_usuario_fk='$userId'";
        $registros2 = mysqli_query($conexion, $sql) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $sqlEsp = "SELECT especialidad FROM especialidad WHERE id_especialidad='$reg5[11]'";
        $regEsp = mysqli_query($conexion, $sqlEsp) or die("Problemas en la seleccion:" . mysqli_error($conexion));
        $reg6 = mysqli_fetch_row($regEsp);
        if ($registros2->num_rows === 0 && $tipo=='3'){
                    
            header("Location: ../solicitudes-disponibles/solicitudes-disponibles.php?error_mensaje=0");
        }else{
            $regIdEspecialidad2 = mysqli_fetch_row($registros2);
        }
        $buscarTutor = $reg5[9];
        if(isset($buscarTutor)){
            $sqlTutor = "SELECT nombre FROM usuario WHERE id_usuario = $buscarTutor";
            $registrosTut = mysqli_query($conexion, $sqlTutor) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regTut = mysqli_fetch_row($registrosTut);
        }
        $buscarUsuario = $reg5[8];
        if(isset($buscarUsuario)){
            $sqlUsuario1 = "SELECT nombre, premium FROM usuario WHERE id_usuario = $buscarUsuario";
            $registrosUsuario = mysqli_query($conexion, $sqlUsuario1) or die("Problemas en la seleccion!:" . mysqli_error($conexion));
            $regUsuario1 = mysqli_fetch_row($registrosUsuario);
        }
        $buscarEstado = $reg5[6];
        if(isset($buscarEstado)){
            $sqlEstado = "SELECT estado_solicitud FROM estado_solicitud WHERE id_estado_solicitud = $buscarEstado";
            $registroEstados1 = mysqli_query($conexion, $sqlEstado) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            $regEstado = mysqli_fetch_row($registroEstados1);
        }


        ?>
   

<section class="detalle-box">
    <h1>DETALLE SOLICITUD</h1><br>

    <table border="1" width="700" align="center">
        <tr>
            <th>Enunciado</th>
            <th>Detalles</th>
        </tr>

        <tr>
            <th>Titulo</th>
            <td><?php echo $reg5[1]?></td>
        </tr>
        <tr>
            <th>Descripcion</th>
            <td><?php echo $reg5[2]?></td>
        </tr>
        <tr>
            <th>Premium</th>
        <td><?php 
    if($regUsuario1[1]==0){
        echo "No";
    }else{
        echo "Si";?>
        <i class="fa fa-star" style="color:#af7d31fb;"></i><?php
    }
    ?></td>
    </tr>
        <tr>
        <th>Estado de la solicitud</th>
        
        <td><?php if(isset($buscarEstado)){
echo $regEstado[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
    </tr>
        <tr>
            <th>Usuario</th>
            <td><?php if(isset($buscarUsuario)){
echo $regUsuario1[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
        </tr>
        <tr>
            <th>Tutor</th>
            <td><?php if(isset($buscarTutor)){
echo $regTut[0];
    }else{
echo "Sin determinar";
    }
    
    ?></td>
        </tr>
        <tr>
            <th>Fecha de Ingreso</th>
            <td><?php echo $reg5[3]?></td>
        </tr>
        <tr>
            <th>Especialidad</th>
            <td><?php echo $reg6[0]?></td>
        </tr>
    

    </table>
<form method="POST" action="media.php?permiso=1">
            <?php 
                echo "<input type='hidden' id='idSolicitud1' name='idSolicitud1' value='$reg5[0]'>"; //id solicitud
                echo "<input type='hidden' id='idUsuario1' name='idUsuario1' value='$reg5[8]'>"; //id usuario
                if(isset($reg5[9])){
                    echo "<input type='hidden' id='idTutor1' name='idTutor1' value='$reg5[9]'>"; //id tutor 
                }else{
                    echo "<input type='hidden' id='idTutor1' name='idTutor1' value='sin-tutor'>";
                }
                echo "<input type='hidden' id='idEspecialidad1' name='idEspecialidad1' value='$regIdEspecialidad[0]'>"; //id especialidad
            ?>
            <input id="BtnVerMedia" type='submit' value='Ver media'>
            </form>
<?php

if($tipo == 3){
?>
<form method="POST" action="agregar-detalle-solicitud.php?permiso=1">
<?php 
    echo "<input type='hidden' id='idSolicitud1' name='idSolicitud1' value='$reg5[0]'>"; //id solicitud
    echo "<input type='hidden' id='idUsuario1' name='idUsuario1' value='$reg5[8]'>"; //id usuario
    echo "<input type='hidden' id='idTutor1' name='idTutor1' value='$userId'>";
    echo "<input type='hidden' id='idEspecialidad1' name='idEspecialidad1' value='$regIdEspecialidad[0]'>"; //id especialidad
?><?php 
if($userId!=$reg5[8]){
    echo "<br><input id='BtnCancelar' type='submit' value='Aceptar solicitud'>";
}
}else if($tipo == 4){
?>
<form method="POST" action="cancelar-solicitud.php?permiso=1">
<?php 
    echo "<input type='hidden' id='idSolicitud1' name='idSolicitud1' value='$reg5[0]'>"; //id solicitud
    echo "<input type='hidden' id='idUsuario1' name='idUsuario1' value='$reg5[8]'>"; //id usuario
    if(isset($reg5[9])){
        echo "<input type='hidden' id='idTutor1' name='idTutor1' value='$reg5[9]'>"; //id tutor 
    }else{
        echo "<input type='hidden' id='idTutor1' name='idTutor1' value='sin-tutor'>";
    }
    echo "<input type='hidden' id='idEspecialidad1' name='idEspecialidad1' value='$regIdEspecialidad[0]'>"; //id especialidad
?>
<input id="BtnCancelar" type='submit' value='Cancelar solicitud'>



</form>
<?php
}
?>


        <br>
        <a class="fa fa-arrow-left fa-xs"id="Volver" href="javascript:history.back()"> Volver</a>

</section>  
</div>
    </section>
    <?php 
    mysqli_close($conexion);
    ?>

    <?php 
    include_once '../estructura/footer.php';
    ?>

</body>

</html>