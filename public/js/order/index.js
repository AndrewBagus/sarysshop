$(function () {
  $(document).on('click', '#btn-new', function (e) {
    e.preventDefault()
    toggleShow('#card-form', '#card-table')
  })
})
