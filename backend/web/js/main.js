$(function(){

  $(document).on('click', '.fc-day', function(){

    var date = $(this).attr('data-date');
    $.get('index.php?r=evento/create',{'date':date},function(data){
      $('#modal').modal('show')
       .find('#modalContent')
       .html(data);
    });
  });
// se obtiene el click de crear
$('#modalButton').click(function(){
  $('#modal').modal('show')
  .find('#modalContent')
  .load($(this).attr('value'));
  });
});
