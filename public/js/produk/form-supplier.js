$(function () {
  $(document).on('click', '#btn-add-supplier', function (e) {
    e.preventDefault()
    getKelurahanDesa('#kelurahan-supplier')
    toggleShow('#card-form-supplier', '#card-form')
    $('#nama-supplier').focus()
  })

  $(document).on('click', '#btn-back-supplier', function (e) {
    e.preventDefault()
    $('#form-gudang')[0].reset()
    $('#kelurahan-supplier').empty()
    toggleShow('#card-form', '#card-form-supplier')
  })

  $(document).on('select2:close', '#kelurahan-supplier', function () {
    $(this).closest('form').find('#telp-supplier')[0].focus()
  })

  $(document).on('change', '#kelurahan-supplier', function () {
    const pos = $(this).find(':selected').data('pos')
    $('#kode-pos-supplier').val(pos)
    $('#telp-supplier').focus()
  })

  $(document).on('hide.bs.modal', '#modal-supplier', function () {
    $('#form-data')[0].reset()
    $('#kelurahan-supplier').empty()
  })

  $('#form-supplier').validate({
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
      const data = getFormData($('#form-supplier'))
      data.id = 0

      f_ajax(`${base_uri}/supplier/saveData`, data, function (response) {
        if (response.status) {
          notification('success', 'Information', response.message)
          getOptionData(
            '#supplier',
            '/supplier/getSuppliers',
            true,
            response.supplier_id
          )
          $('#btn-back-supplier').click()
        } else {
          newalert('info', 'Information', response.message)
        }
      })
    },
  })
})
