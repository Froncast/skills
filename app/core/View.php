<?php

namespace app\core;

/**
 * 
 */
class View
{
	
	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	public function render($title, $vars = [])
	{
		extract($vars);
		$path = 'app/views/'.$this->path.'.php';
		if (file_exists($path))
		{
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'app/views/layouts/'.$this->layout.'.tpl.php';
		} else{
			echo "View not found: ".$path;
		}
	}

	public static function errorCode($code)
	{
		http_response_code($code);
		$path = 'app/views/errors/'.$code.'.php';
		if (file_exists($path))
		{
			require 'app/views/errors/'.$code.'.php';
		}
		exit();
	}

	public function redirect($url)
	{
		header('location: /skills'.$url);
		exit;
	}

	public function message($status, $message)
	{
		exit(json_encode(['status' => $status, 'message' => $message]));
	}
}
