<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.log.php");
class Dealer extends Functions
{
	public $db;
	public $log;
	public $ctable="dealer";
	
	public $id='';public $name='';public $email='';public $password='';public $phone='';public $address='';public $isVarified='';public $isActive='';
    public $valid_keys=array("id","phone","imei","refreshToken","otp","last_login");
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;	
		$log	= new Log();
		$this->log=$log;	
    } 
	 public function InsertDealer($detail) 
	 {
		extract($detail);
		$dup_where = "phone = '".$phone."' AND isDelete=0 AND isActive=1";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where);
		if($credit_limit<0)
		{
			$reply=array("ack"=>0,"developer_msg"=>"Credit Limit is not less than Zero","ack_msg"=>"Credit Limit Not Less Than Zero!!");
			return $reply;
		}
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate Sales Executive","ack_msg"=>"Already Exist this Mobile Number!!");
			return $reply;
		}
		else
		{
			
			$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"person_name",
						"company_name",
						"phone",
						"landline",
						"pan_no",
						"gst_no",
						"pincode",
						"address",
						"country",
						"state",
						"city",
						"credit_limit",
						"remaining_credit_limit",
						"created_date",
					);
			$values = array(
						$person_name,
						$company_name,
						$phone,
						$landline,
						$pan_no,
						$gst_no,
						$pincode,
						html_entity_decode($address),
						$country,
						$state,
						$city,
						$credit_limit,
						$credit_limit,
						$adate,
					);
					
		 	$dealer_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$dealer_id,"insert",$this->log->slm['DEALER_INSERT']." : ".$dealer_id);
			if($dealer_id!=0)
			{
				
				$last_account_id=$this->db->rp_getValue("account_info","MAX(id)","isDelete=0",0);
														
				$last_account_no=$this->db->rp_getValue("account_info","account_number","id=".$last_account_id."",0);
				
				if($last_account_no=="")
				{
					$last_account_no="0001";
				}
				else
				{
					 $last_account_no=str_pad($last_account_no+1, 4, 0, STR_PAD_LEFT);
					
				}
				
				$rows 	= array(
						"account_number",
						"did",
						"dealer_name",
						"add_date",
					);
				$values = array(
						$last_account_no,
						$dealer_id,
						$person_name,
						$adate,
					);
					
				$account_info_id = $this->db->rp_insert("account_info",$values,$rows,0);
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_INSERT',1),"ack_msg"=>$this->log->getMessage('DEALER_INSERT'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Dealer Not Inserted.");
				return $reply;
			}
		}
	 }
	public function UpdateDealer($detail)
	  {
		 
			extract($detail);
			$dup_where = "phone = '".$phone."' AND id!='".$id."' AND isDelete=0 AND isActive=1";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>"Duplicate Sales Executive","ack_msg"=>"Already Exist this Mobile Number!!","id"=>$id);
				return $reply;
				
			}
			if($credit_limit<0)
			{
				$reply=array("ack"=>0,"developer_msg"=>"Credit Limit must be positive number","ack_msg"=>"Credit Limit must be positive number!!","id"=>$id);
				return $reply;
			}
			else{
				$old_credit_limit = $this->db->rp_getValue("dealer","credit_limit","id='".$id."'");
				$old_remaining_credit_limit = $this->db->rp_getValue("dealer","remaining_credit_limit","id='".$id."'");
				
				$difference_of_credit=$credit_limit-$old_credit_limit;
				$new_remaining_credit_limit=$old_remaining_credit_limit+$difference_of_credit;
				if($new_remaining_credit_limit<0)
				{
					$available_credit=$credit_limit+abs($new_remaining_credit_limit);
					$reply=array("ack"=>0,"ack_msg"=>"You could not enter less than ".$available_credit,"developer_msg"=>"You could not enter less than ".$available_credit,"id"=>$id);
					return $reply;
				}
				
				
				$created_date=date('Y-m-d H:i:s');
				$rows 	= array(
							"person_name"	=> $person_name,
							"company_name"	=> $company_name,
							"phone"	=> $phone,
							"pan_no"	=> $pan_no,
							"gst_no"	=> $gst_no,
							"pincode"	=> $pincode,
							"credit_limit"	=> $credit_limit,
							"remaining_credit_limit" => $new_remaining_credit_limit,
							"landline"	=> $landline,
							"address"	=> html_entity_decode($address),
							"country"			=> $country,
							"state"			=> $state,	
							"city"			=> $city,
							"created_date"			=> $created_date,
						);
				$where	= "id='".$id."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$id,"update",$this->log->slm['DEALER_UPDATE']." : ".$person_name);
				$user_detail=$this->getDealerDetail($uid);
						
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_UPDATE',1),"ack_msg"=>$this->log->getMessage('DEALER_UPDATE'),"result"=>$user_detail['result']);
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Update Failed.","id"=>$id);
					return $reply;
				}
			}	
		}
	public function UpdateDealerService($detail)
	  {
			extract($detail);
			$dup_where = "phone = '".$phone."' AND id!='".$id."' AND isDelete=0 AND isActive=1";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
			if($credit_limit<0)
			{
				$reply=array("ack"=>0,"developer_msg"=>"Credit Limit is not less than Zero","ack_msg"=>"Credit Limit Not Less Than Zero!!","id"=>$id);
				return $reply;
			}
			if($r){
				$reply=array("ack"=>0,"developer_msg"=>"Duplicate Sales Executive","ack_msg"=>"Already Exist this Mobile Number!!","id"=>$id);
			return $reply;
				
			}else{
				$credit_limit=$this->db->postiveNumber($credit_limit);
				$created_date=date('Y-m-d H:i:s');
				$rows 	= array(
							"person_name"	=> $person_name,
							"company_name"	=> $company_name,
							"phone"	=> $phone,
							"pan_no"	=> $pan_no,
							"gst_no"	=> $gst_no,
							"pincode"	=> $pincode,
							"landline"	=> $landline,
							"address"	=>$this->db->clean($address),
							"state"			=> $state,	
							"city"			=> $city,
							"created_date"			=> $created_date,
						);
				$where	= "id='".$id."'";
				$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$id,"update",$this->log->slm['DEALER_UPDATE']." : ".$person_name);
				$user_detail=$this->getDealerDetail($id);
						
				if($uid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_UPDATE',1),"ack_msg"=>$this->log->getMessage('DEALER_UPDATE'),"result"=>$user_detail['result']);
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Update Failed.");
					return $reply;
				}
			}	
		}		
	public function DealerGetEditData($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0 AND isActive=1";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		$result['person_name']		= htmlentities($ctable_d['person_name']);
		$result['company_name']		= htmlentities($ctable_d['company_name']);
		$result['phone']		= htmlentities($ctable_d['phone']);
		$result['landline']		= htmlentities($ctable_d['landline']);
		$result['pan_no']		= htmlentities($ctable_d['pan_no']);
		$result['pincode']		= htmlentities($ctable_d['pincode']);
		$result['gst_no']		= htmlentities($ctable_d['gst_no']);
		$result['credit_limit']	= htmlentities($ctable_d['credit_limit']);
		$result['address']	= strip_tags($ctable_d['address']);
		$result['country']	= htmlentities($ctable_d['country']);
		$result['state']		= stripslashes($ctable_d['state']);
		$result['city']			= stripslashes($ctable_d['city']);
		
		$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Dealer Detail Fetched Successfully.","result"=>$result);
		return $reply;
	
	}
	
	public function DealerDelete($detail)
	{
		$dealer_name=$this->db->rp_getValue($this->ctable,"person_name","isDelete=0 AND id='".$detail['id']."' AND isActive=1");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['DEALER_DELETE']." : ".$dealer_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_DELETE',1),"ack_msg"=>$this->log->getMessage('DEALER_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete record Failed.");
				return $reply;
			}
	}
	public function DealerActive($detail)
	{
		$dealer_name=$this->db->rp_getValue($this->ctable,"person_name","isDelete=0 AND isActive=1 AND id='".$detail['id']."'");
		$rows 	= array(
		"isActive"	=> $detail['status']
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['DEALER_ACTIVE']." : ".$dealer_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_ACTIVE',1),"ack_msg"=>$this->log->getMessage('DEALER_ACTIVE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete record Failed.");
				return $reply;
			}
	}
	
	function validateKey($detail)
    {
        $error=array();
        foreach($detail as $key=>$value)
        {
            if(!in_array($key,$this->valid_keys))
            {
                $error[]=$key;
            }
        }

        if(empty($error))
        {
            $result=array("ack"=>1);
            return $result;
        }
        else
        {
            $result=array("ack"=>0,"error"=>$error);
            return $result;
        }
    }
	 function validateDetail($detail,$validateKey)
    {
        $isValid=true;
        $result=array("invalid"=>array());
                
        // Password Validation
        //$detail['password']="";
        if(array_key_exists("password",$this->valid_keys) && !array_key_exists("password",$detail) && strlen($detail['password'])>0)
        {
            $result['invalid']['password']="Password must be entered.";
            $isValid=false;
        }

        // Phone Validation
        if(array_key_exists("phone",$this->valid_keys) && !array_key_exists("phone",$detail) && strlen($detail['phone'])==10)
        {
            $result['invalid']['phone']="Contact number must be 10 digit.";
            $isValid=false;
        }

        if($isValid)
        {
            return array("ack"=>1);
        }
        else
        {
            $result['ack']=0;
            return $result;
        }

    }

	function loginDealer($detail)
    {
		if(!empty($detail))
        {
            $isValid=$this->validateKey($detail,array("phone"));
			if($isValid['ack']==1)
            {
                $countFromphone=$this->countDealer("phone",$detail['phone']);
                if($countFromphone>=1)
                {
                    $count=$this->db->rp_getTotalRecord($this->ctable,"phone='".$detail['phone']."' AND isDelete=0 AND isActive=1",0);
                    $registerd_user_id=$this->db->rp_getValue($this->ctable,"id","phone='".$detail['phone']."' AND isDelete=0 AND isActive=1",0);
                   
					if($count==1)
					{
						
						$otp=$this->sendOTPToContactNumber($detail['phone']);
						$date=date("Y-m-d H:i:s");
						$values=array("otp"=>$otp,"imei"=>$detail['imei'],"refreshToken"=>$detail['refreshToken'],"last_login"=>$date);
						$this->db->rp_update($this->ctable,$values,"phone='".$detail['phone']."'",0);

						$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_SUCESS',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_SUCESS'));
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_FAILED',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_FAILED'));
						return $reply;
					}
                    
                }
                else
                {
                    $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_REGISTERED',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_REGISTERED'),"invalid_field"=>$isValid['invalid']);
                    return $reply;
                }
            }
            else
            {
                $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID'),"invalid_field"=>$isValid['invalid']);
                return $reply;
            }
        }
        else
        {
            $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'));
            return $reply;
        }
    }
   
	function verifyOTP($detail)
	{
		if(!empty($detail))
		{
			$countFromPhone=$this->countDealer("phone",$detail['phone']);
			if($countFromPhone>=1)
			{
			
				$isValid=$this->validateDetail($detail,array("phone"));
				if($isValid['ack']==1)
				{
					$count=$this->db->rp_getTotalRecord($this->ctable,"phone='".$detail['phone']."' AND otp='".$detail['otp']."' AND isDelete=0 AND isActive=1",0);
					if($count>0)
					{
						$values=array("refreshToken"=>$detail['refreshToken'],"isVerified"=>1);
					    $isUpdated=$this->rp_update($this->ctable,$values,"phone='".$detail['phone']."' AND isDelete=0 AND isActive=1",0);

						$registerd_user_id=$this->db->rp_getValue($this->ctable,"id","phone='".$detail['phone']."' AND isDelete=0 AND isActive=1 AND isVerified=1",0);
						$user_detail=$this->getDealerDetail($registerd_user_id);
						$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_VERIFY_OTP_SUCESS',1),"ack_msg"=>$this->log->getMessage('DEALER_VERIFY_OTP_SUCESS'),"result"=>$user_detail['result']);
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_VERIFY_OTP_FAILED',1),"ack_msg"=>$this->log->getMessage('DEALER_VERIFY_OTP_FAILED'));
						return $reply;
					}
						
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID'),"invalid_field"=>$isValid['invalid']);
					return $reply;
				}
			
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_REGISTERED',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_REGISTERED'));
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'));
		}
	}
	function ResendOTP($detail)
	{
		if(!empty($detail))
		{
			$countFromPhone=$this->countDealer("phone",$detail['phone']);
			
			if($countFromPhone>=1)
			{
				$isValid=$this->validateDetail($detail,array("phone"));
				if($isValid['ack']==1)
				{
					
					return $reply=$this->sendOTPToContactNumber($detail['phone']);
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID'),"invalid_field"=>$isValid['invalid']);
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_REGISTERED',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_REGISTERED'));
				return $reply;
			}
				
			
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'));
		}
	}
	function getDealerDetail($user_id=0,$required_columns=array(),$isUserChannelRequired=false,$isFollowingChannelRequired=false)
    {
        $required_columns=$this->getRequiredColumns($required_columns);
        if($user_id!=0)
        {
            $where="id='".$user_id."' AND isDelete=0 AND isActive=1";
            $result=$this->rp_getData($this->ctable,$required_columns,$where,"",0);
            if($result)
            {


                $detail=mysqli_fetch_assoc($result);
               
                $reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'),"result"=>$detail);
                return $reply;
            }
            else
            {
                $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'));
                return $reply;
            }
        }
        else
        {
            $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'));
            return $reply;
        }
    }
    function DealerAccountInfo($detail)
	{
		 $countDealer=$this->countDealer("id",$detail['did']);
         if($countDealer >0){
			$credit=0;
			$debit=0;
			$margin=0;
			$balance=0;
			if($detail['from_date']!="" && $detail['to_date']!=""){
				$where .= "DATE(entry_date)>= '".date_format(date_create($_REQUEST['from_date']),"Y-m-d")."' And DATE(entry_date)<='".date_format(date_create($_REQUEST['to_date']),"Y-m-d")."' AND did='".$detail['did']."' AND isDelete=0 AND isActive=1";
				
			}else{
				$where="did='".$detail['did']."' AND isDelete=0 AND isActive=1";
			}
			
				
			$d_detail=array();
			$d_detail['dealer_account_no']=$this->db->rp_getValue("account_info","account_number","did='".$detail['did']."'");
			$d_detail['dealer_name']=$this->db->rp_getValue("account_info","dealer_name","did='".$detail['did']."'");
			$d_detail['phone']=$this->db->rp_getValue("dealer","phone","id='".$detail['did']."'");
			
			
			$dealer_details=$this->db->rp_getData("dealer_account","*",$where,"",0);
			if($dealer_details){
				while($dealer_detail=mysqli_fetch_assoc($dealer_details)){
					
					$dealer_detail['entry_date']=date("d-m-Y",strtotime($dealer_detail['entry_date']));
					$dealerdetails[]=$dealer_detail;
					
					$credit+=$dealer_detail['credit'];
					$debit+=$dealer_detail['debit'];
					
					$amount_r=$this->db->rp_getData("dealer_payment","current_amount,bill_amount","did='".$detail['did']."'AND isDelete=0 AND isActive=1","",0);
					
					while($amount_d=mysqli_fetch_assoc($amount_r)){
						$current_amount+=$amount_d['current_amount'];
						$bill_amount+=$amount_d['bill_amount'];
					}
					
					$balance=($bill_amount-$current_amount);
					$closing_amount = $debit-$credit;
					if($debit > $credit){
						$amount_status=1;
					}else{
						$amount_status=0;
					}
					
				}
				$total=array("credit"=>$credit,"debit"=>$debit,"remaining_bal"=>$balance,"closing_amount"=>$closing_amount,"amount_status"=>$amount_status);
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_SUCESS'),"result"=>$dealerdetails,"dealer_detail"=>$d_detail,"total"=>$total);
				return $reply;
			}
			else{
				$dealerdetails['dealerdetails']=array();
				$total=array();
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_FAILED'),"dealer_detail"=>$d_detail);
				return $reply;
			}
		}
		else{
			$reply=array("ack"=>2,"developer_msg"=>$this->log->getMessage('DEALER_NOT_AVAILABLE',1),"ack_msg"=>$this->log->getMessage('DEALER_NOT_AVAILABLE'));
			return $reply;
		}
	}
	
	function DownloadCustomerAccountInfo($detail)
	{
		if($detail['from_date']!="" && $detail['to_date']!=""){
			
			$where = "DATE(entry_date)>= '".date("Y-m-d",strtotime($_REQUEST['from_date']))."' And DATE(entry_date)<='".date("Y-m-d",strtotime($_REQUEST['to_date']))."' AND did='".$detail['did']."' AND isActive=1 AND isDelete=0";
			
			$body_url=ADMINSITEURL."dealer_account_report_format.php?did=".$detail['did']."&from_date=".$detail['from_date']."&to_date=".$detail['to_date']."";
			
		}else{
			$where="did='".$detail['did']."' AND isActive=1 AND isDelete=0 ";
			$body_url=ADMINSITEURL."dealer_account_report_format.php?did=".$detail['did'];
		}
		$count_dealer_details=$this->db->rp_getTotalRecord("dealer_account",$where,0);
		
		if($count_dealer_details > 0){
			
			$adate=date('d-m-Y');
			$name=$this->db->rp_getValue("dealer","person_name","id='".$detail['did']."'");
			$string ="<style>th,tr,td{border:1px solid #000; padding:10px;}</style>";
			$content=file_get_contents($body_url);
			$d = html_entity_decode($content);
			$d.=$string;
			include("../ccroyalagency/mpdf60/mpdf.php");

			$mpdf = new mPDF('',    // mode - default ''

			 'A4',    // format - A4, for example, default ''

			 10,     // font size - default 0

			 'sans-serif',    // default font family

			 3,    // margin_left

			 3,    // margin right

			 3,     // margin top

			 3,    // margin bottom

			 0,     // margin header

			 0,     // margin footer

			 'P');  // L - landscape, P - portrait
			$mpdf->WriteHTML($d);

			if($detail['from_date']!="" && $detail['to_date']!=""){
				$fileName = "Account_Report-".$detail['from_date']."_to_".$detail['to_date'];
			}else{
				$fileName = "Account_Report";
			}
			
			if(!is_dir($fileName)){

				mkdir("../ccroyalagency/".Account_Report_FILES.$fileName);

			}

			$pdf_file_path	= "../".ADMINFOLDER."/".Account_Report_FILES.$fileName."/".$fileName.'.pdf';



			if(file_exists($pdf_file_path)){

				unlink($pdf_file_path);

			}

			$mpdf->Output($pdf_file_path);

			$xl_file_path	= "../".ADMINFOLDER."/".Account_Report_FILES.$fileName."/".$fileName.'.xls';

			if(file_exists($xl_file_path)){

				unlink($xl_file_path);

			}

			file_put_contents($xl_file_path, $d);

			$result=array();
			$result['pdf']=ADMINSITEURL."/".Account_Report_FILES.$fileName."/".$fileName.'.pdf';
			$result['xls']=ADMINSITEURL."/".Account_Report_FILES.$fileName."/".$fileName.'.xls';
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('DEALER_ACCOUNT_GET_FAILED'));
			return $reply;
		}
	}
	
	function sendOTPToContactNumber($detail)
	{
		if(!empty($detail))
		{
			$countFromId=$this->countDealer("phone",$detail);
			if($countFromId>=1)
			{
				 $isValid=$this->validateDetail($detail,array("phone"));
				if($isValid['ack']==1)
				{

					$activationCode=$this->generateActivationCode();
					// Detail of normal user
					$where=" phone='".$detail."'";
					$values=array("otp"=>$activationCode);			
				    $registerd_user_id=$this->rp_update($this->ctable,$values,$where,0);
					if($registerd_user_id!=0)
					{
						$name=$this->rp_getValue("dealer","person_name",$where,0);
						$reply=$this->aj_sendSecurityCode($name,$detail,$activationCode);
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
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID'));
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_VALID'));
				return $reply;
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('DEALER_LOGIN_NOT_FOUND'));
			return $reply;
		}
	}
	 function getRequiredColumns($required_columns=array())
    {
        if(!empty($required_columns))
        {
            $required_columns_string=implode(",",$required_columns);
            return $required_columns_string;
        }
        else
        {
            return "*";
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
	function aj_sendSecurityCode($name="User",$number,$activationCode)
	{
		require_once('notification.class.php');
	    $nt = new Notification();
		$sms="Hello ".$name.",\nYour Code:".$activationCode."\nThank You,\nTeam ".SITETITLE;			
		$msgId="NO";
		if($number!="")
		{
		   //	$msgId=$nt->aj_sendSMSSecurity($number,$sms);
			if($msgId!="")
			{
				$deliveryStatus=array("ack"=>1,"ack_msg"=>"OTP sent to ".$number." successfully");
				
				//$deliveryStatus=array("ack"=>1,"ack_msg"=>"OTP sent to ".$number." successfully");	
			}
			//$deliveryStatus=$nt->aj_getDeliveryReport($msgId);
			else{
			$deliveryStatus=array("ack"=>0,"ack_msg"=>"SMS sending failed on".$number,"reason"=>"Invalid mobile number or mobile switched off or out of coverage area!!");	
			}
			return $deliveryStatus;			
		}		
		return array('ack'=>0,'ack_msg'=>"Internal Error!","developer_msg"=>"Empty Mobile Number");
	}
	function countDealer($key,$value)
    {
        $countDealer = $this->db->rp_getTotalRecord($this->ctable,$key."='".$value."'",0);
        return $countDealer;
    }
    function duplicateSalesExecutive($key,$value,$primary_key)
    {
        $countDealer = $this->db->rp_getTotalRecord($this->ctable,$key."='".$value."' AND ".$this->primary_column."!=".$primary_key,0);
        return $countDealer;
    }
	
	
		
}
	
	


?>