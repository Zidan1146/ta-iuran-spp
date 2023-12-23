<?php
  include_once dirname(__FILE__)."/connect.php";
  include_once dirname(__FILE__)."/scripts.php";
  include_once dirname(__FILE__, 2)."/constants.php";

  // SQL functions
  function createUser($nama, $nisn, $email, $password) {
    $cookieValue = randomStringGenerator();
    $script = "INSERT INTO 
    user (nama, nisn, email, password, role, token)
    VALUES ('$nama', '$nisn', '$email', '$password', 'user', '$cookieValue')";

    mysqli_query(conn, $script);

    $lastId = mysqli_insert_id(conn);

    generateSPPData($lastId);

    setcookie(cookieName, $cookieValue, expireTime, domain);
  }

  function generateSPPData($userId) {
    $monthAndYear = getMonths();

    for($i = 0; $i < 3; $i++) {
      $year = $monthAndYear['year'] + $i;
        foreach($monthAndYear['months'] as $month) {
          $query = "SELECT * FROM data_spp
          WHERE bulan = '$month' AND 
          tahun = '$year' AND
          id_pemilik = $userId";

          $result = mysqli_query(conn, $query);

          if(mysqli_num_rows($result) === 0) {
            $query = "INSERT INTO
            data_spp (bulan, tahun, status, id_pemilik)
            VALUES ('$month', '$year', 'belum_dibayar', $userId)";

            mysqli_query(conn, $query);
          }
      }
    }
  }

  function loginCheck($username, $password, $isPermanent = false) {
    $cookieValue = randomStringGenerator();
    $script = "SELECT id FROM user
    WHERE (nama='$username' OR email='$username')
    AND password='$password'";

    $query = mysqli_query(conn, $script);

    $data = mysqli_fetch_array($query);
    $result = isset($data);

    if($result) {
      $addToken = "UPDATE user
      SET token='$cookieValue'
      WHERE id=$data[0]";
      mysqli_query(conn, $addToken);

      setcookie(cookieName, $cookieValue, $isPermanent ? rememberMeExpireTime : expireTime, domain);
      return true;
    }
    return null;
  }

  function getData($param) {

    $query = "SELECT * FROM user
    WHERE token='$param'";

    $userData = mysqli_query(conn, $query);

    $data = [
      "user" => mysqli_fetch_array($userData)
    ];

    $query = "SELECT * FROM data_spp
    WHERE id_pemilik = {$data['user']['id']}";
    $sppData = mysqli_query(conn, $query);

    $undoneSppQuery = "$query AND status = 'belum_dibayar'";
    $undoneSppData = mysqli_query(conn, $undoneSppQuery);

    $doneSppQuery = "$query AND status = 'sudah_dibayar'";
    $doneSppData = mysqli_query(conn, $doneSppQuery);

    $query = "SELECT * FROM notification
    WHERE Idpemilik = {$data['user']['id']} 
    ORDER BY id DESC";
    $notificationData = mysqli_query(conn, $query);

    if(isPageParamExist && currentPageParam === 'notifikasi') {
      while($spp = mysqli_fetch_array($sppData)) {
        if($spp['status'] === 'sudah_dibayar') {
          continue;
        }
        $daysLeft = getMonthsNumberAndDaysLeft($spp['tahun'], $spp['bulan'], $spp['tenggat_bayar'])['daysLeft'];
  
        $notificationQuery = "SELECT * FROM notification 
        WHERE Idpemilik = {$data['user']['id']} AND 
        idSpp = $spp[id]";
  
        $existingNotification = mysqli_query(conn, $notificationQuery);
  
        if(mysqli_num_rows($existingNotification) <= 0) {
            if($daysLeft < 0) {
              $dayLeft = $daysLeft * -1;
              $query = "INSERT INTO notification(notificationDate, title, description, Idpemilik, idSpp)
              VALUES(NOW(), 'Melewati Tenggat!', 'Pembayaran bulan $spp[bulan] belum dibayar, tenggat telah terlewat $dayLeft hari yang lalu', '{$data['user']['id']}', '$spp[id]')";
      
              mysqli_query(conn, $query);
            } else if($daysLeft <= 7) {
              $query = "INSERT INTO notification(notificationDate, title, description, Idpemilik, idSpp)
              VALUES(NOW(), 'Tenggat Pembayaran hampir berakhir', 'Pembayaran bulan $spp[bulan] belum dibayar, tenggat $daysLeft hari lagi', '{$data['user']['id']}', '$spp[id]')";
      
              mysqli_query(conn, $query);
            }
        }
      }
    }

    $data['spp'] = $sppData;
    $data['undoneSppCount'] = mysqli_num_rows($undoneSppData);
    $data['doneSppCount'] = mysqli_num_rows($doneSppData);
    $data['sppCount'] = mysqli_num_rows($sppData);
    $data['notifications'] = $notificationData;

    if ($data) {
      return $data;
    }
    return null;
  }

  function logout() {
    $token = $_COOKIE[cookieName];
    if(isset($token)) {
      setcookie(cookieName,"", time() - (60*60*24*30), domain);
      $query = "UPDATE user 
      SET token = NULL
      WHERE token = '$token'";
      mysqli_query(conn, $query);
    }
  }

  function successfullPayment() {
    $id = $_GET['id'];
    $idSPP = $_GET['idSPP'];
    $bulan = getMonthString($_GET['bulan']);
    echo "<script>alert('id = $id, idSpp = $idSPP, bulan = $bulan');</script>";
    if(isset($id) && isset($idSPP) && $bulan) {
      $query = "UPDATE data_spp
      SET tanggal_bayar = NOW(),
      status = 'sudah_dibayar'
      WHERE id = $idSPP";

      mysqli_query(conn, $query);

      $query = "INSERT INTO notification(notificationDate, title, description, Idpemilik, idSpp)
      VALUES(NOW(), 'Pembayaran Berhasil!', 'Pembayaran bulan $bulan telah selesai dibayar', $id, $idSPP)";

      mysqli_query(conn, $query);
    } else {
      http_response_code(500);
    }
  }
?>