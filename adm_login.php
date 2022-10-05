<?php
  require_once "./head.php";      //head呼び出し
?>
</head>

<?php 
  require_once "./module/admin.php"; //ユーザーモジュール呼び出し

  if($_SERVER["REQUEST_METHOD"] === "POST") //自分へのPOSTできたかのチェック
  {
    $result = new ADMIN(); //クラス呼び出し
    $admin_id = $result->AdminLogin($_POST["id"],$_POST["pass"]); //ログインメソッド呼び出し 引数 id,pass 
    if(!empty($admin_id)) //正しくログインできたかのチェック
    {
      $_SESSION["admin_id"] = $admin_id; //ユーザーidをセッションに入れる
      header('Location: ./test1.php'); //トップにリダイレクト
      exit(); //セッションkill
    }
    else //ログイン失敗したら
    {
    	echo "存在しません";
    }
  }
?>

<body class="text-center">
  <main class="form-signin">
    <form action="" method="POST">
      <h1 class="h3 fw-normal mt-5 text-center">ログイン</h1>
      
      <div class="row justify-content-center m-5">
      <div class="form-floating col-7 m-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="id" name="id">
        <label for="floatingInput">ユーザーID</label>
      </div>
      <div class="form-floating col-7 m-3">
        <input type="password" class="form-control" id="floatingPassword" placeholder="pass" name="pass">
        <label for="floatingPassword">パスワード</label>
      </div>
      
      <button class="btn btn-lg btn-primary col-7 m-3" type="submit">ログイン</button>
      </div>
   </form>
  </main>
</body>

</html>
