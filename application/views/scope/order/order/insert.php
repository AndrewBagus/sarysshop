<style>
  .pad-0 {
    padding: 0px;
  }
</style>
<div class="content-header">
  <div class="breadcrumb-wrapper col-xs-12">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        <a href="dashboard">Home</a>
      </li>
      <li class="breadcrumb-item active">
        <a href="<?= base_url(); ?><?= $url; ?>"><?= $title; ?></a>
      </li>
      <li class="breadcrumb-item">
        <a>Tambah <?= $title; ?></a>
      </li>
    </ol>
  </div>
</div>
<div class="col-md-12 row">
  <div class="col-md-6">
    <h4 class="card-title" id="title_header">Tambah <?= $title; ?></h4>
  </div>
</div>
<hr class="col-md-12" />
<div class="content-body">
  <form id="form_creator" class="form-horizontal" enctype='multipart/form-data' action="#">
    <div class="col-md-4">
      <div class="card">
        <div id="panel_editor" class="card-body collapse in">
          <div class="card-block" style="padding:5px">
            <div class="form-body">
              <div class="col-md-12">
                <fieldset class="col-sm-12" id="area-name">
                  <h5>Nama Customer</h5>
                  <div class="input-group input-group-lg">
                    <input type="hidden" id="hidden_name" name="name" value="<?= set_value('customer_id'); ?>" />
                    <input id="name" class="form-control cannot-null" type="text" maxlength="100" value="<?= set_value('name'); ?>" placeholder="Cari customer" />
                    <span class="text-danger"></span>
                    <?= form_error('name', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-11 pad-0" id="area-name-text" style="display:none"></fieldset>
                <button id="btn_edit_name" onclick="edit_name()" type="button" class="btn btn-info btn-sm col-md-1" style="display:none"><i class="fa fa-edit"></i></button>
                <fieldset class="col-sm-12" id="area-dikirim">
                  <h5>Dikirim Ke</h5>
                  <div class="input-group input-group-lg">
                    <input type="hidden" id="hidden_dikirim_ke" name="dikirim_ke" value="<?= set_value('customer_id'); ?>" />
                    <input id="dikirim_ke" class="form-control cannot-null" type="text" maxlength="100" value="<?= set_value('dikirim_ke'); ?>" placeholder="Cari customer" />
                    <span class="text-danger"></span>
                    <?= form_error('dikirim_ke', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-11 pad-0" id="area-dikirim-text" style="display:none"></fieldset>
                <button id="btn_edit_dikirim" onclick="edit_dikirim()" type="button" class="btn btn-info btn-sm col-md-1" style="display:none"><i class="fa fa-edit"></i></button>
                <fieldset class="col-sm-12">
                  <h5>Tanggal</h5>
                  <div class="input-group input-group-lg">
                    <input type="text" name="tanggal_order" id="tanggal_order" class="form-control cannot-null" placeholder="Format tanggal (dd-MM-yyyy)" value="<?= date('d-m-Y'); ?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                  <span class="text-danger"></span>
                  <?= form_error('tanggal_order', '<span class="text-danger"></span>'); ?>
                </fieldset>
                <fieldset class="col-sm-12">
                  <h5>Note</h5>
                  <div class="input-group input-group-lg">
                    <textarea id="note" name="note" rows="6" class="form-control" type="text"><?= set_value('note'); ?></textarea>
                    <span class="text-danger"></span>
                    <?= form_error('note', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div id="panel_editor" class="card-body collapse in">
          <div class="card-block">
            <div class="form-body">
              <div class="col-md-12">
                <fieldset class="col-sm-12">
                  <h5>Cari Produk</h5>
                  <div class="input-group input-group-lg">
                    <select class="form-control select2 cannot-null" style="padding: 0 0 0 12px !important;display:none" id="cari_produk" placeholder="Cari Produk">
                    </select>
                    <!-- <div class="form-control-position" style="padding:7px">
                      <i class="fa fa-search info font-medium-5"></i>
                    </div> -->
                    <span class="text-danger"></span>
                    <?= form_error('cari_produk', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div id="panel_editor" class="card-body collapse in">
          <div class="card-block">
            <div class="form-body">
              <div class="col-md-12">
                <fieldset class="col-sm-12">
                  <h5>Keranjang</h5>
                  <table class="table table-striped table-bordered table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th style='width:40%'> Nama</th>
                        <th style='width:20%'> Harga</th>
                        <th style='width:10%'> Qty </th>
                        <th style='width:20%'> Subtotal </th>
                        <th>
                          <center>Aksi</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody id='cart_list'>
                      <tr class='cart-empty'>
                        <td colspan="5" style='text-align:center'>Keranjang masih kosong</td>
                      </tr>
                    </tbody>
                  </table>
                  <hr />
                  <table style="width:100%">
                    <thead>
                      <tr>
                        <th style='width:40%'>Subtotal</th>
                        <th style='width:20%'></th>
                        <th style='width:10%' id='total_qty'>0</th>
                        <th style='width:20%' id='subtotal'>Rp. 0</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style='width:40%'>Berat total: <span id='total_berat'>0Kg</span></td>
                        <td style='width:20%'></td>
                        <td style='width:10%'></td>
                        <td style='width:20%'></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="2" style='width:40%'>
                          <div class="col-md-12 pad-0">
                            <div class="col-md-4 pad-0">Pilih kurir </div>
                            <div class="col-md-8">
                              <select class="form-control select" disabled onchange="set_kurir_image()" id="m_kurir" name="m_kurir" style="width: 100%;">
                                <option value="0">Pilih kurir</option>
                                <?php
                                foreach ($kurir as $row) {
                                ?>
                                  <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                        </td>
                        <td>
                          <?php
                          foreach ($kurir as $row) {
                          ?>
                            <img id="image_kurir_<?= $row['id'] ?>" src="<?= base_url(); ?>app_assets/upload/kurir/<?= $row['image_url'] ?>" style="max-height:50px;display:none">
                          <?php
                          }
                          ?>
                        </td>
                        <td style='width:10%'><input id="biaya_kurir" name="biaya_kurir" class="form-control cannot-null format_currency" type="text" value="" /></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="col-md-12 pad-0" style="margin-top:10px">
                    <button type="button" id="add_diskon" class="btn btn-outline-info"><i class="fa fa-plus"></i> Diskon order</button>
                    <button type="button" id="add_biaya" class="btn btn-outline-info"><i class="fa fa-plus"></i> Biaya lain</button>
                  </div>
                  <hr class="col-md-12" />
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="form-actions col-md-12">
  <div class="text-xs-right">
    <button id="btn_save" onclick="save()" type="button" class="btn btn-info">Simpan <i class="icon-save position-right"></i></button>
    <a href="<?= base_url(); ?><?= $url; ?>" class="btn btn-info">Batal <i class="icon-arrow-left3 position-right"></i></a>
  </div>
</div>
<script>
  positive_integer_load();

  $("#biaya_kurir").attr("disabled", "disabled");

  $('.format_currency').on('keyup', function() {
    var num = this.value;
    var str = num.toString().replace(".", ""),
      parts = false,
      output = [],
      i = 1,
      formatted = null;
    if (str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
      if ((str[j] != "," && !$.isNumeric(str[j]))) {

      } else if (str[j] != ",") {
        output.push(str[j]);
        if (i % 3 == 0 && j < (len - 1)) {
          output.push(",");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    this.value = (formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
  });

  $("#name").autocomplete({
      source: "<?= base_url(); ?><?= $url; ?>/get_customer",
      minLength: 3,
      select: function(event, ui) {
        $('#hidden_name').val($('#temp_name_id').val());
        $('#area-name').hide();
        $('#area-name-text').html(ui.item.value);
        $('#area-name-text').show();
        $('#btn_edit_name').show();
        if ($('#hidden_dikirim_ke').val() == '') {
          $('#hidden_dikirim_ke').val($('#temp_name_id').val());
          $('#area-dikirim').hide();
          $('#area-dikirim-text').html(ui.item.value);
          $('#area-dikirim-text').show();
          $('#btn_edit_dikirim').show();
        }
        $('#temp_name_id').remove();
        $("#cart_list").children().remove();
        $('#cart_list').append(`
          <tr class='cart-empty'>
            <td colspan="5" style='text-align:center'>Keranjang masih kosong</td>
          </tr>`);
        $('#total_qty').html('0');
        $('#subtotal').html('Rp. 0');
        $('#total_berat').html('0Kg');
        $('#biaya_kurir').val('');

        $('#m_kurir').val('0').trigger('change');
        $('#m_kurir').attr('disabled', 'disabled');

        console.log('id', ui.item.id);
        console.log('value', ui.item.value);
      },
    })
    .data("ui-autocomplete")._renderItem = function(ul, item) {
      let txt = String(item.label).replace(new RegExp(this.term, "gi"), "<b style='color:blue'>$&</b>");

      return $("<li></li>")
        .data("ui-autocomplete-item", item)
        .append("<div>" + txt + "</div>")
        .appendTo(ul);
    };

  $("#dikirim_ke").autocomplete({
      source: "<?= base_url(); ?><?= $url; ?>/get_customer",
      minLength: 3,
      select: function(event, ui) {
        $('#hidden_dikirim_ke').val($('#temp_name_id').val());
        $('#temp_name_id').remove();
        $('#area-dikirim').hide();
        $('#area-dikirim-text').html(ui.item.value);
        $('#area-dikirim-text').show();
        $('#btn_edit_dikirim').show();

        console.log('id', ui.item.id);
        console.log('value', ui.item.value);
      },
    })
    .data("ui-autocomplete")._renderItem = function(ul, item) {
      let txt = String(item.value).replace(new RegExp(this.term, "gi"), "<b style='color:blue'>$&</b>");

      return $("<li></li>")
        .data("ui-autocomplete-item", item)
        .append("<div>" + txt + "</div>")
        .appendTo(ul);
    };

  $('#tanggal_order').datepicker({
    autoclose: true,
    todayHighlight: true,
    todayBtn: true,
    dateFormat: 'dd-mm-yy',
    maxDate: -0,
    orientation: 'bottom',
  });

  $("#cari_produk").select2({
    ajax: {
      url: "<?= base_url(); ?><?= $url; ?>/get_produk",
      dataType: 'json',
      delay: 250,
      data: function(params) {
        if ($('#hidden_name').val() == "") {
          alert("Pilih customer terlebih dahulu!");
        } else {
          return {
            search_data: params.term,
            m_kategori_pelanggan_id: 1
          };
        }
      },
      processResults: function(data, params) {
        return {
          results: data,
        };
      },
      cache: true
    },
    minimumInputLength: 3,
    placeholder: "Cari Produk",
    escapeMarkup: function(markup) {
      return markup;
    },
    closeOnSelect: false,
    templateSelection: ''
  });
  $('.select2-selection__arrow').remove();

  $("body").on('change', '.select2-search__field', function(event) {
    console.log($('#select2-cari_produk-results').children().attr('class'));
    // $('#select2-cari_produk-results').attr('style', 'pointer-events: none');
    // $('#select2-cari_produk-results').children().each(function() {
    //   $(this).attr('style', 'cursor: pointer');
    // });
  });

  // $('#cari_produk').on('select2:select', function(e) {
  //   console.log($('#select2-cari_produk-results').children().attr('class'));
  //   $('#select2-cari_produk-results').children().attr('disabled', 'disabled')
  // });

  function add_cart(element) {
    var varian_id = $(element).parent().find('.varian_id').val();
    var name = $(element).parent().find('.name').val();
    var harga = $(element).parent().find('.harga').val();
    var qty = $(element).parent().find('.qty').val();
    var jenis = $(element).parent().find('.jenis').val();
    var tempo = $(element).parent().find('.tempo').val();
    var ukuran = $(element).parent().find('.ukuran').val();
    var warna = $(element).parent().find('.warna').val();
    var image = $(element).parent().find('.image').val();
    var berat = $(element).parent().find('.berat').val();

    if ($('#cart_list').find('.produk_varian_id_' + varian_id).length) {
      glsUI.showNotif('PERINGATAN', 'Produk sudah ada dalam keranjang', 'warning');
    } else {
      var preorder = jenis != 2 ? "<span class='badge badge-warning' style='font-size:10px'><b>PREORDER " + tempo + " HARI</b></span>" : "";
      var image_url = image ? 'app_assets/upload/produk/'.image : 'app_assets/img/no-image.png';
      var produk = `
        <tr class='produk_varian_id_` + varian_id + `'>
          <td>
            <span>` + name + `</span></br>
            <small class='badge badge-info' style='font-size:10px'><b>` + ukuran + ` ` + warna + `</b></small> ` + preorder + `
            <input type='hidden' class='berat_produk' value='` + (parseInt(berat) * parseInt(qty)) + `'/>
            <input type='hidden' name='m_produk_varian_id' value='` + varian_id + `'/>
          </td>
          <td>Rp ` + harga + `</td>
          <td>` + qty + ` <input type='hidden' name='produk_qty_` + varian_id + `' class='produk_qty' value='` + qty + `'/></td>
          <td>Rp ` + format_currency((parseInt(qty) * parseInt(harga.replace(/\./g, '')))) + ` <input type='hidden' class='price' value='` + (parseInt(qty) * parseInt(harga.replace(/\./g, ''))) + `'/></td>
          <td></td>
        </tr>`;
      $('#cart_list').append(produk);
      $('.cart-empty').remove();

      var sum_price = 0;
      $('.price').each(function() {
        sum_price += Number($(this).val());
      });
      $('#subtotal').html('Rp ' + format_currency(sum_price));

      var total_qty = 0;
      $('.produk_qty').each(function() {
        total_qty += Number($(this).val());
      });
      $('#total_qty').html(format_currency(total_qty));

      var total_berat = 0;
      $('.berat_produk').each(function() {
        total_berat += Number($(this).val());
      });
      // total_berat = total_berat.toString().length >= 4 ? (total_berat / 1000) : total_berat;
      total_berat = (total_berat / 1000);
      $('#total_berat').html(total_berat + "Kg");
      // alert(total_berat)

      if (total_qty != 0) {
        $('#m_kurir').removeAttr('disabled');
        $('#m_kurir').val('0').trigger('change');
      }
    }
  }

  function format_currency(num) {
    var str = num.toString().replace(".", ""),
      parts = false,
      output = [],
      i = 1,
      formatted = null;
    if (str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
      if ((str[j] != "," && !$.isNumeric(str[j]))) {

      } else if (str[j] != ",") {
        output.push(str[j]);
        if (i % 3 == 0 && j < (len - 1)) {
          output.push(".");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    return (formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
  }

  function edit_name() {
    $('#name').val('');
    $('#hidden_name').val('');
    $('#area-name').show();
    $('#area-name-text').html('');
    $('#area-name-text').hide();
    $('#btn_edit_name').hide();
  }

  function edit_dikirim() {
    $('#dikirim_ke').val('');
    $('#hidden_dikirim_ke').val('');
    $('#area-dikirim').show();
    $('#area-dikirim-text').html('');
    $('#area-dikirim-text').hide();
    $('#btn_edit_dikirim').hide();
  }

  function set_kurir_image() {
    var id = $('#m_kurir').val();
    $("[id^='image_kurir_']").hide();
    $("#image_kurir_" + id).show();
    if (id == 0) {
      $("#biaya_kurir").val('')
      $("#biaya_kurir").attr("disabled", "disabled")
    } else if (id == 1) {
      $("#biaya_kurir").val('0')
      $("#biaya_kurir").attr("disabled", "disabled")
    } else {
      $("#biaya_kurir").removeAttr("disabled");
    }
  }
</script>