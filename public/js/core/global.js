let base_uri = window.location.origin
const date_format = 'DD/MM/YYYY'
let diskons = {
  type: '',
  nominal: 0,
}
let pajaks = {
  id: '',
  nominal: 0,
}

function notification(tipe, title, message) {
  toastr.options = {
    closeButton: true,
    debug: false,
    positionClass: 'toast-top-left',
    onclick: null,
    showDuration: '100',
    hideDuration: '100',
    timeOut: '3000',
    extendedTimeOut: '900',
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut',
  }
  toastr[tipe](message, title)
}

function confirmation(statement, statement2, title) {
  if (title == undefined) title = 'Apakah anda yakin?'
  Swal.fire({
    heightAuto: false,
    title: title,
    text: '',
    icon: 'warning',
    // animation: false,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!',
  }).then(function (result) {
    if (result.value) {
      statement(result.value)
    } else {
      if (statement2 != undefined) statement2()
    }
  })
}

function newalert(tipe, title, message) {
  Swal.fire({
    heightAuto: false,
    icon: tipe,
    title: title,
    html: message,
  })
}

function f_ajax(url, data) {
  var _success =
    arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null

  // CSRF Hash
  const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
  const csrfHash = $('[name=app_token_name]').val() // CSRF hash

  data[csrfName] = csrfHash

  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'JSON',
    data: data,
    success: function success(result) {
      if (_success != null) _success(result)
    },
    error: function error(msg) {
      console.log(msg)
    },
  })
}

function f_ajax_file(url, data) {
  var _success =
    arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null

  // CSRF Hash
  const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
  const csrfHash = $('[name=app_token_name]').val() // CSRF hash
  data.append(csrfName, csrfHash)

  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'JSON',
    processData: false,
    contentType: false,
    data: data,
    success: function success(result) {
      if (_success != null) _success(result)
    },
    error: function error(msg) {
      console.log(msg)
    },
  })
}

function formateDateFromDb(dateStr) {
  return moment(dateStr, 'YYYY-MM-DD').format(date_format)
}

function formateDateDb(dateStr) {
  return moment(dateStr, date_format).format('YYYY-MM-DD')
}

function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=')

    if (sParameterName[0] === sParam) {
      if (sParameterName[1] !== undefined) {
        if (sParameterName.length > 2) {
          content =
            decodeURIComponent(sParameterName[1]) +
            '=' +
            decodeURIComponent(sParameterName[2])
        } else {
          content = decodeURIComponent(sParameterName[1])
        }
      }

      return content
    }
  }
}

function toggleShow(show, hide, focus) {
  $(show).removeClass('d-none')
  $(hide).addClass('d-none')

  if (focus !== undefined) {
    $(focus).focus()
  }
}

function isNumber(evt) {
  evt = evt ? evt : window.event
  var charCode = evt.which ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false
  }
  return true
}

function initThousand() {
  $('.thousand').mask('#,##0', { reverse: true })
}

function thousandMark(usage) {
  $(usage).val(
    $(usage)
      .val()
      .replace(/,/g, '')
      .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,')
  )
}

function thousandFormat(value) {
  return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,')
}

function thousandUnFormat(value) {
  return value.replace(/,/g, '')
}

function strToUpperCase(str) {
  str = str.toLowerCase().replace(/\b[a-z]/g, function (letter) {
    return letter.toUpperCase()
  })
  return str
}

function getFormData($form) {
  const unindexed_array = $form.serializeArray()
  const indexed_array = {}

  $.map(unindexed_array, function (n, _) {
    indexed_array[n['name']] = n['value'].trim()
  })

  return indexed_array
}

function getFormDataFile($form) {
  const data = new FormData()
  const unindexed_array = $form.serializeArray()

  $.map(unindexed_array, function (n, _) {
    data.append(n['name'], n['value'].trim())
  })

  return data
}

