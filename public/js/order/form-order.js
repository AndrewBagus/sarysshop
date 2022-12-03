let tableOrderList
$(function () {
  tableOrderList = $('#table-detail-order-list').DataTable({
    responsive: true,
    info: false,
    paging: false,
    searching: false,
    ordering: false,
    columnDefs: [
      {
        targets: 0,
        orderable: false,
      },
    ],
    columns: [
      {
        data: null,
        render: function (_, _, full) {
          let produk = ''
          if (full !== undefined) produk = createProduk(full, false)
          return produk
        },
      },
      {
        data: 'harga',
        render: function (data, _, full) {
          let diskon = ''
          if (full.diskon_tipe == 'nominal' && full.diskon_nominal > 0) {
            diskon = `<small style="display: block; color: #ff5f5f">disc. Rp${thousandFormat(
              full.diskon_nominal
            )}</small>`
          } else if (full.diskon_tipe == 'percen' && full.diskon_persen > 0) {
            diskon = `<small style="display: block; color: #ff5f5f">disc. ${thousandFormat(
              full.diskon_persen
            )}%</small>`
          }

          return 'Rp.' + thousandFormat(data) + diskon
        },
      },
      {
        data: 'qty',
        render: function (data) {
          return thousandFormat(data)
        },
      },
      {
        data: 'subtotal',
        className: 'dropdown',
        render: function (data) {
          const btnEdit =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-order-item-edit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="fa fa-edit"></i></button>'
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger btn-sm btn-order-item-delete" data-bs-toggle="tooltip" data-bs-title="Hapus"><i class="fa fa-trash"></i></button>'
          const btnDiskon =
            '<button type="button" class="btn btn-outline-success btn-sm btn-order-item-diskon" data-bs-toggle="tooltip" data-bs-title="Diskon"><i class="fa fa-plus"></i></button>'

          const btnWrapper = `<a href="javascript:void(0); class="dropdown-toggle ms-1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-more"></i></a>
                                  <ul class="dropdown-menu">
                                    <li>${btnDiskon}</li>
                                    <li>${btnEdit}</li>
                                    <li>${btnDelete}</li>
                                  </ul>`
          return 'Rp.' + thousandFormat(data) + ' ' + btnWrapper
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
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('click', '.btn-order-item-edit', function (e) {
    e.preventDefault()
    const row = tableOrderList.row($(this).parents('tr'))
    const data = row.data()
    const index = row.index()

    $('#edit-varian-index').val(index)
    $('#edit-varian-qty').val(data.qty)
    $('#edit-varian-nama').html(data.produk_nama)
    $('#modal-edit-varian').modal('show')
  })

  $(document).on('click', '.btn-order-item-diskon', function (e) {
    e.preventDefault()
    const row = tableOrderList.row($(this).parents('tr'))
    const data = row.data()
    const index = row.index()

    const hargaAwal = data.qty * data.harga
    const diskonNominal = parseInt(data.diskon_nominal)
    const hargaAkhir = hargaAwal - diskonNominal

    $('#diskon-varian-index').val(index)
    $('#diskon-varian').val(data.diskon_tipe).trigger('change')
    $('#diskon-varian-percen').val(data.diskon_persen)
    $('#diskon-varian-nominal').val(thousandFormat(data.diskon_nominal))

    $('#diskon-varian-nama').html(data.produk_nama)
    $('#diskon-varian-harga-awal').html(thousandFormat(hargaAwal))
    $('#diskon-varian-harga-akhir').html(thousandFormat(hargaAkhir))

    $('#modal-diskon-varian').modal('show')
  })

  $(document).on('click', '.btn-order-item-delete', function (e) {
    e.preventDefault()
    const varians = tableOrderList.rows().data().toArray()
    const row = tableOrderList.row($(this).parents('tr'))
    const index = row.index()

    confirmation(function () {
      varians.splice(index, 1)
      refreshTable(tableOrderList, varians)
      refreshGrandTotal()
    })
  })
})

function refreshTableOrder() {
  const varians = tableOrderList.rows().data().toArray()
  const totalVarian = varians.length

  if (totalVarian === 0) return false

  for (let i = 0; i < totalVarian; i++) {
    const varian = varians[i]
    const harga = getHarga(varian)
    const subtotal = harga * parseInt(varian.qty) - varian.diskon_nominal

    varian.harga = harga
    varian.subtotal = subtotal
    varians[i] = varian
  }

  refreshTable(tableOrderList, varians)
  refreshGrandTotal()
}
