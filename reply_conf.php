<?php 
  require_once "./head.php"; 
?>
	
</head>
<?php 
	// ログインしていなかったらログインページへ
	if (!isset($_SESSION[User])) {
		header('Location: index.php');
	}
?>
<?php 
  $result = NEW CONTUCT();
  $contuct = $result->UserGetContuct($_SESSION[User][User_Id]);
?>
<body class="text-center">


<?php require_once "./module/header_set.php";?>
  <main>

      <h1 class="h3 mb-3 fw-normal mt-3 text-center">お問い合わせ</h1>
      <?php if(!empty($contuct)) { ?>
        <?php foreach($contuct as $key => $val) { ?>
          <div class="row justify-content-center mt-5 " style="border:2px solid; width:50%; margin:0 auto;">
          <?php if(!empty($val["contuct_reply"])){ ?>    
            <p class="text-danger">返信あり</p>
          <?php } ?>
              <div class="col-12">
                <p>お問い合わせ日時</p>
                <p><?= $val["contuct_time"]; ?></p>
              </div>

              <div class="col-12">
                <p>お問い合わせタイトル</p>
                <p><?= $val["title"]; ?></p>
              </div>

              <div class="col-12">
              <p>お問い合わせ内容</p>
              <p><?= $val["content"]; ?></p>
              </div>

              <div class="col-12">
              <p>返信日時</p>
              <p><?= $val["reply_time"]; ?></p>
              </div>

              <div class="col-12">
              <p>返信内容</p>
              <p><?= $val["contuct_reply"]; ?></p>
              </div>

          </div>
          
        <?php } ?>  
      <?php }else{ ?>
        <p>お問い合わせはありません</p>
      <?php } ?>
  </main>
</body>
<?php require_once "./footer.php" ?>

</html>