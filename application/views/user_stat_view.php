<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title><?php echo $title;?></title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
<?php

foreach ($all_username as $value) {
	$post_username[] = $value->username;
}


foreach ($dotscount_images as $value) {
	$dotscount_post_image_name[] = $value->image_name;
}

foreach ($dotscount_gt as $value) {
	$dotscount_gt_post_image_name[] = $value->image_name;
}

foreach ($dist_images as $value) {
	$dist_post_image_name[] = $value->image_name;
}

foreach ($dist_gt_images as $value) {
	$dist_gt_post_image_name[] = $value->image_name;
}

$length = count($dist_images);
for ($x = 0; $x < $length; $x++) {
    $dist_user0_chart[$x] = $dist_images[$x]->distance;
    $dist_user1_chart[$x] = $dist_user1[$x]->distance;
    $dist_user2_chart[$x] = $dist_user2[$x]->distance;
} 

$dotscount_imagecount=0;
foreach ($dotscount_user0 as $value) {
	$dotscount_user0_imageid[]= $value->image_id;
	$dotscount_user0_count[]= $value->dots_count;
	$dotscount_imagecount = $dotscount_imagecount +'1';
}

foreach ($dotscount_user1 as $value) {
	$dotscount_user1_imageid[]= $value->image_id;
	$dotscount_user1_count[]= $value->dots_count;
}

foreach ($dotscount_user2 as $value) {
	$dotscount_user2_imageid[]= $value->image_id;
	$dotscount_user2_count[]= $value->dots_count;
}
for ($x = 0; $x < $dotscount_imagecount; $x++) {
    $diffCountUser1[$x] = abs($dotscount_user0_count[$x] - $dotscount_user1_count[$x]);
    $diffCountUser2[$x] = abs($dotscount_user0_count[$x] - $dotscount_user2_count[$x]);
    $dotscount_total_diff[$x] = $diffCountUser1[$x] + $diffCountUser2[$x] ;
} 

//sorting bubble sort
for ($i = 0; $i < $dotscount_imagecount-1; $i++) {
	// Last i elements are already in place   
   for ($j = 0; $j < $dotscount_imagecount-$i-1; $j++){
   		if ($dotscount_total_diff[$j] < $dotscount_total_diff[$j+1]){
   			$temp_dotscount_total_diff = $dotscount_total_diff[$j];
   			$dotscount_total_diff[$j]=$dotscount_total_diff[$j+1];
   			$dotscount_total_diff[$j+1]=$temp_dotscount_total_diff;

   			$temp_diffCountUser1=$diffCountUser1[$j];
   			$diffCountUser1[$j]=$diffCountUser1[$j+1];
   			$diffCountUser1[$j+1]=$temp_diffCountUser1;

   			$temp_diffCountUser2=$diffCountUser2[$j];
   			$diffCountUser2[$j]=$diffCountUser2[$j+1];
   			$diffCountUser2[$j+1]=$temp_diffCountUser2;

   			$temp_dotscount_image_name = $dotscount_post_image_name[$j];
   			$dotscount_post_image_name[$j]=$dotscount_post_image_name[$j+1];
   			$dotscount_post_image_name[$j+1]=$temp_dotscount_image_name;

   			$temp_dotscount_images = $dotscount_images[$j];
   			$dotscount_images[$j]=$dotscount_images[$j+1];
   			$dotscount_images[$j+1]=$temp_dotscount_images;
   		}   
   }       
}   

$length = count($dotscount_gt);
for ($x = 0; $x < $length; $x++) {
    $dotscount_gt_chart_vln[$x] = $dotscount_gt[$x]->dots_count_vln;
    $dotscount_gt_chart_adm[$x] = $dotscount_gt[$x]->dots_count_adm;
} 

$length = count($dist_gt);
for ($x = 0; $x < $length; $x++) {
    $dist_gt_chart[$x] = $dist_gt[$x]->distance;
} 

?>

</head>

<body>
	<script>
	  $( function() {
	    var availableTags = <?php echo '["' . implode('", "', $post_username) . '"]' ?>;
	    $( "#tags" ).autocomplete({
	      source: availableTags
	    });
	  } );

	window.onload = function() {
		var ctx = document.getElementById('canvas').getContext('2d');
		
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Chart.js Bar Chart'
				},
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
			}
		});
		
		var ctx_dots_count = document.getElementById('canvasDotsCount').getContext('2d');
		
		window.myBar = new Chart(ctx_dots_count, {
			type: 'bar',
			data: barChartDotsCount,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Chart.js Bar Chart'
				},
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
			}
		});

		var ctx_dots_count_gt = document.getElementById('canvasDotsCountGT').getContext('2d');
		
		window.myBar = new Chart(ctx_dots_count_gt, {
			type: 'bar',
			data: barChartDotsCountGT,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Chart.js Bar Chart'
				},
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
			}
		});

		var ctx_dist_gt = document.getElementById('canvasDistGT').getContext('2d');
		
		window.myBar = new Chart(ctx_dist_gt, {
			type: 'bar',
			data: barChartDistGT,
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Chart.js Bar Chart'
				},
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
		        }
			}
		});
	};

	document.getElementById('randomizeData').addEventListener('click', function() {
		var zero = Math.random() < 0.2 ? true : false;
		barChartData.datasets.forEach(function(dataset) {
			dataset.data = dataset.data.map(function() {
				return zero ? 0.0 : randomScalingFactor();
			});

		});
		window.myBar.update();
		
	});
