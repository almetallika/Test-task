<?php
?>
	<div class="col-md-12">
		<h1>Register</h1>
	</div>
	<div class="col-md-12">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<form id="login" action="/users/register" method="post">
				<?echo $errmsg;?>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" id="username" value="<?echo $username;?>" />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" value="<?echo $password;?>" />
				</div>
				<div class="form-group">
					<label for="password1">Password1</label>
					<input type="password" class="form-control" name="password1" id="password1" value="<?echo $password1;?>" />
				</div>
				<div class="form-group">
					<a href="/users/login" >Login</a>
				</div>
				<input type="hidden" name="register" value="OK" />
				<div class="mbr-buttons btn-inverse center">
					<input type="submit" name="submit" id="submit" class="btn btn-lg " value="Register" />
				</div>
			</form>
		</div>
		<div class="col-md-3">
		</div>
	</div>


	
	