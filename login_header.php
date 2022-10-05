<?php 
  if(isset($_SESSION[User]))
  {
    $result = new USER();
    $result->UserOpeTime($_SESSION[User][User_Id]);
  }
?>
<header>
  <div class="header-top">
    <a href="index.php">
      <img src="<?= Img_path ?>logo.png" alt="" class="d-block mx-auto img-responsive" style="margin-bottom:55px;  display: block; height: 150px; width: 150px;">
    </a>
    <nav class="navbar navbar-expand-lg navbar-light text-center" style="background-color:black;">
      <div class="mx-auto" id="navbarNav">
        <ul class="navbar-nav mx-auto header_menu">
          <li class="me-5 ms-5">
            <p class="text-white ">ログイン名: <?= $_SESSION[User][User_Name]; ?> さん</p>
          </li>
          <li class="me-5 ms-5">
            <a class="" href="index.php">トップ</a>
          </li>
          <li class="ms-5 me-5">
            <a class="" href="./login_cart.php">カート</a>
          </li>
          <li class="ms-5 me-5">
            <a class="" href="notice.php">お知らせ</a>
          </li>
          <li class="ms-5 me-5">
            <a class="" href="brow_list.php">閲覧履歴</a>
          </li>
          <li class="ms-5 me-5">
            <a class="" href="buy_list.php">購入履歴</a>
          </li>
          <li class="ms-5 me-5">
            <a class="" href="okini_list.php">お気に入り</a>
          </li>
          <li class="ms-5 me-5">
            <form action="./logout.php" method="POST" name="logout">
              <a class="" href="javascript: logout.submit()">ログアウト</a>
            </form>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>

