<?php 
  require_once "./head.php";                //head読み込み
  $cart = "";                               //カート情報取得変数
  $err = "";                                //エラー表示変数
  $check = "";
  $item_total = "";                         //商品毎の合計金額変数
  $total = 0;                               //全商品の合計金額変数
  $result = "";                             //カートクラス呼び出し
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
  $result = new CART();
  if($_SERVER["REQUEST_METHOD"] === "POST")
  {
    $result->CartCountChange($_SESSION[User][User_Id],$_POST["item_id"],$_POST["count"]);
  }
?>

<?php
  $cart = $result->GetUserCart($_SESSION[User][User_Id]);      //カートの情報を取得する

?>


<body>

  <!-- 全体 -->

  <div class="container">
    <div class="row justify-content-around">
      <!-- タイトル -->
      <div class="mx-auto mb-5 ">
        <p class="text-center mt-4 h2">カート</p>
      </div>
      <!-- /タイトル -->
      <?php foreach($cart as $val) { ?>
      <!-- 商品情報セクション -->
      <div class="d-flex row border p-4 mb-4 position-relative">
        <div class="row justify-content-center">
          <!-- 削除ボタン -->
          <form class="" action="" method="POST">
            <input type="submit" class="btn btn-primary position-absolute m-1 p-0 text-light" 
          role="button" value="✖️"  style=" width: 2.5rem; height: 2.5rem; top: 0; right: 0; z-index: 3; background-color: rgba(255,0,0,.3);">
            <input type="hidden" name="item_id" value="<?= $val[Item_Id]?>">
            <input type="hidden" name="count" value="0">
          </form>
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
          </div>
          <!-- /数量 -->
          <div class="d-flex align-items-center btn-group-vertical col-md-2">
            <form class="" action="" method="POST">
              <div class="d-flex mb-3 align-items-center ">
                <label for="exampleInputEmail1" class="form-label me-3">数量</label>
                <input type="number" name="count" value="<?php  if($val[Stock_Count] == 0)
                                                                {
                                                                  echo 0;
                                                                  $item_total = 0;
                                                                  $err = "現在この商品は在庫なしのため購入できません";
                                                                  $check = 999;
                                                                }
                                                                elseif($val[Item_Count] <= $val[Stock_Count])
                                                                {
                                                                  echo $val[Item_Count];
                                                                  $err = "";
                                                                  $item_total = $val[Item_Count] * $val[Item_Price];
                                                                  $total += $item_total;
                                                                  $purch[$val[Item_Id]][Item_Count] = $val[Item_Count];
                                                                  $purch[$val[Item_Id]][Item_Total] = $item_total;
                                                                }
                                                                elseif($val[Item_Count] > $val[Stock_Count])
                                                                {
                                                                  echo $val[Stock_Count];
                                                                  $err = "最大" . $val[Stock_Count] . "までしか買えません<br>変更ボタンを押してください";
                                                                  $item_total = $val[Stock_Count] * $val[Item_Price];
                                                                  $total += $item_total;
                                                                  $purch[$val[Item_Id]][Item_Count] = $val[Stock_Count];
                                                                  $purch[$val[Item_Id]][Item_Total] = $item_total;
                                                                  $check = 999;
                                                                }; 
                                                            ?>" 
                        class="form-control"   style="width: 10rem;">&nbsp;
                <input type="submit" class="btn btn-primary" role="button" value="変更">
              </div>
              <p class="text-center text-danger"><?= $err; ?></p>
              <p class="text-center h4"><?= "金額：" . $item_total . "円" ?></p>
                <input type="hidden" name="item_id" value="<?= $val[Item_Id]?>">
            </form>
          </div>
          <!-- /数量 -->
        </div>
      </div>    
      <?php }; ?>
    </div>
  </div>
  <!-- 購入画面へ -->
  <form method="post" name="form1" action="purchase.php" method="POST">
    <div class="mx-auto mb-5 text-center">
      <p class="h2 mb-5">合計金額：<?= $total ?>円</p>
    <input type="hidden" name="user_id" value="<?= $_SESSION[User][User_Id]; ?>" >
    <input type="hidden" name="total" value="<?= $total; ?>" >
    <?php if(!empty($cart)) { ?>
      <?php if(!($check == 999)) { ?>
        <a class="btn btn-primary" href="javascript:form1.submit()" role="button">購入手続き</a>
      <?php }else{ ?>
        <button class="btn btn-primary" role="button" disabled>購入手続き</button>
      <?php } ?>
    <?php }else{ ?>
      <button class="btn btn-primary" role="button" disabled>購入手続き</button>
    <?php } ?>
    </div>
  </form>
  <!-- /購入画面へ -->
<!-- /全体 -->
</body>

<?php 
  require_once "./footer.php";                  //フッター読み込み
?>

</html>
