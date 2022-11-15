$(function () {
  $(document).on('click', '#btn-back', function () {
    $('#form-data')[0].reset()
    $('#jenis-bank').val('').trigger('change')
    toggleShow('#card-table', '#card-form')
  })

  $('#form-data').validate({
    rules: {
      jenis_bank_id: {
        required: true,
      },
      cabang: {
        required: true,
      },
      rekening: {
        required: true,
      },
      atas_nama: {
        required: true,
      },
    },
    messages: {
      jenis_bank_id: {
        required: 'Bank harus di isi',
      },
      cabang: {
        required: 'Cabang harus di isi',
      },
      rekening: {
        required: 'Rekening harus di isi',
      },
      atas_nama: {
        required: 'Atas Nama harus di isi',
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

      f_ajax(`${base_uri}/bank/saveData`, data, function (response) {
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
