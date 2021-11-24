$(document).ready(function() {
    $('#category_1').click(function () {
      var link = $(this).attr('var');
      $('.post').attr("value",link);
      $('.redirect').submit();
    });
  });
  $(document).ready(function() {
    $('#category_2').click(function () {
      var link = $(this).attr('var');
      $('.post').attr("value",link);
      $('.redirect').submit();
    });
  });
  $(document).ready(function() {
    $('#category_5').click(function () {
      var link = $(this).attr('var');
      $('.post').attr("value",link);
      $('.redirect').submit();
    });
  });
