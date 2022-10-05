<?php 
  require_once "./head.php"; 
  date_default_timezone_set('UTC');
  $mk = mktime(0, 0, 0, date("m")  , date("d")+3, date("Y"));
?>
	
</head>

<?php require_once "./module/header_set.php";?>
<?php 
if($_SERVER["REQUEST_METHOD"] === "POST")
{
  $result = new CART();
  $end = $result->BuyComp($_POST["user_id"]);
}
else
{
  header("Location: login_cart.php");
}
?>

<body class="text-center">
  <main>
    <form>
      <h1 class="h3 mb-3 fw-normal mt-3 text-center">ご購入ありがとうございました。</h1>
      <div class="row justify-content-center">
        <div class="col-10">
          <br/>
          <br/>
          <p class="h4 mb-5"><?= date("Y年m月d日",$mk) ?>に配送いたします。</p>
          <p>発送後の変更はお受けできない場合がございます。<br/>
          	変更は早めにお願いいたします。</p>
          <p>発送後の配送変更は配送業者にお願いいたします。</p>
          <br/>
          <br/>
          <div class="d-grid gap-2 col-4 mx-auto">
            <a class="btn btn-primary" href="index.php" type="button">トップ</a>
          </div>
      	</div>
      </div>
      <br/>
   </form>
  </main>
</body>

<?php require_once "./footer.php" ?>

</html>