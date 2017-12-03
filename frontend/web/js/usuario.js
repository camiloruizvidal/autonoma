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
    $('.roles').click(function ()
    {
        switch ($(this).val())
        {
            case 'Estudiante':
                if ($('#Estudiante').prop('checked'))
                {
                    $("#Comite,#Secretario,#Docente,#Jurado").attr("disabled", true);
                    $("#Comite,#Secretario,#Docente,#Jurado").hide();
                }
                else
                {
                    $("#Comite,#Secretario,#Docente,#Jurado").removeAttr("disabled");
                    $("#Comite,#Secretario,#Docente,#Jurado").show();
                }
                break;
            case 'Docente':
                if ($('#Docente').prop('checked'))
                {
                    $("#Estudiante,#Secretario").attr("disabled", true);
                    $("#Estudiante,#Secretario").hide();
                }
                else
                {
                    $("#Estudiante,#Secretario").removeAttr("disabled");
                    $("#Estudiante,#Secretario").show();
                }
                break;
            case 'Jurado':
                if ($('#Jurado').prop('checked'))
                {
                    $("#Estudiante,#Secretario").attr("disabled", true);
                    $("#Estudiante,#Secretario").hide();
                }
                else
                {
                    $("#Estudiante,#Secretario").removeAttr("disabled");
                    $("#Estudiante,#Secretario").show();
                }
                break;
            case 'Secretario':
                if ($('#Secretario').prop('checked'))
                {
                    $("#Comite,#Estudiante,#Docente,#Jurado").attr("disabled", true);
                    $("#Comite,#Estudiante,#Docente,#Jurado").hide();
                }
                else
                {
                    $("#Comite,#Estudiante,#Docente,#Jurado").removeAttr("disabled");
                    $("#Comite,#Estudiante,#Docente,#Jurado").show();
                }
                break;
            case 'Comite':
                if ($('#Comite').prop('checked'))
                {
                    $("#Estudiante,#Secretario").attr("disabled", true);
                    $("#Estudiante,#Secretario").hide();
                }
                else {

                    $("#Estudiante,#Secretario").removeAttr("disabled");
                    $("#Estudiante,#Secretario").show();
                }

                break;
        }
    });
    tabla();
    $('#nombre,#documento').keyup(function ()
    {
        tabla();
    });
    $('#nombre,#documento,#programa,#estado,#rol').change(function ()
    {
        tabla();
    });
    $('#form-signup').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: 'index.php?r=site%2Fsignup',
            type: 'post',
            data: $('#form-signup').serialize(),
            success: function (data) {
                $('#data').html(data);
                rendertabla();
            }
        });
    });
});