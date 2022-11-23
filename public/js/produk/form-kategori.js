$(function () {
  $(document).on('click', '#btn-add-kategori', function (e) {
    e.preventDefault()
    toggleShow('#card-form-kategori', '#card-form')
    $('#nama-kategori').focus()
  })

  $(document).on('click', '#btn-back-kategori', function () {
    $('#form-kategori')[0].reset()
    toggleShow('#card-form', '#card-form-kategori')
  })

  $('#form-kategori').validate({
    rules: {
      nama: {
        required: true,
      },
    },
    messages: {
      nama: {
        required: 'Nama Kategori harus di isi',
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback')
      element.parents('.form-group').append(error)
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid')
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid')
    },

    submitHandler: function (_, event) {
      event.preventDefault()
      const data = getFormData($('#form-kategori'))
      data.id = 0

      f_ajax(`${base_uri}/kategoriProduk/saveData`, data, function (response) {
        if (response.status) {
          notification('success', 'Information', response.message)
          getOptionData(
            '#kategori-produk',
            '/kategoriProduk/getKategoriProduks',
            true,
            response.kategori_id
          )
          $('#btn-back-kategori').click()
        } else {
          newalert('info', 'Information', response.message)
        }
      })
    },
  })
})
