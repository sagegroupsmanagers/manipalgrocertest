<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	//$json = array("status" =>"" , "info" => "");
	$qur_bnr_img = mysqli_query($link,"SELECT `image` FROM `oc_banner_image` WHERE `banner_id` IN (SELECT `banner_id` FROM `oc_banner` WHERE `name`='Home Page Slideshow')")  or die("Invalid query: "  .mysql_error());
	$result =array();
	while($r = mysqli_fetch_array($qur_bnr_img))
	{
		extract($r);
		$image = str_replace(" ","%20",$image);
		$result[] = array("image" => "http://www.manipalgrocer.in/image/".$image);
		//$result[] = array("image" => "http://www.manipalgrocer.in/image/".$image);
        $json = array("status" => 1, "info" => $result);
	}   
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json,JSON_PRETTY_PRINT);
 ?>