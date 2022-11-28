$(function () {
  $(document).on('change', '#nominal-type', function (e) {
    const value = $('#nominal-type').val()
    if (value === 'percen') {
      $('#wrapper-percen').removeClass('d-none')
      $('#wrapper-percen').rules('add', {
        required: true,
      })
      $('#wrapper-percen').focus()
      $('#wrapper-nominal').rules('remove', 'required')
      $('#wrapper-nominal').prop('readonly', true)
    } else if (value === 'nominal') {
      $('#wrapper-nominal').rules('add', {
        required: true,
      })
      $('#wrapper-nominal').focus()
      $('#wrapper-nominal').prop('readonly', false)
      $('#wrapper-percen').rules('remove', 'required')
      $('#wrapper-percen').addClass('d-none')
      $('#wrapper-percen').val('0')
    }
  })

  $(document).on('keyup', '#wrapper-percen', function () {
    let value = thousandUnFormat($(this).val())
    if (parseInt(value) > 100) value = 100
    else if (parseInt(value) === 0) value = ''

    $(this).val(value)
    $('#wrapper-nominal').val(0)
    if (subtotal > 0) {
      const nominal = Math.round((subtotal * value) / 100)
      $('#wrapper-nominal').val(thousandFormat(nominal))
    }
  })

  $(document).on('focus', '#wrapper-percen', function () {
    let value = $(this).val()
    if (value !== '') value = parseInt(value) === 0 ? '' : parseInt(value)
    $(this).val(value)
  })

  $(document).on('focus', '#wrapper-nominal', function () {
    let value = $(this).val()
    value = value === '0' ? '' : value
    $(this).val(value)
  })

  $(document).on('hide.bs.modal', '#modal-wrapper', function () {
    $('#form-wrapper')[0].reset()
    $('#wrapper-name').val('')
    $('#wrapper-nominal').val(0)
    $('#wrapper-index').val('')
    $('#wrapper-type').val('')
    $('#nominal-type').val('nominal').trigger('change')
  })

  $(document).on('shown.bs.modal', '#modal-wrapper', function () {
    $('#wrapper-name').focus()
    $('#wrapper-nominal').val(0)
  })

  initValidateForm(
    '#form-wrapper',
    {
      wrapper_nominal: {
        required: true,
      },
    },
    {
      wrapper_nominal: {
        required: 'Nominal harus di isi',
      },
      wrapper_percen: {
        required: 'Persen harus di isi',
      },
    },
    function () {
      const type = $('#wrapper-type').val()
      const index = $('#wrapper-index').val()
      const nama = $('#wrapper-name').val()
      const nominalType = $('#nominal-type').val()
      const percen = $('#wrapper-percen').val()
      const nominal = $('#wrapper-nominal').val()
      let meesage = null

      data = {
        id: 0,
        nama: nama,
        tipe: nominalType,
        persen: thousandUnFormat(percen),
        nominal: thousandUnFormat(nominal),
      }

      if (type === 'granddiskon') {
        refreshGrandDiskon(index, data)
        meesage = 'Data Diskon berhasil disimpan'
      } else if (type === 'grandadditional') {
        refreshGrandAdditional(index, data)
        meesage = 'Data Biaya Lain berhasil disimpan'
      }

      notification('success', 'Informasi', meesage)
      refreshGrandTotal()
      $('#modal-wrapper').modal('hide')
    }
  )
})
