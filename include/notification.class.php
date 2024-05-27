<?php
include("class.phpmailer.php");
class Notification extends Functions
{
	/*
		*** Notification Function Developed By Jai Acharya :/ <<<
	*/
	private $mailer;
	private $mailer2;
	private $log;
	public $CtableEmail="email";
	function __construct() {
		$this->mailer = new PHPMailer();
		$this->mailer2 = new PHPMailer();
		$this->log=new Log();
	}
	public function rp_checkSMS($n,$sms) // Common SMS Function
    {
		$smsMsg = urlencode($sms);
		$apiurl = SMS_URL."&mobile=+91".$n."&message=".$smsMsg;
		return file_get_contents($apiurl);
    }
	public function sendSMS($n,$sms) // Common SMS Function
    {				
		$smsTo 	= $n;		
		$apiurl =SMS_URL."&mobile=+91".$smsTo."&message=".urlencode($sms);
		//$replyString = file_get_contents($apiurl);
		$replyString=" SMS off";
		$reply=explode(",",$replyString);
		$this->log->addSMSLog($smsTo,$sms,"".$replyString);
		return 1;
		if(preg_replace('/\s+/', '', $reply[1])=="success")
		{			
			// Message Sent Successfully 
			
			return 1;
		}
		else
		{	
			$this->log->addSMSLog($smsTo,$sms,$replyString);
			return 0;
		}	
    }
    public function rp_sendGenEmail($toemail,$subject="",$body="",$new_file_name="",$uploaded_file_path="") // Common Email Function
    {
		
		$from_name = SITETITLE;
		$from_mail = MAIL_FROM;
		//$mail = new PHPMailer();
		
		$this->mailer->SetFrom($from_mail,$from_name); // From email ID and from name
		$this->mailer->AddAddress($toemail);
		$this->mailer->AddAddress(MAIL_BCC);
		$this->mailer->AddAddress(MAIL_CC);		
		$this->mailer->AddReplyTo(MAIL_REPLY_TO, MAIL_FROM);
		$this->mailer->Subject = $subject;
		$this->mailer->MsgHTML($body);
		if($new_file_name!="" && $uploaded_file_path!=""){
			$this->mailer->AddAttachment($uploaded_file_path,$new_file_name);
		}
		$this->mailer->Send();
		return true;
    }
	public function rp_sendEmail($toemail,$subject="",$body="",$cc="",$files=array()) // Common Email Function
    {
		$from_name = EMAIL_FROM_NAME;
		$from_mail = EMAIL_FROM_MAIL;
		$this->mailer2->SetFrom($from_mail,$from_name); // From email ID and from name
		$this->mailer2->AddAddress(stripslashes($toemail));//$toemail
		$this->mailer2->AddAddress(EMAIL_CC);//$toemail		
		// Multiple Email In BCC
		$bcc=EMAIL_BCC;
		$this->mailer2->AddAddress($bcc);
		if($cc!="")
		{
			$this->mailer2->AddAddress($cc);	
			$this->mailer2->AddReplyTo($cc, EMAIL_FROM_MAIL);
		}
		else
		{			
			$this->mailer2->AddReplyTo(EMAIL_REPLY_TO, EMAIL_FROM_NAME);
		}
		$this->mailer2->Subject = $subject;
		$this->mailer2->MsgHTML($body);
		$this->mailer2->SMTPSecure = 'ssl';
		if(!empty($files)){
			foreach($files as $file)
			{
				$this->mailer2->AddAttachment($file['upload_file_path'],$file['new_file_path']);
			
			}
			
		}
		$result=$this->mailer2->Send();
		$this->log->addEmailLog($toemail,$subject." ".$result,$body,implode(",",$files),EMAIL_FROM_MAIL,EMAIL_FROM_NAME,date("Y-m-d H:i:s"));
		return $result;
    }
	
