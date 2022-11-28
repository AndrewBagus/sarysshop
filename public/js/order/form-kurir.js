$(function () {
  getOptionData('#kurir', '/kurir/getKurirs')

  $(document).on('hidden.bs.modal', '#modal-kurir', function () {
    $('#kurir').val(null).trigger('change')
    $('#kurir-biaya').val(0)
  })

  $(document).on('focus', '#kurir-biaya', function () {
    const value = $(this).val()
    if (value === '0') $(this).val('')
  })

  $(document).on('click', '#btn-biaya-kurir', function (e) {
    e.preventDefault()
    $('#modal-kurir').modal('show')
    if (kurir.id !== 0) {
      $('#kurir').val(kurir.id).trigger('change')
      $('#kurir-biaya').val(thousandFormat(kurir.biaya))
      $('#kurir-biaya').focus()
    }
  })

  initValidateForm(
    '#form-kurir',
    {
      kurir_id: {
        required: true,
      },
      biaya_kurir: {
        required: true,
      },
    },
    {
      kurir_id: {
        required: 'Kurir harus di isi',
      },
      biaya_kurir: {
        required: 'Biaya Kurir minimal 0',
      },
    },
    function () {
      const kurirData = $('#kurir').select2('data')[0]
      const biaya = $('#kurir-biaya').val()
      kurir.id = kurirData.id
      kurir.nama = kurirData.text
      kurir.biaya = thousandUnFormat(biaya)
      $('#kurir-nama').html(kurir.nama)
      $('#ongkir').html(biaya)
      $('#modal-kurir').modal('hide')

      refreshGrandTotal()
    }
  )
})
