<?php 
  require_once "./head.php"; 
?>
	<style>
		.h5 { border-bottom: solid;
			  position: relative; }
	</style>

</head>

<?php require_once "./module/header_set.php";?>

<?php
$total = 0;
$use_point = 0;
$pref_id = 1;
$available_point = 0;
if(isset($_POST["total"]))
{
	$total = $_POST["total"];
}
elseif (isset($_POST["order_money"]))
{
	$total = $_POST["order_money"];
}
if(isset($_POST["use_point"]))
{
	$use_point = $_POST["use_point"];
}

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$result1 = new CART();
		$purch = $result1->GetUserData($_POST["user_id"]);
		$result2 = new USER();
		$have_point = $result2->GetHavePoint($_SESSION[User][User_Id]);
		if($total <= $have_point["User_Have_Point"])
		{
			$available_point = $total;
		}
		else
		{
			$available_point = $have_point["User_Have_Point"];
		}
		if(isset($_POST["change_pref"]))
		{
			$pref_name = $_POST["change_pref"];
			$result_pref_id = $result2->GetPrefId($_POST["change_pref"]);
		}
		if(isset($result_pref_id))
		{
			$pref_id = $result_pref_id[Bb_Pref_Id];
		}
		elseif (isset($purch))
		{
			$pref_id = $purch[Bb_Pref_Id];
		}
	}
	else
	{
		header("Location: ./index.php");
	}

?>


