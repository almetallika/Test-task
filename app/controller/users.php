<?php
/*
	class Users.php
	------------------------------
	Работа с пользователями
*/

class Users extends App
{
	public function __construct()
	{
		$this->usermodel = $this->load_class('Usermodel','/model');
	}
	
	public function login()
	{		
		$header['title'] = "Login page";
		$header['description'] = "Welcome page";
		$header['keywords'] = "Welcome, page, system";

		if (isset($_REQUEST['login']) AND ($_REQUEST['login'] === "OK"))
		{
			if( $this->usermodel->login($_REQUEST['username'], $_REQUEST['password']) ){
				$this->redirect( '/');
			}
		}
		$data['content'] = $this->view("login", '', true);
		
		$this->view("header", $header);
		$out = $this->view('content', $data);		
		$this->view("footer");
	}
	
	public function register()
	{
		$input['errmsg'] = '';
		if (isset($_REQUEST['register']) AND ($_REQUEST['register'] === "OK")) 
		{
			$result = $this->usermodel->register($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['password1']);
			if($result['status'] == true){
				$this->redirect( '/users/login');
			} else {
				$input['errmsg'] = $result['msg'];
			}
		}
		$header['title'] = "Register page";
		$header['description'] = "Welcome page";
		$header['keywords'] = "Welcome, page, system";
		
		$input['username'] = (isset($_REQUEST['username'])) ? $_REQUEST['username'] : "";
		$input['password'] = (isset($_REQUEST['password'])) ? $_REQUEST['password'] : "";
		$input['password1'] = (isset($_REQUEST['password1'])) ? $_REQUEST['password1'] : "";
		
		$data['content'] = $this->view("register", $input, true);
		
		$this->view("header", $header);
		$out = $this->view('content', $data);		
		$this->view("footer");
	}
	
	public function logout()
	{
		$this->usermodel->logout();
		$this->redirect('/');
	}
}