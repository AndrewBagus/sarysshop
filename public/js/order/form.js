let subtotal = 0
let grandTotal = 0
let kurir = {
  id: 0,
  nama: null,
  biaya: 0,
  berat: 0,
}
let diskons = []
let additionals = []

$(function () {
  $(document).on('click', '#btn-back', function () {
    resetForm()
    toggleShow('#card-table', '#card-form')
  })

  $(document).on('click', '#btn-stay', function (e) {
    e.preventDefault()
    $('#mode').val('stay')
    $('#form-data').submit()
  })

  $(document).on('click', '#btn-save', function (e) {
    e.preventDefault()
    $('#mode').val('back')
    $('#form-data').submit()
  })

  const rules = {
    pelanggan_id: {
      required: true,
    },
    pelanggan_kirim: {
      required: true,
    },
    tgl_order: {
      required: true,
    },
  }

  const messages = {
    pelanggan_id: {
      required: 'Nama Pelanggan harus di isi',
    },
    pelanggan_kirim: {
      required: 'Dikirim Kepada harus di isi',
    },
    tgl_order: {
      required: 'Tanggal Order harus di isi',
    },
    bank_id: {
      required: 'Bank harus di isi',
    },
    tanggal_pembayaran: {
      required: 'Tanggal Pembayaran harus di isi',
    },
    nominal: {
      required: 'Nominal harus di isi',
    },
  }

  $('#form-data').validate({
    rules: rules,
    messages: messages,
    errorElement: 'span',
    ignore: ':hidden:not(.summernote),.note-editable.card-block',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback')
      if (
        element.hasClass('select2bs5') ||
        element.hasClass('select2bs5-nonclear') ||
        element.hasClass('bank-pembayran')
      ) {
        element.parents('.form-group').append(error)
      } else if (element.hasClass('summernote')) {
        $(error).insertAfter(element.siblings('.note-editor'))
      } else if (element.parent('.input-group').length === 0) {
        $(error).insertAfter(element)
      } else {
        element.parents('.form-group').append(error)
      }

      $('#mode').val('')
      if (!checkForm()) {
        return false
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
      if (!checkForm()) {
        return false
      }

      if (grandTotal < 0) {
        newalert(
          'info',
          'Total Order kurang dari Rp.0, silahkan cek kembali',
          'informasi'
        )
        return false
      }

      const order = getFormData($('#form-data'))
      const produks = tableOrderList.rows().data().toArray()
      order['subtotal_pembelian'] = subtotal
      order['grandtotal'] = grandTotal
      order['tgl_order'] = formateDateDb(order['tgl_order'])
      order['tanggal_pembayaran'] =
        order['tanggal_pembayaran'] === ''
          ? ''
          : formateDateDb(order['tanggal_pembayaran'])
      order['nominal'] =
        order['nominal'] === '' ? '' : thousandUnFormat(order['nominal'])

      const data = {
        order: JSON.stringify(order),
        produks: JSON.stringify(produks),
        kurir: JSON.stringify(kurir),
        diskons: JSON.stringify(diskons),
        additionals: JSON.stringify(additionals),
      }

      f_ajax(`${base_uri}/order/saveOrder`, data, function (response) {
        const mode = $('#mode').val()
        if (mode === 'stay') {
          notification('success', 'Information', response.message)
          // tableList.ajax.reload(null, false)
          resetForm()
        } else {
          $('#btn-back').click
        }
      })
    },
  })

  function resetForm() {
    $('#form-data')[0].reset()
    $('#id').val(0)
    $('#mode').val('')
    $('#pemensan').val(null).trigger('change')
    $('#pemesan-alamat').empty()
    $('#penerima').val(null).trigger('change')
    $('#penerima-alamat').empty()
    $('#status-pembayran').val('belum-bayar').trigger('change')
    $('#bank').val(null).trigger('change')
    $('.additional-order-detail').empty()
    $('#sub-total-display').html(0)
    $('#grand-total-display').html(0)

    $('#sub-total').val(0)
    $('#grand-total').val(0)
  }

  function checkForm() {
    const produks = tableOrderList.rows().data().toArray()
    if (produks.length === 0) {
      newalert('info', 'Produk tidak boleh kosong', 'informasi')
      return false
    }
    if (kurir.id === 0) {
      newalert('info', 'Silahkan pilih kurir / jasa pengantaran', 'informasi')
      return false
    }
    return true
  }
})

