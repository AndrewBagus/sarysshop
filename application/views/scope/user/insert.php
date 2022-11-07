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
                <fieldset class="col-sm-10">
                  <h5>Nama Lengkap</h5>
                  <div class="input-group input-group-lg">
                    <input id="name" name="name" class="form-control cannot-null" type="text" maxlength="100" value="<?= set_value('name'); ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('name', '<span class="text-danger"></span>'); ?>
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
                <fieldset class="col-sm-4">
                  <h5>No. Hp / Telepon</h5>
                  <div class="input-group input-group-lg">
                    <input id="phone" name="phone" class="form-control positive-integer cannot-null" type="text" maxlength="15" value="<?= set_value('no_telepon'); ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('phone', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-4">
                  <h5>Password</h5>
                  <div class="input-group input-group-lg">
                    <input id="password" name="password" class="form-control cannot-null" type="password" maxlength="15" value="<?= set_value('password'); ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('password', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-4">
                  <h5>Re-Password</h5>
                  <div class="input-group input-group-lg">
                    <input id="re_password" name="re_password" class="form-control cannot-null" type="password" maxlength="15" value="<?= set_value('re_password'); ?>" />
                  </div>
                </fieldset>
                <fieldset class="col-sm-2">
                  <h5>Role</h5>
                  <div class="input-group input-group-lg">
                    <select class="form-control select" id="m_role_id" name="m_role_id" style="width: 100%;">
                      <?php
                      foreach ($role as $row) {
                      ?>
                        <option value="<?= $row['id'] ?>" <?= set_value('m_role_id') ? 'active' : ''; ?>><?= $row['name'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <?= form_error('m_role_id', '<span class="text-danger"></span>'); ?>
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