let tableLayananList
$(function () {
  tableLayananList = $('#table-layanan-list').DataTable({
    responsive: true,
    searching: false,
    info: false,
    paging: false,
    columnDefs: [
      {
        targets: 0,
        orderable: false,
      },
    ],
    columns: [
      {
        data: null,
        render: function (_, _, _, meta) {
          return meta.row + 1
        },
      },
      {
        data: 'nama',
      },
      {
        data: null,
        render: function (data, type, full, meta) {
          const btnEdit =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-edit-layanan" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="fa fa-edit"></i></button>'
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger mt-1 mt-lg-1 mt-xl-0 mt-xl-0 btn-sm btn-delete-layanan" data-bs-toggle="tooltip" data-bs-title="Hapus"><i class="fa fa-trash"></i></button>'

          const btn = '<center>' + btnEdit + ' ' + btnDelete + '</center>'

          return btn
        },
      },
    ],
    language: {
      oPaginate: {
        sNext: '<i class="fa fa-angle-right"></i>',
        sPrevious: '<i class="fa fa-angle-left"></i>',
      },
      sEmptyTable: 'Data tidak tersedia',
    },
    drawCallback: function (settings) {
      $('select[name=table-list_length]').removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('hidden.bs.modal', '#modal-layanan', function () {
    resetLayananForm()
    $('#layanan-title').empty()
    $('#nama').focus()
  })

  $(document).on('click', '#btn-new-layanan', function (e) {
    e.preventDefault()
    $('#layanan-id').val(0)
    $('#layanan-title').html('Tambah')
    $('#modal-layanan').modal('show')
    $('#layanan-nama').focus()
  })

  $(document).on('click', '.btn-edit-layanan', function (e) {
    e.preventDefault()
    const row = tableLayananList.row($(this).parents('tr'))
    const data = row.data()
    const index = row.index()

    $('#layanan-index').val(index)
    $('#layanan-id').val(data.id)
    $('#layanan-nama').val(data.nama)

    $('#layanan-title').html('Ubah')
    $('#modal-layanan').modal('show')
    $('#layanan-nama').focus()
  })

  $(document).on('click', '.btn-delete-layanan', function (e) {
    e.preventDefault()
    const row = tableLayananList.row($(this).parents('tr'))
    const index = row.index()
    const layanans = tableLayananList.rows().data().toArray()
    confirmation(function () {
      layanans.splice(index, 1)
      notification('success', 'Information', 'Data berhasil di hapus')
      refreshTable(tableLayananList, layanans)
    })
  })

  const rules = {
    nama: {
      required: true,
    },
  }

  const messages = {
    nama: {
      required: 'Nama Layanan harus di isi',
    },
  }

  initValidateForm('#form-layanan', rules, messages, function () {
    if (Swal.getContainer()) {
      Swal.close()
      return false
    }
    const data = getFormData($('#form-layanan'))
    const index = $('#layanan-index').val()
    const title = $('#layanan-title').html()
    const layanans = tableLayananList.rows().data().toArray()
    let message = 'Data berhasil di simpan'

    const checkNama = layanans.filter(function (e) {
      return e.nama === data.nama
    })

    const checkIndex = layanans.findIndex(function (e) {
      return e.nama === data.nama
    })

    if (checkNama.length > 0 && index !== checkIndex.toString()) {
      newalert(
        'info',
        'Nama layanan telah terpakai',
        'Informasi',
        function (result) {
          if (result.isDismissed) $('#layanan-nama').focus()
        }
      )
      return false
    }

    if (parseInt(data.id) === 0 && index === '') {
      layanans.push(data)
    } else {
      layanans[index] = data
      message = 'Data berhasil di ubah'
    }

    if (title === 'Tambah') {
      $('#layanan-nama').focus()
      resetLayananForm()
    } else if (title === 'Ubah') {
      $('#modal-layanan').modal('hide')
    }

    notification('success', 'Information', message)
    refreshTable(tableLayananList, layanans)
  })

  function resetLayananForm() {
    $('#form-layanan')[0].reset()
    $('#layanan-id').val(0)
    $('#layanan-index').val('')
  }
})
