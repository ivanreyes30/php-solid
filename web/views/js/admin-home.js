
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
            <i class="bi bi-trash-fill actions text-danger" student-id="${value.id}"></i>
            <i
              class="bi bi-pencil-square actions text-warning"
              data-bs-toggle="modal"
              data-bs-target="#studentModal"
              student-id="${value.id}"
              student-email="${value.email}"
              student-name="${value.name}"
              student-age="${value.age}"
              student-gpa="${value.gpa}"
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

getStudents(`${apiUrl}/student/all?page=1&per_page=10`)