<html>
<head>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	
	// Store data from test.php
	var records;
	
	// Get data from test.php
	fetch('http://localhost/fyp_chart/test.php', {method: 'GET'})
	
		// If return data, response = data
		.then(function(response) {
			
			if(response.ok) {
				
				// Get json data from above response
				response.json().then(function(data) {
				
					// Store json data
					records = data;
					
				});
			}
		});
		
	
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {
		  
		  //console.log(records);
		  
		  // Create new variable to store data and match google api format(title then value)
		  var newRecords = [];
		  
		  // Push title
		  newRecords.push(['DateTime', 'Temperature(°C)', 'Humidity(%)', 'Light_intensity(lux/lx)', 'air_pressure']);
		  
		  
		  for(var i=0; i<records.length; i++) {
			//console.log(records[i]);
			console.log(Object.values(records[i]));
			
			// Convert json data to array     {'date', 122, 2121, 2121, 13} to ['date', 122, 2121, 2121, 13]
			newRecords.push(Object.values(records[i]));
			
		  }

		  
		var data = google.visualization.arrayToDataTable(newRecords);

	  //console.log(data);
		var options = {
          title: 'Room temperature, humidity, light_intensity and air_pressure',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>
<style>
table {
	border-collapse: collapse;
    width: 50%;
}
th, td {
    padding: 15px;
}
</style>

</head>
  <body>
	<h2>The IOT system sensor data </h2>
    <div id="curve_chart" style="width: 1000; height: 500px"></div>
	

  </body>
</html>


<?php 
	 include("database.php");
     $mysqli = ConnectDB();
	
	
	$result = $mysqli->query ("SELECT * FROM sensor_data");
	
	$records = array();
	
	
	echo "<br><b><u>Room temperature, humidity, light_intensity, air_pressure </b>";
	
	echo"<table width=500 height=200 border=1>";
	echo"<th>Datetime</th> <th>Temperature</th><th>Humidity</th> <th>Light_intensity</th> <th>Air_pressure</th>";
	
	while($row = $result->fetch_assoc()) 
	{
		//var_dump($row);
		//$records[]=$row["datetime"].','.$row["temperature"].','.$row["humidity"].','.$row["light_intensity"].','.$row["air_pressure"]; 
		
	
		 echo '<tr><td>'.$row["datetime"].'</td>' ;
		 echo '<td>'.$row["temperature"].'°C</td>';
		 echo '<td>'.$row["humidity"].'%</td>';
		 echo '<td>'.$row["light_intensity"]."lux</td>";
		 echo '<td>'.$row["air_pressure"].'</tr></td>' ;
		
		//echo "['".$row["datetime"]." ',".(double)$row["temperature"].",".$row["humidity"].",".$row["light_intensity"].",".$row["air_pressure"]."],";
			
		//echo json_encode($row);
		//$records[] = $row;
		 //var_dump (row["datetime"]);
		 
		
		
		$records[] = $row;
		 
	}
	echo'</table>';
	
	//var_dump($records);
	
	

?>

