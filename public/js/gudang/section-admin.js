let tableAdminList
$(function () {
  tableAdminList = $('#table-admin-list').DataTable({
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
        data: 'nama',
      },
      {
        data: 'role',
      },
      {
        data: null,
        render: function (data, type, full, meta) {
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger btn-sm btn-delete-admin" data-bs-toggle="tooltip" data-bs-title="Hapus Admin"><i class="fa fa-trash"></i></button>'

          const btn = '<center>' + btnDelete + '</center>'

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
      $('select[name=table-admin-list_length]').removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('click', '#btn-new-admin', function (e) {
    e.preventDefault()
    const admins = tableAdminList.rows().data().toArray()
    f_ajax(
      base_uri + '/user/getUsers',
      {
        admins: JSON.stringify(admins),
      },
      function (response) {
        refreshTable(tableAdminFormList, response)
        $('#modal-admin').modal('show')
      }
    )
  })

  $(document).on('click', '.btn-delete-admin', function (e) {
    e.preventDefault()
    const data = tableAdminList.row($(this).parents('tr')).data()
    let admins = tableAdminList.rows().data().toArray()
    confirmation(function () {
      admins = admins.filter(function (item) {
        return item.id != data.id
      })

      refreshTable(tableAdminList, admins)
    })
  })
})
