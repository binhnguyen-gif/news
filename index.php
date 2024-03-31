<?php
include 'db_config.php';
$page = null;
if(isset($_GET['action'])) {
    $page = $_GET['action'];
}
$isSecure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
$httpHost = $_SERVER['HTTP_HOST'];
$port = $_SERVER['SERVER_PORT'];

// Kiểm tra nếu sử dụng cổng 8000 và không phải HTTPS
if ($port == '8000' && !$isSecure) {
    $httpHost .= ':8000';
}

$current_url = ($isSecure ? 'https://' : 'http://') . $httpHost . $_SERVER['REQUEST_URI'];
require_once 'header.php';
switch ($page) {
  case 'detail':
      require_once 'post_detail.php';
      break;
  case 'posts':
    require_once 'posts.php';
    break;
  default:
      require_once 'home.php';
      break;
}
require_once 'footer.php';
?>