$(document).ready(function() {
    $('#click_this').click(function () {
      var link = $(this).attr('var');
      alert(link);
      $('.post').attr("value",link);
      $('.redirect').submit();
    });
  });