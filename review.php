<?php 
  require_once "./head.php";                //head読み込み
  $cart = "";                               //カート情報取得変数
  $err = "";                                //エラー表示変数
  $check = "";
  $item_total = "";                         //商品毎の合計金額変数
  $total = 0;                               //全商品の合計金額変数
  $result = "";
  $i = 0;//カートクラス呼び出し
?>
</head>
<?php 
  require_once "./module/header_set.php";   //ヘッダー切り替えモジュール読み込み
  require_once "./newmodule/get_review.php";
  $result = new REVIEW();
  $rev = $result->GetReview($_GET["id"]);
?>

<?php
  $result = new CART();
  if($_SERVER["REQUEST_METHOD"] === "POST")
  {
    $result->CartCountChange($_SESSION[User][User_Id],$_POST["item_id"],$_POST["count"]);
  }
?>

<body>

  <!-- 全体 -->

  <div class="container">
    <div class="row justify-content-around">
      <!-- タイトル -->
      <div class="mx-auto mb-5 ">
        <p class="text-center mt-4 h2">レビュー</p>
      </div>
      <!-- /タイトル -->
      <?php foreach($rev as $val) {?>
        <!-- レビュー -->
        <div class="d-flex row border p-4 mb-4 position-relative col-12">
          <div class="row justify-content-center">
            <!-- 投稿者名 -->
            <div class="row col-md-12 d-flex justify-content-between">
                <div class="col-sm-5">
                    <p class="text-center h3">投稿者名: <?= $val["Rev_Name"]?></p>
                    <p class="text-center h5"> <?= $val["Sex_Name"]?></p>
                </div>
                <p class="text-center col-sm-5 text-black-50">投稿日: <?= $val["Rev_Date"]?></p>
            </div>
            <!-- レビュー内容 -->
            <div class="card-body text-center row">
              <!-- 星・数 -->
              <div class="my-3 mx-auto ">
                <div class="d-flex justify-content-center col-12">
                  <p id="rev<?= $i++; ?>" class="mt-2"></p>
                  <p class="h3 m-2"><?= $val["Rev_Status"] ?></p>
                </div>
                <!-- コメント -->
                <p class="col-12 text-break mt-4 h5"><?= $val["Rev_Comment"]?></p>
              </div>
              <!-- /レビュー内容 -->
            </div>
          </div>
        </div> 
        <!-- /レビュー  -->
      <?php } ?>

     <form action="./item_detail.php" method="GET">
     <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
      <div class="d-grid gap-2 col-3 m-3 mx-auto">
        <button class="btn btn-primary" type="submit">商品ページに戻る</button>
      </div>
    </form>
    </div>
  </div>
  
  <script src="./js/jquery.raty.js"></script>
	
  <script>
    var count = <?= json_encode($i); ?>;
    var rev = <?= json_encode($rev); ?>;
    console.log(rev[0]["Rev_Status"]);
    $(function(){
        for(var i = 0; i < count; i++){
        $("#rev" + i).raty({
            score: rev[i]["Rev_Status"]
        });
        }
    });
  </script>
</body>

<!-- フッター -->
<?php require_once "./footer.php" ?>
</html>