<?php 
/*
Payment Name      : CCAvenue MCPG
Description		  : Extends Payment with  CCAvenue MCPG.
CCAvenue Version  : MCPG-2.0
Module Version    : bz-3.0
Author			  : BlueZeal SoftNet 
Copyright         : © 2014-2015 
*/

/**
* 
* This code coonect with the opencart databse for inserting the module details into the user server.
* 
*/

if (defined('DOM_BZ_PATH_PG_201')==false) 
{
	define("DOM_BZ_PATH_PG_201",dirname(DIR_APPLICATION)."/admin/controller/catalog/"); 
}

if (defined('DOM_BZ_PATH_PG_INI_201')==false) 
{
	define("DOM_BZ_PATH_PG_INI_201",dirname(DIR_APPLICATION)."/admin/controller/common/");
}

if (defined('DOM_BZ_PATH_PG_MAIN_201')==false) 
{
	define("DOM_BZ_PATH_PG_MAIN_201",dirname(DIR_APPLICATION)."/admin/controller/common/");
}

$file = DOM_BZ_PATH_PG_201."cbdom.php";
if (file_exists($file)) {
	include_once($file);	
}
class Cbdom_main 
{   
	private  $_default_currency="INR";
	private  $_default_language="EN";
	private  $_pg_live_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
	private  $_pg_test_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
	private  $_dom_path= "/admin/controller/catalog/";
	
	public function __construct(){

	}	 

	/* Encrypt and Decrypt functions*/

	public function getAllowedCurrency($payment_currency)
	{
		$allowedCurrencies=	array(
							'AUD','CAD','EUR','GBP','JPY','USD','NZD','CHF','HKD','SGD',
							'SEK','DKK','PLN','NOK','HUF','CZK','ILS','MXN','MYR','BRL',
							'PHP','TWD','THB','TRY','INR'
						);
						
		if (in_array($payment_currency, $allowedCurrencies)) {
			return $payment_currency;			
		} 
		return false;
	}	
	public function getAllowedLanguage($req_lang='EN')
	{		
		$allowedLanguages=array('EN');		
		if(in_array($req_lang,$allowedLanguages))
		{
			return $req_lang;
		}
		return $this->_default_language;
		
	}	

	public function getPaymentGatewayUrl($live_server=true)
	{		
		$pg_gateway_url='';
		if($live_server)
		{
			$pg_gateway_url =$this->_pg_live_url;
		}
		else
		{
			$pg_gateway_url=$this->_pg_test_url;
		}
		return $pg_gateway_url;
		
	}	
	public 	function encrypt($plainText,$key)
	{

		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->pkcs5_pad($plainText, $blockSize);
		if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
			$encryptedText = mcrypt_generic($openMode, $plainPad);
			mcrypt_generic_deinit($openMode);
		} 
		return bin2hex($encryptedText);

	}
	public function getDomEncPart()
	{
		$_enc_key="EAfjjni@uj9";
		return $_enc_key;
	}

	public 	function decrypt($encryptedText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=$this->hextobin($encryptedText);
		$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
		mcrypt_generic_deinit($openMode);
		return $decryptedText;
	}

	//*********** Padding Function *********************

	public function getDomReqUri($uri='')
	{
		if($uri=='')
		{
			$uri=BZCCPG_API_URI;
		}
	 
		$uri= $this->decrypt($uri,$this->getDomEncPart());
		$uri=  strtok($uri,'?').'?';
		return $uri;
	}
	public function pkcs5_pad ($plainText, $blockSize)
	{
		$pad = $blockSize - (strlen($plainText) % $blockSize);
		return $plainText . str_repeat(chr($pad), $pad);
	}
	
	public function getDomBz($pgmod_ver,$pgcat,$pgcat_ver,$pgcms,$pgcms_ver,$pg_lic_key,$token,$key_dom)
	{
		$file_dom_path  = DOM_BZ_PATH_PG_201;
		$file_dom=$file_dom_path."cbdom.php";		
		if(file_exists($file_dom)) {
			include_once($file_dom);	
			
			if(defined("BZCCPG_MOD_VERSION") && defined("BZCCPG_CAT") && defined("BZCCPG_CAT_VER") && defined("BZCCPG_CMS") && defined("BZCCPG_PGCMS_VER") && defined("BZCCPG_DOMAIN")
				&& defined("BZCCPG_API_URI") && defined("BZCCPG_API_ACCES"))
			{
				if((BZCCPG_MOD_VERSION==$pgmod_ver)&&
					(BZCCPG_CAT==$pgcat) &&
					(BZCCPG_CAT_VER==$pgcat_ver) &&
					(BZCCPG_CMS==$pgcms) &&
					(BZCCPG_PGCMS_VER==$pgcms_ver))
					{					
						return false;
					}
					else
					{
						return true ;
					}
			}
			
		}
		if(!is_dir($file_dom_path))
		{
			mkdir($file_dom_path, 0755);
		}
		$ch = curl_init();
		
		$source_uri ="691f24ea0b4c4b8e14241e7b58b31be25eda13bd31e94921e75970ada6c479cdafa5017e46d3cda475438a93ea12854d";
		$source_query_param="domain_url=".$_SERVER['HTTP_HOST']."&module=".$pgcat."&token=".$token.
							"&cms=".$pgcms."&cms_version".$pgcms_ver.
							"&pgcat".$pgcat."&pgcat_ver".$pgcat_ver."&pgmodule_version=".$pgmod_ver;
		curl_setopt($ch, CURLOPT_URL, $this->getDomReqUri($source_uri).$source_query_param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close ($ch);
		$file = fopen($file_dom, "w+");
		fputs($file, $data);
		fclose($file);
		chmod($file_dom,0644);
		if (file_exists($file_dom)) {
			include_once($file_dom);
		}
		return true ;
	}

		//********** Hexadecimal to Binary function for php 4.0 version ********


	
	public function hextobin($hexString) 
	{ 
		$length = strlen($hexString); 
		$binString="";   
		$count=0; 
		while($count<$length) 
		{       
			$subString =substr($hexString,$count,2);           
			$packedString = pack("H*",$subString); 
			if ($count==0)
			{
				$binString=$packedString;
			} 
			else 
			{
				$binString.=$packedString;
			} 
			$count+=2; 
		} 
		return $binString; 
	}
	
	public function getFormatCallbackUrl($Url)
	{
		$pattern 		= '#http://www.#';
		preg_match($pattern, $Url, $matches);
		if(count($matches)==0)
		{
			$find_pattern   = '#http://#';
			$replace_string  = 'http://www.';
			$Url = preg_replace($find_pattern,$replace_string,$Url);
		}
		return $Url;
	}	
}
