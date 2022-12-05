let tableViewPembayaranList
$(function () {
  tableViewPembayaranList = $('#table-view-pembayaran-list').DataTable({
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
        data: null,
        render: function (_, _, full) {
          return `<div>${full.jenis_bank} - ${full.atas_nama}</div>
                <div><b>${full.rekening}</b></div>`
        },
      },
      {
        data: 'tanggal_pembayaran',
        render: function (data) {
          return formateDateFromDb(data)
        },
      },
      {
        data: 'keterangan',
        render: function (data) {
          return data === null
            ? ''
            : `<p style="word-break: break-word; white-space: pre-wrap;">${data}<p>`
        },
      },
      {
        data: 'nominal',
        render: function (data) {
          return `Rp. ${thousandFormat(data)}`
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
    drawCallback: function (_) {
      const api = this.api()
      const data = api.rows().data()
      const total = data.reduce((accumulator, object) => {
        return accumulator + parseInt(object.nominal)
      }, 0)
      $('#view-total-pembayaran').html(thousandFormat(total))
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })
})
