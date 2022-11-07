<?php
$feature_url = $this->uri->segment(1);
?>
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow">
  <!-- main menu content-->
  <div class="main-menu-content" style="margin-top:10px">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
      <?php
      $group_name = "";
      $i = 1;
      foreach ($feature as $row) {
        $group_id = $row['group_id'];
        if ($group_name != $row['group_name'] && $row['group_count'] > 1) {
          $i = 1;
      ?>
          <hr style="margin:0px">
          <li class='navigation-header' style='text-align: center'>
            <span data-i18n='nav.category.menu'><?= $row['group_name'] ?></span><i data-toggle='tooltip' data-placement='right' data-original-title='<?= $row['group_name'] ?>'></i>
          </li>
        <?php
        }
        ?>
        <li class="nav-item <?= $row['code'] == $feature_url ? 'active' : ''; ?>">
          <a href="<?= base_url(); ?><?= $row['url']; ?>"><i class="<?= $row['icon']; ?>"></i><span class='menu-title'><?= $row['name']; ?></span></a>
        </li>
        <?php
        if ($group_name == $row['group_name'] && $row['group_count'] == $i) {
          $i = 1;
        ?>
          <hr style="margin:0px">
      <?php
        }
        $group_name = $row['group_name'];
        $i++;
      }
      ?>
    </ul>
  </div>
</div>