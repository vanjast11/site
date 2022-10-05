<?php 
      $url = array(); 
      $url = explode("/", $_SERVER['REQUEST_URI']);
?>

<div class="d-none d-lg-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <span class="fs-4">管理者メニュー</span>
      <hr>
      <ul class="nav flex-column mb-auto">
        <li class="nav_item <?php if($url[count($url) - 1 ] == "test1.php"){ echo "menu_active"; }; ?>">
          <a href="test1.php" class="nav-link link-dark" aria-current="page">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#home" />
            </svg>
            売り上げ管理
          </a>
        </li>
        <li class="nav_item <?php if($url[count($url) - 1 ] == "test2.php"){ echo "menu_active"; }; ?>">
          <a href="test2.php" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#speedometer2" />
            </svg>
            商品別売り上げ
          </a>
        </li>
        <li class="nav_item <?php if($url[count($url) - 1 ] == "test3.php"){ echo "menu_active"; }; ?>">
          <a href="test3.php" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#table" />
            </svg>
            お問い合わせ管理
          </a>
        </li>
        <li class="nav_item <?php if($url[count($url) - 1 ] == "test4.php"){ echo "menu_active"; }; ?>">
          <a href="test4.php" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#grid" />
            </svg>
            商品編集
          </a>
        </li>
        <li class="nav_item <?php if($url[count($url) - 1 ] == "test5.php"){ echo "menu_active"; }; ?>">
          <a href="test5.php" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#people-circle" />
            </svg>
            商品追加
          </a>
        </li>
        <li class="nav_item <?php if($url[count($url) - 1 ] == "test6.php"){ echo "menu_active"; }; ?>">
          <a href="test6.php" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#people-circle" />
            </svg>
            在庫編集
          </a>
        </li>
        <li class="nav_item <?php if($url[count($url) - 1 ] == "test7.php"){ echo "menu_active"; }; ?>">
          <a href="test7.php" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#people-circle" />
            </svg>
            ユーザー情報変更
          </a>
        </li>
        <li class="nav_item ">
          <a href="./adm_logout.php" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#people-circle" />
            </svg>
            ログアウト
          </a>
        </li>
      </ul>
    </div>