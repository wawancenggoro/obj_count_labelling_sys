<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title><?php echo $title;?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<h1>Register</h1>
	<div id="body">
		<form method="post" action="<?php echo base_url();?>main/register_data">
				<div class="form-group">
					<label>Username:</label>
					<input type="text" name="username" class ="form-control"/>
				</div>
				<br>
				<div class="form-group">
					<label>Password :</label>
					<input type="password" name="password" class ="form-control"/>
				</div>
				<br>
				<div class="form-group">
					<label>Role :</label>
					<input type="text" name="role" class ="form-control"/>
				</div>
				<br>
				<div class="form-group">
					<input type="submit" name="insert" value="Login" class ="btn btn-info"/>
				</div>
		</form>
	</div>

</body>


</html>