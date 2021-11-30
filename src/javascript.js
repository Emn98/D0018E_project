//listen to category_buttons 

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

// listen to typing in table edit_product

$(document).ready(function() {
  $('#edit_table tbody tr td').keyup(function() {
    clearTimeout($.data(this, 'timer'));
    var wait = setTimeout(saveData, 500); // delay after user types
    $(this).data('timer', wait);
  });
});
function saveData() { 

  var obj = $('#edit_table tbody tr').map(function() {
  var $row = $(this);
  var t1 = $row.find(':nth-child(1)').text();
  var t2 = $row.find(':nth-child(2)').text();
  return {
      td_1: $row.find(':nth-child(1)').text(),
      td_2: $row.find(':nth-child(2)').text()
     };
  }).get();
  //alert(obj.td_1);

  $.ajax({
    cache: false,
    type: "POST",
    url: "/product_handling/edit_product.php",
    dataType: "json",
    data: JSON.stringify(obj),
    success: function() {
         alert("this worked");
    }
    
  });
  $("#redirect").submit();

}
