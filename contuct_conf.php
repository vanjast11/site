<?php 
  require_once "./head.php"; 
?>
	
</head>

<?php require_once "./module/header_set.php";?>
<?php 
  if($_SERVER["REQUEST_METHOD"] === "GET")
  {
    header("Location: index.php");
  }
?>

<body class="text-center">
  <main>
    <form action="contuct_comp.php" method="POST">
      <h1 class="h3 mb-3 fw-normal mt-3 text-center">お問い合わせ</h1>
      <div class="row justify-content-center">
        <?php if(!isset($_SESSION[User])) { ?>
          <div class="col-10 pb-5">
            <p>お問い合わせ返信先メールアドレス</p>
            <p><?php if(isset($_POST["email"])){ echo $_POST["email"]; }; ?></p>
          </div>
        <?php } ?>
        <div class="col-10">
          <p>お問い合わせタイトル</p>
          <p><?php if(isset($_POST["title"])){ echo $_POST["title"]; }; ?></p>
		    </div>
        <div class="col-8 pt-5">
          <p>お問い合わせ内容</p>
           <div style="word-break: break-all;"><?php if(isset($_POST["content"])){ echo $_POST["content"]; }; ?></div>
        </div>
        <div class="d-grid gap-2 col-5 mx-auto">
        <input type="hidden" name="email" value="<?php if(isset($_POST["email"])){ echo $_POST["email"]; }; ?>">
        <input type="hidden" name="title" value="<?php if(isset($_POST["title"])){ echo $_POST["title"]; }; ?>">
        <input type="hidden" name="content" value="<?php if(isset($_POST["content"])){ echo $_POST["content"]; }; ?>">
          <button class="btn btn-primary mb-3" type="submit">送信</button>
        </div>
      </div>
   </form>
   <form action="contuct.php" method="POST">
     <input type="hidden" name="email" value="<?php if(isset($_POST["email"])){ echo $_POST["email"]; }; ?>">
     <input type="hidden" name="title" value="<?php if(isset($_POST["title"])){ echo $_POST["title"]; }; ?>">
     <input type="hidden" name="content" value="<?php if(isset($_POST["content"])){ echo $_POST["content"]; }; ?>">
      <div class="d-grid gap-2 col-5 mx-auto">
        <button class="btn btn-primary mb-3" type="submit">戻る</button>
      </div>
    </form>
  </main>
</body>

<?php require_once "./footer.php" ?>

</html>