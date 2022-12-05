<div class="card bg-transparent d-none" id="card-form">
  <div class="card-header bg-transparent mb-5">
    <h1>Form Order</h1>
  </div>

  <form id="form-data">
    <div class="row" style="padding-left: 0; padding-right: 0;">
      <input type="hidden" class="form-control" id="id" name="id" value="0" readonly>
      <input type="hidden" class="form-control" id="mode" value="" readonly>
      <input type="hidden" class="form-control" id="sub-total" name="subtotal_pembelian" value="0" readonly>
      <input type="hidden" class="form-control" id="grand-total" name="grandtotal" value="0" readonly>
      <?php echo $this->include('order/components/form-left') ?>
      <?php echo $this->include('order/components/form-right') ?>
      <?php echo $this->include('order/components/table-pembayaran') ?>
      <?php echo $this->include('order/components/form-button') ?>
    </div>
  </form>
</div>
