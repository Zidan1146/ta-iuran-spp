<!DOCTYPE html>
<html>
  <head>
    <title>Website Iuran | SMKN 1 Cimahi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup_login.css">
  </head>

  <body>
    <?php 
      include_once "backend/constants.php";
      include_once "backend/server/connect.php";
      include_once "backend/server/scripts.php";
      global $data;
      $data = cookieCheck();

      $isDataExist = isset($data);
    ?>
    <div class="<?= pageParamValue !== 'login' && pageParamValue !== 'signup' ? 'main' : 'login-signup-main' ?>">
      <dialog class="logout-dialog" id="logout-dialog">
        <p>Keluar dari akun?</p>
        <div class="logout-dialog-actions">
            <button id="logout-action">Keluar</button>
            <button id="close-dialog-action">Batal</button>
        </div>
      </dialog>
      <?php
        if(isPageParamExist) {
          switch(pageParamValue) {
            case 'login':
              include "content/login.php";
              break;
            case 'signup':
              include 'content/signup.php';
              break;
            default:
              include "layout/poto_profile.php";
              include "layout/header.php";
              include "layout/menu.php";
              include "layout/konten.php";
              break;
          }
        } else {
            include "layout/poto_profile.php";
            include "layout/header.php";
            include "layout/menu.php";
            include "layout/konten.php";
        }
      ?>
    </div>

    <script>
      const showDialogButton = document.getElementById('show-logout-dialog');
      const logoutButton = document.getElementById('logout-action');
      const closeDialogButton = document.getElementById('close-dialog-action');
      const dialog = document.getElementById('logout-dialog');

      if(showDialogButton && closeDialogButton && dialog) {
        showDialogButton.addEventListener('click', () => dialog.showModal());
        closeDialogButton.addEventListener('click', () => dialog.close());
        logoutButton.addEventListener('click', () => {
          dialog.close();
          fetch('/backend/action/logout.php');
          location = 'index.php?halaman=login';
        });
      }
    </script>
  </body>
</html>