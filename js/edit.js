$(function () {
  let lastStates = [];

  function editAction () {
      if(!lastStates[$(this).parent().attr('id')]) {
        let self = $(this);
        lastStates[$(this).parent().attr('id')] = $(this).parent().children('div').html();
        let text = $(this).parent().children('div').children('.message').text();
        $(this).parent().children('div').children('.message').replaceWith('<input name="edited" class="form-control" value="'+text+'"><button class="btn btn-primary my-1" name="submit">ОК</button>');
        $(this).text('Отменить').attr('class','btn btn-danger');
        $(this).parent().find('button[name="submit"]').click(function () {
          let edited = $(self).parent().children('div').children('input[name="edited"]');
          if(edited.val() === "") {
            edited.addClass('is-invalid').focus();
          }
          else {
            $.post('/index.php/feed/edit', {'id': $(self).parent().children('div').data('id'), 'message': edited.val()});
            $(location).attr('href', '/index.php');
            window.location.reload(true);
          }
        });
      }
      else {
        $(this).parent().children('div').html(lastStates[$(this).parent().attr('id')]);
        lastStates[$(this).parent().attr('id')] = null;
        $(this).text('Редактировать').attr('class','btn btn-primary');
      }
  }

  $('button[name="edit"]').click(editAction);

});
