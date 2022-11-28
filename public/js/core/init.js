$(function () {
  $('.select2bs5').select2({
    theme: 'bootstrap-5',
    allowClear: true,
  })

  $('.select2bs5-nonclear').select2({
    theme: 'bootstrap-5',
  })

  initThousand()

  $(document).on('blur', 'input[data-toggle=datetimepicker]', function () {
    if ($(this).data('datetimepicker') !== undefined)
      $(this).data('datetimepicker').hide()
  })

  $('input[data-toggle=datetimepicker]').datetimepicker({
    format: date_format,
  })

  $(document).on('click', '*[data-bs-toggle="tooltip"]', function () {
    $(this).tooltip('hide')
  })

  $(document).on('click', '[data-bs-toggle="dropdown"]', function (e) {
    e.preventDefault()
    if ($(this).hasClass('show')) {
      $(this).removeClass('show')
      $(this)
        .parents('.dropdown, .dropstart')
        .find('ul.dropdown-menu')
        .removeClass('show')
    } else {
      $(this).addClass('show')
      $(this)
        .parents('.dropdown, .dropstart')
        .find('ul.dropdown-menu')
        .addClass('show')
    }
  })
})

// window.addEventListener('load', function () {
//   const t = document.getElementById('loader')
//   setTimeout(function () {
//     t.classList.add('fadeOut')
//   }, 300)
// })
