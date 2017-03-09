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
		var data = new google.visualization.DataTable(<?php $jsonTable?>);
		var options = {			
          title: 'Real time sensor data LineChart',
          is3D: 'false';
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
    <div id="curve_chart" style="width: 900px; height: 500px "></div>
	
	
  </body>
</html>


<?php 
$server = "127.0.0.1"; 
$userName= "root"; 
$password= 287730849;
$db ="test1";

$mysqli = new mysqli($server, $userName, $password, $db);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

	 $result = $mysqli->query('SELECT * FROM sensor_data');
	/*
								
	$rows = array();
	$table = array();
	$table['cols'] = array(
	
	array('id'=>'', 'label' => 'Datetime', 'type' => 'datetime'),
    array('id'=>'', 'label' => 'temperature', 'type' => 'number'),
	array('id'=>'', 'label' => 'humidity', 'type' => 'number'),
    array('id'=>'', 'label' => 'ligth_intensity', 'type' => 'number'),
	array('id'=>'', 'label' => 'air_pressure', 'type' => 'number')
	);
	 // Extract the information from $result 
	  foreach($result as $r) {

      $temp = array();

      // The following line will be used to slice the Pie chart

      $temp[] = array('v' => (string) $r['datetime']); 

      // Values of the each slice

      $temp[] = array('v' => (double) $r['temperature']); 
	  $temp[] = array('v' => (double) $r['humidity']); 
	  $temp[] = array('v' => (double) $r['light_intensity']); 
	  $temp[] = array('v' => (double) $r['air_pressure']); 
	  
	  
      $rows[] = array('c' => $temp);
    }
	
$table['rows'] = $rows;

// convert data into JSON format
$jsonTable = json_encode($table, true);

echo $jsonTable;
*/
while($row = $result->fetch_assoc()) 
	{
		//var_dump($row);
		//$records[]=$row["datetime"].','.$row["temperature"].','.$row["humidity"].','.$row["light_intensity"].','.$row["air_pressure"]; 
		
	
		 //echo '<tr><td>'.$row["datetime"].'</td>' ;
		 //echo '<td>'.$row["temperature"].'°C</td>';
		 //echo '<td>'.$row["humidity"].'%</td>';
		 //echo '<td>'.$row["light_intensity"]."lux</td>";
		 //echo '<td>'.$row["air_pressure"].'</tr></td>' ;
		
		//echo "['".$row["datetime"]." ',".(double)$row["temperature"].",".$row["humidity"].",".$row["light_intensity"].",".$row["air_pressure"]."],";
			
		//echo json_encode($row);
		//$records[] = $row;
		 //var_dump (row["datetime"]);
		
		$records = array();
		
		$records = (int)$row;
		var_dump($records);
		//$jsonTable = json_encode($records); 
		
		//$jsonTable.O
		//var_dump($jsonTable);
		
	}
	echo'</table>';
	
?>