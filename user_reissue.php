<?php 
  require_once "./head.php"; ;
  $err = "";

?>
<link rel="stylesheet" href="./css/login.css">
<link rel="stylesheet" href="style.css">
</head>

<!-- パスワード再発行 user_reissue.php -->
<?php require_once "./module/header_set.php";?>
<body>
  <div class="container">
    <div class="justify-content-center">

      <form class="" action="./user_reissue_input.php" method="POST">

        <div class="row gld-3 justify-content-center py-5">

          <!-- ページ -->
          <div class="col-9 my-5">
            <ul class="list-group list-group-horizontal text-center justify-content-between">
              <li class="col-3 list-group-item bg-secondary ms-3 border">ユーザーIDと生年月日入力</li>
              <li class="col-3 list-group-item border">再発行パスワード入力</li>
              <li class="col-3 list-group-item border">パスワード再発行完了</li>
            </ul>
          </div>
          <!-- /ページ -->

          <!-- 入力セクション -->

          <section class="col-9 center-block mb-4">
          
            <!-- ユーザーID -->
            <div class="row mb-4 text-center ">
              <div class="col-md-2">
                <label for="lgFormGroupInput" class="col-form-label col-form-label-lg text-center">ユーザーID</label>
              </div>
              <div class="col-md-8">
                <input type="text" name="id" class="form-control form-control-lg id-form" id="id" placeholder="123456789">
              </div>
              <div class="err-msg-id mt-1 text-danger"></div>
            </div>
            <!-- /ユーザーID -->



            <!-- 生年月日 -->
            <div class="row mb-4 text-center ">
              <div class="col-md-2">
                <label for="lgFormGroupInput" class="col-form-label col-form-label-lg text-center">生年月日</label>
              </div>
              <div class="col-md-8">
                <input type="text" name="birth" class="form-control form-control-lg birth-form" id="birth" placeholder="19990101">
              </div>
              <div class="err-msg-birth mt-1 text-danger"></div>
            </div>
            <!-- /生年月日 -->
            <p class="text-center text-danger h4"><?= $err; ?></p>
          </section>
          <!-- /入力セクション -->

          <!-- ボタンセクション -->
          <div class="col-6 text-center mb-5">
            <button type="submit" class="btn btn-primary btn-lg" id="submit">送信</button>
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