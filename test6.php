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
$msg = "";
$result = new ADMIN();
// 在庫更新
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$msg = $result->SetStock($_POST["id"],
                           $_POST["stock_count"],
                           $_POST["stock_max"],
                           $_POST["stock_low"]);
}
$item = $result->GetItemStock();
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
          <div class="card border-left-primary shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    在庫編集
                  </div>
                  <p><?= $msg ?></p>
                      <nav class="inline_box col-12">
                        <table class="col-12 text-center table table-striped">
                          <tr>
                            <th class="col-1">商品ID</th>
                            <th class="col-2">商品名</th>
                            <th class="col-2">在庫数</th>
                            <th class="col-2">最小在庫数</th>
                            <th class="col-2">最大在庫数</th>
                            <th class="col-1">変更</th>
                          </tr>
                          <?php for($i = 0; $i < count($item); $i++){ ?>
                          <tr>
                          <form action="" method="POST">
                            <td><?= $item[$i]["id"]; ?></td>
                            <td><?= $item[$i]["name"]; ?></td>
                            <td><input type="text" name="stock_count" class="col-sm-12" value="<?= $item[$i]["stock_count"]; ?>"></td>
                            <td><input type="text" name="stock_max" class="col-sm-12" value="<?= $item[$i]["stock_max"]; ?>"></td>
                            <td><input type="text" name="stock_low" class="col-sm-12" value="<?= $item[$i]["stock_low"]; ?>"></td>
                            <td><input type="submit"  class="col-sm-3 col-md-12 align-items-end" value="変更"></td>
                            <input type="hidden" name="id" value="<?= $item[$i]["id"]; ?>">
                          </form>
                          </tr>
                          <?php } ?>
                        </table>
                      </nav>
                      <!-- /売り上げグラフ -->
                </div>
              </div>
            </div>
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

</body>

</html>