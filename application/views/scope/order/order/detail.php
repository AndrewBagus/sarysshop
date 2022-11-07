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
?>
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
        <a>Detail <?= $title; ?></a>
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
            <h4 class="card-title" id="title_header">Detail <?= $title; ?></h4>
            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
          </div>
          <div id="panel_editor" class="card-body collapse in">
            <div class="card-block">
              <div class="form-body">
                <div class="col-md-2">
                  <img src="<?= base_url(); ?>app_assets\upload\produk\<?= $data['image_url']; ?>" style="max-width:120px;max-height:120px;padding:2px;margin-bottom:5px" />
                </div>
                <div class="col-md-7">
                  <h3><?= $data['name']; ?></h3>
                  <p><?= $data['keterangan']; ?></p>
                </div>
                <div class="col-md-3">
                  <fieldset class="col-md-6" style="margin-bottom:5px">
                    <h7><b>Jenis Produk</b></h7>
                    <div class="input-group input-group-sm">
                      <p style="margin-bottom:0px"><?= $data['jenis_produk']; ?></p>
                    </div>
                  </fieldset>
                  <fieldset class="col-md-6" style="margin-bottom:10px">
                    <h7><b>Tempo Kedatangan</b></h7>
                    <div class="input-group input-group-sm">
                      <p style="margin-bottom:0px"><?= $data['tempo_kedatangan_barang']; ?> Hari</p>
                    </div>
                  </fieldset>
                  <fieldset class="col-md-7" style="margin-bottom:5px">
                    <h7><b>Kategori Produk</b></h7>
                    <div class="input-group input-group-sm">
                      <p style="margin-bottom:0px"><?= $data['kategori_produk']; ?></p>
                    </div>
                  </fieldset>
                  <fieldset class="col-md-7" style="margin-bottom:5px">
                    <h7><b>Total Stok</b></h7>
                    <div class="input-group input-group-sm">
                      <p style="margin-bottom:0px"><?= $data['stok']; ?></p>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        $i = 1;
        foreach ($varian as $row) {
          $result = search($varian_image, 'm_produk_varian_id', $row['id']);

        ?>
          <div class="card">
            <div id="panel_editor" class="card-body collapse in">
              <div class="card-block">
                <div class="form-body">
                  <div class="col-md-2">
                    <h3>Varian <?= $i; ?></h3>
                    <img src="<?= base_url(); ?><?= !empty($result) ? 'app_assets/upload/produk/' . $result[0]['image_url'] : 'app_assets/img/no-image.png' ?>" style="max-width:120px;max-height:120px;padding:2px;margin-bottom:5px" />
                  </div>
                  <div class="col-md-3">
                    <fieldset style="margin-bottom:10px">
                      <h7><b>SKU</b></h7>
                      <div class="input-group input-group-sm">
                        <p style="margin-bottom:0px"><?= $row['code']; ?></p>
                      </div>
                    </fieldset>
                    <fieldset style="margin-bottom:10px">
                      <h7><b>Total Stok</b></h7>
                      <div class="input-group input-group-sm">
                        <p style="margin-bottom:0px"><?= $row['stok']; ?></p>
                      </div>
                    </fieldset>
                  </div>
                  <div class="col-md-3">
                    <fieldset style="margin-bottom:10px">
                      <h7><b>Berat</b></h7>
                      <div class="input-group input-group-sm">
                        <p style="margin-bottom:0px"><?= $row['berat']; ?> gr</p>
                      </div>
                    </fieldset>
                    <fieldset style="margin-bottom:10px">
                      <h7><b>Satuan</b></h7>
                      <div class="input-group input-group-sm">
                        <p style="margin-bottom:0px"><?= $row['satuan']; ?></p>
                      </div>
                    </fieldset>
                    <fieldset style="margin-bottom:10px">
                      <h7><b>Varian</b></h7>
                      <div class="input-group input-group-sm">
                        <p style="margin-bottom:0px">Ukuran: <?= $row['ukuran']; ?>, Warna: <?= $row['warna']; ?></p>
                      </div>
                    </fieldset>
                  </div>
                  <div class="col-md-4">
                    <fieldset class="col-md-6" style="margin-bottom:10px">
                      <h7><b>Harga Beli</b></h7>
                      <div class="input-group input-group-sm">
                        <p style="margin-bottom:0px">Rp <?= number_format($row['harga_beli'], 0, ',', '.'); ?></p>
                      </div>
                    </fieldset>
                    <?php
                    foreach ($kategori_pelanggan as $pelanggan) {
                      $varian = search($varian_harga, 'm_produk_varian_id', $row['id']);
                      if (!empty($varian)) {
                        $harga = search($varian, 'm_kategori_pelanggan_id', $pelanggan['id']);
                        if (!empty($harga)) {
                          $get_harga = number_format($harga[0]['harga'], 0, ',', '.');
                        } else {
                          $get_harga = '';
                        }
                      } else {
                        $get_harga = '';
                      }
                    ?>
                      <fieldset class="col-md-6" style="margin-bottom:10px">
                        <h7><b>Harga Jual <?= $pelanggan['name']; ?></b></h7>
                        <div class="input-group input-group-sm">
                          <p style="margin-bottom:0px">Rp <?= $get_harga; ?></p>
                        </div>
                      </fieldset>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
          $i++;
        }
        ?>
        <div class="card">
          <div id="panel_editor" class="card-body collapse in">
            <div class="card-block">
              <div class="form-body">
                <div class="text-xs-right">
                  <a href="<?= base_url(); ?><?= $url; ?>" class="btn btn-info">Kembali <i class="icon-arrow-left3 position-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>