var app = angular.module('Inicio',[]);



//controlador para validar credenciales
app.controller('Credenciales',function($http,$scope,$window){
    $scope.alerta = true;

    //evento click para iniciar sesion validarcredenciales
    $scope.iniciarSesion = function()
    {
        $http({
            url:'validarcredenciales',
            params:{usuario:$scope.usuario},
            method:'GET'
        }).then(function(response){
            if(response.data==='validado')
            {
                $window.location.href = 'dashboard';
            }
            else
            {
                $scope.alerta = false;
            }
        });
    }
});