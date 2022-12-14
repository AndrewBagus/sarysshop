let tableVarian
$(function () {
  $(document).on('click', '#btn-new-varian', function (e) {
    e.preventDefault()
    $('#varian-title').html('Tambah')
    $('#varian-id').val(0)
    $('#modal-varian').modal('show')
    $('#sku').focus()
  })

  $(document).on('hide.bs.modal', '#modal-varian', function () {
    clearVarianForm()
  })

  $(document).on('click', '#btn-random-sku', function (e) {
    e.preventDefault()
    const code = 'PV-' + generateCode()
    $('#sku').val(code)
  })

  $(document).on('click', '.btn-edit-varian', function (e) {
    e.preventDefault()
    const row = tableVarian.row($(this).parents('tr'))
    const index = row.index()
    const data = row.data()

    $('#varian-id').val(data.id)
    $('#varian-index').val(index)

    for (const item in data) {
      const field = $(`[name=${item}]`)
      if (field.length > 0 && item !== 'image' && item !== 'id')
        field.val(thousandFormat(data[item]))
      else if (item === 'image' && data[item] !== null)
        $('#image-varian-display').prop(
          'src',
          `${base_uri}/uploads/varian/${data[item]}`
        )
    }

    $('#varian-title').html('Ubah')
    $('#modal-varian').modal('show')
    $('#sku').focus()
  })

  $(document).on('click', '.btn-delete-varian', function (e) {
    e.preventDefault()
    const row = tableVarian.row($(this).parents('tr'))
    const index = row.index()
    const varians = tableVarian.rows().data().toArray()
    confirmation(function () {
      varians.splice(index, 1)
      refreshTable(tableVarian, varians)
    })
  })

  initValidateForm(
    '#form-varian',
    {
      code: {
        required: true,
      },
      berat: {
        required: true,
      },
    },
    {
      code: {
        required: 'SKU harus di isi',
      },
      berat: {
        required: 'Berat harus di isi',
      },
      stok: {
        required: 'Stok harus di isi',
      },
    },
    function () {
      const tableData = tableVarian.rows().data().toArray()
      const index = $('#varian-index').val()
      const data = getFormData($('#form-varian'))
      const file = $('#image-varian').prop('files')[0]
      data.image = $('#image-varian-display').prop('src')
      data.file = file
      if (file === undefined && index === '') {
        data.image = ''
      }

      if (index === '') {
        tableData.push(data)
      } else {
        data.image = tableData[index].image
        tableData[index] = data
      }

      if ($('#varian-index').val() !== '') {
        $('#modal-varian').modal('hide')
      }

      clearVarianForm()
      refreshTable(tableVarian, tableData)
      notification('success', 'Information', 'Data berhasil disimpan')
    }
  )

  function clearVarianForm() {
    $('#form-varian')[0].reset()
    $('#varian-id').val(0)
    $('#varian-index').val('')
    $('#image-varian-display').prop(
      'src',
      base_uri + '/assets/images/add-image.png'
    )
  }
})

function destroyVarianTable() {
  if ($.fn.DataTable.isDataTable('#table-varian-list')) {
    tableVarian.clear().draw()
    tableVarian.destroy()
    $('#table-varian-list thead').empty()
    $('.form-varian-wrapper').empty()
  }
}

function createVarianForm(title, idForm, nameForm) {
  return `<div class="form-group mt-2">
            <label class="form-label" for="${idForm}">${title}</label>
            <div class="input-group">
              <span class="input-group-text">Rp.</span>
              <input type="text" class="form-control thousand" id="${idForm}" name="${nameForm}" placeholder="0" onkeypress="return isNumber(event)">
            </div>
          </div>`
}

