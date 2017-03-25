<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	
	$telephoneNO = $_GET['telephone'];
	$query_order_id = mysqli_query($link,"SELECT `order_id`,`date_added`,`order_status_id` FROM `oc_order` WHERE `telephone`='$telephoneNO'");
	
	$result = array();
	$json = array("status" => 1, "info" => $result);
	
	while($row1 = mysqli_fetch_row($query_order_id))
	{
		extract($row1);
		$result[] = array("order_id"=>$row1[0],"date"=>$row1[1],"status"=>$row1[2]);
        $json = array("status" => 1, "info" => $result);
	}
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json,JSON_PRETTY_PRINT);
?>