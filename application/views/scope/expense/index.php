<?php
$page_table = $this->uri->segment(3);
if (!$page_table) {
  $page_table = 0;
}
$month_number = date('m');
$total_pengeluaran = $total_pengeluaran == null ? 0 : $total_pengeluaran;
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
                <fieldset class="col-md-1" style="margin:5px 5px 5px 0px;padding:0px">
                  <div class="input-group input-group-m">
                    <div class="input-group-prepend">
                      <select class="form-control" id="search_option" name="search_option" style="font-weight:bold">
                        <option value="by_date">By Date</option>
                        <option value="by_month">By Month</option>
                      </select>
                    </div>
                  </div>
                </fieldset>
                <fieldset id="area_date_start" class="col-md-2" style="margin:5px 5px 5px 0px;padding:0px">
                  <div class="input-group input-group-m">
                    <input type="text" name="date_start" id="date_start" class="form-control cannot-null" placeholder="Format tanggal (dd-MM-yyyy)" value="01<?= date('-m-Y'); ?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </fieldset>
                <fieldset id="area_date_end" class="col-md-2" style="margin:5px 5px 5px 0px;padding:0px">
                  <div class="input-group input-group-m">
                    <input type="text" name="date_end" id="date_end" class="form-control cannot-null" placeholder="Format tanggal (dd-MM-yyyy)" value="<?= date('d-m-Y'); ?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </fieldset>
                <fieldset id="area_year" class="col-md-2" style="margin:5px 5px 5px 0px;padding:0px;display:none">
                  <div class="input-group input-group-m">
                    <div class="input-group-prepend">
                      <select class="form-control" id="year" name="year" style="font-weight:bold">
                        <?php
                        $year = date('Y');
                        for ($i = $year; $i > ($year - 5); $i--) {
                        ?>
                          <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </fieldset>
                <fieldset id="area_month" class="col-md-2" style="margin:5px 5px 5px 0px;padding:0px;display:none">
                  <div class="input-group input-group-m">
                    <div class="input-group-prepend">
                      <select class="form-control" id="month" name="month" style="font-weight:bold">
                        <?php
                        foreach ($month as $row) {
                        ?>
                          <option value="<?= $row['num']; ?>"><?= $row['name']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </fieldset>
                <fieldset class="col-md-2" style="margin:5px 0px 5px 5px;padding:0px">
                  <button type="submit" class="btn btn-blue"><i class="fa fa-search" style="margin-bottom:2px;margin-top:2px"></i></button>
                  <button type="button" id="clear" onclick="to_index()" disabled class="btn btn-blue"><i class="fa fa-rotate" style="margin-bottom:2px;margin-top:2px"></i></button>
                </fieldset>
              </form>
              <div class="col-md-12">
                <span>Total Pengeluaran</span>
                <h3>Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></h3>
              </div>
              <table id="table_editor" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Tanggal </th>
                    <th> Nama Pengeluaran </th>
                    <th> Harga/Biaya </th>
                    <th> Jumlah </th>
                    <th> Total </th>
                    <th>
                      <center>Aksi</center>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($table as $row) {
                  ?>
                    <tr>
                      <td><?= ++$start; ?></td>
                      <td><?= $hari[$row['day']]; ?>, <?= $row['date']; ?></td>
                      <td>
                        <p style="margin-bottom:0px"><?= $row['name']; ?></p><small class="text-gray-4 line-clamp-1"><?= $row['keterangan']; ?></small>
                      </td>
                      <td>Rp <?= number_format($row['biaya'], 0, ',', '.'); ?></td>
                      <td><?= $row['jumlah']; ?> Unit</td>
                      <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                      <td>
                        <button id="btn_edit" onclick="load_edit('<?= $row['id']; ?>')" type="button" class="btn btn-info btn-sm"><i class="fa fa-fw fa-edit position-right"></i></button>
                        <button id="btn_delete" onclick="delete_data('<?= $row['id']; ?>','<?= $row['name']; ?>')" type="button" class="btn btn-info btn-sm"><i class="fa fa-fw fa-trash position-right"></i></button>
                      </td>
                    </tr>
                  <?php
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
<!-- <script src="<?= base_url(); ?>app_assets/robust/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script> -->
<!-- <script src="<?= base_url(); ?>app_assets/js/app.js"></script> -->
<script>
  $('#date_start').datepicker({
    autoclose: true,
    todayHighlight: true,
    todayBtn: true,
    dateFormat: 'dd-mm-yy',
    maxDate: -0,
    orientation: 'bottom',
  });

  $('#date_end').datepicker({
    autoclose: true,
    todayHighlight: true,
    todayBtn: true,
    dateFormat: 'dd-mm-yy',
    maxDate: -0,
    orientation: 'bottom',
  });

  $('#search_option').on('change', function() {
    if (this.value == "by_date") {
      $('#area_date_start').show();
      $('#area_date_end').show();
      $('#area_year').hide();
      $('#area_month').hide();
    } else {
      $('#area_date_start').hide();
      $('#area_date_end').hide();
      $('#area_year').show();
      $('#area_month').show();
    }
  });

  $("#date_end").datepicker("option", "minDate", "01<?= date('-m-Y'); ?>");

  $('#date_start').on('change', function() {
    $("#date_end").datepicker("option", "minDate", this.value);
  });

  $('#month').val('<?= $month_number; ?>').trigger('change');

  function load_insert() {
    $("#content_body").load("<?= base_url(); ?><?= $url; ?>/load_insert/");
  }

  function load_edit(id) {
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
  if (set_value('search_option')) {
  ?>
    disable_button();
    $('#search_option').val('<?= set_value('search_option'); ?>').trigger('change');
    <?php
    if (set_value('search_option') == "by_date") {
    ?>
      $("#date_start").val('<?= set_value('date_start'); ?>');
      $("#date_end").val('<?= set_value('date_end'); ?>');
    <?php
    } else if (set_value('search_option') == "by_month") {
    ?>
      $('#year').val('<?= set_value('year'); ?>').trigger('change');
      $('#month').val('<?= set_value('month'); ?>').trigger('change');
  <?php
    }
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
</script>