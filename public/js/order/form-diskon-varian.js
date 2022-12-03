$(function () {
  $(document).on('hide.bs.modal', '#modal-diskon-varian', function () {
    $('#diskon-varian-index').val('')
    $('#diskon-varian').val('nominal').trigger('change')
    $('#diskon-varian-percen').val(0)
    $('#diskon-varian-nominal').val(0)

    $('#diskon-varian-nama').html('')
    $('#diskon-varian-harga-awal').html(0)
    $('#diskon-varian-harga-akhir').html(0)
  })

  $(document).on('shown.bs.modal', '#modal-diskon-varian', function () {
    const tipe = $('#diskon-varian').val()
    if (tipe === 'nominal') $('#diskon-varian-nominal').focus()
    else if (tipe === 'percen') $('#diskon-varian-percen').focus()
  })

  $(document).on('change', '#diskon-varian', function () {
    const value = $(this).val()
    if (value === 'percen') {
      $('#diskon-varian-percen').removeClass('d-none')
      $('#diskon-varian-percen').rules('add', {
        required: true,
      })
      $('#diskon-varian-percen').focus()
      $('#diskon-varian-nominal').rules('remove', 'required')
      $('#diskon-varian-nominal').prop('readonly', true)
    } else if (value === 'nominal') {
      $('#diskon-varian-nominal').rules('add', {
        required: true,
      })
      $('#diskon-varian-nominal').focus()
      $('#diskon-varian-nominal').prop('readonly', false)
      $('#diskon-varian-percen').rules('remove', 'required')
      $('#diskon-varian-percen').addClass('d-none')
      $('#diskon-varian-percen').val('0')
    }
  })

  $(document).on('keyup', '#diskon-varian-percen', function () {
    const index = $('#diskon-varian-index').val()
    const varian = tableOrderList.row(index).data()
    let subTotalVarian = varian.qty * varian.harga
    let value = $(this).val()
    let nominal = 0
    if (value !== '') {
      value = thousandUnFormat(value)
      if (parseInt(value) > 100) value = 100

      $(this).val(value)
      nominal = Math.round((subTotalVarian * value) / 100)
      if (subTotalVarian > nominal) {
        subTotalVarian -= nominal
      } else {
        subTotalVarian = 0
      }
    }
    $('#diskon-varian-nominal').val(thousandFormat(nominal))
    $('#diskon-varian-harga-akhir').html(thousandFormat(subTotalVarian))
  })

  $(document).on('focus', '#diskon-varian-percen', function () {
    let value = $(this).val()
    if (value !== '') value = parseInt(value) === 0 ? '' : parseInt(value)
    $(this).val(value)
  })

  $(document).on('focus', '#diskon-varian-nominal', function () {
    let value = $(this).val()
    value = value === '0' ? '' : value
    $(this).val(value)
  })

  $(document).on('keyup', '#diskon-varian-nominal', function () {
    const index = $('#diskon-varian-index').val()
    const varian = tableOrderList.row(index).data()
    let subTotalVarian = varian.qty * varian.harga
    let value = $(this).val()
    value = value === '0' ? '' : value

    if (value !== '') {
      value = parseInt(thousandUnFormat(value))
      if (subTotalVarian > value) {
        subTotalVarian -= value
      } else if (subTotalVarian < value) {
        value = subTotalVarian
        subTotalVarian = 0
      }
      $(this).val(thousandFormat(value))
    }
    $('#diskon-varian-harga-akhir').html(thousandFormat(subTotalVarian))
  })

  initValidateForm(
    '#form-diskon-varian',
    {
      diskon_varian_nominal: {
        required: true,
      },
    },
    {
      diskon_varian_nominal: {
        required: 'Nominal harus di isi',
      },
      diskon_varian_percen: {
        required: 'Persen harus di isi',
      },
    },
    function () {
      const varians = tableOrderList.rows().data().toArray()
      const index = $('#diskon-varian-index').val()
      const tipe = $('#diskon-varian').val()
      let percen = $('#diskon-varian-percen').val()
      let nominal = $('#diskon-varian-nominal').val()

      if (percen !== '') percen = parseInt(thousandUnFormat(percen))
      nominal = parseInt(thousandUnFormat(nominal))

      const varian = varians[index]
      const subtotal = varian.qty * varian.harga
      varian.diskon_tipe = tipe
      varian.diskon_persen = percen
      varian.diskon_nominal = nominal

      varian.subtotal = subtotal - nominal

      varians[index] = varian
      notification('success', 'Informasi', 'Data Diskon berhasil disimpan')

      refreshTable(tableOrderList, varians)
      refreshGrandTotal()
      $('#modal-diskon-varian').modal('hide')
    }
  )
})
