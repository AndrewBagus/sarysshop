let tablePembayaranList
$(function () {
  getBank()

  $('#tgl-bayar').datetimepicker('destroy')
  $('#tgl-bayar').datetimepicker({
    minDate: moment(),
    format: date_format,
  })

  tablePembayaranList = $('#table-pembayaran-list').DataTable({
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
        data: 'name',
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
          return `<p style="word-break: break-word; white-space: pre-wrap;">${data}<p>`
        },
      },
      {
        data: 'nominal',
        render: function (data) {
          return `Rp. ${thousandFormat(data)}`
        },
      },
      {
        data: null,
        render: function (_) {
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger btn-sm btn-remove-pembayaran" data-bs-toggle="tooltip" data-bs-title="Hapus Pembayaran"><i class="fa fa-trash"></i></button>'
          const btnEdit =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-edit-pembayaran" data-bs-toggle="tooltip" data-bs-title="Edit Pembayaran"><i class="fa fa-edit"></i></button>'

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
    drawCallback: function (_) {
      const api = this.api()
      const data = api.rows().data()
      const total = data.reduce((accumulator, object) => {
        return accumulator + parseInt(object.nominal)
      }, 0)
      $('#total-pembayaran').html(thousandFormat(total))
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('click', '#btn-pembayaran-new', function (e) {
    e.preventDefault()
    const totalBayar = parseInt($('#total-pembayaran').html())
    const sisa = grandTotal - totalBayar
    if (sisa === 0) {
      newalert('info', 'Pembayaran telah lunas', 'informasi')
      return false
    }
    $('#tgl-bayar').val(moment().format(date_format))
    $('#modal-pembayaran').modal('show')
  })

  $(document).on('hide.bs.modal', '#modal-pembayaran', function () {
    $('#bank').val(null).trigger('change')
    $('#tgl-bayar').val('')
    $('#nominal').val('')
    $('#pembayaran-keterangan').val('')
    $('#pembayaran-id').val(0)
    $('#pembayaran-index').val('')
  })

  $(document).on('keyup', '#nominal', function () {
    let value = $(this).val()
    value = value === '0' ? '' : value

    if (value !== '') {
      value = parseInt(thousandUnFormat(value))
      const totalBayar = parseInt($('#total-pembayaran').html())
      const sisa = grandTotal - totalBayar
      if (value > sisa) $(this).val(thousandFormat(sisa))
    }
  })

  $(document).on('click', '.btn-edit-pembayaran', function (e) {
    e.preventDefault()
    const row = tablePembayaranList.row($(this).parents('tr'))
    const data = row.data()
    const index = row.index()

    $('#pembayaran-id').val(data.id)
    $('#pembayaran-index').val(index)
    $('#tgl-bayar').val(data.tanggal_pembayaran)
    $('#nominal').val(thousandFormat(data.nominal))
    $('#pembayaran-keterangan').val(data.keterangan)
    $('#bank').val(data.bank_id).trigger('change')

    $('#modal-pembayaran').modal('show')
  })

  $(document).on('click', '.btn-remove-pembayaran', function (e) {
    e.preventDefault()
    const row = tablePembayaranList.row($(this).parents('tr'))
    const index = row.index()
    const pembayarans = tablePembayaranList.rows().data().toArray()

    confirmation(function () {
      pembayarans.splice(index, 1)
      notification('success', 'Informasi', 'Data Pembayaran berhasil di hapus')

      refreshTable(tablePembayaranList, pembayarans)
    })
  })

  initValidateForm(
    '#form-pembayaran',
    {
      bank_id: {
        required: true,
      },
      tanggal_pembayaran: {
        required: true,
      },
      nominal: {
        required: true,
      },
    },
    {
      bank_id: {
        required: 'Bank harus di isi',
      },
      tanggal_pembayaran: {
        required: 'Tanggal Pembayaran harus di isi',
      },
      nominal: {
        required: 'Nominal harus di isi',
      },
    },
    function () {
      const data = getFormData($('#form-pembayaran'))
      const index = $('#pembayaran-index').val()
      const pembayarans = tablePembayaranList.rows().data().toArray()
      const bank = $('#bank option:selected').select2().text()

      const nominal = $('#nominal').val()
      const id = $('#pembayaran-id').val()
      const tgl = $('#tgl-bayar').val()

      let message = 'Data Qty berhasil di simpan'

      data.id = id
      data.tanggal_pembayaran = formateDateDb(tgl)
      data.name = bank
      data.nominal = thousandUnFormat(nominal)

      if (index == '') {
        pembayarans.push(data)
      } else {
        pembayarans[index] = data
        message = 'Data Qty berhasil di ubah'
      }

      notification('success', 'Informasi', message)

      refreshTable(tablePembayaranList, pembayarans)
      $('#modal-pembayaran').modal('hide')
    }
  )

  function getBank() {
    f_ajax(`${base_uri}/bank/getBanks`, {}, function (response) {
      const repo = response.map(function (item) {
        const name = item.jenis_bank === null ? item.cabang : item.jenis_bank
        return {
          id: item.id,
          text: `<div>${name} - ${item.atas_nama}</div>
                <div><b>${item.rekening}</b></div>`,
        }
      })

      $('#bank')
        .prepend('<option selected></option>')
        .select2({
          theme: 'bootstrap-5',
          allowClear: true,
          placeholder: 'Cari Bank',
          escapeMarkup: function (m) {
            return m
          },
          data: repo,
          templateResult: formatRepo,
          templateSelection: formatRepoSelection,
        })
    })
  }

  function formatRepo(repo) {
    return $(repo.text)
  }

  function formatRepoSelection(repo) {
    return repo.text
  }
})