function countSubTotalBerat(arrays) {
  subtotal = 0
  let berat = 0
  if (arrays.length > 0) {
    for (const item of arrays) {
      subtotal += parseInt(item.subtotal)
      berat += parseInt(item.subBerat)
    }
  }

  const grandBerat = berat > 0 ? berat / 1000 : ''
  $('#sub-total').val(subtotal)
  $('#sub-total-display').html(thousandFormat(subtotal))
  if (grandBerat !== '') {
    kurir.berat = berat
    $('#berat-total').html(`(${grandBerat}Kg)`)
  } else {
    kurir.berat = 0
    $('#berat-total').html('')
  }

  return subtotal
}

function refreshGrandDiskon(index, data) {
  if (index === '') {
    diskons.push(data)
  } else {
    const diskon = diskons[index]
    data.id = diskon.id
    diskons[index] = data
  }
  createDiskonAdditional('#diskon-wrapper', diskons, true)
}

function refreshGrandAdditional(index, data) {
  if (index === '') {
    additionals.push(data)
  } else {
    const additional = additionals[index]
    data.id = additional.id
    additionals[index] = data
  }
  createDiskonAdditional('#additional-wrapper', additionals, false)
}

function createDiskonAdditional(usage, arrays, is_red) {
  let contents = ''

  let i = 0
  for (const item of arrays) {
    const nama = item.nama !== '' ? ` - ${item.nama}` : ''
    const persen = item.tipe === 'percen' ? ` ${item.persen}%` : ''
    const title = is_red ? 'Diskon Order' : 'Biaya Lain'
    let content = `<tr><td colspan="3">${title}`
    if (persen !== '') content += persen
    if (nama !== '') content += nama

    const btnEdit = `<button type="button" class="btn btn-outline-primary btn-sm btn-order-edit" data-index="${i}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="fa fa-edit"></i></button>`

    const btnDelete = `<button type="button" class="btn btn-outline-danger btn-sm btn-order-delete" data-index="${i}" data-bs-toggle="tooltip" data-bs-title="Hapus"><i class="fa fa-trash"></i></button>`

    const btnWrapper = `<a href="javascript:void(0); class="dropdown-toggle ms-1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-more"></i></a>
                                  <ul class="dropdown-menu">
                                    <li>${btnEdit}</li>
                                    <li>${btnDelete}</li>
                                  </ul>`

    const nominal = thousandFormat(item.nominal)
    let nominalArea = is_red
      ? `<td class="dropdown" style="color:#ff5f5f">Rp. (${nominal}) ${btnWrapper}</td>)`
      : `<td class="dropdown">Rp. ${nominal} ${btnWrapper}</td>`

    content += `</td>${nominalArea}</tr>`

    contents += content
  }
  $(usage).html(contents)
}

function countDiskonAdditional(arrays, subtotal, tipe) {
  let total = 0
  let i = 0
  for (const item of arrays) {
    if (item.tipe === 'percen') {
      item.nominal = Math.round(
        (parseInt(subtotal) * parseInt(item.persen)) / 100
      )
      arrays[i].nominal = item.nominal
    }
    total += parseInt(item.nominal)
    i++
  }

  if (tipe === 'diskon') {
    createDiskonAdditional('#diskon-wrapper', arrays, true)
  } else if (tipe === 'biaya') {
    createDiskonAdditional('#additional-wrapper', arrays, false)
  }
  return total
}

function refreshGrandTotal() {
  const varians = tableOrderList.rows().data().toArray()
  const subTotal = countSubTotalBerat(varians)
  const grandDiskon = countDiskonAdditional(diskons, subTotal, 'diskon')
  const grandAdditional = countDiskonAdditional(additionals, subTotal, 'biaya')
  grandTotal = parseInt(subTotal)

  grandTotal += parseInt(kurir.biaya)
  grandTotal -= parseInt(grandDiskon)
  grandTotal += parseInt(grandAdditional)

  let grandDisplay = `Rp. ${thousandFormat(grandTotal)}`
  if (grandTotal < 0) {
    grandDisplay = `<span style="color: #ff5f5f">(${grandDisplay})</span>`
  }

  $('#grand-total').val(grandTotal)
  $('#grand-total-display').html(grandDisplay)
}
