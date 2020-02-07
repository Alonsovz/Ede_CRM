var app = angular.module('Dashboard');

app.config(function($routeProvider){
   $routeProvider

       .when('/tramitescomerciales',{
           templateUrl:'../views/TramitesComerciales/Index.html',
           controller: 'IndexController'
       })
});


//controlador inicial
app.controller('IndexController',function($http,$scope,DTOptionsBuilder,$timeout,$interval){

});