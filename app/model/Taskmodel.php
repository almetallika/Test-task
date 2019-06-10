<?php
/*
	Модель Tasks.php
	------------------------------------
	Модель для управления данными Задач
*/

class Taskmodel {
	
	public function __construct(){}
	
	public function create($user, $email, $text)
	{
		global $db;
		$db->query("INSERT INTO tasks (user, email,taskText, done) VALUES ('$user', '$email', '$text', 0)");
		return $db->insert_id();
	}
	
	public function getTask($taskId)
	{
		global $db;
		return $db->super_query("SELECT * FROM tasks WHERE taskId='$taskId'");
	}

	public function getTasks($page = 1, $rows = 3, $orderby = 'taskId', $order = " DESC ")
	{
		global $db;
		$start = ($page - 1) * $rows;
		
		$result['tasklist'] = $db->super_query("SELECT * FROM tasks ORDER BY {$orderby} {$order} LIMIT $start, $rows ", true);
		$result['rows'] = $db->super_query("SELECT COUNT(taskId) as records FROM tasks");
		return $result;
	}
	
	
	public function update($taskId, $data = null)
	{
		global $db;
		
		if (!$data) return false;
		
		foreach($data as $key=>$value)
		{
			$tmp[] = "$key='$value'"; 
		}
		return $db->query("UPDATE tasks SET ".implode(",",$tmp)." WHERE taskId=$taskId");
	}
	
	public function del($taskId)
	{
		global $db;
		$db->query("DELETE FROM tasks WHERE taskId=$taskId");
	}
	
}