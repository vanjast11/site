<?php require_once "./head.php"; ?>

<?php require_once "./module/header_set.php";?>
<?php 
if(!isset($_SESSION[User]))
{
	header("Location: guest_cart.php"); // ユーザー情報がない場合（つまり非会員の場合）はゲスト用カートページへリダイレクト
}
?>
<?php 
$name = "";
$status = "";
$comment = "";
if(isset($_SESSION["Review"]["Rev_Name"]))
{
	$name = $_SESSION["Review"]["Rev_Name"];
}
if(isset($_SESSION["Review"]["Rev_Name"]))
{
	$status = $_SESSION["Review"]["Rev_Status"];
}
if(isset($_SESSION["Review"]["Rev_Name"]))
{
	$comment = $_SESSION["Review"]["Rev_Comment"];
}
if(isset($_POST["top"]))
{
	unset($_SESSION["Review"]);
	unset($_SESSION["Item_Id"]);
	if($_POST["top"] == "top")
	{
		header("Location:index.php");
		exit;
	}
}
$result = new ITEM();
$review = $result->GetDetailItem($_SESSION["Item_Id"]["item_id"]);
?>
<!-- レビュー入力完了 review_comp.php -->

<body>

  <!-- 全体 -->

  <div class="container">
    <div class="justify-content-center">

      <!-- 商品情報セクション -->
      <div class="d-flex row border p-5 my-5">
        <div class="row justify-content-center">

          <!-- 商品写真 -->
          <div class="row card col-md-2" style="width: 14rem; height: 14em">
            <a href="">
              <img class="card-img-top" src="<?= Img_path . $review[Item_Image_1];?>" alt="Card image cap">
            </a>
          </div>
          <!-- /商品写真 -->

          <!-- 商品情報 -->

          <div class="card-body text-center col-md-2 ">

            <!-- 商品タイトル -->
            <div class="my-3 mx-auto">
              <h3 class="card-title h3"><?= $review[Item_Name];?></h3>
            </div>
            <!-- 商品タイトル -->

            <!-- 商品金額 -->
            <div class="mx-auto">
              <h3 class="card-title text-danger h3"><?= $review[Item_Price];?>円</h3>
            </div>
            <!-- /商品金額 -->

          </div>
          <!-- /商品情報 -->

        </div>
      </div>
      <!-- /商品情報セクション -->


      <form action="" method = "post">

        <!-- お問い合わせ入力セクション -->
        <section>

          <!-- ユーザーお問合わせ内容 -->
          <div class="mx-auto mt-5 p-5 border">

            <!-- テキストエリア -->
            <div class="form-group mb-3 text-center">
              
              <h1 class="mt-5">こちらの内容で投稿したしました。<br>
                ありがとうございます。</h1>
            </div>
            <!-- /テキストエリア -->
			ニックネーム
                <input class="form-control form-group col-3" id="inputdefault" type="text" name = "name" value="<?php echo $name?>" readonly>
                評価
                <input class="form-control form-group col-3" id="inputdefault" type="text" name = "status" value="<?php echo $status?>" readonly>
                レビュー内容
                <input class="form-control form-group col-3" id="inputdefault" type="text" name = "comment" value="<?php echo $comment?>" readonly>
          </div>
          <!-- ユーザーお問合わせ内容 -->

        </section>
        <!-- /お問い合わせ入力セクション -->

        <!-- ボタンセクション -->
        <section class="mx-auto text-center">
          <button type="submit" class="btn btn-primary btn-lg m-5" name = "top" value = "top">トップ画面へ戻る</button>

        </section>
        <!-- /ボタンセクション -->

      </form>

    </div>
  </div>
  <!-- /全体 -->
</body>
<!-- ---------------------------------------------- -->
<?php require_once "./footer.php" ?>

</html>