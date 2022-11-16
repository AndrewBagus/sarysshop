<div class="modal" id="modal-admin" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">List Admin<span id="admin-title"></span></h3>
      </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table id="table-admin-form-list" class="table table-bordered table-hover" cellspacing="0" width="100%">
              <?= $this->include('gudang/components/table-admin') ?>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
    </div>
  </div>
</div>
