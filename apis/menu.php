
<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	$qur_menus = mysqli_query($link,"SELECT ocd.name,ocd.category_id FROM oc_category_description ocd, oc_category oc where ocd.category_id=oc.category_id and oc.top=1;")  or die("Invalid query: "  .mysql_error());
	$result =array();
	while($r = mysqli_fetch_array($qur_menus))
	{
		extract($r);
		$name = str_replace("&amp;","and",$name);
		$result[] = array("id" => $category_id,"menu" => $name);
        $json = array("status" => 1, "info" => $result);
	}   
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json,JSON_PRETTY_PRINT);
?>
