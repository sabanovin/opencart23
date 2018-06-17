<?php
/*
  $Id: sms.php $
   opncart Open Source Shopping Cart Solutions
  http://www.opencart-ir.com
  version:2.8
*/
require_once(DIR_SYSTEM.'library/nuSoap/nusoap.php');   

 final class Sms {
      private     $to;
      private   $body;
      private $username ;
	  private $sms_api ;
	  private  $sample;
      private  $password;
      private  $from;
	  private $sms_getway;
      public $flash = false;
 
    function send_sms($to_mobile_number = null,$sms_text,$sms_api,$sms_getway,$from,$sample) {
		
      if ( (!empty($to_mobile_number)) && 11 <= strlen( $to_mobile_number ) && substr($to_mobile_number,0,2)=="09" ||  substr($to_mobile_number,0,4)=="+989" ) {
      
		return $this->send($to_mobile_number,$sms_text,$sms_api,$sms_getway,$from,$sample);
		 }
    }

    function send($to,$body,$sms_api,$sms_getway,$from,$sample) {
		
		 $this->sms_api=$sms_api;
	
	//$to=$this->session->data['to'];	
	$this->to=$to;
	//$body=$this->session->data['sms_text'];
	$this->body=$body;
	$this->sms_getway=$sms_getway;
	$this->sms_sample=$sample;
		
			//$this->sms_getway=$this->config->get('sms_samane_sms');
			switch ($this->sms_getway){ //switch
			
				case 'sabanovin': 
			        $SendUrl=" ?gateway=".$from."&amp;to=".$to."&amp;text=" . urlencode($body) . "";
					
					$url = "https://api.sabanovin.com/v1/".$this->sms_api."/sms/send.json";

// http_build_query builds the query from an array
$query_array = array (
    'text' => $body,
    'gateway' => $from,
    'to' => $to,
    'format' => 'json'
);

$query = http_build_query($query_array);
$result = file_get_contents($url . '?' . $query);
					//$SendUrl = str_replace('&amp;', '&', $SendUrl);
					//echo $SendUrl;
					//$res = file_get_contents($SendUrl);
					//print_r($res);
						//return $res ;
				break;
				
			   case 'Panel2u': 
			  
						 $res = @file_get_contents("http://sms.panel2u.ir/post/sendSMS.ashx?from=".$this->from."&to=".$to."&text=" . urlencode($body) . "&password=".$this->password."&username=".$this->username."");
				break;
				case 'panizsms': 
			  
						 $res = @file_get_contents("http://www.panizsms.ir/post/sendSMS.ashx?from=".$this->from."&to=".$to."&text=" . urlencode($body) . "&password=".$this->password."&username=".$this->username."");
				break;
				   case 'Sabasms': 
				   
						$Qs =array(
						'username' => $this->username,
						'password' => $this->password,
						'from'     => $this->from,
						'text'    => urlencode($body) 
						 );
					
					$fields=$this->BuildQs($Qs);
					//foreach($this->to as $Resipient)
					//{
						//array_push($this->Ids, $this->SendSocketHTTP('/Post/SendSms.ashx',$fields.'&To='.$Resipient));
						$this->SendSocketHTTP('/Post/SendSms.ashx',$fields.'&To='.$this->to);
					//}
					 /*
						  
			   $sms_client = new nusoap_client('http://www.SabaPayamak.com/Post/Send.asmx');
		
            $params = array(
            'from'=> $this->from,
            'username'=>$this->username,
            'password'=>$this->password,
			 'to'=>$to,
			 'text'=>$body,
			 'flash'=>false
               );

	      $res = $sms_client->call("SendSms",  $params);
		 */
		  break;
				   case 'Lksms': 
				   
				$res = @file_get_contents("http://api.lksms.com/?Username=".$this->username."&Password=".$this->password."&Type=2&Text=".urlencode($body)."&From=".$this->from."&To=".$to."&MCode=".$to."");
			  
			  break;
					
					 case 'textsms': 
				   
				$res = file_get_contents("http://textsms.ir/send_via_get/send_sms.php?username=".$this->username."&password=".$this->password."&sender_number=".$this->from."&receiver_number=".$to."&note=".urlencode($body));
			  
			  break;
			  
			   case 'irantc': 
				   
							 $url="http://webservice.iran.tc";
							$sms_client=new nusoap_client('http://webservice.iran.tc/');				
							
							 $params = array(
								  
									'username'=>$this->username,
									'password'=>$this->password,
									 'reciever'=>$to,
									 'text'=>$body,
									 'sender'=> $this->from
								);
						
							$res = $sms_client->call("SendSMS",  $params );
						
								return     $res; 
								
								break;
							   
				  case 'smsopencart': 
								  		// $url="http://185.4.28.180/class/sms/webservice/server.php?wsdl";
							//$sms_client=new nusoap_client('http://185.4.28.180/class/sms/webservice2/server.php?wsdl');	
							$sms_client=new nusoap_client('http://37.130.202.188/class/sms/webservice2/server.php?wsdl');							 
							 $params = array(
								    'fromNum'=> $this->from,
									'toNum'=>$to,
								    'messageContent'=>$body,
								    'messageType'=>'normal',
									'user'=>$this->username,
									'pass'=>$this->password
								);
						//print_r($params);
							$res = $sms_client->call("SendSMS",  $params );
							//echo $res;
						
								return     $res;                              
						break; 
						
						
						
						 case 'smsir': 


$client= new SoapClient('http://ip.sms.ir/ws/SendReceive.asmx?wsdl');

$parameters['userName'] = $this->username;
$parameters['password'] = $this->password;
$parameters['mobileNos'] = array(doubleval($to));
$parameters['messages'] = array($body);
$parameters['lineNumber'] = $this->from;
$parameters['sendDateTime'] = date("Y-m-d")."T".date("H:i:s");
$res =$client->SendMessageWithLineNumber($parameters);
return     $res; 
							                            
						break; 
						
						/////////////////////////////////////////////////////////sample///////////////////////////////
						  case 'smssample': 
						echo html_entity_decode($this->sms_sample);	                        
						break; 
						
						
						 ///////////////////////////////////end sample////////////////////////////////////////
						 
						 case 'payam-resan' :
								
			$client = new SoapClient('http://sms-webservice.ir/v1/v1.asmx?WSDL');
			
			$parameters['Username'] = $this->username;
			$parameters['PassWord'] =  $this->password;
			$parameters['SenderNumber'] = $this->from;
			$parameters['RecipientNumbers'] = array($to);
			$parameters['MessageBodie'] = $body;
			$parameters['Type'] = 1;
			$parameters['AllowedDelay'] = 0;
			
			$res = $client->SendMessage($parameters);                            
								   
      break;
						  case 'netpayamak': 
								$res = @file_get_contents("http://login.netpayamak.com/API/Sendsms.ashx?from=".$from."&to=".$to."&text=" . urlencode($body) . "&password=".$this->password."&username=".$this->username."");						 
	
								return     $res;                              
						break;   
						   case 'farapayamak': 
								 $sms_client= new SoapClient("http://87.107.121.52/post/send.asmx?wsdl");
								
									$parameters['username'] = $this->username;
									$parameters['password'] = $this->password;
									$parameters['to'] =array($to) ;
									$parameters['from'] = $this->from;
									$parameters['text'] =$body;
									$parameters['isflash'] =false;
									$parameters['udh'] ="";
									$parameters['recId'] =array(0);
									$parameters['status'] =0;
								
                                    $result = $sms_client->SendSms($parameters)->SendSmsResult;
									//print_r( $parameters );
									return     $result;
	            		break; 	
		
				   case 'mihansms': 
								 $sms_client=new nusoap_client('http://www.mihansmscenter.com/webservice/');	
							 $params = array(
								  
									'username'=>$this->username,
									'password'=>$this->password,
									 'to'=>$to,
									 'from'=> $this->from,
									 'text'=>$body,
									  'send_time'=> "",
									  'check_duplicate' => "",
									  ' udh' => ""
								);
							$res = $sms_client->call("send",  array(
																$this->username,
																 $this->password,
																 $to,
																 $body,
															   $this->from,
															   '',
															   '',
															   ''
																 )
																 );
			break; 												 
			case 'smscart' :
								
							$url = 'http://ir-payamak.com/sendsms.php';
						$fields_string="";
						$fields = array( 'programmer'=>"5",
						'username'=>$username,
						'password'=>$password,
						'from'=>$from,
						'to'=>$to,
						'text'=>$body,
						'isflash'=>"",
						'udh'=>""
						);
					foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
					rtrim($fields_string,'&');
					 
					//open connection
					$ch = curl_init();
					 
					//set the url, number of POST vars, POST data
							curl_setopt($ch,CURLOPT_URL,$url);
							curl_setopt($ch,CURLOPT_POST,count($fields));
							curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
					
					//$data_string = json_encode($input);                                     
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");   
							curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								
							//$smshare_headers = array("Accept" => "application/json", "Content-Type" => "application/json");
							curl_setopt($ch, CURLOPT_HTTPHEADER, array(        
								'Content-Type: application/json',              
								'Content-Length: ' . strlen($input))     
							);                                                 
																			  
					
					/////
					
					
					 
					//execute post
					$result = curl_exec($ch);
					 
					//close connection
					 
					curl_close($ch);
					
					 //$res = @file_get_contents("http://irsmspanel.com/post/sendSMS.ashx?from=". $from."&to=".$to."&text=" . urlencode( $body) . "&password=". $password."&username=".$username."");	                                 
					   
      break;
												 
		case 'hostiran'  :
					$options = array(
			'login' => $this->username,
			'password' => $this->password
			);
			$client = new SoapClient('http://sms.hostiran.net/webservice/?WSDL', $options);
			try
			{
				$messageId = $client->send($to,$body);
				//sleep(3);
				//print ($client->deliveryStatus($messageId));
				//var_dump($client->accountInfo());
			}
			catch (SoapFault $sf)
			{
				print $sf->faultcode."\n";
				print $sf->faultstring."\n";
			}
					
			break; 	
			}
	}
   
	////////////////////////////////////////////////send sms sabapayamak//////////////////////////////////////////////////////
	
	  private function SendSocketHTTP($page,$QueryString)
    {
        // init infos        
        // Build HTTP Header
        $header  = 'POST' . " " . $page . " HTTP/1.1\r\n";
        $header .= "Host: " . 'www.sabapayamak.com' . "\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " .strlen($QueryString) . "\r\n";
        $header .= "Connection: close\r\n\r\n";
        $header .= $QueryString . "\r\n";

        // Socket connection
        $socket = fsockopen( 'www.sabapayamak.com' , 80, $errno, $errstr);
      
        if($socket) // if we're connected
        {
            fputs($socket, $header); // Send header
            while(!feof($socket))
            {
                $response[] = fgets($socket); // Grab return codes
            }
            fclose($socket);
        }
        else
        {
            $response = false;
        }
        return ($response[10]);     
    }
		
		
		private	function Execute($url)         //Post a htttp request
		{
			if (($f = @fopen($url, 'r')))
			{
				$answer = fgets($f, 255);
				return $answer;
	
			}
			else
			{
				echo 'Error';
				return false;
			}
		}
		
		 
		private function BuildQS($args)
		{
			$qs = '';
			$countArgs = 1;
			foreach ($args as $key => $value)
			{
				$qs .= $key . '=' . $value;
				if ($countArgs < sizeof($args))
					$qs .= '&';
				$countArgs++;
			}
			return $qs;
		}
		
		
		
###########################################

#    Public Methodes                      #                 

###########################################
		public function AddRecipient($to)       //Ad a resipient number to _to array
		{
			array_push($this->_to, $to);
		}

		

	
	

	
	
	function smscredit($username,$password,$sms_getway,$from){
		 $this->password=$password;
	//$from=$this->config->get('config_sms_from');
	$this->from=$from;
	//$username=$this->config->get('config_sms_user');
	$this->username=$username;
	//$to=$this->session->data['to'];	
	
	$this->sms_getway=$sms_getway;
		
		switch ($this->sms_getway){ //switch
      case 'NovinPayamak':
     
			  $sms_client = new nusoap_client('http://www.novinpayamak.com/WebService/?wsdl', 'wsdl');
		
			$credit = $sms_client->call("CreditCheck", array(array('gateway_number' => $this->from, 'gateway_pass' => $this->password)));
			return $credit;
		
      case 'behinpayam': 
	  
       
	        return $res = " این وب سرویس امکان نمایش اعتبار را تدارد";
		
      case 'Panel2u': 
	  
	        return $res = " این وب سرویس امکان نمایش اعتبار را تدارد";
	  case 'Sabasms': 
	  
	     	$Qs= array(
			          'username' => $this->username,
					  'password' =>$this->password
					  );
			return $this->SendSocketHTTP('/Post/GetCredit.ashx',$this->BuildQS($Qs));
		case 'Lksms': 
	  
	    return $res = " این وب سرویس امکان نمایش اعتبار را تدارد";
		case 'irantc': 
	  
	        $client =new nusoap_client('http://webservice.iran.tc/');			
	        $credit = $client->call('CREDIT_LINESMS',
		                                 array(
		                              $username,
		                                $password,
		                                $from
		                                     )
		                                );
		
	      return $credit;
	case 'smscart': 
	  
	      return $res = " این وب سرویس امکان نمایش اعتبار را تدارد";
	case 'mihansms': 
	  
	  		         $client = new nusoap_client('http://www.mihansmscenter.com/webservice/');		
                     $credit = $client->call('accountInfo',
		                                 array(
		                                 $this->username,
		                                 $this->password,
		                              
		                                      )
		                                 );
		
	return $credit;
		
    }

		
	}
	
	
	

		public function setsms( $txtmsg, $shop = "", $url = "", $username = "", $password = "", $orderid = "",$status_order="" )
	{
		$txt = str_replace( "#shop#", $shop, $txtmsg );
		$txt = str_replace( "#url#", $url, $txt );
		$txt = str_replace( "#email#", $username, $txt );
		$txt = str_replace( "#pass#", $password, $txt );
		$txt = str_replace( "#ip#", $_SERVER['REMOTE_ADDR'], $txt );
		$txt = str_replace( "#orderid#", $orderid, $txt );
		$txt = str_replace( "#status_order#", $status_order, $txt );
		$txt = str_replace( "#nl#", "\r\n", $txt);
		return $txt;
	}
		public function setsmsorder( $txtmsg, $shop = "", $url = "", $username = "", $password = "", $orderid = "",$status_order="",$order_tedad="",$pro_name="",$pro_price="",$pro_total="",$pro_rah )
	{
		$txt = str_replace( "#shop#", $shop, $txtmsg );
		$txt = str_replace( "#url#", $url, $txt );
		$txt = str_replace( "#email#", $username, $txt );
		$txt = str_replace( "#pass#", $password, $txt );
		$txt = str_replace( "#ip#", $_SERVER['REMOTE_ADDR'], $txt );
		$txt = str_replace( "#orderid#", $orderid, $txt );
		$txt = str_replace( "#order_tedad#", $order_tedad, $txt );
		$txt = str_replace( "#pro_name#", $pro_name, $txt );
		$txt = str_replace( "#pro_price#", $pro_price, $txt );
		$txt = str_replace( "#pro_total#", $pro_total, $txt );
		$txt = str_replace( "#pro_rah#", $pro_rah, $txt );
		$txt = str_replace( "#status_order#", $status_order, $txt );
		$txt = str_replace( "#nl#", "\r\n", $txt);
		return $txt;
	}
	public function setsmspay( $txtmsg, $shop = "",  $telephone = "", $name = "", $amount = "",$bank="" ,$msg="",$rah="" )
	{
		$txt = str_replace( "#shop#", $shop, $txtmsg );
		$txt = str_replace( "#telephone#", $telephone, $txt );
		$txt = str_replace( "#name#", $name, $txt );
		$txt = str_replace( "#price_pay#", $amount, $txt );
		$txt = str_replace( "#bank#", $bank, $txt );
		$txt = str_replace( "#des_pay#", $msg, $txt );
		$txt = str_replace( "#order_rah#", $rah, $txt );
		return $txt;
	}
	public function setsmsverify($txtmsg, $verify="" )
	{
		$txt = str_replace( "#verify_code#", $verify,$txtmsg );
		return $txt;
	}

public function setusername($txtmsg, $username="" )
	{
		$txt = str_replace( "#username#", $username,$txtmsg );
		return $txt;
	}
	public function setsmsfish( $txtmsg, $shop = "",  $telephone = "", $name = "", $amount = "",$bank="" ,$msg="",$order_id )
	{
		$txt = str_replace( "#shop#", $shop, $txtmsg );
		$txt = str_replace( "#telephone#", $telephone, $txt );
		$txt = str_replace( "#name#", $name, $txt );
		$txt = str_replace( "#price_order#", $amount, $txt );
		$txt = str_replace( "#bank#", $bank, $txt );
		$txt = str_replace( "#des_fish#", $msg, $txt );
		$txt = str_replace( "#order_id#", $order_id, $txt );
		return $txt;
	}
		public function setsmsfish_edit( $txtmsg, $fish_id )
	{
		$txt = str_replace( "#shop#", $shop, $txtmsg );
		$txt = str_replace( "#telephone#", $telephone, $txt );
		$txt = str_replace( "#name#", $name, $txt );
		$txt = str_replace( "#price_order#", $amount, $txt );
		$txt = str_replace( "#bank#", $bank, $txt );
		$txt = str_replace( "#des_fish#", $msg, $txt );
		$txt = str_replace( "#order_id#", $order_id, $txt );
		return $txt;
	}
	
		public function setsmsletme($txtmsg, $product_name,$product_url )
	{
		$txt = str_replace( "#product_name#", $product_name, $txtmsg );
		$txt = str_replace( "#productLink#", $product_url, $txt );
		
		return $txt;
	}
			public function setsmsnewslater( $txtmsg, $mobile)
	{
		$txt = str_replace( "#mobile#", $mobile, $txtmsg );
	
		return $txt;
	}

	
  }
  
?>
