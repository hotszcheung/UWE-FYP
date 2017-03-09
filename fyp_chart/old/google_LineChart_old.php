<html>
<head>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
		//mysql 5 datas var define 
		//var datetime, temperature, humidity, light_intensity, air_pressure ;
		//var temperature = document.getElementById("temperature").value;
		
      function drawChart() {
		var data = google.visualization.arrayToDataTable([
          ['DateTime', 'Temperature', 'Humidity', 'light_intensity', 'air_pressure'],
		  <?php 
			/*$query = "SELECT * FROM sensor_data";

			$exec = mysqli_query($con,$query);
			if($row = mysqli_fetch_array($exec)){

			echo "['".$row['datetime']."',  ".$row['temperature'].",  ".$row['humidity'].",  ".$row['light_intensity'].",  ".$row['air_pressure']."]";
			}*/
			//echo json_encode($row);
		   ?>

		  ['2017-02-28 16:41:02',  10, 49, 10,15],	
		  ['2017-02-28 16:42:02',  12, 52, 20,30],
          ['2017-02-28 16:43:01',  14, 55, 30,45]
		  //['Year', 'Sales', 'Expenses'],
		  //['2004',  1000,      400],
          //['2005',  1170,      460],
          //['2006',  660,       1120],
          //['2007',  1030,      540]

      ]);

		var options = {
          title: 'Real time sensor data LineChart',
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
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
	

  </body>
</html>


<?php 
	 include("database.php");
     $mysqli = ConnectDB();
	
	
	$result = $mysqli->query ("SELECT * FROM sensor_data");
	//$records = array();
	
	echo "<br><b><u>The Real time sensor data Table </b>";
	
	echo"<table width=500 height=200 border=1>";
	echo"<th>Datetime</th> <th>Temperature</th><th>Humidity</th> <th>Light_intensity</th> <th>Air_pressure</th>";
	
	while($row = $result->fetch_assoc()) 
	{
		$records[]=$row["datetime"].','.$row["temperature"].','.$row["humidity"].','.$row["light_intensity"].','.$row["air_pressure"]; 
			
		 echo '<tr><td>'.$row["datetime"].'</td>' ;
		 echo '<td>'.$row["temperature"].'°C</td>';
		 echo '<td>'.$row["humidity"].'%</td>';
		 echo '<td>'.$row["light_intensity"]."lux</td>";
		 echo '<td>'.$row["air_pressure"].'</tr></td>' ;
		
		 //echo "['".$row['datetime']."',  ".$row['temperature'].",  ".$row['humidity'].",  ".$row['light_intensity'].",  ".$row['air_pressure']."],";
			
		echo json_encode($row);
	
	
	}
	echo'</table>';
	
	

	//echo json_encode($records);
?>
