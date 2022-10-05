<?php require_once "./head.php"; ?>
  <script src="./js/chart.min.js"></script>
  <link rel="stylesheet" href="./css/adm.css">
  <style>
    .contuct-main {
      display: none;
    }
  </style>

</head>

<?php 
if(!isset($_SESSION["admin_id"])) //正しくログインできたかのチェック
{
	header('Location: ./adm_login.php'); //トップにリダイレクト
}
?>

<!-- ファイルアップロード -->
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
        $filename[$i] = $_POST["db_item_image$i"];
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
// 在庫更新
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $result = new ADMIN();
  $result->AdmItemEdit(
    $_POST["item_id"],
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

//商品データ取得
$result = new ADMIN();
$item =  $result->AdmGetItemData();

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

            <!-- 検索フォーム -->
            <form action="" method="">
              <div class="col-sm-8 m-5 mb-2 h3">
                商品ID検索 : <input id="search" type="text" name="search" value="">
                <!-- <input class="ms-3" type="submit" value="🔍"> -->
                <a href="" id="searchbutton" class="h3 ms-3">▼</a>
              </div>
            </form>
            <!-- /検索フォーム -->

            <?php
            foreach ($item as $key => $val)
            {
            	if ($_SESSION["admin_id"] == "minamiosakagisenkou") {
            		require './guest_adm/test4_tml.php';
            	} else {
            		require './adm/test4_adm_tml.php';
            	}
            } ?>
          </div>
        </div>
        <!-- /売り上げグラフ -->

      </div>
    </div>
    <!-- /リストグループのサイドバー -->
    <div class="b-example-divider"></div>
  </main>

  <script>
    $('.testbutton').click(function(e) {
      $(e.currentTarget).siblings().next(".contuct-main").toggle("200sec");
    });

    $(function() {
      $("#searchbutton").click(function() {
        let search_id = $("#search").val();
        console.log("sec" + search_id);

        $("#searchbutton").attr("href", "#sec" + `${search_id}`);
        let target = $($(this).attr("href")).offset().top;

        //コンテンツへスクロール
        $("html, body").animate({
          scrollTop: target
        }, 500);

        return false;
      });
    });
  </script>

  <script src="./sidebar.js"></script>

</body>

</html>