<?php
	// TCPDFライブラリ読み込み
	require_once "./tcpdf/tcpdf.php";
	require_once "./tcpdf/fpdi/autoload.php";
	
	// POSTされてきた購入日時・ユーザーIDから領収書情報取得
	function GetReceipt($order_time, $user_id)
	{
		$i = 0;
		$rec = array();
		
		try
		{
			// $db = new PDO("mysql:host=mysql650.db.sakura.ne.jp;dbname=minamiosakagisen_web21g1","minamiosakagisen","MI_osaka214");
				$db = new PDO("mysql:host=mysql650.db.sakura.ne.jp;dbname=minamiosakagisen_web21g1","minamiosakagisen","MI_osaka214");
			$db -> exec("SET NAMES utf8");
			$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			
			$sql = "SELECT 	order_name,
											b.pref_name as order_pref_name, 
											order_add, 
											order_tel,
											deli_name,
											c.pref_name as deli_pref_name,
											deli_add, 
											deli_tel,
											order_use_point, 
											order_get_point,
											item_name, 
											item_price,
											order_count, 
											(item_price * order_count) AS sumordercount											
 						FROM k2g1_item, 
								 k2g1_order, 
								 k2g1_prefectures b,
								 k2g1_prefectures c,
								(SELECT *
										FROM k2g1_order_det
										WHERE det_regi_date = ? ) a
							WHERE k2g1_item.item_id = a.item_id
								AND a.order_id = k2g1_order.order_id
								AND k2g1_order.order_pref_id = b.pref_id
								AND k2g1_order.deli_pref_id = c.pref_id
								AND k2g1_order.user_id = ? ";
			
			$result = $db->prepare($sql);
			$result->execute(array($order_time, $user_id));
			
			while($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$rec[$i]["order_name"] = $row["order_name"];
				$rec[$i]["order_pref"] = $row["order_pref_name"];
				$rec[$i]["order_add"] = $row["order_add"];
				$rec[$i]["order_tel"] = $row["order_tel"];
				$rec[$i]["deli_name"] = $row["deli_name"];
				$rec[$i]["deli_pref"] = $row["deli_pref_name"];
				$rec[$i]["deli_add"] = $row["deli_add"];
				$rec[$i]["deli_tel"] = $row["deli_tel"];
				$rec[$i]["use_point"] = $row["order_use_point"];
				$rec[$i]["get_point"] = $row["order_get_point"];
				$rec[$i]["item_name"] = $row["item_name"];
				$rec[$i]["item_price"] = $row["item_price"];
				$rec[$i]["order_count"] = $row["order_count"];
				$rec[$i]["SumOrderCount"] = $row["sumordercount"];
				$i++;
			}
			return $rec;
			
		}
		catch (Exception $e)
		{
			echo "MSG;" . $e->getMessage() . "<br>";
			echo "CODE;" . $e->getCode() . "<br>";
			echo "LINE;" . $e->getLine() . "<br>";
			$db = NULL;
		}
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$rec = GetReceipt($_POST["order_time"], $_POST["user_id"]);
		
		$i = 0;
		$subtotal = 0;
		
		// 注文者
		$order_name = $rec[$i]["order_name"];
		$order_pref = $rec[$i]["order_pref"];
		$order_add = $rec[$i]["order_add"];
		$order_tel = $rec[$i]["order_tel"];
		
		// お届け先
		$deli_name = $rec[$i]["deli_name"];
		$deli_pref = $rec[$i]["deli_pref"];
		$deli_add = $rec[$i]["deli_add"];
		$deli_tel = $rec[$i]["deli_tel"];
		
		// ポイント
		$use_point = $rec[$i]["use_point"];
		$get_point = $rec[$i]["get_point"];
		
		// 商品
		for (; $i < count($rec); $i++) {
			$item_name[$i] = $rec[$i]["item_name"];
			$item_price[$i] = $rec[$i]["item_price"];
			$order_count[$i] = $rec[$i]["order_count"];
			$SumOrderCount[$i] = $rec[$i]["SumOrderCount"];
			$subtotal += $SumOrderCount[$i];
		}
		
		// 合計
		$total = $subtotal - $use_point;
		
		$pdf = new setasign\Fpdi\Tcpdf\Fpdi();
		
		// ヘッダー領域を無効にする
		$pdf->setPrintHeader( false );
		
		// PDFテンプレート読み込み
		$pdf->setSourceFile("./tcpdf/receipt.pdf");
		$pdf->AddPage();
		$tpl = $pdf->importPage(1);
		$pdf->useTemplate($tpl);
		
		
		//$pdf->SetFont(フォント, スタイル, サイズ);
		//$pdf->Text(x座標, y座標, テキスト);
		
		$x = 43;
		$y = 41;
		$plus = 4.3;   // ＋約1行分
		
		//【注文者】
		//名前
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y, htmlspecialchars( $order_name ) );
		
		//都道府県名
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $order_pref ) );
		
		//住所
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $order_add ) );
		
		//電話番号
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $order_tel ) );
		
		
		
		//【お届け先】
		$y = 66.4;
		
		//名前
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y, htmlspecialchars( $deli_name ) );
		
		//都道府県名
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $deli_pref ) );
		
		//住所
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $deli_add ) );
		
		//電話番号
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $deli_tel ) );
		
		
		//【商品】
		for ($i = 0, $y = 96.5, $plus = 0; $i < count($rec); $i++, $plus+=4.3) {
			//商品名
			$pdf->SetFont('kozminproregular', '', 8);
			$pdf->Text(28, $y + $plus, htmlspecialchars( $item_name[$i] ) );
			
			//単価
			$pdf->SetFont('kozminproregular', '', 8);
			$item_price[$i] = number_format($item_price[$i]) . "-";
			$pdf->Text(99, $y + $plus, htmlspecialchars( $item_price[$i] ) );
			
			//数量
			$pdf->SetFont('kozminproregular', '', 8);
			$pdf->Text(133, $y + $plus, htmlspecialchars( $order_count[$i] ) );
			
			//金額
			$pdf->SetFont('kozminproregular', '', 8);
			$SumOrderCount[$i] = number_format($SumOrderCount[$i]) . "-";
			$pdf->Text(161, $y + $plus, htmlspecialchars( $SumOrderCount[$i] ) );
		}
		
		
		$x = 161;
		$y = 202.8;
		$plus = 4.3;
		
		// 小計
		$pdf->SetFont('kozminproregular', '', 8);
		$subtotal = number_format($subtotal) . "-";
		$pdf->Text($x, $y, htmlspecialchars( $subtotal ) );
		
		// 使用ポイント
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $use_point ) );
		
		// 合計
		$pdf->SetFont('kozminproregular', '', 8);
		$total = number_format($total) . "-";
		$pdf->Text($x, $y += $plus, htmlspecialchars( $total ) );
		
		// 獲得ポイント
		$pdf->SetFont('kozminproregular', '', 8);
		$pdf->Text($x, $y += $plus, htmlspecialchars( $get_point ) );
		
		
		//$pdf->Output(出力時のファイル名, 出力モード);
		$pdf->Output("receipt.pdf", "I");
	}
	
	
	
?>


<html>
<head>
<title></title>
</head>

<body>
</body>
</html>
