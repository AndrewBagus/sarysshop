<ul class="nav nav-pills mt-3" id="pills-tab" role="tablist">
  <li class="nav-item mb-lg-1" role="presentation">
    <a href="<?php echo base_url('/order') ?>" class="nav-link <?php echo $page === 'order' ? 'active' : ''; ?>" role="tab" aria-selected="true">
      <i class="ti-package fw-bolder"></i>
      <span>Semua Order</span>
    </a>
  </li>
  <li class="nav-item" role="presentation">
    <a href="<?php echo base_url('/order/belum-bayar') ?>" class="nav-link <?php echo $page === 'belum-bayar' ? 'active' : ''; ?>" role="tab" aria-selected="false">
      <i class="ti-money fw-bolder"></i>
      <span>Belum Bayar</span>
    </a>
  </li>
  <li class="nav-item mt-1 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0" role="presentation">
    <a href="<?php echo base_url('/order/belum-lunas') ?>" class="nav-link <?php echo $page === 'belum-lunas' ? 'active' : ''; ?>" role="tab" aria-selected="false">
      <i class="ti-credit-card fw-bolder"></i>
      <span>Belum Lunas</span>
    </a>
  </li>
  <li class="nav-item mt-1 mt-md-0 mt-lg-0 mt-xl-0" role="presentation">
    <a href="<?php echo base_url('/order/belum-proses') ?>" class="nav-link <?php echo $page === 'belum-proses' ? 'active' : ''; ?>" role="tab" aria-selected="false">
      <i class="ti-infinite fw-bolder"></i>
      <span>Belum Diproses</span>
    </a>
  </li>
  <li class="nav-item mt-1 mt-md-1 mt-lg-0 mt-xl-0" role="presentation">
    <a href="<?php echo base_url('/order/belum-resi') ?>" class="nav-link <?php echo $page === 'belum-resi' ? 'active' : ''; ?>" role="tab" aria-selected="false">
      <i class="ti-clipboard fw-bolder"></i>
      <span>Belum Ada Resi</span>
    </a>
  </li>
  <li class="nav-item mt-1 mt-md-1 mt-lg-1 mt-xl-0" role="presentation">
    <a href="<?php echo base_url('/order/proses-pengiriman') ?>" class="nav-link <?php echo $page === 'proses-pengiriman' ? 'active' : ''; ?>" role="tab" aria-selected="false">
      <i class="ti-truck fw-bolder"></i>
      <span>Proses Pengiriman</span>
    </a>
  </li>
  <li class="nav-item mt-1 mt-md-1 mt-lg-1 mt-xl-0" role="presentation">
    <a href="<?php echo base_url('/order/selesai') ?>" class="nav-link <?php echo $page === 'selesai' ? 'active' : ''; ?>" role="tab" aria-selected="false">
      <i class="ti-check fw-bolder"></i>
      <span>Order Selesai</span>
    </a>
  </li>
</ul>
