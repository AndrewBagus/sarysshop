$(function () {
  $('#penerima').select2({
    theme: 'bootstrap-5',
    ajax: {
      url: base_uri + '/pelanggan/findPelanggans',
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
      processResults: function (data, params) {
        data = $.map(data, function (obj) {
          obj.namaCari = obj.nama.replace(
            new RegExp(params.term, 'gi'),
            "<b style='color:#00bcd4'>$&</b>"
          )
          return obj
        })
        return {
          results: data,
        }
      },
    },
    minimumInputLength: 3,
    placeholder: 'Cari Penerima',
    escapeMarkup: function (markup) {
      return markup
    },
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

  $(document).on('select2:open', '#penerima', function () {
    document
      .querySelector('.select2-search input.select2-search__field')
      .focus()
  })

  function formatRepo(repo) {
    if (repo.loading) {
      return repo.text
    }

    const wrapper = $(
      `<div class="col-xs-12">
        <div class="d-flex align-items-center justify-content-between position-relative">
          <div class="d-flex align-items-center justify-content-between w-100 ms-3">
            <div style="font-size: 16px">
              <div style="font-size: 17px; font-weight: bolder">${repo.namaCari}</div>
              <small class="d-block">${repo.alamat}</small>
              <small class="d-block">Kec. ${repo.kecamatan}, ${repo.kode_pos}</small>
            </div>
          </div>
        </div>
       </div>`
    )

    return wrapper
  }

  function formatRepoSelection(repo) {
    if (repo.nama !== undefined) {
      const alamat = `<div class="col-xs-12 mt-2">
        <div class="d-flex align-items-center justify-content-between position-relative">
          <div class="d-flex align-items-center justify-content-between w-100">
            <div style="font-size: 16px">
              <div style="font-size: 16px; font-weight: bolder">Alamat: </div>
              <small class="d-block">${repo.alamat}</small>
              <small class="d-block">Kec. ${repo.kecamatan}, ${repo.kode_pos}</small>
            </div>
          </div>
        </div>
       </div>`

      $('#penerima-alamat').html(alamat)
    }
    return repo.text || repo.nama
  }
})
