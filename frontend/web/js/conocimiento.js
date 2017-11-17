function rendertabla()
{
    $('#table_documentos').DataTable(languaje());
}
function tabla() {
    $.ajax({
        url: '../controllers/ajax/conocimiento.php',
        type: 'post',
        data: {id_proyecto_tipo: $('select').val()},
        success: function (data) {
            $('#data').html(data);
            rendertabla();
        }
    });
}
$(function ()
{
    tabla();
	$('select').change(function()
	{
		tabla();
	})
});