function initVarianTable(uri, parameters, callback) {
  f_ajax(uri, parameters, function (response) {
    const kategoris = response.kategoris
    let columns = [
      {
        data: null,
        render: function (_, _, _, meta) {
          return meta.row + 1
        },
      },
      {
        data: 'image',
        render: function (data) {
          if (data === '' || data === null) {
            data = base_uri + '/assets/images/add-image.png'
          } else if (data.indexOf('blob') === -1) {
            data = base_uri + '/uploads/varian/' + data
          }
          return `<img src="${data}" class="image-uploader image-thumbnail" accept="image/png, image/jpg, image/jpeg">`
        },
      },
      {
        data: 'code',
      },
      {
        data: 'berat',
      },
      {
        data: 'harga_beli',
        render: function (data) {
          let content = ''
          if (data !== '') content = 'Rp. ' + thousandFormat(data)

          return content
        },
      },
    ]
    const colspan = kategoris.length + 1
    let headers = `<tr>
                        <th rowspan="2" style="vertical-align: middle;"> No </th>
                        <th rowspan="2" style="vertical-align: middle;"> Gambar </th>
                        <th colspan="2" style="text-align: center;"> Spesifikasi </th>
                        <th colspan="${colspan}" style="text-align: center;"> Harga </th>
                        <th colspan="3" style="text-align: center;"> Informasi Produk </th>
                        <th rowspan="2" style="vertical-align: middle;" data-priority="1"> Aksi </th>
                      </tr>`

    headers += '<tr>'
    headers += '<th style="vertical-align: middle;">SKU</th>'
    headers += '<th style="vertical-align: middle;">Berat (gram)</th>'
    headers += '<th style="vertical-align: middle;">Harga Beli</th>'

    const contentFormHargaBeli = createVarianForm(
      'Harga Beli',
      'harga-beli',
      'harga_beli'
    )
    $('#form-varian-left').append(contentFormHargaBeli)
    $('#harga-beli').rules('add', {
      required: true,
      messages: {
        required: 'Harga Beli harus di isi',
      },
    })

    for (let i = 0; i < kategoris.length; i++) {
      const item = kategoris[i]
      const title = `Harga ${item.nama}`
      const arrayName = item.nama.split(' ')
      let idForm = item.nama.toLowerCase()

      if (arrayName.length > 0) {
        nameForm = arrayName.join('_').toLowerCase()
        idForm = arrayName.join('-').toLowerCase()
      }

      headers += `<th>${title}</th>`
      columns.push({
        data: item.id,
        render: function (data) {
          let content = ''
          if (data !== '') content = 'Rp. ' + thousandFormat(data)

          return content
        },
      })

      const contentForm = createVarianForm(title, idForm, item.id)
      if (i % 2 === 0) {
        $('#form-varian-left').append(contentForm)
      } else {
        $('#form-varian-right').append(contentForm)
      }

      $('#' + idForm).rules('add', {
        required: true,
        messages: {
          required: title + ' harus di isi',
        },
      })
    }

    headers += '<th style="vertical-align: middle;">Ukuran</th>'
    headers += '<th style="vertical-align: middle;">Warna</th>'
    headers += '<th style="vertical-align: middle;">Stok</th>'
    headers += '</tr>'
    $('#table-varian-list thead').html(headers)
    initThousand()

    columns.push(
      {
        data: 'ukuran',
      },
      {
        data: 'warna',
      },
      {
        data: 'stok',
      },
      {
        data: null,
        render: function () {
          const btnEdit =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-edit-varian" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="fa fa-edit"></i></button>'
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger mt-1 mt-lg-0 btn-sm btn-delete-varian" data-bs-toggle="tooltip" data-bs-title="Hapus"><i class="fa fa-trash"></i></button>'

          const btn = `<center> ${btnEdit} ${btnDelete} </center>`

          return btn
        },
      }
    )

    tableVarian = $('#table-varian-list').DataTable({
      scrollX: true,
      columns: columns,
      language: {
        oPaginate: {
          sNext: '<i class="fa fa-angle-right"></i>',
          sPrevious: '<i class="fa fa-angle-left"></i>',
        },
        sEmptyTable: 'Data tidak tersedia',
      },
      drawCallback: function (_) {
        $('select[name=table-varian-list_length]').removeClass('form-select')
        $('[data-bs-toggle="tooltip"]').tooltip()
      },
    })
    if (callback !== undefined) callback(response)
  })
}