</script>
	Current User: <?php echo $username; ?>
	<div class="ui-widget">
		<form method="post" action="" id="form_search_user">
			<label for="username">Username: </label>
			<input name="username">
			<button type="submit" form="form_search_user" value="Submit">Search</button>
		</form>
	</div>

	<br/>
	<br/>

<fieldset>
<legend>Distance Summary</legend>
<div id="container" style="width: 50%;">
		<canvas id="canvas"></canvas>
</div>
<button id="randomizeData">Randomize Data</button>
	
	<script>
	
		var randomScalingFactor = function() {
			// return Math.round(Math.random() * 100);
			return Math.random() * 100;
		};
		var DistLabel = <?php 
			echo '["';

			echo $dist_post_image_name[0];
			
			$length = count($dist_post_image_name);
			for ($i=1; $i < $length; $i++) { 
				echo '", "'.$dist_post_image_name[$i];
			}

			echo '"]'; ?>; //14532

		var color = Chart.helpers.color;
		var barChartData = {
			labels: DistLabel,
			datasets: [{
				type: 'line',
				label: 'Total Distance',
				backgroundColor:'rgba(122,122,122,0.2)',
				borderColor:'rgba(102,255,102,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($dist_user0_chart); ?>
			}, {
				label: 'Distance from Username2',
				backgroundColor:'rgba(0,0,255,0.2)',
				borderColor:'rgba(0,0,255,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($dist_user1_chart); ?>
			}, {
				label: 'Distance from Username3',
				backgroundColor:'rgba(255,0,255,0.2)',
				borderColor:'rgba(255,0,255,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($dist_user2_chart); ?>
			}]

		};		
	</script>
<br/>
View Markers:
<table border="1">
<tr>
	<?php 
		$length = count($dist_images);
		for ($i=0; $i < $length; $i++) { 
			$user1 = $dist_user1[$i]->username2;
			$user2 = $dist_user2[$i]->username2;
			echo '<td style="padding-left: 10px; padding-right: 10px"><a href="../../index.php/checkImage/view_check_image/'.$dist_images[$i]->image_id.'/'.$username.'
				'.'/'.$user1.''.'/'.$user2.'" target="blank">'.$dist_images[$i]->image_name.'</a></td>';
		}
	?>
	
</tr>
</table>
<br/>
Discard/Approve Work:
<br/>
<select>
	<?php 
		foreach ($dist_images as $image) {
			echo '<option value="'.$image->image_id.'"
				>'.$image->image_name.'</option></td>';
		}
	?>
</select> 
<button type="button">Discard</button> 
<button type="button">Approve</button> 
<br/>
<br/>
<button type="button">Discard All Current User Works</button> 
</fieldset>

<br/>
<br/>
<br/>
<br/>
<br/>
<fieldset>
<legend>Dots Count Difference Summary</legend>
<div id="container" style="width: 50%;">
		<canvas id="canvasDotsCount"></canvas>
</div>	
	<script>	
		var DotsCountLabel = <?php 
			echo '["';

			echo $dotscount_post_image_name[0];
			
			$length = count($dotscount_post_image_name);
			for ($i=1; $i < $length; $i++) { 
				echo '", "'.$dotscount_post_image_name[$i];
			}

			echo '"]'; ?>;


		//image_name
		var color = Chart.helpers.color;
		var barChartDotsCount = {
			labels: DotsCountLabel,
			datasets: [{
				type: 'line',
				label: 'Total Count Differences',
				backgroundColor:'rgba(122,122,122,0.2)',
				borderColor:'rgba(102,255,102,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($dotscount_total_diff); ?>
			}, {
				label: 'Count Difference from Other User 1',
				backgroundColor:'rgba(0,0,255,0.2)',
				borderColor:'rgba(0,0,255,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($diffCountUser1); ?>
			}, {
				label: 'Count Difference from Other User 2',
				backgroundColor:'rgba(255,0,255,0.2)',
				borderColor:'rgba(255,0,255,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($diffCountUser2); ?>
			}]

		};
	</script>
