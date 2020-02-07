var app = angular.module('Dashboard')



//configuracion de la vista parcial para mostrar los clientes
.config(function($routeProvider){
   $routeProvider
       .when('/reportes',{
           templateUrl:'../views/Reportes/Show.html',
           controller:'ShowReportesController'
       });
});



//controlador para listar los clientes
app.controller('ShowReportesController',function($scope,$http,DTOptionsBuilder,$timeout){
    var language = {
        "lengthMenu": " _MENU_ Resultados por pagina",
        "search":         "Filtrar:",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando resultados _PAGE_ de _PAGES_ paginas",
        "infoEmpty": "No se encontraron resultados",
        "infoFiltered": "(Filtrados de un total de _MAX_  Registros)",
        "paginate": {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       ">",
            "previous":   "<"
        },
        "oAria": {
            "sSortAscending":  ": activate to sort column ascending",
            "sSortDescending": ": activate to sort column descending"
        }

    };

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('full_numbers')
        .withDisplayLength(5)
        .withOption('order', [0, 'desc'])
        .withLanguage(language);


 $scope.generarReporteGlobal = function()
 {




    var now1 = moment(new Date($scope.formRptGlobal.fecha1));
    var now2 = moment(new Date($scope.formRptGlobal.fecha2));


    var fechaInicio = $("#fechaInicioRptGl").val();
    var fechaFin = $("#fechaFinRptGl").val();

     if($scope.formRptGlobal.fecha2 < $scope.formRptGlobal.fecha1){
        $.amaran({
            'theme'     :'awesome error',
            'content'   :{
            title:'Advertencia!!',
            message:'La fecha final no debe ser menor a la inicial',
            info:'Error...',
            icon:'fas fa-exclamation-triangle'
            },
            delay: 4000,
            'cssanimationOut'   :'fadeOutRight',
            'position'  : 'top right',
             'inEffect'  : 'slideLeft',
             
            });
     }else{
        $http({
            url:'getallatencionesbyfecha',
            method:'GET',
            params:{usuario: $scope.formRptGlobal.userC, fecha1: fechaInicio, fecha2: fechaFin}
        }).then(function(response){
            $scope.atencionesG = response.data;
        });

        $http({
            url:'getalleventosbyfecha',
            method:'GET',
            params:{usuario: $scope.formRptGlobal.userC, fecha1: fechaInicio, fecha2: fechaFin}
        }).then(function (response) {
            $scope.eventosClG  = response.data;
    
        });


        $http({
            url:'getallticketsbyfecha',
            method:'GET',
            params:{usuario: $scope.formRptGlobal.userC, fecha1: fechaInicio, fecha2: fechaFin}
        }).then(function (response) {
            $scope.ticketsClG  = response.data;
    
        });




        
        $("#fecha1RptGl").text(fechaInicio);
        $("#fecha2RptGl").text(fechaFin+" .");
        $("#modalRptGlobal").modal("show");
     }
 
 };
 

 $scope.generarReporteUser = function()
 {
    var now1 = moment(new Date($scope.formRptUser.fecha1U));
    var now2 = moment(new Date($scope.formRptUser.fecha2U));

    var fechaInicio = $("#fechaInicioRptG").val();
    var fechaFin = $("#fechaFinRptG").val();

    var usuario =$('#userSelect option:selected').html();

    

     if($scope.formRptUser.fecha2U < $scope.formRptUser.fecha1U){
        $.amaran({
            'theme'     :'awesome error',
            'content'   :{
            title:'Advertencia!!',
            message:'La fecha final no debe ser menor a la inicial',
            info:'Error...',
            icon:'fas fa-exclamation-triangle'
            },
            delay: 4000,
            'cssanimationOut'   :'fadeOutRight',
            'position'  : 'top right',
             'inEffect'  : 'slideLeft',
             
            });
     }else{

        $http({
            url:'getallatencionesbyidUsuario',
            method:'GET',
            params:{usuario: $scope.formRptUser.userC, fecha1: fechaInicio, fecha2: fechaFin}
        }).then(function(response){
            $scope.atenciones = response.data;
        });

        $http({
            url:'getalleventosbyidUsuario',
            method:'GET',
            params:{usuario: $scope.formRptUser.userC, fecha1: fechaInicio, fecha2: fechaFin}
        }).then(function (response) {
            $scope.eventosCl  = response.data;
    
        });


        $http({
            url:'getallticketsbyidUsuario',
            method:'GET',
            params:{usuario: $scope.formRptUser.userC, fecha1: fechaInicio, fecha2: fechaFin}
        }).then(function (response) {
            $scope.ticketsCl  = response.data;
    
        });




        $("#nomUserRpt").text(usuario);
        $("#fecha1RptG").text(fechaInicio);
        $("#fecha2RptG").text(fechaFin+" .");
        $("#modalRptUsuario").modal("show");
     }
 
 };
});