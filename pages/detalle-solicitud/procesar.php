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
           
        include_once '../estructura/listaNav.php';
        
        ?>

<?php


if($tipo == '2'){
    header("Location: ../index/index.php?error_mensaje=0");
}else{
   
    
    
    
    $idSolicitud1 = mysqli_real_escape_string($conexion, $_POST['idSolicitud1']);
    $texto = mysqli_real_escape_string($conexion, $_POST['textoSolucion1']);
    $linkVideo = mysqli_real_escape_string($conexion, $_POST['video1']);
    //$userId; Tutor
    //$date = date('y-m-d h:i:s');
    
    $sqlUpdate1 = "UPDATE solicitud SET  estado_solicitud_fk = '3', respuesta_tutor = '$texto' WHERE id_solicitud='$idSolicitud1'";
    $registrosUpdate1 = mysqli_query($conexion, $sqlUpdate1) or die("Problemas en la seleccion update solicitud:" . mysqli_error($conexion));

    $fileCount = count($_FILES['file']['name']);
        if($fileCount > 0 ){
            
            for($i=0;$i<$fileCount;$i++){
                $fileName = $_FILES['file']['name'][$i];
                
                if ($fileName !== ""){
                    
                    $sqlMediaDocumento = "INSERT INTO media (index_imagen, id_solicitud_fk, id_usuario_fk) VALUES ('$fileName', '$idSolicitud1', '$userId')";
                    $regImagenIngreso = mysqli_query($conexion, $sqlMediaDocumento) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                    $IDMedia = mysqli_insert_id($conexion);
                    $newMod = $IDMedia.$fileName;
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], '../../imagenes/'.$newMod);
                    $sqlMediaMod = "UPDATE media SET index_imagen = '$newMod' WHERE id_media = '$IDMedia'";
                    $regMod = mysqli_query($conexion, $sqlMediaMod) or die("Problemas en la seleccion:" . mysqli_error($conexion));
                }
                
            }
        }
       

        if($linkVideo!=''){
            $pattern="/(?:https?:\/\/)?(?:www\.)?youtu\.?be(?:\.com)?\/?.*(?:watch|embed)?(?:.*v=|v\/|\/)([\w\-_]+)\&?/";
            if($resultadoVideo = preg_match($pattern, $linkVideo, $match)){ 
                
                $sqlMediaVideo = "INSERT INTO media (link_video, id_solicitud_fk, id_usuario_fk) VALUES ('$match[1]', '$idSolicitud1', '$userId')";
               $regxdxd = mysqli_query($conexion, $sqlMediaVideo) or die("Problemas en la seleccion:" . mysqli_error($conexion));
            }
            
            
        }
    
    
    
    
    
mysqli_close($conexion);
header("Location: ../mis-solicitudes/mis-solicitudes.php?exito=2");
    
    
    
}



?>