<br/>
View Markers:
<table border="1">
<tr>
	<?php 
		$length = count($dotscount_images);
		for ($i=0; $i < $length; $i++) { 
			$user1 = $dotscount_user1[$i]->username;
			$user2 = $dotscount_user2[$i]->username;
			echo '<td style="padding-left: 10px; padding-right: 10px"><a href="../../index.php/checkImage/view_check_image/'.$dotscount_images[$i]->image_id.'/'.$username.'
				'.'/'.$user1.''.'/'.$user2.'" target="blank">'.$dotscount_images[$i]->image_name.'</a></td>';
		}
	?>
	
</tr>
</table>
<br/>
Discard/Approve Work:
<br/>
<select>
	<?php 
		foreach ($dotscount_images as $image) {
			echo '<option value="'.$image->image_id.'"
				>'.$image->image_name.'</option></td>';
		}
	?>
</select> 
<button type="button">Discard</button> 
<button type="button">Approve</button> 
<br/>
<br/>
<button type="button">Discard All Current User Works</button> 
</fieldset>
<br/>
<br/>
<br/>
<br/>
<br/>
<fieldset>
<legend>Distance to Ground Truth Summary</legend>
<div id="container" style="width: 50%;">
		<canvas id="canvasDistGT"></canvas>
</div>	
	<script>	
		var DistGTLabel = <?php 
			echo '["';

			echo $dist_gt_post_image_name[0];
			
			$length = count($dist_gt_post_image_name);
			for ($i=1; $i < $length; $i++) { 
				echo '", "'.$dist_gt_post_image_name[$i];
			}

			echo '"]'; ?>;


		//image_name
		var color = Chart.helpers.color;
		var barChartDistGT = {
			labels: DistGTLabel,
			datasets: [{
				label: 'Distance to Ground Truth',
				backgroundColor:[
					'rgba(0,0,255,0.2)',
					'rgba(255,0,0,0.2)'
					],
				borderColor:[
					'rgba(0,0,255,0.2)',
					'rgba(255,0,0,0.2)'
					],
				borderWidth: 1,
				data: <?php echo json_encode($dist_gt_chart); ?>
			}]

		};
	</script>
<br/>
View Markers:
<table border="1">
<tr>
	<?php 
		$length = count($dist_gt);
		for ($i=0; $i < $length; $i++) { 
			$user1 = $dist_gt[$i]->username2;
			echo '<td style="padding-left: 10px; padding-right: 10px"><a href="../../index.php/checkImage/view_check_image/'.$dist_gt[$i]->image_id.'/'.$username.'
				'.'/'.$user1.'" target="blank">'.$dist_gt[$i]->image_name.'</a></td>';
		}
	?>
	
</tr>
</table>
<br/>
<button type="button">Discard All Current User Works</button> 
</fieldset>
<br/>
<br/>
<br/>
<br/>
<br/>
<fieldset>
<legend>Dots Count Difference to Ground Truth Summary</legend>
<div id="container" style="width: 50%;">
		<canvas id="canvasDotsCountGT"></canvas>
</div>	
	<script>	
		var DotsCountLabel = <?php 
			echo '["';

			echo $dotscount_gt_post_image_name[0];
			
			$length = count($dotscount_gt_post_image_name);
			for ($i=1; $i < $length; $i++) { 
				echo '", "'.$dotscount_gt_post_image_name[$i];
			}

			echo '"]'; ?>;


		//image_name
		var color = Chart.helpers.color;
		var barChartDotsCountGT = {
			labels: DotsCountLabel,
			datasets: [{
				label: 'Ground Truth Dots Count',
				backgroundColor:'rgba(0,0,255,0.2)',
				borderColor:'rgba(0,0,255,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($dotscount_gt_chart_adm); ?>
			}, {
				label: 'User Dots Count',
				backgroundColor:'rgba(255,0,0,0.2)',
				borderColor:'rgba(255,0,0,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($dotscount_gt_chart_vln); ?>
			}]

		};
	</script>
<br/>
View Markers:
<table border="1">
<tr>
	<?php 
		$length = count($dotscount_gt);
		for ($i=0; $i < $length; $i++) { 
			$user1 = $dotscount_gt[$i]->username_admin;
			echo '<td style="padding-left: 10px; padding-right: 10px"><a href="../../index.php/checkImage/view_check_image/'.$dotscount_gt[$i]->image_id.'/'.$username.'
				'.'/'.$user1.'" target="blank">'.$dotscount_gt[$i]->image_name.'</a></td>';
		}
	?>
	
</tr>
</table>
<br/>
<button type="button">Discard All Current User Works</button> 
</fieldset>
</body>


</html>