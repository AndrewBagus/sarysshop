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
      <div class="card col-md-10">
        <div class="card-header">
          <h4 class="card-title" id="title_header">Tambah <?= $title; ?></h4>
          <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        </div>
        <div id="panel_editor" class="card-body collapse in">
          <div class="card-block">
            <form id="form_creator" class="form-horizontal" action="#">
              <div class="form-body">
                <fieldset class="col-sm-6">
                  <h5>Nama Pengeluaran</h5>
                  <div class="input-group input-group-lg">
                    <input id="name" name="name" class="form-control cannot-null" type="text" maxlength="100" value="<?= set_value('name') ? set_value('name') : $data['name']; ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('email', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-6">
                  <h5>Tanggal</h5>
                  <div class="input-group input-group-lg">
                    <input type="text" name="date" id="date" class="form-control cannot-null" placeholder="Format tanggal (dd-MM-yyyy)" value="<?= set_value('date') ? set_value('date') : $data['date']; ?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                  <script type='text/javascript'>
                    $('#date').datepicker({
                      autoclose: true,
                      todayHighlight: true,
                      todayBtn: true,
                      dateFormat: 'dd-mm-yy',
                      maxDate: -0,
                      orientation: 'bottom',
                    });
                  </script>
                  <span class="text-danger"></span>
                  <?= form_error('date', '<span class="text-danger"></span>'); ?>
                </fieldset>
                <fieldset class="col-sm-8">
                  <h5>Biaya</h5>
                  <div class="input-group input-group-lg">
                    <input id="biaya" name="biaya" class="form-control cannot-null format_currency" type="text" value="<?= number_format(set_value('biaya') ? set_value('biaya') : $data['biaya'], 0, ',', ','); ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('biaya', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-4">
                  <h5>Jumlah</h5>
                  <div class="input-group input-group-lg">
                    <input id="jumlah" name="jumlah" class="form-control positive-integer cannot-null positive-integer" type="text" value="<?= set_value('jumlah') ? set_value('jumlah') : $data['jumlah']; ?>" />
                    <span class="text-danger"></span>
                    <?= form_error('jumlah', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
                <fieldset class="col-sm-12">
                  <h5>Keterangan</h5>
                  <div class="input-group input-group-lg">
                    <textarea id="keterangan" name="keterangan" rows="3" class="form-control cannot-null" type="text"><?= set_value('keterangan') ? set_value('keterangan') : $data['keterangan']; ?></textarea>
                    <span class="text-danger"></span>
                    <?= form_error('keterangan', '<span class="text-danger"></span>'); ?>
                  </div>
                </fieldset>
              </div>
              <div class="form-actions">
                <h3 class="col-md-8">Total:</h3>
                <div class="text-xs-right col-md-4 row">
                  <h3>Rp <span id="nilai_total"><?= number_format($data['total'], 0, '.', '.'); ?></span></h3>
                </div>
              </div>
              <div class="text-xs-right">
                <button id="btn_edit" onclick="edit('<?= $data['id']; ?>')" type="button" class="btn btn-info">Ubah <i class="icon-save position-right"></i></button>
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

  $('#biaya').on('keyup', function() {
    var jumlah = $('#jumlah').val();
    jumlah = jumlah == 0 ? 1 : jumlah == "" ? 1 : jumlah;
    $('#nilai_total').html(format_currency((this.value.replace(/,/g, "") * jumlah)));
  });

  $('#jumlah').on('keyup', function() {
    if (this.value != "") {
      this.value = (parseInt(this.value));
    }

    var biaya = $('#biaya').val();
    var jumlah = this.value == 0 ? 1 : this.value == "" ? 1 : this.value;
    $('#nilai_total').html(format_currency((jumlah * biaya.replace(/,/g, ""))));
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
</script>