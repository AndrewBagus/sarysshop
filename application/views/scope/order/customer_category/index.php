<?php
$page_table = $this->uri->segment(3);
if (!$page_table) {
  $page_table = 0;
}
?>
<div id="table_area">
  <div class="content-header">
    <div class="breadcrumb-wrapper col-xs-12">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          <a href="dashboard">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a><?= $title; ?></a>
        </li>
      </ol>
    </div>
  </div>
  <div class="content-body">
    <div class="">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="title_header"><?= $title; ?></h4>
            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><button id="btn_tambah_data" onclick="load_insert()" type="button" class="btn btn-info btn-min-width"><i class="icon-plus-square white"></i> Tambah Data </button></li>
                <li><a data-action="expand" class="nav-link nav-link-expand"><i class="icon-expand2"></i></a></li>
              </ul>
            </div>
          </div>
          <div id="panel_list" class="card-body collapse in">
            <div class="card-block card-dashboard">
              <form id="form_seacrh" method="post" action="">
                <fieldset class="col-md-3" style="margin:5px 5px 5px 0px;padding:0px">
                  <div class="input-group input-group-m">
                    <input id="key" name="key" class="form-control" type="text" value="<?= set_value('key'); ?>" placeholder="Masukan kategori pelanggan" />
                  </div>
                </fieldset>
                <fieldset class="col-md-2" style="margin:5px 0px 5px 5px;padding:0px">
                  <button type="submit" class="btn btn-blue"><i class="fa fa-search" style="margin-bottom:2px;margin-top:2px"></i></button>
                  <button type="button" id="clear" onclick="to_index()" disabled class="btn btn-blue"><i class="fa fa-rotate" style="margin-bottom:2px;margin-top:2px"></i></button>
                </fieldset>
              </form>
              <table id="table_editor" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Nama </th>
                    <th> Status </th>
                    <th>
                      <center>Aksi</center>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($table as $row) {
                  ?>
                    <tr>
                      <td><?= ++$start; ?></td>
                      <td><?= $row['name']; ?></td>
                      <td><?= ucfirst($row['status_data']); ?></td>
                      <td>
                        <button id="btn_edit" onclick="load_edit('<?= $row['id']; ?>')" type="button" class="btn btn-info btn-sm"><i class="fa fa-fw fa-edit position-right"></i></button>
                      </td>
                    </tr>
                  <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
              <?= $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url(); ?>app_assets/robust/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>app_assets/robust/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>app_assets/robust/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>app_assets/js/app.js"></script>
<script>
  function load_insert() {
    $('#insert_area').show();
    $("#content_body").load("<?= base_url(); ?><?= $url; ?>/load_insert/");
  }

  function load_edit(id) {
    $('#edit_area').show();
    $("#content_body").load("<?= base_url(); ?><?= $url; ?>/load_edit/" + id);
  }

  function to_index(page) {
    if (page && page != "0") {
      window.location = "<?= base_url(); ?><?= $url; ?>/index/" + page;
    } else {
      window.location = "<?= base_url(); ?><?= $url; ?>";
    }
  }

  function search_table() {
    $("#form_search").submit();
  }

  function disable_button() {
    $('#clear').removeAttr('disabled', 'disabled');
  }
  <?php
  if (set_value('key')) {
  ?>
    disable_button();
  <?php
  }
  ?>

  function save() {
    var error = validate_form("form_creator");
    if (error == 0) {
      var form = $('#form_creator').get(0);
      var formData = new FormData(form);
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/save',
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === 'failed') {
            show_success_notif('warning', result.message, 'warning');
          } else {
            // glsUI.showNotif('Success', result.message, 'info');
            to_index();
          }
        })
        .fail(function(xhr, status, error) {
          glsUI.showMessage('ERROR', 'Maaf, proses penyimpanan data gagal \nMessage: ' + error, 'error', 'btn-danger');
        })
        .always(function() {

        });
    }
  }

  function delete_data(id, name) {
    if (confirm('Are you sure you want to delete ' + name + '?') === true) {
      $.ajax({
          method: "POST",
          url: '<?= base_url() ?><?= $url; ?>/delete/' + id,
        })
        .done(function(result) {
          if (result.status === false) {
            glsUI.showMessage('ERROR', 'Maaf, proses hapus data gagal \nMessage: ' + result.message, 'error', 'btn-danger');
          } else {
            // glsUI.showNotif('Success', 'Jenis produk berhasil dihapus!', 'info');
            to_index();
          }
        })
        .fail(function(xhr, status, error) {
          glsUI.showMessage('ERROR', 'Maaf, hapus data gagal \nMessage: ' + error, 'error', 'btn-danger');
        })
        .always(function() {

        });
    }
  }

  function edit(id) {
    var error = validate_form("form_creator");
    if (error == 0) {
      var form = $('#form_creator').get(0);
      var formData = new FormData(form);
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/edit/' + id,
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === 'failed') {
            show_success_notif('warning', result.message, 'warning');
          } else {
            // glsUI.showNotif('Success', result.message, 'info');
            to_index("<?= $page_table; ?>");
          }
        })
        .fail(function(xhr, status, error) {
          glsUI.showMessage('ERROR', 'Maaf, proses penyimpanan data gagal \nMessage: ' + error, 'error', 'btn-danger');
        })
        .always(function() {

        });
    }
  }

  function show_success_notif(status, message, icon) {
    glsUI.showNotif(status, message, icon);
  }

  <?php
  if ($this->session->flashdata('flash_success')) {

  ?>
    show_success_notif('success', '<?= $this->session->flashdata('flash_success'); ?>', 'info');
  <?php
  }

  ?>
  // <?php
      // if ($this->session->flashdata('flash_failed')) {

      // 
      ?>
  //   show_success_notif('warning', '<?= validation_errors(); ?>', 'warning');
  // <?php
      // }

      // 
      ?>
</script>