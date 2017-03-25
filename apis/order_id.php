<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
	die('Not connected : ' . mysql_error());
	}
	
	$qry_get_order_id = mysqli_query($link,"SELECT `order_id` FROM `oc_order` WHERE 1 ORDER BY `order_id` DESC LIMIT 1")  or die("Invalid query: "  .mysql_error());
		while($r = mysqli_fetch_array($qry_get_order_id))
		{
			extract($r);
			$result[] = array("order_id" => $order_id);
			$json = array("status" => 1, "info" => $result);
		}
		@mysqli_close($link);
 /* Output header */
header('Content-type: application/json');
 echo json_encode($json,JSON_PRETTY_PRINT);
	
 
?>