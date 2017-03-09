<?php

include("database.php");
     $mysqli = ConnectDB();
	
	
	$result = $mysqli->query ("SELECT * FROM sensor_data");
	
	$records = [];
	
	while($row = $result->fetch_assoc()) 
	{
		//var_dump($row);
		 
		/*	
		 echo '<tr><td>'.$row["datetime"].'</td>' ;
		 echo '<td>'.$row["temperature"].'°C</td>';
		 echo '<td>'.$row["humidity"].'%</td>';
		 echo '<td>'.$row["light_intensity"]."lux</td>";
		 echo '<td>'.$row["air_pressure"].'</tr></td>' ;
		*/
		//echo "[".$row["datetime"]." ',".$row["temperature"].",".$row["humidity"].",".$row["light_intensity"].",".$row["air_pressure"]."],";
			
		//echo json_encode($row);
		
		$row["temperature"] = (int) $row["temperature"];
		$row["humidity"] = (int) $row["humidity"];
		$row["light_intensity"] = (int) $row["light_intensity"];
		$row["air_pressure"] = (int) $row["air_pressure"];
		
		$records[] = $row;
		 //var_dump (row["datetime"]);
		 
	}
	//var_dump($records);
	
	echo json_encode($records);
?>