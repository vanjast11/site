<?php require_once "./head.php"; ?>


  <script src="./js/chart.min.js"></script>
  <link rel="stylesheet" href="./css/adm.css">

</head>

<?php 
if(!isset($_SESSION["admin_id"])) //正しくログインできたかのチェック
{
	header('Location: ./adm_login.php'); //トップにリダイレクト
}
?>


<?php
define("MAX_FILE_SIZE", (1024 * 70));  // ファイル最大サイズ：70KByte
//----- 変数 -----
$pflg      = 0;        // POSTフラグ
$filename    = array();        // ファイル名 
$image_folder  = "img/";    // 保存フォルダ
$errmsg      = array();      // エラーメッセジ配列 


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $pflg = 1;
  for ($i = 1; $i <= 4; $i++)
  {
    while (true)
    {
      if (strlen($_FILES["item_image$i"]["name"]) <= 0)
      {
        $errmsg[] = "ファイルが指定されていません";
        break;
      }
      $filename[$i] = $_FILES["item_image$i"]["name"];  //指定のファイルname
      // アップロードファイル：サイズチェック
      if ($_FILES["item_image$i"]["error"] !== 0)
      {
        if ($_FILES["item_image$i"]["error"] == 2)
        {
          $errmsg[] = "ファイルのサイズオーバーです （MAX：" . MAX_FILE_SIZE / 1024 . " KByte）";
        }
        else
        {
          $errmsg[] = "アップロードエラー発生";
        }
        break;
      }
      if ($_FILES["item_image$i"]["size"] == 0)
      {
        $errmsg[] = "指定されたファイルが存在しないか空です（０）です";
        break;
      }
      $fileinfo = pathinfo($filename[$i]);
      $ext = strtolower($fileinfo["extension"]);
      if ($ext != "gif" && $ext != "jpg" && $ext != "jpeg" && $ext != "bmp" && $ext != "png")
      {
        $errmsg[] = "gif か jpeg か bmp 形式のファイルを指定してください";
      }

      break;
    }
    if (!count($errmsg))
    {
      $movepath = $image_folder . mb_convert_encoding(
        $filename[$i],
        "SJIS",
        "UTF-8"
      );
      $moveok = move_uploaded_file(
        $_FILES["item_image$i"]["tmp_name"],
        $movepath
      );
      if (!$moveok)
      {
        $errmsg[] = "アップロードに失敗しました";
      }
    }
  }
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $result = new ADMIN();
  $result->SetNewItem(
    $_POST["name"],
    $_POST["item_price"],
    $filename[1],
    $filename[2],
    $filename[3],
    $filename[4],
    $_POST["item_explanation"],
    $_POST["cat_id"],
    $_POST["class_id"],
    $_POST["item_cost"],
    $_POST["item_flg"],
    $_POST["recom_flg"],
    $_POST["stock_count"],
    $_POST["stock_max"],
    $_POST["stock_low"]
  );
}
?>


<body>
<!-- アイコンの設定 -->
<?php require_once "./adm_svg.php"; ?>
<!-- /アイコンの設定 -->

  <main class="">

    <div class="b-example-divider d-none d-lg-flex"></div>

    <!-- ライトモードのサイドバー -->
    <?php require_once "./adm_sidebar.php" ?>
    <!-- /ライトモードのサイドバー -->

    <div class="b-example-divider d-none d-lg-flex row"></div>

    <!-- リストグループのサイドバー -->
    <div class="row col-md-9 ms-0">

      <div class="row col-12 ms-0">

        <!-- 売り上げグラフ -->
        <div class="col-sm-12 col-md-12 mb-4" style="height:1000px;">
          <div class="card border-left-primary shadow py-2 col-sx-9 col-12 ">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    商品追加
                  </div>


                  <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000">

                    <!-- コンテンツ -->
                    <nav class="inline_box col-12 mb-1 contuct-menu">
                      <div class="d-md-flex">
                        <p class="col-12 col-md-4 ">商品原価:<input type="text" class="" name="item_cost" value="500">円</p>
                        <p class="col-12 col-md-4">商品名:<input type="text" class="" name="name" value="テスト"></p>
                        <p class="col-12 col-md-4">価格:<input type="text" class="" name="item_price" value="1000">円</p>
                      </div>
                      <div class="d-md-flex">
                        <p class="col-12 col-md-4">在庫数<input type="text" name="stock_count" value="50"></p>
                        <p class="col-12 col-md-4">最大在庫数<input type="text" name="stock_max" value="500"></p>
                        <p class="col-12 col-md-4"> 最小在庫数<input type="text" name="stock_low" value="5"></p>
                      </div>
                </div>
                <div class="col-12 contuct-main">
                  <p class="col-md-3">商品説明:</p>
                  <div class="row p-2 justify-content-end">
                    <textarea name="item_explanation" id="" class="col-12" rows="10">testtest</textarea>
                  </div>
                  <div class="d-flex row">
                    <p class="col-12 col-md-6">サムネイル:<input type="file" class="" name="item_image4" value=""></p>
                    <p class="col-12 col-md-6">画像1:<input type="file" class="" name="item_image1" value="いいベルト"></p>
                    <p class="col-12 col-md-6">画像2:<input type="file" class="" name="item_image2" value="いいベルト"></p>
                    <p class="col-12 col-md-6">画像3:<input type="file" class="" name="item_image3" value="いいベルト"></p>

                    <p class="col-12 col-md-6">カテゴリー:
                      <select name="cat_id" id="pet-select">
                        <option value="">-カテゴリー-</option>
                        <option value="1">財布</option>
                        <option value="2">ベルト</option>
                        <option value="3">小物</option>
                      </select>
                    </p>
                    <p class="col-12 col-md-6">分類:
                      <select name="class_id" id="pet-select">
                        <option value="">-分類-</option>
                        <option value="1">ビジネス</option>
                        <option value="2">男性用</option>
                        <option value="3">女性用</option>
                      </select>
                    </p>
                    <p class="col-12 col-md-6">商品状態:
                      <select name="item_flg" id="pet-select">
                        <option value="">-状態-</option>
                        <option value="0">販売前</option>
                        <option value="1">販売中</option>
                        <option value="9">削除</option>
                      </select>
                    </p>
                    <p class="col-12 col-md-6">おすすめ状態:
                      <select name="recom_flg" id="pet-select">
                        <option value="">-状態-</option>
                        <option value="0">通常</option>
                        <option value="1">おすすめ</option>
                      </select>
                    </p>
                  </div>
                </div>
                </nav>
                <!-- /コンテンツ -->
                <div class="col-12 text-end">
                  <?php if ($_SESSION["admin_id"] == "minamiosakagisenkou") { ?>
                    <input type="submit" class="col-3 col-md-3 justify-content-end" style="height:30px; margin-top:25px;" disabled>
                  <?php } else { ?>
                    <input type="submit" class="col-3 col-md-3 justify-content-end" style="height:30px; margin-top:25px;">
                  <?php  } ?>
                      </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /売り上げグラフ -->

    </div>

    </div>
    </div>
    <!-- /リストグループのサイドバー -->
    <div class="b-example-divider"></div>
  </main>
  <script src="./sidebar.js"></script>

</body>

</html>