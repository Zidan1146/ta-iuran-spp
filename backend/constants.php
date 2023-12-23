<?php
  // Frontend
  define('currentPageParam', $_GET['halaman']);
  define('isPageParamExist', null !== currentPageParam);
  define('pageParamValue', isPageParamExist ? currentPageParam : '');

  // Connection
  define('DB_HOST','localhost');
  define('DB_USERNAME','zids_5576_admin');
  define('DB_DATABASE', 'zids_5576_ta_iuran_spp');
  define('DB_PASSWORD','Xb?tg7NG');
  define('DB_PORT', 3306);

  // Cookies
  define('cookieName', 'token');
  define('expireTime', time() + (60*60*24));
  define('rememberMeExpireTime', time() + (60*60*24*30));
  
  define('domain', '/');
  
?>