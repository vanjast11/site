<?php require_once "./head.php"; ?>
<?php require_once "./module/header_set.php"; ?>
<?php
if (!isset($_SESSION[User])) {
  header("Location: guest_cart.php"); // ユーザー情報がない場合（つまり非会員の場合）はゲスト用カートページへリダイレクト
}
?>
<!-- レビュー入力 review_input.php -->

<?php
// 入力フォームの中に入れる変数（最初は空欄）
$name = "";
$status = "";
$comment = "";
$errmsg = array();
if (isset($_POST["id"])) {
  $_SESSION["Item_Id"]["item_id"] = $_POST["id"];
}
if (!isset($_POST["id"]) && !isset($_SESSION["Item_Id"]["item_id"])) {
  header("Location:buy_list.php"); // 商品が選択されていない場合
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) { // 確認ボタンが押された場合の処理
  if (isset($_POST["name"]) && $_POST["name"] != "") {
    $_SESSION["Review"]["Rev_Name"] = htmlspecialchars($_POST["name"], ENT_QUOTES);
  } else {
    $errmsg[] = "名前が入力されていません";
    $_SESSION["Review"]["Rev_Name"] = "";
  }
  if (isset($_POST["status"]) && $_POST["status"] != "") {
    $_SESSION["Review"]["Rev_Status"] = $_POST["status"];
  } else {
    $errmsg[] = "評価が入力されていません";
    $_SESSION["Review"]["Rev_Status"] = "";
  }
  if (isset($_POST["comment"]) && $_POST["comment"] != "") {
    $_SESSION["Review"]["Rev_Comment"] = htmlspecialchars($_POST["comment"], ENT_QUOTES);
  } else {
    $errmsg[] = "レビューの内容が入力されていません";
    $_SESSION["Review"]["Rev_Comment"] = "";
  }
  if (!count($errmsg)) { // エラーがなければ確認ページへリダイレクト
    header("Location:review_conf.php");
    exit;
  }
}

// 確認ページから修正のためリダイレクトで戻ってきた場合の処理。また、入力してない項目があった場合（エラーがあった場合）もほかに入力した項目があればその項目はセッションに入っているので以下の数行処理を行う。
if (isset($_SESSION["Review"]["Rev_Name"])) {
  $name = $_SESSION["Review"]["Rev_Name"];
}
if (isset($_SESSION["Review"]["Rev_Status"])) {
  $status = $_SESSION["Review"]["Rev_Status"];
}
if (isset($_SESSION["Review"]["Rev_Comment"])) {
  $comment = $_SESSION["Review"]["Rev_Comment"];
}
$result = new ITEM();
$review = $result->GetDetailItem($_SESSION["Item_Id"]["item_id"]);

?>

<body>

  <!-- 全体 -->

  <div class="container ps-5">
      <p class="text-center mt-4 h2">レビュー入力</p>
    <div class="d-md-flex justify-content-center">

      <div class="col-md-6 col-sm-3">
            <img class="col-md-12 col-sm-3 m-0 w-50 ms-5" src="<?= Img_path . $review[Item_Image_1]; ?>" style="margin-left:2000px;">
        <div class="">
          <div class="">
            <h2 class=""><?= $review[Item_Name]; ?></h2>
          </div>
          <div class="">
            <h2 class=""><?= $review[Item_Price]; ?>円</h2>
          </div>
        </div>
      </div>

      <div>
        <form action="" class="form-inline" method="post">

          <!-- ユーザーお問合わせ内容 -->
          <div class="mx-auto">

            <!-- タイトル -->
            <div class="row form-group text-center mb-5 d-flex">

              <div class="d-flex row border p-4 mb-5">
                <div class="row justify-content-center">
                  <!-- お問い合わせタイトル -->
                  ニックネームを入力してください:<br />
                  <input class="form-control form-group col-3" id="inputdefault" type="text" name="name" value="<?php echo $name ?>"><br />
                  この商品の評価を１から５の5段階で入力してください：<br />
                  <select name="status">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                      <option value="<?php echo $i; ?>" <?php if ($status == $i) {
                                                          echo "selected";
                                                        } ?>><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                  <!-- テキストエリア -->
                  <div class="form-group mb-3 text-center"><br />
                    <label for="exampleFormControlTextarea1">レビュー内容入力</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="5"><?php echo $comment ?></textarea>
                  </div>
                </div>
                <!-- ボタンセクション -->
                <section class="mx-auto text-center">
                   <?php
                     foreach ($errmsg as $val) {
                       echo '<p class="text-danger">' . $val . '</p>';
                     }
                   ?>
                  <button type="submit" class="btn btn-primary btn-lg mt-2 mb-5" name="submit" value="conf">確認</button>
                </section>
                <!-- /ボタンセクション -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<?php require_once "./footer.php" ?>

</html>