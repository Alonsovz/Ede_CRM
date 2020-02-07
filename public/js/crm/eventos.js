var app = angular.module('Dashboard');


app.config(function($routeProvider){
   $routeProvider

       .when('/eventos',{
            templateUrl:'../views/Eventos/Show.html',
            controller:'ShowEventosController'
       });
});



//controlador para mostrar el calendario
app.controller('ShowEventosController',function($uibModal, $log,$uibModalStack,$http,$scope,DTOptionsBuilder,$timeout,$interval){


    $scope.listadoeventos = true;
    $scope.calendarioeventos = false;
    $scope.formularioticket = true;
    $scope.alertaticket = true;
    $scope.detallesevento = true;
    $scope.alertas = true;
    $scope.botonordentrabajo = true;
    $scope.botonguardarticket = false;
    $scope.eventos = {};
    $scope.ticket  = {};
    $scope.formticket = {};
    $scope.orden = {};
    $scope.formnuevoevento = true;
    $scope.formularioordentrabajo = true;
    $scope.formularioresolucion = true;
    $scope.alertaresolucion = true;
    $scope.alertaerrorticket  = true;


    var pc = this;
    pc.data = "Lorem Name Test";

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
        .withDisplayLength(2)
        .withOption('order', [4, 'desc'])
        .withLanguage(language);

    $scope.mostrarformticket = function () {
        $scope.formularioticket = false;
        $scope.detallesevento = true;
        $scope.formticket.evento = this.evento.id;
        $scope.orden.evento = this.evento.id;

        console.log(this.evento);
    };

    $scope.mostrardetalles = function()
    {
        $scope.formularioticket = true;
        $scope.detallesevento = false;
        $scope.formevento = this.evento;


        //evento para listar tickets asociados al evento
        $http({
            url:'getticketsbyevento',
            method:'GET',
            params:{evento:this.evento.id}
        }).then(function(response){
            $scope.tickets = response.data;
        });


        //evento para listar los adjuntos segun evento seleccionado
        $http({
            url:'getadjuntosbyevento',
            method:'POST',
            params:{evento:this.evento.id}

        }).then(function(response){
            $scope.adjuntos = response.data;
        });

    };


    //funcion para mostrar el formulario de resolucion
    $scope.eventoglobal = "";
    $scope.verformresolucion = function()
    {
      $scope.formularioresolucion = false;
      $scope.eventoglobal = this.evento.id;
    };

    //evento para guardar la resolucion
    $scope.guardarresolucion = function()
    {
        $http({
            url:'guardarresolucionevento',
            method:'POST',
            params:{resolucion:$scope.modelresolucion.resolucion,evento:$scope.eventoglobal}
        }).then(function(response){
            $scope.alertaresolucion = false;
            $scope.formularioresolucion = true;

            $timeout(function(){
                $scope.alertaresolucion = true;
            },2000)
        });
    };


    //guardar ticket y orden de trabajo adjunto
    $scope.guardarticketorden = function()
    {
        var now = moment(new Date($scope.formticket.fechacompromiso));
        var resolucion = now.tz('America/El_Salvador').format('YYYYMMDD h:mm');

        var now = moment(new Date($scope.orden.fechacompromiso));
        var ordenresolucion = now.tz('America/El_Salvador').format('YYYYMMDD h:mm');


        $http({
            url:'guardarticketorden',
            method:'GET',
            params: {

                //ticket
                titulo:             $scope.formticket.titulo,
                usuario:            $scope.formticket.usuario,
                usuarionotificar:   $scope.formticket.usuarioanotificar,
                fecharesolucion:    resolucion,
                descripcion:        $scope.formticket.descripcion,
                evento:             $scope.formticket.evento,

                //orden
                trabajo:                $scope.orden.trabajo,
                fecharesolucionorden:   ordenresolucion,
                direccionorden:         $scope.orden.direccion,
                agencia:                $scope.orden.agencia,
                gerencia:               $scope.orden.gerencia,
                contratista:            $scope.orden.contratista,
                observaciones:          $scope.orden.observaciones,
                evento:                 $scope.orden.evento


            }
        }).then(function(response){
            if(response.data==true)
            {
                $scope.formticket = {};
                $scope.ticket = response.data;
                console.log($scope.ticket);
                $scope.alertaticket  = false;
                $scope.formularioticket = true;
                $scope.orden = {};

                $scope.botonguardarticket = true;
                $scope.botonordentrabajo = false;
                $scope.formularioordentrabajo = true;
                $scope.alertaerrorticket  = true;


                $timeout(function(){
                    $scope.alertaticket = true;
                },2000)
            }
            else
            {
                $scope.alertaerrorticket  = false;
            }
        });
    };



    //nuevo evento
    $scope.nuevoevento = function()
    {
        $scope.formnuevoevento = false;
    };


    //mostrar form de orden trabajo
    $scope.verformularioordentrabajo = function()
    {
        $scope.formularioordentrabajo = false;
    };




    //listado de usuarios coman
    $http({
        url:'getusuarioscomanda',
        method:'GET'
    }).then(function(response){
        $scope.usuario = {
            model:null,
            availableOptions:response.data
        }
    });

    $scope.guardarticket = function()
    {
        var now = moment(new Date($scope.formticket.fechacompromiso));
        var resolucion = now.tz('America/El_Salvador').format('YYYYMMDD h:mm');
        $http({
            url:'guardarticket',
            method:'GET',
            params: {titulo:$scope.formticket.titulo,usuario:$scope.formticket.usuario,fecharesolucion:resolucion,
                descripcion:$scope.formticket.descripcion,evento:$scope.formticket.evento, usuarionotificar:   $scope.formticket.usuarioanotificar,}
        }).then(function(response){
            $scope.formticket = {};
            $scope.ticket = response.data;
            console.log($scope.ticket);
            $scope.alertaticket  = false;
            $scope.formularioticket = true;

            $scope.botonguardarticket = true;
            $scope.botonordentrabajo = false;


            $timeout(function(){
                $scope.alertaticket = true;
            },2000)
        });
    };


    $http({
        url:'geteventos',
        method:'GET'
    }).then(function (response) {
        $scope.eventos  = response.data;

    });


    $http({
        url:'geteventosusuarios',
        method:'GET'
    }).then(function (response) {
        $scope.eventosCl  = response.data;

    });

    //ver listado de eventos
    $scope.verlistadoeventos = function()
    {
        $scope.listadoeventos = false;
        $scope.calendarioeventos = true;
    };


    $scope.cancelarEvento = function()
    {
        $scope.formnuevoevento = true;
    };

    //guardar evento
    $scope.guardarEvento = function()
    {
        var now = moment(new Date($scope.formevento.fechacompromiso));
        $compromiso_fecha = now.tz('America/El_Salvador').format('YYYYMMDD h:mm');

        var now1 = moment(new Date($scope.formevento.fecharesolucion));
        $resolucion_fecha = now1.tz('America/El_Salvador').format('YYYYMMDD h:mm');

        $http({
            url:'guardarevento',
            method:'get',
            params:{fechacompromiso:$compromiso_fecha,
                fecharesolucion:$resolucion_fecha,
                descripcion:$scope.formevento.descripcion,cliente:$scope.formevento.nombrecliente,suministro:$scope.formevento.suministro
            }
        }).then(function(){
            $scope.alertas = false;
            $scope.formevento = {};

            $timeout(function(){
                $scope.alertas = true;

                $http({
                    url:'geteventos',
                    method:'GET'
                }).then(function (response) {
                    $scope.eventos  = response.data;

                });


            },2000);
        });
    };


    //llamada de eventos cada 5 minutos
    $interval(function(){
        $http({
            url:'geteventos',
            method:'GET'
        }).then(function (response) {
            $scope.eventos  = response.data;
        });
    },300000);





});