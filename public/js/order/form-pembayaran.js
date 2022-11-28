$(function () {
  $(document).on('change', '#status-pembayaran', function () {
    const value = $(this).val()
    if (value === 'belum-bayar') {
      $('.belum-bayar-hide').addClass('d-none')
      $('#bank').rules('remove', 'required')
      $('#tgl-bayar').rules('remove', 'required')
      $('#nominal').rules('remove', 'required')
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
    }
  })
})
