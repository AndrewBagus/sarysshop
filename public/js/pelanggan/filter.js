$(function () {
  getOptionData(
    '#kategori-pelanggan-filter',
    '/kategoriPelanggan/getKategoriPelanggan'
  )

  $(document).on('click', '#btn-filter', function (e) {
    e.preventDefault()
    $('#modal-filter').modal('show')
  })

  $(document).on('click', '#btn-refresh', function (e) {
    e.preventDefault()
    $('#kategori-pelanggan-filter').val('').trigger('change')
    tableList.ajax.reload()
    $('#modal-filter').modal('hide')
  })

  initValidateForm(
    '#form-filter',
    {
      kategori_pelanggan_filter: {
        required: true,
      },
    },
    {
      kategori_pelanggan_filter: {
        required: 'Kategori Pelanggan harus di isi',
      },
    },
    function () {
      tableList.ajax.reload()
      $('#modal-filter').modal('hide')
    }
  )
})
