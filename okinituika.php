<?php
require_once "./module/define.php";
//session_start();

// セッション受け取り
$user_id=$_POST ["user_id"];
$item_id=$_POST ["item_id"];
header("Content-type: application/json; charset=utf-8");
//確認用
//echo json_encode($item_id .$user_id);
	
	// 上記3つはおそらくincludeまたはrequireして使用するから最終的にはここに記述する必要はなくなると思うけど暫定的に記述しておきます。
	
	try {
		$db = new PDO(database_dsn,database_user,database_pass);
		$db->exec ( "SET NAMES utf8" );
		$db->setAttribute ( PDO::ATTR_CASE, PDO::CASE_LOWER );
		// 文字連結する場合は前後に空白入れないとエラーになるから要注意
		$sql = " SELECT user_id, item_id ";
		$sql .= " FROM k2g1_favorite ";
		$sql .= " WHERE user_id = ? ";
		$sql .= " AND item_id = ? ";
		// 文字連結する場合は前後に空白入れないとエラーになるから要注意
		$result = $db->prepare ( $sql );
		$result->execute ( array (
				$user_id,
				$item_id
		) );
		if ($result !== FALSE) {
			if (! $result->fetch ( PDO::FETCH_ASSOC )) {
				try {
					$db = new PDO ( $dsn, $user, $pass );
					$db->exec ( "SET NAMES utf8" );
					$db->setAttribute ( PDO::ATTR_CASE, PDO::CASE_LOWER );
					// 文字連結する場合は前後に空白入れないとエラーになるから要注意
					$sql = " INSERT INTO k2g1_favorite ";
					$sql .= " SET user_id = ?, ";
					$sql .= " item_id = ? ";
					// 文字連結する場合は前後に空白入れないとエラーになるから要注意
					$result = $db->prepare ( $sql );
					$result->execute ( array (
							$user_id,
							$item_id
					) );
					if ($result !== FALSE) {
						$db = NULL;
					} else {
						echo "SQL ERROR:" . $sql;
						$db = NULL;
					}
				} catch ( Exception $e ) {
					echo "MSG" . $e->getMessage () . "<br/>";
					echo "CODE" . $e->getCode () . "<br/>";
					echo "LINE" . $e->getLine () . "<br/>";
					$db = NULL;
				}
			} else {
				try {
					$db = new PDO(database_dsn,database_user,database_pass);
					$db->exec ( "SET NAMES utf8" );
					$db->setAttribute ( PDO::ATTR_CASE, PDO::CASE_LOWER );
					// 文字連結する場合は前後に空白入れないとエラーになるから要注意
					$sql = " DELETE FROM k2g1_favorite ";
					$sql .= " WHERE user_id = ? ";
					$sql .= " AND item_id = ? ";
					// 文字連結する場合は前後に空白入れないとエラーになるから要注意
					$result = $db->prepare ( $sql );
					$result->execute ( array (
							$user_id,
							$item_id
					) );
					if ($result !== FALSE) {
						$db = NULL;
					} else {
						echo "SQL ERROR:" . $sql;
						$db = NULL;
					}
				} catch ( Exception $e ) {
					echo "MSG" . $e->getMessage () . "<br/>";
					echo "CODE" . $e->getCode () . "<br/>";
					echo "LINE" . $e->getLine () . "<br/>";
					$db = NULL;
				}
			}
			
			$db = NULL;
		} else {
			echo "SQL ERROR:" . $sql;
			$db = NULL;
		}
	} catch ( Exception $e ) {
		echo "MSG" . $e->getMessage () . "<br/>";
		echo "CODE" . $e->getCode () . "<br/>";
		echo "LINE" . $e->getLine () . "<br/>";
		$db = NULL;
	}

