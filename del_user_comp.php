<?php 
  require_once "./head.php";                //head読み込み
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $result = new USER();
    $result->DelUser($_SESSION[User][User_Id]);
    $_SESSION = array();
  }  
  else
  {
    header("Location: index.php" );
  }
?>
</head>

<body>
<?php 
  require_once "./module/header_set.php";
?>
  <!-- 全体 -->

  <div class="container">
    <div class="row justify-content-around">
      <!-- タイトル -->
      <div class="mx-auto mb-5 ">
      </div>
      <!-- /タイトル -->
        <!-- レビュー -->
        <div class="d-flex row border p-4 mb-4 position-relative col-12">
          <div class="row justify-content-center">
            <!-- 投稿者名 -->
            <div class="row col-md-12 d-flex justify-content-center">
                <p class="text-center col-3 h3">退会が完了しました</p>
            </div>
            <!-- 商品情報 -->
            <div class="card-body text-center row">
              <!-- 商品タイトル -->
              <div class="my-3 mx-auto ">
                <p class="col-12 text-break mt-5"></p>
              </div>
              <!-- /商品タイトル -->
            </div>
          </div>
            <div class="d-flex gap-2 row m-3 mx-auto justify-content-evenly">
              <button class="btn btn-primary col-2" type="button" onclick="location.href='./index.php'">トップ</button>
            </div>
          </form>
        </div> 
        <!-- /レビュー  -->
    </div>
  </div>
</body>

<?php 
  require_once "./footer.php";                  //フッター読み込み
?>

</html>