<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title>Upload Image</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<h1>Upload Image</h1>
	  <?php echo $error;?> 
	  <form method="post" action="<?php echo base_url();?>main/do_upload" enctype="multipart/form-data" />
			<input type="file" name="userfile"/>
			<input type="submit" name="submit" value ="Upload Image">
	</form>
</body>


</html>