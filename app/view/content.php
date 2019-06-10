<?php
?>
	<div class="navbar navbar-inverse"  role="navigation"> 
		<a class="navbar-brand" href="/">Tasks</a>
		<ul class="nav navbar-nav">
			<li class="nav-item active">
			<?php if (isset($_SESSION['logged']) AND ($_SESSION['logged'] == true)) { ?>
				 <a class="nav-link" href="/users/logout">Logout</span></a>
	<?php		} else {	?>
				 <a class="nav-link" href="/users/login">Login</span></a> 
	<?php		} 			?>
			</li>
		</ul> 
	</div>

<div class="container-fluid">
	<div class="row">

	</div>
	
	<div class="row">
		<div class="col-md-10 col-xs-12" >
			<?php echo $content;?>
		</div>
	</div>

</div>
