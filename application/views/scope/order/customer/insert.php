<div class="content-header">
  <div class="breadcrumb-wrapper col-xs-12">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-item active">
        <a href="product_type"><?= $title; ?></a>
      </li>
      <li class="breadcrumb-item">
        <a>Tambah <?= $title; ?></a>
      </li>
    </ol>
  </div>
</div>
<div class="content-body">
  <div class="">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title" id="title_header">Tambah <?= $title; ?></h4>
          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        </div>
        <div id="panel_editor" class="card-body collapse in">
          <div class="card-block">
            <form id="form_creator" class="form-horizontal" action="#">
              <div class="form-body">
                <fieldset class="col-sm-3">
                  <h5>Kategori Customer</h5>
                  <div class="input-group input-group-lg">
                    <select class="form-control select" id="m_kategori_pelanggan_id" name="m_kategori_pelanggan_id" style="width: 100%;">
                      <?php
                      foreach ($kategori_pelanggan as $row) {
                      ?>
                        <option value="<?= $row['id'] ?>" <?= set_value('kategori_customer_id') ? 'active' : ''; ?>><?= $row['name'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <?= form_error('kategori', '<span class="text-danger"></span>'); ?>
                </fieldset>
                <fieldset class="col-sm-7">
                  <h5>Nama Lengkap</h5>
                  <div class="input-group input-group-lg">
                    <input id="name" name="name" class="form-control cannot-null" type="text" maxlength="100" value="<?= set_value('name'); ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('email', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <div class="col-md-12 row">
                  <fieldset class="col-sm-6">
                    <h5>Kota/kecamatan</h5>
                    <div class="input-group input-group-lg">
                      <select class="form-control select2 cannot-null" style="padding: 0 0 0 12px !important" id="m_kelurahan_desa_id" name="m_kelurahan_desa_id" placeholder="Cari Kota/kecamatan">
                      </select>
                      <div class="form-control-position" style="padding:7px">
                        <i class="fa fa-search info font-medium-5"></i>
                      </div>
                      <span class="text-danger"></span>
                      <?= form_error('m_kelurahan_desa_id', '<span class="text-danger"></span>'); ?>
                    </div>
                  </fieldset>
                  <fieldset class="col-sm-4">
                    <h5>Kode Pos</h5>
                    <div class="input-group input-group-lg">
                      <input id="kode_pos" name="kode_pos" class="form-control cannot-null" type="text" maxlength="10" value="<?= set_value('kode_pos'); ?>" />
                      <span class="text-danger"></span>
                      <?= form_error('kode_pos', '<span class="text-danger"></span>'); ?>
                    </div>
                  </fieldset>
                </div>

                <fieldset class="col-sm-4">
                  <h5>No. Hp / Telepon</h5>
                  <div class="input-group input-group-lg">
                    <input id="no_telepon" name="no_telepon" class="form-control positive-integer cannot-null" type="text" maxlength="15" value="<?= set_value('no_telepon'); ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('no_elepon', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-6">
                  <h5>Email</h5>
                  <div class="input-group input-group-lg">
                    <input id="email" name="email" class="form-control cannot-null" type="email" maxlength="50" value="<?= set_value('email'); ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('email', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-10">
                  <h5>Alamat</h5>
                  <div class="input-group input-group-lg">
                    <textarea id="alamat" name="alamat" rows="3" class="form-control cannot-null" type="text"><?= set_value('alamat'); ?></textarea>
                    <span class="text-danger"></span>
                    <?= form_error('alamat', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
              </div>
              <div class="form-actions">
                <div class="text-xs-right">
                  <button id="btn_save" onclick="save()" type="button" class="btn btn-info">Simpan <i class="icon-save position-right"></i></button>
                  <a href="<?= base_url(); ?><?= $url; ?>" class="btn btn-info">Batal <i class="icon-arrow-left3 position-right"></i></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  positive_integer_load();

  $("#m_kelurahan_desa_id").select2({
    ajax: {
      url: "<?= base_url(); ?><?= $url; ?>/get_kelurahan_desa",
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return {
          search_data: params.term
        };
      },
      processResults: function(data, params) {
        return {
          results: data,
        };
      },
      cache: true
    },
    minimumInputLength: 3,
    placeholder: "Cari Kota/kecamatan",
  });
  $('.select2-selection__arrow').remove();

  $("#kode_pos").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "<?= base_url(); ?><?= $url; ?>/get_kode_pos",
        dataType: "json",
        data: {
          term: request.term,
          m_kelurahan_desa_id: $('#m_kelurahan_desa_id').val()
        },
        success: function(data) {
          response(data);
        }
      });
    },
    minLength: 0,
  });

  $("#kode_pos").on("click", function() {
    $('#kode_pos').autocomplete("search");
  });

  $('#m_kelurahan_desa_id').on('change', function() {
    $('#kode_pos').val('');
  });
</script>