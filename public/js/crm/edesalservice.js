var app = angular.module('Dashboard');


app.config(function($routeProvider){
    $routeProvider

        .when('/ordenestrabajo',{
            templateUrl:'../views/EdesalService/Show.html',
            controller:'ShowController'
        })

        .when('/ordenestrabajoadmin',{
            templateUrl:'../views/EdesalService/ShowAdmin.html',
            controller:'ShowController'
        })
        .when('/ordenestrabajoadminventas',{
            templateUrl:'../views/EdesalService/ShowAdminGrandesClientes.html',
            controller:'ControllerVentas'
        })
});



app.controller('ShowController',function($http,$scope,$timeout,DTOptionsBuilder){


    $scope.detallesorden = true;
    $scope.alertaorden = true;
    $scope.formdenegarorden = true;
    $scope.alertaordendenegada = true;

    //listamos las ordenes de trabajo
    $http({
        url:'getordenes',
        method:'GET'
    }).then(function(response){
        $scope.ordenes = response.data;
    });

     //ordenes para los asignados
    $http({
        url:'getordenesforasignados',
        method:'GET'
    }).then(function(response){
        $scope.ordenesasignados = response.data;
    });


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
        .withOption('order', [4, 'desc'])
        .withLanguage(language);


    //ver detalle de la orden
    $scope.verdetalleorden = function()
    {

      $scope.up_orden = this.orden;
      console.log($scope.up_orden);
      $scope.detallesorden = false;

      if(this.orden.autorizado_1==1)
      {
          $scope.botonaprobarorden = true;
          $scope.botondenegarorden = true;
      }
       else {
          $scope.botonaprobarorden = false;
          $scope.botondenegarorden = false;
      }
    };


    //aprobar orden
    $scope.aprobarOrden = function()
    {
        $http({
            url:'aprobarorden',
            method:'POST',
             params:{orden:this.up_orden.id,comentario:this.up_orden.observacionejecucion}
        }).then(function(response){
            $scope.detallesorden = true;
            $scope.alertaorden = false;

            //recargamos por http las ordenes
            $http({
                url:'getordenes',
                method:'GET'
            }).then(function(response){
                $scope.ordenes = response.data;
            });

            $timeout(function(){
                $scope.alertaorden = true;
            },3000);
        });
    };


    //mostrar form denegar orden
    $scope.mostrarformdenegarorden = function()
    {
        $scope.formdenegarorden = false;
    };


    //denegar orden
    $scope.denegarorden = function()
    {
        $http({
            url:'denegarorden',
            method:'POST',
            params:{orden:this.up_orden.id,comentario:$scope.comentariodenegacion}
        }).then(function(response){

            $scope.alertaordendenegada = false;
            $scope.detallesorden = true;

            //recargamos por http las ordenes
            $http({
                url:'getordenes',
                method:'GET'
            }).then(function(response){
                $scope.ordenes = response.data;
            });

            $timeout(function(){
                $scope.alertaordendenegada = true;
            },3000);
        });
    }

});


app.controller('ControllerVentas',function($http,$scope,$timeout,DTOptionsBuilder){

    $scope.detallesorden = true;
    $scope.alertaordenventas = true;
    $scope.formdenegarordenventas = true;
    $scope.alertaordendenegadaventas = true;

    //listamos las ordenes de trabajo
    $http({
        url:'getordenes',
        method:'GET'
    }).then(function(response){
        $scope.ordenes = response.data;
    });


    //ordenes para los asignados
    $http({
        url:'getordenesforasignados',
        method:'GET'
    }).then(function(response){
        $scope.ordenesasignados = response.data;
    });


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
        .withOption('order', [4, 'desc'])
        .withLanguage(language);


    //ver detalle de la orden
    $scope.verdetalleorden = function()
    {

        $scope.up_orden = this.orden;
        console.log($scope.up_orden);
        $scope.detallesorden = false;

        if(this.orden.autorizado_2==1)
        {
            $scope.botonaprobarordenventas = true;
            $scope.botondenegarordenventas = true;
        }
        else {
            $scope.botonaprobarordenventas = false;
            $scope.botondenegarordenventas = false;
        }
    };


    //aprobar orden
    $scope.aprobarOrdenventas = function()
    {
        $http({
            url:'aprobarordenventas',
            method:'POST',
            params:{orden:this.up_orden.id,comentario:$scope.up_orden.observacionejecucionventas}
        }).then(function(response){
            $scope.detallesorden = true;
            $scope.alertaorden = false;

            //recargamos por http las ordenes
            $http({
                url:'getordenes',
                method:'GET'
            }).then(function(response){
                $scope.ordenes = response.data;
            });

            $timeout(function(){
                $scope.alertaorden = true;
            },3000);
        });
    };




    //mostrar form denegar orden
    $scope.mostrarformdenegarordenventas = function()
    {
        $scope.formdenegarordenventas = false;
    };


    //denegar orden
    $scope.denegarordenventas = function()
    {
        $http({
            url:'denegarordenventas',
            method:'POST',
            params:{orden:this.up_orden.id,comentario:$scope.comentariodenegacionventas}
        }).then(function(response){

            $scope.alertaordendenegada = false;
            $scope.detallesorden = true;

            //recargamos por http las ordenes
            $http({
                url:'getordenes',
                method:'GET'
            }).then(function(response){
                $scope.ordenes = response.data;
            });

            $timeout(function(){
                $scope.alertaordendenegada = true;
            },3000);
        });
    }
});