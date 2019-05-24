
$(function()
{
    function previewAction () {

    let feed = $('#feedback');
    let name = $('#name').val();
    let email = $('#email').val();
    let message = $('#message').val();
    let image = $('#image')[0];

    $('#feedback').remove();

    $.get('/views/feed/Preview.html').done(function (data){
      data = $(data);
      data.find('#name').text('Имя: '+name);
      data.find('#email').text('Email: '+email);
      data.find('#message').text('Сообщение: '+message);
      if(image.files && image.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $(data.find('#image')).attr('src', e.target.result);
        }
        reader.readAsDataURL(image.files[0]);
      }
      else {
        data.find('#image').remove();
      }
      $('body').append(data);

      $('#back').click(function () {
        $('#preview').remove();
        $('body').append(feed);
        if(!$.data($('#preview-btn'), "events")) {
          $('#preview-btn').click(previewAction);
        }
      });
    });
  }


  $('#preview-btn').click(previewAction);


});
