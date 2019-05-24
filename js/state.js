$(function () {

  $('.accept').click(function () {
    $.post('/index.php/feed/setstate', {id: $(this).closest('div').children('div').data('id'),
    id_state: 2});
    $(this).closest('.set-state').hide();
    $(this).closest('.set-state').siblings('.accepted').show();
  });

  $('.reject').click(function () {
    $.post('/index.php/feed/setstate', {id: $(this).closest('div').children('div').data('id'),
    id_state: 3});
    $(this).closest('.set-state').hide();
    $(this).closest('.set-state').siblings('.rejected').show();
  });

});
