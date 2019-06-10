<?php
?>

<div class="col-md-12">
	<h1>Create new task</h1>
</div>
<div class="col-md-12">
	<form id="login" action="/tasks/save" method="post">
		<input type="hidden" name="taskId" value="<?echo $taskId;?>">
		<div class="form-group">
			<label for="user">User</label>
			<input type="text" class="form-control" name="user" id="user" value="<? echo $user;?>" />
		</div>
		<div class="form-group">
			<label for="email">email</label>
			<input type="email" class="form-control" name="email" id="email" value="<? echo $email;?>" />
		</div>
		<div class="form-group">
			<label for="taskText">Task description</label>
			<textarea class="form-control" name="taskText" id="taskText"><? echo $taskText;?></textarea>
		</div>		
		<div class="mbr-buttons btn-inverse center">
			<input type="submit" class="btn btn-lg btn-success" value="Save" />
		</div>
	</form>

</div>