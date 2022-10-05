<?php
require_once "./module/define.php";
$flg = $_POST["flg"];
	// $dcount = $_POST["dcount"] = "31"	;
	// $ym = $_POST["ym"] = "2022_03";
	// $result = MonthSales($ym, $dcount);
	// echo $result;
	// 年間
	if($flg == 1)
	{
		$yy = $_POST["yy"];
		$flg = $_POST["flg"];
		$result = YearSales($yy);
	}
	
	// 月間
	if($flg == 2)
	{
		$dcount = $_POST["dcount"];
		$ym = $_POST["ym"];
		$result = MonthSales($ym, $dcount);
		
	}
	
	// 週間
	if($flg == 3)
	{
		$wcount = $_POST["wcount"];
		$yy = $_POST["yy"];
		$mm = $_POST["mm"];
		$dd = $_POST["dd"];
		$flg = $_POST["flg"];
		$result = WeekSales($wcount, $yy, $mm, $dd);
	}

	
// ------------------------------ 年間 ------------------------------
	function YearSales($yy){
		
		try
		{
			
			$db = new PDO(database_dsn,database_user,database_pass);
			$db -> exec("SET NAMES utf8");
			$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			
			$year = array();
			
			// 1月～9月分
			for ($i = 0; $i < 9; $i++) {
				$sql = 'SELECT SUM(order_money), COUNT(*)
		                FROM   k2g1_order
		                WHERE  buy_day
		                LIKE   ?';
				$result = $db->prepare($sql);
				$result->execute(array($yy . '_0' . ($i+1) . '%'));
				
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$year[$i]["money"] = $row["sum(order_money)"];
					$year[$i]["count"] = $row["count(*)"];
				}
				
				// 値が無かったら0を代入
				if (!isset($year[$i]["money"])) {
					$year[$i]["money"] = 0;
					$year[$i]["count"] = 0;
				}
			}
			
			// 10月～12月分
			for ($i = 9; $i < 12; $i++) {
				$sql = 'SELECT SUM(order_money), COUNT(*)
		                FROM   k2g1_order
		                WHERE  buy_day
		                LIKE   ?';
				$result = $db->prepare($sql);
				$result->execute(array($yy . '_' . ($i+1) . '%'));
				
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$year[$i]["money"] = $row["sum(order_money)"];
					$year[$i]["count"] = $row["count(*)"];
				}
				
				// 値が無かったら0を代入
				if (!isset($year[$i]["money"])) {
					$year[$i]["money"] = 0;
					$year[$i]["count"] = 0;
				}
			}
			
			return $year;
		}
		catch (Exception $e)
		{
			echo "MSG;" . $e->getMessage() . "<br>";
			echo "CODE;" . $e->getCode() . "<br>";
			echo "LINE;" . $e->getLine() . "<br>";
			$db = NULL;
		}
		
	}
	
	
	
	// ------------------------------ 月間 ------------------------------
	function MonthSales($ym, $dcount){
		
		try
		{
			$db = new PDO(database_dsn,database_user,database_pass);
			$db -> exec("SET NAMES utf8");
			$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			
			$month = array();
			
			// 1日～9日分
			for ($i = 0; $i < 9; $i++) {
				$sql = 'SELECT SUM(order_money), COUNT(*)
		                FROM   k2g1_order
		                WHERE  buy_day
		                LIKE   ?';
				$result = $db->prepare($sql);
				$result->execute(array($ym . '_0' . ($i+1) . '%'));
				
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$month[$i]["money"] = $row["sum(order_money)"];
					$month[$i]["count"] = $row["count(*)"];
				}
				
				if (!isset($month[$i]["money"])) {
					$month[$i]["money"] = 0;
					$month[$i]["count"] = 0;
				}
			}
			
			// 10日～月末分
			// 指定日からその月の日数を取得しカウント
			for ($i = 9; $i < $dcount; $i++) {
				$sql = 'SELECT SUM(order_money), COUNT(*)
		                FROM   k2g1_order
		                WHERE  buy_day
		                LIKE   ?';
				$result = $db->prepare($sql);
				$result->execute(array($ym . '_' . ($i+1) . '%'));
				
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$month[$i]["money"] = $row["sum(order_money)"];
					$month[$i]["count"] = $row["count(*)"];
				}
				
				// 値が無かったら0を代入
				if (!isset($month[$i]["money"])) {
					$month[$i]["money"] = 0;
					$month[$i]["count"] = 0;
				}
			}
			
			return $month;
			
		}
		catch (Exception $e)
		{
			echo "MSG;" . $e->getMessage() . "<br>";
			echo "CODE;" . $e->getCode() . "<br>";
			echo "LINE;" . $e->getLine() . "<br>";
			$db = NULL;
		}
		
	}
	
	
	
	// ------------------------------ 週間 ------------------------------
	 function WeekSales($wcount, $yy, $mm, $dd){
		
		try
		{
			$db = new PDO(database_dsn,database_user,database_pass);
			$db -> exec("SET NAMES utf8");
			$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			
			$week = array();
			
			// 指定日の曜日の数値($wcount)で、月曜の日付から順に計算
			for ($i = 6; $i >= 0; $i--, $wcount--) {
				$sql = 'SELECT SUM(order_money), COUNT(*)
		                FROM   k2g1_order
		                WHERE  buy_day
		                LIKE   ?';
				
				// 月曜から順に日付を取得
				$tm = mktime(0, 0, 0, $mm, $dd - $wcount, $yy);
				$ymd = date('Y_m_d', $tm);
				$result = $db->prepare($sql);
				$result->execute(array($ymd . '%'));
				
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$week[$i]["money"] = $row["sum(order_money)"];
					$week[$i]["count"] = $row["count(*)"];
				}
				
				// 値が無かったら0を代入
				if (!isset($week[$i]["money"])) {
					$week[$i]["money"] = 0;
					$week[$i]["count"] = 0;
				}
			}
			
			return $week;
			
		}
		catch (Exception $e)
		{
			echo "MSG;" . $e->getMessage() . "<br>";
			echo "CODE;" . $e->getCode() . "<br>";
			echo "LINE;" . $e->getLine() . "<br>";
			$db = NULL;
		}
		
	}
	

	header("Content-type: application/json; charset=UTF-8");
	echo json_encode($result);
	exit;

?>
