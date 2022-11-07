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
<div class="content-body">
  <div class="">
    <div class="col-xs-12">
      <form id="form_creator" class="form-horizontal" enctype='multipart/form-data' action="#">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="title_header">Tambah <?= $title; ?></h4>
            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
          </div>
          <div id="panel_editor" class="card-body collapse in">
            <div class="card-block">
              <div class="form-body">
                <div class="col-md-10">
                  <fieldset class="col-sm-12">
                    <h5>Nama Produk</h5>
                    <div class="input-group input-group-lg">
                      <input id="name" name="name" class="form-control cannot-null" type="text" maxlength="100" value="<?= set_value('name'); ?>" />
                      <span class="text-danger"></span>
                      <?= form_error('email', '<span class="text-danger"></span>'); ?>
                    </div>
                  </fieldset>
                  <fieldset class="col-sm-10">
                    <h5>Supplier</h5>
                    <div class="input-group input-group-lg">
                      <select class="form-control select2 cannot-null" style="padding: 0 0 0 12px !important" id="m_supplier_id" name="m_supplier_id" placeholder="Cari Supplier">
                      </select>
                      <div class="form-control-position" style="padding:7px">
                        <i class="fa fa-search info font-medium-5"></i>
                      </div>
                      <span class="text-danger"></span>
                      <?= form_error('m_supplier_id', '<span class="text-danger"></span>'); ?>
                    </div>
                  </fieldset>
                  <fieldset class="col-sm-4">
                    <h5>Jenis Produk</h5>
                    <div class="input-group input-group-lg">
                      <select class="form-control select" id="m_jenis_produk_id" name="m_jenis_produk_id" style="width: 100%;">
                        <?php
                        foreach ($jenis_produk as $row) {
                        ?>
                          <option value="<?= $row['id'] ?>" <?= set_value('jenis_produk_id') ? 'active' : ''; ?>><?= $row['name'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <?= form_error('jenis_produk', '<span class="text-danger"></span>'); ?>
                  </fieldset>
                  <fieldset class="col-sm-4">
                    <h5>Kategori Produk</h5>
                    <div class="input-group input-group-lg">
                      <select class="form-control select" id="m_kategori_produk_id" name="m_kategori_produk_id" style="width: 100%;">
                        <?php
                        foreach ($kategori_produk as $row) {
                        ?>
                          <option value="<?= $row['id'] ?>" <?= set_value('kategori_produk_id') ? 'active' : ''; ?>><?= $row['name'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <span class="input-group-addon btn btn-info" onclick="open_category_product()"><i class="icon-plus white position-right"></i></span>
                    </div>
                    <?= form_error('kategori_produk', '<span class="text-danger"></span>'); ?>
                  </fieldset>
                  <fieldset class="col-md-4" style="margin-bottom:5px">
                    <h5>Tempo Kedatangan</h5>
                    <div class="input-group input-group-lg">
                      <input name="tempo_kedatangan_barang" class="form-control cannot-null positive-integer" type="text" value="0" />
                      <span class="input-group-addon">Hari</span>
                    </div>
                    <span class="text-danger"></span>
                  </fieldset>
                  <fieldset class="col-sm-12">
                    <h5>Keterangan Produk</h5>
                    <div class="input-group input-group-lg">
                      <textarea id="keterangan" name="keterangan" rows="5" class="form-control cannot-null" type="text"><?= set_value('keterangan'); ?></textarea>
                      <span class="text-danger"></span>
                      <?= form_error('keterangan', '<span class="text-danger"></span>'); ?>
                    </div>
                  </fieldset>

                  <fieldset class="col-sm-5">
                    <h5>Varian</h5>
                    <div class="input-group input-group-lg">
                      <input id="is_varian" name="is_varian" onchange="set_varian()" type="checkbox" class="switchBootstrap form-control" />
                    </div>
                  </fieldset>
                </div>
                <fieldset class="col-sm-2">
                  <h5>Thumbnail</h5>
                  <div class="input-group input-group-lg">
                    <img src="<?= base_url(); ?>app_assets\img\add-image.png" class="image-uploader" id="thumbnail_1" var="1" image="1" style="max-width:120px;max-height:120px;border-radius:20%;cursor:pointer;border-style:dashed;padding:2px;margin-bottom:5px" />
                    <input type="file" class="" id="upload_thumbnail_1" name="upload_thumbnail_1" style="display:none">
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div id="panel_editor" class="card-body collapse in">
            <div class="card-block">
              <div class="form-body">
                <div class="col-md-12" style="margin-bottom:10px;display:none" id="area_btn_add"><button id="btn_add" type="button" class="btn btn-info" style="float:right" onclick="duplicate_varian()">Tambah Varian <i class="icon-plus-square white position-right"></i></button></div>
                <table id="table_editor" class="table table-striped table-bordered table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th style="width:5%"> No </th>
                      <th style="width:10%"> Gambar</th>
                      <th style="width:20%"> Spesifikasi </th>
                      <th style="width:45%"> Harga </th>
                      <th style="width:20%"> Informasi Produk </th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="body_varian">
                    <tr>
                      <td>1</td>
                      <td>
                        <div id="image_area">
                          <div class="varian"></div>
                          <div id="area_varian_1_image_1">
                            <img src="<?= base_url(); ?>app_assets\img\add-image.png" class="image-uploader" id="image_1" var="1" image="1" style="max-width:120px;max-height:120px;border-radius:20%;cursor:pointer;border-style:dashed;padding:2px;margin-bottom:5px" />
                            <input type="file" class="" id="upload_image_1" name="upload_image_1" style="display:none">
                            <span class="text-danger"></span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <fieldset class="col-md-12" style="margin-bottom:5px">
                          <h7>SKU</h7>
                          <div class="input-group input-group-sm">
                            <input name="code_1" id="code_1" class="form-control cannot-null code-varian" type="text" maxlength="15" />
                            <input name="no_varian" id="no_varian_1" class="form-control" type="hidden" value="1" />
                            <span class="input-group-addon btn btn-blue btn-code" id="btn_code_1"><i class="fa fa-rotate"></i></span>
                          </div>
                          <span class="text-danger"></span>
                        </fieldset>
                        <fieldset class="col-md-12" style="margin-bottom:5px">
                          <h7>Berat</h7>
                          <div class="input-group input-group-sm">
                            <input name="berat_1" class="form-control cannot-null positive-integer" type="text" />
                            <span class="input-group-addon">gram</span>
                          </div>
                          <span class="text-danger"></span>
                        </fieldset>
                      </td>
                      <td>
                        <fieldset class="col-md-6" style="margin-bottom:5px">
                          <h7>Harga Beli</h7>
                          <div class="input-group input-group-sm">
                            <input name="harga_beli_1" class="form-control cannot-null format_currency" type="text" />
                            <span class="text-danger"></span>
                          </div>
                        </fieldset>
                        <?php
                        foreach ($kategori_pelanggan as $row) {
                        ?>
                          <fieldset class="col-md-6" style="margin-bottom:5px">
                            <h7>Harga Jual <?= $row['name']; ?></h7>
                            <div class="input-group input-group-sm">
                              <input name="harga_jual_1_<?= $row['id']; ?>" class="form-control cannot-null format_currency" type="text" />
                              <span class="text-danger"></span>
                            </div>
                          </fieldset>
                        <?php
                        }
                        ?>
                      </td>
                      <td>
                        <fieldset class="col-md-12" style="margin-bottom:5px">
                          <h7>Ukuran</h7>
                          <div class="input-group input-group-sm">
                            <input name="ukuran_1" class="form-control cannot-null" type="text" maxlength="25" />
                            <span class="text-danger"></span>
                          </div>
                        </fieldset>
                        <fieldset class="col-md-12" style="margin-bottom:5px">
                          <h7>Warna</h7>
                          <div class="input-group input-group-sm">
                            <input name="warna_1" class="form-control cannot-null" type="text" maxlength="25" />
                            <span class="text-danger"></span>
                          </div>
                        </fieldset>
                        <fieldset class="col-md-12" style="margin-bottom:5px">
                          <h7>Stok</h7>
                          <div class="input-group input-group-sm">
                            <input name="stok_1" class="form-control cannot-null positive-integer" type="text" value="0" />
                            <span class="text-danger"></span>
                          </div>
                        </fieldset>
                      </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form-actions">
                <div class="text-xs-right">
                  <button id="btn_save" onclick="save()" type="button" class="btn btn-info">Simpan <i class="icon-save position-right"></i></button>
                  <a href="<?= base_url(); ?><?= $url; ?>" class="btn btn-info">Batal <i class="icon-arrow-left3 position-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  positive_integer_load();

  $("#m_supplier_id").select2({
    ajax: {
      url: "<?= base_url(); ?><?= $url; ?>/get_supplier",
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
    placeholder: "Cari Supplier",
  });
  $('.select2-selection__arrow').remove();

  switch_bootstrap('is_varian', 'Ya', 'Tidak');

  var no = 1;

  function duplicate_upload(varian, image) {
    var html = "<div id='area_varian_" + varian + "_image_" + image + "'><img src='<?= base_url(); ?>app_assets/img/add-image.png' class='image-uploader' id='varian_" + varian + "_image_" + image + "' var='" + varian + "' image='" + image + "' style='max-width:120px;max-height:120px;border-radius:20%;cursor:pointer;border-style:dashed;padding:2px;margin-bottom:5px'/><input type='file' id='upload_varian_" + varian + "_image_" + image + "' name='upload_varian_" + varian + "_image_" + image + "' style='display:none'><a id='hapus_varian_" + varian + "_image_" + image + "' onclick='hapus_gambar(this.id)'>hapus gambar</a></div>";
    $("#image_area").append(html);
  }

  function duplicate_varian() {
    no++;
    var html =
      `<tr id='varian_no_` + no + `'>
        <td>` + no + `</td>
        <td>
          <div id='image_area'>
            <div class='varian'></div>
            <div id='area_varian_` + no + `_image_1'>
              <img src='<?= base_url(); ?>app_assets/img/add-image.png' class='image-uploader' id='image_` + no + `' var='` + no + `' image='1' style='max-width:120px;max-height:120px;border-radius:20%;cursor:pointer;border-style:dashed;padding:2px;margin-bottom:5px' />
              <input type='file' class='' id='upload_image_` + no + `' name='upload_image_` + no + `' style='display:none'>
              <span class='text-danger'></span>
            </div>
          </div>
        </td>
        <td>
          <fieldset class='col-md-12' style='margin-bottom:5px'>
            <h7>SKU</h7>
            <div class='input-group input-group-sm'>
              <input name='code_` + no + `' id='code_` + no + `' class='form-control cannot-null code-varian' type='text' maxlength='15' />
              <input name='no_varian' id='no_varian_` + no + `' class='form-control' type='hidden' value='` + no + `' />
              <span class='input-group-addon btn btn-blue btn-code' id='btn_code_` + no + `'><i class='fa fa-rotate'></i></span>
            </div>
            <span class='text-danger'></span>
          </fieldset>
          <fieldset class='col-md-12' style='margin-bottom:5px'>
            <h7>Berat</h7>
            <div class='input-group input-group-sm'>
              <input name='berat_` + no + `' class='form-control cannot-null positive-integer' type='text' />
              <span class='input-group-addon'>gram</span>
            </div>
            <span class='text-danger'></span>
          </fieldset>
        </td>
        <td>
          <fieldset class='col-md-6' style='margin-bottom:5px'>
            <h7>Harga Beli</h7>
            <div class='input-group input-group-sm'>
              <input name='harga_beli_` + no + `' class='form-control cannot-null format_currency' type='text'/>
              <span class='text-danger'></span>
            </div>
          </fieldset>
          <?php
          foreach ($kategori_pelanggan as $row) {
          ?>
              <fieldset class='col-md-6' style='margin-bottom:5px'>
                <h7>Harga Jual <?= $row['name']; ?></h7>
                <div class='input-group input-group-sm'>
                  <input name='harga_jual_` + no + `_<?= $row['id']; ?>' class='form-control cannot-null format_currency' type='text' />
                  <span class='text-danger'></span>
                </div>
              </fieldset>
            <?php
          }
            ?>
        </td>
        <td>
          <fieldset class='col-md-12' style='margin-bottom:5px'>
            <h7>Ukuran</h7>
            <div class='input-group input-group-sm'>
              <input name='ukuran_` + no + `' class='form-control cannot-null' type='text' maxlength='25' />
              <span class='text-danger'></span>
            </div>
          </fieldset>
          <fieldset class='col-md-12' style='margin-bottom:5px'>
            <h7>Warna</h7>
            <div class='input-group input-group-sm'>
              <input name='warna_` + no + `' class='form-control cannot-null' type='text' maxlength='25' />
              <span class='text-danger'></span>
            </div>
          </fieldset>
          <fieldset class='col-md-12' style='margin-bottom:5px'>
            <h7>Stok</h7>
            <div class='input-group input-group-sm'>
              <input name='stok_` + no + `' class='form-control cannot-null positive-integer' type='text' value='0' />
              <span class='text-danger'></span>
            </div>
          </fieldset>
        </td>
        <td><button type='button' id='btn_remove_` + no + `' class='btn btn-info btn-sm remove-varian'><i class='fa fa-fw fa-trash position-right'></i></button></td>
      </tr>`;
    $("#body_varian").append(html);
    positive_integer_load();
  }

  $(function() {
    $("#form_creator").on('change', ':file', function(event) {
      if (this.files && this.files[0]) {
        $("#" + this.id.replace("upload_", "")).attr("src", URL.createObjectURL(event.target.files[0]));
        // var varian = (this.id).split("_")[2];
        // var image = (this.id).split("_")[4];
        // if ($("#varian_" + varian + "_image_" + (parseInt(image) + 1)).length == 0) {
        //   if (parseInt(image) < 5) {
        //     duplicate_upload(varian, (parseInt(image) + 1));
        //   }
        // }

      }
    });
  });

  $("#form_creator").on("click", ".image-uploader", function() {
    $("#upload_" + this.id).click();
  });

  function hapus_gambar(id) {
    var varian = (id).split("_")[2];
    var image = (id).split("_")[4];
    $("#area_varian_" + varian + "_image_" + image).remove();
  }

  function set_varian() {
    if ($("#is_varian").is(":checked") == true) {
      $("#area_btn_add").show();
    } else {
      $("#area_btn_add").hide();
    }
  }

  $("#form_creator").on("click", ".btn-code", function() {
    var gen_code = "PV-" + generate_code();
    var no = (this.id).split("_")[2];
    $('#code_' + no).val(gen_code);

    var id = 'code_' + no;
    var code = gen_code;

    var form = $('#form_creator').get(0);
    var formData = new FormData(form);
    formData.append('code', code);
    $.ajax({
        url: '<?= base_url() ?><?= $url; ?>/checking_code',
        type: 'post',
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
      }).done(function(result) {
        if (result.status === false) {
          $('#' + id).parent().parent().find('.text-danger').text("SKU sudah terpakai!");
        } else {
          $('#' + id).parent().parent().find('.text-danger').text("");
        }
      }).fail(function(xhr, status, error) {
        console.log(error);
      })
      .always(function() {

      });
  });

  function delete_varian(varian) {
    $('#varian_no_' + id).remove();
  }

  $("#table_editor").on("click", ".remove-varian", function() {
    if (confirm('Apakah anda yakin menghapus varian ini?') === true) {
      var element = $('#' + this.id).parent().parent();
      element.remove();
    }
  });

  $('#form_creator').on('change', '.code-varian', function() {
    var id = this.id;
    var code = $('#' + this.id).val();

    var form = $('#form_creator').get(0);
    var formData = new FormData(form);
    formData.append('code', code);
    $.ajax({
        url: '<?= base_url() ?><?= $url; ?>/checking_code',
        type: 'post',
        dataType: 'json',
        contentType: false,
        processData: false,
        data: formData,
      }).done(function(result) {
        if (result.status === false) {
          $('#' + id).parent().parent().find('.text-danger').text("SKU sudah terpakai!");
        } else {
          $('#' + id).parent().parent().find('.text-danger').text("");
        }
      }).fail(function(xhr, status, error) {
        console.log(error);
      })
      .always(function() {

      });

    // $(".code-varian").each(function() {
    //     if (id != this.id) {
    //       var get_code = $('#' + this.id).val();

    //       if (get_code != "") {
    //         if (code == get_code) {
    //           $('#' + id).parent().parent().find('.text-danger').text("SKU sudah terpakai!");
    //         } else {
    //           $('#' + id).parent().parent().find('.text-danger').text("");
    //         }
    //       }
    //     }
    //   });
  });

  $('#form_creator').on('keyup', '.format_currency', function() {
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
</script>