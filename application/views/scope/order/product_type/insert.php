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
                <div class="form-group row">
                  <label class="col-md-3">Nama</label>
                  <div class="col-md-9">
                    <input id="name" name="name" type="text" class="form-control cannot-null" maxlength="25" placeholder="Nama jenis produk">
                    <span class="text-danger"></span>
                    <?= form_error('name', '<span class="text-danger"></span>'); ?>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="text-xs-right">
                    <button id="btn_save" onclick="save()" type="button" class="btn btn-info">Simpan <i class="icon-save position-right"></i></button>
                    <a href="<?= base_url(); ?><?= $url; ?>" class="btn btn-info">Batal <i class="icon-arrow-left3 position-right"></i></a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>