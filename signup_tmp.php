<?php
  require_once "./head.php"; 
      $id =   $_POST["id"];
      $name = $_POST["name"];
      $ruby = $_POST["ruby"];
      $sex =  $_POST["sex"];
      $pass = $_POST["pass"];
      $birth = $_POST["birth"];
      $post = $_POST["post"];
      $pref = $_POST["pref"];
      $add = $_POST["add"];
      $tel =  $_POST["tel"];
      $email = $_POST["email"];
      $err = "";
?>
</head>

<!-- header 呼び出し -->
<?php require_once "./module/header_set.php";?>

<?php
if($_SERVER["REQUEST_METHOD"] === "GET")
{
  header("Location: index.php");
}
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");

  $to = $_POST["email"];   //送り先
  $title = 'title２';                  //件名
  $message = "本登録はこちら  " .  $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . Gamen_Url_User_SignUp_Comp . "?id="  . $id  . "   １時間以内に本登録を完了してください";                 //本文
  $headers = "From: web21g1@websystem.rulez.jp";       //送り主
  if(mb_send_mail($to, $title, $message, $headers))     //順番遵守
  {
    $result = new USER();
    $result->SetNewUser();
  }
  else
  {
    $err = "メール送信できませんでした。<br> 再度登録し直してください";
  }
 ?>
<!-- head 呼び出し -->
<?php require_once "head.php"?>

</head>

<!-- header 呼び出し -->
<?php require_once "./module/header_set.php";?>
<?php 

?>
<body class="text-center">
  <main>
    <form>
    <?php if(empty($err)) { ?>
      <h1 class="h3 mb-3 fw-normal mt-3 text-center">仮登録完了いたしました。</h1>
      <div class="row justify-content-center">
        <div class="col-10">
          <br/>
          <br/>
          <p>ご登録いただいたメールアドレスにメールを送信いたしました。</p>
          <p>1時間以内にURLから本登録をお願いいたします。</p>
          <br/>
          <br/>
          <div class="d-grid gap-2 col-5 mx-auto">
            <button class="btn btn-primary" type="button" onclick="location.href='./index.php'">トップ</button>
          </div>
      	</div>
      </div>
      <br/>
    <?php }else{ ?>
      <h1 class="h3 mb-3 fw-normal mt-3 text-center text-denger"><?= $err; ?></h1>
      <div class="row justify-content-center">
        <div class="col-10">
          <br/>
          <br/>
          <div class="d-grid gap-2 col-5 mx-auto">
            <button class="btn btn-primary" type="button" onclick="location.href='./index.php'">トップ</button>
          </div>
      	</div>
      </div>
      <br/>
      <?php } ?>
   </form>
  </main>
</body>