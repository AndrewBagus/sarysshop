let tableList
$(function () {
  getOptionData('#supplier', '/supplier/getSuppliers')
  getOptionData('#kategori-produk', '/kategoriProduk/getKategoriProduks')
  getOptionData('#gudang', '/gudang/getGudangs', false)
  getOptionData('#jenis-produk', '/jenisProduk/getJenisProduks', false)

  tableList = $('#table-list').DataTable({
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
        data: 'nama',
        render: function (data, _, full) {
          const img = `<img class="mt-1" src="${base_uri}/assets/images/product-default.png" style="width: 32px; height: 32px;">`
          const name = `<p class="mb-1">${data}</p>`
          const price = `<p>Rp. ${thousandFormat(
            full.min_harga
          )} - Rp. ${thousandFormat(full.max_harga)}</p>`
          const content = `<div style="display: flex; justify-content: space-around; align-items: flex-start;">
              ${img}
              <div>
              ${name}
              ${price}
              </div>
            </div>`
          return content
        },
      },
      {
        data: 'supplier',
        render: function (data, _, full) {
          const name = `<p class="mb-1">${data}</p>`
          const address = `<p>${full.supplier_alamat}</p>`
          const content = name + address
          return content
        },
      },
      {
        data: 'stok',
      },
      {
        data: 'varian',
        render: function (data) {
          return `<button type="button" class="btn btn-outline-primary btn-sm">${data} Varian</div>`
        },
      },
      {
        data: 'kategori_produk',
      },
      {
        data: 'jenis_produk',
        render: function (data, _, full) {
          let btn = 'success'
          if (full.jenis_produk_id > 1) btn = 'primary'
          return `<div class="alert alert-${btn}">${data}</div>`
        },
      },
      {
        data: 'tempo_kedatangan',
      },
      {
        data: null,
        render: function (_) {
          const btnEdit =
            '<button type="button" class="btn btn-outline-primary btn-sm btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ubah"><i class="fa fa-edit"></i></button>'
          const btnDelete =
            '<button type="button" class="btn btn-outline-danger mt-1 mt-lg-0 btn-sm btn-delete" data-bs-toggle="tooltip" data-bs-title="Hapus"><i class="fa fa-trash"></i></button>'

          const btn = `<center> ${btnEdit} ${btnDelete} </center>`

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
      url: `${base_uri}/produk/getDataTable`,
      type: 'POST',
      data: function (e) {
        // CSRF Hash
        const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
        const csrfHash = $('[name=app_token_name]').val() // CSRF hash
        e[csrfName] = csrfHash
      },
    },
    drawCallback: function (_) {
      $('select[name=table-list_length]').removeClass('form-select')
      $('[data-bs-toggle="tooltip"]').tooltip()
    },
  })

  $(document).on('click', '#btn-new', function (e) {
    e.preventDefault()
    $('.tooltip').tooltip('hide')
    $('#title-form').html('Tambah')
    initVarianTable(
      `${base_uri}/kategoriPelanggan/getKategoriPelanggans`,
      {},
      function () {
        toggleShow('#card-form', '#card-table')
        tableVarian.columns.adjust()
        $('#nama').focus()
      }
    )
  })

  $(document).on('click', '.btn-edit', function (e) {
    e.preventDefault()
    const data = tableList.row($(this).parents('tr')).data()

    initVarianTable(
      `${base_uri}/produk/getProdukVarians`,
      { produk_id: data.id },
      function (response) {
        tableVarian.clear().draw()
        tableVarian.rows.add(response.varians).draw()
      }
    )

    for (const item in data) {
      const field = $(`[name=${item}]`)
      if (field.length > 0 && item !== 'image' && item !== 'stok')
        field.val(data[item]).trigger('change')
      else if (item === 'image' && data[item] !== null)
        $('#image-display').prop(
          'src',
          `${base_uri}/uploads/produk/${data[item]}`
        )
    }

    $('.tooltip').tooltip('hide')
    $('#title-form').html('Ubah')

    toggleShow('#card-form', '#card-table', '#nama')
    tableVarian.columns.adjust()
    $('#nama').focus()
  })

  $(document).on('click', '.btn-delete', function (e) {
    e.preventDefault()
    const row = tableList.row($(this).parents('tr')).data()
    $('.tooltip').tooltip('hide')

    confirmation(function () {
      const data = {
        id: row.id,
      }
      f_ajax(base_uri + '/produk/removeData', data, function (response) {
        notification('success', 'Information', response.message)
        tableList.ajax.reload()
      })
    })
  })
})
