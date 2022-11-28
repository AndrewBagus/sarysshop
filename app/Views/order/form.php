<div class="card bg-transparent" id="card-form">
  <div class="card-header bg-transparent mb-5">
    <h1>Form Order</h1>
  </div>

  <div class="row" style="padding-left: 0; padding-right: 0;">
    <?php echo $this->include('order/components/form-left') ?>
    <?php echo $this->include('order/components/form-right') ?>

    <div class="col-md-12 mt-3">
      <div class="row">
        <div class="col-12 col-md-4">
          <button type="button" class="btn btn-danger" id="btn-back"><i class="fa fa-arrow-left"></i> Back</button>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-6 mt-1 mt-md-0 mt-lg-0 mt-xl-0">
              <button type="submit" class="btn btn-info" style="width: 100%;"><i class="fa fa-refresh"></i> Simpan & tambah order baru</button>
            </div>
            <div class="col-md-6 mt-1 mt-md-0 mt-lg-0 mt-xl-0">
              <button type="submit" class="btn btn-outline-primary" style="width: 100%;"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
