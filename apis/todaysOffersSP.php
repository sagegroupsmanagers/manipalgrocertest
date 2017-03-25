<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysql_error());
	}
	
	
	$query_product_id = mysqli_query($link,"SELECT p.product_id 
	FROM oc_product p LEFT JOIN oc_product_to_store p2s ON (p.product_id = p2s.product_id) 
	WHERE p.status = '1' AND p.date_available <= NOW() ORDER BY p.viewed DESC, p.date_added DESC LIMIT 20");

	$result = array();
	while($row1 = mysqli_fetch_row($query_product_id))
	{
		extract($row1);
		
		$pro_id=$row1[0];
		//echo $pro_id;
		
		$query_fetch_product_details = mysqli_query($link,"SELECT p.price as mrp, p.image, pd.name , ps.price as sp, od.name as option_type, po.product_option_id from oc_product as p 
		LEFT JOIN oc_product_to_category as pc on pc.product_id = '$pro_id'
		LEFT JOIN oc_product_description AS pd on pd.product_id = '$pro_id'
		LEFT JOIN oc_product_special AS ps on ps.product_id = '$pro_id'
		LEFT JOIN oc_product_option as po on po.product_id = '$pro_id'
		LEFT JOIN oc_option_description as od on od.option_id = po.option_id");
		
		while($row3 = mysqli_fetch_row($query_fetch_product_details))
		{
			$pro_price = $row3[0];
		//echo $pro_price;
			$pro_image = $row3[1];
		//echo $pro_image;
			$pro_name = $row3[2];
		//echo $pro_name;
			$pro_sp = $row3[3];
		//echo $pro_sp;
			$pro_od = $row3[4];
		//echo $pro_od;
		}
		
		$price=0;
			
		$query_product_options = mysqli_query($link,"select ovd.name, pov.price, pov.price_prefix 
		from oc_option_description od,oc_option_value_description ovd, 
		oc_product_option_value pov where od.option_id = pov.option_id and 
		pov.option_value_id = ovd.option_value_id and pov.product_id = '$pro_id'");
		
		$base_price = $pro_price;
		if(!empty($pro_sp))
		{
			$base_price = $pro_sp;
		}
		$options[] = array();
		$options = null;
		while($row2 = mysqli_fetch_row($query_product_options))
		{
			extract($row2);
			
			$op_va_name = $row2[0];
			$pro_op_va_price = $row2[1];
			$pro_op_prefix = $row2[2];
			
			if($pro_op_prefix == '-')
			{
				$op_price = $base_price - $pro_op_va_price;
			}
			else
			{
				$op_price = $base_price + $pro_op_va_price;
			}
			
			$options[$op_va_name] = $op_price;
		}
		$pro_image = str_replace(" ","%20",$pro_image);
		$pro_name = str_replace("&amp;","and",$pro_name);
		$result[] = array("product_id"=>$pro_id,
			"image"=>"http://www.manipalgrocer.in/image/".$pro_image,
			"name" => $pro_name,
			"price"=>$pro_price,
			"special_price" => $pro_sp,
			"option_type"=>$pro_od,
		"options" => $options);
			
	}
	$json = array("info" => $result, "count" => mysqli_num_rows($query_product_id));
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json, JSON_PRETTY_PRINT);
?>
