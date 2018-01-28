$('#create_cro').submit(function(e) {
  var validation = true;
  var password = $(this).find('input[name="password"]').val(),
      password_c = $(this).find('input[name="password_confirmation"]').val();
  $('.has-error').addClass('hidden');
  if (password != password_c) {
    $('.has-error-password').removeClass('hidden');
    validation = false;
  }
  return validation;
});
