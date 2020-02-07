var app = angular.module('Dashboard')


.config(function($routeProvider){
   $routeProvider

       .when('/suministros',{
           templateUrl:'../views/Suministros/Show.html',
           controller:'Dashboard.ShowSuministroController'
       })
});

app.directive("fileInput", function($parse){
    return{
        link: function($scope, element, attrs){
            element.on("change", function(event){
                var files = event.target.files;
                //console.log(files[0].name);
                $parse(attrs.fileInput).assign($scope, element[0].files);
                $scope.$apply();
            });
        }
    }
});

//controlador para suministros
app.controller('Dashboard.ShowSuministroController',function($http,$scope,DTOptionsBuilder,$timeout,FileUploader){


    $scope.detallesum = true;
    $scope.frm_atenciones = true;
    $scope.alertas = true;
    $scope.frm_nuevaatencion = true;
    $scope.fax = true;
    $scope.alertaatencion = true;
    $scope.correo = true;
    $scope.whatsapp = true;
    var n_suministro = "";
    $scope.archivos = new Array();
    var descripcionesadjuntos = new Array();
    var tiposarch = new Array();



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


    //listar los tipos de archivos
    $http({
        url:'listartiposdearchivos',
        method:'POST'
    }).then(function(response){
        $scope.tiposarchivos =
            {
                model:null,
                availableOptions:response.data
            }
    });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('full_numbers')
        .withDisplayLength(5)
        .withOption('order', [1, 'desc'])
        .withLanguage(language);

    //evento para listar los suministros por usuario_unicom
    $http({
        url:'listarsuministros',
        method:'GET'
    }).then(function(response){
        $scope.suministros = response.data
    });



    //evento para detalle de suministro
    $scope.detallesuministro = function()
    {
            $scope.frm_atenciones = false;
            $scope.detallesum = false;
            $scope.suministroDetalle = this.suministro;
            console.log($scope.suministroDetalle);



            //evento para listar las atenciones realizadas al suministro
            $http({
            url:'getatencionesbysuministro',
            method:'GET',
            params:{suministro:$scope.suministroDetalle.num_suministro}
        }).then(function(response){


            $scope.atenciones = response.data;
        });




        //evento para mostrar el formulario de nueva atencion y esconder el detalle del suministro
        $scope.nuevaatencion = function()
        {
            $scope.formatencion = {};

            $scope.detallesum = true;
            $scope.frm_nuevaatencion = false;
            $scope.formatencion.suministro = $scope.suministroDetalle.num_suministro;
            $scope.formatencion.cliente = $scope.suministroDetalle.nombrecliente+' '+$scope.suministroDetalle.apellidocliente;

            //listamos por medio de una llamada http los tipos de atenciones que pueden darse para el usuario
            $http({
                url:'gettiposatenciones',
                method:'GET'
            }).then(function(response){
                $scope.tipoatenciones =
                    {
                        model:null,
                        availableOptions:response.data
                    }
            });

            //listamos por medio de una llamada http todos los motivos que pueden existir de atenciones al cliente en la db
            $http({
                url:'getmotivosatenciones',
                method:'GET'
            }).then(function(response){

                $scope.motivoatenciones = {
                    model:null,
                    availableOptions:response.data
                }
            });






        };

        //evento para poder obtener el change del select de tipos de atencion
        $scope.evt_tipoatencion = function()
        {
          if($scope.formatencion.tipoatenciones.nombre==="EMAIL")
          {
              $scope.correo = false;
              $scope.fax = true;
              $scope.whatsapp = true;
          }
          else if($scope.formatencion.tipoatenciones.nombre==="WHATSAPP")
          {
              $scope.correo = true;
              $scope.fax = true;
              $scope.whatsapp = false;
          }
          else if($scope.formatencion.tipoatenciones.nombre==="FAX")
          {
              $scope.correo = true;
              $scope.fax = false;
              $scope.whatsapp = true;
          }
        };


        //evento para guardar un archivo adjunto y la ficha de atencion
        $scope.cargaradjuntoatenciones = function()
        {

            //obtenemos los datos del formulario
            var fd = new FormData();
            var files = document.getElementById('file').files[0];
            fd.append('file',files);
            descripcionesadjuntos.push($scope.descripcionadjunto);
            tiposarch.push($scope.tipoarchivo);

            // AJAX request
            $http({
                method: 'post',
                url: 'guardaradjuntobyatencion',
                data: fd,
                headers: {'Content-Type': undefined}
            }).then(function successCallback(response) {
                // respuesta con el nombre del archivo cargado
                $scope.formatencion.adjunto = response.data.name;

                $scope.archivos.push(response.data);
                $scope.descripcionadjunto = "";
                $scope.tipoarchivo = "";


                console.log($scope.archivos);
                console.log(tiposarch);
                console.log(descripcionesadjuntos);

            });


        };


        //guardamos la ficha de atencion
        $scope.guardarFichaAtencion = function()
        {
            $http({
                url:'guardarfichaatencion',
                method:'post',
                contentType:'json',
                data:{
                    suministro:     $scope.formatencion.suministro,
                    cliente:        $scope.formatencion.cliente,
                    contacto:       $scope.formatencion.contacto,
                    telefono:       $scope.formatencion.telefono,
                    whatsapp:       $scope.formatencion.whatsapp,
                    correo:         $scope.formatencion.correo,
                    fax:            $scope.formatencion.fax,
                    tipoatencion:   $scope.formatencion.tipoatenciones.id,
                    motivoatencion: $scope.formatencion.motivoatenciones,
                    descripcion:    $scope.formatencion.descripcion,
                    adjuntos:       $scope.archivos,
                    descripciones:  descripcionesadjuntos,
                    tiposarchivos:  tiposarch
                }

            }).then(function(response){
                $scope.formatencion = {};
                $scope.alertaatencion = false;
                $scope.archivos.length = 0;
                descripcionesadjuntos.length = 0;

                $timeout(function(){
                    $scope.alertaatencion = true;
                },2000);

            });
        };


        //evento para cancelar la nueva atencion (ficha)
        $scope.cancelarnuevaatencion = function()
        {
            $scope.frm_nuevaatencion = true;
        }


    };








});