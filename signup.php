<?php 
  require_once "./head.php"; 
?>
    <!--自作CSS -->
    <style type="text/css">
        /*ここに調整CSS記述*/
    </style>
    <link rel="stylesheet" href="./css/login.css">
</head>
<?php 
    $i = ""; //性別表示ループ用
    $sex = array(1 => "男性", 2 => "女性",  3=> "無回答"); //性別配列

?>

<?php require_once "./module/header_set.php";?>
<body>

<h1 class="h3 mt-5 text-center">新規会員登録</h1>

<!-- Page Content -->
<div class="container text-center p-lg-5 ">

    <form action="./signup_conf.php" method="POST" name="loginform" class="needs-validation" novalidate>

      <!--ユーザーID-->
      <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">会員ID</label>
            <div class="col-sm-10">
                <input type="text" id="id" name="id" class="col-12 id-form" value="<?php if(isset($_POST["id"])){ echo $_POST["id"]; }; ?>" placeholder=" ログインの際に使用するIDを入力してください">
                <div class="invalid-feedback">入力してください</div>
                <p class="form-text text-muted">文字と数字を含めて20文字以内で、空白、特殊文字、絵文字を含むことはできません。</p>
            </div>
            <div class="err-msg-id mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/ユーザーID-->

        <!--名前-->
        <div class="form-group row mb-5">
            <label for="" class="col-sm-2 col-form-label">名前</label>
            <div class="col-sm-10">
            	<select name="name" class="col-12" id="name">
                    <option value="田中太郎">田中太郎</option>
                    <option value="佐藤花子">佐藤花子</option>
                    <option value="鈴木ジョニー">鈴木ジョニー</option>
                </select>
            </div>
            <div class="err-msg-name mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/名前-->

        <!--ふりがな-->
        <div class="form-group row mb-5">
            <label for="inputEmail" class="col-sm-2 col-form-label">ふりがな</label>
            <div class="col-sm-10">
                <select name="ruby" class="col-12" id="ruby">
                    <option value="たなかたろう">たなかたろう</option>
                    <option value="さとうはなこ">さとうはなこ</option>
                    <option value="すずきじょにー">すずきじょにー</option>
                </select>
            </div>
            <div class="err-msg-ruby mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/ふりがな-->

        <!--生年月日-->
        <div class="form-group row mb-5">
            <label for="inputEmail" class="col-sm-2 col-form-label">生年月日</label>
            <div class="col-sm-10">
                <select name="birth" class="col-12" id="birth">
                    <option value="20000101">20000101</option>
                    <option value="20000606">20000606</option>
                    <option value="20001212">20001212</option>
                </select>
            </div>
            <div class="err-msg-birth mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/ふりがな-->


        <!--Eメール-->
        <div class="form-group row mb-5">
            <label for="inputEmail" class="col-sm-2 col-form-label">Eメール</label>
            <div class="col-sm-10">
                <input type="text" id="mail" name="email" class="col-12 mail-form" value="<?php if(isset($_POST["email"])){ echo $_POST["email"]; }; ?>" placeholder=" Eメール">
                <div class="invalid-feedback">入力してください</div>
            </div>
            <div class="err-msg-mail mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/Eメール-->

        <!--パスワード-->
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">パスワード</label>
            <div class="col-sm-10">
                <input type="password" id="pass" name="pass" class="col-12 pass-form" placeholder=" パスワード">
                <div class="invalid-feedback">入力してください</div>
                <small id="passwordHelpBlock" class="form-text text-muted">パスワードは、文字と数字を含めて8～20文字で、空白、特殊文字、絵文字を含むことはできません。</small>
            </div>
            <div class="err-msg-pass mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/パスワード-->

        <!--確認パスワード-->
        <div class="form-group row mb-5">
            <label for="inputPassword" class="col-sm-2 col-form-label">確認パスワード</label>
            <div class="col-sm-10">
                <input type="password" id="checkPass" class="col-12 checkPass-form" placeholder=" 再度パスワードを入力してください">
                <div class="invalid-feedback">入力してください</div>
            </div>
            <div class="err-msg-checkPass mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/確認パスワード-->

        <!--電話番号-->
        <div class="form-group row mb-5">
            <label for="inputPassword" class="col-sm-2 col-form-label">電話番号</label>
            <div class="col-sm-10">
                <select name="tel" class="col-12" id="tel">
                    <option value="0611112222">0611112222</option>
                    <option value="0344445555">0344445555</option>
                    <option value="09011112222">09011112222</option>
                </select>
            </div>
            <div class="err-msg-tel mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/電話番号-->

        <!--郵便番号-->
        <div class="form-group row mb-5">
            <label for="inputPassword" class="col-sm-2 col-form-label">郵便番号</label>
            <div class="col-sm-10">
                <select name="post" class="col-12" id="post">
                    <option value="1112222">1112222</option>
                    <option value="3334444">3334444</option>
                    <option value="5556666">5556666</option>
                </select>
            </div>
            <div class="err-msg-post mt-0 mb-1 text-danger"><?php if(isset($mailerr)){echo $mailerr;}?></div>
        </div>
        <!--/郵便番号-->

        <!--都道府県-->
        <?php
            $result = new USER();
            $pref = $result->GetPref();
        ?>
        <div class="form-group row mb-5">
            <label for="inputPassword" class="col-sm-2 col-form-label">都道府県</label>
            <div class="col-sm-10">
                <select name="pref" class="col-12" id="">
                    <?php for($i=0; $i < count($pref[Bb_Pref_Id]); $i++) { ?> 
                        <option value="<?= $pref[Bb_Pref_Id][$i]; ?>"><?= $pref[Bb_Pref_Name][$i]; ?></option>
                    <?php }; ?>    
                
                </select>
                <div class="invalid-feedback">入力してください</div>
            </div>
        </div>
        <!--/都道府県-->

        <!--住所-->
        <div class="form-group row mb-5">
            <label for="inputPassword" class="col-sm-2 col-form-label">住所</label>
            <div class="col-sm-10">
                <select name="add" class="col-12" id="add">
                    <option value="和泉市テクノステージ2丁目3番地5号">和泉市テクノステージ2丁目3番地5号</option>
                    <option value="大阪市北区梅田1">大阪市北区梅田1</option>
                    <option value="大阪市中央区2">大阪市中央区2</option>
                </select>
            </div>
        </div>
        <!--/住所-->

        <!--性別-->
        <div class="form-group">
            <div class="row mb-4">
                <legend class="col-form-label col-sm-2">性別</legend>
                <div class="col-sm-8 d-flex justify-content-between">
                    <?php foreach($sex as $key => $val){ ?>
                    <div class="">
                        <input type="radio" name="sex" value="<?= $key ?>" <?php if(isset($_POST["sex"]))
                                                                                    { 
                                                                                        if($_POST["sex"] == $key)
                                                                                        {
                                                                                            echo "checked"; 
                                                                                        } 
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "checked"; 
                                                                  }; ?>>
                        <label for="customRadioInline1"><?= $val ?></label>
                    </div>
                    <?php }; ?>
                </div>
            </div>
        </div>
        <!--/性別-->

        <!--利用規約-->
        <div class="form-group pb-3">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="custom-control-label" for="invalidCheck">
                    利用規約に同意する
                </label>
                <div class="invalid-feedback mb-3">提出する前に同意する必要があります</div>
            </div>
        </div>
        <!--/利用規約-->

        <!--ボタンブロック-->
        <div class="section1 text-center">
            <div class="form-group row">
                <div class="col-sm-12">
                <button class="w-100 btn btn-lg btn-primary" type="submit" id="submit">登録</button>
                </div>
            </div>
        </div>
        <!--/ボタンブロック-->

    </form>

</div><!-- /container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<!-- 郵便番号から住所自動入力 -->
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<!-- Validation -->
<script>

    // 無効なフィールドがある場合にフォーム送信を無効にするスターターJavaScriptの例
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // カスタムブートストラップ検証スタイルを適用するすべてのフォームを取得
            var forms = document.getElementsByClassName('needs-validation');
            // ループして帰順を防ぐ
            var validation = Array.prototype.filter.call(forms, function(form) {
                // submitボタンを押したら以下を実行
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script src="js/user_register_validation.js"></script>
</body>

<?php require_once "footer.php"; ?>
</html>