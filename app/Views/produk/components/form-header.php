<div class="row" style="padding-left: 0; padding-right: 0;">
  <input type="hidden" class="form-control" id="id" name="id" value="" readonly>
  <div class="col-md-2">
    <?= $this->include('produk/components/form-image') ?>
  </div>
  <div class="col-md-10">
    <div class="row">
      <?= $this->include('produk/components/form-left') ?>
      <?= $this->include('produk/components/form-right') ?>

      <div class="col-md-12">
        <div class="form-group mt-3">
          <label class="form-label" for="keterangan">Keterangan</label>
          <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
        </div>
      </div>
    </div>

  </div>
</div>
