$(function () {
  $('.select2bs4').select2({
    theme: 'bootstrap-5',
    allowClear: true,
  })

  $('.select2bs4-nonclear').select2({
    theme: 'bootstrap-5',
  })

  $(document).on('blur', 'input[data-toggle=datetimepicker]', function () {
    $(this).data('datetimepicker').hide()
  })

  $('input[data-toggle=datetimepicker]').datetimepicker({
    format: date_format,
  })

  $(document).on('click', '#dropdownMenuLink', function (e) {
    e.preventDefault()
    if ($(this).hasClass('show')) {
      $(this).removeClass('show')
      $(this).parents('li').find('ul.dropdown-menu').removeClass('show')
    } else {
      $(this).addClass('show')
      $(this).parents('li').find('ul.dropdown-menu').addClass('show')
    }
  })
})

window.addEventListener('load', function () {
  const t = document.getElementById('loader')
  setTimeout(function () {
    t.classList.add('fadeOut')
  }, 300)
})
