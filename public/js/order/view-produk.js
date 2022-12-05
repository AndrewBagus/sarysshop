let tableViewOrderList
$(function () {
  tableViewOrderList = $('#table-view-produk-list').DataTable({
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
          return 'Rp.' + thousandFormat(data)
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

  $(document).on('hide.bs.modal', '#modal-view-produk', function () {
    tableViewOrderList.clear().draw()
    $('#view-kurir-nama').empty()
    $('#view-ongkir').empty()
    $('#view-grand-total-display').empty()
    $('#view-produk-title').empty()
  })
})
