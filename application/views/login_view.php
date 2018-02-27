<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>

</head>
<body>

<div id="container">
	<h1>Login</h1>

	<div id="body">
		<form method="post" action="<?php echo base_url();?>main/login_validation">
				<div class="form-group">
					<label>Username:</label>
					<input type="text" name="username" class ="form-control"/>
					<span class="test-danger"><?php echo form_error('username');?></span>
				</div>
				<br>
				<div class="form-group">
					<label>Password :</label>
					<input type="password" name="password" class ="form-control"/>
					<span class="test-danger"><?php echo form_error('password');?></span>
				</div>
				<br>
				<div class="form-group">
					<input type="submit" name="insert" value="Login" class ="btn btn-info"/>
					<a href="index.php?/main/register">Register</a>
					<?php
					echo $this->session->flashdata("error");
					?>
				</div>
		</form>
	</div>

</div>
</body>
</html>