<body class="text-center">
  <main>
      <h1 class="h3 mb-3 fw-normal mt-3 border-bottom">購入手続き</h1>
     		<div class="row justify-content-center">
      	<div class="col-10">
					<div id="regidelidata" class="col-12">
						<p class="h5">お届け先</p>
						<p class="h6">お名前</p>
						<p id="displayname"><?= $purch[Bb_User_Name]; ?></p>
						
						<p class="h6">ふりがな</p>
						<p id="displayruby"><?= $purch[Bb_User_Ruby]; ?></p>
						
						<p class="h6">郵便番号</p>
						<p id="displaypost"><?= $purch[Bb_User_Post]; ?></p>

						
						<p class="h6">都道府県</p>
						<p><span id="displaypref" class="d-none"><?= $purch[Bb_Pref_Id]; ?></span><?= $purch[Bb_Pref_Name]; ?></p>
						
						<p class="h6">住所</p>
						<p id="displayadd"><?= $purch[Bb_User_Add]; ?></p>
						
						<p class="h6">電話番号</p>
						<p id="displaytel"><?= $purch[Bb_User_Tel]; ?></p>
					</div>

					<div id="changedelidata" class="col-12  d-none">
						<p class="h5">お届け先</p>
						<p class="h6">お名前</p>
						<!-- <input id="inputname" class="mb-2" type="text" value=""> -->
						<select name="" id="inputname">
							<option value="山田太郎">山田太郎</option>
							<option value="佐藤花子">佐藤花子</option>
							<option value="田中ジョニー">田中ジョニー</option>
						</select>
						
						<p class="h6">ふりがな</p>
						<!-- <input id="inputruby" class="mb-2" type="text" value=""> -->
						<select name="" id="inputruby">
							<option value="やまだたろう">やまだたろう</option>
							<option value="さとうはなこ">さとうはなこ</option>
							<option value="たなかじょにー">たなかじょにー</option>
						</select>
						
						<p class="h6">郵便番号</p>
						<!-- <input id="inputpost" class="mb-2" type="text" value=""> -->
						<select name="" id="inputpost">
							<option value="1234567">1234567</option>
							<option value="5910000">5910000</option>
							<option value="1902345">1902345</option>
						</select>
						
						<p class="h6">都道府県</p>
						<!-- <input id="inputpref" class="mb-2" type="text" value=""> -->
						<select name="" id="inputpref">
							<option value="1">愛知県</option>
							<option value="9">大阪府</option>
							<option value="26">東京都</option>
						</select>
						
						<p class="h6">住所</p>
						<!-- <input id="inputadd" class="col-8 mb-2" type="text" value=""> -->
						<select name="" id="inputadd">
							<option value="みなかみ町1-2-3">みなかみ町1-2-3</option>
							<option value="白老郡2-3-4">白老郡2-3-4</option>
							<option value="久保田3-4-5">久保田3-4-5</option>
						</select>


						<p class="h6">電話番号</p>
						<!-- <input id="inputtel" class="mb-3" type="text" value="">			 -->
						<select name="" id="inputtel">
							<option value="09012345678">09012345678</option>
							<option value="07098765432">07098765432</option>
							<option value="08019283746">08019283746</option>
						</select>
					</div>

      		<br/>
					<div class="d-md-flex col-12 justify-content-evenly">
						<p class="col-sm-12 col-md-2"><input id="regideli" type="radio" name="changedeli" value="" checked>登録されているお届け先</p>
						<p class="col-sm-12 col-md-2"><input id="changedeli" type="radio" name="changedeli" value="">違うお届け先に変更する</p>
					</div>
		<form action="payment_comp.php"  name="purchase" method="POST">
      		<p class="h5">お支払い方法</p>
					<input type="hidden" name="user_id" value='<?= $purch[Bb_User_Id]; ?>'>
      		<input type="radio" name="pay_id" value="1">クレジットカード
					<input type="radio" name="pay_id" value="2" checked>振り込み
      		<br/>
      	</div>
      </div>
      
      <div class="d-grid gap-2 col-5 mx-auto mt-5">
				<input type="hidden" name="user_id" value='<?= $purch[Bb_User_Id]; ?>'>
				<input type="hidden" id="deli_name" name="deli_name" value='<?= $purch[Bb_User_Name]; ?>'>
				<input type="hidden" id="deli_ruby" name="deli_ruby" value='<?= $purch[Bb_User_Ruby]; ?>'>
				<input type="hidden" id="deli_pref_id" name="deli_pref_id" value='<?= $purch[Bb_Pref_Id]; ?>'>
				<input type="hidden" id="deli_add" name="deli_add" value='<?= $purch[Bb_User_Add]; ?>'>
				<input type="hidden" id="deli_post" name="deli_post" value='<?= $purch[Bb_User_Post]; ?>'>
				<input type="hidden" id="deli_tel" name="deli_tel" value='<?= $purch[Bb_User_Tel]; ?>'>


     	 	<input type="hidden" name="order_name" value='<?= $purch[Bb_User_Name]; ?>'>
				<input type="hidden" name="order_ruby" value='<?= $purch[Bb_User_Ruby]; ?>'>
				<input type="hidden" name="order_pref_id" value='<?= $purch[Bb_Pref_Id]; ?>'>
				<input type="hidden" name="order_add" value='<?= $purch[Bb_User_Add]; ?>'>
				<input type="hidden" name="order_post" value='<?= $purch[Bb_User_Post]; ?>'>
				<input type="hidden" name="order_tel" value='<?= $purch[Bb_User_Post]; ?>'>
				<input type="hidden" name="order_money" value='<?= $total; ?>'>
      			
				支払金額
				<input type="text" id="totalmoney" name="pay_money" value='<?= $total - $use_point; ?>' readonly>
				使用可能ポイント
				<input type="text" id="havepoint" name="available" value="<?= $available_point; ?>" readonly>
				使用ポイントを入力してください
				<input type="number" id="usepoint" name="use_point" value="<?= $use_point; ?>">
				<div id = "alert" class="text-danger"></div>
				<div id = "money" class="text-danger"></div>
				<input type="button" id = "pointbtn" value = "支払金額に使用ポイントを反映する">
				
				<div class="d-grid gap-2 col-10 mx-auto m-2">
				<!-- 上の「支払金額に使用ポイントの変更を反映する」ボタンを押さないと、購入ボタンを押して、購入手続きを完了させることはできません。 -->
					<button class="btn btn-primary" type="submit" id = "payment" disabled>使用ポイントを設定して反映ボタンを押してください</button>
				</div>
			</form>
			<?php 
			$name = "";
			$ruby = "";
			$post = "";
			$pref = "";
			$add = "";
			$tel = "";
			
			if(isset($_POST["change_name"]))
			{
				$name = $_POST["change_name"];
			}
			elseif (isset($purch[Bb_User_Name]))
			{
				$name = $purch[Bb_User_Name];
			}
			if(isset($_POST["change_ruby"]))
			{
				$ruby = $_POST["change_ruby"];
			}
			elseif (isset($purch[Bb_User_Ruby]))
			{
				$ruby = $purch[Bb_User_Ruby];
			}
			if(isset($_POST["change_post"]))
			{
				$post = $_POST["change_post"];
			}
			elseif (isset($purch[Bb_User_Post]))
			{
				$post = $purch[Bb_User_Post];
			}
			if(isset($_POST["change_pref"]))
			{
				$pref = $_POST["change_pref"];
			}
			elseif (isset($purch[Bb_Pref_Id]))
			{
				$pref = $purch[Bb_Pref_Id];
			}
			if(isset($_POST["change_add"]))
			{
				$add = $_POST["change_add"];
			}
			elseif (isset($purch[Bb_User_Add]))
			{
				$add = $purch[Bb_User_Add];
			}
			if(isset($_POST["change_tel"]))
			{
				$tel = $_POST["change_tel"];
			}
			elseif (isset($purch[Bb_User_Tel]))
			{
				$tel = $purch[Bb_User_Tel];
			}
			
			
			?>
			<div class="d-grid gap-2 col-10 mx-auto m-2">
  			<a class="btn btn-primary" type="button" href="login_cart.php">カートに戻る</a>
			</div>
  	</div>
    <br/>
    <script>
			$("#pointbtn").click(function(){
			 let usepoint = parseInt($("#usepoint").val());				//使用ポイント
			 let havepoint = parseInt($("#havepoint").val());			//所持ポイント
			 let totalmoney = parseInt($("#totalmoney").val());		//合計金額
			 let alert = "";
				console.log(usepoint);
				console.log(havepoint);
				console.log(totalmoney);

				// 使用ポイントが空や数字意外なら使用ポイントを０にする
				if(isNaN(usepoint))
				{
					alert = "使用ポイントを０に設定しました";
					$("#alert").text(alert);
					$("#usepoint").val("0");
					$("#money").text("お支払い金額は" + totalmoney + "円です");
				}

				// 使用ポイントが０未満だったら使用ポイントを０にする
				if(usepoint <= 0)
				{
					alert = "使用ポイントを０に設定しました";
					$("#alert").text(alert);
					$("#usepoint").val("0");
					$("#money").text("お支払い金額は" + totalmoney + "円です");
					$("#payment").text("購入")
				}

				//使用ポイントが所持ポイントを上回ったら全額使用に設定
				if(usepoint > havepoint)
				{
					$("#usepoint").val(havepoint);
					alert = "使用ポイントを全額に設定しました。";
					$("#alert").text(alert);
					$("#money").text("お支払い金額は" + (totalmoney - havepoint) + "円です");
					$("#payment").text("購入")
				}

				// 使用ポイントが正常に入力されたら使用ポイントを設定
				if(usepoint <= havepoint && usepoint >= 0)
				{		
					$("#alert").text("");
					$("#money").text("お支払い金額は" + (totalmoney - usepoint) + "円です");
					$("#payment").text("購入")
				}
				$("#payment").prop("disabled", false);
			})

			$("#usepoint").click(function()
			{
				$("#payment").prop("disabled", true);
				$("#payment").text("使用ポイントを設定して反映ボタンを押してください")
				$("#money").text("");
			})

			$("#regideli").click(function()
			{
				$("#regidelidata").removeClass("d-none")
				$("#changedelidata").addClass("d-none")
			})

			$("#changedeli").click(function()
			{
				$("#regidelidata").addClass("d-none")
				$("#changedelidata").removeClass("d-none")
			})

			$("#payment").click(function()
			{
				if($("#regideli").prop("checked"))
				{
					let deliname = $("#displayname").text();
					let deliruby = $("#displayruby").text();
					let deliprefid =  $("#displaypref").text();
					let deliadd =  $("#displayadd").text();
					let delipost = parseInt($("#displaypost").text());
					let delitel =  parseInt($("#displaytel").text());
					$("#deli_name").val(deliname);
					$("#deli_ruby").val(deliruby);
					$("#deli_pref_id").val(deliprefid);
					$("#deli_add").val(deliadd);
					$("#deli_post").val(delipost);
					$("#deli_tel").val(delitel);


				}

				if($("#changedeli").prop("checked"))
				{
					let deliname = $("#inputname").val();
					let deliruby = $("#inputruby").val();
					let deliprefid =  $("#inputpref").val();
					let deliadd =  $("#inputadd").val();
					let delipost = parseInt($("#inputpost").val());
					let delitel =  parseInt($("#inputtel").val());			
					$("#deli_name").val(deliname);
					$("#deli_ruby").val(deliruby);
					$("#deli_pref_id").val(deliprefid);
					$("#deli_add").val(deliadd);
					$("#deli_post").val(delipost);
					$("#deli_tel").val(delitel);

				}
				// return false;
			})
			
			
    </script>
  </main>
</body>

<?php require_once "./footer.php" ?>

</html>