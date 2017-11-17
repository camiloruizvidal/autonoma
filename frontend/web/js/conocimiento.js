function rendertabla()
{
    $('#table_documentos').DataTable(languaje());
}
function tabla() {
    $.ajax({
        url: '../controllers/ajax/conocimiento.php',
        type: 'post',
        //data: $('form').serialize(),
        success: function (data) {
            $('#data').html(data);
            rendertabla();
        }
    });
}
$(function ()
{
    tabla();
});