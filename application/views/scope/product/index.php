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
                    <div class="input-group-prepend">
                      <select class="form-control" id="search_option" style="font-weight:bold;display:none" name="search_option">
                        <option value="name">Nama</option>
                        <option value="supplier">Supplier</option>
                      </select>
                      <input id="key" name="key" class="form-control col-md-8" type="text" style="width:200%" value="<?= set_value('key'); ?>" placeholder="Masukan nama produk" />
                    </div>
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
                    <th> Produk</th>
                    <th> Supplier</th>
                    <th> Stok </th>
                    <th> Varian </th>
                    <th> Kategori </th>
                    <th> Jenis </th>
                    <th> Tempo </th>
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
                      <td style="padding:5px">
                        <div class="col-md-12" style="padding:0px;">
                          <div class="col-md-2" style="padding:0px;">
                            <img src="<?= base_url(); ?>app_assets\upload\produk\<?= $row['image_url']; ?>" style="padding:0px; width:100%">
                          </div>
                          <div class="col-md-9" style="padding:0px 0px 0px 5px">
                            <p style="margin-bottom:2px"><?= $row['name']; ?></p>
                            <?php
                            if ($row['min_harga'] == $row['max_harga']) {
                            ?>
                              <p style="margin-bottom:2px">Rp <?= number_format($row['min_harga'], 0, ',', '.'); ?></p>
                            <?php
                            } else {
                            ?>
                              <p style="margin-bottom:2px">Rp <?= number_format($row['min_harga'], 0, ',', '.'); ?> - Rp <?= number_format($row['max_harga'], 0, ',', '.'); ?></p>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p style="margin-bottom:2px"><?= $row['nama_supplier']; ?></p>
                        <p style="margin-bottom:2px"><?= $row['alamat_supplier']; ?></p>
                      </td>
                      <td><?= $row['stok']; ?></td>
                      <td><?= $row['count_varian']; ?></td>
                      <td><?= $row['kategori_produk']; ?></td>
                      <td><?= $row['jenis_produk']; ?></td>
                      <td><?= $row['tempo_kedatangan_barang']; ?> Hari</td>
                      <td><?= ucfirst($row['status_data']); ?></td>
                      <td>
                        <button id="btn_detail" onclick="load_detail('<?= $row['id']; ?>')" type="button" class="btn btn-info btn-sm"><i class="fa fa-fw fa-search position-right"></i></button>
                        <button id="btn_edit" onclick="load_edit('<?= $row['id']; ?>')" type="button" class="btn btn-info btn-sm"><i class="fa fa-fw fa-edit position-right"></i></button>
                        <button id="btn_delete" onclick="delete_data('<?= $row['id']; ?>','<?= $row['name']; ?>')" type="button" class="btn btn-info btn-sm"><i class="fa fa-fw fa-trash position-right"></i></button>
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
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>app_assets/robust/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<script src="<?= base_url(); ?>app_assets/robust/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>app_assets/robust/app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>app_assets/robust/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script>
  $('#table_editor').DataTable({
    paging: false,
    searching: false,
    ordering: false,
    "lengthChange": false
  });

  $('#table_editor_info').hide();

  function load_insert() {
    // $('#insert_area').show();
    $("#content_body").load("<?= base_url(); ?><?= $url; ?>/load_insert/");
  }

  function load_edit(id) {
    // $('#edit_area').show();
    $("#content_body").load("<?= base_url(); ?><?= $url; ?>/load_edit/" + id);
  }

  function load_detail(id) {
    // $('#edit_area').show();
    $("#content_body").load("<?= base_url(); ?><?= $url; ?>/load_detail/" + id);
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

  $("#key").autocomplete({
      source: "<?= base_url(); ?><?= $url; ?>/get_autocomplete",
      minLength: 3,
    })
    .data("ui-autocomplete")._renderItem = function(ul, item) {
      let txt = String(item.value).replace(new RegExp(this.term, "gi"), "<b style='color:blue'>$&</b>");

      return $("<li></li>")
        .data("ui-autocomplete-item", item)
        .append("<div>" + txt + "</div>")
        .appendTo(ul);
    };

  $("#key").autocomplete({
    source: "<?= base_url(); ?><?= $url; ?>/get_autocomplete",
    minLength: 3,
  });

  function save() {
    var error = validate_form("form_creator");
    if (error == 0) {
      var form = $('#form_creator').get(0);
      var formData = new FormData(form);
      var no_varian = [];
      $("[name='no_varian']").each(function() {
        no_varian.push($('#' + this.id).val());
      });
      formData.append('no_varian', JSON.stringify(no_varian));
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/save',
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === false) {
            glsUI.showMessage('ERROR', 'Maaf, proses penyimpanan data gagal \nMessage: ' + result.message, 'error', 'btn-danger');
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
      var no_varian = [];
      $("[name='no_varian']").each(function() {
        no_varian.push($('#' + this.id).val());
      });
      var id_varian = [];
      $("[name='id_varian']").each(function() {
        id_varian.push($('#' + this.id).val());
      });
      formData.append('no_varian', JSON.stringify(no_varian));
      formData.append('id_varian', JSON.stringify(id_varian));
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/edit/' + id,
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === false) {
            glsUI.showMessage('ERROR', 'Maaf, proses penyimpanan data gagal \nMessage: ' + result.message, 'error', 'btn-danger');
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

  function show_success_notif(message) {
    glsUI.showNotif('SUCCESS', message, 'info');
  }

  <?php
  if ($this->session->flashdata('flash_success')) {

  ?>
    show_success_notif('<?= $this->session->flashdata('flash_success'); ?>');
  <?php
  }

  ?>

  function open_category_product() {
    window.open('<?= base_url(); ?>product_category', '_blank');
  }

  function generate_code() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }
</script>