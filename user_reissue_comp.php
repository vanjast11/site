<?php 
  require_once "./head.php"; 

  $result = new USER();
  $result->UserPass($_POST["id"],$_POST["pass"],$_POST["birth"]);

?>

<link rel="stylesheet" href="style.css">
</head>

<!-- パスワード再発行完了 user_reissue_comp.php -->
<?php 
  require_once "./module/header_set.php";
  

  if($_SERVER["REQUEST_METHOD"] === "GET")
  {
    header("Location: ./user_reissue.php");
  }  
?>
<body>

  <div class="container">
    <div class="justify-content-center">

      <div class="row gld-3 justify-content-center py-5">

        <!-- ページ -->
        <div class="col-9 my-5">
          <ul class="list-group list-group-horizontal text-center justify-content-between">
            <li class="col-3 list-group-item ms-3 border">ユーザーIDと生年月日入力</li>
            <li class="col-3 list-group-item  border">再発行パスワード入力</li>
            <li class="col-3 list-group-item bg-secondary border">パスワード再発行完了</li>
          </ul>
        </div>
        <!-- /ページ -->

        <!-- テキストメッセージセクション -->
        <div class="col-9 center-block mb-5">
          <div class="text-center mt-5">
            <p>パスワード変更が完了いたしました。</p>
          </div>
        </div>
        <!-- /テキストメッセージセクション -->

        <!-- ボタンセクション -->
        <div class="col-6 text-center">
          <button onclick="location.href='./index.php'" class="btn btn-primary btn-lg m-5">トップ</button>
          <button onclick="location.href='./login.php'" class="btn btn-primary btn-lg">ログイン</button>
        </div>
        <!-- /ボタンセクション -->
      </div>
    </div>
  </div>
</body>
<?php require_once "./footer.php" ?>

</html>