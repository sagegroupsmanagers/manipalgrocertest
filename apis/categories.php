
<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	$qur_menus = mysqli_query($link,"SELECT oc.`image`,ocd.name,ocd.category_id FROM oc_category_description ocd, oc_category oc where ocd.category_id=oc.category_id and oc.top=1;")  or die("Invalid query: "  .mysql_error());
	$result =array();
	while($r = mysqli_fetch_array($qur_menus))
	{
		extract($r);
		$name = str_replace("&amp;","and",$name);
		$image = str_replace(" ","%20",$image);
		$result[] = array("category_id" => $category_id,"category_name" => $name,"image"=>"http://www.manipalgrocer.in/image/".$image);
        $json = array("status" => 1, "info" => $result);
	}   
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>
