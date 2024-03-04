
$(document).on('submit', '#signup-form', function (e) {
  e.preventDefault()

  if (!isPasswordMatched()) {
    showAlert('warning', 'Password does not matched')
    return
  }

  $(this).find('button').prop('disabled', true)
  const params = getFormValues('#signup-form')

  post(`${apiUrl}/student/create`, params)
    .then((result) => {
      $(this)[0].reset()
      showAlert('success', ' Success! Your account has been created successfully.')
    })
    .catch((error) => {
      showAlert('danger', error.responseJSON.message)
    })
    .always(() => {
      $(this).find('button').prop('disabled', false)
    })
})

function isPasswordMatched()
{
  return $('#password').val() === $('#confirm-password').val()
}