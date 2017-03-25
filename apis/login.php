<?php

  $link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysqli_error());
	}
 if($_SERVER['REQUEST_METHOD']=='GET'){
	
 $telephone = $_GET['telephone'];
 $sql_query=mysqli_query($link,"select telephone,firstname,imei from oc_customer where telephone = '$telephone'")  or die("Invalid query: "  .mysql_error());
 $result =array();
 $json = array("status" => 1, "info" => $result);
 while($r = mysqli_fetch_array($sql_query))
	{
		extract($r);
		$result[] = array("telephone" => $telephone,"firstname" => $firstname,"imei" => $imei);
        $json = array("status" => 1, "info" => $result);
	}
 }
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json,JSON_PRETTY_PRINT);
 ?>