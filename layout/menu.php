<?php include_once "backend/constants.php"; ?>
<div class="menu">
  <ul class="list_menu">
    <li class="list-child">
      <a href="index.php?halaman=dashboard" <?= (pageParamValue === 'dashboard') || !isPageParamExist ? 'class="selected-menu"' : '' ?>>
        Dashboard
      </a>
    </li>
    <li class="list-child">
      <a href="index.php?halaman=faq" <?= pageParamValue === 'faq' ? 'class="selected-menu"' : '' ?>>
        FAQ
      </a>
    </li>
    <li class="list-child">
      <a href="index.php?halaman=notifikasi" <?= pageParamValue === 'notifikasi' ? 'class="selected-menu"' : '' ?>>
        Notifikasi
      </a>
    </li>
    <li class="list-child">
      <a id="show-logout-dialog">
        Logout
      </a>
    </li>
  </ul>
</div>