function getOptionData(usage, uri, showPlaceholder = true, id) {
  $(usage).empty()
  f_ajax(base_uri + uri, {}, function (response) {
    let options = '<option></option>'
    $.each(response, function (i, v) {
      let selected = ''

      if (v.id == id) {
        selected = 'selected'
      }

      options +=
        '<option value="' + v.id + '" ' + selected + '>' + v.nama + '</option>'
      if (!showPlaceholder && i === 0)
        options =
          '<option value="' + v.id + '" selected>' + v.nama + '</option>'
    })
    if (uri === '/jenisBank/getJenisBanks') {
      options += '<option value="0">Bank Lain</option>'
    }
    $(usage).html(options)
  })
}

function initDateTime(usage) {
  $(usage).datetimepicker('destroy')
  $(usage).datetimepicker({
    format: date_format,
    useCurrent: false,
    autoclose: true,
  })
}

function initValidateForm(usage, rules, messages, callback) {
  $(usage).validate({
    rules: rules,
    messages: messages,
    errorElement: 'span',
    ignore: ':hidden:not(.summernote),.note-editable.card-block',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback')
      if (
        element.hasClass('select2bs5') ||
        element.hasClass('select2bs5-nonclear')
      ) {
        element.parents('.form-group').append(error)
      } else if (element.hasClass('summernote')) {
        $(error).insertAfter(element.siblings('.note-editor'))
      } else if (element.parent('.input-group').length === 0) {
        $(error).insertAfter(element)
      } else {
        element.closest('.input-group').append(error)
      }
    },
    highlight: function (element) {
      $(element).addClass('is-invalid')
    },
    unhighlight: function (element) {
      $(element).removeClass('is-invalid')
    },
    submitHandler: function (_, event) {
      event.preventDefault()
      if (callback !== undefined) {
        callback()
      }
    },
  })
}

function inFormAlert(usage, type, message) {
  $(usage).hide()
  $(usage).empty()
  $(usage).append(
    $(
      "<div class='alert alert-" +
        type +
        " alert-dismissable alert-message' role='alert' style='margin-bottom:0;'><span> " +
        message +
        " </span> <button type='button' class='close' data-dismiss='alert' aria-label='Close'> \
    <span aria-hidden='true'>&times;</span> \
  </button></div>"
    )
  )
  $(usage).fadeIn('slow')
  $('.alert-message')
    .delay(5000)
    .fadeOut('slow', function () {
      $(this).remove()
      $(usage).hide()
    })
}

function generateRandomIntegerInRange(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min
}

function refreshTable(table, data) {
  table.clear().draw()
  table.rows.add(data).draw()
}

function generateCode() {
  let text = ''
  const possible =
    'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'

  for (let i = 0; i < 5; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length))

  return text
}

function getKelurahanDesa(usage) {
  $(usage).select2({
    theme: 'bootstrap-5',
    ajax: {
      url: base_uri + '/kelurahan/getKelurahan',
      type: 'POST',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
        const csrfHash = $('[name=app_token_name]').val() // CSRF hash

        return {
          [csrfName]: csrfHash,
          search_data: params.term,
        }
      },
      processResults: function (data, params) {
        $(usage).html('<option></option>')
        for (const item in data) {
          const x = data[item]
          $(usage).append(
            '<option value="' +
              x.id +
              '" data-pos="' +
              x.kode_pos +
              '">' +
              x.kecamatan +
              '</option'
          )
        }
        return {
          results: $.map(data, function (obj) {
            return { id: obj.id, text: obj.kecamatan }
          }),
        }
      },
      cache: true,
    },
    minimumInputLength: 3,
    placeholder: 'Cari Kota/kecamatan',
    language: {
      inputTooShort: function (args) {
        var remainingChars = args.minimum - args.input.length

        var message = 'Masukan ' + remainingChars + ' atau lebih karakter'

        return message
      },
      noResults: function () {
        return 'Data tidak ditemukan'
      },
      searching: function () {
        return 'Mencari...'
      },
    },
  })

  $(document).on('select2:open', usage, function () {
    // $(this).parents('.form-group').find
    document.querySelector('.select2-search__field').focus()
  })
}
