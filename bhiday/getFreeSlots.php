<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

getFreeTime(array(1,2), "2011-05-09 00:00:00", "2011-05-10 00:00:00");


function getFreeTime($friends, $dateStart, $dateEnd)
{
	date_default_timezone_set("America/Los_Angeles");
	
	if ($dateEnd == 0) $dateEnd = $dateStart;
	
	$bitmap = array();
	
	$di = new DateInterval('P1D');
	
	$format = "Y-m-d H:i:s";
	$start_date = date_create_from_format($format, $dateStart);
 	$end_date = date_create_from_format($format, $dateEnd);
 	
 	$start_date = dateFloor($start_date);
 	$end_date = dateFloor($end_date);
 
 	$i = 0;
 	
 	while ($start_date->getTimestamp() <= $end_date->getTimestamp())
 	{
 		//echo "******   ". $i. " : " . $start_date->format($format) ."  ********\n"; 
 		$bitmap[$i] = array_pad(array(), 48, 0); //all free!
 		getFreeTimeForOneDay($friends, $start_date->format($format), $bitmap[$i]);
 		$start_date->add($di);
 		$i++;
 	}
}

function getFreeTimeForOneDay ($friends, $dateStart, &$bitmap)
{
	$db_host = "localhost";
	$db_port = "3306";
	$db_user = "hack";
	$db_pass = "hack0r";
	$db_name = "hack";

	$handle = mysql_connect($db_host.":".$db_port, $db_user, $db_pass);
	if (!$handle) {
	    die('Could not connect: ' . mysql_error());
	}

	if (!mysql_select_db($db_name,$handle)) {
			die('Could not connect: ' . mysql_error());
	}

	//code begins
	
	//$bitmap = array_pad(array(), 48, 0); //all free!
	
	foreach ($friends as $friend)
	{
		$query = "SELECT * FROM fb_caltable WHERE uid = '$friend'";
		//echo $query;
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) 
		{
			//got all rows
			$format = "Y-m-d H:i:s";
 		   	$start_ts = date_create_from_format($format, $row["start_ts"]);
 		   	$end_ts = date_create_from_format($format, $row["end_ts"]);
 		   	$end_recur = date_create_from_format($format, $row["end_recur"]);
 		   	
 		   	$start_ts_int = $start_ts->getTimestamp();
 		   	$end_ts_int = $start_ts->getTimestamp(); 		   	
 		   	$end_recur_int = $end_recur->getTimestamp();
 		   
 		   	//calculate param timestamp also!
 		   	$date_start_param = date_create_from_format($format, $dateStart);
 		   	$date_start_param_int = $date_start_param->getTimestamp(); 		   	
 		   	
 		   	if ($row["recur"] == 'W')
 		   	{
 		   		//this is a recurring event
 		   		//echo getDayFromTS($date_start_param_int);
 		   		//check if given date is between start and end
 		   		//if (($date_start_param_int < $start_ts_int) || 
 		   		//	($date_start_param_int > $end_recur_int))
 		   		//	continue;
 		   		
 		   		if (dateFloor($start_ts)->getTimestamp() > $date_start_param_int 
 		   			||	dateCeil($end_recur)->getTimestamp() < $date_start_param_int)
 		   				continue;
 		   			
 		   		if (strstr($row["days"], getDayFromTS($date_start_param_int)) == FALSE) continue;
 		   		
 		   		//update bitmap
 		   		$hour_start = intval($start_ts->format("H"));
 		   		$min_start = intval($start_ts->format("i"));
 		   		$hour_end = intval($end_ts->format("H"));
 		   		$min_end = intval($end_ts->format("i"));
 		   		
 		   		  		print $hour_start. " " . $min_start . " " . $hour_end . " " . $min_end;
 		   		
 		   		for ($i = 0; $i < 48; $i++)
 		   		{
 		   			$min = ($i % 2) * 30;
 		   			$hour = intval($i / 2);
 		   			//print ($hour == $hour_end && $min <= $min_end)?strval($i)."true":strval($i)."false";
 		   			
 		   			if (($hour > $hour_start && $hour < $hour_end)
 		   				|| ($hour == $hour_start && $min >= $min_start)
 		   				|| ($hour == $hour_end && $min <= $min_end))
 		   			{
 		   				$bitmap[$i] = 1;
 		   			}
 		   			
 		   		}
 		   	
 		   	}
 		   	else 
 		   	{
 		   		//this is a one time event
 		   		//$start_ts_date = getdate($start_ts);
 		   		$start_ts_date = $start_ts->format("Y-m-d");
 		   		if ($start_ts_date != substr($dateStart, 0, 10)) continue;
 		   		
 		   		//update bitmap
 		   		$hour_start = intval($start_ts->format("H"));
 		   		$min_start = intval($start_ts->format("i"));
 		   		$hour_end = intval($end_ts->format("H"));
 		   		$min_end = intval($end_ts->format("i"));
 		   		
 		 
 		   		
 		   		for ($i = 0; $i < 48; $i++)
 		   		{
 		   			$min = ($i % 2) * 30;
 		   			$hour = $i / 2;
 		   			if (($hour > $hour_start && $hour < $hour_end)
 		   				|| ($hour == $hour_start && $min >= $min_start)
 		   				|| ($hour == $hour_end && $min <= $min_end))
 		   			{
 		   				$bitmap[$i] = 1;
 		   			}
 		   			
 		   		}
 		   		
 		   	}
 		   	
		}
		
		
	}

	print_r($bitmap);
	

	mysql_close($handle);

	return $bitmap;
}

function getDayFromTS($timestamp)
{
	$day_start = getdate($timestamp);
 	return strtoupper(substr($day_start["weekday"], 0, 2));
}

function dateFloor($date)
{
	//of type DateTime
	$format = "Y-m-d H:i:s";
	$toFloorDate = new DateTime($date->format($format));
	$toFloorDate->setTime(0,0,0);
	return $toFloorDate;
}

function dateCeil($date)
{
	//of type DateTime
	$toCielDate = dateFloor($date);
	$di = new DateInterval('P1D');
	$toCielDate->add($di);
	return $toCielDate;
}
?>
