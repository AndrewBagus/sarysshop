<div class="card-body order-content">
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade <?php echo $page === 'order' ? 'show active' : ''; ?>" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'belum-bayar' ? 'show active' : ''; ?>" id="pills-belum-bayar" role="tabpanel" aria-labelledby="pills-belum-bayar-tab" tabindex="1">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'belum-lunas' ? 'show active' : ''; ?>" id="pills-belum-lunas" role="tabpanel" aria-labelledby="pills-belum-lunas-tab" tabindex="2">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'belum-proses' ? 'show active' : ''; ?>" id="pills-belum-proses" role="tabpanel" aria-labelledby="pills-belum-proses-tab" tabindex="3">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'belum-resi' ? 'show active' : ''; ?>" id="pills-belum-resi" role="tabpanel" aria-labelledby="pills-belum-resi-tab" tabindex="4">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'proses-pengiriman' ? 'show active' : ''; ?>" id="pills-proses-pengiriman" role="tabpanel" aria-labelledby="pills-proses-pengiriman-tab" tabindex="5">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'selesai' ? 'show active' : ''; ?>" id="pills-selesai" role="tabpanel" aria-labelledby="pills-selesai-tab" tabindex="6">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
  </div>
</div>
