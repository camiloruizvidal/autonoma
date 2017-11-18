function rendertabla()
{
    $('#table_proyecto').DataTable(languaje());
}
function tabla()
{
    $.ajax({
        url: '../controllers/ajax/proyecto.php',
        type: 'post',
        data: $('#search').serialize(),
        success: function (data) {
            $('#data').html(data);
            rendertabla();
        }
    });
}
$(function ()
{
    $('#nombre,#proyecto,#inicio,#fin').keyup(function ()
    {
        tabla();
    });
    $('#idmodalidad,#activo,#inicio,#fin').change(function ()
    {
        tabla();
    });
    tabla();
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
});