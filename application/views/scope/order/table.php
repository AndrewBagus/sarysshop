<?php
function search($array, $key, $value)
{
  $results = [];

  if (is_array($array)) {
    if (isset($array[$key]) && $array[$key] == $value) {
      $results[] = $array;
    }

    foreach ($array as $subarray) {
      $results = array_merge($results, search($subarray, $key, $value));
    }
  }

  return $results;
}

function tgl_indo($tanggal)
{
  $hari = array(
    1 =>   'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
  );
  $split_time = explode(' ', $tanggal);
  $split_tanggal = explode('-', $split_time[0]);

  return  $hari[(int)$split_tanggal[3]] . ', ' . $split_tanggal[2] . ' ' . $split_tanggal[1] . ' ' . $split_tanggal[0] . ' ' . $split_time[1];
}
?>
<?php
?>
<h3><?= $total_rows; ?> order ditemukan</h3>
<?php
foreach ($table as $row) {
  $badge_color = 'badge badge-danger';
  $status_pembayaran = 'Belum Bayar';
  if ($row['status_pembayaran'] == 'installment') {
    $badge_color = 'badge badge-warning';
    $status_pembayaran = 'Down Payment';
  } else if ($row['status_pembayaran'] == 'paid') {
    $badge_color = 'badge badge-success';
    $status_pembayaran = 'Lunas';
  }
  $date = date_create($row['tanggal_order']);
  $estimasi = $row['estimasi_pengiriman'];
  $id = $row['id'];
  date_add($date, date_interval_create_from_date_string("$estimasi days"));

  $diproses_color = 'color:grey';
  $dikirim_color = 'color:grey';
  $diterima_color = 'color:grey';
  if ($row['status_order'] == 'Di Proses') {
    $diproses_color = 'color:green';
  }
  if ($row['status_order'] == 'Pengiriman') {
    $diproses_color = 'color:green';
    $dikirim_color = 'color:green';
  }
  if ($row['status_order'] == 'Terkirim') {
    $diproses_color = 'color:green';
    $dikirim_color = 'color:green';
    $diterima_color = 'color:green';
  }
?>
  <div class="card">
    <div class="card-header">
      <div class="col-md-6" style="padding:0px">
        <div class="col-md-1" style="padding:0px">
          <a href="#">#<?= $row['id']; ?></a>
        </div>
        <div class="col-md-8" style="padding:0px">
          <small class="tag tag-orange"><i class="fa-solid fa-clock"></i> Estimasi Pengiriman <?= date_format($date, "Y-m-d"); ?></small>
        </div>
        <div class="col-md-12" style="padding:0px">
          (<?= tgl_indo(date('Y-M-d-N H:i:s', strtotime($row['tanggal_order']))); ?>)
        </div>
      </div>
      <div class="col-md-6" style="padding:0px;margin-top:10px">
        <h6 style="float:right;margin:0px;margin-left:5px;margin-right:5px"><i style="<?= $diterima_color; ?>" class="fa fa-house-circle-check fa-xl"></i></h6>
        <h6 style="float:right;margin:0px"><i style="<?= $diterima_color; ?>" class="fa fa-arrow-right"></i></h6>
        <h6 style="float:right;margin:0px;margin-left:5px;margin-right:5px"><i style="<?= $dikirim_color; ?>" class="fa fa-truck fa-xl"></i></h6>
        <h6 style="float:right;margin:0px"><i style="<?= $dikirim_color; ?>" class="fa fa-arrow-right"></i></h6>
        <h6 style="float:right;margin:0px;margin-left:5px;margin-right:5px"><i style="<?= $diproses_color; ?>" class="fa fa-box fa-xl"></i></h6>
      </div>
    </div>
    <div id="panel_list" class="card-body collapse in">
      <div class="card-block card-dashboard" style="padding-top:10px;padding-bottom:10px">
        <div class="col-md-4" style="padding:0px;padding-right:15px">
          <fieldset style="margin-bottom:15px">
            <p style="margin-bottom:0px;color:grey">Pemesan</p>
            <div class="input-group input-group-sm">
              <h4 style="margin-bottom:0px"><b><?= $row['nama_pelanggan']; ?></b></h4>
            </div>
            <div class="input-group input-group-sm">
              <p style="margin-bottom:0px;color:purple"><?= strtoupper($row['kategori_pelanggan']); ?></p>
            </div>
          </fieldset>
          <fieldset style="margin-bottom:15px">
            <p style="margin-bottom:0px;color:grey">Dikirim Kepada</p>
            <div class="input-group input-group-sm">
              <h4 style="margin-bottom:0px"><b><?= $row['nama_kirim']; ?></b></h4>
            </div>
            <div class="input-group input-group-sm">
              <p style="margin-bottom:0px;color:purple"><?= strtoupper($row['kategori_kirim']); ?></p>
            </div>
          </fieldset>
          <fieldset style="margin-bottom:0px">
            <p style="margin-bottom:0px;color:grey">Admin</p>
            <div class="input-group input-group-sm">
              <h4 style="margin-bottom:0px"><b><?= $row['nama_user']; ?></b></h4>
            </div>
          </fieldset>
          <?php
          if ($row['note'] != '') {
          ?>
            <fieldset style="margin-bottom:0px;margin-top:15px">
              <p style="margin-bottom:0px;color:grey">Catatan</p>
              <div class="input-group input-group-sm">
                <p style="margin-bottom:0px"><?= $row['note']; ?></p>
              </div>
            </fieldset>
          <?php
          }
          ?>
        </div>
        <div class="col-md-4" style="padding:0px;padding-right:15px">
          <fieldset style="margin-bottom:0px">
            <p class="col-md-8" style="padding:0px;margin-bottom:0px;color:grey">Status Bayar & Total Bayar</p>
            <a class="col-md-4" href="#" onclick="load_riwayat('<?= $id; ?>')" style="padding:0px"><span style="float:right">Riwayat</span></a>
            <div class="input-group input-group-sm" style="border: 1px solid grey;padding:15px">
              <h4 style="margin-bottom:10px"><b>Rp <?= number_format($row['grandtotal'], 0, ',', ','); ?></b></h4>
              <div class="col-md-4" style="padding:0px">
                <small class="<?= $badge_color; ?>"><?= $status_pembayaran; ?></small>
              </div>
              <div class="col-md-6" style="padding:0px">
                <?php
                if ($row['status_pembayaran'] == 'installment') {
                  $kurang_bayar = (int)$row['grandtotal'] - (int)$row['total_bayar'];
                ?>
                  <small class="badge badge-info col-md-6">- Rp <?= number_format($kurang_bayar, 0, ',', ','); ?></small>
                <?php
                }
                if ($row['status_pembayaran'] == 'paid') {
                  $this->db->select_max('tanggal_pembayaran');
                  $this->db->where('t_order_id', $row['id']);
                  $tanggal = $this->db->get('t_order_pembayaran')->row_array();
                ?>
                  <small class="badge badge-info col-md-8"><?= date('d-m-Y', strtotime($tanggal['tanggal_pembayaran'])); ?></small>
                <?php
                }
                ?>
              </div>
            </div>
          </fieldset>
          <fieldset style="margin-bottom:0px">
            <p style="margin-bottom:0px;color:grey">Kurir</p>
            <div class="input-group input-group-sm" style="border: 1px solid grey;padding:15px">
              <div class="col-md-2" style="padding:0px;">
                <img src="<?= base_url(); ?>app_assets\upload\kurir\<?= $row['image_url']; ?>" style="padding:0px; width:100%">
              </div>
              <div class="col-md-9" style="padding:0px 0px 0px 5px">
                <h4 style="margin-bottom:10px"><b><?= $row['kurir']; ?></b></h4>
                <p style="margin-bottom:0px">Resi: <?= $row['no_resi'] == "" ? "-" : $row['no_resi']; ?></p>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="col-md-4" style="padding:0px">
          <p style="margin-bottom:0px;color:grey">Produk (total <?= $row['jumlah_order']; ?> item)</p>
          <?php
          $produk = search($order_detail, 't_order_id', $row['id']);
          foreach ($produk as $row_produk) {
            $badge_type = 'badge badge-warning';
            if ($row_produk['jenis_produk'] != 'Pre Order') {
              $badge_type = 'badge badge-info';
            }
          ?>
            <a href="#" class="col-md-12" style="padding:0px;margin-bottom:5px;color:blue"><?= strtoupper($row_produk['name'] . ' ' . $row_produk['warna'] . ' ' . $row_produk['ukuran']); ?> (<?= $row_produk['qty']; ?>x) <small class="<?= $badge_type; ?>"><?= $row_produk['jenis_produk']; ?></small></a>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="col-md-12" style="padding:0px">
        <button id="btn_cancel" type="button" disabled class="btn btn-danger" style="float:right">Cancel <i class="fa fa-xmark"></i></button>
        <button id="btn_save" type="button" disabled class="btn btn-warning" style="float:right;margin-right:5px">Edit <i class="fa fa-edit"></i></button>
        <?php
        if ($status == "unpaid") {
        ?>
          <button id="btn_process" type="button" onclick="load_pembayaran('<?= $id; ?>')" class="btn btn-info btn-process" style="float:right;margin-right:5px">Update Bayar <i class="fa fa-wallet"></i></button>
        <?php
        } else if ($status == "installment") {
        ?>
          <button id="btn_process" type="button" onclick="load_pelunasan('<?= $id; ?>')" class="btn btn-info btn-process" style="float:right;margin-right:5px">Update Pelunasan <i class="fa fa-box"></i></button>
        <?php
        } else if ($status == "paid") {
        ?>
          <button id="btn_process" type="button" onclick="proses_orderan('<?= $id; ?>')" class="btn btn-info btn-process" style="float:right;margin-right:5px">Proses Orderan <i class="fa fa-box"></i></button>
        <?php
        } else if ($status == "onprocess" && $row['kurir_id'] == '1') {
        ?>
          <button id="btn_process" type="button" onclick="diterima_pelanggan('<?= $id; ?>')" class="btn btn-info btn-process" style="float:right;margin-right:5px">Barang Diterima <i class="fa fa-truck"></i></button>
        <?php
        } else if ($status == "onprocess" && $row['kurir_id'] != '1') {
        ?>
          <button id="btn_process" type="button" onclick="load_pengiriman('<?= $id; ?>')" class="btn btn-info btn-process" style="float:right;margin-right:5px">Kirim <i class="fa fa-truck"></i></button>
        <?php
        } else if ($status == "shipping") {
        ?>
          <button id="btn_process" type="button" onclick="diterima_pelanggan('<?= $id; ?>')" class="btn btn-info btn-process" style="float:right;margin-right:5px">Barang Diterima <i class="fa fa-house-circle-check"></i></button>
        <?php
        }
        ?>
      </div>
    </div>
    <?= $this->pagination->create_links(); ?>
  </div>
<?php
}
?>
<script>
  function load_pembayaran(id) {
    $('#modal_area').modal('toggle');
    $('#modal_title').html('Pembayaran');
    $("#modal_form").html('');
    $("#modal_form").load("<?= $url; ?>/load_pembayaran/" + id + "/");
  }

  function load_pelunasan(id) {
    $('#modal_area').modal('toggle');
    $('#modal_title').html('Pelunasan');
    $("#modal_form").html('');
    $("#modal_form").load("<?= $url; ?>/load_pelunasan/" + id + "/");
  }

  function load_riwayat(id) {
    $('#modal_area').modal('toggle');
    $('#modal_title').html('Riwayat Pembayaran');
    $("#modal_form").html('');
    $("#modal_form").load("<?= $url; ?>/load_riwayat/" + id + "/");
  }

  function load_pengiriman(id) {
    $('#modal_area').modal('toggle');
    $('#modal_title').html('Pengiriman');
    $("#modal_form").html('');
    $("#modal_form").load("<?= $url; ?>/load_pengiriman/" + id + "/");
  }

  function proses_orderan(id) {
    if (confirm('Apakah anda yakin akan memproses orderan id  #' + id + '?') === true) {
      var form = $('#modal_form').get(0);
      var formData = new FormData(form);
      formData.append('id', id);
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/proses_orderan',
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === false) {
            alert('Maaf, proses penyimpanan data gagal \nMessage: ' + result.message);
          } else {
            // glsUI.showNotif('Success', result.message, 'info');
            to_index();
          }
        })
        .fail(function(xhr, status, error) {
          alert('Maaf, proses penyimpanan data gagal \nMessage: ' + error);
        })
        .always(function() {

        });
    }
  }

  function diterima_pelanggan(id) {
    if (confirm('Apakah anda yakin orderan id  #' + id + ' telah diterima pelanggan?') === true) {
      var form = $('#modal_form').get(0);
      var formData = new FormData(form);
      formData.append('id', id);
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/diterima_pelanggan',
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === false) {
            alert('Maaf, proses penyimpanan data gagal \nMessage: ' + result.message);
          } else {
            // glsUI.showNotif('Success', result.message, 'info');
            to_index();
          }
        })
        .fail(function(xhr, status, error) {
          alert('Maaf, proses penyimpanan data gagal \nMessage: ' + error);
        })
        .always(function() {

        });
    }
  }

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

  function load_bank() {
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
  }

  function proses_pembayaran(id) {
    var error = validate_form("modal_form");
    if (error == 0) {
      var form = $('#modal_form').get(0);
      var formData = new FormData(form);
      formData.append('id', id);
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/proses_pembayaran',
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === false) {
            alert('Maaf, proses penyimpanan data gagal \nMessage: ' + result.message);
          } else {
            // glsUI.showNotif('Success', result.message, 'info');
            to_index();
          }
        })
        .fail(function(xhr, status, error) {
          alert('Maaf, proses penyimpanan data gagal \nMessage: ' + error);
        })
        .always(function() {

        });
    }
  }

  function proses_pengiriman(id) {
    var error = validate_form("modal_form");
    if (error == 0) {
      var form = $('#modal_form').get(0);
      var formData = new FormData(form);
      formData.append('id', id);
      $.ajax({
          url: '<?= base_url() ?><?= $url; ?>/proses_pengiriman',
          type: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: formData,
        }).done(function(result) {
          if (result.status === false) {
            alert('Maaf, proses penyimpanan data gagal \nMessage: ' + result.message);
          } else {
            // glsUI.showNotif('Success', result.message, 'info');
            to_index();
          }
        })
        .fail(function(xhr, status, error) {
          alert('Maaf, proses penyimpanan data gagal \nMessage: ' + error);
        })
        .always(function() {

        });
    }
  }
</script>