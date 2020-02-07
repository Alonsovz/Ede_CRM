<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * -------------------------------------------------------
 * RUTA PARA CREDENCIALES E INICIO
 * ------------------------------------------------------*/
Route::get('/', function () {
    return view('login');
});

Route::get('dashboard', function () {
    return view('inicio');
});

//service para validar credenciales
Route::get('validarcredenciales','CredencialesController@validacion');


//obtener usuarios comanda
Route::any('getusuarioscomanda','CredencialesController@getUsuariosComanda');

//cerrar la sesion activa del usuario
Route::any('cerrarsesion','CredencialesController@cerrarSesion');


//--------------------------------------------------------





/* -------------------------------------------------------
 * RUTA PARA CLIENTES
 * ------------------------------------------------------*/

//ruta para listar los clientes de facturacion por medio de una conexion a la db de factelec
Route::any('showclientes','ClientesController@index');

//listar el cliente por ID
Route::get('cliente','ClientesController@ejemplo');

//service para listar contactos de un cliente en especifico
Route::get('listarcontactosbycliente','ClientesController@listarContactosByCliente');

//service para listar los suministros por cliente
Route::get('listarsuministrosbycliente','ClientesController@listarSuministrosByCliente');

//ruta para guardar un cliente potencial
Route::get('guardarclientepotencial','ClientesController@savePotencial');

//listar clientes potenciales
Route::get('getclientespotenciales','ClientesController@getClientesPotenciales');


//Reportes

//listar atenciones por usuario
Route::get('getallatencionesbyidUsuario','ReportesController@getallatencionesbyidUsuarios');


//listar eventos por usuario
Route::get('getalleventosbyidUsuario','ReportesController@getalleventosbyidUsuarios');



//listar tickets por usuario
Route::get('getallticketsbyidUsuario','ReportesController@getallticketsbyidUsuarios');



//listar atenciones por fecha
Route::get('getallatencionesbyfecha','ReportesController@getallatencionesbyfechas');


//listar eventos por fecha
Route::get('getalleventosbyfecha','ReportesController@getalleventosbyfechas');



//listar tickets por fecha
Route::get('getallticketsbyfecha','ReportesController@getallticketsbyfechas');


//listar atenciones clientes potenciales
Route::get('getallatencionesbyidCliente','ClientesController@getallatencionesbyidClientes');


//listar atenciones clientes potenciales
Route::get('getConteoAtenciones','AtencionesController@getConteoAtencion');


//listar eventos clientes potenciales
Route::get('geteventoseventosbyidCliente','ClientesController@geteventoseventosbyidClientes');




//listar tickets clientes potenciales
Route::get('geticketsbyidCliente','ClientesController@geticketsbyidClientes');

//listar los contactos de los clientes potenciales
Route::get('getcontactospotenciales','ClientesController@getContactosPotenciales');


//guardar un contacto para un cliente potencial
Route::get('guardarcontactobypotencial','ClientesController@saveContactoByClientePotencial');


//Obtener clientes compartidos
Route::any('getclientescompartidos','ClientesController@getCompartidos');

//guardar usuarios para compartir cliente
Route::post('guardarusuarios','ClientesController@saveUsuariosByCliente');


//obtener los usuarios con los que esta siendo compartido un cliente
Route::any('obtenerusuariosbyclientepot','ClientesController@getUsuariosByCliente');


//dejar de compartir cliente con un usuario
Route::any('dejarcompartircliente','ClientesController@dejarCompartirCliente');




//--------------------------------------------------------



/* -------------------------------------------------------
 * RUTA PARA SUMINISTROS
 * ------------------------------------------------------*/

//ruta para listar todos los suministros segun usuario_unicom
Route::any('listarsuministros','SuministrosController@index');

//ruta para obtener las atenciones realizadas a un suministro en especifico
Route::any('getatencionesbysuministro','SuministrosController@getAtencionesBySuministro');







//--------------------------------------------------------





/* -------------------------------------------------------
 * RUTA PARA ATENCIONES
 * ------------------------------------------------------*/

//ruta para listar todos los tipos de atenciones
Route::get('gettiposatenciones','AtencionesController@getTiposAtenciones');

//obtener los motivos de atenciones
Route::get('getmotivosatenciones','AtencionesController@getMotivos');

//guardar una nueva ficha de atencion en la db
Route::post('guardarfichaatencion','AtencionesController@store');


//consultar los adjuntos para las atenciones
Route::post('veradjuntosatenciones','AtencionesController@verAdjuntosByAtencion');


//subir carga de archivos para atenciones
Route::any('guardaradjuntobyatencion','AtencionesController@storeAdjunto');


//obtener todas las atenciones
Route::get('getallatenciones','AtencionesController@atenciones');

//obtener todas las atenciones
Route::get('getallatencionesMisClientes','AtencionesController@atencionesMisClientes');
//nuevo evento
Route::post('guardarevento','EventosController@store');


//Guardar resolucion de evento
Route::post('guardarresolucionevento','EventosController@guardarResolucion');



//obtener eventos
Route::get('geteventos','EventosController@getEventos');
//obtener eventos
Route::get('geteventosusuarios','EventosController@getEventosOtrosUsuarios');

//listar adjuntos de los eventos
Route::post('getadjuntosbyevento','EventosController@getAdjuntos');



//ruta para obtener los tipos de archivos para una nueva atencion
Route::post('listartiposdearchivos','AtencionesController@listarTiposArchivos');




//--------------------------------------------------------



//tickets
Route::any('guardarticket','TicketController@store');

//guardar ticket con orden
Route::any('guardarticketorden','TicketController@storeWithOrden');

//buscar tickets por eventos
Route::any('getticketsbyevento','TicketController@getTicketsByEvento');


//mostrar los ticket crm
Route::any('getticketsall','TicketController@getTicketsAll');




//mostrar los ticket crm
Route::any('getticketsallOthersU','TicketController@getticketsallOthers');
//guardar reminder de tipo ticket
Route::any('guardarreminder','TicketController@guardarReminder');


//obtener los reminders
Route::post('getreminders','TicketController@getReminders');


//finalizar reminder
Route::post('finalizarreminder','TicketController@finalizarReminder');


//aceptar solucion de ticket
Route::post('aceptarsolucionticket','TicketController@aceptarSolucion');

//denegar solucion del ticket
Route::any('denegarsolucion','TicketController@denegarSolucion');




/*------------------------------------------------------------------
EDESAL SERVICES
-------------------------------------------------------------------*/

//Obtener las ordenes de trabajo de area tecnica
Route::any('getordenes','EdesalServiceController@getOrdenes');


//obtener ordenes para los usuarios asignados
Route::any('getordenesforasignados','EdesalServiceController@getOrdenesForAsignado');


//aprobar orden
Route::post('aprobarorden','EdesalServiceController@aprobarOrden');


//imprimir orden de trabajo tecnica
Route::any('imprimirorden','EdesalServiceController@imprimirOrden');


Route::post('denegarorden','EdesalServiceController@denegarOrden');


//aprobar una orden por parte de ventas
Route::POST('aprobarordenventas','EdesalServiceController@aprobarOrdenVenta');

//denegar una orden por parte del area de ventas
Route::POST('denegarordenventas','EdesalServiceController@denegarOrdenVenta');

