<p class="judul_profile">Notifikasi</p>

<?php
  while($notification = mysqli_fetch_array($data['notifications'])) {
?>
  <fieldset class="fieldset_notif">
    <p><?= $notification['notificationDate'] ?></p>
    <h2><?= $notification['title'] ?></h2>
    <p> <?= $notification['description'] ?> </p>
  </fieldset>
  <br><br>
<?php
}
?>