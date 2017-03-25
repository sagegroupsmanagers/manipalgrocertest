<?php
/*Payment Name    : CCAvenue MCPG
Description		  : Extends Payment with  CCAvenue MCPG.
Opencart version  : 2.0.1.1
CCAvenue Version  : MCPG-2.0
Module Version    : bz-3.0
Author			  : BlueZeal SoftNet 
Copyright         : © 2014-2015 */
 
if (defined('DOM_BZ_PATH_PG_MAIN_201')== false) 
{
	define("DOM_BZ_PATH_PG_MAIN_201",dirname(DIR_APPLICATION)."/admin/controller/common/");
}

$file=DOM_BZ_PATH_PG_MAIN_201."cbdom_main.php";// need to be edit for every ecommerce path 

if (file_exists($file)) {	include_once($file); } 

class ControllerPaymentCcavenuepay extends Controller {
	public function index() {
	
		$this->language->load('payment/ccavenuepay');
		$data['button_confirm'] = $this->language->get('button_confirm');		
		$cbdom = new Cbdom();		
		
		$this->load->model('checkout/order');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		if ($order_info)		{
			$currency =  $cbdom->getAllowedCurrency($order_info['currency_code']); 
			if($currency==false)
			{
				echo "Currency not allowed ";
				return false;
			}
			 
			$language=$cbdom->getAllowedLanguage();
	
			$Amount						= $this->currency->format($order_info['total'], $order_info['currency_code'], false, false);
			$Merchant_Id 				= $this->config->get('ccavenuepay_merchant_id');
			$access_code 				= $this->config->get('ccavenuepay_access_code');
			$Order_Id 					= $this->session->data['order_id'];
			$Url 						= $this->url->link('payment/ccavenuepay/callback');
			$workingKey 				= $this->config->get('ccavenuepay_working_key');			
			$Url 						= $this->url->link('payment/ccavenuepay/callback');
			$this->load->model('localisation/zone');
			$billing_name 		= '';
			$billing_address 	= '';
			$billing_city		= '';
			$billing_state		= '';
			$billing_tel		= '';
			$billing_zip		= '';
			$billing_country 	= '';
			$billing_email		= '';		
			
			$delivery_name		= '';
			$delivery_address 	= '';
			$delivery_city		= '';
			$delivery_state		= '';
			$delivery_tel		= '';
			$delivery_zip		= '';
			$delivery_country 	= '';
			$merchant_param1 	= '';
			
			if($order_info['payment_firstname'])
			{
				$customer_firstname 				= html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');	
				$customer_lastname 				    = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');					
				$billing_name						= $customer_firstname." ".$customer_lastname;
				$address1  							= html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');	
				$address2  							= html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8');	
				$billing_address 					= $address1." ".$address2;
				$billing_city 						= html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
				$billing_state						= $order_info['payment_zone'];
				$billing_tel						= html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');		
				$billing_zip						= html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
				$billing_country_iso_code_3 		= $order_info['payment_iso_code_3'];
				$billing_country_query 				= $this->db->query("SELECT name FROM " . DB_PREFIX . "country where iso_code_3='".$billing_country_iso_code_3."'");
				$billing_country_name 				= $billing_country_query->row['name'];
				$billing_country					= $billing_country_query->row['name'];
				$billing_country					= $billing_country_name;
			}
			
			
			if($order_info['shipping_firstname'])
			{
				$customer_firstname 				= html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8');	
				$customer_lastname  				= html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8');	
				$delivery_name						= $customer_firstname." ".$customer_lastname;
				$address1  							= html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8');	
				$address2  							= html_entity_decode($order_info['shipping_address_2'], ENT_QUOTES, 'UTF-8');	
				$delivery_address					= $address1." ".$address2;									
				$delivery_city						= html_entity_decode($order_info['shipping_city'], ENT_QUOTES, 'UTF-8');
				$delivery_state						= $order_info['shipping_zone'];
				$delivery_tel						= html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');				
				$delivery_zip						= html_entity_decode($order_info['shipping_postcode'], ENT_QUOTES, 'UTF-8');
				$delivery_country_iso_code_3 		= $order_info['shipping_iso_code_3'];
				$delivery_country_query 			= $this->db->query("SELECT name FROM " . DB_PREFIX . "country where iso_code_3='".$billing_country_iso_code_3."'");
				$delivery_country_name 				= $delivery_country_query->row['name'];
				$delivery_country					= $delivery_country_query->row['name'];
				$delivery_country					= $delivery_country_name;
			}
		
			$billing_email								= $order_info['email'];
			$merchant_param1							= $this->session->data['comment'];
			$redirect_url								= $this->url->link('payment/ccavenuepay/callback');
			$cancel_url									= $this->url->link('payment/ccavenuepay/callback');
			$merchant_data_array 						= array();			
			$merchant_data_array['merchant_id'] 		= $Merchant_Id;
			$merchant_data_array['order_id']			= $Order_Id;
			$merchant_data_array['currency']			= $order_info['currency_code'];
			$merchant_data_array['amount'] 				= $Amount;
			$merchant_data_array['redirect_url']		= $redirect_url;
			$merchant_data_array['cancel_url'] 			= $cancel_url;
			$merchant_data_array['language']			= $language;
			$merchant_data_array['billing_name']		= $billing_name;
			$merchant_data_array['billing_address']		= $billing_address;
			$merchant_data_array['billing_city']		= $billing_city;
			$merchant_data_array['billing_state']		= $billing_state;
			$merchant_data_array['billing_zip']			= $billing_zip;
			$merchant_data_array['billing_country']		= $billing_country;
			$merchant_data_array['billing_tel']			= $billing_tel;
			$merchant_data_array['billing_email']		= $billing_email;
			$merchant_data_array['delivery_name']		= $delivery_name;
			$merchant_data_array['delivery_address']	= $delivery_address;
			$merchant_data_array['delivery_city']		= $delivery_city;
			$merchant_data_array['delivery_state']		= $delivery_state;
			$merchant_data_array['delivery_zip']		= $delivery_zip;
			$merchant_data_array['delivery_country']	= $delivery_country;
			$merchant_data_array['delivery_tel']		= $delivery_tel;
			$merchant_data_array['merchant_param1']		= $merchant_param1;
			
			$merchant_data 								= implode("&",$merchant_data_array);			
			$data['access_code']	 					= $access_code ; 
			$data['action'] 							= $cbdom->getPaymentGatewayUrl();
				
			$cbdom->setBZCCLicenceApiTNPrefix(DB_PREFIX);
			$apidetails = $this->db->query($cbdom->getPgmDetails())->rows; // passed instance of db variable
			
			## gethering details for pass
			$passdata = array("merchantdata"=>$merchant_data_array,"encryptkey"=>$workingKey,"data"=>$data);

			## get Frontend form by calling the API server
						
			$api_resonse = $cbdom->getfrontform($apidetails,json_encode($passdata));

			## The API response
			$data['api_resonse'] = $api_resonse;
			
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ccavenuepay.tpl')) {
			 
				return $this->load->view($this->config->get('config_template') . '/template/payment/ccavenuepay.tpl',$data);
			} else {
		
				return $this->load->view('default/template/payment/ccavenuepay.tpl',$data);
			}
			
		}
	}
	 
	public function callback() 
	{
		$cbdom 			= new Cbdom();		
		$workingKey 	= $this->config->get('ccavenuepay_working_key');
		$encResponse	= $_REQUEST["encResp"];		//This is the response sent by the CCAvenue Server
		$rcvdString		= $cbdom->decrypt($encResponse,$workingKey);	//Crypto Decryption used as per the specified working key.
		$decryptValues	= explode('&', $rcvdString);
		$dataSize		= sizeof($decryptValues);
		$response_array	= array();

		for($i = 0; $i < count($decryptValues); $i++) 
		{
	  		$information	= explode('=',$decryptValues[$i]);
			if(count($information)==2)
			{
				$response_array[$information[0]] = urldecode($information[1]);
			}			  
		}

		$order_status		= '';
		$order_id    		= '';
		$tracking_id		= '';
		$bank_ref_no 		= '';
		$failure_message 	= '';
		$payment_mode 		= '';
		$card_name    		= '';
		$status_code  		= '';
		$status_message 	= '';
		$currency       	= '';
		$amount			= '';
		$payment_status_message	= '';
		
		if(isset($response_array['order_id'])) 		$order_id 			= $response_array['order_id'];
		if(isset($response_array['tracking_id'])) 	$tracking_id 		= $response_array['tracking_id'];
		if(isset($response_array['bank_ref_no'])) 	$bank_ref_no 		= $response_array['bank_ref_no'];
		if(isset($response_array['order_status'])) 	$order_status 		= $response_array['order_status'];
		if(isset($response_array['failure_message'])) 	$failure_message= $response_array['failure_message'];
		if(isset($response_array['payment_mode'])) 	$payment_mode 		= $response_array['payment_mode'];
		if(isset($response_array['card_name'])) 	$card_name 			= $response_array['card_name'];
		if(isset($response_array['status_code'])) 	$status_code 		= $response_array['status_code'];
		if(isset($response_array['status_message'])) 	$status_message = $response_array['status_message'];
		if(isset($response_array['currency'])) 		$currency 			= $response_array['currency'];
		if(isset($response_array['amount'])) 		$amount 			= $response_array['amount'];
		
		$this->load->language('payment/ccavenuepay');
		$this->load->library('encryption');
		$this->load->model('checkout/order');
		$order_info 	= $this->model_checkout_order->getOrder($order_id);
		if($order_info)
		{
			$this->language->load('payment/ccavenuepay');
			$data = array(
					"order_id"			=> $order_id,
					"tracking_id"		=> $tracking_id,
					"bank_ref_no"		=> $bank_ref_no,
					"order_status"		=> $order_status,
					"failure_message"	=> $failure_message,
					"payment_mode"		=> $payment_mode,
					"card_name"			=> $card_name,
					"status_code"		=> $status_code,
					"status_message"	=> $status_message,
					"currency"			=> $currency,
					"amount"			=> $amount
				);
 
			if (isset($order_info['order_id'])) {
				$order_id = $order_info['order_id'];
			} else {
				$order_id = $data['order_id'];
			
			}			

			if($order_status=="Success")
			{				
				$payment_status_message = $this->language->get('success_comment');
				$payment_status  = true;
				$order_status_id = $this->config->get('ccavenuepay_completed_status_id');
				if (!$order_info['order_status_id']) {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message);
				} else {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message, FALSE);
				}
				$payment_confirmation_mail =  $this->config->get('ccavenuepay_payment_confirmation_mail');
				
				if($payment_confirmation_mail)
				{						
					$subject  = $this->language->get('payment_confirmation_mail_subject');
		
					$customer_name= $order_info['firstname']." ".$order_info['lastname'];
					$mail_body 	= $this->language->get('payment_confirmation_mail_body');
					$payment_confirmation_mail_body =sprintf($mail_body ,$customer_name,$order_id,$order_info['date_added'],$order_info['payment_method'],$order_info['shipping_method'],$order_info['total']);
					$to	  		= $order_info['email'];	
					$mail 	 	= new Mail();							
					$mail->setTo($to);
					$mail->setFrom($this->config->get('config_email'));
					$mail->setSender($this->config->get('config_name'));
					$mail->setSubject($subject);
					$mail->sethtml(html_entity_decode($payment_confirmation_mail_body, ENT_QUOTES, 'UTF-8'));
					$mail->send();

				}
			}
			else if($order_status=="Aborted")
			{
				$payment_status_message = $this->language->get('pending_comment');
				$payment_status = false;
				$order_status_id = $this->config->get('ccavenuepay_pending_status_id');
				if (!$order_info['order_status_id']) {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message);
				} else {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message, FALSE);
				}
			}
			else if($order_status=="Failure")
			{
				$payment_status_message =$this->language->get('declined_comment');
				$payment_status = false;
				$order_status_id = $this->config->get('ccavenuepay_failed_status_id');
				if (!$order_info['order_status_id']) {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message);
				} else {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message, FALSE);
				}	
			}
			else
			{
				$payment_status_message = $this->language->get('failed_comment');							
				$payment_status = false;				
				$order_status_id = $this->config->get('ccavenuepay_failed_status_id');				
				if (!$order_info['order_status_id']) {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message);
				} else {
					$this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $payment_status_message, FALSE);
				}
			}

			/**************** Start pay failure logic ************/
			$data['title'] 	= sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
			if (!isset($this->request->server['HTTPS']) || ($this->request->server['HTTPS'] != 'on')) {
				$data['base'] = HTTP_SERVER;
			} else {
				$data['base'] = HTTPS_SERVER;
			}
			$data['language'] 				= $this->language->get('code');
			$data['direction'] 				= $this->language->get('direction');
			$data['heading_title'] 			= sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
			$data['text_response'] 			= $this->language->get('text_response');
			$data['payment_status_message'] = $payment_status_message;		
 	
			if($payment_status)
			{				
				$data['text_payment_wait'] = sprintf($this->language->get('text_payment_wait'), $this->url->link('checkout/success'));
				$data['continue'] = $this->url->link('checkout/success');
				$this->response->redirect($this->url->link('checkout/success'));
			}
			else
			{
				$data['text_payment_wait'] = sprintf($this->language->get('text_payment_wait'), $this->url->link('checkout/cart'));
				$data['continue'] = $this->url->link('checkout/cart');
			}
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ccavenuepay_response.tpl')) {
					$template = $this->config->get('config_template') . '/template/payment/ccavenuepay_response.tpl';
				} else {
					$template = 'default/template/payment/ccavenuepay_response.tpl';
				}
			$data['header'] = $this->load->controller('common/header');
			$data['column_content_bottom'] = $this->load->controller('common/content_bottom');
			$data['column_content_top'] = $this->load->controller('common/content_top');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['footer'] = $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view($template, $data));
		}
	}
}
?>