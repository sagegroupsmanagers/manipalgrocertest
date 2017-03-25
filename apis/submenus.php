
<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	
	$name = $_GET['name'];
	
	$result = mysqli_query($link,"select category_id from `oc_category_description` where `name` = '$name'");
	
	if (!$result) {
    echo 'Could not run query: ';
    exit;
	}
	$row = mysqli_fetch_row($result);
	
	$par_ID = $row[0];
	
	$qur_menus = mysqli_query($link,"SELECT ocd.name,ocd.category_id FROM `oc_category_description` AS ocd WHERE ocd.category_id IN (SELECT oc.category_id FROM `oc_category` AS oc WHERE oc.parent_id='$par_ID' ORDER BY oc.category_id);")  or die("Invalid query: "  .mysqli_error($link));
	
	$result1 =array();
	
	$json = array("status" => 1, "info" => $result1);
	
	while($r = mysqli_fetch_array($qur_menus))
	{
		extract($r);
		$name = str_replace("&amp;","and",$name);
		$result1[] = array("submenu" => $name,"id" => $category_id); 
        $json = array("status" => 1, "info" => $result1);
	}   
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json,JSON_PRETTY_PRINT);
?>
