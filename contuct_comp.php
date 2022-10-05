<?php 
  require_once "./head.php"; 

  mb_language("Japanese");
  mb_internal_encoding("UTF-8");


  if($_SERVER["REQUEST_METHOD"] === "GET")
  {
    header("Location: index.php");
  }

if(isset($_SESSION[User]))
{
  $result = NEW contuct();
  $result->UserSetContuct($_SESSION[User][User_Id], $_POST["title"], $_POST["content"]);
}
else
{
  $to = $_POST["email"];   //送り先
  $title = 'title２';                  //件名
  $message = "お問い合わせいただきありがとうございます。運営からの返信をお待ちください。";                 //本文
  $headers = "From: web21g1@websystem.rulez.jp";       //送り主
  mb_send_mail($to, $title, $message, $headers);
  
  $result = NEW contuct();
  $result->GuestSetContuct($_POST["title"], $_POST["content"]);
}

?>
	
</head>

<?php require_once "./module/header_set.php";?>

<body class="text-center">
  <main>
      <h1 class="h3 mb-3 fw-normal mt-3 text-center">お問い合わせ内容を送信しました。</h1>
      <div class="row justify-content-center">
      <?php if(isset($_POST["email"])){ ?>  
        <p>ご登録いただいたメールアドレス宛に返信致します。</p>
      <?php } ?>
        <p>返信までしばらくお待ちください。</p>
        <div class="d-grid gap-2 col-5 mx-auto">
          <button class="btn btn-primary mb-3" type="button" onclick="location.href='index.php'">トップ</button>
        </div>
      </div>
  </main>
</body>

<?php require_once "./footer.php" ?>

</html>

