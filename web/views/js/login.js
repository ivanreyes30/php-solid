
$(document).on('submit', '#login-form', function (e) {
  e.preventDefault()
  $(this).find('button').prop('disabled', true)
  const params = formData({ email: $('#email').val(), password: $('#password').val() })

  post(`${apiUrl}/auth/login`, params)
    .then((result) => {
      if (result.role == 1) location.replace(`${webUrl}/admin/home`)
      else location.replace(`${webUrl}/student/home`)
    })
    .catch((error) => {
      showAlert('danger', error.responseJSON.message)
    })
    .always(() => {
      $(this).find('button').prop('disabled', false)
    })
})

