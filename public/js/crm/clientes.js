var app = angular.module('Dashboard')



//configuracion de la vista parcial para mostrar los clientes
.config(function($routeProvider){
   $routeProvider
       .when('/clientes',{
           templateUrl:'../views/Clientes/Show.html',
           controller:'ShowClientesController'
       });
});


//controlador para listar los clientes
app.controller('ShowClientesController',function($scope,$http,DTOptionsBuilder,$timeout){


    $scope.footercliente = true;
    $scope.formulariopotencial = true;
    $scope.clientepot = {};
    $scope.listadopotenciales =true;
    $scope.potencial = {};
    $scope.alertas = true;
    $scope.detallespotenciales = true;
    $scope.detalleshistorial = true;
    $scope.detalleshistorial = true;
    $scope.detalleshistorials = true;
    $scope.detalleshistorials = true;
    $scope.alertacontacto = true;
    $scope.nuevaatencion = true;
    $scope.alertaerroratencion = true;
    $scope.formatencion = {};
    $scope.fax = true;
    $scope.correo = true;
    $scope.whatsapp = true;
    $scope.alertaatencion = true;
    $scope.informaciontecnica = true;
    $scope.archivos = new Array();
    var descripcionesadjuntos = new Array();
    $scope.usuarioscompartidos = new Array();
    $scope.clientegeneral = "";

    $http({
        url:'showclientes',
        method:'POST'
    }).then(function(response){
        $scope.clientes  = response.data;


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
        .withDisplayLength(2)
        .withOption('order', [1, 'desc'])
        .withLanguage(language);


   $scope.btn_nuevocliente = function()
   {
       $scope.formulariopotencial = false;
       $scope.listadopotenciales = true;
       $scope.detallespotenciales = true;
       $scope.nuevaatencion = true;
       $scope.detallespotenciales = true;
       $scope.detalleshistorial = true;
       $scope.detalleshistorials = false;
   };

   //tab2click
    $scope.tab2click = function()
    {
        $scope.detallespotenciales = true;
        $scope.nuevaatencion = true;
    };


   //listar clientes compartidos para un usuario logueado
    $http({
        url:'getclientescompartidos',
        method:'POST'
    }).then(function(response){
        $scope.cli_compartidos = response.data;
    });

    //evento para detalle de clientes
    $scope.detallecliente = function()
    {
        $scope.footercliente = false;
        $scope.clienteDetalle = this.cliente;
        console.log($scope.clienteDetalle.codigo);

        //evento para listar los contactos del cliente seleccionado
        $http({
            url:'listarcontactosbycliente',
            params:{f_cliente:$scope.clienteDetalle.codigo},
            method:'GET'
        }).then(function(response){
            $scope.contactos = response.data;
        });


        //evento para listar los suministros
        $http({
            url:'listarsuministrosbycliente',
            params:{f_cliente:$scope.clienteDetalle.codigo},
            method:'GET'
        }).then(function(response){
            $scope.suministros = response.data;
        });
    };

    //mostrar el formulario para detalles tecnicos
    $scope.vertecnica = function()
    {
      $scope.informaciontecnica = false;
      $scope.botontecnica = false;
    };


    //guardar cliente potencial
    $scope.guardarclientepotencial = function()
    {
        //http para guardar el cliente potencial
        $http({
            url:'guardarclientepotencial',
            params: $scope.clientepot,
            method: 'GET'
        }).then(function(response){
            if(response.data)
            {
                $scope.clientepot = {};
                $scope.alertas = false;

                //timeout para alerta
                $timeout(function(){
                    $scope.alertas = true;
                },2000);

                //listar clientes potenciales
                $scope.verclientespotenciales = function()
                {
                    $scope.formulariopotencial = true;
                    $scope.detallespotenciales = true;
                    $scope.listadopotenciales = false;
                    $http({
                        url:'getclientespotenciales',
                        method:'GET'
                    }).then(function(response){
                        $scope.potencial = response.data;

                    });
                };

                //guardar usuarios con los que se compartira el cliente
                $http({
                    url:'guardarusuarios',
                    method:'POST',
                    contentType:'json',
                    data:{usuarios:$scope.usuarioscompartidos,cliente:response.data}
                }).then(function(response)
                {
                    $scope.usuarioscompartidos.length = 0;
                    $scope.informaciontecnica = true;
                });
            }
        });
    };



    //listar clientes potenciales
    $scope.verclientespotenciales = function()
    {
        $scope.formulariopotencial = true;
        $scope.detallespotenciales = true;
        $scope.detallespotenciales = true;
        $scope.listadopotenciales = false;
        $scope.nuevaatencion = true;

        $scope.potencial = [];
        $http({
            url:'getclientespotenciales',
            method:'GET'
        }).then(function(response){
            $scope.potencial = response.data;

        });
    };




    //ver detalles de los potenciales
    var clientepotencial = "";

    $scope.verdetallespotencial = function()
    {
        $scope.detalleshistorials = true;
     //   $scope.detalleshistorials = false;
        $scope.detallespotenciales = false;
        $scope.formulariopotencial = true;
      //  $scope.listadopotenciales = true;
        $scope.nuevaatencion = true;


        clientepotencial = this.p.id;



        $scope.up_cliente  = this.p;

        console.log($scope.up_cliente);


        $http({
            url:'getcontactospotenciales',
            method:'GET',
            params:{cliente:this.p.id}
        }).then(function(response){
            $scope.contactos = response.data;

        });

        //obtenemos los usuarios con los que esta siendo compartido el cliente
        $http({
            url:'obtenerusuariosbyclientepot',
            method:'get',
            params:{cliente:this.p.id}
        }).then(function(response){
            $scope.usuarioscliente = response.data;
        });
    };


    $scope.verdetalleshistorial = function()
    {
        $scope.detalleshistorial = false;
        $scope.detallespotenciales = true;
        $scope.formulariopotencial = true;
        $scope.nuevaatencion = true;

        $("#nameCliente").text(this.p.empresa);

        $http({
            url:'getallatencionesbyidCliente',
            method:'GET',
            params:{cliente:this.p.empresa}
        }).then(function(response){
            $scope.atenciones = response.data;
        });


        $http({
            url:'geteventoseventosbyidCliente',
            method:'GET',
            params:{cliente:this.p.empresa}
        }).then(function (response) {
            $scope.eventosCl  = response.data;
    
        });


        $http({
            url:'geticketsbyidCliente',
            method:'GET',
            params:{cliente:this.p.empresa}
        }).then(function (response) {
            $scope.ticketsCl  = response.data;
    
        });
       
    };


    $scope.verdetalleshistorials = function()
    {
        $scope.detalleshistorials = false;
        $scope.detallespotenciales = true;
        $scope.formulariopotencial = true;
        $scope.nuevaatencion = true;

        $("#nameClientes").text(this.p.empresa);

        $http({
            url:'getallatencionesbyidCliente',
            method:'GET',
            params:{cliente:this.p.empresa}
        }).then(function(response){
            $scope.atencionesCli = response.data;
        });


        $http({
            url:'geteventoseventosbyidCliente',
            method:'GET',
            params:{cliente:this.p.empresa}
        }).then(function (response) {
            $scope.eventosCli  = response.data;
    
        });


        $http({
            url:'geticketsbyidCliente',
            method:'GET',
            params:{cliente:this.p.empresa}
        }).then(function (response) {
            $scope.ticketsCli  = response.data;
    
        });
       
    };


    //guardar usuarios nuevos
    $scope.guardarusuariosnuevos = function()
    {
        $http({
            url:'guardarusuarios',
            method:'POST',
            contentType:'json',
            data:{usuarios:$scope.usuarioscompartidos,cliente:clientepotencial}
        }).then(function(response)
        {
            $scope.usuarioscompartidos.length = 0;
            $scope.informaciontecnica = true;

            //refrescamos los nuevos usuarios
            $http({
                url:'obtenerusuariosbyclientepot',
                method:'get',
                params:{cliente:clientepotencial}
            }).then(function(response){
                $scope.usuarioscliente = response.data;
            });
        });
    };

    //dejar de compartir un cliente con un usuario
    $scope.dejarCompartirCliente = function()
    {
        $http({
            url:'dejarcompartircliente',
            method:'get',
            params:{user:this.usuario.id,linea:this.usuario.linea}
        }).then(function(response){
            //refrescamos los nuevos usuarios
            $http({
                url:'obtenerusuariosbyclientepot',
                method:'get',
                params:{cliente:clientepotencial}
            }).then(function(response){
                $scope.usuarioscliente = response.data;
            });
        });
    };

    $scope.cerrarHistorial = function(){
        $scope.detalleshistorial = true;
        $scope.detalleshistorials = true;
    }

    $scope.cerrardetallespotenciales= function(){
        $scope.detallespotenciales = true;
    }
        
    

    //guardar un contacto para un cliente potencial
    $scope.guardarcontacto = function()
    {
        $http({
            url:'guardarcontactobypotencial',
            method:'GET',
            params:{
                nombre:$scope.contacto.nombre,
                cargo:$scope.contacto.cargo,
                telefono:$scope.contacto.telefono,
                celular:$scope.contacto.celular,
                correo:$scope.contacto.correo,
                cliente:clientepotencial
            }
        }).then(function(response){
            $scope.contacto = {};
            $scope.alertacontacto = false;

            $http({
                url:'getcontactospotenciales',
                method:'GET',
                params:{cliente:clientepotencial}
            }).then(function(response){
                $scope.contactos = response.data;

            });

            $timeout(function(){
                $scope.alertacontacto = true;
            },2000);

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



    //evento para mostrar el formulario de nueva atencion
    $scope.formularionuevaatencion = function()
    {
        $scope.nuevaatencion = false;
        $scope.detalleshistorial = true;
        $scope.detalleshistorials = true;
        $scope.detallespotenciales = true;
        $scope.formatencion.cliente = this.p.empresa;
    };


    //evento para guardar un archivo adjunto y la ficha de atencion
    $scope.cargaradjuntoatenciones = function()
    {

        //obtenemos los datos del formulario
        var fd = new FormData();
        var files = document.getElementById('file').files[0];
        fd.append('file',files);
        descripcionesadjuntos.push($scope.descripcionadjunto);

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


            console.log($scope.archivos);

            console.log(descripcionesadjuntos);

        });


    };


    //añadir elementos al arreglo de los usuarios que compartiran clientes
    $scope.asignarusuario = function()
    {
      $scope.usuarioscompartidos.push($scope.clientepot.compartirusuario);
      console.log($scope.usuarioscompartidos);
    };


    //guardamos la ficha de atencion
    $scope.guardarFichaAtencion = function()
    {
        $http({
            url:'guardarfichaatencion',
            method:'post',
            contentType:'json',
            params:{

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
                descripciones:  descripcionesadjuntos
            }

        }).then(function(response){
            if(response.data==true)
            {
                $scope.formatencion = {};
                $scope.alertaatencion = false;
                $scope.archivos.length = 0;
                descripcionesadjuntos.length = 0;
                $scope.alertaerroratencion = true;

                $timeout(function(){
                    $scope.alertaatencion = true;
                },2000);
            }
            else
            {
                $scope.alertaerroratencion = false;
            }

        });
    };


});



