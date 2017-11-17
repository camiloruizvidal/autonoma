function languaje()
{
    var data = {
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
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
        $('#table_documentos').DataTable(languaje());
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
    $('#inicio,#fin').change(function ()
    {
        tabla();
    });
    $('#nombre').keyup(function ()
    {
        tabla();
    });
}
function fechas()
{
    var dateFormat = "yy-mm-dd",
            from = $("#inicio")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat: dateFormat
            })
            .on("change", function () {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#fin").datepicker(
            {
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat: dateFormat
            })
            .on("change", function () {
                from.datepicker("option", "maxDate", getDate(this));
            });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        }
        catch (error) {
            date = null;
        }
        return date;
    }
}
$(function ()
{
    fechas();
    search();
    tabla();
});
