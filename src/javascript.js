function go_to_category(id){
  var category_id = id;
  $('.post').attr("value",category_id);//Insert the value of the category into the form on line 24. 
  $('.redirect').submit(); //Submit the form. 
}
