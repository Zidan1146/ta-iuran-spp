<div class="konten">
  <?php
    if(isset($_GET['halaman'])){
      $page = $_GET['halaman'];
      switch ($page) {
        case 'dashboard':
          include "content/dashboard/dashboard.php";
          break;

        case 'faq':
          include "content/faq/faq.php";
          break;

        case 'notifikasi':
          include "content/notifikasi/notifikasi.php";
          break;

        case 'rekapdata':
          include "content/rekapdata/rekapdata.php";
          break;

        case 'logout':
          include "content/logout/logout.php";
          break;

        default:
          echo "<center><h3>Maaf. Halaman tidak ditemukan!</h3></center>";
          break;
      }
    }
    else {
      include "content/dashboard/dashboard.php";
    }
  ?>
</div>