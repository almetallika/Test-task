<?php
/*
	App
	-----------------------------------------	
*/

class App {
	
	public $method;					// request method
	public $uri;						// request uri
	static $_classes = array();			// loaded classes
	
	public function __construct()
	{	
		$this->router();
	}
	
	public function router()
	{
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = $_SERVER['REQUEST_URI'];
		$_uri = explode("/",rtrim($this->uri,'/'));
		
		$controller = (isset($_uri[1])) ? $_uri[1] : DEFAULT_ROUTER;
		$method = (isset($_uri[2])) ? $_uri[2] : "index";
		
		$class = $this->load_class($controller);
				
		if(isset($_uri[3]))
		{
			$class->$method($_uri[3]);
		}
		else 
		{
			$class->$method( );
		} 
	}
	
	// load template
	public function view($template, $data = array(), $return_code = false)
	{
		$filename = VIEWPATH.'/'.$template.'.php';
		
		if (!file_exists($filename))	die("template ".$template." not found...");
		
		if ($data) extract($data);
		
		ob_start();
		
		include($filename); // include() vs include_once() allows for multiple views with the same name
		
		if ($return_code === TRUE)
		{
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}		
		ob_end_flush();
	}
	
	// load class
	public function &load_class($class, $directory = '/controller', $param = NULL)
	{
		// class exist?
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}
		
		foreach (array(APPPATH, LIBPATH) as $path)
		{
			if (file_exists($path.$directory.'/'.$class.'.php'))
			{
				if (class_exists($class, FALSE) === FALSE)
				{
					require_once($path.$directory.'/'.$class.'.php');
				}
				break;
			} else {
				$this->error404();
			}
		}
		
		$this->is_loaded($class);

		$_classes[$class] = isset($param)
			? new $class($param)
			: new $class();
		return $_classes[$class];		
	}
	
	public function &is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class !== '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}
		return $_is_loaded;
	}
	
	public function error404()
	{
		$this->view('error404');
	}
	
	public function redirect($path)
	{
		header("Location: ".$path);
	}
}