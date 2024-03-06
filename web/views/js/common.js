/*
|--------------------------------------------------------------------------
| Variables
|--------------------------------------------------------------------------
*/

const apiUrl = 'http://localhost/php-solid/api'
const webUrl = 'http://localhost/php-solid/web'

/*
|--------------------------------------------------------------------------
| Go back
|--------------------------------------------------------------------------
*/

$(document).on('click', '.go-back', function (e) {
  e.preventDefault()
  location.replace(`${webUrl}/login`)
})

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

$(document).on('click', '.logout', function (e) {
  e.preventDefault()

  get(`${apiUrl}/auth/logout`)
    .then(() => (location.replace(`${webUrl}/login`)))
    .catch((error) => (console.log(error)))
})

/*
|--------------------------------------------------------------------------
| Http Requests Helpers
|--------------------------------------------------------------------------
*/

function get (endpoint, params)
{
  return $.ajax({
    url: endpoint,
    type: 'GET',
    data: params,
    contentType: false,
    processData: false
  })
}

function post (endpoint, params)
{
  return $.ajax({
    url: endpoint,
    type: 'POST',
    data: params,
    contentType: false,
    processData: false
  })
}

function get (endpoint)
{
  return $.ajax({
    url: endpoint,
    type: 'POST',
    contentType: false,
    processData: false
  })
}

/*
|--------------------------------------------------------------------------
| Form Helpers
|--------------------------------------------------------------------------
*/

function formData(params)
{
  let form = new FormData()

  for (const param in params) {
    form.append(param, params[param])
  }

  return form
}

function getFormValues(form)
{
  const object = {}

  // input[type="text"], input[type="password"], input[type="email"], input[type="number"] input[type="hidden"]
  $(`${form} input`).each((key, inputBox) => {
    const name = $(inputBox).attr('name')
    const value = $(inputBox).val()
    object[name] = value
  })

  return formData(object)
}

function isPasswordMatched()
{
  return $('#password').val() === $('#confirm-password').val()
}

/*
|--------------------------------------------------------------------------
| Alert Helpers
|--------------------------------------------------------------------------
*/

function showAlert(type, message)
{
  $('.custom-alert span').html(message)
  $('.custom-alert')
    .removeClass()
    .addClass(`alert alert-${type} custom-alert`)
    .show()

  setTimeout(() => {
    $('.custom-alert').hide()
  }, 3000)
}