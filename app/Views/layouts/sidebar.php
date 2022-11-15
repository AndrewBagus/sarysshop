<div class="sidebar">
  <div class="sidebar-inner">
    <div class="sidebar-logo">
      <div class="peers ai-c fxw-nw">
        <div class="peer peer-greed"><a class="sidebar-link td-n" href="<?= base_url() ?>">
            <div class="peers ai-c fxw-nw">
              <div class="peer">
                <div class="logo"><img src="<?= base_url(); ?>/assets/images/web-logo.png" alt="logo" style="width: 175px; height: 65px; scale: 0.85;"></div>
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
        <li class="nav-item <?= $parentClass ?>">
          <a class="<?= $linkClass; ?>" href="<?= $link ?>">
            <span class="icon-holder">
              <i class="<?= $feature['icon']; ?>"></i>
            </span>
            <span class="title"><?= $feature['nama']; ?></span>
            <?php if ($hasChild > 0) : ?>
              <span class="arrow"><i class="ti-angle-right"></i></span>
            <?php endif ?>
          </a>
          <?php if ($hasChild > 0) : ?>
            <ul class="dropdown-menu" style="padding-left: 0;">
              <?php foreach ($feature['child'] as $item) :
                $childActive = $item['nama'] === $title ? 'active' : '';
              ?>
                <li class="pL-25 <?= $childActive; ?>">
                  <a class="sidebar-link" href="<?= base_url($item['link']); ?>">
                    <span class="icon-holder">
                      <i class="<?= $item['icon']; ?>"></i>
                    </span>
                    <?= $item['nama']; ?>
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
