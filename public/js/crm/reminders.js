var app = angular.module('Dashboard')


//configuracion de la vista parcial para mostrar los clientes
.config(function($routeProvider){
    $routeProvider
        .when('/reminders',{
            templateUrl:'../views/Reminders/Show.html',
            controller:'ReminderController'
        });
});



//controlador
app.controller('ReminderController',function($timeout,$http, $scope,$interval,SweetAlert){

    $scope.alertareminder = true;
    $scope.reminders = {};
    $scope.posponerdiv = true;


    //obtenemos los reminders
    $http({
        url:'getreminders',
        method:'POST'
    }).then(function(response){
        $scope.reminders = response.data;
    });


    //funcion para posponer
    $scope.finalizarreminder = function()
    {
        var idreminder = this.reminder.id;

        SweetAlert.swal({
                title: "Seguro que desea finalizar este reminder",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18A689",confirmButtonText: "Si, deseo finalizarlo!",
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function(isConfirm){
                if (isConfirm) {
                    $http({
                        url:'finalizarreminder',
                        method:'POST',
                        params:{reminder:idreminder}
                    }).then(function(response){
                        SweetAlert.swal("","Reminder finalizado!","success");
                        //obtenemos los reminders
                        $http({
                            url:'getreminders',
                            method:'POST'
                        }).then(function(response){
                            $scope.reminders = response.data;
                        });
                    });
                } else {
                    SweetAlert.swal("Proceso cancelado", "", "error");

                }
            });


    };

    //guardar un reminder
    $scope.guardarreminder = function()
    {
        var now = moment(new Date($scope.formreminder.fecha));
        var resolucion = now.tz('America/El_Salvador').format('YYYYMMDD');

        $http({
           url:'guardarreminder',
           method:'POST',
           params:{descripcion:$scope.formreminder.descripcion,fecha:$scope.formreminder.fecha}
        }).then(function(response){

            $scope.alertareminder = false;

            $timeout(function(){
                $scope.alertareminder = true;
            },2000);

            //obtenemos los reminders
            $http({
                url:'getreminders',
                method:'POST'
            }).then(function(response){
                $scope.reminders = response.data;
            });
        });
    };



    //intervalo cada 5 minutos
    $interval(function(){
        //obtenemos los reminders
        $http({
            url:'getreminders',
            method:'POST'
        }).then(function(response){
            $scope.reminders = response.data;
        });
    },300000);

});

