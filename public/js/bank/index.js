let tableList
$(function () {
  getOptionData('#jenis-bank', '/jenisBank/getJenisBank')
  tableList = $('#table-list').DataTable({
    responsive: true,
    deferRender: true,
    processing: true,
    serverSide: true,
    columnDefs: [
      {
        targets: 0,
        orderable: false,
      },
    ],
    columns: [
      {
        data: 'no',
      },
      {
        data: 'jenis_bank',
        render: function (data) {
          if (data === null) data = 'Bank Lain'

          return data
        },
      },
      {
        data: 'rekening',
      },
      {
        data: 'cabang',
      },
      {
        data: 'atas_nama',
      },
      {
        data: null,
        render: function (data, type, full, meta) {
          const btnEdit =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="fa fa-edit"></i></button>'
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger mt-1 mt-lg-0 btn-sm btn-delete" data-bs-toggle="tooltip" data-bs-title="Hapus"><i class="fa fa-trash"></i></button>'

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
    ajax: {
      url: `${base_uri}/bank/getDataTable`,
      type: 'POST',
      data: function (e) {
        // CSRF Hash
        const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
        const csrfHash = $('[name=app_token_name]').val() // CSRF hash
        e[csrfName] = csrfHash
      },
    },
    drawCallback: function (settings) {
      $('select[name=table-list_length]').removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('click', '#btn-new', function (e) {
    e.preventDefault()
    $('.tooltip').tooltip('hide')
    $('#title-form').html('Tambah')
    $('#id').val(0)
    toggleShow('#card-form', '#card-table')
    $('#cabang').focus()
  })

  $(document).on('click', '.btn-edit', function (e) {
    e.preventDefault()
    const data = tableList.row($(this).parents('tr')).data()
    $('#id').val(data.id)
    $('#jenis-bank').val(data.jenis_bank_id).trigger('change')
    $('#cabang').val(data.cabang)
    $('#rekening').val(data.rekening)
    $('#atas_nama').val(data.atas_nama)

    $('.tooltip').tooltip('hide')
    $('#title-form').html('Ubah')

    toggleShow('#card-form', '#card-table', '#nama')
  })

  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault()
    const row = tableList.row($(this).parents('tr')).data()
    $('.tooltip').tooltip('hide')

    confirmation(function () {
      const data = {
        id: row.id,
      }
      f_ajax(base_uri + '/bank/removeData', data, function (response) {
        notification('success', 'Information', response.message)
        tableList.ajax.reload()
      })
    })
  })
})
