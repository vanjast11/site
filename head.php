<?php                                        
  session_start();                            //セッション開始
  ini_set('display_errors', 1);               //厳密チェック  
  require_once "./module/define.php";         //定数ファイル読み込み
  require_once "./module/user_module.php";    //ユーザーモジュール読み込み
  require_once "./module/cart_module.php";    //カートモジュール読み込み
  require_once "./module/item_module.php";    //商品モジュール読み込み
  require_once './module/admin.php';
  require_once './module/contuct_module.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>pelle</title>
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/jquery-2.1.4.min.js"></script>
  <link href="./bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="./bootstrap-5.0.0-beta1-dist/js/bootstrap.min.js"></script>
  <script defer src="./fontawesome-free-5.15.4-web/js/brands.js"></script>
		<script defer src="./fontawesome-free-5.15.4-web/js/solid.js"></script>
		<script defer src="./fontawesome-free-5.15.4-web/js/fontawesome.js"></script>
		<link href="./fontawesome-free-5.15.4-web/css/fontawesome.css" rel="stylesheet">
		<link href="./fontawesome-free-5.15.4-web/css/brands.css" rel="stylesheet">
		<link href="./fontawesome-free-5.15.4-web/css/solid.css" rel="stylesheet">