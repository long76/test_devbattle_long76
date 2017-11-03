<?
if(sizeof($_GET))
{
	$valute=json_decode(file_get_contents("https://www.cbr-xml-daily.ru/daily_json.js"),true)["Valute"];
    $json[]=array("name"=>"RUB","title"=>"Российский рубль");
	foreach ($valute as $value)
	    $json[]=array("name"=>$value["CharCode"],"title"=>$value["Name"]);
	echo json_encode($json); 
}
?>