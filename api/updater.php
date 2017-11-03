<?
$time=time()-86400;
$current_date_link=date("Y/m/d",$time);
$current_date=date("d.m.Y",$time);
$mysqli = new mysqli('localhost', 'root', 'password', 'currency');
if(!$mysqli->connect_error)
{
    if($result = $mysqli->query("SELECT name,value,nominal FROM `data` WHERE `date`='$current_date'"))
	    if(!$result->num_rows)
	    {
		    $valute=json_decode(file_get_contents("https://www.cbr-xml-daily.ru/archive/$current_date_link/daily_json.js"),true)["Valute"];
		    foreach ($valute as $value)
				$mysqli->query("INSERT INTO `data` (`name`,`nominal`,`value`,`date`) VALUES('".$value["CharCode"]."',".$value["Nominal"].",".$value["Value"].",'$current_date')");
	    }
	$result->close();
	$mysqli->close();
}
?>