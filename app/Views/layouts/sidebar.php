<div class="sidebar">
  <div class="sidebar-inner">
    <div class="sidebar-logo">
      <div class="peers ai-c fxw-nw">
        <div class="peer peer-greed"><a class="sidebar-link td-n" href="<?php echo base_url() ?>">
            <div class="peers ai-c fxw-nw">
              <div class="peer">
                <div class="logo"><img src="<?php echo base_url(); ?>/assets/images/toko.png" alt="logo" style="width: 180px; height: 110px; scale: 0.85;"></div>
              </div>
            </div>
          </a></div>
        <div class="peer">
          <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
        </div>
      </div>
    </div>
    <ul class="sidebar-menu scrollable pos-r">
      <?php
      $features = get_features(session()->get('role_id'));
      foreach ($features as $i => $feature) :
        $hasChild = count($feature['child']);
        $marginClass = $i === 0 ? 'mT-30' : '';
        $parentActive = '';
        $linkClass = 'dropdown-toggle';
        $link = empty($feature['link']) ? 'javascript:void(0);' : base_url($feature['link']);
        if ($feature['nama'] === $title) {
          $parentActive = 'active';
          $linkClass = 'sidebar-link';
        } else if ($feature['nama'] == $parent) {
          $parentActive = 'dropdown open';
        } else if ($hasChild > 0) {
          $parentActive = 'dropdown';
        }

        $parentClass = $parentActive;
        if (!empty($marginClass)) {
          $parentClass = $marginClass . ' ' . $parentActive;
        }
      ?>
        <li class="nav-item <?php echo $parentClass ?>">
          <a class="<?php echo $linkClass; ?>" href="<?php echo $link ?>">
            <span class="icon-holder">
              <i class="<?php echo $feature['icon']; ?>"></i>
            </span>
            <span class="title"><?php echo $feature['nama']; ?></span>
            <?php if ($hasChild > 0) : ?>
              <span class="arrow"><i class="ti-angle-right"></i></span>
            <?php endif ?>
          </a>
          <?php if ($hasChild > 0) : ?>
            <ul class="dropdown-menu" style="padding-left: 0;">
              <?php foreach ($feature['child'] as $item) :
                $childActive = $item['nama'] === $title ? 'active' : '';
              ?>
                <li class="pL-25 <?php echo $childActive; ?>">
                  <a class="sidebar-link" href="<?php echo base_url($item['link']); ?>">
                    <span class="icon-holder">
                      <i class="<?php echo $item['icon']; ?>"></i>
                    </span>
                    <?php echo $item['nama']; ?>
                  </a>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif ?>
        </li>
      <?php endforeach ?>

    </ul>
  </div>
</div>
