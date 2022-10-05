<?php require_once "./head.php"; ?>
<script src="./js/chart.min.js"></script>
<link rel="stylesheet" href="./css/adm_chart.css">
</head>

<?php 
if(!isset($_SESSION["admin_id"])) //正しくログインできたかのチェック
{
	header('Location: ./adm_login.php'); //トップにリダイレクト
}
?>
<body>
<!-- アイコンの設定 -->
<?php require_once "./adm_svg.php"; ?>
<!-- /アイコンの設定 -->

<main>

  <div class="b-example-divider d-none d-lg-flex"></div>

    <!-- ライトモードのサイドバー -->
    <?php require_once "./adm_sidebar.php" ?>
    <!-- /ライトモードのサイドバー -->

  <div class="b-example-divider d-none d-lg-flex row"></div>
  <?php
  
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // 現在の年月日を取得
        $date = date("Y-m-d");
    } else {
        // 検索された年月日を取得
        $date = $_POST["date"];
    }
    
    // 年・月・日をそれぞれ取得
    list($yy, $mm, $dd) = explode('-', $date);
    // 曜日の数値を取得
    $wcount = date('N', strtotime($date)) -1;
    // 年・月を代入
    $ym = $yy . "_". $mm;
    // 日付の数値を取得
    $dcount = date('t', strtotime($date));
    $result = new ADMIN();
  ?>
  
  <!-- リストグループのサイドバー -->
    <div class="row w-100 m-1">
      <div class="row w-100 m-1" style="height:100px;">
        <!-- 今年の売り上げ -->
        <div class="col-6 col-sm-6 col-md-3  mb-4">
          <div class="card border-left-primary shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      1年間の売り上げ</div>
                      <?php 
                          // 年のみ代入
                          $ymd = $yy;
                          $money = $result->MoneyTotal($ymd);
                      ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $money; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /今年の売り上げ -->   
        <!-- 今月の売り上げ -->
        <div class="col-6 col-sm-6 col-md-3 mb-4">
          <div class="card border-left-primary shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      月の売り上げ</div>
                      <?php 
                          // 年・月を代入
                          $ymd = $yy . "_" . $mm;
                          $money = $result->MoneyTotal($ymd);
                      ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $money ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /今月の売り上げ -->
        <!-- 本日の注文数 -->
        <div class="col-6 col-sm-6 col-md-3 mb-4">
          <div class="card border-left-primary shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      1日の注文数</div>
                      <?php 
                          // 年・月・日を代入
                          $ymd = $yy . "_" . $mm . "_" .$dd;
                          $count = $result->CountTotal($ymd);
                      ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /本日の注文数 -->
        <!-- 本日の売り上げ -->
        <div class="col-6 col-sm-6 col-md-3 mb-4">
          <div class="card border-left-primary shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      1日の売り上げ</div>
                      <?php 
                          $money = $result->MoneyTotal($ymd);
                      ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $money ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /本日の売り上げ -->
        <!-- 売り上げ検索ボタン -->
        <div class="d-flex col-12">
          <div class="row col-6 d-flex">
            <form action="" method="post">
            <input type="date" class="col-6 col-lg-3" name="date"></input>
            <button type="submit" class="btn btn-info col-6 col-lg-3">検索</button>
            <?= $date ?>
            </form>
          </div>
          <div class="row col-6 flex-row-reverse ms-4">
            <button type="button" id="week" class="btn btn-secondary col-4 col-lg-3">週間</button>
            <button type="button" id="mon" class="btn btn-secondary col-4 col-lg-3">月間</button>
            <button type="button" id="year" class="btn btn-secondary col-4 col-lg-3">年間</button>
          </div>
        </div>
        <!-- /売り上げ検索ボタン -->
        <!-- 売り上げグラフ -->
        <div class="col-sm-12 col-md-12 mb-4">
          <div class="card border-left-primary shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div>
                    <canvas id="mychart"></canvas>
                  </div>
                </div>
                <div style="width:1px;">
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
var yy = <?= json_encode($yy); ?>;
var mm = <?= json_encode($mm); ?>;
var dd = <?= json_encode($dd); ?>;
var ym = <?= json_encode($ym); ?>;
var dcount = <?= json_encode($dcount); ?>;
var wcount = <?= json_encode($wcount); ?>;
var myChart = "";
var ctx = document.getElementById('mychart');
</script>

<script src="./test1.js"></script>

</body>

</html>