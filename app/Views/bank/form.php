<div class="card d-none" id="card-form">
  <div class="card-header">
    <h1><span id="title-form"></span> Bank</h1>
  </div>
  <form id="form-data" autocomplete="off">
    <div class="card-body">
      <input type="hidden" class="form-control" id="id" name="id" value="" readonly>
      <div class="row" style="padding-left: 0; padding-right: 0;">
        <div class="col-md-4">
          <div class="form-group">
            <label class="form-label" for="jenis-bank">Bank</label>
            <select class="form-control select2bs5" id="jenis-bank" name="jenis_bank_id" data-placeholder="Bank" style="width: 100%;">
            </select>
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label class="form-label" for="cabang">Cabang</label>
            <input type="text" class="form-control" id="cabang" name="cabang" placeholder="Cabang">
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 0; padding-right: 0; margin-top: 1.5rem;">
        <div class="col-md-4">
          <div class="form-group">
            <label class="form-label" for="rekening">Nomor Rekening</label>
            <input type="text" class="form-control" id="rekening" name="rekening" placeholder="Nomor Rekening" onkeypress="return isNumber(event)">
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label class="form-label" for="atas_nama">Atas Nama</label>
            <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama">
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-danger" id="btn-back"><i class="fa fa-arrow-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
