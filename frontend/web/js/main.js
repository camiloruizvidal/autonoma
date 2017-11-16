var ante = 0;
var pro = 0;
function msj(texto)
{
    Command: toastr["success"](texto, "Alerta")

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}
function cargandoalertas()
{
    $.ajax({
        url: '../controllers/alertas.php',
        dataType: 'json',
        success: function (data)
        {
            if (ante != data.Anteproyecto)
            {
                ante = data.Anteproyecto;
                $('#not_ante').html('<button class="btn btn-danger btn-icon">' + ante + '</button>');
                msj('Se ha creado un nuevo anteproyecto');
            }
            if (pro != data.Proyecto)
            {
                pro = data.Proyecto;
                $('#not_proy').html('<button class="btn btn-danger btn-icon" style="border-radius: 20px;">' + pro + '</button>');
                msj('Se ha creado un nuevo proyecto');
            }
        }
    });
}
function alertas()
{
    $.ajax({
        url: '../controllers/alertas.php',
        dataType: 'json',
        async: false,
        success: function (data)
        {
            pro = data.Proyecto;
            ante = data.Anteproyecto;
            $('#not_ante').html('<button class="btn btn-danger btn-icon" style="border-radius: 20px;">' + ante + '</button>');
            $('#not_proy').html('<button class="btn btn-danger btn-icon" style="border-radius: 20px;">' + pro + '</button>');
        }
    });
}
function notifi()
{
    if ($('#w3').text() === 'Ver Anteproyectos')
    {
        $('#w3 li a').html('<i id="not_ante"></i>Ver Anteproyectos');
    }
}
function inputsearch()
{
    $('input[name="DocumentoSearch[nombre]"]').parent().html('<div class="input-group"><span class="input-group-btn"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button></span>' + $('input[name="DocumentoSearch[nombre]"]').parent().html() + '</div>');


}
$(function ()
{
    inputsearch();
    notifi();
    alertas();
    setInterval(cargandoalertas, 3000);
    $(document).on('click', '.fc-day', function ()
    {
        var date = $(this).attr('data-date');
        $.get('index.php?r=evento/create', {'date': date}, function (data)
        {
            $('#modal').modal('show')
                    .find('#modalContent')
                    .html(data);
        });
    });
    // se obtiene el click de crear
    $('#modalButton').click(function ()
    {
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
});
