<?
if(isset($_GET['valute']))
{
	$current_date=date("d.m.Y");
	$json=array();
    $mysqli = new mysqli('localhost', 'root', 'password', 'currency');
    if(!$mysqli->connect_error)
    {
	    if($result = $mysqli->query("SELECT nominal,value,date FROM `data` WHERE `name`='".$_GET['valute']."'"))
	    {
	        if($result->num_rows==0)
	            die(json_encode(array("status"=>"error","description"=>"Valute not found!")));
		    else
			    while($row = $result->fetch_row())
		            $json[]=array('nominal'=>$row[0],'value'=>$row[1],'date'=>$row[2]);
	    }
	    $result->close();
        echo json_encode($json);
        $mysqli->close();
	}
}
?>