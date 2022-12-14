<div class="header navbar">
  <div class="header-container">
    <ul class="nav-left">
      <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
    </ul>
    <ul class="nav-right">
      <li class="dropdown"><a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          <!-- <div class="peer mR-10"><img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt=""></div> -->
          <div class="peer mR-10"><img class="w-2r bdrs-50p" src="<?= base_url(); ?>/assets/images/user.png" alt="user" style="padding: 2px; width: 32px; height: 32px; object-fit: contain; border: 1px solid rgba(0,0,0,.250);"></div>
          <div class="peer"><span class="fsz-md c-grey-900">
              <?= session()->get('fullname'); ?>
            </span></div>
        </a>
        <ul class="dropdown-menu fsz-md" aria-labelledby="dropdownMenuLink">
          <li><a href="<?= base_url('/logout'); ?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
