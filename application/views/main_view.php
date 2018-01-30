<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title><?php echo $title;?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
<?php
echo '<h2>Welcome-'.$this->session->userdata('username').'</h2>';
echo '<label><a href ="'.base_url().'main/logout">Logout</a></label>';
?>			
<br><br>
<a href="../main/view_marking">Mark Image</a>
<br>
<a href="../main/display_image">Display Image</a>
<br>
<a href="../main/upload_image">Upload Image</a>

</body>


</html>