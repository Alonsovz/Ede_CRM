<!DOCTYPE html>
<html >

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CRM | EDESAL</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/ng-table@2.0.2/bundles/ng-table.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.0/sweetalert.min.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

 

    {{--CSS PARA DATETIMEPICK A PARTIR DE NODEMODULE--}}
    <link rel="stylesheet" href="node_modules/@ui-platform/angularjs-bootstrap4-datetimepicker/src/css/datetimepicker.css"/>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <script src="js/angular/angular.js"></script>
    <script src="js/angular/angular-route.js"></script>
    <script src="js/angular-datatable.js"></script>
    <script src="js/angular/angular-animate.js"></script>
    <script src="js/angular/angular-sanitize.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.4/moment-timezone-with-data-2010-2020.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-moment/1.3.0/angular-moment.min.js"></script>

    {{--DATETIMEPICKER FOR NODEMODULE--}}
    <script src="node_modules/@ui-platform/angularjs-bootstrap4-datetimepicker/src/js/datetimepicker.js"></script>
    <script src="node_modules/@ui-platform/angularjs-bootstrap4-datetimepicker/src/js/datetimepicker.templates.js"></script>
    <script src="node_modules/angular-date-time-input/src/dateTimeInput.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js"></script>

    <script src="js/angular/angular-file-upload.js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sweetalert/1.1.2/SweetAlert.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-calendar/1.0.0/calendar.js"></script>
    <script src="js/fullcalendar/fullcalendar.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.5/i18n/angular-locale_es-es.js'></script>
    <script src="js/crm/dashboard.js"></script>
    <script src="js/crm/clientes.js"></script>
    <script src="js/crm/suministros.js"></script>
    <script src="js/crm/atenciones.js"></script>
    <script src="js/crm/eventos.js"></script>
    <script src="js/crm/tickets.js"></script>
    <script src="js/crm/tramitescomerciales.js"></script>
    <script src="js/crm/edesalservice.js"></script>
    <script src="js/crm/reminders.js"></script>

    <script src="js/crm/reportes.js"></script>


<link rel="stylesheet" href="css/amaran.min.css">
<script src="//cdn.jsdelivr.net/jquery.amaran/0.5.4/jquery.amaran.min.js"></script>


    <style>
        #side-menu
        {
            background-color: white;
            height: 1500px;
            position: fixed;
            width: 225px;
        }

        .navbar-static-top
        {
            background-color:#20c997 ;
            color: black;
        }
        body{
            color:black;
        }
        html{
            color:black;
        }
      
    </style>

</head>



