<?php
$uploaddir = '';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$name = $_POST['name'];

$conn = pg_pconnect("dbname=postgres user=postgres password=root");
$query = "insert into images (image_name,path)values ('$name', '$uploadfile')";
$result = pg_query($query);

echo "'$result'\n";

if($result)
{
    echo "File is valid, and was successfully uploaded.\n";
    unlink($uploadfile);
}

pg_close($conn);
?>