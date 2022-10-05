<?php 
  require_once "./head.php"; 											//head読み込み

	$get = "";																			//商品クラス呼び出し変数
	$detail = "";																		//商品詳細情報取得変数
	$result = "";																		//カートクラス呼び出し
	$err = "";																			//エラー表示変数
	$relation = "";																	//関連商品情報取得変数
	$relation_count = "";		
	$flg = "ng";											//関連商品ループ変数
	$guestfavoflg = "0";
?>
	<link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme.css">
	<link rel="stylesheet" href="css/detail.css">
	<style>
		#avg img {
			width:15px;
			height:15px;
		}
		
		#rev1 img,
		#rev2 img,
		#rev3 img,
		#rev4 img,
		#rev5 img {
		 	width:15px;
			height:15px;
		 }
		
	</style>
</head>
<?php
 require_once "./module/header_set.php";					//ヘッダー切り替えモジュール読み込み
?>
<?php 
if(!isset($_GET["id"]))
{
	header("Location: index.php");
}

	$get = new ITEM();															//商品クラス呼び出し
	$detail = $get->GetDetailItem($_GET["id"]);			//商品詳細メソッド呼び出し

	// ログインユーザーお気に入り
	if (isset($_POST['submit1'])) 
	{
		$result->SetRecomItem($_SESSION[User][User_Id], $_POST ["item_id"], $_POST ["count"]);
		header ( "Location:okini_list.php" );
		exit ();
	}

	//ゲストお気に入り
	if (isset($_POST['submit2'])) 
	{
		if(isset($_SESSION["favo"]))
		{
			for($i = 0; $i < count($_SESSION["favo"]); $i++)
			{
				if($_SESSION["favo"][$i]["item_id"] == $_POST["item_id"])
				{
					if($_SESSION["favo"][$i]["favo_flg"] == 1)
					{
						$_SESSION["favo"][$i]["favo_flg"] = 0;
						$favoflg = 99999;
					}
					else
					{
						$_SESSION["favo"][$i]["favo_flg"] = 1;
						$favoflg = 99999;
					}
				}
			}

			if(!(isset($favoflg)))
			{
				$_SESSION["favo"][$i]["item_id"] = $_POST["item_id"];
				$_SESSION["favo"][$i]["item_name"] = $_POST["item_name"];
				$_SESSION["favo"][$i]["item_price"] = $_POST["item_price"];
				$_SESSION["favo"][$i]["item_thum_image"] = $_POST["item_thum_image"];
				$_SESSION["favo"][$i]["favo_flg"] = 0;
			}
		}
		else
		{
			$_SESSION["favo"][0]["item_id"] = $_POST["item_id"];
			$_SESSION["favo"][0]["item_name"] = $_POST["item_name"];
			$_SESSION["favo"][0]["item_price"] = $_POST["item_price"];
			$_SESSION["favo"][0]["item_thum_image"] = $_POST["item_thum_image"];
			$_SESSION["favo"][0]["favo_flg"] = 0;
		}
		header ( "Location:okini_list.php" );
	}
	// echo "<pre>";
	// var_dump($_SESSION["favo"]);
	// var_dump($_POST);
	// echo "</pre>";
  //ログインユーザーがカートに入れるを押したらカートTBに登録
	if(isset($_POST["submit3"]))
	{
		if(isset($_SESSION[User][User_Id]))
		{
			//カートDBに登録
			$result = new CART();
			$err = $result->UserCartIn($_SESSION[User][User_Id],$_GET["id"],$_POST["piece"]);
			//login_cart.phpに移動
			header("Location: login_cart.php");
		}
			
		if(isset($_SESSION[Cart][$_GET["id"]]))
		{
			foreach($_SESSION[Cart] as $key => $val)
			{
				if($key == $_GET["id"])
				{
					$_SESSION[Cart][$_GET["id"]][Item_Count] += $_POST["piece"];
				}
			}
		}
		else
		{
			$_SESSION[Cart][$_GET["id"]][Item_Count] = $_POST["piece"];
		}
		header("Location: guest_cart.php");
	}