<body class="" ng-app="Dashboard">

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation" style="border:solid 1px lightgrey" >
        <div class="sidebar-collapse fixed-left">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img src="img/users.png" width="100" height="100" alt="">
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="." style="color: black">
                             <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Session::get('usuario')}}</strong>
                             </span> <span class="text-xs block">{{Session::get('alias')}}<b class="caret"></b></span> </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li style=""><a href="cerrarsesion">Cerrar sesion</a></li>
                        </ul>
                    </div>
                    <div class="logo-element" style="font-weight: bold">
                       CRM
                    </div>
                </li>


                @foreach(Session::get('roles') as $rol)
                    @if($rol->rol=="ejecutivo_ventas")
                        <li style="border:solid 1px lightgrey">
                            <a  style="color: black; font-size: medium;" class="hideNoti" href="#!clientes"><i class="fas fa-users"></i>
                                <span class=""> Clientes</span>

                            </a>

                        </li>

                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: medium;" class="hideNoti" href="#!suministros"><i class="fas fa-industry"></i>
                                <span class="nav-label"> Suministros</span>
                            </a>
                        </li>

                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: medium;" class="hideNoti" href="#!atenciones"><i class="fas fa-bell"></i>
                                <span class="nav-label">Atenciones</span>
                            </a>

                        </li>


                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: medium;" class="hideNoti" href="#!eventos"><i class="fas fa-calendar-alt"></i> <span class="nav-label">Eventos</span></a>

                        </li>

                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: medium;" class="hideNoti" href="#!ticketscrm"><i class="fas fa-ticket-alt"></i>
                                <span class="nav-label">Tickets CRM</span>
                            </a>

                        </li>

                        @elseif($rol->rol=="comercial")
                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: small;" class="hideNoti" href="#!tramitescomerciales"><i class="fas fa-home"></i>
                                <span class="nav-label">Tramites Comerciales</span>
                            </a>

                        </li>

                    @elseif($rol->rol=="area_tecnica")
                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: medium;"  class="hideNoti" href="#!ordenestrabajo"><i class="fas fa-file"></i>
                                <span class="nav-label">Ordenes de trabajo</span>
                            </a>
                        </li>

                    @elseif($rol->rol=="admin_tecnica")
                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: medium;" href="#!ordenestrabajoadmin"><i class="fas fa-file"></i>
                                <span class="nav-label">Ordenes de trabajo</span>
                            </a>
                        </li>

                    @elseif($rol->rol=="admin_ventas")
                        <li style="border:solid 1px lightgrey">
                            <a style="color: black; font-size: medium;" class="hideNoti" href="#!ordenestrabajoadminventas"><i class="fas fa-file"></i>
                                <span class="nav-label">Ordenes de trabajo</span>
                            </a>
                        </li>
                    @endif

                @endforeach
                <li style="border:solid 1px lightgrey">
                    <a style="color: black; font-size: medium;" class="hideNoti" href="#!reminders"><i class="fas fa-bell"></i>
                        <span class="nav-label">Reminders</span>
                    </a>

                </li>


                <li style="border:solid 1px lightgrey">
                    <a style="color: black; font-size: medium;" class="hideNoti" href="#!reportes">
                    <i class="fas fa-file"></i>
                        <span class="nav-label">Reportes</span>
                    </a>

                </li>

            </ul>

        </div>
    </nav>
    <?php

$serverName = "192.168.50.2";
$connectionInfo = array( "Database"=>"comanda_db", "UID"=>"sa", "PWD"=>"saedesal");
$conn = sqlsrv_connect( $serverName, $connectionInfo );

  if (!$conn)
      {exit("Fallo conexion: " . $conn);}
?>

<?php

$sql = "select count(id) as nocerrado from crm_atenciones
where atencion_cerrada = 'N'
and usuario_creacion = '".Session::get('alias')."' ";

$rs1 = sqlsrv_query( $conn, $sql );

while ($row = sqlsrv_fetch_array( $rs1, SQLSRV_FETCH_ASSOC))
{
    $atenciones = $row["nocerrado"];
}


$sql2 = "select count(id) as nocerrado from crm_eventos
where estado in (1,3)
and usuario_crm = ".Session::get('usuario_crm')." ";

$rs2 = sqlsrv_query( $conn, $sql2 );

while ($row = sqlsrv_fetch_array( $rs2, SQLSRV_FETCH_ASSOC))
{
    $eventos = $row["nocerrado"];
}


$sql3 = "select count(id) as nocerrado from tickets
where estado_id < 8
and categoria_id = 8 
and us_solicitante = ".Session::get('usuario_crm')." ";

$rs3 = sqlsrv_query( $conn, $sql3 );

while ($row = sqlsrv_fetch_array( $rs3, SQLSRV_FETCH_ASSOC))
{
    $tickets = $row["nocerrado"];
}

