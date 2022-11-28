$(function () {
  let produkQuery, produks
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

  $(document).on('keyup', '.produk-qty', function () {
    let value = $(this).val()
    value = parseInt(value)
    if (isNaN(value) || value < 1) value = 1
    else if (value > 1000) value = 1000
    $(this).val(value)
  })

  $(document).on('click', '.produk-min', function (e) {
    e.preventDefault()
    e.stopPropagation()
    const inputFrom = $(this).next('input')
    const value = inputFrom.val()
    counter(inputFrom, value, 'min')
  })

  $(document).on('click', '.produk-plus', function (e) {
    e.preventDefault()
    e.stopPropagation()
    const inputFrom = $(this).siblings('input')
    const value = inputFrom.val()
    counter(inputFrom, value, 'plus')
  })

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

  function formatRepo(repo) {
    if (repo.loading) {
      return repo.text
    }

    produks = repo
    let imageUri = `${base_uri}/assets/images/product-default.png`
    const pathProduk = `${base_uri}/uploads/produk/`
    const pathVarian = `${base_uri}/uploads/varian/`
    if (repo.image) imageUri = pathVarian + repo.image
    else if (repo.produk_image) imageUri = pathProduk + repo.produk_image

    let deskirpsi = ''
    if (repo.ukuran && !repo.warna) deskirpsi = repo.ukuran
    else if (!repo.ukuran && repo.warna) deskirpsi = repo.warna
    else if (repo.ukuran && repo.warna) deskirpsi = repo.deskirpsi

    if (deskirpsi !== '')
      deskirpsi = `<span class="label label-outline-info">${deskirpsi}</span>`

    let po = ''
    if (parseInt(repo.jenis_produk_id) === 2)
      po = `<span class="label label-outline-primary">${repo.keterangan}</span>`

    let hargas = repo.hargas.filter(function (harga) {
      return harga.is_default == '1'
    })[0]
    const harga = `<div style="font-weight: bold;">Rp.${thousandFormat(
      hargas.harga
    )}</div>`

    const btn = `<button class="btn btn-primary btn-sm ms-3 sepek" data-repo-id="${repo.id}"><i class="fa fa-plus"></i> Tambah</button`

    const wrapper = $(
      `<div class="col-xs-12">
        <div class="d-flex align-items-center justify-content-between position-relative">
          <img src="${imageUri}" style="height: 65px; width: 65px;">
          <div class="d-flex align-items-center justify-content-between w-100 ms-3">
            <div style="font-size: 16px">
              <div style="font-size: 17px;">${repo.produk_nama}</div>
              ${deskirpsi}
              ${po}
              ${harga}
            </div>
            <div style="
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
                    <button class="btn btn-outline-secondary btn-sm produk-min" type="button"><i class="fa fa-minus"></i></button>
                    <input type="number" class="form-control produk-qty" min="1" max="1000" value="1">
                    <button class="btn btn-outline-secondary btn-sm produk-plus" type="button"><i class="fa fa-plus"></i></button>
                  </div>
                  ${btn}
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>`
    )

    return wrapper
  }

  function formatRepoSelection(repo) {
    produkQuery = repo.produk_nama
    return repo.text || repo.produk_nama
  }

  $(document).on('click', '.sepek', function (e) {
    e.preventDefault()
    console.log($(this).data('repo'))
  })
})
