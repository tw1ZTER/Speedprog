<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="../../css/perfil-cliente.css">
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/Slider.js"></script>

    <title>SpeedProg</title>

<body>
<nav id="nav-cab">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="logo"><a href="../../main.html" >Abogados United</a><?php 
        if(isset($user)){
            echo " Bienvenido ". $user->getNombre();
            $tipo = $user->getTipo();
        }else{
            require('../login/login.php');
            
            
        } 
         ?></label>
       
        <ul>
            <li><a href="../login/logout.php">Salir</a></li>
        </ul>
    </nav>

    <section>

PERFIL CLIENTE
    </section>
    <footer>
        <div class="container-footer-all">
            <div class="container-body">
                <div class="colum2">
                    <h1>Redes Sociales</h1>
                    <div class="row">
                        <a href="https://www.facebook.com/"><img src="/img/fbicon.png"></a>
                        <label>Siguenos en Facebook</label>
                    </div>
                    <div class="row">
                        <a href="https://twitter.com/?lang=es"><img src="/img/twittericon.png"></a>
                        <label>Siguenos en Twitter</label>
                    </div>
                    <div class="row">
                        <a href="https://www.instagram.com/?hl=es-la"><img src="/img/igicon.png"></a>
                        <label>Siguenos en Instagram</label>
                    </div>
                    <div class="row">
                        <a href="https://myaccount.google.com/?tab=kk"><img src="/img/gmailicon.png"></a>
                        <label>Siguenos en Google+</label>
                    </div>
                    <div class="row">
                        <a href="https://www.pinterest.cl/"><img src="/img/pinteresticon.png"></a>
                        <label>Siguenos en Pinterest</label>
                    </div>
                </div>
                <div class="colum3">
                    <h1>Informacion Contactos</h1>
                    <div class="row2">
                        <img src="/img/locationicon.png">
                        <label>Ahumada 312, oficina 108 entrepiso. Santiago Centro. Chile</label>
                    </div>
                    <div class="row2">
                        <img src="/img/phone.png">
                        <label>(56)-2-2695-79-19</label>
                    </div>
                    <div class="row2">
                        <img src="/img/mailicon.png">
                        <label>info@abogadosunited.cl</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-footer">
            <div class="footer">
                <div class="copyright">
                    © 2022 Todos los derechos reservados | <b>SpeedProg</b>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/efectoPaginaPrincipal.js"></script>



</body>

</html>