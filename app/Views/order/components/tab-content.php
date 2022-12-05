<div class="card-body order-content px-0">
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade <?php echo $page === 'order' ? 'show active' : ''; ?>" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'belum-bayar' ? 'show active' : ''; ?>" id="pills-belum-bayar" role="tabpanel" aria-labelledby="pills-belum-bayar-tab" tabindex="1">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'sudah-dp' ? 'show active' : ''; ?>" id="pills-sudah-dp" role="tabpanel" aria-labelledby="pills-sudah-dp-tab" tabindex="2">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'sudah-lunas' ? 'show active' : ''; ?>" id="pills-sudah-lunas" role="tabpanel" aria-labelledby="pills-sudah-lunas-tab" tabindex="3">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'pengiriman' ? 'show active' : ''; ?>" id="pills-pengiriman" role="tabpanel" aria-labelledby="pills--pengiriman-tab" tabindex="5">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
    <div class="tab-pane fade <?php echo $page === 'terkirim' ? 'show active' : ''; ?>" id="pills-terikiim" role="tabpanel" aria-labelledby="pills-terkirim-tab" tabindex="6">
      <?php echo $this->include('order/components/table-index') ?>
    </div>
  </div>
</div>
