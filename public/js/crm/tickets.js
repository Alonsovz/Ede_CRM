var app = angular.module('Dashboard');

app.config(function($routeProvider){
    $routeProvider
        .when('/ticketscrm',{
            templateUrl:'../views/Tickets/Show.html',
            controller:'TicketController'
        });
});


app.controller('TicketController',function($scope,$http,$timeout,DTOptionsBuilder,$interval){

    var tck = this;
    $scope.formulariodetallesticket = true;
    $scope.botonessolucion = true;
    $scope.denegarform = true;
    $scope.alertaticket = true;

    $scope.tickets = {};

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
        .withOption('order', [3, 'desc'])
        .withLanguage(language);

    $http({
        url:'getticketsall',
        method:'GET'
    }).then(function(response){
        $scope.tickets = response.data;
    });


    $http({
        url:'getticketsallOthersU',
        method:'GET'
    }).then(function(response){
        $scope.ticketsCl = response.data;
    });


    //mostrar formulario para denegar solucion
    $scope.mostrarformdenegado  = function()
    {
      $scope.denegarform = false;
    };


    //aceptar solucion
    $scope.aceptarsolucion = function()
    {
      $http({
         url:'aceptarsolucionticket',
         method:'post',
         params:{ticket:$scope.formticket.id}
      }).then(function(response){
            if(response.data===true)
            {
                $scope.formulariodetallesticket = true;
                $scope.botonessolucion = true;
                $scope.denegarform = true;
                $scope.alertaticket = false;
            }

          $http({
              url:'getticketsall',
              method:'GET'
          }).then(function(response){
              $scope.tickets = response.data;
          });

            $timeout(function(){
                $scope.alertaticket = true;
            },2000);
      });
    };


    //denegar solucion
    $scope.denegarsolucion = function()
    {
        $http({
            url:'denegarsolucion',
            method:'post',
            params:{ticket:$scope.formticket.id,descripcion:$scope.desc_denegado}
        }).then(function(response){
            if(response.data===true)
            {
                $scope.formulariodetallesticket = true;
                $scope.botonessolucion = true;
                $scope.denegarform = true;
                $scope.alertaticket = false;
            }

            $http({
                url:'getticketsall',
                method:'GET'
            }).then(function(response){
                $scope.tickets = response.data;
            });

            $timeout(function(){
                $scope.alertaticket = true;
            },2000);
        });
    };

    $scope.verdetalleticket = function()
    {
        $scope.formticket = this.ticket;
        $scope.formticket.usuarioasignado = this.ticket.nombreasignado+" "+this.ticket.apellidoasignado;
        $scope.formulariodetallesticket = false;

        if(this.ticket.estado_id==6)
        {
            $scope.botonessolucion = false;
        }
    }




});

