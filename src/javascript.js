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
  $('.edit_table td').keyup(function() {
    clearTimeout($.data(this, 'timer'));
    var wait = setTimeout(saveData, 500); // delay after user types
    $(this).data('timer', wait);
  });
});
function saveData() {
  var table = document.getElementsByClassName('edit_table');
    for (var r = 0, n = table.rows.length; r < n; r++) {
        for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
            alert(table.rows[r].cells[c].innerHTML);
        }
    }
}