<?php

class Synicsys{

	protected $url = "http://alerts.synicsys.com/api/web2sms.php";

	public function notifyAdmin($message)
	{
		for ($i = 1;$i <= 4;$i ++) {
            $name = 'synicsys_admin'.$i;
            $to = $this->config->get($name);
            $sms->send($to, $message);
        }   
	}

	// public function notifyUser($mob_num, $msg)
	// {
	// 	$msg = "Dear"
	// }

	public function send($mob_num, $msg)
	{		
		$working_key = $this->config->get('synicsys_working_key');
		$sender_id = $this->config->get('synicsys_sender_id');	

		if ($mob_num) {	
			$ch = curl_init($url);			
			curl_setopt($ch, CURLOPT_POST, 1);			
			curl_setopt($ch, CURLOPT_POSTFIELDS, "workingkey=" . $working_key . "&sender=" . $sender_id . "&to=" . $mob_num . "&message=" . $msg . "");			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);			
			curl_exec($ch);	
		}	
	}
}