<?php 
  require_once "./head.php";                //head読み込み
  $err = "";
?>
</head>
<?php 
  require_once "./module/header_set.php";   //ヘッダー切り替えモジュール読み込み
?> 

<?php
  if(!isset($_SESSION[User]))
  {
    header("Location: guest_cart.php");
  }
?>
<?php
  $result = new USER();
  $brow = $result->GetBrowList($_SESSION[User][User_Id]);
  if(empty($brow))
  {
    $err = "最近閲覧した商品はありません";
  }
?>

<body>

  <!-- 全体 -->

  <div class="container">
    <div class="row justify-content-around">
      <!-- タイトル -->
      <div class="mx-auto mb-5 ">
        <p class="text-center mt-4 h2">閲覧履歴</p>
      </div>
      <?php if(empty($err)) { ?>
        <!-- /タイトル -->
        <?php foreach($brow as $val) { ?>
        <!-- 商品情報セクション -->
        <div class="d-flex row border p-4 mb-4 ">
          <div class="row justify-content-center">
            <!-- 商品写真 -->
            <div class="row card col-md-2" style="width: 14rem; height: 14em">
              <a href="./item_detail.php?id=<?= $val[Item_Id];?>"> <!--商品詳細へ -->
                <img class="card-img-top" src="<?= Img_path . $val[Item_Thum_Image];?>" alt="Card image cap">
              </a>
            </div>
            <!-- /商品写真 -->
            <!-- 商品情報 -->
            <div class="card-body text-center col-md-2 ">

              <!-- 商品タイトル -->
              <div class="my-3 mx-auto">
                <h3 class="card-title h3"><?= $val[Item_Name];?></h3>
              </div>
              <!-- /商品タイトル -->

              <!-- 商品金額 -->
              <div class="mx-auto">
                <h3 class="card-title text-danger h3"><?= $val[Item_Price];?>円</h3>
              </div>
              <!-- /商品金額 -->
              <div class="d-flex mb-3 align-items-center ">
                  <a href="item_detail.php?id=<?= $val[Item_Id]; ?>" class="btn btn-primary col-5 mx-auto mt-3">商品ページ</a>
                </div>
            </div>
          </div>
        </div>    
        <?php }; ?>
      <?php }else{ ?>
        <p class="text-center text-danger h3"><?= $err; ?></p>
        <?php } ?>
    </div>

  </div>
<!-- /全体 -->
</body>

<?php 
  require_once "./footer.php";                  //フッター読み込み
?>

</html>

