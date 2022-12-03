let produks = []
$(function () {
  let produkQuery
  $('#produk')
    .select2({
      theme: 'bootstrap-5',
      ajax: {
        url: base_uri + '/produk/findProduks',
        type: 'POST',
        dataType: 'json',
        delay: 250,
        data: function (params) {
          const csrfName = $('[name=app_token_name]').attr('name') // CSRF Token name
          const csrfHash = $('[name=app_token_name]').val() // CSRF hash

          return {
            [csrfName]: csrfHash,
            search: params.term,
          }
        },
        cache: true,
        processResults: function (data) {
          data = $.map(data, function (obj) {
            obj.disabled = true // replace pk with your identifier

            return obj
          })

          produks = data
          return {
            results: data,
          }
        },
      },
      minimumInputLength: 3,
      placeholder: 'Cari Produk',
      escapeMarkup: function (markup) {
        return markup
      },
      closeOnSelect: false,
      templateResult: formatRepo,
      templateSelection: formatRepoSelection,
      language: {
        inputTooShort: function (args) {
          var remainingChars = args.minimum - args.input.length

          var message = 'Masukan ' + remainingChars + ' atau lebih karakter'

          return message
        },
        noResults: function () {
          return 'Data tidak ditemukan'
        },
        searching: function () {
          return 'Mencari...'
        },
      },
    })
    .on('select2:closing', function (e) {
      const search = $('input.select2-search__field').val()
      produkQuery = search
      if (search === '') {
        $('#select2-produk-container').html(
          `<span class="select2-selection__placeholder">Cari Produk</span>`
        )
      } else {
        $('#select2-produk-container').html(`<span>${produkQuery}</span>`)
      }
    })
    .on('select2:open', function (e) {
      $('input.select2-search__field').focus().val(produkQuery).trigger('input')
    })

  $(document).on('select2:open', '#produk', function () {
    document
      .querySelector('.select2-search input.select2-search__field')
      .focus()
  })

  $(document).on('keyup', '.produk-qty', function (e) {
    let value = $(this).val()
    if (value !== '') {
      value = parseInt(value)
      if (isNaN(value) || value < 1) value = 1
      else if (value > 1000) value = 1000
      $(this).val(value)
    }

    if (e.keyCode === 13) {
      $(this).parents('.form-group').find('.btn-produk-tambah').click()
    }
  })

  $(document).on('blur', '.produk-qty', function () {
    let value = $(this).val()
    if (value === '') {
      $(this).val(1)
    }
  })

  $(document).on('click', '.btn-produk-min', function (e) {
    e.preventDefault()
    e.stopPropagation()
    const inputFrom = $(this).next('input')
    const value = inputFrom.val()
    counter(inputFrom, value, 'min')
  })

  $(document).on('click', '.btn-produk-plus', function (e) {
    e.preventDefault()
    e.stopPropagation()
    const inputFrom = $(this).siblings('input')
    const value = inputFrom.val()
    counter(inputFrom, value, 'plus')
  })

  $(document).on('click', '.btn-produk-tambah', function (e) {
    e.preventDefault()
    const varian_id = $(this).data('repo-id')
    const qty = parseInt($(this).parents('.form-group').find('input').val())
    const produk = produks.find(function (obj) {
      return parseInt(obj.id) === varian_id
    })

    const harga = getHarga(produk)
    const subtotal = harga * parseInt(qty)
    const subBerat = parseInt(produk.berat) * parseInt(qty)

    produkOrder = {
      id: 0,
      produk_id: produk.id,
      produk_nama: produk.produk_nama,
      produk_varian_id: varian_id,
      jenis_produk_id: produk.jenis_produk_id,
      qty: qty,
      harga: harga,
      ukuran: produk.ukuran,
      image: produk.image,
      pruduk_image: produk.pruduk_image,
      keterangan: produk.keterangan,
      subBerat: subBerat,
      harga: harga,
      qty: qty,
      subBerat: subBerat,
      subtotal: subtotal,
      diskon_tipe: 'nominal',
      diskon_persen: 0,
      diskon_nominal: 0,
      hargas: produk.hargas,
    }

    const varians = tableOrderList.rows().data().toArray()
    const check = varians.filter(function (obj) {
      return parseInt(obj.produk_varian_id) === varian_id
    })
    if (check.length > 0) {
      newalert('info', 'Produk telah ditambahkan sebelumnya', 'informasi')
      return false
    }

    varians.push(produkOrder)
    refreshTable(tableOrderList, varians)
    refreshGrandTotal()
    notification('success', 'Informasi', 'Produk berhasil ditambahkan')

    $(this).parents('.form-group').find('.produk-qty').focus()
  })

  function formatRepo(repo) {
    if (repo.loading) {
      return repo.text
    }

    const wrapper = createProduk(repo)

    return $(wrapper)
  }

  function formatRepoSelection(repo) {
    produkQuery = repo.produk_nama
    return repo.text || repo.produk_nama
  }
})

