<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	
	$name = $_POST['Query'];
	
	$query= mysqli_query($link,"SELECT name FROM oc_product_description WHERE name LIKE '%".$name."%'");
	
	$result = array();
	$name = str_replace("&amp;","and",$name);
	$json = array("status" => 1, "info" => $result);
	
	while($row = mysqli_fetch_array($query))
	{
		extract($row);
		$result[] = $row;
        //$json = array("status" => 1, "info" => $result);
	}
	print(json_encode($result))
	/*@mysqli_close($link);*/
	/* Output header */
	/*header('Content-type: application/json');
	echo json_encode($json);*/
?>