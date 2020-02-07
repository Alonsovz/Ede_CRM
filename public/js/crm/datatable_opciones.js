$(document).ready(function(){

     $('.dataTables-example1').DataTable({
        "order": [[ 0, "desc" ]],
        "autoWidth": true,
        "language": {
            "lengthMenu": " _MENU_ Resultados por pagina",
            "search":         "Buscar:",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando resultados _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron resultados",
            "infoFiltered": "(Filtrados de un total de _MAX_  Registros)",
            "paginate": {
                "first":      "Primero",
                "last":       "Ulitmo",
                "next":       ">",
                "previous":   "<"
            }


        }
    });
});