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
        render: function (data) {
          return 'Rp.' + thousandFormat(data)
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
      $('select[name=table-admin-form-list_length]').removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })
})

function refreshTableOrder() {
  const varians = tableOrderList.rows().data().toArray()
  const totalVarian = varians.length

  if (totalVarian === 0) return false

  for (let i = 0; i < totalVarian; i++) {
    const varian = varians[i]
    const harga = getHarga(varian)
    const subtotal = harga * parseInt(varian.qty)

    varian.harga = harga
    varian.subtotal = subtotal
    varians[i] = varian
  }

  refreshTable(tableOrderList, varians)
  const grandSubtotal = countSubtotal(varians)
  $('#sub-total').html(`${thousandFormat(grandSubtotal)}`)
}
