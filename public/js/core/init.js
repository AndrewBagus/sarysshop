$(function () {
  $('.select2bs5').select2({
    theme: 'bootstrap-5',
    allowClear: true,
  })

  $('.select2bs5-nonclear').select2({
    theme: 'bootstrap-5',
  })

  $(document).on('blur', 'input[data-toggle=datetimepicker]', function () {
    $(this).data('datetimepicker').hide()
  })

  $('input[data-toggle=datetimepicker]').datetimepicker({
    format: date_format,
  })
})
window.addEventListener('load', function () {
  const t = document.getElementById('loader')
  setTimeout(function () {
    t.classList.add('fadeOut')
  }, 300)
})
