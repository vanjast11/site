<?php 
  require_once "./head.php";                    //head読み込み


  $err = "";                                    //数量エラー変数
  $item_total = "";                             //商品毎の合計金額変数
  $total = 0;                                   //全商品の合計金額
?>
</head>

<?php 
  require_once "./module/header_set.php";       //ヘッダー切り替えモジュール読み込み
?>
<?php
  if($_SERVER["REQUEST_METHOD"] === "POST")    
  {
    foreach($_SESSION[Cart] as $item_id => $data)
    {
      if($item_id == $_POST["id"])
      {
        $_SESSION[Cart][$item_id][Item_Count] = $_POST["piece"];
      }
    }
  }
?>
<?php
  if(isset($_SESSION[User]))
  {
    header("Location: " . Gamen_Url_Login_Cart);
  }
  if(isset($_SESSION[Cart]))
  {
    $result = new CART();
    $_SESSION[Cart] = $result->guestStockCheck($_SESSION[Cart]);
    
  }
?>

<!-- カート cart.php -->

<body>
  <div class="container">
    <div class="row justify-content-around">
      <!-- タイトル -->
      <div class="mx-auto mb-5 ">
        <p class="text-center mt-4 h2">カート</p>
      </div>
      <!-- /タイトル -->
      <?php if(isset($_SESSION[Cart])) {?>
	      <?php foreach($_SESSION[Cart] as $item_id => $data){?>
					<?php if($data[Item_Count] > 0) {?>
						<!-- 商品情報セクション -->
						<div class="d-flex row border p-4 mb-4 position-relative">
							<div class="row justify-content-center">
								<!-- 削除ボタン -->
								<form class="" action="" method="POST">
									<input type="submit" class="btn btn-primary position-absolute m-1 p-0 text-light" 
								role="button" value="✖️"  style=" width: 2.5rem; height: 2.5rem; top: 0; right: 0; z-index: 3; background-color: rgba(255,0,0,.3);">
									<input type="hidden" name="id" value="<?= $item_id; ?>">
									<input type="hidden" name="piece" value="0">
								</form>
								<!-- 商品写真 -->
								<div class="row card col-md-2" style="width: 14rem; height: 14em">
									<a href="./item_detail.php?id=<?= $item_id; ?>"> <!--商品詳細へ -->
										<img class="card-img-top" src="<?= Img_path . $data[Item_Thum_Image]; ?>" alt="Card image cap">
									</a>
								</div>
								<!-- /商品写真 -->
								<!-- 商品情報 -->
								<div class="card-body text-center col-md-2 ">
		
									<!-- 商品タイトル -->
									<div class="my-3 mx-auto">
										<h3 class="card-title h3"><?= $data[Item_Name]; ?></h3>
									</div>
									<!-- /商品タイトル -->
		
									<!-- 商品金額 -->
									<div class="mx-auto">
										<h3 class="card-title text-danger h3"><?= $data[Item_Price]; ?>円</h3>
									</div>
									<!-- /商品金額 -->
								</div>
								<!-- /数量 -->
								<div class="d-flex align-items-center btn-group-vertical col-md-2">
									<form class="" action="" method="POST">
										<div class="d-flex mb-3 align-items-center ">
											<label for="exampleInputEmail1" class="form-label me-3">数量</label>
											<input type="number" name="piece" value="<?php if($data[Stock_Count] == 0)
																													{
																														echo 0;
																														$item_total = 0;
																														$err = "現在この商品は在庫なしのため購入できません";
																													}
																													elseif($data[Item_Count] <= $data[Stock_Count])
																													{
																														echo $data[Item_Count];
																														$err = "";
																														$item_total = $data[Item_Count] * $data[Item_Price];
																														$total += $item_total;
																													}
																													elseif($data[Item_Count] > $data[Stock_Count])
																													{
																														echo $data[Stock_Count];
																														$err = "最大" . $data[Stock_Count] . "個までしか買えません";
																														$item_total = $data[Stock_Count] * $data[Item_Price];
																														$total += $item_total;
																													}
																										?>"class="form-control" style="width: 10rem;">&nbsp;
											
											<input type="submit" class="btn btn-primary" role="button" value="変更">
										</div>
										<p class="text-center text-danger"><?= $err; ?></p>
										<p class="text-center h4"><?= "金額：" . $item_total . "円" ?></p>
										<input type="hidden" name="id" value="<?= $item_id; ?>">
									</form>
								</div>
								<!-- /数量 -->
							</div>
						</div> 
					<?php } ?>
	      <?php } ?>   
		<?php  }?>       
    </div>
  </div>
  <!-- 購入画面へ -->
  <div class="mx-auto mb-5 text-center">
    <p class="h2 mb-5">合計金額：<?= $total ?>円</p>
    <p class="h3 text-danger">新規会員登録後に購入手続きに進めます</p>
    <a class="btn btn-primary" href="signup.php" role="button">新規会員登録</a>
  </div>
  <!-- /購入画面へ -->
</body>
<?php 
require_once "./footer.php"           //フッター読み込み
?>
</html>