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
  <div class="col-md-12 row">
    <div class="col-md-6">
      <h4 class="card-title" id="title_header"><?= $title; ?></h4>
    </div>
    <div class="col-md-6">
      <div style="float:right">
        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><button id="btn_tambah_data" onclick="load_insert()" type="button" class="btn btn-info btn-min-width"><i class="icon-plus-square white"></i> Tambah Data </button></li>
            <li><a data-action="expand" class="nav-link nav-link-expand"><i class="icon-expand2"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <hr class="col-md-12" />
  <div class="col-md-12" id="button_area">
    <button type="button" id="unpaid" class="btn btn-info btn-status"><i class="fa-solid fa-circle"></i> Belum Bayar</button>
    <button type="button" id="installment" class="btn btn-secondary bg-white btn-status"><i class="fa-solid fa-circle grey"></i> Sudah DP</button>
    <button type="button" id="paid" class="btn btn-secondary bg-white btn-status"><i class="fa-solid fa-circle grey"></i> Sudah Lunas</button>
    <button type="button" id="shipping" class="btn btn-secondary bg-white btn-status"><i class="fa-solid fa-circle grey"></i> Pengiriman</button>
    <button type="button" id="delivered" class="btn btn-secondary bg-white btn-status"><i class="fa-solid fa-circle grey"></i> Terkirim</button>
  </div>
  <div class="col-md-12">
    <form id="form_seacrh" method="post" action="">
      <fieldset class="col-md-4" style="margin:5px 5px 5px 0px;padding:0px">
        <div class="input-group input-group-m">
          <div class="input-group-prepend">
            <select class="form-control" id="search_option" style="font-weight:bold" name="search_option">
              <option value="id">Order ID</option>
              <option value="nama_customer">Nama Customer</option>
            </select>
            <input id="key" name="key" class="form-control col-md-8" type="text" style="width:150%" value="<?= set_value('key'); ?>" placeholder="Cari . . ." />
          </div>
        </div>
      </fieldset>
      <fieldset class="col-md-2" style="margin:5px 0px 5px 5px;padding:0px">
        <button type="submit" class="btn btn-blue"><i class="fa fa-search" style="margin-bottom:2px;margin-top:2px"></i></button>
        <button type="button" id="clear" onclick="to_index()" disabled class="btn btn-blue"><i class="fa fa-rotate" style="margin-bottom:2px;margin-top:2px"></i></button>
      </fieldset>
    </form>
  </div>
  <div class="col-md-12" id="list_area">
    <div class="card">
      <div class="card-header">
        ----
      </div>
      <div id="panel_list" class="card-body collapse in">
        <div class="card-block card-dashboard">
          ---
        </div>
      </div>
      <div class="card-footer">
        ---
      </div>
    </div>
  </div>

</div>
<script src="<?= base_url(); ?>app_assets/robust/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>app_assets/robust/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script>
  function load_insert() {
    // $('#insert_area').show();
    $("#content_body").load("<?= $url; ?>/load_insert/");
  }

  function load_edit(id) {
    // $('#edit_area').show();
    $("#content_body").load("<?= $url; ?>/load_edit/" + id);
  }

  function load_detail(id) {
    // $('#edit_area').show();
    $("#content_body").load("<?= $url; ?>/load_detail/" + id);
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

  load_table('unpaid');

  function load_table(status) {
    $("#list_area").load("<?= $url; ?>/load_table/" + status);
  }

  $(".btn-status").on("click", function() {
    $('.btn-status').attr('class', 'btn btn-secondary bg-white btn-status');
    $('.btn-status').children().attr('class', 'fa-solid fa-circle grey');
    $(this).attr('class', 'btn btn-info btn-status');
    $(this).children().attr('class', 'fa-solid fa-circle');
    load_table(this.id);
  });

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

  function generate_code() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }
</script>