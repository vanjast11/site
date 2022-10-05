<?php require_once "./head.php"; ?>

<?php require_once "./module/header_set.php";?>
<?php 
if(!isset($_SESSION[User]))
{
	header("Location: guest_cart.php"); // ユーザー情報がない場合（つまり非会員の場合）はゲスト用カートページへリダイレクト
}
?>
<?php 
$name = ""; // フォーム（readonly）の中に入れる変数
$status = ""; // フォーム（readonly）の中に入れる変数
$comment = ""; // フォーム（readonly）の中に入れる変数

require_once './module/review_module.php';

if(isset($_SESSION["Review"]["Rev_Name"]))
{
	$name = $_SESSION["Review"]["Rev_Name"]; // フォーム（readonly）の中に入れる変数
}
if(isset($_SESSION["Review"]["Rev_Name"]))
{
	$status = $_SESSION["Review"]["Rev_Status"]; // フォーム（readonly）の中に入れる変数
}
if(isset($_SESSION["Review"]["Rev_Name"]))
{
	$comment = $_SESSION["Review"]["Rev_Comment"]; // フォーム（readonly）の中に入れる変数
}
if(isset($_POST["post"]) || isset($_POST["correct"]))
{
	if($_POST["post"] == "post")
	{
		
		$result = new REVIEW();
		$review = $result->SetReview($_SESSION[User][User_Id], $_POST["name"], $_SESSION["Item_Id"]["item_id"], $_POST["status"], $_POST["comment"]);
		header("Location:review_comp.php");
		exit;
	}
	else if($_POST["correct"] == "correct")
	{
		header("Location:review_input.php");
		exit;
	}
}
$result = new ITEM();
$review = $result->GetDetailItem($_SESSION["Item_Id"]["item_id"]);
?>

<!-- レビュー入力確認 review_conf.php -->

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
              
        <!-- お問い合わせ入力セクション -->
        <section>

          <!-- ユーザーお問合わせ内容 -->
          <div class="mx-auto mt-5 p-5 border">

            <!-- タイトル -->
            <div class="row form-group text-center mb-5 d-flex">

              <div class="d-flex row border p-4 mb-5">
                <div class="row justify-content-center">
                  <!-- お問い合わせタイトル -->
                  <!-- テキストエリア -->
            	ニックネーム
                <input class="form-control form-group col-3" id="inputdefault" type="text" name = "name" value="<?php echo $name?>" readonly>
                評価
                <input class="form-control form-group col-3" id="inputdefault" type="text" name = "status" value="<?php echo $status?>" readonly>
                レビュー内容
                <input class="form-control form-group col-3" id="inputdefault" type="text" name = "comment" value="<?php echo $comment?>" readonly>
                
                </div>
               </div>
              </div>
             </div>
            </section>
              <h1 class="mt-5">こちらの内容で投稿してよろしいですか？</h1>
            </div>
            <!-- /テキストエリア -->

          </div>
          <!-- ユーザーお問合わせ内容 -->

        </section>
        <!-- /お問い合わせ入力セクション -->

        <!-- ボタンセクション -->
        <section class="mx-auto text-center">
          <button type="submit" class="btn btn-primary btn-lg m-5" name = "post" value = "post">上記の内容でレビューを投稿する</button>
          <button type="submit" class="btn btn-primary btn-lg m-5" name = "correct" value = "correct">編集画面に戻って修正する</button>
        </section>
        <!-- /ボタンセクション -->

      </form>


    </div>
    <!-- /全体 -->
  </div>
</body>
<!-- ---------------------------------------------- -->
<?php require_once "./footer.php" ?>

</html>