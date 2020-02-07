<html>

<style>
    #loaderLogin{
        -webkit-animation: 2s rotate linear infinite;
        animation: 2s rotate1 linear infinite;
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
    }

    @keyframes rotate1 {
        0% {
            transform: rotate(0);
            animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
         }
        50% {
            transform: rotate(90deg);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        100% {
            transform: rotate(180deg);
        }
    }
</style>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CRM | EDESAL</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">



    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/angular/angular.js"></script>
    <script src="js/crm/credenciales.js"></script>

</head>

<body class="green-bg" ng-app="Inicio" style="background-image: url('img/fondo2.png'); background-size: cover">

<div class="middle-box text-center loginscreen animated fadeInDown">


    <div  style="border: solid 1px black; padding: 25px; background-color: white; margin-top: 150px;
    ">

            <img src="img/miniLogo.png" alt="" id=""  width="70px">

                <h2 style="color:#04546D; font-weight:bold;">EDESAL | CRM</h2>

            <form class="m-t" role="form" action="index.html" ng-controller="Credenciales">
                <div class="form-group">
                    <input type="text" class="form-control" id="user" ng-model="usuario" placeholder="Usuario" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" ng-model="password" placeholder="Contraseña" required="">
                </div>
                <button type="button" ng-click="iniciarSesion()" 
                style="background-color:#04546D;"
                class="btn btn-primary block full-width m-b">Inicio de sesion</button>
                <div ng-hide="alerta" class="alert alert-dismissable alert-danger"><i class="fas fa-exclamation-circle"></i> Error al validar credenciales</div>
            </form>


    </div>
</div>


<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $("form :input").attr("autocomplete", "off");
});
</script>


</body></html>