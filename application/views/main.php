<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

<a href="../marking/view">Mark Image</a>
<br>
<a href="display.html">Display Image</a>
<br>
<a href="upload.html">Upload Image</a>

<table>
	<tr>
		<td><?php print_r($_SESSION);?></td>
	</tr>  
</table>

<a href="<?php echo base_url('index.php/main/logout'); ?>">Logout</a>  
</body>


</html>