	public function aj_sendSecurityCode($toemail,$subject="",$body="") // Common Email Function
    {
		$from_name = EMAIL_FROM_NAME;
		$from_mail = EMAIL_FROM_MAIL;			
		$body = $body;
		$mail32 = new PHPMailer();
		$mail32->SetFrom($from_mail,$from_name); // From email ID and from name
		$mail32->AddAddress(stripslashes($toemail));
		$mail32->Subject = $subject;
		$mail32->MsgHTML($body);
		$mail32->Send();
		/*****************************************/
		
    }
	public function aj_sendSMSSecurity($n,$sms) // Common SMS Function
    {				
		$smsTo 	= $n;		
		$apiurl =SMS_URL."&mobile=+91".$smsTo."&message=".urlencode($sms);
		$msg_id = file_get_contents($apiurl);
		return $msg_id;
    }
	public function rp_getDeliveryReport($messageId) // Common SMS Function
    {		
		$apiurl = SMS_URL."&messageid=".urlencode($messageId);
		$delivery_report_string= file_get_contents($apiurl);
		$delivery_report=explode(",",$delivery_report_string);
		if($delivery_report[4]=='DELIV')
		{
			$ack=array("ack"=>1,"ack_msg"=>"SMS sent successfully on".$delivery_report[0],"extra"=>$delivery_report);
			
		}
		else if($delivery_report[4]=='EXPIRED')
		{
			$ack=array("ack"=>0,"ack_msg"=>"SMS sending failed on".$delivery_report[0],"reason"=>"Mobile switched off or out of coverage area!!","extra"=>$delivery_report);
		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"SMS sending failed on".$delivery_report[0],"reason"=>"Mobile number not available","extra"=>$delivery_report);
		}
		return $ack;
    }
	public function getEmailBody($EMAIL_TYPE,$params)
	{
		
		switch($EMAIL_TYPE)
		{
			case "FORGET_PASSWORD":
			$url=ADMINSITEURL."email_body/email_template.php?name=".urlencode($params['name'])."&email=".urlencode($params['email'])."&activation_code=".urlencode($params['activation_code']);
			$body=file_get_contents($url);
			$subject="Forget Password For ".SITETITLE;
			return array("body"=>$body,"subject"=>$subject);
			break;			
		}
	}
	public function sendNotification($data, $ids ,$type)
	{
		//print_r($data);exit;
		$apiKey = 'AIzaSyDUcz71FakhhQhNPwiNXLy5-j2mx-lDITI';
		$url = 'https://android.googleapis.com/gcm/send';
		$post = array(
						'registration_ids'  => $ids,
						'data'              => $data,
						);
	
		$headers = array( 
							'Authorization: key=' . $apiKey,
							'Content-Type: application/json'
						);
	
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);//////// SSL Verifier False ////////
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );
		$result = curl_exec( $ch );
		curl_close( $ch );
		$this->log->addFirebaseLog($apiKey,$url,$data,$ids,$result);
		return $result;
	}	

	public function ComposeEmail($detail)
	{
		if(!empty($detail))
		{
			$detail['created_date']=date("Y-m-d H:i:s");
			

			$from_name = $detail['from_name'];
			$from_mail = $detail['from_email'];			
			$body = $body;
			$mail32 = new PHPMailer();
			$mail32->SetFrom($from_mail,$from_name); // From email ID and from name
			foreach($detail['recipient'] as $R)
			{
				$mail32->AddAddress(stripslashes($R));
			}
			$mail32->AddAddress(stripslashes(System::$Settings['default_cc']));
			$mail32->AddAddress(stripslashes(System::$Settings['default_bcc']));
			$this->mailer2->AddReplyTo(System::$Settings['from_email'], System::$Settings['from_name']);

			$mail32->Subject = $detail['subject'] ;
			$mail32->MsgHTML($detail['message'] );
			$mail32->Send();

			$detail['recipient']=implode(",",$detail['recipient']);
			$columns=array_keys($detail);
			$values=array_values($detail);
			$this->rp_insert($this->CtableEmail,$values,$columns,0);

			$reply=array('ack'=>1,"ack_msg"=>"Email Sent Successfully!!");
		}
		else
		{
			$reply=array('ack'=>0,"ack_msg"=>"Details not valid try again");
		}
		return $reply;
	}
	function addNotification($detail){
		//print_r($detail); exit;
		extract($detail);
		$rows=array(
			"user_id",
			"user_type",
			"type_slug",
			"notification_type",
			"notification_title",
			"notification_description",
			"respective_date",
			"reference_id",
			"reference_type",
			"created_date",
			);
		$values=array(
			$user_id,
			$user_type,
			$type_slug,
			$notification_type,
			$notification_title,
			$notification_description,
			$respective_date,
			$reference_id,
			$reference_type,
			date('Y-m-d H:i:s'),
			);
		$notification_id=$this->rp_insert("notification_executive",$values,$rows,0);
		if($notification_id!=0){


			$no_details=$this->rp_getData("notification_executive","*","id='".$notification_id."'");
			if($no_details){
				$no_details=mysqli_fetch_assoc($no_details);
				$notification_data=$no_details;
			}
			$data=$notification_data;
			$refresh_tokens=false;
			if($type_slug=='all')
			{
				$refresh_tokens=$this->rp_getData("refresh_token_executive","refresh_token","","",0);
			}
			else if($type_slug=='employee')
			{
				$refresh_tokens=$this->rp_getData("refresh_token_executive","refresh_token","user_id='".$user_id."'","",0);
			}
			
				if($refresh_tokens){
					$tokens=array();
					while($refresh_token=mysqli_fetch_assoc($refresh_tokens)){
						$tokens[]=$refresh_token['refresh_token'];
					}
					$result=$this->send_notification($data,$tokens,1);
				}
			$reply=array('ack'=>1,"ack_msg"=>"Notification inserted successfully");
		}else{
			$reply=array('ack'=>0,"ack_msg"=>"Notification inserted failed try again");
		}
		return $reply;
	}
	
	function addCustomerNotification($detail){
		extract($detail);

		if(isset($customers) && empty($customers) || in_array(-1, $customers))
		{
			$rows=array(
				"user_id",
				"user_type",
				"type_slug",
				"notification_type",
				"notification_title",
				"notification_description",
				"respective_date",
				"reference_id",
				"reference_type",
				"created_date",
				);
			$values=array(
				$user_id,
				$user_type,
				$type_slug,
				$notification_type,
				$notification_title,
				$notification_description,
				$respective_date,
				$reference_id,
				$reference_type,
				date('Y-m-d H:i:s'),
				);
			$notification_id=$this->rp_insert("notification_customer",$values,$rows,0);
			if($notification_id!=0){
				$no_details=$this->rp_getData("notification_customer","*","id='".$notification_id."'");
				if($no_details){
					$no_details=mysqli_fetch_assoc($no_details);
					$notification_data=$no_details;
				}
				$data=$notification_data;
				if($user_id!=0)
				{
					$refresh_tokens=$this->rp_getData("refresh_token_customer","refresh_token","user_id='".$user_id."'","",0);
				}
				else
				{
					$refresh_tokens=$this->rp_getData("refresh_token_customer","refresh_token","","",0);
				}
				
				
					if($refresh_tokens){
						$tokens=array();
						while($refresh_token=mysqli_fetch_assoc($refresh_tokens)){
							$tokens[]=$refresh_token['refresh_token'];
						}
						
						$result=$this->send_notification($data,$tokens,2);
					}
				$reply=array('ack'=>1,"ack_msg"=>"Notification inserted successfully");
			}else{
				$reply=array('ack'=>0,"ack_msg"=>"Notification inserted failed try again");
			}

		}
		else
		{
			foreach($customers as $c)
			{
				$type_slug='customer';
				$user_type='1';
				$user_id=$c;
				$rows=array(
					"user_id",
					"user_type",
					"type_slug",
					"notification_type",
					"notification_title",
					"notification_description",
					"respective_date",
					"reference_id",
					"reference_type",
					"created_date",
					);
				$values=array(
					$user_id,
					$user_type,
					$type_slug,
					$notification_type,
					$notification_title,
					$notification_description,
					$respective_date,
					$reference_id,
					$reference_type,
					date('Y-m-d H:i:s'),
					);
				$notification_id=$this->rp_insert("notification_customer",$values,$rows,0);
			}
			
			
			$data=array(
				"user_id"=>0,
				"user_type"=>$user_type,
				"type_slug"=>$type_slug,
				"notification_type"=>$notification_type,
				"notification_title"=>$notification_title,
				"notification_description"=>$notification_description,
				"respective_date"=>$respective_date,
				"reference_id"=>$reference_id,
				"reference_type"=>$reference_type,
				"created_date"=>date('Y-m-d H:i:s'),
				
				);
				$refresh_tokens=$this->rp_getData("refresh_token_customer","refresh_token","user_id IN (".implode(",",$customers).")","",0);
				if($refresh_tokens){
					$tokens=array();
					while($refresh_token=mysqli_fetch_assoc($refresh_tokens)){
						$tokens[]=$refresh_token['refresh_token'];
					}
					
					$result=$this->send_notification($data,$tokens,2);
				}
			$reply=array('ack'=>1,"ack_msg"=>"Notification inserted successfully");
			
		}
		
		return $reply;
	}
	

	public function GetNotificationTitle($Type,$Parmas)
	{
		if($Type=='ORDER_CREATE')
		{
			$title="Order ".$Parmas['order_no']." Generated By Customer ".$Parmas['customer_name'].".";
		}
		else if($Type=='ORDER_ACCEPT')
		{
			$title="Order ".$Parmas['order_no']." approved.";
		}
		else if($Type=='ORDER_REJECT')
		{
			$title="Order ".$Parmas['order_no']." disapproved.";
		}
		else if($Type=='ORDER_DISPATCHED')
		{
			$title="Order ".$Parmas['order_no']." dispatched.";
		}
		else if($Type=='ORDER_DISPATCHED_EMPLOYEE')
		{
			$title="Order ".$Parmas['order_no']." available for delivery.";
		}
		else if($Type=='ORDER_CANCELLED')
		{
			$title="Order ".$Parmas['order_no']." cancelled.";
		}
		else if($Type=='NEW_MESSAGE')
		{
			$title="Reply for Ticket#".$Parmas['chat_room_id'];
		}
		else if($Type=='SALES_REPO_VISIT_ADMIN')
		{
			$title="Executive ".$Parmas['emp_name']." visited ".$Parmas['customer_name'];
		}
		else if($Type=='PAYMENT_DUE')
		{
			$title="Dear ".$Parmas['customer_name']." your account due on payment ";
		}
		else if($Type=='ACCOUNT_STATMENT')
		{
			$title="Dear ".$Parmas['customer_name']." your weekly account statement ready";
		}
		
		return $title;
	}

	public function GetNotificationDescription($Type,$Parmas)
	{
		if($Type=='ORDER_CREATE')
		{
			$title="Order ".$Parmas['order_no']." Generated By Customer ".$Parmas['customer_name']." of value ".$Parmas['order_grand_total'].".";
		}
		else if($Type=='ORDER_ACCEPT')
		{
			$title="Order ".$Parmas['order_no']." of ".CURR.$Parmas['order_grand_total']."  approved.";
		}
		else if($Type=='ORDER_REJECT')
		{
			$title="Order ".$Parmas['order_no']." disapproved. For more information contact administrator";
		}
		else if($Type=='ORDER_DISPATCHED')
		{
			$title="Order ".$Parmas['order_no']." dispatched.";
		}
		else if($Type=='ORDER_DISPATCHED_EMPLOYEE')
		{
			$title="Order ".$Parmas['order_no']." available for delivery on address ".$Parmas['dispatch_billing_address'];
		}
		else if($Type=='ORDER_CANCELLED')
		{
			$title="Order ".$Parmas['order_no']." cancelled.";
		}
		else if($Type=='NEW_MESSAGE')
		{
			$title="Ticket#".$Parmas['chat_room_id']."<br/>".$Parmas['message'];
		}
		else if($Type=='SALES_REPO_VISIT_ADMIN')
		{
			$title="Executive ".$Parmas['emp_name']." visited ".$Parmas['customer_name']." on ".$Parmas['date'];
		}
		else if($Type=='PAYMENT_DUE')
		{
			$title="Dear ".$Parmas['customer_name']." your account due on payment of amount ".$Parmas['due_amount']." kindly pay to continue service.";
		}
		else if($Type=='ACCOUNT_STATMENT')
		{
			$title="Dear ".$Parmas['customer_name']." your account statement from ".$Parmas['from_date']." to ".$Parmas['to_date']." ready click below to download it.<br/><a href='".$Parmas['link']."'> Download</a>";
		}
		

		return $title;
	}
}
?>