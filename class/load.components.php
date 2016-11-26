<?php

	if(!defined("__FLOWER__")) exit();

	function load_php($target_include)
	{
		if(file_exists($target_include)){
			include($target_include);
		}else{
			die("Fatal Error : Could not call $target_include");
		}
	}
	
	include('HttpClient.class.php');
	
	load_php(__ROOT.'/class/system/Defined.php');
	load_php(__ROOT.'/class/components/Request/Variables.php');
	load_php(__ROOT.'/class/components/Request/Request.php');
	
	define('__StartTime__', request::getMicroTime());
	
	function load_extension(){
		request::load_php(__ROOT.'/class/system/defined.php');
		request::load_php(__ROOT.'/class/components/template.php');
		/* Maya */
		request::load_php(__ROOT.'/class/components/Maya/maya.php');
		/* Cache */
		request::load_php(__ROOT.'/class/components/Cache/Redis.php');
		request::load_php(__ROOT.'/class/components/Cache/Apc.php');
		request::load_php(__ROOT.'/class/components/Cache/Memcached.php');
		/* File System */
		request::load_php(__ROOT.'/class/components/FileSystem/File.php');
		request::load_php(__ROOT.'/class/components/FileSystem/Directory.php');
		/* Image */
		request::load_php(__ROOT.'/class/components/Image/Image.php');
		/* Stream */
		request::load_php(__ROOT.'/class/components/Stream/Stream.php');
		/* Compress */
		request::load_php(__ROOT.'/class/components/Compress/Zlib.php');
		request::load_php(__ROOT.'/class/components/Compress/Zip.php');
		/* Database */
		request::load_php(__ROOT.'/class/components/Database/Db.php');
		/* Request */
		request::load_php(__ROOT.'/class/components/Request/Header.php');
		request::load_php(__ROOT.'/class/components/Request/Cookie.php');
		request::load_php(__ROOT.'/class/components/Request/Session.php');
		request::load_php(__ROOT.'/class/components/Request/String.php');
		request::load_php(__ROOT.'/class/components/Request/Array.php');
		request::load_php(__ROOT.'/class/components/Request/Func.php');
		request::load_php(__ROOT.'/class/components/Reuqest/Parser.php');
		request::load_php(__ROOT.'/class/components/Reuqest/Json.php');
		request::load_php(__ROOT.'/class/components/Reuqest/Mail.php');
		/* ID3 */
		request::load_php(__ROOT.'/class/components/Id3/Id3.php');
	}

	spl_autoload_register('load_extension');
	
	if(defined("__CMS__")){
		session::on();
		load_php(__ROOT.'/class/base/base.php');
		$base = new base();
		$base->call();
	}
?>
