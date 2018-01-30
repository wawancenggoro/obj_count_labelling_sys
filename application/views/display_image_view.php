<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title>Display Image</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<h1>Display Image</h1>
	<table width ="600" border ="1" cellpadding="1" cellspacing="1">
		<tr>
			<td>id</td>
			<td>image_name</td>
			<td>image</td>
		</tr>
		<?php foreach ($data as $va) {?>
		<tr>
			<td><?php echo $va->image_id;?></td>
			<td><?php echo $va->image_name;?></td>
			<td>
				<img src="../../images/<?php echo $va->image_name;?>" width="200" height="200">
			</td>
		</tr>
		<?php } ?>

		
	</table>

</body>


</html>