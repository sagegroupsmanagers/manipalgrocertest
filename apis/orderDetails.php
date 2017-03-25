<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	
	$Order_id = $_GET['order_id'];
	$query_order_id = mysqli_query($link,"SELECT CONCAT(ocr.`firstname`, ' ', ocr.`lastname`) AS cust_name,ocr.`payment_method`,ocr.`date_added`, op.`image`, orp.`name`, orp.`quantity`, orp.`price`, ocr.`total`FROM `oc_order_product` AS orp, `oc_order` AS ocr, `oc_product` AS op WHERE orp.`order_id` ='$Order_id' AND orp.`order_id` = ocr.`order_id` AND orp.`product_id` = op.`product_id`");
	
	$result = array();
	$json = array("status" => 1, "info" => $result);
	
	while($row1 = mysqli_fetch_row($query_order_id))
	{
		extract($row1);
	$row1[3]= str_replace(" ","%20");
		$result[] = array("cust_name"=>$row1[0],"payment_method"=>$row1[1],"date_added"=>$row1[2],"image"=>"http://www.manipalgrocer.in/image/".$row1[3],"name"=>$row1[4],"quantity"=>$row1[5],"price"=>$row1[6],"total"=>$row1[7]);
        $json = array("status" => 1, "info" => $result);
	}
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>