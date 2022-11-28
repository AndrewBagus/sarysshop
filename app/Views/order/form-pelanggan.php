<div class="card d-none" id="card-pelanggan">
  <div class="card-header">
    <h1><span id="title-form"></span> Pelanggan</h1>
  </div>
  <form id="form-pelanggan" autocomplete="off">
    <?php echo $this->include('pelanggan/components/form-body') ?>
    
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back-pelanggan"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
