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

  $(document).on('click', '.btn-order-edit', function (e) {
    e.preventDefault()
    const index = $(this).data('index')
    const tipe = $(this).data('tipe')
    let arrays = []
    if (tipe === 'granddiskon') {
      arrays = diskons[index]
      $('#wrapper-title').html('Diskon Order')
    } else if (tipe === 'grandadditional') {
      arrays = additionals[index]
      $('#wrapper-title').html('Biaya Lain')
    }
    console.log(arrays)

    $('#wrapper-type').val(tipe)
    $('#wrapper-index').val(index)
    $('#wrapper-name').val(arrays.nama)
    $('#nominal-type').val(arrays.tipe).trigger('change')
    $('#wrapper-percen').val(arrays.persen)
    $('#wrapper-nominal').val(thousandFormat(arrays.nominal))

    $('#modal-wrapper').modal('show')
  })

  $(document).on('click', '.btn-order-delete', function (e) {
    e.preventDefault()
    const index = $(this).data('index')
    const tipe = $(this).data('tipe')

    confirmation(function () {
      if (tipe === 'granddiskon') {
        diskons.splice(index, 1)
        createDiskonAdditional('#diskon-wrapper', diskons, true)
      } else if (tipe === 'grandadditional') {
        additionals.splice(index, 1)
        createDiskonAdditional('#additional-wrapper', additionals, false)
      }
      refreshGrandTotal()
    })
  })
})
