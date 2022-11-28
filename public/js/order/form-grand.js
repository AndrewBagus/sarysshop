$(function () {
  $(document).on('click', '#btn-global-diskon', function (e) {
    e.preventDefault()
    $('#wrapper-title').html('Diskon Order')
    $('#wrapper-type').val('granddiskon')
    $('#modal-wrapper').modal('show')
  })

  $(document).on('click', '#btn-global-additional', function (e) {
    e.preventDefault()
    $('#wrapper-title').html('Biaya Lain')
    $('#wrapper-type').val('grandadditional')
    $('#modal-wrapper').modal('show')
  })
})
