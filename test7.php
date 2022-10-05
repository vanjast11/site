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

<!-- ユーザー情報変更 -->
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $result = new ADMIN();
    $a = $result->AdmSetUserData($_POST["user_id"],
                             $_POST["user_name"],
                             $_POST["user_ruby"],
                             $_POST["sex_id"],
                             $_POST["user_birth"],
                             $_POST["user_post"],
                             $_POST["pref_id"],
                             $_POST["user_add"],
                             $_POST["user_tel"],
                             $_POST["user_status"]);
  }
?>


<!-- ユーザー情報取得 -->
<?php
  $result = new ADMIN();
  $user_data = $result->AdmGetUserData();
  $result = new USER();
  $pref = $result->GetPref();
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
                ユーザーID検索 : <input id="search" type="text" name="search" value="">
                <!-- <input class="ms-3" type="submit" value="🔍"> -->
                <a href="" id="searchbutton" class="h3 ms-3">▼</a>
              </div>
            </form>
            <!-- /検索フォーム -->

            <?php
            foreach ($user_data as $key => $val)
            {
            	if ($_SESSION["admin_id"] == "minamiosakagisenkou") {
            		require './guest_adm/test7_tml.php';
            	} else {
            		require './adm/test7_adm_tml.php';
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