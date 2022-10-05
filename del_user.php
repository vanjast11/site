<?php 
  require_once "./head.php";                //head読み込み

  if(!(isset($_SESSION[User])))
  {
    header("Location: index.php" );
  }
?>
</head>

<body>
<?php require_once "./module/header_set.php";?>
  <!-- 全体 -->

  <div class="container">
    <div class="row justify-content-around">
      <!-- タイトル -->
      <div class="mx-auto mb-5 ">
        <p class="text-center mt-4 h2">退会手続き</p>
      </div>
      <!-- /タイトル -->
        <div class="d-flex row border p-4 mb-4 position-relative col-md-6 col-10">
          <div class=" justify-content-center">
            
            <!-- メッセージ -->
            <div class="row col-md-12 d-flex justify-content-center">
                <p class="text-center col-md-12 col-sm-12 h3">本当に退会しますか？</p>
            </div>
          </div>
          <div class="gap-2 row m-3 mx-auto justify-content-evenly">
            <form action="del_user_comp.php" method="POST" class="col-5">
              <button class="btn btn-primary col-sm-12 col-md-12" type="submit">退会する</button>
            </form>
            <div class="col-5">
              <button class="btn btn-primary col-sm-12 col-md-12" onclick="location.href='./index.php'" type="button">戻る</button>
            </div>
          </div>
        </div> 
    </div>
  </div>
</body>

<?php 
  require_once "./footer.php";                  //フッター読み込み
?>

</html>