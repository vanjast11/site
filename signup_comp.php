<?php 
  require_once "./head.php"; 
?>
<?php require_once "./module/header_set.php";?>
<?php
if($_SERVER["REQUEST_METHOD"] === "GET")
{
  header("Location: index.php");
}

$_SESSION = array();
  $result = new USER();
  //ユーザーの状態フラグが仮登録なことを確認する
  $status = $result->UserGetStatus($_GET["id"]);
  if($status == 0)
  {
  //ユーザーの状態フラグが仮登録の人を本登録に更新してユーザーIDと状態フラグを取得する
    $check = $result->UserStatusChange($_GET["id"]);
    $_SESSION[User][User_Id] = $check[Bb_User_Id];
    $_SESSION[User][User_Name] = $check[Bb_User_Name];
    $_SESSION[User][User_Status] = $check[Bb_User_Status];
  }
?>
</head>
<body class="text-center">
  <main>
    <form>
      <h1 class="h3 mb-3 fw-normal mt-3 text-center">本登録完了いたしました。</h1>
      <div class="row justify-content-center">
        <div class="col-10">
          <br/>
          <br/>
          <p>ご登録ありがとうございました。</p>
          <br/>
          <br/>
          <div class="d-grid gap-2 col-5 mx-auto">
            <button class="btn btn-primary" type="button" onclick="location.href='./index.php'">トップ</button>
          </div>
      	</div>
      </div>
      <br/>
   </form>
  </main>
</body>

<?php require_once "./footer.php" ?>

</html>