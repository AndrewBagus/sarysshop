<div class="modal" id="modal-view-pembayaran" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">View Pembayaran Order: <span id="view-pembayaran-title"></span></h3>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover"  id="table-view-pembayaran-list" width="100%">
          <thead>
            <tr>
              <th> No </th>
              <th> Bank </th>
              <th> Tanggal Pembayaran </th>
              <th> Keterangan </th>
              <th> Nominal </th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th colspan="4"> Total Pembayaran </th>
              <th>Rp. <span id="view-total-pembayaran">0</span></th>
            </tr>
          </tfoot>
          
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
