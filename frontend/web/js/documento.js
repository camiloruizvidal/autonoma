function rendertabla()
{
    $('#table_documentos').DataTable(languaje());
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
