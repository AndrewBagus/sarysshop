$(function () {
  $(document).on('hide.bs.modal', '#modal-diskon-varian', function () {
    $('#edit-varian-index').val('')
    $('#edit-varian-qty').val('')
    $('#edit-varian-nominal').val(0)

    $('#edit-varian-nama').html('')
  })

  $(document).on('shown.bs.modal', '#modal-diskon-varian', function () {
    $('#edit-varian-qty').focus()
  })

  $(document).on('keyup', '#edit-varian-qty', function (e) {
    let value = $(this).val()
    if (value !== '') {
      value = parseInt(value)
      if (isNaN(value) || value < 1) value = 1
      else if (value > 1000) value = 1000
      $(this).val(value)
    }

    if (e.keyCode === 13) {
      $(this).parents('.form-group').find('.btn-produk-tambah').click()
    }
  })

  $(document).on('blur', '#edit-varian-qty', function () {
    let value = $(this).val()
    if (value === '') {
      $(this).val(1)
    }
  })

  $(document).on('click', '#btn-produk-min', function (e) {
    e.preventDefault()
    e.stopPropagation()
    const inputFrom = $(this).next('input')
    const value = inputFrom.val()
    counter(inputFrom, value, 'min')
  })

  $(document).on('click', '#btn-produk-plus', function (e) {
    e.preventDefault()
    e.stopPropagation()
    const inputFrom = $(this).siblings('input')
    const value = inputFrom.val()
    counter(inputFrom, value, 'plus')
  })

  initValidateForm(
    '#form-edit-varian',
    {
      edit_varian_qty: {
        required: true,
      },
    },
    {
      edit_varian_qty: {
        required: 'Qty harus di isi',
      },
    },
    function () {
      const varians = tableOrderList.rows().data().toArray()
      const index = $('#edit-varian-index').val()
      let qty = $('#edit-varian-qty').val()
      qty = parseInt(qty)
      let varian = varians[index]
      const subtotal = qty * parseInt(varian.harga)
      varian.qty = qty
      varian.subtotal = subtotal - parseInt(varian.diskon_nominal)
      varians[index] = varian
      notification(
        'success',
        'Informasi',
        'Data kuantiti berhasil di ubah disimpan'
      )

      refreshTable(tableOrderList, varians)
      refreshGrandTotal()
      $('#modal-edit-varian').modal('hide')
    }
  )
})
