<?php 
  require_once "./head.php"; //head呼び出し

  if($_SERVER["REQUEST_METHOD"] === "POST") //IDと生年月日が入力されてきたかチェック
  {
    $result = new USER(); //ユーザークラス呼び出し
    $check = $result->UserUpPassCheck($_POST["id"],$_POST["birth"]); //ユーザーが存在するかチェック 引数: ID, 生年月日
    if($check === FALSE) //存在しなければエラー
    {
      header("Location: ./user_reissue.php");
    }
  }
  else
  {
    header("Location: ./user_reissue.php");
  }
?>
<link rel="stylesheet" href="./css/login.css">
<link rel="stylesheet" href="style.css">
</head>
<!-- パスワード再発行入力 user_reissue_input.php -->
<?php require_once "./module/header_set.php";?>
<body>

  <div class="container">
    <div class="justify-content-center">
      <form class="" action="user_reissue_comp.php" method="POST">
        <!-- パスワード再発行入力 -->
        <div class="row gld-3 justify-content-center py-5">

          <!-- ページ -->
          <div class="col-9 my-5">
            <ul class="list-group list-group-horizontal text-center justify-content-between">
              <li class="col-3 list-group-item ms-3 border">ユーザーIDと生年月日入力</li>
              <li class="col-3 list-group-item bg-secondary border">再発行パスワード入力</li>
              <li class="col-3 list-group-item border">パスワード再発行完了</li>
            </ul>
          </div>
          <!-- /ページ -->

          <!-- 入力セクション -->
          <section class="col-9 center-block mb-4">
            <!-- パスワード -->
            <div class="row mb-4 text-center ">
              <div class="col-md-2">
                <label for="lgFormGroupInput" class="col-form-label col-form-label-lg text-center">パスワード</label>
              </div>
              <div class="col-md-8">
                <input type="password" name="pass" class="form-control form-control-lg pass-form" id="pass" placeholder="1234Aaaa">
              </div>
              <div class="err-msg-pass mt-1 text-danger"></div>
            </div>
            <!-- /パスワード -->

            <!-- 確認用パスワード -->
            <div class="row mb-4 text-center">
              <div class="col-md-2">
                <label for="lgFormGroupInput" class="col-form-label col-form-label-lg text-center">確認用パスワード</label>
              </div>
              <div class="col-md-8">
                <input type="password" name="checkpass" class="form-control form-control-lg checkPass-form" id="checkPass" placeholder="1234Aaaa">
              </div>
              <div class="err-msg-checkPass mt-1 text-danger"></div>
            </div>
            <!-- /確認用パスワード -->
          </section>
          <!-- /入力セクション -->
          <input type="hidden" name="id" value="<?= $_POST["id"]; ?>">
          <input type="hidden" name="birth" value="<?= $_POST["birth"]; ?>">
          
          <!-- ボタンセクション -->
          <div class="col-6 text-center mb-5">
            <button type="submit" class="btn btn-primary btn-lg" id="submit">再発行</button>
          </div>
          <!-- /ボタンセクション -->
        </div>
      </form>
    </div>
  </div>
  <script src="js/user_reissue_validation.js"></script>
</body>
<?php require_once "./footer.php" ?>

</html>