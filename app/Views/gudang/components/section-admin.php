<div class="card">
  <div class="card-header">
    <h1>Admin Gudang</h1>
    <div class="card-tools">
      <button type="button" class="btn btn-outline-primary mt-1 mt-lg-0" id="btn-new-admin" data-bs-toggle="tooltip" data-bs-title="Tambah Admin">
        <i class="fa fa-plus"></i> Tambah Admin
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="table-admin-list" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <?= $this->include('gudang/components/table-admin') ?>
      </table>
    </div>
  </div>
</div>
