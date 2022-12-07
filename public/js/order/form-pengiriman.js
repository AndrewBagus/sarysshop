$(function () {
  $(document).on('hide.bs.modal', '#modal-pengiriman', function () {
    $('#form-pengiriman')[0].reset()
    $('#pengiriman-title').empty()
    $('#pengiriman-kurir').empty()
    $('#pengiriman-id').val('')

    $('#pengiriman-resi').rules('add', {
      required: true,
    })
    $('#pengiriman-resi').prop('readonly', false)
  })

  initValidateForm(
    '#form-pengiriman',
    {
      pengiriman_resi: {
        required: true,
      },
      pengiriman_tgl: {
        required: true,
      },
    },
    {
      pengiriman_resi: {
        required: 'Resi Pengiriman harus di isi',
      },
      pengiriman_tgl: {
        required: 'Tanggal Pengiriman harus di isi',
      },
    },
    function () {
      const pengiriman_id = $('#pengiriman-id').val()
      const pengiriman_resi = $('#pengiriman-resi').val()
      const pengiriman_tgl = $('#pengiriman-tgl').val()

      if ($('#card-form').is(':visible')) {
      } else {
        const data = {
          id: pengiriman_id,
          no_resi: pengiriman_resi,
          tanggal_dikirim: formateDateDb(pengiriman_tgl),
        }
        confirmation(function () {
          f_ajax(
            `${base_uri}/order/saveOrderPengiriman`,
            data,
            function (response) {
              tableList.ajax.reload(null, false)
              notification('success', 'Informasi', response.message)
              $('#modal-pengiriman').modal('hide')
            }
          )
        })
      }
    }
  )
})
