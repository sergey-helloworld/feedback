$(function () {

  function changeColor(element) {
    element.attr('class', 'btn btn-primary');
    element.siblings().attr('class', 'btn btn-secondary');
  }

  function sortAction(event) {
    $('.message-block').sort(function (a, b) {
      return $(a).find(event.data.classname).text() < $(b).find(event.data.classname).text() ? -1 :
      $(a).find(event.data.classname).text() > $(b).find(event.data.classname).text() ? 1 : 0;
    }).appendTo('#feed-list');
    changeColor($(this));
  }

  $('#sort-by-date').click({classname: '.date'}, sortAction);
  $('#sort-by-email').click({classname: '.email'}, sortAction);
  $('#sort-by-author').click({classname: '.name'}, sortAction);

});
