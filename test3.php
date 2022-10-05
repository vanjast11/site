<?php require_once "./head.php"; ?>
<script src="./js/chart.min.js"></script>
<link rel="stylesheet" href="./css/adm.css">
<style>
.contuct-main{
  display:none;
}
  </style>
<?php 
  $ok = "";
  $result = NEW CONTUCT();
  if($_SERVER["REQUEST_METHOD"] === "POST")
  {
    $contuct = $result->SetReply($_POST["contuct_id"], $_POST["reply"]);
    $ok = "お問い合わせに返信しました";
  }
  $contuct = $result->GetContuct();
?>

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

<main class="">

  <div class="b-example-divider d-none d-lg-flex"></div>

    <!-- ライトモードのサイドバー -->
    <?php require_once "./adm_sidebar.php" ?>
    <!-- /ライトモードのサイドバー -->

  <div class="b-example-divider d-none d-lg-flex row"></div>

  <!-- リストグループのサイドバー -->
    <div class="row col-md-9 ms-0">

      <div class="row col-12 ms-0">
        
        <!-- お問い合わせ -->
        <div class="col-sm-12 col-md-12 mb-4" style="height:1000px;">
          <div class="card border-left-primary shadow py-2 col-sx-9 col-12 ">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    お問い合わせ
                  </div>
                  <p class="h5 col-12 text-center"><?= $ok; ?></p>
                  <?php 
                  	foreach($contuct as $val){ 
                  		if ($_SESSION["admin_id"] == "minamiosakagisenkou") {
                    		require './guest_adm/test3_tml.php';
                  		} else {
                  			require './adm/test3_adm_tml.php';
                  		}
                  	}
                   ?>
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
    $(e.currentTarget).parent().next(".contuct-main").toggle("200sec");
  });

  $('.mtestbutton').click(function(e) {
    $(e.currentTarget).next().next(".contuct-main").toggle("200sec");
  });
  </script>
  <script src="./sidebar.js"></script>

</body>

</html>