?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="background-image: url('img/umbrella33.jpg'); background-size: cover"  >
                <div class="navbar-header" style="height: 100px">
                    
                </div>
            </nav>
            <div class="row" style="margin-left:50px;">
                <div style="background-color: #4D9205;text-align: center;" class="col-lg-3">
                
                    <h3 style="color: white;"> <i class="fa fa-bell"></i> 
                    
                    Atenciones  no cerradas 
                    <span class="pull-right label" style="font-weight:bold;
                        font-size:14px;color:white;background-color:#035373;">
                         <?php echo $atenciones; ?> </span>
                    </h3>
               
               
                </div>
                <div class="col-lg-1"></div>

                <div style="background-color: #5D0483;text-align: center;" class="col-lg-3">
                
                    <h3 style="color: white;"> <i class="fa fa-calendar"></i> 
                        Eventos no cerrados 
                        <span class="pull-right label" style="font-weight:bold;
                        font-size:14px;color:black;background-color:yellow;">
                        <?php echo $eventos; ?>
                        </span>
                    </h3>
                  
                
                </div>
                <div class="col-lg-1"></div>
                <div style="background-color: #834B04;text-align: center;" class="col-lg-3">
                
                    <h3 style="color: white;"> <i class="fa fa-ticket-alt"></i> 
                    Tickets no cerrados
                    <span class="pull-right label" style="font-weight:bold;
                        font-size:14px;color:black;background-color:#fffff;">
                        <?php echo $tickets; ?>
                        </span>
                </h3>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
        <br><br>


        <button class="btn btn-danger" id="btnVerNotificador" style="display:none;font-size:20px;background-color:#640C93;">
            <i class="fa fa-bell"></i>
            Ver notificador
        </button>

    <div id="notificador" style="border-top:1px solid black;">
     
    @foreach(Session::get('roles') as $rol)
           @if($rol->rol=="ejecutivo_ventas")
                <div class="row wrapper border-bottom white-bg page-heading" style="background-color: honeydew; ">

                    <div class="row" style="">
                        <div class="col-lg-6">
                            <h1><img src="img/notificador1.png" height="50px" width="50" alt=""> Notificador </h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6" style="margin-top: 10px; " ng-controller="ShowEventosController" >
                            <div class="ibox float-e-margins" style="border: solid 1px black; " >
                                <div class="ibox-title" style="background-color: black;color: white; ">
                                    <h5><i class="fas fa-calendar-alt"></i> Eventos</h5>

                                </div>

                                <div class="ibox-content inspinia-timeline" style="height: 200px; overflow-y: scroll; overflow-x: hidden">

                                    <div class="timeline-item" ng-repeat="evento in eventos">
                                        <div class="row" style="border:dashed 1px lightgrey;" ng-if="evento.estado!='Cerrado'">
                                            <div class="col-xs-2 date">
                                                <i class="fa fa-calendar-alt"></i>
                                                @{{evento.fecha_compromiso | amDateFormat:'DD/MM/YYYY H:mm'}}
                                                <br>

                                            </div>
                                            <div class="col-xs-6 content no-top-border">
                                                <p class="m-b-xs text-success"><strong>@{{ evento.cliente }}</strong></p>
                                                <p>
                                                    @{{evento.descripcion}}
                                                </p>
                                            </div>
                                            <div class="col-xs-2" style="margin-top: 5px">
                                                {{--<button class="btn btn-md btn-white" style="border:solid 1px black;"><i class="fas fa-file"></i> Resolución</button>--}}
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="ibox-footer" style="height: 50px">
                                    <a type="button"  href="#!eventos" class="btn btn-info col-lg-12 hideNoti" style="border: solid 1px black;"><i class="fas fa-eye"></i> Ver mas</a>
                                </div>
                            </div>
                        </div>

                        <div ng-controller="ReminderController" class="col-lg-6" style="margin-top: 10px">
                            <div class="ibox">
                                <div class="ibox-heading">
                                    <div class="ibox-title" style="background: black; color:white">
                                        <h5><i class="fas fa-bell"></i> Reminders</h5>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="timeline-item" ng-repeat="reminder in reminders">
                                        <div class="row" style="border:dashed 1px lightgrey;" ng-if="evento.estado!='Cerrado'">
                                            <div class="col-xs-2 date">
                                                <i class="fa fa-bell"></i>
                                                @{{reminder.fechasolaprox | amDateFormat:'DD/MM/YYYY H:mm'}}
                                                <br>

                                            </div>
                                            <div class="col-xs-4 content no-top-border">
                                                <p>
                                                    @{{reminder.descripcion}}
                                                </p>
                                            </div>
                                            <div class="col-xs-5" style="margin-top: 5px">
                                                <button type="button" ng-click="posponer(reminder)" class="btn btn-xs btn-warning" style="border:solid 1px black;"><i class="fas fa-hand-paper"></i> Posponer</button>
                                                <button type="button" class="btn btn-xs btn-primary" ng-click="finalizarreminder(reminder)" style="border:solid 1px black;"><i class="fas fa-check-circle"></i> Finalizar</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="ibox-footer" ng-hide="posponerdiv">
                                    <form action="" class="form-horizontal">

                                        <div class="row">
                                            <div class="col-lg-4" style="margin-left: 10px">
                                                <div class="form-group">
                                                    <label for="">Nueva Fecha:</label>
                                                    <input  type="date" ng-model="formreminder.fecha | amDateFormat:'DD/MM/YYYY h:mm'" class="form-control ">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4" style="margin-left: 10px">
                                                <div class="form-group">
                                                    <button type="button" style="border:solid 1px black" class="btn btn-xs btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <br>


                    </div>

                    <div class="row">
                        <div class="col-lg-6" style="margin-top:10px ">
                            <div class="ibox float-e-margins" style="border: solid 1px black;">
                                <div class="ibox-title">
                                    <h3><i class="fas fa-bell"></i> Atenciones</h3>
                                    <div class="ibox-tools">

                                    </div>
                                </div>

                                <div class="ibox-content " style="height: 100px">
                                    <div>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-danger m-r-sm">28</button>
                                                    ATENCIONES CRM
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary m-r-sm">5</button>
                                                    Atenciones CALIDAD
                                                </td>

                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-6" style="margin-top: 10px">
                            <div class="ibox float-e-margins" style="border: solid 1px black;" ng-controller="TicketController">
                                <div class="ibox-title">
                                    <h3><i class="fas fa-ticket-alt"></i> Tickets en proceso</h3>
                                    <div class="ibox-tools">

                                    </div>
                                </div>
                                <div class="ibox-content " style="height: 100px; overflow-x: hidden; overflow-y: scroll">
                                    <ul class="list-group">
                                        <li class="list-group-item" ng-repeat="ticket in tickets" style="border:solid 1px black; border-radius: 25px;margin-top: 10px">
                                            <p><a class="" href="#"><b>@{{ticket.nombreasignado}} @{{ticket.apellidoasignado}}</b></a> @{{ticket.descripcion}}</p>
                                            <small style="color: black;" class="block text-muted"><i class="fas fa-clock"></i> @{{ticket.fechasolicitud | amDateFormat:'DD/MM/YYYY H:mm'}}</small>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

               @elseif($rol->rol=="comercial")
                <div class="row wrapper border-bottom white-bg page-heading">

                    <div class="row">
                        <div class="col-lg-6">
                            <h1><b>CRM EDESAL</b></h1>
                        </div>
                    </div>
                </div>
            @endif

    @endforeach
    </div>


        {{--CONTENIDO NG-VIEW--}}
        <div class="wrapper wrapper-content" ng-view>

        </div>






















        <div class="footer hidden">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->




<script>
    /*$(document).ready(function(){
        $('.navbar-minimalize').click().addClass('hidden');
    });*/
</script>

<script>
    $(document).ready(function(){
        $(".hideNoti").click(function(){
            $("#notificador").hide();
            $("#btnVerNotificador").show();
        });

        $("#btnVerNotificador").click(function(){
            $("#notificador").show();
            $("#btnVerNotificador").hide();
        });


        $("form :input").attr("autocomplete", "off");
   



    });

    
</script>


</body>

</html>
