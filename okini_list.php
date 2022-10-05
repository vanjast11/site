<?php
require_once "./head.php"; // head読み込み
$recom = array();
$err = "";
$flg = 0;
?>
</head>
<?php
require_once "./module/header_set.php"; // ヘッダー切り替えモジュール読み込み
?> 





<?php
$result = new USER ();
if ($_SERVER ["REQUEST_METHOD"] === "POST") { 
	if(isset($_POST["del"]))
	{
		for($i = 0; $i < count($_SESSION["favo"]); $i++)
			{
				if($_SESSION["favo"][$i]["item_id"] == $_POST["item_id"])
				{
					if($_SESSION["favo"][$i]["favo_flg"] == 1)
					{
						$_SESSION["favo"][$i]["favo_flg"] = 0;
					}
					else
					{
						$_SESSION["favo"][$i]["favo_flg"] = 1;
					}
				}
			}
	}

	if(isset($_POST["dbfavodel"]))
	{
		$result->SetRecomItem ( $_SESSION [User] [User_Id], $_POST ["item_id"], $_POST ["count"] );
		// F5キー対策
		header ( "Location:okini_list.php" );
		exit ();
	}
}

?>
<?php
if(isset($_SESSION[User]))
{
	$recom = $result->GetRecomItem ( $_SESSION [User] [User_Id] );
	if (empty ( $recom )) {
		$err = "お気に入りの商品はありません";
	}
}
?>

<body>

	<!-- 全体 -->
	<div class="container">
		<div class="row justify-content-around">
			<!-- タイトル -->
			<div class="mx-auto mb-5 ">
				<p class="text-center mt-4 h2">お気に入り</p>
			</div>
      <?php if(empty($err)) { ?>
				<?php if(isset($_SESSION[User])) { ?>
					<!-- /タイトル -->
					<?php foreach($recom as $val) { ?>
						<!-- 商品情報セクション -->
						<div class="d-flex row border p-4 mb-4 position-relative">
							<div class="row justify-content-center">
								<!-- 削除ボタン -->
								<form action="" method="POST">
									<input type="submit"
										class="btn btn-primary position-absolute m-1 p-0 text-light"
										role="button" name="dbfavodel" value="✖"
										style="width: 2.5rem; height: 2.5rem; top: 0; right: 0; z-index: 3; background-color: rgba(255, 0, 0, .3);">
									<input type="hidden" name="item_id" value="<?= $val[Item_Id]; ?>"> <input
										type="hidden" name="count" value="0">
								</form>
								<!-- 商品写真 -->
								<div class="row card col-md-2" style="width: 14rem; height: 14em">
									<a href="./item_detail.php?id=<?= $val[Item_Id];?>"> <!--商品詳細へ -->
										<img class="card-img-top"
										src="<?= Img_path . $val[Item_Thum_Image];?>"
										alt="Card image cap">
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
										<a href="item_detail.php?id=<?= $val[Item_Id]; ?>"
											class="btn btn-primary col-5 mx-auto mt-3">商品ページ</a>
									</div>
								</div>
							</div>
						</div>    
					<?php }; ?>
				<?php }else{ ?>
					<!-- /タイトル -->
					<?php if(isset($_SESSION["favo"])) {?>
						<?php foreach($_SESSION["favo"] as $val) { ?>
							<?php if($val["favo_flg"] == 0 ) { ?>
								<?php $flg = 999; ?>
								<!-- 商品情報セクション -->
								<div class="d-flex row border p-4 mb-4 position-relative">
									<div class="row justify-content-center">
										<!-- 削除ボタン -->
										<form action="" method="POST">
											<input type="hidden" name="item_id" value="<?= $val[Item_Id]; ?>"> 
											<input type="hidden" name="count" value="0">
											<input type="submit" name="del"
												class="btn btn-primary position-absolute m-1 p-0 text-light"
												role="button" value="✖"
												style="width: 2.5rem; height: 2.5rem; top: 0; right: 0; z-index: 3; background-color: rgba(255, 0, 0, .3);">
										</form>
										<!-- 商品写真 -->
										<div class="row card col-md-2" style="width: 14rem; height: 14em">
											<a href="./item_detail.php?id=<?= $val[Item_Id];?>"> <!--商品詳細へ -->
												<img class="card-img-top"
												src="<?= Img_path . $val[Item_Thum_Image];?>"
												alt="Card image cap">
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
												<a href="item_detail.php?id=<?= $val[Item_Id]; ?>"
													class="btn btn-primary col-5 mx-auto mt-3">商品ページ</a>
											</div>
										</div>
									</div>
								</div>
							<?php }else{ ?>
							<?php } ?>    
						<?php }; ?>
						<?php if($flg == 0){ ?>
							<p class="text-center text-danger h3">お気に入りの商品はありません</p>
						<?php } ?>
					<?php } else { ?>
						<p class="text-center text-danger h3">お気に入りの商品はありません</p>
					<?php } ?>
				<?php }; ?>
      <?php }else{ ?>
        <p class="text-center text-danger h3"><?= $err; ?></p>
      <?php } ?>
    </div>

	</div>
	<!-- /全体 -->
</body>

<?php
require_once "./footer.php"; // フッター読み込み
?>

</html>

