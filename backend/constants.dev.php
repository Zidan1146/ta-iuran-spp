<?php
  // Frontend
  define('currentPageParam', $_GET['halaman']);
  define('isPageParamExist', null !== currentPageParam);
  define('pageParamValue', isPageParamExist ? currentPageParam : '');

  // Connection
  define('DB_HOST','localhost');
  define('DB_USERNAME','root');
  define('DB_DATABASE', 'ta_iuran_spp');
  define('DB_PASSWORD','');

  // Cookies
  define('cookieName', 'token');
  define('expireTime', time() + (60*60*24));
  define('rememberMeExpireTime', time() + (60*60*24*30));
  
  define('domain', '/');
  
?>