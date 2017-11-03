<?
if(isset($_POST['from'],$_POST['to'],$_POST['value']))
{
	if(floatval($_POST['value'])<=0)
		die(json_encode(array("status"=>"error","description"=>"Error 'value': '".$_POST['value']."' value must be positive!")));
	$valute=json_decode(file_get_contents("https://www.cbr-xml-daily.ru/daily_json.js"),true)["Valute"];
	$from=0;
	if(!strcasecmp("RUB",$_POST['from']))
		$from=1;
	else
	    foreach ($valute as $value)
	        if(!strcasecmp($value["CharCode"],$_POST['from']))
	        {
	            $from=$value["Value"]/$value["Nominal"];
	            break;
	        }
	if(!$from)
		die(json_encode(array("status"=>"error","description"=>"Error 'from': '".$_POST['from']."' not found!")));
	$to=0;
	if(!strcasecmp("RUB",$_POST['to']))
		$to=1;
	else
        foreach ($valute as $value)
	        if(!strcasecmp($value["CharCode"],$_POST['to']))
	        {
	            $to=$value["Value"]/$value["Nominal"];
	            break;
	        }
    if(!$to)
		die(json_encode(array("status"=>"error","description"=>"Error 'to': '".$_POST['to']."' not found!")));
    if(!strcasecmp($_POST['from'],$_POST['to']))
		die(json_encode(array("status"=>"success","value"=>$_POST['value'])));
	die(json_encode(array("status"=>"success","value"=>($_POST['value']*$from)/$to)));
}
?>