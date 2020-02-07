
 

//configuramos la ruta que mostrarara nuestra vista
app.config(function($routeProvider){
   $routeProvider
       .when('/atenciones',{
           templateUrl:'../views/Atenciones/Show.html',
           controller:'AtencionesController'
       })

});




//controlador para mostrar las atenciones
app.controller('AtencionesController',function($uibModal, $log,$uibModalStack,$http,$scope,DTOptionsBuilder,$timeout){

    $scope.alertas = true;
    $scope.formnuevoevento = true;
    $scope.frmticket = true;
    $scope.alertasticket = true;
    $scope.adjuntosatenciones = true;
    $scope.formevento = {};
    $scope.eventos = {};

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

    

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('full_numbers')
        .withDisplayLength(2)
        .withOption('order', [10, 'desc'])
        .withLanguage(language);



    var arreglo_atenciones = [];

    //evento para listar todas las atenciones realizadas
    $http({
        url:'getallatenciones',
        method:'GET'
    }).then(function(response){
        $scope.atenciones = response.data;
    });


    $http({
        url:'getConteoAtenciones',
        method:'GET'
        
    }).then(function(response){
        $scope.atencionesC = response.data;
    });

    

    //evento para listar todas las atenciones realizadas a mis clientes
    $http({
        url:'getallatencionesMisClientes',
        method:'GET'
    }).then(function(response){
        $scope.atencionesCl = response.data;
    });


    //ver adjuntos de una atencion seleccionada
    $scope.veradjuntos = function()
    {
        console.log(this.atencion);
        //consultar los adjuntos de una atencion
        $http({
            url:'veradjuntosatenciones',
            method:'post',
            params:{atencion:this.atencion.id}
        }).then(function(response)
        {
            $scope.archivosadjuntos = response.data;
            $scope.adjuntosatenciones = false;
        });
    };



    //nuevo evento formulario
    $scope.nuevoevento = function()
    {

        $scope.formnuevoevento = false;
        console.log(this.atencion.num_suministro);
        $scope.formevento.suministro = this.atencion.num_suministro;
        $scope.formevento.nombrecliente = this.atencion.cliente;
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


            $scope.archivos.push(response.data);
            $scope.descripcionadjunto = "";
            $scope.tipoarchivo = "";


            console.log($scope.archivos);
            console.log(tiposarch);
            console.log(descripcionesadjuntos);

        });


    };







    //funcion para guardar un nuevo evento
    $scope.guardarEvento = function()
    {
        var now = moment(new Date($scope.formevento.fechacompromiso));
        $compromiso_fecha = now.tz('America/El_Salvador').format('YYYYMMDD h:mm');

        var now1 = moment(new Date($scope.formevento.fecharesolucion));
        $resolucion_fecha = now1.tz('America/El_Salvador').format('YYYYMMDD h:mm');

        $http({
            url:'guardarevento',
            contentType:'json',
            method:'post',
            data:{

                fechacompromiso:    $compromiso_fecha,
                fecharesolucion:    $resolucion_fecha,
                descripcion:        $scope.formevento.descripcion,
                cliente:            $scope.formevento.nombrecliente,
                suministro:         $scope.formevento.suministro,
                adjuntos:           $scope.archivos,
                descripciones:      descripcionesadjuntos,
                tiposarchivos:      tiposarch

                }
        }).then(function(){
            $scope.alertas = false;
            $scope.formevento = {};

            $timeout(function(){
                $scope.alertas = true;
            },2000);
        });
    };


    $scope.cancelarEvento = function()
    {
        $scope.formnuevoevento = true;
    };












});







//controlador para modal
app.controller('ModalInstanceCtrl', function ($uibModal, $log,$uibModalStack,$scope,$http) {

});