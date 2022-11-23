$(function () {
  $(document).on('click', '#btn-back', function () {
    $('#form-data')[0].reset()
    $('#jenis-bank').val('').trigger('change')
    destroyVarianTable()
    toggleShow('#card-table', '#card-form')
  })

  $(document).on('click', '.image-uploader', function (e) {
    e.preventDefault()
    $(this).parents('.form-group').find('input[type=file]').click()
  })

  $(document).on('change', 'input[type=file]', function (e) {
    if (this.files && this.files[0]) {
      $(this)
        .parents('.form-group')
        .find('.image-uploader')
        .prop('src', URL.createObjectURL(e.target.files[0]))
    }
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
      const data = getFormDataFile($('#form-data'))
      const varians = tableVarian.rows().data().toArray()

      if (varians.length === 0) {
        newalert('info', 'Varian produk minimal harus 1', 'Informasi')
        return false
      }

      for (let i = 0; i < varians.length; i++) {
        const item = varians[i]

        if (item.file !== undefined) {
          data.append('varianFile_' + i, item.file)
        }
      }
      const file = $('#image').prop('files')[0]
      data.append(`produkFile`, file === undefined ? '' : file)
      data.append(`varians`, JSON.stringify(varians))

      f_ajax_file(`${base_uri}/produk/saveData`, data, function (response) {
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
