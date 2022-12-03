$(function () {
  getBank()

  $('#tgl-bayar').datetimepicker('destroy')
  $('#tgl-bayar').datetimepicker({
    minDate: moment(),
    format: date_format,
  })

  $(document).on('change', '#status-pembayaran', function () {
    const value = $(this).val()
    if (value === 'belum-bayar') {
      $('.belum-bayar-hide').addClass('d-none')
      $('#bank').rules('remove', 'required')
      $('#tgl-bayar').rules('remove', 'required')
      $('#nominal').rules('remove', 'required')

      $('#bank').val('').trigger('change')
      $('#tgl-bayar').val('')
      $('#nominal').val('')
    } else if (value === 'cicilan') {
      $('.belum-bayar-hide').removeClass('d-none')
      $('#bank').rules('add', {
        required: true,
      })
      $('#tgl-bayar').rules('add', {
        required: true,
      })
      $('#nominal').rules('add', {
        required: true,
      })
      const tgl = $('#tgl-bayar')
      tgl_value = tgl.val()
      if (tgl_value === '') tgl.val(moment().format(date_format))
    } else if (value === 'lunas') {
      $('.belum-bayar-hide').addClass('d-none')
      $('.lunas-show').removeClass('d-none')
      $('#nominal').rules('remove', 'required')

      $('#bank').rules('add', {
        required: true,
      })
      $('#tgl-bayar').rules('add', {
        required: true,
      })
      $('#nominal').rules('add', {
        required: true,
      })
      const tgl = $('#tgl-bayar')
      tgl_value = tgl.val()
      if (tgl_value === '') tgl.val(moment().format(date_format))
    }
  })

  function getBank() {
    f_ajax(`${base_uri}/bank/getBanks`, {}, function (response) {
      const repo = response.map(function (item) {
        const name = item.jenis_bank === null ? item.cabang : item.jenis_bank
        return {
          id: item.id,
          text: `<div>${name} - ${item.atas_nama}</div>
                <div><b>${item.rekening}</b></div>`,
        }
      })

      $('#bank')
        .prepend('<option selected></option>')
        .select2({
          theme: 'bootstrap-5',
          allowClear: true,
          placeholder: 'Cari Bank',
          escapeMarkup: function (m) {
            return m
          },
          data: repo,
          templateResult: formatRepo,
          templateSelection: formatRepoSelection,
        })
    })
  }

  function formatRepo(repo) {
    return $(repo.text)
  }

  function formatRepoSelection(repo) {
    return repo.text
  }
})
