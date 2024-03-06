
let studentAction = null
const studentModal = new bootstrap.Modal(document.getElementById('studentModal'))

function defaultGetStudents()
{
  getStudents(`${apiUrl}/student/all?page=1&per_page=10`)
}

function getStudents(endpoint)
{
  get(endpoint)
    .then((result) => {
      if (result.data.length < 1) {
        tableEmpty()
        return
      }
      displayTable(result)
    })
    .catch((error) => {
      showAlert('danger', error.responseJSON.message)
    })
}

function tableEmpty()
{
  $('table tbody')
    .html(`
      <tr>
        <td colspan="6">No data found.</td>
      </tr>
    `)

  $('.pagination')
    .parent()
    .hide()
}

function displayTable(result)
{
  $('table tbody').html('')
  result.data.forEach(function (value) {
    $('table tbody')
      .append(`
        <tr>
          <td>${value.id}</td>
          <td>${value.email}</td>
          <td>${value.name}</td>
          <td>${value.age}</td>
          <td>${value.gpa}</td>
          <td>
            <i class="bi bi-trash-fill action text-danger" student-id="${value.id}" action="delete"></i>
            <i
              class="bi bi-pencil-square action text-warning"
              student-id="${value.id}"
              student-email="${value.email}"
              student-name="${value.name}"
              student-age="${value.age}"
              student-gpa="${value.gpa}"
              action="update"
            ></i>
          </td>
        </tr>
      `)
  })

  pagination(result)
}

function pagination(result)
{
  const previousDisabled = result.current_page === 1 
    ? 'disabled'
    : ''

  const nextDisabled = result.total_page === result.current_page 
    ? 'disabled'
    : ''

  $('.pagination')
    .parent()
    .show()

  $('.pagination').html(``)

  $('.pagination').html(`
    <li class="page-item ${previousDisabled}" action="previous">
      <a class="page-link">Previous</a>
    </li>
  `)

  result.pagination.forEach(function (value) {
    const isActive = value.label == result.current_page
      ? 'active'
      : ''
      
    $('.pagination').append(`
      <li class="page-item ${isActive}" action="paginate" endpoint="${value.url}">
        <a class="page-link">
          ${value.label}
        </a>
      </li>
    `)
  })

  $('.pagination').append(`
    <li class="page-item ${nextDisabled}" action="next">
      <a class="page-link">Next</a>
    </li>
  `)
}

function createStudent()
{
  if (!isPasswordMatched()) {
    showAlert('warning', 'Password does not matched')
    return
  }
  
  const params = getFormValues('#student-form')
  disableFormButton(true)
  post(`${apiUrl}/student/create`, params)
    .then((result) => {
      showAlert('success', ' Success! Student account has been created successfully.')
      defaultGetStudents()
      resetModalForm()
    })
    .catch((error) => {
      showAlert('danger', error.responseJSON.message)
    })
    .always(() => {
      disableFormButton(false)
    })
}

function updateStudent()
{
  const params = getFormValues('#student-form')
  disableFormButton(true)
  post(`${apiUrl}/student/update`, params)
    .then((result) => {
      showAlert('success', ' Success! Student account has been updated successfully.')
      defaultGetStudents()
      resetModalForm()
    })
    .catch((error) => {
      showAlert('danger', error.responseJSON.message)
    })
    .always(() => {
      disableFormButton(false)
    })
}

function deleteStudent(id)
{
  const action = window.confirm('Are you sure you want to delete?')

  if (!action) return

  const params = formData({ id })
  post(`${apiUrl}/student/delete`, params)
    .then((result) => {
      showAlert('success', ' Success! Student account has been deleted successfully.')
      defaultGetStudents()
    })
    .catch((error) => {
      showAlert('danger', error.responseJSON.message)
    })
}

function disableFormButton(disabled)
{
  $('#student-form button').prop('disabled', disabled)
}

function resetModalForm()
{
  $('#student-form')[0].reset()
  $('#studentModal').modal('toggle')
  $('.modal-backdrop').remove()
}

function hidePasswords()
{
  const element = $('.passwords')
  element.find('input').prop('required', false)
  element.hide()
}

function showPasswords()
{
  const element = $('.passwords')
  element.find('input').prop('required', true)
  element.show()
}

$(document).on('click', '.page-item', function (e) {
  e.preventDefault()
  const action = $(this).attr('action')
  switch (action) {
    case 'paginate': {
      const endpoint = $(this).attr('endpoint')
      getStudents(endpoint)
      break
    }

    case 'next': {
      if ($(this).hasClass('disabled')) return
      const element = $(this).parent().find('.page-item.active')
      const endpoint = element
        .removeClass('active')
        .next()
        .addClass('active')
        .attr('endpoint')

      getStudents(endpoint)
      break
    }

    case 'previous': {
      if ($(this).hasClass('disabled')) return
      const element = $(this).parent().find('.page-item.active')
      const endpoint = element
        .removeClass('active')
        .prev()
        .addClass('active')
        .attr('endpoint')

      getStudents(endpoint)
      break
    }
  }
})

$(document).on('submit', '#student-form', function (e) {
  e.preventDefault()

  switch (studentAction) {
    case 'create': {
      createStudent()
      break
    }
    case 'update': {
      updateStudent()
    }
  }
})

$(document).on('click', '.action', function (e) {
  e.preventDefault()
  studentAction = $(this).attr('action')
  
  switch (studentAction) {
    case 'create': {
      showPasswords()
      $('#student-form')[0].reset()
      $('#student-form')
        .find('button[type="submit"]')
        .html('Create')
        .removeClass()
        .addClass('btn btn-success')

      $('#studentModal').modal('toggle')
      break
    }
    case 'update': {
      hidePasswords()
      $('#student-form')
        .find('button[type="submit"]')
        .html('Update')
        .removeClass()
        .addClass('btn btn-warning text-white')

      $('#email').val($(this).attr('student-email'))
      $('#name').val($(this).attr('student-name'))
      $('#age').val($(this).attr('student-age'))
      $('#gpa').val($(this).attr('student-gpa'))
      $('#id').val($(this).attr('student-id'))
      $('#studentModal').modal('toggle')
      break
    }
    case 'delete': {
      const id = $(this).attr('student-id')
      deleteStudent(id)
    }
  }
})

defaultGetStudents()