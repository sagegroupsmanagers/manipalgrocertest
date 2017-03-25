<?php 
/*Payment Name    : CCAvenue MCPG
Description		  : Extends Payment with  CCAvenue MCPG.
Opencart version  : 2.0.1.1
CCAvenue Version  : MCPG-2.0
Module Version    : bz-3.0
Author			  : BlueZeal SoftNet 
Copyright         : © 2014-2015 */

class ModelPaymentCcavenuepay extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('payment/ccavenuepay');		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('ccavenuepay_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");		
		if ($this->config->get('ccavenuepay_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('ccavenuepay_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	
		$status = TRUE;
		$method_data = array();	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'ccavenuepay',
				'title'      => $this->language->get('text_title'),	
				'terms'      => '',
				'sort_order' => $this->config->get('ccavenuepay_sort_order')
      		);
    	}  
    	return $method_data;
  	}
}
?>
