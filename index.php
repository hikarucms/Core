<?php

	define('__FLOWER__', TRUE);
	define('__ROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
	define('__DIR', dirname(__FILE__));
		
	try{
		$target_include = __ROOT.'/class/load.components.php';
		
		if(file_exists($target_include)){
			require($target_include);
		}else{
			throw new Exception("File not found : ".$target_include, 1);
		}
	}catch(Exception $e){
		$error_message = $e->getMessage().'(Error Code : '.$e->getCode().')';
		include(__MOD.'/tpl/critical_msg.php');
	}

?>
