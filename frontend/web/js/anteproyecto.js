function rendertabla()
{
    $('#table_anteproyecto').DataTable(languaje());
}
function tabla() {
    $.ajax({
        url: '../controllers/ajax/anteproyecto.php',
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