<?php
	
	function msi_db_connect($dbname) {
		$db = null;
	    $dsn = 'mysql:host=localhost;dbname=pos;port=3306';
	    $user ='root';
	    $password ='';
	    try {
	        $db = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => false));
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true); //prepares エミュレートモード
	        $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // カラム名を小文字で取得する
	        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // エラー時にExceptionをthrowさせる
			$db->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING); // 空文字をNUｌｌに変換
	    } catch(PDOException $e) {
			$code = $e->getCode();
			$str = $code;
				print $str;
				die();
		    }
		    return $db;
	}
	function msi_db_getConnect(&$db=null) {
		
		try {
			
			if(is_string($db)) $db = msi_db_connect($db);
			else if(!is_object($db)) return false;
			return true;
		} catch(PDOException $e) {
			throw $e;
			return false;
		}
	}

?>