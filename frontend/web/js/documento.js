function languaje()
{
    var data = {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "NingÃºn dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ãšltimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    };
    return data;
}
function rendertabla()
{
    try {
        //$('#table_documentos').DataTable();
    }
    catch (E)
    {
        console.log(E);
    }
}
function tabla() {
    $.ajax({
        url: '../controllers/ajax/documentos.php',
        type: 'post',
        data: $('form').serialize(),
        success: function (data) {
            $('#data').html(data);
            rendertabla();
        }
    });
}
function limpiar(input)
{
    console.log($(input)[0].tagName);
    switch ($(input)[0].tagName)
    {
        case 'INPUT':
            $(input).val('');
            break;
        case 'SELECT':
            $(input).val('-1');
            break;
    }
    tabla();

}

function search()
{
    $('#nombre').keyup(function ()
    {
        tabla();
    });

}

$(function ()
{
    search();
    tabla();
});
