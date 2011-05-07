<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//insert in database table!
//opening mysql connection
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

require_once("iCalcreator.class.php");

$config = array( 	"unique_id" => "ucla.edu",
					"filename" => "103873013.ics" );

$calObj = new vcalendar($config);
$calObj->parse();

while (($component = $calObj->getComponent()) != FALSE)
{
	if ($component instanceof vevent)
	{
		$start_ts = array2datetime($component->getProperty("DTSTART"));  
		$end_ts = array2datetime($component->getProperty("DTEND")); 
		$rrule = ($component->getProperty("RRULE"));
		//print_r ($rrule); echo "<br><br>";
		//handle rrule
		if ($rrule["FREQ"] != "WEEKLY") throw new Exception("Only WEEKLY recurrence has been implemented.");
		if (!isset($rrule["UNTIL"])) throw new Exception("Could not find UNTIL clause in RRULE");
		$end_recur = array2datetime($rrule["UNTIL"]);
		if ($rrule["INTERVAL"] != 1) throw new Exception("Only 1 week recurrence is implemented.");
		if (!isset($rrule["BYDAY"])) throw new Exception("Could not find BYDAY clause in RRULE");
		$days = "";
		
		if (sizeof($rrule["BYDAY"]) == 1)
		{
			$days = $rrule["BYDAY"]["DAY"];
		}
		else
		{
			foreach ($rrule["BYDAY"] as $day)
			{
				if(!isset($day["DAY"])) throw new Exception("Invalid tag 	inside BYDAY.");
				$days = $days . $day["DAY"];
			}
		}
		
		$description = $component->getProperty("DESCRIPTION");
		$summary = $component->getProperty("SUMMARY");
		$location = $component->getProperty("LOCATION");
		
		$query = "INSERT INTO fb_caltable (start_ts, end_ts, recur, end_recur, days, summary, description, location) VALUES ('$start_ts', '$end_ts', 'W', '$end_recur', '$days', '$summary', '$description', '$location')";

		echo $query. '<br><br>';

		$result = mysql_query($query);
		if (!$result) 
		{
    		die('Invalid query: ' . mysql_error());
		}
	}
}

mysql_close($handle);

function array2datetime($arg)
{
	return	 	$arg["year"] 	. "-" .
				$arg["month"]	. "-" .
				$arg["day"]		. " " .
				$arg["hour"]	. ":" .
				$arg["min"]		. ":" .
				$arg["sec"];
	
}

?>