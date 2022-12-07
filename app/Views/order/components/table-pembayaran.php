<div class="col-md-12 mt-2">
  <div class="card">
    <div class="card-header">
      <h3>Pembayaran</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-outline-primary" id="btn-pembayaran-new" data-bs-toggle="tooltip" data-bs-title="Tambah Data">
          <i class="fa fa-plus"></i> Tambah Pembayaran
        </button>
      </div>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="table-pembayaran-list" width="100%">
          <thead>
            <tr>
              <th> No </th>
              <th> Bank </th>
              <th> Tanggal Pembayaran </th>
              <th> Keterangan </th>
              <th> Nominal </th>
              <th></th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th colspan="4"> Total Pembayaran </th>
              <th colspan="2">Rp. <span id="total-pembayaran">0</span></th>
            </tr>
          </tfoot>
        </table>
      </div>

    </div>
  </div>
</div>
