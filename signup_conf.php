<?php 
  require_once "./head.php"; 
?>
    <!--自作CSS -->
    <style type="text/css">
        /*ここに調整CSS記述*/
    </style>
</head>
<?php require_once "./module/header_set.php";?>

<?php if($_SERVER["REQUEST_METHOD"] === "POST"){?>
<body>

<h1 class="h3 mt-5 text-center">新規会員登録</h1>

<!-- Page Content -->
<div class="container text-center p-lg-5 ">

      <!--ユーザーID-->
      <div class="form-group row justify-content-center">
            <label for="inputId" class="col-sm-6 col-form-label">会員ID</label>
            <div class="col-sm-6">
              <p><?= $_POST["id"]; ?></p>
            </div>
        </div>
        <!--/ユーザーID-->

        <!--名前-->
        <div class="form-group row justify-content-center">
            <label for="inputName" class="col-sm-6 col-form-label">名前</label>
            <div class="col-sm-6">
              <p><?= $_POST["name"]; ?></p>
            </div>
        </div>
        <!--/名前-->

        <!--ふりがな-->
        <div class="form-group row">
            <label for="inputRuby" class="col-sm-6 col-form-label">ふりがな</label>
            <div class="col-sm-6">
              <p><?= $_POST["ruby"]; ?></p>
            </div>
        </div>
        <!--/ふりがな-->

        <!--生年月日-->
        <div class="form-group row">
            <label for="inputBirth" class="col-sm-6 col-form-label">生年月日</label>
            <div class="col-sm-6">
              <p><?= $_POST["birth"]; ?></p>
            </div>
        </div>
        <!--/ふりがな-->


        <!--Eメール-->
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-6 col-form-label">Eメール</label>
            <div class="col-sm-6">
              <p><?= $_POST["email"]; ?></p>
            </div>
        </div>
        <!--/Eメール-->

        <!--パスワード-->
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-6 col-form-label">パスワード</label>
            <div class="col-sm-6">
              <p><?= $_POST["pass"]; ?></p>
            </div>
        </div>
        <!--/パスワード-->

        <!--郵便番号-->
        <div class="form-group row">
          <label for="inputPost" class="col-sm-6 col-form-label">電話番号</label>
          <div class="col-sm-6">
            <p><?= $_POST["tel"]; ?></p>
          </div>
        </div>
        <!--/郵便番号-->

        <!--郵便番号-->
        <div class="form-group row">
            <label for="inputPost" class="col-sm-6 col-form-label">郵便番号</label>
            <div class="col-sm-6">
              <p><?= $_POST["post"]; ?></p>
            </div>
        </div>
        <!--/郵便番号-->

        <!--都道府県-->
        <?php
          $result =  new USER();
          $pref_name = $result->GetPrefName($_POST["pref"]);
        ?>
        <div class="form-group row">
            <label for="inputPref" class="col-sm-6 col-form-label">都道府県</label>
            <div class="col-sm-6">
              <p><?= $pref_name[Bb_Pref_Name]; ?></p>
            </div>
        </div>
        <!--/都道府県-->

        <!--住所-->
        <div class="form-group row">
            <label for="inputAdd" class="col-sm-6 col-form-label">住所</label>
            <div class="col-sm-6">
              <p><?= $_POST["add"]; ?></p>
            </div>
        </div>
        <!--/住所-->

        <!--性別-->
        <?php
          $result =  new USER();
          $sex_name = $result->GetSex($_POST["sex"]);
        ?>
            <div class="row form-group mb-4">
                <label class="col-form-label col-sm-6">性別</label>
                <div class="col-sm-6">
                  <p><?= $sex_name[Bb_Sex_Name]; ?></p>
                </div>
            </div>
        <!--/性別-->
        <div class="col-12 text-center d-sm-flex justify-content-center">

    <form action="./signup_tmp.php" class="m-2" method="POST">
      <input type="hidden" name="id" value="<?= $_POST["id"]; ?>">
			<input type="hidden" name="name" value="<?= $_POST["name"]; ?>">
			<input type="hidden" name="ruby" value="<?= $_POST["ruby"]; ?>">
			<input type="hidden" name="birth" value="<?= $_POST["birth"]; ?>">
			<input type="hidden" name="email" value="<?= $_POST["email"]; ?>">
      <input type="hidden" name="pass" value="<?= $_POST["pass"]; ?>">
			<input type="hidden" name="post" value="<?= $_POST["post"]; ?>">
      <input type="hidden" name="pref" value="<?= $_POST["pref"]; ?>">
      <input type="hidden" name="add" value="<?= $_POST["add"]; ?>">
      <input type="hidden" name="sex" value="<?= $_POST["sex"]; ?>">
      <input type="hidden" name="tel" value="<?= $_POST["tel"]; ?>">

      <!--ボタンブロック-->
      <button onclick="location.href='./index.php'" class="btn btn-primary col-12 col-sm-12 btn-lg m-2">仮登録</button>
    </form>
    <form action="signup.php" class="m-2" method="POST">
      <input type="hidden" name="id" value="<?= $_POST["id"]; ?>">
			<input type="hidden" name="name" value="<?= $_POST["name"]; ?>">
			<input type="hidden" name="ruby" value="<?= $_POST["ruby"]; ?>">
			<input type="hidden" name="birth" value="<?= $_POST["birth"]; ?>">
			<input type="hidden" name="email" value="<?= $_POST["email"]; ?>">
      <input type="hidden" name="pass" value="<?= $_POST["pass"]; ?>">
			<input type="hidden" name="post" value="<?= $_POST["post"]; ?>">
      <input type="hidden" name="pref" value="<?= $_POST["pref"]; ?>">
      <input type="hidden" name="add" value="<?= $_POST["add"]; ?>">
      <input type="hidden" name="sex" value="<?= $_POST["sex"]; ?>">
      <input type="hidden" name="tel" value="<?= $_POST["tel"]; ?>">
      <button onclick="location.href='./login.php'" class="btn btn-primary col-12 btn-lg m-2">戻る</button>
    </form>   
        </div>
        <!--/ボタンブロック-->

</div>
<script>

</script>
</body>

<?php require_once "footer.php"; ?>
</html>

<?php }else{ header("Location: ./signup.php");}; ?>