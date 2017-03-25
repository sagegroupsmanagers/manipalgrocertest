<?php echo $header; ?>
<?php echo $column_left; ?> 

<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-ccavenue" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i> <?php echo $button_save; ?></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i> <?php echo $button_cancel; ?></a></div>
				<h1><?php echo $heading_title; ?></h1>
				<ul class="breadcrumb">
					<?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="container-fluid">
			<?php if ($error_warning) { ?>
			<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
			<?php } ?>
			<div class="panel panel-default">				
				<div class="panel-heading" id ="api_panel" style="display: inline-block; margin-left: 20px; ">
					<div class="af" id="af" style="float: left; padding:  23px 5px 0px; border-right: 1px dashed #cccccc; height: 132px;">
						<a href="https://www.bluezeal.in/" target="_blank">
							<img src="https://api.bluezeal.in/cca/images/logo.png" alt="Bluezeal Logo">	
						<!--Ccavenue Payment Module developed by Bluezeal.in-->
						</a><br><br>
						<div>
							
							<b><font color="sky blue">We Make </font> <font color="red"> Module </font><font color="sky blue">  Simpler </font>
							</b>
						</div>		
					</div>
					<div id ="right_panel" style="display: inline-block; margin-left: 20px; margin-top: 44px; float:left">
						<h3 class="panel-title"><?php echo $heading_title; ?> </h3>
						</br> <a style=" font-size:16px;font-family:Verdana, Geneva, sans-serif; color:#09F;">Module Version:</a><a style="color:#390; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold"><?php echo BZCCPG_MOD_VERSION; ?></a>				  
						</br><a href="<?php echo $ccavenuepay_pdf_link;?>" target="_blank" style="color:#F00; font-family:Verdana, Geneva, sans-serif; font-size:10px;"> PDF Manual Guide</a>&nbsp;&nbsp;&nbsp; <a  href="<?php echo $ccavenuepay_video_link; ?>" style="color:#F00; font-family:Verdana, Geneva, sans-serif; font-size:10px;">Video Tutorial Guide </a><br> <span class="blue small fontstyle"><a class="support" href="https://www.bluezeal.in/support" target="_blank">Support</a></span>
					</div>
					<!------ download  -->
					<div class="panel-2"  style="display:none; padding: 23px 5px 27px; float:left; border-left: 1px dashed #cccccc; margin-left:20px; ">
						<div id="module_update_panel" style="float: left; border:1px solid #eeeeee; padding:20px;">
							<a style="color:#09F; font-family:Verdana, Geneva, sans-serif; font-size:12px; font-size:15px"> Avilable Updated Version:</a> 
							<br>Module version  &nbsp  &nbsp  : &nbsp &nbsp <span id="new_module_version" style="font-size: 14px;font-weight: bold;color: green;"></span>
							<div style="display:none;">
								<br>Cms Version  &nbsp &nbsp &nbsp  &nbsp  &nbsp : &nbsp &nbsp <span id="new_cms_ver" style="font-size: 14px;font-weight: bold;color: green;"></span>
								<br>Category Version  &nbsp      : &nbsp &nbsp <span id="new_cat_ver" style="font-size: 14px;font-weight: bold;color: green;"></span>
							</div>
							<a>
								<span class="red small about fontstyle" style="color: blue;font-family:Verdana, Geneva, sans-serif; font-size:12px; font-size:14px;margin:5px; text-decoration: underline;" id="update_module_button" onclick="return update_newmodule();">Get Updated Module</span>
							</a>
						</div>
						<div id="file_download_panel" style="float: left;margin-left: 11px; margin-top: 40px;">
							<form class="download_module" method="get" action="" id="Download_file">
								<button type="submit">Download!</button>
							</form>
						</div> 
					</div>
					<!---- download --->
				</div>
				<div class="panel-body">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ccavenuepay" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
							<div class="col-sm-10">
								<select name="ccavenuepay_status" id="input-status" class="form-control">
									<?php if ($ccavenuepay_status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-merchant_id"><?php echo $entry_merchant_id; ?></label>
							<div class="col-sm-10">
								<input type="text" name="ccavenuepay_merchant_id" value="<?php echo $ccavenuepay_merchant_id;  ?>" placeholder="<?php echo $entry_merchant_id; ?>" id="input-merchant_id" class="form-control"  /> 
								<?php if ($error_merchant_id) { ?>
										<span class="error"><?php echo $error_merchant_id; ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-access_code"><?php echo $entry_access_code; ?></label>
							<div class="col-sm-10">
								<input type="text" name="ccavenuepay_access_code" value="<?php echo $ccavenuepay_access_code;  ?>" placeholder="<?php echo $entry_access_code; ?>" id="input-access_code" class="form-control"  /> 
								<?php if ($error_access_code) { ?>
									<span class="error"><?php echo $error_access_code; ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-working_key"><?php echo $entry_working_key; ?></label>
							<div class="col-sm-10">
								<input type="password" name="ccavenuepay_working_key" value="<?php echo $ccavenuepay_working_key;  ?>" placeholder="<?php echo $entry_working_key; ?>" id="input-working_key" class="form-control"  /> 
								<?php if ($error_working_key) { ?>
									<span class="error"><?php echo $error_working_key; ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-payment_confirmation_mail"><?php echo $entry_payment_confirmation_mail; ?></label>
							<div class="col-sm-10">
								<?php if ($ccavenuepay_payment_confirmation_mail) { ?>
									<input type="radio" name="ccavenuepay_payment_confirmation_mail" value="1" checked="checked" />
									<?php echo $text_yes; ?>            
									<input type="radio" name="ccavenuepay_payment_confirmation_mail" value="0" />
									<?php echo $text_no; ?>            
								<?php } else { ?>            
									<input type="radio" name="ccavenuepay_payment_confirmation_mail" value="1" />
									<?php echo $text_yes; ?>            
									<input type="radio" name="ccavenuepay_payment_confirmation_mail" value="0" checked="checked" />
									<?php echo $text_no; ?><?php } ?>
							</div>
						</div> 
						<div class="form-group">
							<label class="col-sm-2 control-label"  for="input-total">
								<span data-toggle="tooltip"  title="<?php echo $help_total; ?>" ><?php echo $entry_total; ?> </span> 
							</label> 
							<div class="col-sm-10">
								<input type="text" name="ccavenuepay_total" value="<?php echo $ccavenuepay_total; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
							<div class="col-sm-10">
								<select name="ccavenuepay_geo_zone_id" id="input-geo-zone" class="form-control">
									<option value="0"><?php echo $text_all_zones; ?></option>
									<?php foreach ($geo_zones as $geo_zone) { ?>
									<?php if ($geo_zone['geo_zone_id'] == $cheque_geo_zone_id) { ?>
									<option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
									<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-completed_status"><span data-toggle="tooltip" title="<?php echo $help_completed_status; ?>"><?php echo $entry_completed_status; ?></span></label>
								<div class="col-sm-10">
									<select name="ccavenuepay_completed_status_id" id="input-completed_status_id" class="form-control">
										<?php foreach ($order_statuses as $order_status)  {  ?>
									   <?php  if ($order_status['order_status_id'] == $ccavenuepay_completed_status_id)  { ?>
											<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
											<?php } else { ?>
											<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
											<?php } ?>
											<?php } ?>
										 
									</select>
								</div>
							</div>
							<div class="form-group">
							<label class="col-sm-2 control-label" for="input-failed_status"><span data-toggle="tooltip" title="<?php echo $help_failed_status; ?>"><?php echo $entry_failed_status; ?></span></label>
							<div class="col-sm-10">
							  <select name="ccavenuepay_failed_status_id" id="input-failed_status" class="form-control">
						<?php foreach ($order_statuses as $order_status) {  ?>
							   <?php if ($order_status['order_status_id'] == $ccavenuepay_failed_status_id) { ?>
									 <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
									<?php } ?>
							 <?php } ?> 
							  </select>
							</div>
						  </div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-pending_status"><span data-toggle="tooltip" title="<?php echo $help_pending_status; ?>"><?php echo $entry_pending_status; ?></span></label>
							<div class="col-sm-10">
							  <select name="ccavenuepay_pending_status_id" id="input-pending_status" class="form-control">
								<?php foreach ($order_statuses as $order_status) { ?>
									<?php if ($order_status['order_status_id'] == $ccavenuepay_pending_status_id)  { ?>
									<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
									<?php } else { ?>
										<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
									<?php } ?>
								<?php } ?>
							  </select>
							</div>
						  </div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
							<div class="col-sm-10">
							  <input type="text" name="ccavenuepay_sort_order" value="<?php echo $ccavenuepay_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>	
	</div>
</div>
<script  type="text/javascript">
	 $(document).ready(function()
	{
		//$("#module_update_panel").hide();
		$("#file_download_panel").hide();
        // $('.panel-2').hide();  
        // $('.panel-2').show();  
		 
	});
	/** 
  *
  * This Function Is Call Function Of Module Update Cheking (check_module_upload())
  */
	function check_update(li,module)
  	{
	  	var lincense_key = li;
	  	var module_version = module;
	  	var module_name = "<?php echo BZCCPG_CMS; ?>";
	  	$.ajax({
	  		url:'index.php?route=payment/ccavenuepay/check_module_upload&token=<?php echo $token; ?>&lincese_key='+lincense_key+'&module_version='+module_version+'&module_name='+module_name+'',
	  		type: 'POST'
	  	}).success(function(data)
	  	{
	  		var len = data.length;
	  		//console.log(data);
			var mydata = JSON.parse(data);	  		
			if(mydata.flage == 1)
			{
				$("#new_module_version").html(mydata.new_version);
				$("#new_cms_ver").html(mydata.new_cms_ver);
				$("#new_cat_ver").html(mydata.new_cat_ver);
				
				$("#module_update_panel").show();
				$(".panel-2").show();
			}
			else
			{
				$("#module_update_panel").hide();
				$(".panel-2").hide();
			}
	  	});
	 }
	var lincense_key = "<?php echo  BZCCPG_LICENCE_KEY; ?>";
	var module_version = "<?php echo BZCCPG_MOD_VERSION; ?>";
	 	check_update(lincense_key,module_version);
		
   /**
	*
	* This Function Is New Module Update Start Call Function (newmoduleupdate_now())
	*/
	function update_newmodule()
	{
			var lincense_key 		= "<?php echo  BZCCPG_LICENCE_KEY; ?>";
			var module_version 		= "<?php echo BZCCPG_MOD_VERSION; ?>";
			var newmodule_version 	= $("#new_module_version").text();
			var new_cat_ver 		= $("#new_cat_ver").text();
			var new_cms_ver 		= $("#new_cms_ver").text();
			var module_name = "opencart";
			
			$.ajax({
				url:'index.php?route=payment/ccavenuepay/newmoduleupdate_now&token=<?php echo $token ?>&lincese_key='+lincense_key+'&module_version='+module_version+'&module_name='+module_name+'&newmodule_version='+newmodule_version+'&new_cms_ver='+new_cms_ver+'&new_cat_ver='+new_cat_ver+'',
				type: 'POST'
		  	}).success(function(data)
		  	{
		  		console.log(data);
		  		var mydata = JSON.parse(data);	 
		  		if(mydata.status == true)
		  		{
		  			var file_path = mydata.file_path;
		  			$("#file_download_panel").show();
		  			$(".download_module").attr("action", file_path);
		  			alert("Status :"+mydata.massage);
				}
				else
				{
					alert("Status : Error -"+mydata.massage);
				}
		  		/*if(mydata.status == true){ alert(mydata.massage);/*return true; }else{ return false; }*/
		  	});
	}
</script>
<?php echo $footer; ?>