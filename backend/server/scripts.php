<?php
  include_once dirname(__FILE__, 2)."/constants.php";
  include_once dirname(__FILE__)."/sqlScripts.php";

  function cookieCheck() {
    $isLoginOrRegister = currentPageParam === "login" || currentPageParam === "signup";
    if(isset($_COOKIE[cookieName]) && $_COOKIE[cookieName] !== '') {
      $tokenValue = $_COOKIE[cookieName];
      $userData = getData($tokenValue);
      if($isLoginOrRegister && isset($userData)) {
        header('Location: /index.php');
      }
      return $userData;
    }
    if(!$isLoginOrRegister){
      $halaman = null;
      switch (currentPageParam) {
        case 'login':
          $halaman = 'login';
          break;
        case 'signup':
          $halaman = 'signup';
          break;
        default:
          $halaman = 'login';
          break;
      }
      header("Location: /index.php?halaman=$halaman");
    }
  }
  function randomStringGenerator($length = 16) {
    return bin2hex(random_bytes($length));
  }

  function getMonths() {
    $data = [
      "months" => [
        "juli",
        "agustus",
        "september",
        "oktober",
        "november",
        "desember",
        "januari",
        "februari",
        "maret",
        "april",
        "mei",
        "juni"
      ],
      "year" => date('Y')
    ];

    return $data;
  }
  function getMonthsNumberAndDaysLeft($year, $month, $dayInMonth) {
    switch($month) {
			case 'januari':
				$monthName = 1;
				break;
			case 'februari':
				$monthName = 2;
				break;
			case 'maret':
				$monthName = 3;
				break;
			case 'april':
				$monthName = 4;
				break;
			case 'mei':
				$monthName = 5;
				break;
			case 'juni':
				$monthName = 6;
				break;
			case 'juli':
				$monthName = 7;
				break;
			case 'agustus':
				$monthName = 8;
				break;
			case 'september':
				$monthName = 9;
				break;
			case 'oktober':
				$monthName = 10;
				break;
			case 'november':
				$monthName = 11;
				break;
			case 'desember':
				$monthName = 12;
				break;
		}

    if($monthName < 7) {
      $year = intval($year) + 1;
    }

    $dueDate = "$year-$monthName-$dayInMonth";
		$dueTimestamp = strtotime($dueDate);
		$currentTimestamp = time();
		$differenceInSeconds = $dueTimestamp - $currentTimestamp ;
		$daysLeft = floor($differenceInSeconds / (60 * 60 * 24));

    return [
      "monthID" => $monthName,
      "daysLeft" => $daysLeft
    ];
  }
  function getMonthString($monthID) {
    $monthName = null;
    switch($monthID) {
			case 1:
				$monthName = 'januari';
				break;
			case 2:
				$monthName = 'februari';
				break;
			case 3:
				$monthName = 'maret';
				break;
			case 4:
				$monthName = 'april';
				break;
			case 5:
				$monthName = 'mei';
				break;
			case 6:
				$monthName = 'juni';
				break;
			case 7:
				$monthName = 'juli';
				break;
			case 8:
				$monthName = 'agustus';
				break;
			case 9:
				$monthName = 'september';
				break;
			case 10:
				$monthName = 'oktober';
				break;
			case 11:
				$monthName = 'november';
				break;
			case 12:
				$monthName = 'desember';
				break;
		}
    return $monthName;
  }
?>