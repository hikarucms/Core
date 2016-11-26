<?php

	const DS = DIRECTORY_SEPARATOR;

	if(!defined("__FLOWER__")) exit();
	
	error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
	
	if(!isset( $HTTP_RAW_POST_DATA)){
		$HTTP_RAW_POST_DATA = file_get_contents('php://input'); //XMLRPC(XML)
	}
	
	define('__ERR_REPORT', TRUE);
	define('__XMLRPC__', FALSE);
	define('__DEBUG__', TRUE);
	define('__CMS__', TRUE);
	define('__SUB', strlen(dirname($_SERVER['DOCUMENT_URI']))==1?'':dirname($_SERVER['DOCUMENT_URI']));
	define('__COMPONENTS__', 'base');
	define('__FILE__ATTACH', '/file/attach/');
	define('__THUMB__ATTACH', '/file/thumbnail/');
	define('__FILE', realpath(dirname(__FILE__)).DS);
	define('__ADDON', __DIR."/addon");
	define('__SYS', __DIR."/module");
	define('__REQURL', $_SERVER['REQUEST_URI']);
	define('__SERVERNAME', $_SERVER['SERVER_NAME']);
	define('__MOD', __SYS."/".__COMPONENTS__);
	
	if(defined(__ERR_REPORT)){
		error_reporting(-1);
	}
?>
