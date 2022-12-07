$(function () {
  $(document).on('hide.bs.modal', '#modal-penerimaan', function () {
    $('#form-penerimaan')[0].reset()
    $('#penerimaan-title').empty()
    $('#penerimaan-kurir').empty()
    $('#penerimaan-resi').empty()
    $('#penerimaan-pengiriman').empty()
    $('#penerimaan-id').val('')
  })

  initValidateForm(
    '#form-penerimaan',
    {
      penerimaan_tgl: {
        required: true,
      },
    },
    {
      penerimaan_tgl: {
        required: 'Tanggal Penerimaan harus di isi',
      },
    },
    function () {
      const penerimaan_id = $('#penerimaan-id').val()
      const penerimaan_tgl = $('#penerimaan-tgl').val()

      if ($('#card-form').is(':visible')) {
      } else {
        const data = {
          id: penerimaan_id,
          tanggal_diterima: formateDateDb(penerimaan_tgl),
        }
        confirmation(function () {
          f_ajax(
            `${base_uri}/order/saveOrderPenerimaan`,
            data,
            function (response) {
              tableList.ajax.reload(null, false)
              notification('success', 'Informasi', response.message)
              $('#modal-penerimaan').modal('hide')
            }
          )
        })
      }
    }
  )
})
