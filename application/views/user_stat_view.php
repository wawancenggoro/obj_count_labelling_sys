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


foreach ($image_name as $value) {
	$post_image_name[] = $value->image_name;
}
//var_dump($post_image_name);die();
$total_real=0;
foreach ($data_real as $value) {
	$data_real_imageid[]= $value->image_id;
	$data_real_dotscount[]= $value->dots_count;
	$total_real = $total_real +'1';
}

foreach ($data_user_1 as $value) {
	$data_user_1_imageid[]= $value->image_id;
	$data_user_1_dotscount[]= $value->dots_count;
}

foreach ($data_user_2 as $value) {
	$data_user_2_imageid[]= $value->image_id;
	$data_user_2_dotscount[]= $value->dots_count;
}
$total_data=0;
for ($x = 0; $x < $total_real; $x++) {
    $diffUser1[$x] = abs($data_real_dotscount[$x] - $data_user_1_dotscount[$x]);
    $diffUser2[$x] = abs($data_real_dotscount[$x] - $data_user_2_dotscount[$x]);
    $total_diff[$x] = $diffUser1[$x] + $diffUser2[$x] ;
    $total_data= $total_data +1;
} 

//sorting bubble sort
   for ($i = 0; $i < $total_data-1; $i++) {
 	// Last i elements are already in place   
       for ($j = 0; $j < $total_data-$i-1; $j++){
       		if ($total_diff[$j] < $total_diff[$j+1]){
       			$temp_total_diff = $total_diff[$j];
       			$total_diff[$j]=$total_diff[$j+1];
       			$total_diff[$j+1]=$temp_total_diff;

       			$temp_diffUser1=$diffUser1[$j];
       			$diffUser1[$j]=$diffUser1[$j+1];
       			$diffUser1[$j+1]=$temp_diffUser1;

       			$temp_diffUser2=$diffUser2[$j];
       			$diffUser2[$j]=$diffUser2[$j+1];
       			$diffUser2[$j+1]=$temp_diffUser2;

       			$temp_image_name = $post_image_name[$j];
       			$post_image_name[$j]=$post_image_name[$j+1];
       			$post_image_name[$j+1]=$temp_image_name;
       		}
              
       } 
           
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

	<div class="ui-widget">
	  <label for="tags">Username: </label>
	  <input id="tags">
	</div>

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
		var MONTHS = <?php echo '["' . implode('", "', $post_image_name) . '"]' ?>;
		var color = Chart.helpers.color;
		var barChartData = {
			labels: MONTHS,
			datasets: [{
				type: 'line',
				label: 'Total Distance',
				backgroundColor:'rgba(122,122,122,0.2)',
				borderColor:'rgba(102,255,102,0.2)',
				borderWidth: 1,
				data: [
					Math.exp(2.00)*10,
					Math.exp(1.75)*10,
					Math.exp(1.50)*10,
					Math.exp(1.25)*10,
					Math.exp(1.00)*10
				]
			}, {
				label: 'Distance from Username2',
				backgroundColor:'rgba(255,0,0,0.2)',
				borderColor:'rgba(255,0,0,0.2)',
				borderWidth: 1,
				data: [
					Math.exp(2.00)*4,
					Math.exp(1.75)*6,
					Math.exp(1.50)*4,
					Math.exp(1.25)*6,
					Math.exp(1.00)*5
				]
			}, {
				label: 'Distance from Username3',
				backgroundColor:'rgba(51,153,255,0.2)',
				borderColor:'rgba(51,153,255,0.2)',
				borderWidth: 1,
				data: [
					Math.exp(2.00)*6,
					Math.exp(1.75)*4,
					Math.exp(1.50)*6,
					Math.exp(1.25)*4,
					Math.exp(1.00)*5
				]
			}]

		};		
	</script>
</fieldset>

<br/>
<br/>
<br/>
<br/>
<br/>
<fieldset>
<legend># of Points Summary</legend>
<div id="container" style="width: 50%;">
		<canvas id="canvasDotsCount"></canvas>
</div>	
	<?php
		//var_dump($total_diff);die();
	?>
	<script>	
		//var DotsCountLabel = ['Image 1', 'Image 2', 'Image 3', 'Image 4', 'Image 5'];
		var DotsCountLabel = <?php echo '["' . implode('", "', $post_image_name) . '"]' ?>;

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
				data: <?php echo json_encode($total_diff); ?>
				}, {
				label: 'Count Difference from Username2',
				backgroundColor:'rgba(255,0,0,0.2)',
				borderColor:'rgba(255,0,0,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($diffUser1); ?>
			}, {
				label: 'Count Difference from Username3',
				backgroundColor:'rgba(51,153,255,0.2)',
				borderColor:'rgba(51,153,255,0.2)',
				borderWidth: 1,
				data: <?php echo json_encode($diffUser2); ?>
			}]

		};
	</script>
</fieldset>
<br/>
<br/>
<br/>
<br/>
<br/>
<fieldset>
<legend>Accuracy to Ground Truth Summary</legend>
Lorem Ipsum
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
</fieldset>

</body>


</html>