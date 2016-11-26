<?php

	if(!defined("__FLOWER__")) exit();
	
	class base
	{
		
		var $js_array = array();
		var $css_array = array();
		
		function &getInstance()
		{
			static $obj = null;
			if(!$obj) $obj = new base();

			return $obj;
		}
		
		function getJS()
		{
			$self = self::getInstance();
			return $self->js_array;
		}
		
		function addJS($js)
		{
			$self = self::getInstance();
			if(!maya::execute('$http||https$', $js, 'boolean', FALSE) && file_exists(__DIR.$js)){
				$self->js_array[] = __SUB.$js."?".date("YmdHis", (filectime(__DIR.$js)));
			}elseif(maya::execute('$http||https$', $js, 'boolean', FALSE)){
				$self->js_array[] = $js;
			}
		}
		
		function getCSS()
		{
			$self = self::getInstance();
			return $self->css_array;
		}
		
		function addCSS($css)
		{
			$self = self::getInstance();
			if(!maya::execute('$http||https$', $css, 'boolean', FALSE) && file_exists(__DIR.$css)){
				$self->css_array[] = __SUB.$css."?".date("YmdHis", (filectime(__DIR.$css)));
			}elseif(maya::execute('$http||https$', $css, 'boolean', FALSE)){
				$self->css_array[] = $css;
			}
		}
		
		function set($key, $val)
		{
			$self = self::getInstance();
			$self->{$key} = $val;
		}
		
		function get($key)
		{
			$self = self::getInstance();
			return $self->{$key};
		}
		
		function getReq()
		{
			$self = self::getInstance();
			return $self->req;
		}
		
		function getPDO()
		{
			$self = self::getInstance();
			return $self->pdo;
		}
		
		function getHost()
		{
			$self = self::getInstance();
			return $self->host;
		}
		
		function initHost()
		{
			$self = self::getInstance();
			$self->host = request::get_host();
		}
		
		function unsetReq($key)
		{
			$self = self::getInstance();
			unset($self->get[$key]);
		}
		
		function initReq()
		{
			$self = self::getInstance();
			$self->get = request::get_req_get();
		}
		
		function get_params($key)
		{
			if(!isset($this->get)) $this->get = request::get_req_get();
			return $this->get[$key];
		}
		
		function post_params($key)
		{
			if(!isset($this->post)) $this->post = request::get_req_post();
			return $this->post[$key];
		}
		
		function call()
		{
			if($_SERVER['HTTP_CACHE_CONTROL']=='no-cache') exit();
				
			ini_set('gd.jpeg_ignore_warning', true);
	
			date_default_timezone_set('Asia/Seoul');
	
			header("X-XSS-Protection: 1; mode=block");
			header("X-Frame-Options: SAMEORIGIN");
			header("X-Content-Type-Options: nosniff");
			header("Access-Control-Allow-Origin: *.".__SERVERNAME);
			//header("X-Scheme: https");
			header("X-EdgeConnect-Origin-MEX-Latency: 16");
			header("Server: FLOWER");
			header("X-Frame-Options: Deny");
			header("X-XSS-Protection: 1; mode=block");
			header("X-Content-Type-Options: nosniff");
			header("Content-Security-Policy:form-action 'self' ; base-uri 'self'; connect-src 'self' *.".__SERVERNAME.";  frame-ancestors 'self' *.youtube.com *.".__SERVERNAME." ; object-src 'self';");
			header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"'); //P3P 표준 헤더
			
			$this->initReq();
			$this->initHost();
			
			$self = self::getInstance();
			$self->get = request::get_req_get();
			$self->post = request::get_req_post();
			$self->req = request::get_req_method();
			$self->is_ajax = request::is_ajax();
			
			$db_file_path = __DIR."/file/config/db.php";
			
			$args = va::args();
			$args->from = $db_file_path;
			$setup_file = file::exist($args);
			
			if($setup_file){
				include($db_file_path);
				
				$args = va::args();
				$args->localhost = 'localhost';
				$args->db = $db_conn['db'];
				$args->user = $db_conn['user'];
				$args->password = $db_conn['password'];
				$args->catch_err = TRUE;
				$self->pdo = db::run($args);
				
				$init_system = __MOD."/init/base.class.php";
				if(file_exists($init_system)){
					include $init_system;
					$init = new init();
					$init->init();
				}else{
					exit('Basic installation system not found'.$init_system);
				}
			}else{
				$install_sys = __MOD."/install/base.class.php";
				if(file_exists($install_sys)){
					include $install_sys;
					$install = new install();
				}else{
					exit('Basic installation system not found'.$install_sys);
				}
			}
			
		}
		
	}

?>
