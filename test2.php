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

  <!-- リストグループのサイドバー -->
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // 現在の年・月・日を取得
        $date = date("Y-m-d");
    } else {
        // 検索された年・月・日を取得
        $date = $_POST["date"];
        $date = date('Y-m-d', strtotime($date));
    }
    
    // 年・月・日をそれぞれ取得
    list($yy, $mm, $dd) = explode('-', $date);
    
    $result = new ADMIN();
  ?>
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
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $money ?></div>
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
            <button type="button" id="week" class="btn btn-secondary col-4 col-lg-3 tab">週間</button>
            <button type="button" id="mon" class="btn btn-secondary col-4 col-lg-3 tab">月間</button>
            <button type="button" id="year" class="btn btn-secondary col-4 col-lg-3 tab">年間</button>
          </div>
        </div>
        <!-- /売り上げ検索ボタン -->
        <!-- 売り上げテーブル -->
        <div class="col-sm-12 col-md-12 mb-4" style="height:1000px;">
          <div class="card border-left-primary shadow py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  
                  <!-- 年間 -->
                  <nav class="inline_box col-12 year content">
                  <?php 
                    $ymd = $yy;
                    $item = $result->YearMonthItem($ymd);
                  ?>
                    <table class="col-12 text-center table table-striped">
                      <tr>
                        <th class="col-1">商品ID</th>
                        <th class="col-3">商品名</th>
                        <th class="col-2">価格</th>
                        <th class="col-1">販売数</th>
                        <th class="col-2">販売金額</th>
                        <th class="col-1">女性</th>
                        <th class="col-1">男性</th>
                        <th class="col-1">その他</th>
                      </tr>
                      <?php 
                        if (!empty($item)) {
                        	for($i = 0; $i < count($item); $i++){ ?>
                        		<tr>
                        			<td><?= $item[$i]["item_id"] ?></td>
                        			<td><?= $item[$i]["item_name"] ?></td>
                        			<td><?= $item[$i]["item_price"] ?>円</td>
                        			<td><?= $item[$i]["SumOrderCount"] ?>個</td>
                        			<td><?= $item[$i]["total"] ?>円</td>
                        			<td><?= $item[$i]["ms"] ?>%</td>
                        			<td><?= $item[$i]["mr"] ?>%</td>
                        			<td><?= $item[$i]["mx"] ?>%</td>
                        		</tr>
                      <?php 
                        	}
                        }
                      ?>
                    </table>
                  </nav>
                  <!-- /年間 -->
                  
                  <!-- 月間 -->
                  <nav class="inline_box col-12 mon content start">
                  <?php 
                    $ymd = $yy . "_" . $mm;
                    $item = $result->YearMonthItem($ymd);
                  ?>
                    <table class="col-12 text-center table table-striped">
                      <tr>
                        <th class="col-1">商品ID</th>
                        <th class="col-3">商品名</th>
                        <th class="col-2">価格</th>
                        <th class="col-1">販売数</th>
                        <th class="col-2">販売金額</th>
                        <th class="col-1">女性</th>
                        <th class="col-1">男性</th>
                        <th class="col-1">その他</th>
                      </tr>
                      <?php 
                        if (!empty($item)) {
                        	for($i = 0; $i < count($item); $i++){ ?>
                        		<tr>
                        			<td><?= $item[$i]["item_id"] ?></td>
                        			<td><?= $item[$i]["item_name"] ?></td>
                        			<td><?= $item[$i]["item_price"] ?>円</td>
                        			<td><?= $item[$i]["SumOrderCount"] ?>個</td>
                        			<td><?= $item[$i]["total"] ?>円</td>
                        			<td><?= $item[$i]["ms"] ?>%</td>
                        			<td><?= $item[$i]["mr"] ?>%</td>
                        			<td><?= $item[$i]["mx"] ?>%</td>
                        		</tr>
                      <?php 
                        	}
                        }
                      ?>
                    </table>
                  </nav>
                  <!-- /月間 -->
                  
                  <!-- 週間 -->
                  <nav class="inline_box col-12 week content">
                  <?php 
                    // 指定日を代入
                    $tm = mktime(0, 0, 0, $mm, $dd +1, $yy);
                    $ymd = date('Y_m_d', $tm);
                    
                    // 指定日の曜日の数値を取得
                    $wcount = date('N', strtotime($date)) -1;
                    
                    // 月曜日の日付を取得
                    $tm = mktime(0, 0, 0, $mm, $dd - $wcount, $yy);
                    $mon = date('Y_m_d', $tm);
                    
                    $item = $result->WeekItem($mon, $ymd);
                  ?>
                    <table class="col-12 text-center table table-striped">
                      <tr>
                        <th class="col-1">商品ID</th>
                        <th class="col-3">商品名</th>
                        <th class="col-2">価格</th>
                        <th class="col-1">販売数</th>
                        <th class="col-2">販売金額</th>
                        <th class="col-1">女性</th>
                        <th class="col-1">男性</th>
                        <th class="col-1">その他</th>
                      </tr>
                      <?php 
                        if (!empty($item)) {
                        	for($i = 0; $i < count($item); $i++){ ?>
                        		<tr>
                        			<td><?= $item[$i]["item_id"] ?></td>
                        			<td><?= $item[$i]["item_name"] ?></td>
                        			<td><?= $item[$i]["item_price"] ?>円</td>
                        			<td><?= $item[$i]["SumOrderCount"] ?>個</td>
                        			<td><?= $item[$i]["total"] ?>円</td>
                        			<td><?= $item[$i]["ms"] ?>%</td>
                        			<td><?= $item[$i]["mr"] ?>%</td>
                        			<td><?= $item[$i]["mx"] ?>%</td>
                        		</tr>
                      <?php 
                        	}
                        }
                      ?>
                    </table>
                  </nav>
                  <!-- /週間 -->
                  
                </div>
              </div>
            </div>
          </div>
        </div> 
        <!-- /売り上げテーブル -->
      </div>

      </div> 
  <!-- /リストグループのサイドバー -->
  <div class="b-example-divider"></div>
</main>

<script>
$(function(){
	$('.content').hide();

	// 最初に月間のみ表示
	$(window).load(function(){
		$('.start').show();
	});
	  $('.tab').on('click',function(){
	    // クリックした要素の ID と違うクラス名のセクションを非表示
	    $('.content').not($('.'+$(this).attr('id'))).hide();
	    // クリックした要素の ID と同じクラスのセクションを表示
	    $('.'+$(this).attr('id')).show();
	  });
	});
</script>
</body>

</html>