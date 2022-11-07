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
                    <input type="hidden" id="hidden_name" class="cannot-null" name="customer_id" value="<?= set_value('customer_id'); ?>" />
                    <input id="name" class="form-control" type="text" maxlength="100" value="<?= set_value('name'); ?>" placeholder="Cari customer" />
                    <span class="text-danger"></span>
                    <?= form_error('name', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-11 pad-0" id="area-name-text" style="display:none"></fieldset>
                <button id="btn_edit_name" onclick="edit_name()" type="button" class="btn btn-warning btn-sm col-md-1" style="display:none"><i class="fa fa-edit"></i></button>
                <fieldset class="col-sm-12" id="area-dikirim">
                  <h5>Dikirim Ke</h5>
                  <div class="input-group input-group-lg">
                    <input type="hidden" id="hidden_dikirim_ke" class="cannot-null" name="dikirim_ke" value="<?= set_value('customer_id'); ?>" />
                    <input id="dikirim_ke" class="form-control" type="text" maxlength="100" value="<?= set_value('dikirim_ke'); ?>" placeholder="Cari customer" />
                    <span class="text-danger"></span>
                    <?= form_error('dikirim_ke', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-11 pad-0" id="area-dikirim-text" style="display:none"></fieldset>
                <button id="btn_edit_dikirim" onclick="edit_dikirim()" type="button" class="btn btn-warning btn-sm col-md-1" style="display:none"><i class="fa fa-edit"></i></button>
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
                    <select class="form-control select2" style="padding: 0 0 0 12px !important;display:none" id="cari_produk" placeholder="Cari Produk">
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
                        <th style='width:20%'><input type='hidden' name='subtotal' value='0' /></th>
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
                            <div class="col-md-4 pad-0">Pre Order </div>
                            <div class="col-md-8">
                              <div class="input-group input-group-sm">
                                <input id="preorder" name="preorder" class="form-control cannot-null positive-integer" type="text" value="" />
                                <span class="input-group-addon">Hari</span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>

                        </td>
                        <td style='width:10%'></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="2" style='width:40%'>
                          <div class="col-md-12 pad-0">
                            <div class="col-md-4 pad-0">Pilih kurir </div>
                            <div class="col-md-8">
                              <select class="form-control select cannot-null" disabled onchange="set_kurir_image()" id="m_kurir" name="m_kurir" style="width: 100%;">
                                <option value="">Pilih kurir</option>
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
                    <button type="button" id="add_diskon" onclick="load_diskon_order()" disabled class="btn btn-outline-info"><i class="fa fa-plus"></i> Diskon order</button>
                    <button type="button" id="add_biaya" onclick="load_biaya_order()" disabled class="btn btn-outline-info"><i class="fa fa-plus"></i> Biaya lain</button>
                  </div>
                  <hr class="col-md-12" />
                  <table style="width:100%">
                    <tbody id='area_diskon_order'>

                    </tbody>
                  </table>
                  <table style="width:100%">
                    <tbody id='area_biaya_order'>

                    </tbody>
                  </table>
                  <table style="width:100%">
                    <thead>
                      <tr>
                        <th style='width:40%'>TOTAL</th>
                        <th style='width:20%'><input type='hidden' name='total' value='0' /></th>
                        <th style='width:10%'></th>
                        <th style='width:20%' id='total'>Rp. 0</th>
                        <th></th>
                      </tr>
                    </thead>
                  </table>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-8">
      <div class="card">
        <div id="panel_editor" class="card-body collapse in">
          <div class="card-block">
            <div class="form-body">
              <div class="col-md-12">
                <fieldset class="col-sm-6">
                  <h5>Status Pembayaran</h5>
                  <div class="input-group input-group-lg">
                    <select id="status_pembayaran" name="status_pembayaran" onchange="set_pembayaran(this)" class="form-control cannot-null">
                      <option value="unpaid">Belum bayar</option>
                      <option value="installment">Down Payment</option>
                      <option value="paid">Lunas</option>
                    </select>
                    <span class="text-danger"></span>
                    <?= form_error('status_data', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-6 installment paid" style="display:none">
                  <h5>Tanggal Bayar</h5>
                  <div class="input-group input-group-lg">
                    <input type="text" name="tanggal_bayar" id="tanggal_bayar" class="form-control" placeholder="Format tanggal (dd-MM-yyyy)" value="<?= date('d-m-Y'); ?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                  <span class="text-danger"></span>
                </fieldset>
                <fieldset class="col-sm-6 installment paid" style="display:none">
                  <h5>Bank Pembayaran</h5>
                  <div class="input-group input-group-lg">
                    <select class="form-control select2" id="m_bank" name="m_bank" style="width: 100%;">
                    </select>
                    <span class="text-danger"></span>
                  </div>
                </fieldset>
                <fieldset class="col-sm-6 installment" style="display:none">
                  <h5>Nominal</h5>
                  <div class="input-group input-group-lg">
                    <input id="nominal_pembayaran" name="nominal_pembayaran" class="form-control format_currency" type="text" value="" />
                  </div>
                  <span class="text-danger"></span>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-actions col-md-12">
      <div class="text-xs-right">
        <button id="btn_save" onclick="save('<?= $status; ?>')" type="button" class="btn btn-info">Simpan <i class="icon-save position-right"></i></button>
        <a href="<?= base_url(); ?><?= $url; ?>/index/<?= $status; ?>" class="btn btn-info">Batal <i class="icon-arrow-left3 position-right"></i></a>
      </div>
    </div>
  </form>
</div>
<script>
  positive_integer_load();

  $("#biaya_kurir").attr("readonly", "readonly");

  $('body').on('keyup', '.format_currency', function() {
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

  $('#modal_area').on('keyup', '#persen', function() {
    var subtotal = $("[name='subtotal']").val();
    var persen = this.value;
    var nominal = (subtotal * persen) / 100
    $('#nominal').val(format_currency(nominal));
  });

  $("#name").autocomplete({
      source: "<?= base_url(); ?><?= $url; ?>/get_customer",
      minLength: 3,
      select: function(event, ui) {
        console.log('pelanggan:' + $('#temp_name_id').val());
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

        $("#cart_list").children().remove();
        $('#cart_list').append(`
          <tr class='cart-empty'>
            <td colspan="5" style='text-align:center'>Keranjang masih kosong</td>
          </tr>`);
        $('#total_qty').html('0');
        $('#subtotal').html('Rp 0');
        $('#total_berat').html('0Kg');
        $('#biaya_kurir').val('');
        $('#total').html('Rp 0');

        $('#area_diskon_order').children().remove();
        $('#area_biaya_order').children().remove();

        //input hidden
        $("[name='subtotal']").val('0');
        $("[name='total']").val("0");

        $('#m_kurir').val('0').trigger('change');
        $('#m_kurir').attr('disabled', 'disabled');

        $('#add_diskon').attr('disabled', 'disabled');
        $('#add_biaya').attr('disabled', 'disabled');
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
      source: "<?= base_url(); ?><?= $url; ?>/get_dikirim",
      minLength: 3,
      select: function(event, ui) {
        console.log('dikirim ke:' + $('#temp_dikirim_id').val());
        $('#hidden_dikirim_ke').val($('#temp_dikirim_id').val());
        $('#area-dikirim').hide();
        $('#area-dikirim-text').html(ui.item.value);
        $('#area-dikirim-text').show();
        $('#btn_edit_dikirim').show();
      },
    })
    .data("ui-autocomplete")._renderItem = function(ul, item) {
      let txt = String(item.value).replace(new RegExp(this.term, "gi"), "<b style='color:blue'>$&</b>");

      return $("<li></li>")
        .data("ui-autocomplete-item", item)
        .append("<div>" + txt + "</div>")
        .appendTo(ul);
    };

  $('#tanggal_bayar').datepicker({
    autoclose: true,
    todayHighlight: true,
    todayBtn: true,
    dateFormat: 'dd-mm-yy',
    maxDate: -0,
    orientation: 'bottom',
  });

  $('#tanggal_order').datepicker({
    autoclose: true,
    todayHighlight: true,
    todayBtn: true,
    dateFormat: 'dd-mm-yy',
    maxDate: -0,
    orientation: 'bottom',
  });

  // var data = [{
  //   id: 0,
  //   text: '<div style="color:green">enhancement</div>',
  //   html: '<div style="color:green">enhancement</div><div><b>Select2</b> supports custom themes using the theme option so you can style Select2 to match the rest of your application.</div>',
  //   title: 'enchancement'
  // }, {
  //   id: 1,
  //   text: '<div style="color:red">bug</div>',
  //   html: '<div style="color:red">bug</div><div><small>This is some small text on a new line</small></div>',
  //   title: 'bug'
  // }];

  // $("#m_bank").select2({
  //   data: data,
  //   escapeMarkup: function(markup) {
  //     return markup;
  //   },
  //   templateResult: function(data) {
  //     return data.html;
  //   },
  //   templateSelection: function(data) {
  //     return data.text;
  //   }
  // })

  $("#m_bank").select2({
    ajax: {
      url: "<?= base_url(); ?><?= $url; ?>/get_bank",
      dataType: 'json',
      delay: 250,
      processResults: function(data, params) {
        return {
          results: data,
        };
      },
      cache: true
    },
    placeholder: "Pilih Bank",
    escapeMarkup: function(markup) {
      return markup;
    },
    templateResult: function(data) {
      return data.text;
    },
    templateSelection: function(data) {
      return data.html;
    }
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
      var string_preorder = jenis != 2 ? "PREORDER " + tempo + " HARI" : "";
      var produk = `
        <tr class='produk_varian_id_` + varian_id + `'>
          <td>
            <div class='col-md-12' style='padding:0px'>
              <div class='col-md-2' style='padding:0px'>
                <img src='<?= base_url(); ?>` + image + `' style='padding:0px; width:100%'>
                <input type='hidden' id='produk_image_` + varian_id + `' name='produk_image_` + varian_id + `' class='produk_image' value='` + image + `'/>
              </div>
              <div class='col-md-9' style='padding:0px 0px 0px 5px'>
                <span>` + name + `</span> <input type='hidden' id='produk_name_` + varian_id + `' name='produk_name_` + varian_id + `' class='produk_name' value='` + name + `'/></br>
                <small class='badge badge-info' style='font-size:10px'><b>` + ukuran + ` ` + warna + `</b></small> ` + preorder + ` <input type='hidden' id='produk_keterangan_` + varian_id + `' name='produk_keterangan_` + varian_id + `' class='produk_keterangan' value='` + ukuran + ` ` + warna + ` ` + string_preorder + `'/>
                <input type='hidden' class='berat_produk' value='` + (parseInt(berat) * parseInt(qty)) + `'/>
                <input type='hidden' name='m_produk_varian_id' value='` + varian_id + `'/>
              </div>
            </div>
          </td>
          <td>Rp ` + harga + `</td>
          <td id='area_qty_` + varian_id + `'>` + qty + `</td>
          <td id='area_price_` + varian_id + `'>Rp ` + format_currency((parseInt(qty) * parseInt(harga.replace(/\./g, '')))) + `</td>
          <td>
            <input type='hidden' id='produk_price_` + varian_id + `' name='produk_price_` + varian_id + `' class='produk_price' value='` + harga + `'/>
            <input type='hidden' id='produk_qty_` + varian_id + `' name='produk_qty_` + varian_id + `' class='produk_qty' value='` + qty + `'/>
            <input type='hidden' id='price_` + varian_id + `' class='price' value='` + (parseInt(qty) * parseInt(harga.replace(/\./g, ''))) + `'/>
            <button type='button' onclick='load_edit_cart("` + varian_id + `")' class='btn btn-warning btn-sm' style='padding:4px'><i class='fa fa-fw fa-edit position-right'></i></button>
            <button type='button' onclick='delete_cart("` + varian_id + `")' class='btn btn-danger btn-sm' style='padding:4px'><i class='fa fa-fw fa-trash position-right'></i></button>
          </td>
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

        $('#add_diskon').removeAttr('disabled');
        $('#add_biaya').removeAttr('disabled');
      }

      var biaya_kurir = $('#biaya_kurir').val();
      biaya_kurir = biaya_kurir == "" ? 0 : biaya_kurir;

      $('.diskon-persen').each(function() {
        var id = $(this).val();
        var persen = $('#diskon_persen_' + id).val();
        var nominal = (sum_price * persen) / 100;
        $('#diskon_nominal_' + id).val(nominal);
        $('#area_diskon_persen_' + id).html('(Rp ' + format_currency(nominal) + ')');
      });

      $('.biaya-persen').each(function() {
        console.log('id-diskon: ' + id);
        var id = $(this).val();
        var persen = $('#biaya_persen_' + id).val();
        var nominal = (sum_price * persen) / 100;
        $('#biaya_nominal_' + id).val(nominal);
        $('#area_biaya_persen_' + id).html('Rp ' + format_currency(nominal) + '');
      });

      var total_diskon = 0;
      $('.diskon-nominal').each(function() {
        var diskon = $(this).val();
        diskon = diskon == "" ? 0 : diskon;
        total_diskon += Number(diskon);
      });

      var total_biaya = 0;
      $('.biaya-nominal').each(function() {
        var biaya = $(this).val();
        biaya = biaya == "" ? 0 : biaya;
        total_biaya += Number(biaya);
      });

      var total = 0;
      total = (sum_price + biaya_kurir + total_biaya) - total_diskon;
      $('#total').html('Rp ' + format_currency(total));

      //input hidden
      $("[name='subtotal']").val(sum_price);
      $("[name='total']").val(total);
    }
  }

  function delete_cart(varian_id) {
    if (confirm('Are you sure you want to delete cart list?') === true) {
      $('.produk_varian_id_' + varian_id).remove();

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

      var biaya_kurir = $('#biaya_kurir').val();
      biaya_kurir = biaya_kurir == "" ? 0 : biaya_kurir;

      $('.diskon-persen').each(function() {
        var id = $(this).val();
        var persen = $('#diskon_persen_' + id).val();
        var nominal = (sum_price * persen) / 100;
        $('#diskon_nominal_' + id).val(nominal);
        $('#area_diskon_persen_' + id).html('(Rp ' + format_currency(nominal) + ')');
      });

      $('.biaya-persen').each(function() {
        var id = $(this).val();
        var persen = $('#biaya_persen_' + id).val();
        var nominal = (sum_price * persen) / 100;
        $('#biaya_nominal_' + id).val(nominal);
        $('#area_biaya_persen_' + id).html('Rp ' + format_currency(nominal) + '');
      });

      var total_diskon = 0;
      $('.diskon-nominal').each(function() {
        var diskon = $(this).val();
        diskon = diskon == "" ? 0 : diskon;
        total_diskon += Number(diskon);
      });

      var total_biaya = 0;
      $('.biaya-nominal').each(function() {
        var biaya = $(this).val();
        biaya = biaya == "" ? 0 : biaya;
        total_biaya += Number(biaya);
      });

      var total = 0;
      total = (sum_price + biaya_kurir + total_biaya) - total_diskon;
      $('#total').html('Rp ' + format_currency(total));

      //input hidden
      $("[name='subtotal']").val(sum_price);
      $("[name='total']").val(total);
    }
  }

  function load_edit_cart(varian_id) {
    $('#modal_area').modal('toggle');
    $('#modal_title').html('Edit Produk');
    $("#modal_form").html('');
    $("#modal_form").load("<?= $url; ?>/load_edit_cart/" + varian_id);
  }

  function edit_cart(varian_id) {
    $('#modal_area').modal('toggle');

    var produk_price = $('#produk_price_' + varian_id).val().replace(/\./g, '').replace(/\,/g, '');
    var qty = $('#qty_varian_' + varian_id).val();
    var price = (parseInt(produk_price) * parseInt(qty))

    $('#produk_qty_' + varian_id).val(qty);
    $('#price_' + varian_id).val(price);
    $('#area_qty_' + varian_id).html(qty);
    $('#area_price_' + varian_id).html('Rp ' + price);

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

    var biaya_kurir = $('#biaya_kurir').val();
    biaya_kurir = biaya_kurir == "" ? 0 : biaya_kurir;

    $('.diskon-persen').each(function() {
      var id = $(this).val();
      var persen = $('#diskon_persen_' + id).val();
      var nominal = (sum_price * persen) / 100;
      $('#diskon_nominal_' + id).val(nominal);
      $('#area_diskon_persen_' + id).html('(Rp ' + format_currency(nominal) + ')');
    });

    $('.biaya-persen').each(function() {
      var id = $(this).val();
      var persen = $('#biaya_persen_' + id).val();
      var nominal = (sum_price * persen) / 100;
      $('#biaya_nominal_' + id).val(nominal);
      $('#area_biaya_persen_' + id).html('Rp ' + format_currency(nominal) + '');
    });

    var total_diskon = 0;
    $('.diskon-nominal').each(function() {
      var diskon = $(this).val();
      diskon = diskon == "" ? 0 : diskon;
      total_diskon += Number(diskon);
    });

    var total_biaya = 0;
    $('.biaya-nominal').each(function() {
      var biaya = $(this).val();
      biaya = biaya == "" ? 0 : biaya;
      total_biaya += Number(biaya);
    });

    var total = 0;
    total = (sum_price + biaya_kurir + total_biaya) - total_diskon;
    $('#total').html('Rp ' + format_currency(total));

    //input hidden
    $("[name='subtotal']").val(sum_price);
    $("[name='total']").val(total);

    $("#modal_form").html('');
  }

  function edit_name() {
    $('#temp_name_id').remove();
    $('#temp_dikirim_id').remove();
    $('#name').val('');
    $('#hidden_name').val('');
    $('#area-name').show();
    $('#area-name-text').html('');
    $('#area-name-text').hide();
    $('#btn_edit_name').hide();
  }

  function edit_dikirim() {
    $('#temp_name_id').remove();
    $('#temp_dikirim_id').remove();
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
      $("#biaya_kurir").attr("readonly", "readonly")
    } else if (id == 1) {
      $("#biaya_kurir").val('0')
      $("#biaya_kurir").attr("readonly", "readonly")
    } else {
      $("#biaya_kurir").removeAttr("readonly");
    }
  }

  function load_diskon_order() {
    $('#modal_area').modal('toggle');
    $('#modal_title').html('Diskon Order');
    $("#modal_form").html('');
    $("#modal_form").load("<?= $url; ?>/load_diskon_order/");
  }

  function change_diskon(elemen) {
    var value = elemen.value;
    if (value == "nominal") {
      $('#persen').hide();
      $('#persen').val('0');
      $('#nominal').removeAttr('readonly');
    } else {
      $('#persen').show();
      $('#nominal').val('0');
      $('#nominal').attr('readonly', 'readonly');
    }
  }

  function tambah_diskon() {
    var name = $('#name_diskon_order').val();
    var diskon_option = $('#diskon_option').val();
    var persen = $('#persen').val();
    var nominal = $('#nominal').val().replace(/\./g, '').replace(/\,/g, '');

    var jumlah_diskon = $('#area_diskon_order').find('.kode-diskon').length;
    var id = (jumlah_diskon + 1);

    var diskon = "";
    if (diskon_option == "nominal") {
      diskon = `
      <tr id='area_diskon_` + id + `'>
        <td colspan='3' style='width:70%'>Diskon Order - ` + name + `</td>
        <td class='text-danger' style='width:20%'>(Rp ` + format_currency(nominal) + `)</td>
        <td>
          <input type='hidden' class='kode-diskon' name='kode_diskon' value='` + id + `' />
          <input type='hidden' id='diskon_name_` + id + `' name='diskon_name_` + id + `' value='` + name + `' />
          <input type='hidden' id='diskon_option_` + id + `' name='diskon_option_` + id + `' value='` + diskon_option + `' />
          <input type='hidden' id='diskon_persen_` + id + `' name='diskon_persen_` + id + `' value='` + persen + `' />
          <input type='hidden' id='diskon_nominal_` + id + `' class='diskon-nominal' name='diskon_nominal_` + id + `' value='` + nominal + `' />
          <button type='button' onclick='hapus_diskon("` + id + `")' class='btn btn-info btn-sm'><i class='fa fa-fw fa-trash position-right'></i></button>
        </td>
      </tr>
      `;
    } else {
      diskon = `
      <tr id='area_diskon_` + id + `'>
        <td colspan='3' style='width:70%'>Diskon Order ` + persen + `% - ` + name + `</td>
        <td class='text-danger' style='width:20%' id='area_diskon_persen_` + id + `'>(Rp ` + format_currency(nominal) + `)</td>
        <td>
          <input type='hidden' class='kode-diskon diskon-persen' name='kode_diskon' value='` + id + `' />
          <input type='hidden' id='diskon_name_` + id + `' name='diskon_name_` + id + `' value='` + name + `' />
          <input type='hidden' id='diskon_option_` + id + `' name='diskon_option_` + id + `' value='` + diskon_option + `' />
          <input type='hidden' id='diskon_persen_` + id + `' name='diskon_persen_` + id + `' value='` + persen + `' />
          <input type='hidden' id='diskon_nominal_` + id + `' class='diskon-nominal' name='diskon_nominal_` + id + `' value='` + nominal + `' />
          <button type='button' onclick='hapus_diskon("` + id + `")' class='btn btn-info btn-sm'><i class='fa fa-fw fa-trash position-right'></i></button>
        </td>
      </tr>
      `;
    }
    var error = validate_form("modal_form");
    if (error == 0) {
      $('#area_diskon_order').append(diskon);

      var subtotal = $("[name='total']").val();
      var total = (parseInt(subtotal) - parseInt(nominal));
      $("[name='total']").val(total);
      $('#total').html('Rp ' + format_currency(total));

      $('#modal_area').modal('toggle');
      $("#modal_form").html('');
    }
  }

  function hapus_diskon(id) {
    var nominal = $('#diskon_nominal_' + id).val();
    var subtotal = $("[name='total']").val();
    var total = (parseInt(subtotal) + parseInt(nominal));
    $("[name='total']").val(total);
    $('#total').html('Rp ' + format_currency(total));
    $('#area_diskon_' + id).remove();
  }

  function load_biaya_order(id = "") {
    $('#modal_area').modal('toggle');
    $('#modal_title').html('Biaya Lain');
    $("#modal_form").html('');
    $("#modal_form").load("<?= $url; ?>/load_biaya_order/" + id);
  }

  function change_biaya(elemen) {
    var value = elemen.value;
    if (value == "nominal") {
      $('#persen').hide();
      $('#persen').val('0');
      $('#nominal').removeAttr('readonly');
    } else {
      $('#persen').show();
      $('#nominal').val('0');
      $('#nominal').attr('readonly', 'readonly');
    }
  }

  function tambah_biaya() {
    var name = $('#name_biaya_order').val();
    var diskon_option = $('#biaya_option').val();
    var persen = $('#persen').val();
    var nominal = $('#nominal').val().replace(/\./g, '').replace(/\,/g, '');

    var jumlah_diskon = $('#area_biaya_order').find('.kode-biaya').length;
    var id = (jumlah_diskon + 1);

    var diskon = "";
    if (diskon_option == "nominal") {
      diskon = `
      <tr id='area_biaya_` + id + `'>
        <td colspan='3' style='width:70%'>Biaya Lain - ` + name + `</td>
        <td style='width:20%'> Rp ` + format_currency(nominal) + `</td>
        <td>
          <input type='hidden' class='kode-biaya' name='kode_biaya' value='` + id + `' />
          <input type='hidden' id='biaya_name_` + id + `' name='biaya_name_` + id + `' value='` + name + `' />
          <input type='hidden' id='biaya_option_` + id + `' name='biaya_option_` + id + `' value='` + diskon_option + `' />
          <input type='hidden' id='biaya_persen_` + id + `' name='biaya_persen_` + id + `' value='` + persen + `' />
          <input type='hidden' id='biaya_nominal_` + id + `' class='biaya-nominal' name='biaya_nominal_` + id + `' value='` + nominal + `' />
          <button type='button' onclick='hapus_biaya("` + id + `")' class='btn btn-info btn-sm'><i class='fa fa-fw fa-trash position-right'></i></button>
        </td>
      </tr>
      `;
    } else {
      diskon = `
      <tr id='area_biaya_` + id + `'>
        <td colspan='3' style='width:70%'>Biaya Lain ` + persen + `% - ` + name + `</td>
        <td style='width:20%' id='area_biaya_persen_` + id + `'> Rp ` + format_currency(nominal) + `</td>
        <td>
          <input type='hidden' class='kode-biaya biaya-persen' name='kode_biaya' value='` + id + `' />
          <input type='hidden' id='biaya_name_` + id + `' name='biaya_name_` + id + `' value='` + name + `' />
          <input type='hidden' id='biaya_option_` + id + `' name='biaya_option_` + id + `' value='` + diskon_option + `' />
          <input type='hidden' id='biaya_persen_` + id + `' name='biaya_persen_` + id + `' value='` + persen + `' />
          <input type='hidden' id='biaya_nominal_` + id + `' class='biaya-nominal' name='biaya_nominal_` + id + `' value='` + nominal + `' />
          <button type='button' onclick='hapus_biaya("` + id + `")' class='btn btn-info btn-sm'><i class='fa fa-fw fa-trash position-right'></i></button>
        </td>
      </tr>
      `;
    }
    var error = validate_form("modal_form");
    if (error == 0) {
      $('#area_biaya_order').append(diskon);

      var subtotal = $("[name='total']").val();
      var total = (parseInt(subtotal) + parseInt(nominal));
      $("[name='total']").val(total);
      $('#total').html('Rp ' + format_currency(total));

      $('#modal_area').modal('toggle');
      $("#modal_form").html('');
    }
  }

  function hapus_biaya(id) {
    var nominal = $('#biaya_nominal_' + id).val();
    var subtotal = $("[name='total']").val();
    var total = (parseInt(subtotal) - parseInt(nominal));
    $("[name='total']").val(total);
    $('#total').html('Rp ' + format_currency(total));
    $('#area_biaya_' + id).remove();
  }

  function set_pembayaran(elemen) {
    if (elemen.value == "unpaid") {
      $('.installment').hide();
      $('.paid').hide();
      $('#nominal_pembayaran').removeClass('cannot-null');
    } else if (elemen.value == "installment") {
      $('.paid').hide();
      $('.installment').show();
      $('#nominal_pembayaran').addClass('cannot-null');
    } else if (elemen.value == "paid") {
      $('.installment').hide();
      $('.paid').show();
      $('#nominal_pembayaran').removeClass('cannot-null');
    }
  }
</script>