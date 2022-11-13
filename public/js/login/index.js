$(function () {
  $('#form-data').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      email: {
        required: 'Email harus di isi',
        email: 'Format email tidak valid',
      },
      password: {
        required: 'Password harus di isi',
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback')
      element.parents('.input-group').append(error)
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid')
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid')
    },

    submitHandler: function (_, event) {
      event.preventDefault()
      const email = $('#email').val()
      const password = $('#password').val()

      const data = {
        email: email,
        password: password,
      }

      f_ajax(`${base_uri}/login/login`, data, function (response) {
        if (response.status) {
          newalert('success', response.message)
          setTimeout(() => {
            window.location = base_uri
          }, 750)
        } else {
          newalert('info', 'Information', response.message)
        }
      })
    },
  })
})
