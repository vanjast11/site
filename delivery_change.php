<?php 
  require_once "./head.php"; 
?>
	<style>
		.h5 { border-bottom: solid;
			  position: relative; }
	</style>

</head>

<?php require_once "./module/header_set.php";?>

<?php
/*
 * <input type = "text" name = "change_pref" value = "<?=  $pref_name[Bb_Pref_Name] ?>" ></br>
 */
$result = new USER();
$pref = $result->GetPref();
$name = "";
$ruby = "";
$post = "";
$pref_id = 1;
$add = "";
$tel = "";

if(isset($_POST["deli_name"]))
{
	$name = $_POST["deli_name"];
}
if(isset($_POST["deli_ruby"]))
{
	$ruby = $_POST["deli_ruby"];
}
if(isset($_POST["deli_post"]))
{
	$post = $_POST["deli_post"];
}
if(isset($_POST["deli_pref_id"]))
{
	$pref_id = $_POST["deli_pref_id"];
}
if(isset($_POST["deli_add"]))
{
	$add = $_POST["deli_add"];
}
if(isset($_POST["deli_tel"]))
{
	$tel = $_POST["deli_tel"];
}
// 2022年3月11日都道府県IDから都道府県名取得するアルゴリズム記述すること！！！
$result = new USER();
$pref_name = $result->GetPrefName($pref_id);
var_dump($pref_name);
// 2022年3月11日都道府県IDから都道府県名取得するアルゴリズム記述すること！！！
?>


<html>
<head>
<title>pelle</title>
</head>
<body class="text-center">

<form action = "purchase.php" method = "post">
	お届け先のお名前：
	<input type = "text" name = "change_name" value = "<?=  $name ?>" ></br>
	お届け先のふりがな：
	<input type = "text" name = "change_ruby" value = "<?=  $ruby ?>" ></br>
	お届け先の郵便番号：
	<input type = "text" name = "change_post" value = "<?=  $post ?>" ></br>
	お届け先の都道府県：
	<select name="change_pref"  id="">
                    <?php for($i=0; $i < count($pref[Bb_Pref_Id]); $i++) { ?> 
                        <option value="<?= $pref[Bb_Pref_Name][$i]; ?>"
                        <?php 
                        if($pref[Bb_Pref_Name][$i] == $pref_name[Bb_Pref_Name])
                        {
                        	echo "selected";
                        }
                        ?>
                        ><?= $pref[Bb_Pref_Name][$i]; ?></option>
                    <?php }; ?>    
                
    </select>
	</br>
	お届け先の住所：
	<input type = "text" name = "change_add" value = "<?=  $add ?>" ></br>
	お届け先の電話番号：
	<input type = "text" name = "change_tel" value = "<?=  $tel ?>" ></br>
	<input type = "hidden" name = "user_id" value = "<?=  $_POST["user_id"]; ?>" ></br>
	<input type="hidden" name="order_money" value='<?= $_POST["order_money"]; ?>'>
	<input type="hidden" name="use_point" value='<?= $_POST["use_point"]; ?>'>
	<input type = "submit" name = "deli_change" value = "上記のお届け先情報に変更する" >
</form>

<?php require_once "./footer.php" ?>
</body>
</html>