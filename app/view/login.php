<?php
?>
	<div class="col-md-12">
		<h1>Login</h1>
	</div>

	<div class="col-md-12">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<form id="login" action="/users/login" method="post">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" id="username" value="" />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" value="" />
				</div>
				<div class="form-group">
					<a href="/users/register" >Register</a>
				</div>
				<input type="hidden" name="login" value="OK" />
				<div class="mbr-buttons btn-inverse center">
					<input type="submit" name="submit" id="submit" class="btn btn-lg " value="Login" />
				</div>
			</form>
		</div>
		<div class="col-md-3">
		</div>
	</div>


	
	