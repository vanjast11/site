<?php 
  require_once "./head.php";                    //head読み込み

  $result = "";                                 //商品クラス呼び出し
  $item = "";                                   //商品情報取得変数


?>
<link rel="stylesheet" href="./css/hamburgermenu.css">
<link rel="stylesheet" href="./css/page_top.css">
<script src="./js/script.js"></script>
<script src="./js/page_top.js"></script>
</head> 
<?php 
  require_once "./module/header_set.php";       //ヘッダー切り替えモジュール読み込み
?>

<?php 
  $result = new ITEM();
  if($_SERVER["REQUEST_METHOD"] === "POST")
  {
    $item = $result->GetSearchItem($_POST);
  }
  else
  {
    $item = $result->GetAllItem();
  }
?>
<form action="item_list.php" name="cat1" method="POST">
  <a href="javascript: cat1.submit()"></a>
</form>
<body>
<div class="d-flex">
   <!-- PCの場合　表示 -->
 <div class="pc">
   <div class="d-flex d-none d-md-block style='width: 200px;">
    <aside class="">
      <div class="card" style="width: 13rem; height: 130em">
        <form action="./item_list.php" class="ms-3 mt-3" method="POST">
          <p>カテゴリー</p>
          <div class="ms-3">
            <input type="checkbox" name="cat[]" value="<?= Wallet ?>">財布<br>
            <input type="checkbox" name="cat[]" value="<?= Belt ?>">ベルト<br>
            <input type="checkbox" name="cat[]" value="<?= Accessory ?>">小物<br>
          </div>
          <p class="mt-3">価格</p>
          <div class="ms-2">
            <input type="text" name="min" style="width: 4rem;">
            〜
            <input type="text" name="max" style="width: 4rem;"><br>
          </div>
            <input type="submit" value="検索" class="mt-3 mx-auto" style="width: 10.5rem;">
        </form>
      </div>
    </aside>
   </div>
  </div>
  <!-- スマフォの場合　表示 -->
  <div class="sp">
  <div class="header-logo-menu">
    <div id="nav-drawer">
      <input id="nav-input" type="checkbox" class="nav-unshown">
      <label id="nav-open" for="nav-input">
        <span></span>
        <span></span>  
      </label>
      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
      <div id="nav-content">
      <!-- ここに中身を入れる -->
      <!-- <div class="d-flex d-none d-md-block style='width: 200px;"> -->
      <aside class="">
        <!-- <div class="card" style="width: 13rem; height: 130em"> -->
          <form action="./item_list.php" class="ms-3 mt-3" method="POST">
            <p>カテゴリー</p>
            <div class="ms-3">
              <input type="checkbox" name="cat[]" value="<?= Wallet ?>">財布<br>
              <input type="checkbox" name="cat[]" value="<?= Belt ?>">ベルト<br>
              <input type="checkbox" name="cat[]" value="<?= Accessory ?>">小物<br>
            </div>
            <p class="mt-3">価格</p>
            <div class="ms-2">
              <input type="text" name="min" style="width: 4rem;">
              〜
              <input type="text" name="max" style="width: 4rem;"><br>
            </div>
              <input type="submit" value="検索" class="mt-3 mx-auto" style="width: 10.5rem;">
          </form>
      </aside>
    </div>
    </div>
    </div>
  </div>
  <div class="p-2 flex-grow-1">
    <div class="row justify-container-center">
      <p class="text-center mt-4 h2">商品一覧</p>
      <?php if(isset($item)){?>
      <?php foreach($item as $key => $val){ ?>
      <div class="mx-auto col-6 col-md-2 m2" style=" margin-top:4rem;">
        <a href="./item_detail.php?id=<?= $val[Item_Id]; ?>">  
        <img class="card-img-top" src="<?= Img_path . $val[Item_Thum_Image]; ?>" alt="Card image cap">
        </a>
        <p class="card-title"><?= $val[Item_Name]; ?></p>
        <h5 class="card-title text-danger"><?= $val[Item_Price]; ?>円</h5>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div> 
</div>

<!-- ページトップボタン -->
<div id="page_top">
  <a href="#"></a>
</div>
</body>
<?php
 require_once "./footer.php";                       //フッター読み込み
?>
</html>
