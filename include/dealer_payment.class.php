<?php
require_once("main.class.php");
require_once('class.system.php');
require_once('notification.class.php');
class DealerPayment extends Functions
{
	public $db;
	public $log;
	public $ctable="dealer_payment";
	public $payment_status=array("0"=>"Waiting For Approval","1"=>"Approved","2"=>"Rejected");
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;
		$this->objSystem = new System();
    } 
	
	function InsertDealerPayment($detail){
		extract($detail);
				if($emp_id!=""){
					$emp_name=$this->db->rp_getValue("emp_personal_info","first_name","id='".$emp_id."' AND isDelete=0");
				}else{
					$emp_name="";
				}
				
				$created_date		= date("Y-m-d H:i:s");
				$cdrow 	= array(
						"did",
						"emp_id",
						"emp_name",
						"bill_no",
						"current_amount",
						"bill_amount",
						"payment_by",
						"remark",
						"date",
						"reference_no",
						"created_date",							
						);
				$cdvalue = array(
						$did,
						$emp_id,
						$emp_name,
						$bill_no,
						round($current_amount),
						$bill_amount,
						$payment_by,
						$remark,
						date('Y-m-d',strtotime($date)),
						$reference_no,
						$created_date,					
						);
				$dealer_payment_id = $this->db->rp_insert("dealer_payment",$cdvalue,$cdrow,0);
				if($dealer_payment_id!=0){
					
					//Credit limit plus of dealer table
					
					$credit_limit=$this->db->rp_getValue("dealer","credit_limit","id='".$did."' AND isDelete=0",0);
					$credit_limit_new=$credit_limit+$current_amount;
					$isUpdated=$this->db->rp_update("dealer",array("credit_limit"=>$credit_limit_new),"id='".$did."' AND isDelete=0",0);
					
					
					//update sales invoice payment amount
					
					$sales_amount=$this->db->rp_getValue("sales_invoice_info","payment_receive_amount","did='".$did."' AND isDelete=0 AND sales_invoice_no='".$bill_no."'");
					
					$payment_amount=$sales_amount+$current_amount;
					
					$isPaymentUpdated=$this->db->rp_update("sales_invoice_info",array("payment_receive_amount"=>$payment_amount),"did='".$did."' AND isDelete=0 AND sales_invoice_no='".$bill_no."'");
					
										
					$reply=array("ack"=>1,"developer_msg"=>"Payment Add Sucessfully.","ack_msg"=>"Payment Add Sucessfully.");
					return $reply;
				}else{
					$reply=array("ack"=>0,"developer_msg"=>"Payment Add Failed.","ack_msg"=>"Payment Add Sucessfully.");
					return $reply;
				}
	}
	function getDealerPayment($did,$status)
	{
		$result = array();		
		if($did!="" && $status!="")
		{
		
			$data    = $this->db->rp_getData($this->ctable,"*","isDelete=0 AND did='".$did."' AND status='".$status."'","id DESC",0);
		}		
		
		if($data)
		{
			
			while($r= mysqli_fetch_assoc($data))
			{
				
				$r['status_slug']	= $this->payment_status[$r['status']];
				$r['date']	= date('d-m-Y',strtotime($r['date']));
				$r['created_date']	= date('d-m-Y',strtotime($r['created_date']));
				
				$result[] 			= $r;	
			}
			if(!empty($result))
			{
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_PAYMENT_LIST_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('DEALER_PAYMENT_LIST_GET_SUCESS'),"result"=>$result);
				return $reply;
			}
			else
			{
				
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_PAYMENT_LIST_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('DEALER_PAYMENT_LIST_GET_FAILED'));
				return $reply;
						
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('NO_DEALER_FOUND',1),"ack_msg"=>$this->log->getMessage('NO_DEALER_FOUND'));
			return $reply;
		}
	}
	public function ApproveDealerPayment($detail)
	{
		extract($detail);
		$rows 	= array(
			"status"	=> $isApprove
		);
		$where	= "id='".$detail['id']."'";
		$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
		
		$dealer_account_no=$this->db->rp_getValue("account_info","account_number","did='".$did."' AND isDelete=0",0);
		$aid=$this->db->rp_getValue("account_info","id","did='".$did."' AND isDelete=0",0);
		
		$row 	= array(
			"did",
			"aid",
			"bill_no",
			"dealer_account_no",
			"credit",
			"debit",
			"type",
			"entry_date",
			"add_date",
		);
		$value 	= array(
			$did,
			$aid,
			$bill_no,
			$dealer_account_no,
			$current_amount,
			"",
			"1",
			date('Y-m-d'),
			date('Y-m-d'),
		);
		$inserted_id=$this->db->rp_insert("dealer_account",$value,$row,0);
			if($uid!=0)
			{
				//send notification
				 
				 $detail['notification_title']="Approved Payment";
				 $detail['notification_type']="2";
				 $detail['notification_description']="your Payment is Apprvoed.";
				 $detail['did']=$did;
				 $this->objSystem->notificationInsert($detail);
					 
				$reply=array("ack"=>1,"developer_msg"=>"Dealer Payment Apprvoed Sucessfully.","ack_msg"=>"Dealer Payment Apprvoed Sucessfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Dealer Payment Apprvoed Failed.","ack_msg"=>"Dealer Payment Apprvoed Failed.");
				return $reply;
			}
	}
	public function RejectDealerPayment($detail)
	{
		extract($detail);
		$rows 	= array(
			"status"	=> $rejected
		);
			$where	= "id='".$id."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
			
			if($uid!=0)
			{
				//Credit limit plus of dealer table
					
					$remaining_credit_limit=$this->db->rp_getValue("dealer","remaining_credit_limit","id='".$did."' AND isDelete=0");
					$credit_limit_new=$remaining_credit_limit+$current_amount;
					$isUpdated=$this->db->rp_update("dealer",array("remaining_credit_limit"=>$credit_limit_new),"id='".$did."' AND isDelete=0");
					
					//Add Payment Amount of dispatch_info table
					
					//	$dispatch_total_amount=$db->rp_getValue("dispatch_info","dispatch_total_amount","dispatch_did='".$did."' AND isDelete=0 AND dispatch_no='".$bill_no."'");
					//$dispatch_remaining_payment=$dispatch_total_amount-$current_amount;
					
					$invoice_amount=$this->db->rp_getValue("sales_invoice_info","grand_total","did='".$did."' AND isDelete=0 AND sales_invoice_no='".$bill_no."'");
					
					$payment_receive_amount=$this->db->rp_getValue("sales_invoice_info","payment_receive_amount","did='".$did."' AND isDelete=0 AND sales_invoice_no='".$bill_no."'");
					
					$remaing_payment_amount=$payment_receive_amount-$current_amount;
					
					$isDispatchUpdated=$this->db->rp_update("sales_invoice_info",array("payment_receive_amount"=>$remaing_payment_amount),"did='".$did."' AND isDelete=0 AND sales_invoice_no='".$bill_no."'");
					
					//send notification
				 
				 $detail['notification_title']="Rejected Payment";
				 $detail['notification_type']="2";
				 $detail['notification_description']="your Payment is Rejected.";
				 $detail['did']=$did;
				 $this->objSystem->notificationInsert($detail);
				
				
				$reply=array("ack"=>1,"developer_msg"=>"Dealer Payment Rejected Sucessfully.","ack_msg"=>"Dealer Payment Rejected Sucessfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Dealer Payment Rejected Failed.","ack_msg"=>"Dealer Payment Rejected Failed.");
				return $reply;
			}
	}
	function GetInvoice($did)
	{
		
		$result = array();		
		if($did!="")
		{
		
			$data    = $this->db->rp_getData("sales_invoice_info","sales_invoice_no,grand_total,payment_receive_amount","isDelete=0 AND did='".$did."'","id DESC");
		}		
		
		if($data)
		{
			
			while($r= mysqli_fetch_assoc($data))
			{
				if($r['grand_total']!=$r['payment_receive_amount']){
					
				
				$pay_amount=$r['grand_total']-$r['payment_receive_amount'];
				$r['grand_total'] 	= round($pay_amount,2);	
				$result[] 			= $r;	
				}
			}
			if(!empty($result))
			{
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('INVOICE_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('INVOICE_GET_SUCESS'),"result"=>$result);
				return $reply;
			}
			else
			{
				
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INVOICE_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('INVOICE_GET_FAILED'));
				return $reply;
						
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('NO_DEALER_FOUND',1),"ack_msg"=>$this->log->getMessage('NO_DEALER_FOUND'));
			return $reply;
		}
	}
	function salesSendOTP($detail)
    {
		if(!empty($detail))
        {
           
				$phone=$this->db->rp_getValue("emp_personal_info","phone","id='".$detail['sales_id']."' AND isDelete=0 AND isActive=1",0);
			   
				if($phone)
				{
					$otp=$this->sendOTPToContactNumber($phone);
					$date=date("Y-m-d H:i:s");
					$values=array("otp"=>$otp);
					$this->db->rp_update("emp_personal_info",$values,"phone='".$phone."'",0);

					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('OTP_SEND_SUCESS',1),"ack_msg"=>$this->log->getMessage('OTP_SEND_SUCESS'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('OTP_SEND_FAILED',1),"ack_msg"=>$this->log->getMessage('OTP_SEND_FAILED'));
					return $reply;
				}
        }
        else
        {
            $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('SALES_ID_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('SALES_ID_NOT_FOUND'));
            return $reply;
        }
    }
	function sendOTPToContactNumber($phone)
	{
		if($phone!="")
		{
			
					$activationCode=$this->generateActivationCode();
					// Detail of normal user
					$where=" phone='".$phone."'";
					$values=array("otp"=>$activationCode);			
				    $registerd_user_id=$this->rp_update("emp_personal_info",$values,$where,0);
					if($registerd_user_id!=0)
					{
						$name=$this->rp_getValue("emp_personal_info","first_name",$where,0);
						$reply=$this->aj_sendSecurityCode($name,$phone,$activationCode);
						return $reply;
					}				
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INTERNAL_ERROR_SERVICE',1),"ack_msg"=>$this->log->getMessage('INTERNAL_ERROR_SERVICE'));
						return $reply;
					}				
				
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'));
			return $reply;
		}
	}
	function generateActivationCode()
	{
		$characters='0123456789';
		$randStr="";
		for($i=0;$i<=5;$i++)
		{
			$randStr=$randStr.$characters[rand(0,strlen($characters)-1)];
		}
		return $randStr;
	}
	function aj_sendSecurityCode($email,$number,$activationCode)
	{
		$nt = new Notification();	
		$sms = $activationCode." is your ".SITENAME." security code";
		$msgId="NO";
		if($number!="")
		{
			$msgId=$nt->rp_checkSMS($number,$sms);	
		}
		return array('ack'=>1,'status'=>"msgId".$msgId."&email=".$email);
	}
}

?>