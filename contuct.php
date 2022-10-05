<?php 
  require_once "./head.php"; 
?>
	
</head>

<?php require_once "./module/header_set.php";?>

<body class="text-center">
  <main>
    <form action="contuct_conf.php" method="POST">
      <h1 class="h3 mb-3 fw-normal mt-3 text-center">お問い合わせ</h1>
      <div class="row justify-content-center">
        <?php if(!isset($_SESSION[User])) { ?>
          <div class="col-10 pb-5">
            <p>お問い合わせ返信先メールアドレス</p>
            <input type="text" name="email" class="col-6" value="<?php if(isset($_POST["email"])){ echo $_POST["email"]; }; ?>">
          </div>
        <?php } ?>
        <div class="col-10">
          <p>お問い合わせタイトル</p>
          <select name="title" class="col-12">
            <option value="返品について">返品について</option>
            <option value="交換について">交換について</option>
            <option value="納期確認">納期確認</option>
          </select>
		</div>
        <div class="col-10 pt-5">
        <p>お問い合わせ内容</p>
          <select name="content" class="col-12">
            <option value="返品したいです">返品したいです</option>
            <option value="交換したいです">交換したいです</option>
            <option value="納期を確認したいです">納期を確認したいです</option>
          </select>
        </div>
        <div class="d-grid gap-2 col-5 mx-auto pt-4">
          <button class="btn btn-primary mb-3" type="submit">確認</button>
        </div>
      </div>
   </form>
  </main>
</body>

<?php require_once "./footer.php" ?>

</html>