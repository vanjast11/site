<?php 
require_once "head.php";      //head呼び出し
?>
  <!-- ここに自作CSS記入 -->
  <link rel="stylesheet" href="./css/login.css">
</head>

<?php 
  $err = "";

  if($_SERVER["REQUEST_METHOD"] === "POST") //自分へのPOSTできたかのチェック
  {
    $result = new USER(); //クラス呼び出し
    $user = $result->UserLogin($_POST["id"],$_POST["pass"]); //ログインメソッド呼び出し 引数 id,pass 
    if(isset($user[User_Status])){
	    if($user[User_Status] == 1) //正しくログインできたかのチェック
	    {
        $_SESSION = array();
	      $_SESSION[User][User_Id] = $user[User_Id]; //ユーザーidをセッションに入れる
        $_SESSION[User][User_Name] = $user[User_Name]; //ユーザーidをセッションに入れる
	      $_SESSION[User][User_Status] = $user[User_Status]; //状態フラグをセッションに入れる
	      header('Location: ./index.php '); //トップにリダイレクト
	      exit();
	    }
    }
    else 
    {
    	$err = "ID又はパスワードが違います";
    }
  }
?>

<?php require_once "./module/header_set.php";?>

<body class="text-center">
  <main class="form-signin">
    <form action="" method="POST">
      <h1 class="h3 mb-3 fw-normal mt-3 text-center">ログイン</h1>
      <p id="err" class="text-danger"><?= $err ?></p>

      <div class="form-floating">
        <input type="text" class="form-control id-form" id="id" placeholder="id" name="id">
        <label for="floatingInput">ユーザーID</label>
      </div>
      <div class="err-msg-id mt-1 text-danger"></div>

      <div class="form-floating">
        <input type="password" class="form-control pass-form" id="pass" placeholder="pass" name="pass">
        <label for="floatingPassword">パスワード</label>
      </div>
      <div class="err-msg-pass mt-1 text-danger"></div>

      <div class="form-check ps-0 mb-3">
        <label>
          <a href="./user_reissue.php">パスワードお忘れの方</a>
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit" id="submit">ログイン</button>
        <label class="mt-3 mb-5">
          <a href="./signup.php">初めての方はこちら(新規会員登録)</a>
        </label>
   </form>
  </main>
  <script src="./js/user_login_validation.js"></script>
</body>

<?php require_once "./footer.php" ?>

</html>
