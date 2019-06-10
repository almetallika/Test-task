<?php

class Tasks extends App
{
	public $per_page = 3;
	
	public function __construct()
	{
		$this->taskmodel = $this->load_class('Taskmodel','/model');
	}
	
	public function index( $page = 1 )
	{
		$header['title'] = "Welcome";
		$header['description'] = "Welcome page";
		$header['keywords'] = "Welcome, page, system";
		
		$uri = explode( "/", ltrim($_SERVER['REQUEST_URI'],'/'));
		$field = ($position = array_search("orderby",$uri)) ? $uri[++$position] : 'taskId';
		$order = ($field != 'taskId') ? $uri[++$position] : ' DESC ';
		
		$tasks = $this->taskmodel->getTasks( $page, $this->per_page, $field, $order );			// грузим список заданий
		$tasks['pages'] = ceil( (int)$tasks['rows']['records'] / $this->per_page);
		$tasks['current_page'] = $page;
		
		
		$data['content'] = $this->view('tasklist', $tasks, true);
		
		$this->view('header', $header);
		$out = $this->view('content', $data);
		$this->view('footer');	
	}
	
	public function page( $page = 1)
	{
		$this->index($page);
	}

	public function orderby( $field = '')
	{
		$this->index($page, $field);
	}
	
	
	public function create()
	{
		$header['title'] = "Create task";
		$header['description'] = "create task page";
		$header['keywords'] = "Welcome, page, system";

		$data['taskId'] = '';
		$data['user'] = '';
		$data['email'] = '';
		$data['taskText'] = '';
		
		$data['content'] = $this->view('createtask', $data, true);
		
		$this->view('header', $header);
		$out = $this->view('content', $data);
		$this->view('footer');		
	}

	public function edit( $taskId )
	{
		$header['title'] = "Create task";
		$header['description'] = "create task page";
		$header['keywords'] = "Welcome, page, system";

		$data = $this->taskmodel->getTask($taskId);
		
		$data['content'] = $this->view('createtask', $data, true);
		
		$this->view('header', $header);
		$out = $this->view('content', $data);
		$this->view('footer');		
	}

	public function del( $taskId )
	{
		$this->taskmodel->del($taskId);
		$this->redirect('/tasks');
	}
	
	public function save()
	{
		$data['user'] = $_REQUEST['user'];
		$data['email'] = $_REQUEST['email'];
		$data['taskText'] = $_REQUEST['taskText'];
		$taskId = $_REQUEST['taskId'];
		
		if ( $taskId == ""){
			$this->taskmodel->create($data['user'], $data['email'], $data['taskText']);
		} else {
			$this->taskmodel->update($taskId, $data);
		}
		$this->redirect('/tasks');
	}
	
	public function done( $taskId = null )
	{
		if (!$taskId) return false;
		$data = array('done' => 1);
		$this->taskmodel->update($taskId, $data);
		$this->redirect('/tasks');		
	}
	
}