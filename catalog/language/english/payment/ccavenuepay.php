<?php
/*Payment Name    : CCAvenue MCPG
Description		  : Extends Payment with  CCAvenue MCPG.
Opencart version  : 2.0.1.1
CCAvenue Version  : MCPG-2.0
Module Version    : bz-3.0
Author			  : BlueZeal SoftNet 
Copyright         : © 2014-2015 */

// Text 
$_['heading_title']     		= 'Thank you for shopping with %s .... ';
$_['text_title'] 				= 'Credit Card / Debit Card / Net Banking </br><img src= "http://www.ccavenue.com/images/460.gif" />';
$_['text_response']     		= 'Response from CCAvenue MCPG:';
$_['text_payment_wait'] 		= '<b><span style="color: #FF0000">Please wait...</span></b><br>If you are not automatically re-directed in 20 seconds, please click <a href="%s">here</a>.';
$_['text_reason'] 				= 'REASON';
$_['text_attn_email']			= 'ATTN: CCAvenue MCPG Order %s needs manual verification';
$_['text_tax']	 				= 'Tax';
$_['text_total']				= 'Shipping, Handling, Discounts & Taxes';
$_['success_comment']			= '<b><span style="color: #000000">Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.</span></b><br>';
$_['pending_comment']			= '<b><span style="color: #FF0000">CCAvenue MCPG payment order cancelled and the transaction has been Aborted </span></b><br>';
$_['failed_comment']			= '<b><span style="color: #FF0000">Security Error. Illegal access detected</span></b><br>';
$_['declined_comment']			= '<b><span style="color: #FF0000">CCAvenue MCPG payment order cancelled and the transaction has been Declined.</span></b><br>';

$_['payment_confirmation_mail_subject']	= 'CCAvenue MCPG Payment Status';
$_['payment_confirmation_mail_body']	= "Dear %s ,<br>  
										   We have received your order, Thanks for your Ccavenue payment.The transaction was successful.Your payment is authorized.<br>
										   The details of the order are below: <br><br>
										   Order ID		  : %s <br>
										   Date Ordered	  : %s <br>
										   Payment Method : %s <br>
										   Shipping Method: %s <br>
										   Order Total    : %s <br><br>";
?>