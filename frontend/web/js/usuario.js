function rendertabla()
{
    $('#table_usuarios').DataTable(languaje());
}
function tabla()
{
    $.ajax({
        url: '../controllers/ajax/usuarios.php',
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
    tabla();
    $('#nombre,#documento').keyup(function ()
    {
        tabla();
    });
    $('#nombre,#documento,#programa,#estado,#rol').change(function ()
    {
        tabla();
    });
});