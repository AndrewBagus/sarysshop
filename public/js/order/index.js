let tableList
$(function () {
  tableList = $('.table-list').DataTable({
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
        data: 'code',
      },
      {
        data: 'pelanggan',
        render: function (data, _, full) {
          return `${data} <span class="label label-outline-primary" style="display: block; width:fit-content;">${full.jenis_pelanggan}</span>`
        },
      },
      {
        data: 'kepada',
        render: function (data, _, full) {
          return `${data} <span class="label label-outline-primary" style="display: block; width:fit-content;">${full.jenis_kepada}</span>`
        },
      },
      {
        data: 'produks',
        render: function (data) {
          return `<button class="btn btn-outline-info produks">${data} Produk</button>`
        },
      },
      {
        data: 'grandtotal',
        render: function (data) {
          return `Rp. ${thousandFormat(data)}`
        },
      },
      {
        data: 'tanggal_order',
        render: function (data) {
          return formateDateFromDb(data)
        },
      },
      {
        data: 'tanggal_dikirim',
        render: function (data) {
          return data === null ? '' : formateDateFromDb(data)
        },
      },
      {
        data: 'kurir',
      },
      {
        data: 'status_pembayaran',
        render: function (data) {
          let status = data
          let btnInfo = 'info'
          if (data === 'belum-bayar') {
            btnInfo = 'danger'
            status = 'belum bayar'
          }
          if (data === 'cicilan') btnInfo = 'secondary'
          return `<button class="btn btn-outline-${btnInfo} produks">${strToUpperCase(
            status
          )}</button>`
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
      url: `${base_uri}/order/getDataTable`,
      type: 'POST',
      data: function (e) {
        // CSRF Hash
        const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
        const csrfHash = $('[name=app_token_name]').val() // CSRF hash
        e[csrfName] = csrfHash
        e.status = $('#table-status').val()
      },
    },
    drawCallback: function (settings) {
      $('select[name=table-list_length]').removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('click', '#btn-new', function (e) {
    e.preventDefault()
    toggleShow('#card-form', '#card-table')
  })
})
