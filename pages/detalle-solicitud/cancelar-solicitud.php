<?php 
if(!isset($_GET['permiso'])){
    header("Location: ../index/index.php?error_mensaje=0");
}


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
        echo " ".$userName;   
        include_once '../estructura/listaNav.php';
        if($tipo == 2){
            header("Location: ../login/loginIndex.php?error_mensaje=0");
        }
        




require("../../php/conexionBD.php");
$conexion = mysqli_connect($dbHost,$dbUser,$dbPassword);
if(mysqli_connect_errno()){
    echo "fallo la conexion";
    exit();
}
mysqli_select_db($conexion, $dbName) or die("No se encuentra la base de datos"); 




$idSolicitud1 = $_REQUEST["idSolicitud1"];
$idUsuario1 = $_REQUEST["idUsuario1"];
$idTutor1 = $_REQUEST["idTutor1"];
$idEspecialidad1 = $_REQUEST["idEspecialidad1"];
$date = date('y-m-d h:i:s');

$sqlUpdate1 = "UPDATE solicitud SET estado_solicitud_fk = '5' WHERE id_solicitud='$idSolicitud1'";
$registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion:" . mysqli_error($conexion));

header("Location: ../index/index.php?cancelar_solicitud=0");

?>