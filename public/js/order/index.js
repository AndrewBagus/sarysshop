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
        data: 'status_pembayaran',
        render: function (data, _, full) {
          const btnEdit =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="fa fa-edit"></i></button>'
          const btnBayar =
            '<button type="button" class="btn btn-outline-info mt-1 mt-lg-0 btn-sm btn-bayar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Bayar"><i class="fa fa-money"></i></button>'
          const btnKirim =
            '<button type="button" class="btn btn-outline-info mt-1 mt-lg-0 btn-sm btn-kirim" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kirim"><i class="ti-truck"></i></button>'
          const btnTerima =
            '<button type="button" class="btn btn-outline-info mt-1 mt-lg-0 btn-sm btn-terima" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Terima"><i class="ti-dropbox"></i></button>'
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger mt-1 mt-lg-0 btn-sm btn-cancel" data-bs-toggle="tooltip" data-bs-title="Cancel"><i class="fa fa-times"></i></button>'

          let btn = `${btnEdit} ${btnBayar} ${btnDelete}`

          if (data === 'lunas' && full.tanggal_dikirim === null)
            btn = `${btnEdit} ${btnKirim} ${btnDelete}`
          else if (
            data === 'lunas' &&
            full.tanggal_dikirim !== null &&
            full.tanggal_diterima === null
          )
            btn = `${btnEdit} ${btnTerima} ${btnDelete}`
          else if (
            data === 'lunas' &&
            full.tanggal_dikirim !== null &&
            full.tanggal_diterima !== null
          )
            btn = `${btnEdit} ${btnDelete}`

          return `<center>${btn}</center>`
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
    drawCallback: function (_) {
      $(this)
        .parents('.dataTables_wrapper ')
        .find('.form-select')
        .removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
      tableList.columns.adjust()
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
        $('#view-berat-total').html(`(${berat})Kg`)

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

  $(document).on('click', '.btn-edit', function (e) {
    e.preventDefault()
    const data = tableList.row($(this).parents('tr')).data()

    f_ajax(
      `${base_uri}/order/getOrderDetail`,
      { order_id: data.id },
      function (response) {
        $('#id').val(data.id)
        $('#tgl-order').val(formateDateFromDb(data.tanggal_order))
        const produks = response.produks
        const pembayarans = response.pembayarans.map(function (item) {
          item.name = `<div>${item.jenis_bank} - ${item.atas_nama}</div>
                <div><b>${item.rekening}</b></div>`
          return item
        })

        const pelanggan = response.pelanggan
        const pelangganAlamat = createAlamat(pelanggan)

        const pelangganOpt = new Option(
          pelanggan.nama,
          pelanggan.id,
          true,
          true
        )
        $('#pemesan').append(pelangganOpt)
        $('#pemesan').trigger({
          type: 'select2:select',
          params: {
            data: pelanggan,
          },
        })
        $('#pemesan-alamat').html(pelangganAlamat)

        const kirim = response.kirim
        const kirimAlamat = createAlamat(kirim)
        const kirimOpt = new Option(kirim.nama, kirim.id, true, true)
        $('#penerima').append(kirimOpt)
        $('#penerima').trigger({
          type: 'select2:select',
          params: {
            data: kirim,
          },
        })
        $('#penerima-alamat').html(kirimAlamat)

        const berat = produks.reduce((accumulator, object) => {
          return accumulator + parseInt(object.berat)
        }, 0)

        kurir = {
          id: data.kurir_id,
          nama: data.kurir,
          biaya: parseInt(data.biaya_kurir),
          berat: berat,
        }
        $('#ongkir').html(thousandFormat(kurir.biaya))
        $('#kurir-nama').html(thousandFormat(kurir.nama))
        diskons = response.diskons
        additionals = response.biayas
        refreshTable(tableOrderList, produks)
        refreshTable(tablePembayaranList, pembayarans)
        refreshGrandTotal()
        toggleShow('#card-form', '#card-table')
      }
    )
  })

  $(document).on('click', '.btn-bayar', function (e) {
    e.preventDefault()
    const data = tableList.row($(this).parents('tr')).data()
    $('#pembayaran-wrapper').removeClass('d-none')
    $('#no-transaksi').html(data.code)

    f_ajax(
      `${base_uri}/order/getOrderPembayaran`,
      { order_id: data.id },
      function (response) {
        const pembayaran =
          response.length === 0
            ? 0
            : response.reduce((accumulator, object) => {
                return accumulator + parseInt(object.nominal)
              }, 0)
        const grandtotal = data.grandtotal
        const sisa = grandtotal - pembayaran

        $('#pembayaran-transaksi').val(data.id)
        $('#pembayaran-grandtotal').html(thousandFormat(grandtotal))
        $('#pembayaran-total').html(thousandFormat(pembayaran))
        $('#pembayaran-sisa').html(thousandFormat(sisa))

        $('#modal-pembayaran').modal('show')
      }
    )
  })
})

function createAlamat(repo) {
  return `<div class="col-xs-12 mt-2">
            <div class="d-flex align-items-center justify-content-between position-relative">
              <div class="d-flex align-items-center justify-content-between w-100">
                <div style="font-size: 16px">
                  <div style="font-size: 16px; font-weight: bolder">Alamat: </div>
                  <small class="d-block">${repo.alamat}</small>
                  <small class="d-block">Kec. ${repo.kecamatan}, ${repo.kode_pos}</small>
                </div>
              </div>
            </div>
         </div>`
}
