let tableAdminFormList
$(function () {
  tableAdminFormList = $('#table-admin-form-list').DataTable({
    responsive: true,
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
        data: 'role',
      },
      {
        data: null,
        render: function (data, type, full, meta) {
          const btnAdd =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-add-admin" data-bs-toggle="tooltip" data-bs-title="Tambah Admin"><i class="fa fa-plus"></i></button>'

          const btn = '<center>' + btnAdd + '</center>'

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
      $('select[name=table-admin-form-list_length]').removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('click', '.btn-add-admin', function (e) {
    e.preventDefault()
    const row = tableAdminFormList.row($(this).parents('tr'))
    const data = row.data()
    row.remove().draw()

    tableAdminList.row.add(data).draw()
  })

  $(document).on('hidden.bs.modal', '#modal-admin', function () {
    $('#admin-title').empty()
    tableAdminFormList.column(3).visible(true)
    tableAdminFormList.clear().draw()
  })
})
