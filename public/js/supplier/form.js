$(function () {
  getKelurahanDesa('#kelurahan')

  $(document).on('select2:close', '#kelurahan', function () {
    $(this).closest('form').find('#telp')[0].focus()
  })

  $(document).on('change', '#kelurahan', function () {
    const pos = $(this).find(':selected').data('pos')
    $('#kode-pos').val(pos)
    $('#telp').focus()
  })

  $(document).on('click', '#btn-back', function () {
    $('#form-data')[0].reset()
    $('#kelurahan').empty()
    toggleShow('#card-table', '#card-form')
  })

  $('#form-data').validate({
    rules: {
      nama: {
        required: true,
      },
      kelurahan_id: {
        required: true,
      },
      kode_pos: {
        required: true,
      },
      telp: {
        required: true,
      },
      alamat: {
        required: true,
      },
      email: {
        email: true,
      },
    },
    messages: {
      nama: {
        required: 'Nama Supplier harus di isi',
      },
      kelurahan_id: {
        required: 'Kota/Kecamatan harus di isi',
      },
      kode_pos: {
        required: 'Kode Pos harus di isi',
      },
      telp: {
        required: 'Telepon harus di isi',
      },
      alamat: {
        required: 'Alamat harus di isi',
      },
      email: {
        email: 'Format email tidak sesuai',
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
      const data = getFormData($('#form-data'))

      f_ajax(`${base_uri}/supplier/saveData`, data, function (response) {
        if (response.status) {
          notification('success', 'Information', response.message)
          tableList.ajax.reload(null, false)
          $('#btn-back').click()
        } else {
          newalert('info', 'Information', response.message)
        }
      })
    },
  })
})
