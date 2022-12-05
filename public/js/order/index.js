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
          return `<button class="btn btn-outline-info btn-produks">${data} Produk</button>`
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
          } else if (data === 'cicilan') btnInfo = 'secondary'
          return `<button class="btn btn-outline-${btnInfo} btn-pembayarans">${strToUpperCase(
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

  $(document).on('click', '.btn-produks', function (e) {
    e.preventDefault()
    const data = tableList.row($(this).parents('tr')).data()
    f_ajax(
      `${base_uri}/order/getOrderProduk`,
      { order_id: data.id },
      function (response) {
        const produks = response.produks
        const diskons = response.diskons
        const biayas = response.biayas
        const subtotal = produks.reduce((accumulator, object) => {
          return accumulator + parseInt(object.subtotal)
        }, 0)
        const berat =
          produks.reduce((accumulator, object) => {
            return accumulator + parseInt(object.berat)
          }, 0) / 1000
        $('#view-sub-total-display').html(thousandFormat(subtotal))
        $('#view-berat-total').html(`${berat}Kg`)

        const biayaKurir = parseInt(data.biaya_kurir)
        const grandTotal = parseInt(data.grandtotal)
        $('#view-kurir-nama').html(data.kurir)
        $('#view-ongkir').html(thousandFormat(biayaKurir))
        $('#view-grand-total-display').html(`Rp. ${thousandFormat(grandTotal)}`)

        $('#view-produk-title').html(
          `<b>${data.code}</b> - Tanggal Order: <b>${moment(
            data.tanggal_order
          ).format(date_format)}</b>`
        )

        createDiskonAdditional('#view-diskon-wrapper', diskons, true, false)
        createDiskonAdditional('#view-additional-wrapper', biayas, false, false)

        refreshTable(tableViewOrderList, produks)
        $('#modal-view-produk').modal('show')
      }
    )
  })

  $(document).on('click', '.btn-pembayarans', function (e) {
    e.preventDefault()
    const data = tableList.row($(this).parents('tr')).data()

    f_ajax(
      `${base_uri}/order/getOrderPembayaran`,
      { order_id: data.id },
      function (response) {
        $('#view-pembayaran-title').html(
          `<b>${data.code}</b> - Tanggal Order: <b>${moment(
            data.tanggal_order
          ).format(date_format)}</b> - GrandTotal: <b>Rp.${thousandFormat(
            data.grandtotal
          )}</b>`
        )
        refreshTable(tableViewPembayaranList, response)
        $('#modal-view-pembayaran').modal('show')
      }
    )
  })
})
