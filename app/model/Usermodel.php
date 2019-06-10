<?php


class Usermodel {
	
	public function __construct(){}
	
	
	/*
		Регистрация пользователя
	*/
	public function register($username, $password, $password1)
	{
		global $db;
		
		if ($password != $password1){
			return array('status' => false, 'msg' => "Введенные пароли не совпадают");
		}
		
		if ($this->userRegistered($username)){
			return array('status' => false, 'msg' => "Такой пользователь уже существует");
		}
		
		$hash = md5($password);
		$db->query("INSERT INTO users (username, password, admin) VALUES ('$username', '$hash',  0)");
		$userId = $db->insert_id();
		return array('status' => true, 'msg' => "Пользователь зарегистрирован, код пользователя $userId");
	}
	
	/*
		Проверка наличия пользователя
	*/
	public function userRegistered($username)
	{
		global $db;
		
		$founded = $db->super_query("SELECT userId FROM users WHERE username='$username'");
		return $founded;
	}
	
	/*
		Вход в систему
	*/
	public function login($username, $password)
	{
		global $db;
		$hash = md5($password);
		$userData = $db->super_query("SELECT * FROM users WHERE username='$username' AND password='$hash'");
		if ($userData){
			$_SESSION['username'] = $username;
			$_SESSION['is_admin'] = ($userData['admin'] == 1) ? true : false;
			$_SESSION['logged'] = true;
			return true;
		}
		return false;
	}
	
	public function logout()
	{
		session_destroy();
		
	}
}