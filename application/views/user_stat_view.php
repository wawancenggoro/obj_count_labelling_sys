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

$id_loadUsername=0;
//var_dump($all_username);die();
foreach ($all_username as $value) {
	$post_username[$id_loadUsername] = $value->username;
	$id_loadUsername = $id_loadUsername +'1';
}

$id_loadImage=0;
foreach ($image_name as $value) {
	$post_image_name[$id_loadImage] = $value->image_name;
	$id_loadImage = $id_loadImage +'1';
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
			return Math.round(Math.random() * 100);
		};
		//var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var MONTHS = <?php echo '["' . implode('", "', $post_image_name) . '"]' ?>;
		var color = Chart.helpers.color;
		var barChartData = {
			labels: MONTHS,
			datasets: [{
				type: 'line',
				label: 'Dataset 1',
				backgroundColor:'rgba(122,122,122,0.2)',
				borderColor:'rgba(102,255,102,0.2)',
				borderWidth: 1,
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}, {
				label: 'Dataset 2',
				backgroundColor:'rgba(255,0,0,0.2)',
				borderColor:'rgba(255,0,0,0.2)',
				borderWidth: 1,
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}, {
				label: 'Dataset 3',
				backgroundColor:'rgba(51,153,255,0.2)',
				borderColor:'rgba(51,153,255,0.2)',
				borderWidth: 1,
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}]

		};

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
</fieldset>

<br/>
<br/>
<br/>
<br/>
<br/>
<fieldset>
<legend># of Points Summary</legend>
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