function getHarga(arrays) {
  let hargas = arrays.hargas.filter(function (harga) {
    return harga.is_default === '1'
  })[0]
  const kategori_pelanggan = $('#kategori-pelanggan').val()
  if (kategori_pelanggan !== '') {
    hargas = arrays.hargas.filter(function (harga) {
      return harga.pelanggan_id === kategori_pelanggan
    })[0]
  }

  return parseInt(hargas.harga)
}

function createProduk(arrays, useBtn = true) {
  let imageUri = `${base_uri}/assets/images/product-default.png`
  const pathProduk = `${base_uri}/uploads/produk/`
  const pathVarian = `${base_uri}/uploads/varian/`
  if (arrays.image) imageUri = pathVarian + arrays.image
  else if (arrays.produk_image) imageUri = pathProduk + arrays.produk_image

  let po = ''
  let harga = ''
  let deskirpsi = ''

  if (arrays.ukuran && !arrays.warna) deskirpsi = arrays.ukuran
  else if (!arrays.ukuran && arrays.warna) deskirpsi = arrays.warna
  else if (arrays.ukuran && arrays.warna) deskirpsi = arrays.deskirpsi

  if (deskirpsi !== '')
    deskirpsi = `<span class="label label-outline-info">${deskirpsi}</span>`

  if (parseInt(arrays.jenis_produk_id) === 2)
    po = `<span class="label label-outline-primary">${arrays.keterangan}</span>`

  const btn = `<button class="btn btn-primary btn-sm btn-produk-tambah" data-repo-id="${arrays.id}" style="margin-left: 2rem"><i class="fa fa-plus"></i> Tambah</button`
  let btnWrapper = ''
  let addMb = 'mb-3'
  if (useBtn) {
    btnWrapper = `<div style="
              display: flex;
              align-self: center;
              justify-content: flex-end;
              min-width: 220px;
              width: 220px;
              flex-wrap: wrap;
              gap: 8px;
            ">
              <div>
                <div class="form-group">
                  <div class="input-group mb-1" style="width: 60%">
                    <button class="btn btn-outline-secondary btn-sm btn-produk-min" type="button"><i class="fa fa-minus"></i></button>
                    <input type="number" class="form-control produk-qty" min="1" max="1000" value="1">
                    <button class="btn btn-outline-secondary btn-sm btn-produk-plus" type="button"><i class="fa fa-plus"></i></button>
                  </div>
                  ${btn}
                </div>
              </div>
            </div>`
    addMb = ''
    harga = `<div style="font-weight: bold;">Rp.${thousandFormat(
      getHarga(arrays)
    )}</div>`
  }

  const wrapper = `<div class="col-xs-12 ${addMb}">
                    <div class="d-flex align-items-top justify-content-between position-relative">
                      <img src="${imageUri}" style="height: 65px; width: 65px;">
                      <div class="d-flex align-items-center justify-content-between w-100 ms-3">
                        <div style="font-size: 16px">
                          <div style="font-size: 17px;">${arrays.produk_nama}</div>
                          ${deskirpsi}
                          ${po}
                          ${harga}
                        </div>
                        ${btnWrapper}
                      </div>
                    </div>
                   </div>`

  return wrapper
}

function counter(inputFrom, value, param) {
  value = parseInt(value)
  if (param === 'min') {
    value = value <= 1 ? 1 : value - 1
  } else if (param === 'plus') {
    value = value >= 1000 ? 1000 : value + 1
  }

  inputFrom.val(value)
  inputFrom.focus()
}
