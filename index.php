<?php 
  require_once "./head.php";                          //head読み込み


  $item        =    "";                               //商品クラス呼び出し変数
  $recom_count =    "";                               //おすすめ商品ループ変数
  $recom_item  =    "";                               //おすすめ商品情報変数(配列で取得)
  $cat_item    =    "";                               //カテゴリー商品情報変数(配列で取得)
  $cat_count   =    "";                               //カテゴリーループ変数

  $item = new ITEM ();                                //商品クラス呼び出し
  $recom_item = $item->GetRecomitem();                //おすすめ商品取得メソッド

  $cat_item = $item->GetCatItem();                    //カテゴリー別商品取得メソッド
  
?>
<link rel="stylesheet" type="text/css" href="css/slick.css"/>
<link rel="stylesheet" href="./css/hamburgermenu.css">
<link rel="stylesheet" href="./css/page_top.css">
<script src="./js/script.js"></script>
<script src="./js/page_top.js"></script>
</head>
<?php 
  require_once "./module/header_set.php";             //ヘッダー切り替えモジュール読み込み
?>       

<body>

<body>
<script type="text/javascript">
(function($) {
    $(function () {
 
        // サイドサブメニューアコーディオン
        $('.sub-menu-head').on('click', function(){
            var $subNav = $(this).next('.sub-menu-nav');
            if ($subNav.is(':visible')) {
                $subNav.velocity('slideUp', {duration: 200});
                $(this).parent('li').removeClass('is-active');
            }
            else {
                $subNav.velocity('slideDown', {duration: 200});
                $(this).parent('li').addClass('is-active');
            }
            return false;
        });
 
        $('#nav-toggle').on('click', function() {
            $('body').toggleClass('close');
        });
 
        $('.scroll').perfectScrollbar();
    });
})(jQuery);
</script>

<div class="d-flex">
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

  <div class="p-2 flex-grow-1">
    <!-- おすすめ商品 -->
    <div class="row justify-container-center">
      <p class="text-center mt-4 h2">おすすめ</p>
      <?php for($recom_count = 0; $recom_count < count($recom_item); $recom_count++){ ?>
        <div class="mx-auto col-6 col-md-2 m2" style="margin-top:4rem;">
          <a href="./item_detail.php?id=<?= $recom_item[Item_Id][$recom_count]; ?>">  
            <img class="card-img-top" src="<?= Img_path . $recom_item[Item_Thum_Image][$recom_count]; ?>" alt="Card image cap">
          </a>
          <p class="card-title"><?= $recom_item[Item_Name][$recom_count]; ?></p>
          <h6 class="card-title text-danger"><?= $recom_item[Item_Price][$recom_count]; ?>円</h6>
        </div>
      <?php }; ?>
    </div>
    <!-- //おすすめ商品 -->

     <!-- カテゴリー 財布 -->
     <div class=""style="margin-top:5rem;">
      <div class="row justify-container-center">
        <p class="text-center mt-4 h2">財布</p>
        <?php for($cat_count = 0; $cat_count < count($cat_item[Wallet][Item_Id]); $cat_count++){ ?>
          <div class="mx-auto col-6 col-md-2 m2" style="margin-top:4rem;">
          <a href="./item_detail.php?id=<?= $cat_item[Wallet][Item_Id][$cat_count]; ?>">
            <img class="card-img-top" src="<?= Img_path . $cat_item[Wallet][Item_Thum_Image][$cat_count]; ?>" alt="Card image cap">
          </a>
          <p class="card-title"><?= $cat_item[Wallet][Item_Name][$cat_count]; ?></p>
          <h6 class="card-title text-danger"><?= $cat_item[Wallet][Item_Price][$cat_count]; ?>円</h6>
        </div>
        <?php }; ?>
      </div>
    </div>
    <!-- /カテゴリー 財布 -->
    <!-- 財布商品一覧へ -->
    
    <form action="./item_list.php" class="" method="POST">
        <input type="hidden" name="cat[]" value="<?= Wallet ?>">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary btn-rounded   "> 財布一覧へ </button>
        </div>
      </form>
      <!-- /財布商品一覧へ -->

    <!-- カテゴリー ベルト -->
    <!-- カテゴリー ベルト -->
    <div class=""style="margin-top:5rem;">
      <div class="row justify-container-center">
      <p class="text-center mt-4 h2">ベルト</p>
        <?php for($cat_count = 0; $cat_count < count($cat_item[Belt][Item_Id]); $cat_count++){ ?>
          <div class="mx-auto col-6 col-md-2 m2" style="margin-top:4rem;">
            <a href="./item_detail.php?id=<?= $cat_item[Belt][Item_Id][$cat_count]; ?>">  
              <img class="card-img-top" src="<?= Img_path . $cat_item[Belt][Item_Thum_Image][$cat_count]; ?>" alt="Card image cap">
            </a>
            <p class="card-title"><?= $cat_item[Belt][Item_Name][$cat_count]; ?></p>
            <h5 class="card-title text-danger"><?= $cat_item[Belt][Item_Price][$cat_count]; ?>円</h5>
          </div>
        <?php }; ?>
        </div>
    </div>
    <!--/カテゴリー ベルト -->
    <!-- ベルト商品一覧へ -->
    <form action="./item_list.php" class="" method="POST">
            <input type="hidden" name="cat[]" value="<?= Belt ?>">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-rounded" data-mdb-ripple-color="#ffffff"> ベルト一覧へ </button>
            </div>
        </form>

       <!-- /ベルト商品一覧へ -->

    <!-- カテゴリー 小物 -->
    <div class=""style="margin-top:5rem;">
      <div class="row justify-container-center">
        <p class="text-center mt-4 h2">小物</p>
        <?php for($cat_count = 0; $cat_count < count($cat_item[Accessory][Item_Id]); $cat_count++){ ?>
          <div class="mx-auto col-6 col-md-2 m2" style="margin-top:4rem;">
              <a href="./item_detail.php?id=<?= $cat_item[Accessory][Item_Id][$cat_count];?>">
                <img class="card-img-top" src="<?= Img_path .  $cat_item[Accessory][Item_Thum_Image][$cat_count]; ?>" alt="ard image cap">
              </a>
            <p class="card-title"><?= $cat_item[Accessory][Item_Name][$cat_count]; ?></p>
            <h5 class="card-title text-danger"><?= $cat_item[Accessory][Item_Price][$cat_count]; ?>円</h5>
          </div>
        <?php }; ?>
      </div>
    </div>
     <!-- 小物商品一覧へ -->
     <form action="./item_list.php" class="" method="POST">
          <input type="hidden" name="cat[]" value="<?= Accessory ?>">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button type="submit" class="btn btn-primary btn-rounded   " data-mdb-ripple-color="#ffffff"> 小物一覧へ </button>
        </form>
      </div>
    <!-- /小物商品一覧へ -->
    <!-- /カテゴリー 小物 -->
  </div>
</div>
<!-- ページトップボタン -->
<div id="page_top">
  <a href="#"></a>
</div>
<script>
   $('.slick01').slick();
</script>
<script type="text/javascript" src="js/slick.min.js"></script>
</body>
<?php 
  require_once "./footer.php"     //フッター読み込み
?>
</html>