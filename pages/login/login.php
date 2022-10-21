<?php 

    include_once 'user.php';
    include_once 'userSession.php';

    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
        
        $user->setUser($userSession->getCurrentUser());


    }else if(isset($_POST['correo']) && isset($_POST['password'])){
        $correoForm = $_POST['correo'];
        $passForm = $_POST['password'];
        
        $user = new User();

        if($user->userExists($correoForm,$passForm)){
            $userSession->setCurrentUser($correoForm);
            $user->setUser($correoForm);
            header("Location: ../perfil-cliente/perfil-cliente.php"); 

        }else{
            $errorLogin = "user o pass incorrecto";
            header("Location: login/loginIndex.php"); 
        }

    }else{
        header("Location: login/loginIndex.php"); 
    }

?>