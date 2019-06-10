<?php 
// пагинация
$nearpages = 3;
$pagination = "";
if ($pages > 1){
	$pagination .=<<<HTML
	<ul class="pagination">
HTML;
	$startpage = ($current_page > $nearpages) ? ($current_page - $nearpages) : 1;
	$endpage = ($current_page + $nearpages <= $pages ) ? ($current_page + $nearpages) : $pages;
	for ($i = $startpage; $i <= $endpage; $i++){
		$active = ($i == $current_page) ? "active" : "";
		$pagination .= <<<HTML
		<li class="{$active}" ><a href="/tasks/page/{$i}">{$i}</a></li>
HTML;
	}
	$pagination .=<<<HTML
	</ul>
HTML;
}

$is_admin = (isset($_SESSION['is_admin']) AND ($_SESSION['is_admin'])) ? true : false;

?>

<div class="col-md-12">
&nbsp;
</div>

<div class="col-md-12">
	<div class="col-md-8" >
		<h1>Task list</h2>
	</div>
	<div class="col-md-4" >
		<a class="btn btn-success" href="/tasks/create">+ Task</a>
	</div>
</div>
<div class="col-md-12">
	<table class="table table-hover" >
		<thead>
			<th><a href="/tasks/page/<?echo $current_page;?>/orderby/user/asc">User</a></th>
			<th><a href="/tasks/page/<?echo $current_page;?>/orderby/email/asc">Email</a></th>
			<th>Task text</th>
	<?
		if ($is_admin) { ?>
			<th>Admin action</th>
	<?	}
	?>
		</thead> 
		<tbody>
	<?
		foreach($tasklist as $task) {
			
			$done = ( $task['done'] == 1) ? ' class="success" ' : "";
	?>
		<tr <? echo $done;?> id="task-<?echo $task['taskId'];?>">
			<td><?echo $task['user'];?></td>
			<td><?echo $task['email'];?></td>
			<td><?echo $task['taskText'];?></td>
	<?
		if ($is_admin) { ?>
			<td>
				<a href="/tasks/edit/<?echo $task['taskId'];?>">Edit</a>
				<a href="/tasks/del/<?echo $task['taskId'];?>">Delete</a>
				<a href="/tasks/done/<?echo $task['taskId'];?>">Done</a>
			</td>
	<?	}
	?>
		</tr> <?
		}
		?>
		</tbody>
	</table>
</div>

<div class="col-md-12">
	<?php echo $pagination;?>
</div>