//閲覧履歴に登録
if(isset($_SESSION[User][User_Id]))
{
	$result = new USER();
	$result->SetBrowList($_SESSION[User][User_Id],$_GET["id"]);
}

?>
<body class="text-center">
<main>
	<div class="container">
	<div class="row justify-content-center">
	<div class="col-sm-12 col-md-9 d-md-flex">
	<div class="col-sm-12 col-md-6 justify-content-center">
		<!-- 商品画像 -->
		<div class="row justify-content-center">
		<div class="col-sm-12 col-md-8">
			<div class="m-2 slider" >
				<img src="<?= Img_path .  $detail[Item_Image_1]; ?>" class="img-fluid" alt="Responsive image">
				<img src="<?= Img_path .  $detail[Item_Image_2]; ?>" class="img-fluid" alt="Responsive image">
				<img src="<?= Img_path .  $detail[Item_Image_3]; ?>" class="img-fluid" alt="Responsive image">
			</div>
		</div>
		</div>
		
		<!-- お気に入りボタン -->
		<!-- ログインユーザー -->
			<?php if(isset($_SESSION[User])) { 
				$favo = $result->GetFavoItem($_SESSION[User][User_Id], $_GET["id"]); ?>
				<form action="" method="post" class="mt-3">
					<?php	if ($favo == $_GET["id"]) { ?>
							<input type="submit" class="btn btn-warning" name="submit1" value="お気に入り解除">
					<?php } else { ?>
							<input type="submit" class="btn btn-success" name="submit1" value="お気に入り登録">
					<?php } ?>
							<input type="hidden" name="item_id" value="<?= $detail["item_id"] ?>"> 
							<input type="hidden" name="count" value="0">
				</form>
			<?php } else { ?>
		
				<!-- ゲスト -->
				<form action="" method="post" class="mt-3">
				<!-- ゲストお気に入りセッションの有無のチェック -->
					<?php if (isset($_SESSION["favo"])) { ?>
				<!-- お気に入りセッションがあるだけループ -->
						<?php	for($i = 0; $i < count($_SESSION["favo"]); $i++) { ?>
				<!-- お気に入りセッションにGETの商品IDがあり、かつお気に入り状態なら解除ボタン表示 -->
							<?php	if($_SESSION["favo"][$i]["item_id"] == $_GET["id"] && $_SESSION["favo"][$i]["favo_flg"] == 0) { ?>

									<input type="submit" class="btn btn-warning" name="submit2" value="お気に入り解除">
									<?php $guestfavoflg = "999"; ?>
				<!-- お気に入りセッションにGETの商品IDがあり、かつ解除状態なら登録ボタン表示 -->
							<?php } elseif($_SESSION["favo"][$i]["item_id"] == $_GET["id"] && $_SESSION["favo"][$i]["favo_flg"] == 1) { ?>

									<input type="submit" class="btn btn-success" name="submit2" value="お気に入り登録">
									<?php $guestfavoflg = "999"; ?>

							<?php }?>

						<?php } ?>
				<!-- お気に入りセッションに商品がなかったらお気に入り登録ボタン表示 -->
						<?php if(!($guestfavoflg == 999)) { ?>

								<input type="submit" class="btn btn-success" name="submit2" value="お気に入り登録"> 

						<?php }?>
				<!-- お気に入りセッションがなかったら登録ボタン表示 -->
					<?php }else{ ?>

						<input type="submit" class="btn btn-success" name="submit2" value="お気に入り登録">

					<?php } ?>

							<input type="hidden" name="item_id" value="<?= $detail[Item_Id] ?>"> 
							<input type="hidden" name="item_name" value="<?= $detail[Item_Name] ?>"> 
							<input type="hidden" name="item_price" value="<?= $detail[Item_Price] ?>"> 
							<input type="hidden" name="item_thum_image" value="<?= $detail[Item_Thum_Image] ?>"> 
				</form>
			<?php } ?>
	</div>
		
		<?php require_once "./module/review_module.php"; ?>
		<?php 
		$result = new REVIEW();
		$rev = $result->GetRevStatus($_GET["id"]);
		?>
	<div class="col-md-7 col-sm-12 justify-content-center">	
		<form action="" method="POST"> 
			<!-- 商品名 -->
			<div class="m-2 p-2">
				<div class="h4 m-3"><?= $detail[Item_Name]; ?></div>
			</div>
			
			<!-- レビュー -->
			<div class="justify-content-center col-12">
			<div class="mt-2">平均評価</div>
				<div class="d-flex justify-content-center col-12">
					<div id="avg" class=""></div>
					<p class="ms-2"><?= $rev["Avg"]["Rev_Status"] ?></p>
				</div>
				<?php for($revstatus = 1; $revstatus <= 5; $revstatus++, $flg = "ng"){ ?>
					<div class="d-flex justify-content-center">
						<div id="rev<?= $revstatus ?>" class=""></div>
						<?php 
						if(isset($rev))
						{
							foreach($rev as $status => $count)
							{
								if(isset($count["Rev_Status"]) && $count["Rev_Status"] == $revstatus)
								{
									echo '<div class="ms-2">' . $count["Count"] . "件</div>";
									$flg = "ok";
									break;
								}
								else
								{
								}
							}
							if($flg == "ng")
							{
								echo '<div class="ms-2">' . "0件" . '</div>';
							}
						}
						else
						{
							echo '<div class="ms-2">' . "0件" . '</div>';
						}
						?>
					</div>
				<?php } ?>
			
			<a href="./review.php?id=<?= $_GET["id"]; ?>">レビュー</a>
			</div>
			
			
			<!-- 商品説明等 -->
			<p class="mt-4" ><?= $detail[Item_Explanation]; ?></p>
			<div>購入可能数：<span id="count"><?= $detail[Stock_Count]; ?></span></div>
			<div>個数：<input type="number" name="piece" value="1" size="1" id="piece" class="piece-form col-1"></div>
			<div class="err-msg-piece mt-1 text-danger"></div>
			<div>価格：<?= $detail[Item_Price]; ?>円</div>
			<div class="d-grid gap-2 col-8 mx-auto m-2">
			<button class="btn btn-primary mb-2" type="submit" id="submit" name="submit3" value="cart">カートに入れる</button>
			
			</div>
		</form>
	</div>	

	</div>
	</div>
	</div>
	<div>
		<!-- 関連商品 -->
		<?php 
			$relation = $get->SimilarItem($_GET["id"]);  //関連商品取得
		?>
		<div class="h5 border m-2 p-2">
		<div class="m-2">関連商品</div>
		<div class="img">
		
		<?php for($relation_count = 0; $relation_count < count($relation); $relation_count++ ) {?>
			<a href="./item_detail.php?id=<?= $relation[$relation_count][Item_Id]; ?>">
				<img src="<?= Img_path .  $relation[$relation_count][Item_Thum_Image]; ?>" class="img-fluid" alt="Responsive image">
			</a>
		<?php } ?>
		
		</div>
		</div>
		
	</div>
</main>

	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/main.js"></script>
	<script src="js/item_detail_validation.js"></script>
	<script src="./js/jquery.raty.js"></script>
	
	<script>
	var avg = <?= json_encode($rev["Avg"]["Rev_Status"]); ?>;
	
    $(function(){
        $('#avg').raty({
            score: avg,
            size: 2
        });
        
        $('#rev1').raty({
            score: 1
        });
        $('#rev2').raty({
            score: 2
        });
        $('#rev3').raty({
            score: 3
        });
        $('#rev4').raty({
            score: 4
        });
        $('#rev5').raty({
            score: 5
        });
    });
    </script>

</body>

<?php
 require_once "./footer.php"    					//フッター読み込み
?>
</html>