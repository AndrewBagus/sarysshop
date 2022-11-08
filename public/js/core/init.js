$('.select2bs4').select2({
  theme: 'bootstrap5',
  allowClear: true,
})

$('.select2bs4-nonclear').select2({
  theme: 'bootstrap5',
})

$(document).on('blur', 'input[data-toggle=datetimepicker]', function () {
  $(this).data('datetimepicker').hide()
})

$('input[data-toggle=datetimepicker]').datetimepicker({
  format: date_format,
})
