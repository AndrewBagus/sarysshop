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

function thousandMark(usage) {
  $(usage).val(
    $(usage)
      .val()
      .replace(/,/g, '')
      .replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,')
  )
}

function thousandFormat(value) {
  return value.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,')
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

function getOptionData(usage, uri, id, filters, parent_id) {
  if (parent_id != undefined) {
    data['parent_id'] = parent_id
  }

  $(usage).empty()
  f_ajax(base_uri + uri, data, function (response) {
    if (filters !== undefined) {
      response = response.filter(function (e) {
        return filters.indexOf(e.id) === -1
      })
    }

    let options = '<option></option>'
    $.each(response, function (_, v) {
      let selected = ''
      let nama = ''

      if (v.id == id) {
        selected = 'selected'
      }

      if (v.nomor_pembelian !== undefined) {
        nama = v.nomor_pembelian
      } else if (v.nomor_penjualan !== undefined) {
        nama = v.nomor_penjualan
      } else {
        nama = v.nama
      }

      options +=
        '<option value="' + v.id + '" ' + selected + '>' + nama + '</option>'
    })
    $(usage).html(options)
  })
}
