<p class="judul_profile">Dashboard</p>
<p class="dashboard1">Selamat Datang <?= $data['user']['nama'] ?>!</p>
</br></br>

<a class="button_dashboard1" href="index.php?halaman=rekapdata&type=belum_dibayar">
  <p class="belum_bayar"> <?= $data['undoneSppCount'] ?> Belum Terbayar</p>
</a>
<a class="button_dashboard2" href="index.php?halaman=rekapdata&type=sudah_dibayar">
  <p class="sudah_bayar"><?= $data['doneSppCount'] ?> Sudah Terbayar</p>
</a>