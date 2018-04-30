<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title>Sync Distance</title>

</head>

<body>
<?php
$this->load->model('main_model');
foreach ($data as $value) {
	$coordinate_id[] = $value->coordinate_id;
	$image_id[] = $value->image_id;
	$x[] = $value->x;
	$y[] = $value->y;
	$userin[] = $value->userin;
}
$unique_userin= array_merge(array_unique($userin));

for($k=0;$k<sizeof($userin);$k++){
 	 for($j=0;$j<sizeof($unique_userin);$j++){
     	if(strcmp($userin[$k],$unique_userin[$j])==0){
 			$dataset_coordinate_id[$j][] = $coordinate_id[$k];
			$dataset_image_id[$j][] = $image_id[$k];
			$dataset_x[$j][] = $x[$k];
			$dataset_y[$j][] = $y[$k];
			$dataset_userin[$j][] = $userin[$k];
  		}
     }
 }


for($x=0;$x<sizeof($unique_userin)-1;$x++){
	for($y=$x+1;$y<sizeof($unique_userin);$y++){
		for($k=0;$k<sizeof($dataset_coordinate_id[$x]);$k++){
			$min=99999999999999999;
			
			for($l=0;$l<sizeof($dataset_coordinate_id[$y]);$l++){

				if($dataset_image_id[$x][$k]==$dataset_image_id[$y][$l]){
					$value = sqrt(pow(($dataset_x[$x][$k]-$dataset_x[$y][$l]),2) + pow(($dataset_y[$x][$k]-$dataset_y[$y][$l]),2));
					
					if($value<$min){
						$min = $value;
						$coor_id1=$dataset_coordinate_id[$x][$k];
						$coor_id2=$dataset_coordinate_id[$y][$l];
					}
				}
			}
			if($min!=99999999999999999)

				$this->main_model->insert_user_dots_distance($dataset_userin[$x][0],$dataset_userin[$y][0],$dataset_image_id[$x][$k],$coor_id1,$coor_id2,$min);
		}
	}
}




?>
Success Sync!
	
</body>


</html>