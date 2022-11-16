<div class="modal" id="modal-filter" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Filter Data</h3>
      </div>
      <form id="form-filter" autocomplete="off">
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label" for="kategori-pelanggan">Kategori Pelanggan</label>
            <select class="form-control select2bs5-nonclear" id="kategori-pelanggan-filter" name="kategori_pelanggan_filter" data-placeholder="Kategori Pelanggan" style="width: 100%;"></select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          <div>
            <button type="button" class="btn btn-outline-info" id="btn-refresh"><i class="fa fa-sync"></i> Refresh</button>
            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
