$(function () {
  $(document).on('click', '#btn-add-gudang', function (e) {
    e.preventDefault()
    getKelurahanDesa('#kelurahan-gudang')
    toggleShow('#card-form-gudang', '#card-form')
    $('#nama-gudang').focus()
  })

  $(document).on('click', '#btn-back-gudang', function (e) {
    e.preventDefault()
    $('#form-gudang')[0].reset()
    $('#kelurahan-gudang').empty()
    tableAdminList.clear().draw()
    tableAdminFormList.clear().draw()
    toggleShow('#card-form', '#card-form-gudang')
  })

  $(document).on('select2:close', '#kelurahan-gudang', function () {
    $(this).closest('form').find('#telp-gudang')[0].focus()
  })

  $(document).on('change', '#kelurahan-gudang', function () {
    const pos = $(this).find(':selected').data('pos')
    $('#kode-pos-gudang').val(pos)
    $('#telp-gudang').focus()
  })

  $('#form-gudang').validate({
    rules: {
      nama: {
        required: true,
      },
      kelurahan_id: {
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
        required: 'Nama Gudang harus di isi',
      },
      kelurahan_id: {
        required: 'Kota/Kecamatan harus di isi',
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
      const data = getFormData($('#form-gudang'))
      const admins = tableAdminList.rows().data().toArray()
      data.admin = JSON.stringify(admins)
      data.id = 0

      f_ajax(`${base_uri}/gudang/saveData`, data, function (response) {
        if (response.status) {
          notification('success', 'Information', response.message)
          getOptionData(
            '#gudang',
            '/gudang/getGudangs',
            false,
            response.gudang_id
          )
          $('#btn-back-gudang').click()
        } else {
          newalert('info', 'Information', response.message)
        }
      })
    },
  })
})
