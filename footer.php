<footer class="" style="background-color:black;">
 <div class="container">
   <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <span class="logo h1">pelle</span>
      </div>
<!-- フッターメニュー -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <ul class="menu ps-0">
          <span>Menu</span>           
          <li>
            <a href="./help.php">ヘルプ</a>
          </li>      
          <li>
            <a href="https://search.rakuten.co.jp/search/mall/%E3%83%99%E3%83%AB%E3%83%88%E5%B0%82%E9%96%80%E5%BA%97+%E3%80%90+%E3%83%99%E3%83%AB%E3%83%88%E3%83%B3+%E3%80%91/">画像提供元</a>
          </li>            
          <li>
            <p>個人情報保護方針<p>
          </li>
          <li>
            <p>特定商取引に基づく表記</p>
          </li>
          <li>
          <?php if (isset($_SESSION[User])) { ?>
            <a href="./del_user.php">退会する</a>
          <?php } else { ?>
            <p>退会する</p>
          <?php } ?>
          </li>
        </ul>
      </div>
<!-- //フッターメニュー -->
<!-- フッターコンタクト -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <ul class="contact ps-0">
          <span>Contact</span>       
          <li>
            <p>電話お問い合わせ</p>
          </li>
          <li>
            <a href="contuct.php" >お問い合わせ</a>
          </li> 
        </ul>
      </div>
<!-- //フッターコンタクト -->
    </div> 
  </div>
</footer>

<?php
  if(isset($_SESSION[User]))
  {
    $result = new USER();

    if($result->GetStatus($_SESSION[User][User_Id]))
    {
      $_SESSION = array();
    }

  }  
?>