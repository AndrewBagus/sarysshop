let tableList
$(function () {
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
        data: 'nama',
      },
      {
        data: 'kategori_pelanggan',
      },
      {
        data: 'telp',
      },
      {
        data: 'alamat',
        render: function (data, _, full) {
          let content =
            '<p style="word-wrap: break-word; white-space: pre-wrap; margin-bottom: 0;">' +
            data +
            '</p>'
          content +=
            '<p style="word-wrap: break-word; white-space: pre-wrap; margin-bottom: 0;">' +
            full.kecamatan +
            '</p>'

          return content
        },
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
      url: `${base_uri}/pelanggan/getDataTable`,
      type: 'POST',
      data: function (e) {
        // CSRF Hash
        const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
        const csrfHash = $('[name=app_token_name]').val() // CSRF hash
        const kategori_pelanggan_id = $('#kategori-pelanggan-filter').val()

        e[csrfName] = csrfHash
        e.kategori_pelanggan_id =
          kategori_pelanggan_id === null ? '' : kategori_pelanggan_id.trim()
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
    toggleShow('#card-form', '#card-table', '#nama')
  })

  $(document).on('click', '.btn-edit', function (e) {
    e.preventDefault()
    const data = tableList.row($(this).parents('tr')).data()
    f_ajax(
      base_uri + '/kelurahan/getKelurahanById',
      {
        kelurahan_id: data.kelurahan_id,
      },
      function (response) {
        $('#id').val(data.id)
        $('#kategori-pelanggan')
          .val(data.kategori_pelanggan_id)
          .trigger('change')
        $('#nama').val(data.nama)
        $('#telp').val(data.telp)
        $('#email').val(data.email)
        $('#alamat').val(data.alamat)
        $('#kode-pos').val(data.kode_pos)

        $('#kelurahan').html(
          '<option value="' +
            response.id +
            '" data-pos="' +
            data.kode_pos +
            '" selected>' +
            data.kecamatan +
            '</option>'
        )

        $('.tooltip').tooltip('hide')
        $('#title-form').html('Ubah')

        toggleShow('#card-form', '#card-table', '#nama')
      }
    )
  })

  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault()
    const row = tableList.row($(this).parents('tr')).data()

    confirmation(function () {
      const data = {
        id: row.id,
      }
      f_ajax(base_uri + '/pelanggan/removeData', data, function (response) {
        notification('success', 'Information', response.message)
        tableList.ajax.reload(null, false)
      })
    })
  })
})
