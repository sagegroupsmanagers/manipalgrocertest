<?php
  $link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysqli_error());
	}
 if($_SERVER['REQUEST_METHOD']=='GET'){
	
	$telephone = $_GET['telephone'];
 
	$query1 = "SELECT customer_id from oc_customer where `telephone` = '$telephone'";
	$result1 = mysqli_query($link,$query1);
	if (!$result1) {
    echo 'Could not run query: ';
    exit;
	}
	$row1 = mysqli_fetch_row($result1);
	$cus_ID = $row1[0];
	
	$query2 = "SELECT address_1,address_2 from oc_address where `customer_id` = '$cus_ID'";
	$result2 = mysqli_query($link,$query2);
	if (!$result2) {
    echo 'Could not run query: ';
    exit;
	}
	$row2 = mysqli_fetch_row($result2);
	$address_1 = $row2[0];
	$address_2 = $row2[1];
	
 $sql_query=mysqli_query($link,"select firstname,lastname,email,telephone from oc_customer where telephone = '$telephone'")  or die("Invalid query: "  .mysql_error());
 
 $result =array();
 $json = array("status" => 1, "info" => $result);
 while($r = mysqli_fetch_array($sql_query))
	{
		extract($r);
		$result[] = array("firstname" => $firstname,"lastname" => $lastname,"email" => $email,"telephone" => $telephone,"address_1" => $address_1,"address_2" =>$address_2);
        $json = array("status" => 1, "info" => $result);
	}
 }
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json,JSON_PRETTY_PRINT);
 ?>