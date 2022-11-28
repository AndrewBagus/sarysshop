$(function() {
  $(document).on('click', '#btn-back', function() {
    $('#form-data')[0].reset()
    $('#id').val('0')
    $('#image-display').prop('src', `${base_uri}/assets/images/kurir.jpg`)
    toggleShow('#card-table', '#card-form')
  })

  $(document).on('click', '.image-uploader', function(e) {
    e.preventDefault()
    $(this).parents('.form-group').find('input[type=file]').click()
  })

  $(document).on('change', 'input[type=file]', function(e) {
    if (this.files && this.files[0]) {
      $(this)
        .parents('.form-group')
        .find('.image-uploader')
        .prop('src', URL.createObjectURL(e.target.files[0]))
    }
  })

  $('#form-data').validate({
    rules: {
      nama: {
        required: true,
      },
    },
    messages: {
      nama: {
        required: 'Nama Kurir harus di isi',
      },
    },
    errorElement: 'span',
    errorPlacement: function(error, element) {
      error.addClass('invalid-feedback')
      element.parents('.form-group').append(error)
    },
    highlight: function(element, errorClass, validClass) {
      $(element).addClass('is-invalid')
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).removeClass('is-invalid')
    },

    submitHandler: function(_, event) {
      event.preventDefault()
      const data = getFormDataFile($('#form-data'))

      const file = $('#image').prop('files')[0]
      data.append(`image`, file === undefined ? '' : file)

      f_ajax_file(`${base_uri}/kurir/saveData`, data, function(response) {
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
