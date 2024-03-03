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

function formData(params)
{
  let form = new FormData()

  for (const param in params) {
    form.append(param, params[param])
  }

  return form
}

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