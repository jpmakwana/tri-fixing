<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.system.php");
require_once("notification.class.php");

class Vendor extends Functions
{
	public $db;
	public $log;
	public $system;
	public $ctable="vendor";
	public $ctableBranch="customer_branch";
	public $ctableBranchAccount="customer_account";
	public $ctableMap="customer_map_area";
	public $ctableSalesInvoice="sales_invoice_info";
	public $ctableSalesInvoiceItems="sales_invoice_item";
	public $CtableCustomerNotes="customer_notes";
	public $CtableCustomerAccount="account_info";
	public $CtableCustomerAccountTransaction="customer_account";
	public $ctableDispatchInfo="dispatch_info";
	public $ctableDispatchPaymentLog="dispatch_payment_log";
	
	function __construct($id="") 
	{
		$db = new Functions();
		$log = new Log();
		$system = new System();
		$conn = $db->connect();
		$this->db=$db;		   
		$this->log=$log;	
		$this->notification=new Notification();	
		$this->system=$system;	
    } 
    public function getCustomerBranchClosingBalance($branch_id)
    {
    	$credit=$this->db->rp_getValue($this->ctableBranchAccount,"SUM(credit)","cid='".$branch_id."' AND isDelete=0",0);
    	$debit=$this->db->rp_getValue($this->ctableBranchAccount,"SUM(debit)","cid='".$branch_id."' AND isDelete=0");
    	$OutStanding=$credit+$debit;
    	$OutStanding=($OutStanding=="")?0:$OutStanding;
    	return $this->db->aNum($OutStanding);
    }

    public function getCustomerClosingBalance($customer_id)
    {
    	$ClosingBalance=0;
    	$branches=$this->rp_getData($this->ctableBranch,"id","cid='".$customer_id."' AND isDelete=0");
    	if($branches)
    	{
    		while($branch=mysqli_fetch_assoc($branches))
    		{
    			$ClosingBalance+=$this->getCustomerBranchClosingBalance($branch['id']);
    		}
    	}

    	return $ClosingBalance;
    }
	public function InsertCustomer($detail,$file) 
	{
	
		extract($detail);
		$dup_where = "email = '".$email."' AND isDelete=0 AND isActive=1";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
		if($r){
			
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND'),"result"=>$user_detail);
			return $reply;
		}
		else{
			if (isset($file["image_path"]) && $file["image_path"]['size']!=0) 
					{
						
						$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
						 $temp = explode(".", $file["image_path"]["name"]);
						 
						$extension = end($temp);
						$error="";
						if($file["image_path"]["error"]>0) {
							$error .= "Error opening the file. ";
						}
						if($file["image_path"]["type"]=="application/x-msdownload"){
							$error .= "Mime type not allowed. ";
						}
						if(!in_array($extension, $allowedExts)){
							$error .= "Extension not allowed. ";
						}
				
						$fileName  = $this->db->clean($file["image_path"]["name"]);
						$fileSize  = round($file["image_path"]["size"]); // BYTES
						//echo $fileSize ;exit;
						$adate   = date('Y-m-d H:i:m');

						$extension = end(explode(".", $fileName));
					
						$fileName	= 'vendor_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/vendor/".$fileName;						
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						$image=$fileName;
						
						
						
					}
					else
					{
						$image="Image not upload.";
						
						
						
					}
			$adate	= date('Y-m-d H:i:s');
	$rows 	= array(
						"name",
						"category_id",
						"cont_person",
						"short_desc",
						"long_desc",
						"email",
						"password",
						"telephone",
						"cellphone",
						"country",
						"city",
						"address",
						"image",
						"video_link",
						"web_url",
						"fb_link",
						"twitter_link",
						"insta_link",
						"linkedin_link",
						"listing_package",
						"promotion_package",
						"isDelete",
						"isActive",
						"created_date",
						"modified_date"
						);
			$values = array(
						$name,
						$category_id,
						$cont_person,
						$short_desc,
						$long_desc,
						$email,
						md5($password),
						$telephone,
						$cellphone,
						$country,
						$city,
						$address,
						$image,
						$video_link,
						$web_url,
						$fb_link,
						$twitter_link,
						$insta_link,
						$linkedin_link,
						$listing_package,
						$promotion_package,
						$isDelete,
						$isActive,
						$adate,
						$adate
						
					);
		 	$customer_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$customer_id,"insert",$this->log->slm['VENDOR_INSERT']." : ".$customer_name);
			if($customer_id!=0)
			{	
				/*$branch_rows=array("cid","branch_name","address","pincode","city","country","email","phone","price_list","adate");
				$branch_values=array($customer_id,$name,$address,$pincode,$city,$country,$email,$cellphone,$price_list,$adate);
				$cbid=$this->db->rp_insert("customer_branch",$branch_values,$branch_rows);
				$last_account_id=$this->rp_getValue("account_info","MAX(id)","isDelete=0",0);
				$last_account_no=$this->rp_getValue("account_info","account_number","id=".$last_account_id."",0);
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
						"cid",
						"cbid",
						"customer_name",
						"add_date",
					);
				$values = array(
						$last_account_no,
						$cid,
						$cbid,
						$name,
						$adate,
					);
					
				$account_info_id = $this->rp_insert("account_info",$values,$rows,0);*/
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VENDOR_INSERT',1),"ack_msg"=>$this->log->getMessage('VENDOR_INSERT'),"id"=>$customer_id);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VENDOR_INSERT_FAILED',1),"ack_msg"=>$this->log->getMessage('VENDOR_INSERT_FAILED'));
				return $reply;
			}
		}
		
	}
	public function UpdateCustomer($detail,$file)
	{
		extract($detail);
		//$dup_where = "email = '".$email."' AND id!='".$_REQUEST['id']."' AND isDelete=0 AND isActive=1";
		$dup_where = "email = '".$email."' AND id!='".$id."' AND isDelete=0 AND isActive=1";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
		if($r){
			
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND'));
			return $reply;
		}
		else{
			

				if (isset($file["image_path"]) && $file["image_path"]['size']!=0) 
					{
						
						$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
						 $temp = explode(".", $file["image_path"]["name"]);
						 
						$extension = end($temp);
						$error="";
						if($file["image_path"]["error"]>0) {
							$error .= "Error opening the file. ";
						}
						if($file["image_path"]["type"]=="application/x-msdownload"){
							$error .= "Mime type not allowed. ";
						}
						if(!in_array($extension, $allowedExts)){
							$error .= "Extension not allowed. ";
						}
				
						$fileName  = $this->db->clean($file["image_path"]["name"]);
						$fileSize  = round($file["image_path"]["size"]); // BYTES
						//echo $fileSize ;exit;
						$adate   = date('Y-m-d H:i:m');

						$extension = end(explode(".", $fileName));
					
						$fileName	= 'vendor_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/vendor/".$fileName;						
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						$image=$fileName;
						
						unset($detail['old_image_path']);
						
					}
					else
					{
							$image=$detail['old_image_path'];
						
						
						
					
						
					}
						$modified_date=date('Y-m-d H:i:s');
						$rows 	= array(
									"name"	=> $name,
									"category_id"	=> $category_id,
									"cont_person" => $cont_person,
									"short_desc"  => $short_desc,
									"long_desc"  => $long_desc,
									"email"	=> $email,
									"telephone"	=> $telephone,
									"cellphone"	=> $cellphone,
									"address" => $address,
									"country"=> $country,
									"city"=>$city,
									"video_link"=>$video_link,
									"web_url"=>$web_url,
									"fb_link"=>$fb_link,
									"twitter_link"=>$twitter_link,
									"insta_link"=>$insta_link,
									"linkedin_link"=>$linkedin_link,
									"listing_package"=>$listing_package,
									"promotion_package"=>$promotion_package,
									"image"	=> $image,
									"isVerified" =>1,
								);
						/* $where	= "id='".$_REQUEST['id']."'";
						$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
						$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['CUSTOMER_UPDATE']." : ".$customer_name); */


						$where	= "id='".$id."'";
						$uid=$this->db->rp_update($this->ctable,$rows,$where,0);
						$this->log->insertLog($this->ctable,$id,"update",$this->log->slm['VENDOR_UPDATE']." : ".$customer_name);
						if($uid!=0)
						{
							
							$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VENDOR_UPDATE',1),"ack_msg"=>$this->log->getMessage('VENDOR_UPDATE'));
							return $reply;
						}
						else
						{
							$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VENDOR_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('VENDOR_UPDATE_FAILED'));
							return $reply;
						}
				
			
		}
			
	}
	public function VendorActive($detail)
	{
		$customer_name=$this->db->rp_getValue($this->ctable,"name","isDelete=0 AND isActive=1 AND id='".$detail['id']."'");
		$rows 	= array(
		"isVerified"	=> 1
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['VENDOR_STATUS_SUCESS']." : ".$customer_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VENDOR_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('VENDOR_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VENDOR_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('VENDOR_STATUS_FAILED'));
				return $reply;
			}
	}
			
	public function CustomerGetEditData($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		$result		= $ctable_d;
		
		$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Update Customer Successfully.","result"=>$result);
		return $reply;
	
	}
	public function CustomerActive($detail)
	{
		$customer_name=$this->db->rp_getValue($this->ctable,"name","isDelete=0 AND isActive=1 AND id='".$detail['id']."'");
		$rows 	= array(
		"isActive"	=> $detail['status']
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['VENDOR_STATUS_SUCESS']." : ".$customer_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('VENDOR_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('VENDOR_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('VENDOR_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('VENDOR_STATUS_FAILED'));
				return $reply;
			}
	}
	function debitAmount($customer_id,$customer_aid,$amount,$remark,$ref_id,$ref_type){
		$adate	= date('Y-m-d H:i:s');
		$customer_account_no=$this->db->rp_getValue("account_info","account_number","id='".$customer_aid."'");
			$rows 	= array(
						"cid", 
						"aid", 
						"type",
						"debit",
						"entry_date",
						"details",
						"reference_id",
						"created_date",
						"reference_table",
						"customer_account_no",
					);
			$values = array(
						$customer_id,
						$customer_aid,
						'debit',
						"-".$amount,
						date('Y-m-d'),
						$remark,
						$ref_id,
						$adate,
						$ref_type,
						$customer_account_no,
					);
					
		 	$uid = $this->db->rp_insert("customer_account",$values,$rows,0);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Customer Debit Amount Successfully","ack_msg"=>"Success!Customer Debit Amount Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Debit Amount Failed.");
				return $reply;
			}
	}
	function creditAmount($customer_id,$customer_aid,$amount,$remark,$ref_id,$reference_table,$payment_type="",$payment_date=""){
		$customer_account_no=$this->db->rp_getValue("account_info","account_number","id='".$customer_aid."'");
		$adate	= date('Y-m-d H:i:s');
		$payment_date=($payment_date!="")?date("Y-m-d H:i:s",strtotime($payment_date)):date("Y-m-d H:i:s");
		$rows 	= array(
					"cid", 
					"aid", 
					"customer_account_no", 
					"reference_id",						
					"reference_table",						
					"type",
					"credit",
					"entry_date",
					"details",
					"created_date",
				);
		$values = array(
					$customer_id,
					$customer_aid,
					$customer_account_no,
					$ref_id,
					$reference_table,
					'credit',
					"+".$amount,
					$payment_date,
					$remark,
					$payment_date,
				);
				
				
		$uid = $this->db->rp_insert("customer_account",$values,$rows,0);
		if($uid!=0)
		{

			// Update OutStanding Payments Now
			$this->UpdateOutstandingPayment($customer_id,$amount);
			$reply=array("ack"=>1,"developer_msg"=>"Customer Debit Amount Successfully","ack_msg"=>"Success!Customer Debit Amount Successfully.");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Debit Amount Failed.");
			return $reply;
		}
	}

	function SendAccountMail($detail){
		extract($detail);
		if(!empty($detail)){

			$body_url=CUSTOMERSITEURL."customer_account_print.php?f=1&id=".$customer_id."&ToDate=".$todate."&FromDate=".$fromdate;
				$d=file_get_contents($body_url);
				//$d = html_entity_decode($d);
				$relCertFileNames = array();
				$merge_file = array();
				
				require('../ccnibscrm/mpdf60/mpdf.php');
				$mpdf = new mPDF('',    // mode - default ''

				 'A4',    // format - A4, for example, default ''

				 15,     // font size - default 0

				 'sans-serif',    // default font family

				 3,    // margin_left

				 3,    // margin right

				 3,     // margin top

				 3,    // margin bottom

				 0,     // margin header

				 0,     // margin footer

				 'P');  // L - landscape, P - portrait

				 $mpdf->SetHTMLFooter('
				<hr><span width="100%" style="vertical-align: bottom; border:0px; font-family: serif; font-size: 12px; color: #000000; font-weight: bold; font-style: italic;">
				Downloaded On:-{DATE d-m-Y H:i:s}
				</span>');
				$mpdf->WriteHTML($d);

				$fileName = "customer_".$customer_id;
				if(!is_dir("../".CUSTOMER_ACCOUNT_FILES.$fileName)){

					mkdir("../".CUSTOMER_ACCOUNT_FILES.$fileName);

				}

				$pdf_file_path	= "../".CUSTOMER_ACCOUNT_FILES.$fileName."/".$fileName.'.pdf';
				if(file_exists($pdf_file_path)){

					unlink($pdf_file_path);

				}
				$mpdf->Output($pdf_file_path);
				$pdf_file_path;

				$result=array();
				$result['pdf']=SITEURL.CUSTOMER_ACCOUNT_FILES.$fileName."/".$fileName.'.pdf';
				
			//Send Mail
			$customer_info=$this->db->rp_getData("customer","*","id='".$customer_id."'");
			if($customer_info){
				$customer_info=mysqli_fetch_assoc($customer_info);
			}

			$to = $customer_info['email'];
			$email_body="";
			$subject="Account of '".$customer_info['name']."'";
			//$txt=file_get_contents($url);
			
			$uploaded_file_path=$result['pdf'];
			$ext = pathinfo($uploaded_file_path, PATHINFO_EXTENSION);
			$new_file_name="ACCOUNT.".$ext;
			$reply_from_function=$this->notification->rp_sendGenEmail($to,$subject,$email_body,$new_file_name,$uploaded_file_path);
		}
	}

	////////////////////////////// Service Part //////////////////////////////
	
	function loginCustomer($detail,$required_columns=array())
    {
		if(!empty($detail))
        {
				$required_columns=$this->system->getRequiredColumns($required_columns);
                $countFromemail=$this->countCustomer("email",$detail['email']);
                if($countFromemail>=1)
                {
					$detail['password']=md5($detail['password']);
                    $customer=$this->db->rp_getData($this->ctable,$required_columns,"email='".$detail['email']."' AND password='".$detail['password']."' AND isDelete=0 AND isActive=1",0);
                   
					if($customer)
					{
						$customer=mysqli_fetch_assoc($customer);
						$customer=$this->getCustomerDetail($customer['id'],$required_columns);
						$this->db->rp_update($this->ctable,array("imei"=>$detail['imei'],"refreshToken"=>$detail['refreshToken']),"email='".$detail['email']."'");

						$total_record=$this->db->rp_getTotalRecord("refresh_token_customer","imei='".$detail['imei']."'",0);
						if($total_record==0){
							$this->db->rp_insert("refresh_token_customer",array($customer['id'],$detail['imei'],$detail['refreshToken']),array("user_id","imei","refresh_token"),0);
						}else{
							$this->db->rp_update("refresh_token_customer",array("user_id"=>$customer['id'],"refresh_token"=>$detail['refreshToken']),"imei='".$detail['imei']."'");
						}

						$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_SUCESS'),"result"=>$customer);
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_FAILED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_FAILED'));
						return $reply;
					}
                    
                }
                else
                {
                    $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_NOT_REGISTERED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_NOT_REGISTERED'));
                    return $reply;
                }
        }
        else
        {
            $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_LOGIN_NOT_FOUND'));
            return $reply;
        }
    }
   
	function ForgotPassword($detail)
	{
		
		if(!empty($detail))
		{
			extract($detail);
			$check=$this->db->rp_getValue($this->ctable,"COUNT(*)","email='".$email."'");
			if($check>0)
			{
				$name=$this->db->rp_getValue($this->ctable,"name","email='".$email."'",0);
				$phone=$this->db->rp_getValue($this->ctable,"cellphone","email='".$email."'",0);
				
				// Register To Customer Table
				$activation_code=$this->system->generateCode();
				$rows=array("otp"=>$activation_code);
				$where=" email='".$email."'";		
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
				
				//Send Mail
				$params=array();
				$params['name']=$name;
				$params['email']=$email;
				$params['phone']=$phone;
				$params['activation_code']=$activation_code;
				$EmailContent=$this->notification->getEmailBody('FORGET_PASSWORD',$params);
				$reply=$this->notification->rp_sendEmail($email,$EmailContent['subject'],$EmailContent['body']);
				if($isUpdated)
				{
					
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('SEND_MAIL_SUCESS',1),"ack_msg"=>$this->log->getMessage('SEND_MAIL_SUCESS'));
					return $reply;
				}
				else	
				{
					
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('SEND_MAIL_FAILED',1),"ack_msg"=>$this->log->getMessage('SEND_MAIL_FAILED'));
					return $reply;
				}
				
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('USER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('USER_NOT_FOUND'));
				return $reply;
				
			}
			
		}
		else			
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INTERNAL_ERROR_SERVICE',1),"ack_msg"=>$this->log->getMessage('INTERNAL_ERROR_SERVICE'));
			return $reply;
		}
	}
	function UserChangeForgetPassword($email,$password)
	{
		$count=$this->countCustomer("email",$email);					
		if($count>0)
		{
			$password=md5($password);
			$values=array("password"=>$password);
			$isUpdated=$this->db->rp_update($this->ctable,$values,"email='".$email."'");
			if($isUpdated)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('PASS_CHANGE_SUCESS',1),"ack_msg"=>$this->log->getMessage('PASS_CHANGE_SUCESS'));
				return $reply;
				
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('PASS_CHANGE_FAILED',1),"ack_msg"=>$this->log->getMessage('PASS_CHANGE_FAILED'));
				return $reply;
			}
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('USER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('USER_NOT_FOUND'));
			return $reply;
				
		}
	}
	function UpdateUserProfile($detail,$required_columns=array())
	{
		extract($detail);
		$count=$this->countCustomer("id",$customer_id);					
		if($count>0)
		{
			$required_columns=$this->system->getRequiredColumns($required_columns);
			$user_detail=$this->getCustomerDetail($customer_id,$required_columns);
			$dup_where = "email = '".$email."' AND id!='".$customer_id."' AND isDelete=0 AND isActive=1";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
			if($r){
				
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND'),"result"=>$user_detail);
				return $reply;
			}
			else{
				
				$created_date=date('Y-m-d H:i:s');
				$rows 	= array(
						"name"			=> $name,
						"applicant"	=> $applicant,
						"address"		=> $address,
						"cellphone"	=> $cellphone,
						"telephone"			=> $telephone,
						"email"			=> $email,
					);
				$where	= "id='".$customer_id."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$customer_id,"update",$this->log->slm['USER_PROFILE_UPDATE_SUCESS']." : ".$name);
			
						
				if($isUpdated)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('USER_PROFILE_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('USER_PROFILE_UPDATE_SUCESS'),"result"=>$user_detail);
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('USER_PROFILE_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('USER_PROFILE_UPDATE_FAILED'));
					return $reply;
				}
			}
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('USER_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('USER_NOT_FOUND'));
			return $reply;
				
		}
			
	}
	function getCustomerDetail($customer_id,$required_columns)
	{
		$user_details=$this->db->rp_getData($this->ctable,$required_columns,"id='".$customer_id."' AND isDelete=0","",0);
		if($user_details)
		{
			$r=mysqli_fetch_assoc($user_details);
			$customers_branch=$this->rp_getData("customer_branch","*","isDelete=0 AND cid='".$customer_id."'");
			if($customers_branch)
			{
				$branches=array();
				while($customer_branch=mysqli_fetch_assoc($customers_branch)){
					$branches[]=$customer_branch;
				}
				$r['customer_branch']=$branches;
			}
			return $r;
		}	
		else
		{
			return false;
		}	
	}
	function getCustomerBranchDetail($customer_branch_id,$required_columns)
	{
		$user_details=$this->db->rp_getData($this->ctableBranch,$required_columns,"id='".$customer_branch_id."' AND isDelete=0","",0);
		if($user_details)
		{
			$r=mysqli_fetch_assoc($user_details);
			$r['customer_detail']=$this->getCustomerDetail($r['cid'],"*");
			return $r;
		}	
		else
		{
			return false;
		}	
	}
	function DownloadCustomerAccountInfo($detail)
	{
		if($detail['from_date']!="" && $detail['to_date']!=""){
			
			$where = "DATE(entry_date)>= '".date("Y-m-d",strtotime($detail['from_date']))."' And DATE(entry_date)<='".date("Y-m-d",strtotime($detail['to_date']))."' AND aid='".$detail['aid']."' AND isActive=1 AND isDelete=0";
			
			$body_url=ADMINSITEURL."customer_account_report_format.php?aid=".$detail['aid']."&from_date=".$detail['from_date']."&to_date=".$detail['to_date']."";
			
		}else{
			$where="aid='".$detail['aid']."' AND isActive=1 AND isDelete=0 ";
			$body_url=ADMINSITEURL."customer_account_report_format.php?aid=".$detail['aid'];
		}
		$count_dealer_details=$this->db->rp_getTotalRecord("customer_account",$where,0);
		
		if($count_dealer_details > 0){
			
			$adate=date('d-m-Y');
			//$name=$this->db->rp_getValue("customer","name","id='".$detail['aid']."'");
			$string ="<style>th,tr,td{border:1px solid #000; padding:10px;}</style>";
			$content=file_get_contents($body_url);
			$d = html_entity_decode($content);
			$d.=$string;
			require_once("../".ADMINFOLDER."/mpdf60/mpdf.php");

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
				$fileName = "Account_Report_".$detail['aid']."_".$detail['from_date']."_to_".$detail['to_date'];
			}else{
				$fileName = "Account_Report_".$detail['aid'].date('d-m-Y');
			}
			
			if(!is_dir("../".ADMINFOLDER."/".Account_Report_FILES.$fileName)){

				mkdir("../".ADMINFOLDER."/".Account_Report_FILES.$fileName);

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
			$result['relative_pdf']=Account_Report_FILES.$fileName."/".$fileName.'.pdf';
			$result['xls']=ADMINSITEURL."/".Account_Report_FILES.$fileName."/".$fileName.'.xls';
			$result['relative_xls']=Account_Report_FILES.$fileName."/".$fileName.'.xls';
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_ACCOUNT_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_ACCOUNT_GET_SUCESS'),"result"=>$result);
			return $reply;
		}
		else{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CUSTOMER_ACCOUNT_GET_FAILED',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_ACCOUNT_GET_FAILED'));
			return $reply;
		}
	}
	
	
	function GenerateSalesInvoice($dispatch_id)
	{
		
		$dispatch_information=$this->rp_getData("dispatch_info","*","id='".$dispatch_id."'");
		if($dispatch_information)
		{
			$sales_invoice_no=$this->db->getlastInsertId("sales_invoice_info");
			$sales_invoice_no=SALES_INVOICE_NO.str_pad($sales_invoice_no, 4, 0, STR_PAD_LEFT);
			$dispatch_information=mysqli_fetch_assoc($dispatch_information);
			$SalesInvoiceColumns=array("sales_invoice_no","cid","cbid","customer_name", "customer_address", "customer_city", "customer_pincode", "customer_country", "vehical_id", "order_id", "status","invoice_qty","invoice_discount","invoice_subtotal","invoice_grandtotal","invoice_due_date","tax_amount","other_tax_amount","sales_invoice_date","created_date","sales_id","dispatcher_id","dispatcher_type","purchase_total","dispatch_id");
			$SalesInvoiceValues=array($sales_invoice_no,$dispatch_information['dispatch_cid'],$dispatch_information['dispatch_cbid'],$dispatch_information['dispatch_customer_name'],$dispatch_information['dispatch_customer_address'],$dispatch_information['dispatch_customer_city'],$dispatch_information['dispatch_customer_pincode'],$dispatch_information['dispatch_customer_country'],$dispatch_information['vehical_id'],$dispatch_information['order_id'],0,$dispatch_information['dispatched_qty'],$dispatch_information['dispatch_discount'],$dispatch_information['dispatch_subtotal'],$dispatch_information['dispatch_grandtotal'],$dispatch_information['payment_due_date'],$dispatch_information['tax_amount'],$dispatch_information['other_tax_amount'],date("Y-m-d"),date("Y-m-d"),$dispatch_information['sales_id'],$dispatch_information['dispatcher_id'],$dispatch_information['dispatcher_type'],$dispatch_information['purchase_total'],$dispatch_information['id']);
			$SalesInvoiceId=$this->rp_insert($this->ctableSalesInvoice,$SalesInvoiceValues,$SalesInvoiceColumns,0);
			if($SalesInvoiceId!=0)
			{
				$dispatch_items=$this->rp_getData("dispatch_item","*","dispatch_id='".$dispatch_id."'");
				if($dispatch_items)
				{
					while($dispatch_item=mysqli_fetch_assoc($dispatch_items))
					{
						$SalesInvoiceItemColumns=array("sales_invoice_id","item_id","item_name","item_code","item_price","item_orignal_price","item_qty","item_subtotal","item_discount","item_discount_amount","item_grandtotal","tax","other_tax","tax_amount","other_tax_amount","purchase_price","item_tax");
						$SalesInvoiceItemValues=array($SalesInvoiceId,$dispatch_item['dispatch_item_id'],$dispatch_item['dispatch_item_name'],$dispatch_item['dispatch_item_code'],$dispatch_item['dispatch_item_selling_price'],$dispatch_item['dispatch_item_orignal_price'],$dispatch_item['dispatch_item_qty'],$dispatch_item['dispatch_item_sub_total'],$dispatch_item['dispatch_item_discount'],$dispatch_item['dispatch_item_discount_amount'],$dispatch_item['dispatch_item_grand_total'],$dispatch_item['dispatch_item_vat_tax'],$dispatch_item['dispatch_item_other_tax'],$dispatch_item['dispatch_item_vat_tax_amount'],$dispatch_item['dispatch_item_other_tax_amount'],$dispatch_item['purchase_price'],$dispatch_item['dispatch_item_tax_id']);
						$this->rp_insert($this->ctableSalesInvoiceItems,$SalesInvoiceItemValues,$SalesInvoiceItemColumns,0);
					}
					
				}
				// GeneratePDF
				$body_url=ADMINSITEURL."sales_invoice_format.php?id=".$SalesInvoiceId;
				$string ="<style>th,tr,td{border:1px solid #000; padding:10px;}</style>";
				$content=file_get_contents($body_url);
				
				$d = html_entity_decode($content);
				
				//$d.=$string;
				require_once("../ccnibscrm/mpdf60/mpdf.php");
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
				$fileName = "Invoice-".$SalesInvoiceId."-".date('d-m-Y').'.pdf';
				
				$pdf_file_path	= SALES_INVOICE_FILES.$fileName;
				if(file_exists($pdf_file_path))
				{
					unlink($pdf_file_path);
				}
				$mpdf->Output($pdf_file_path);
				
				$this->rp_update($this->ctableSalesInvoice,array("sales_invoice_file_url"=>$fileName),"id='".$SalesInvoiceId."'",0);
				$isUpdated=$this->rp_update("dispatch_info",array("sales_invoice_file_url"=>$fileName),"id='".$dispatch_id."'");
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('INVOICE_SUBMIT_SUCCESS',1),"ack_msg"=>$this->log->getMessage('INVOICE_SUBMIT_SUCCESS'),"sales_invoice_id"=>$SalesInvoiceId,"sales_invoice_file_url"=>$fileName);
				//exit;
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INVOICE_SUBMIT_FAIL',1),"ack_msg"=>$this->log->getMessage('INVOICE_SUBMIT_FAIL'));
				return $reply;
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('INVOICE_SUBMIT_FAIL',1),"ack_msg"=>$this->log->getMessage('INVOICE_SUBMIT_FAIL'));
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
	function countCustomer($key,$value)
    {
        $countCustomer = $this->db->rp_getTotalRecord($this->ctable,$key."='".$value."'",0);
        return $countCustomer;
    }
	function CreateNote($cid,$note)
    {
    	$countCustomer=$this->countCustomer("id",$cid);
        if($countCustomer>0)
        {
        	$NoteID=$this->rp_insert($this->CtableCustomerNotes,array($cid,$note,date("Y-m-d H:i:s")),array("cid","note","created_date"),0);
        	if($NoteID!=0)
        	{
        		$reply=array("ack"=>1,"developer_msg"=>"Customer note created","ack_msg"=>"Customer note created");
				return $reply;
        	}
        	else
        	{
        		$reply=array("ack"=>0,"developer_msg"=>"Customer note could not created","ack_msg"=>"Customer note could not created");
				return $reply;
        	}

        	
        }
        else
        {
        	$reply=array("ack"=>0,"developer_msg"=>"Customer note could not created","ack_msg"=>"Customer note could not created");
			return $reply;
        }
    }

    function DeleteNote($nid)
    {
    	$isUpdated=$this->rp_update($this->CtableCustomerNotes,array("isDelete"=>1),"id='".$nid."'");
    	if($isUpdated)
        {
        	
   			$reply=array("ack"=>1,"developer_msg"=>"Customer note deleted","ack_msg"=>"Customer note deleted");
			return $reply;
	     }
        else
        {
        	$reply=array("ack"=>0,"developer_msg"=>"Customer note could not deleted","ack_msg"=>"Customer note could not deleted");
			return $reply;
        }
    }

    function UpdateCustomerActivity($Cid,$Activity,$Time)
    {
    	$Activity=array("0"=>"branch_activity","1"=>"invoice_activity","2"=>"credit_note_activity","3"=>"account_activity");
    	$LastTimeColumns=array(
    		"branch_activity"=>"last_branch_activity_time",
    		"invoice_activity"=>"last_invoice_activity_time",
    		"credit_note_activity"=>"last_credit_note_activity_time",
    		"account_activity"=>"last_account_activity_time",
    	);

    	$countCustomer=$this->countCustomer("id",$Cid);
    	if($countCustomer>0)
    	{
    		$ActivityCount=$this->db->rp_getTotalRecord($this->CtableCustomerActivity,"cid='".$Cid."'");
	    	if($ActivityCount>0)
	    	{
	    		$ActivityCount=$this->db->rp_update($this->CtableCustomerActivity,array($LastTimeColumns[$Activity]=>$Time),"cid='".$Cid."'");
	    		return true;
	    	}
	    	else
	    	{
	    		$this->CreateCustomerActivity($Cid,$AdminID);
	    		$ActivityCount=$this->db->rp_update($this->CtableCustomerActivity,array($LastTimeColumns[$Activity]=>$Time),"cid='".$Cid."'");
	    		return false;
	    	}
    	}
    	else
    	{
    		return false;
    	}
    	

    }

	public function GetCustomerBranchAccountInfo($cbid)
	{
		$AccountInfo=$this->rp_getData($this->CtableCustomerAccount,"*","cbid='".$cbid."'","",0);
		if($AccountInfo)
		{
			$AccountInfo=mysqli_fetch_assoc($AccountInfo);
			$Credit=$this->rp_getValue($this->CtableCustomerAccountTransaction,"SUM(credit)","aid='".$AccountInfo['id']."'");
			$Debit=$this->rp_getValue($this->CtableCustomerAccountTransaction,"SUM(debit)","aid='".$AccountInfo['id']."'");
			$ClosingBalance=$Credit+$Debit;
			$AccountInfo['overall_closing_balance']=($ClosingBalance>0)?$ClosingBalance:$ClosingBalance;
			return $AccountInfo;
		}
		else
		{
			return false;
		}
	}

	public function UpdateOutstandingPayment($cbid,$Payment)
	{
		$PendingPaymentDispatch=$this->db->rp_getData($this->ctableDispatchInfo,"*","dispatch_payment_remain_to_pay>0 AND dispatch_cbid='".$cbid."'","id ASC");
		if($PendingPaymentDispatch)
		{
			while($PendingDispatch=mysqli_fetch_assoc($PendingPaymentDispatch))
			{
				$DispatchID=$PendingDispatch['id'];
				$PendingAmount=$PendingDispatch['dispatch_payment_remain_to_pay'];
				if($Payment<=0)
				{
					break;
				}
				if($Payment>$PendingAmount)
				{
					$Paid=$PendingAmount;
					$Payment=$Payment-$PendingAmount;
					$NewPending=0;
				}
				else
				{
					$Paid=$Payment;
					$NewPending=$PendingAmount-$Payment;
					$NewPending=($NewPending<0)?0:$NewPending;
					$Payment=0;
				}
				$Update=array("dispatch_payment_remain_to_pay"=>$NewPending);
				$this->db->rp_update($this->ctableDispatchInfo,$Update,"id='".$DispatchID."'");
				$this->InsertPaymentLog($DispatchID,$Paid);
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"No Pending Payment From Dispatch","ack_msg"=>"No Pending Payment From Dispatch");
			return $reply;
		}
	}


	function UpdatePendingDispatch($cbid)
	{
		$CustomerBranchAccountInfo=$this->GetCustomerBranchAccountInfo($cbid);
		if($CustomerBranchAccountInfo)
		{
			$OutstandingAmount=$CustomerBranchAccountInfo['overall_closing_balance'];
			if($OutstandingAmount>=0)
			{
				$PendingPaymentDispatch=$this->db->rp_getData($this->ctableDispatchInfo,"*","dispatch_payment_remain_to_pay>0 AND dispatch_cbid='".$cbid."'","id ASC","",0);
				if($PendingPaymentDispatch)
				{
					while($PendingDispatch=mysqli_fetch_assoc($PendingPaymentDispatch))
					{
						$DispatchID=$PendingDispatch['id'];
						$PendingAmount=$PendingDispatch['dispatch_payment_remain_to_pay'];
						if($OutstandingAmount<=0)
						{
							break;
						}
						if($OutstandingAmount>$PendingAmount)
						{
							$OutstandingAmount=$OutstandingAmount-$PendingAmount;
							$Paid=$PendingAmount;
							$NewPending=0;
						}
						else
						{
							$Paid=$OutstandingAmount;
							$NewPending=$PendingAmount-$OutstandingAmount;
							$NewPending=($NewPending<0)?0:$NewPending;
							$OutstandingAmount=0;

						}
						$Update=array("dispatch_payment_remain_to_pay"=>$NewPending);
						$this->db->rp_update($this->ctableDispatchInfo,$Update,"id='".$DispatchID."'");
						$this->InsertPaymentLog($DispatchID,$Paid);
					}
				}
				
			}
			
		}
		else
		{

		}
	}

	public function InsertPaymentLog($DispatchID,$Payment)
	{
		$LogID=$this->rp_insert($this->ctableDispatchPaymentLog,array($DispatchID,$Payment,date("Y-m-d H:i:s")),array("dispatch_id","payment","date"));
		return $LogID;
	}
    


	protected $CtableDispatch="dispatch_info";
	protected $CtableDispatchItem="dispatch_item";
	protected $dispatch_status=array("0"=>"Ready to dispatch","1"=>"On the way","2"=>"Delivered");
	protected $credit_note_status=array("0"=>"Waiting For Approval","1"=>"Approved","2"=>"Rejected");

	function GetCustomerDispatches($Customer,$CustomerBranch,$Filter="",$Sort="",$Limit=array())
	{
		$isCustomerAvailable=$this->isCustomerAvailable($Customer);
		
		if($isCustomerAvailable)
		{
			$isCustomerBranchAvailable=$this->isCustomerBranchAvailable($CustomerBranch);

			if($CustomerBranch=="" || $isCustomerBranchAvailable)
			{
				$WhereClause=" dispatch_cid='".$Customer."' AND isDelete=0 AND isActive=1";
				$SortByClause="";
				$LimitClause="";
				
				if($CustomerBranch!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND dispatch_cbid='".$CustomerBranch."'";
					else
					$WhereClause.=" dispatch_cbid='".$CustomerBranch."'";	
				}

				$FromDate=(array_key_exists("from_date",$Filter) && $Filter['from_date']!="")?date("Y-m-d",strtotime($Filter['from_date'])):"";
				if($FromDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(dispatch_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(dispatch_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
				}

				$ToDate=(array_key_exists("to_date",$Filter) && $Filter['to_date']!="")?date("Y-m-d",strtotime($Filter['to_date'])):"";
				if($ToDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(dispatch_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(dispatch_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";
				}
				if($Sort!="")
				{
					$SortByClause=$Sort;
				}
				else
				{
					$SortByClause="id DESC";
				}
				if(!empty($Limit) && isset($Limit['ul']) && isset($Limit['ll']) && $Limit['ul']!="" && $Limit['ll']!="")
				{
					$LimitClause=" ".$Limit['ul'].",".$Limit['ll'];
				}else{
					$LimitClause="";
				}


				$Dispatches=$this->db->rp_getData($this->CtableDispatch,"*",$WhereClause,$SortByClause,0,$LimitClause);
				if($Dispatches)
				{
					$Result=array();
					while($Dispatch=mysqli_fetch_assoc($Dispatches))
					{
						$Dispatch['dispatch_date']=$this->parseDate($Dispatch['dispatch_date']);
						$Dispatch['path']=ADMINSITEURL."dispatch_ajax_genReport.php?id=".$Dispatch['id']."&status=1";
						$Dispatch['status_slug']=$this->dispatch_status[$Dispatch['status']];
						$Result[]=$Dispatch;
					}
					$ack=array("ack"=>1,"ack_msg"=>"Dispatch Found!!","result"=>$Result);
				}
				else
				{
					$ack=array("ack"=>0,"ack_msg"=>"No Dispatch Found!!");
				}
			}
			else
			{
				$ack=array("ack"=>0,"ack_msg"=>"Customer Branch Not Available Or Temporary Blocked.");
			}
		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"Customer Not Available Or Temporary Blocked.");
		}
		
		return $ack;

	}
	function GetDispatchDetail($dispatch_id)
	{
		$isDispatchAvailable=$this->isDispatchAvailable($dispatch_id);
		
		if($isDispatchAvailable)
		{
			$WhereClause=" id='".$dispatch_id."' AND isDelete=0 AND isActive=1";
			$Dispatches=$this->db->rp_getData($this->ctableDispatchInfo,"*",$WhereClause,"",0);
			if($Dispatches)
			{
				$Dispatch=mysqli_fetch_assoc($Dispatches);
				$vehical_info=$this->db->rp_getData("vehical","*","id='".$Dispatch['vehical_id']."'");
				if($vehical_info){
					$vehical_info=mysqli_fetch_assoc($vehical_info);
					$Dispatch['vehical_name']=$vehical_info['vehical_name'];
					$Dispatch['vehical_no']=$vehical_info['vehical_no'];
				}else{
					$Dispatch['vehical_name']="";
					$Dispatch['vehical_no']="";
				}
				$driver_info=$this->db->rp_getData("emp_personal_info","*","id='".$Dispatch['driver_id']."'");
				if($driver_info){
					$driver_info=mysqli_fetch_assoc($driver_info);
					$Dispatch['dispatch_actual_driver_name']=$driver_info['first_name']." ".$driver_info['last_name'];
					$Dispatch['dispatch_actual_driver_number']=$driver_info['phone'];
					$Dispatch['dispatch_actual_driver_email']=$driver_info['email'];
				}else{
					$Dispatch['dispatch_actual_driver_name']="";
					$Dispatch['dispatch_actual_driver_number']="";
					$Dispatch['dispatch_actual_driver_email']="";
				}
				$Dispatch['dispatch_date']=$this->parseDate($Dispatch['dispatch_date']);
				$Dispatch['path']=ADMINSITEURL."dispatch_ajax_genReport.php?id=".$Dispatch['id']."&status=1";
				$Dispatch['status_slug']=$this->dispatch_status[$Dispatch['status']];
				$Dispatches_items=$this->db->rp_getData("dispatch_item LEFT JOIN product ON dispatch_item.dispatch_item_id=product.id LEFT JOIN category ON product.category_id=category.id","dispatch_item.*","dispatch_id='".$Dispatch['id']."'",ITEM_DISPLAY_ORDER,0);
				while($Dispatch_item=mysqli_fetch_assoc($Dispatches_items))
				{
					$item_result[]=$Dispatch_item;
				}
				$Dispatch['items']=$item_result;
				$ack=array("ack"=>1,"ack_msg"=>"Dispatch Found!!","result"=>$Dispatch);
			}
			else
			{
				$ack=array("ack"=>0,"ack_msg"=>"No Dispatch Found!!");
			}
		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"Customer Not Available Or Temporary Blocked.");
		}
		
		return $ack;

	}

	function GetCustomerSalesInvoice($Customer,$CustomerBranch,$Filter="",$Sort="",$Limit=array())
	{
		$isCustomerAvailable=$this->isCustomerAvailable($Customer);
		
		if($isCustomerAvailable)
		{
			$isCustomerBranchAvailable=$this->isCustomerBranchAvailable($CustomerBranch);

			if($CustomerBranch=="" || $isCustomerBranchAvailable)
			{
				$WhereClause=" cid='".$Customer."' AND isDelete=0 AND isActive=1";
				$SortByClause="";
				$LimitClause="";
				
				if($CustomerBranch!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND cbid='".$CustomerBranch."'";
					else
					$WhereClause.=" cbid='".$CustomerBranch."'";	
				}

				$FromDate=(array_key_exists("from_date",$Filter) && $Filter['from_date']!="")?date("Y-m-d",strtotime($Filter['from_date'])):"";
				if($FromDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(sales_invoice_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(sales_invoice_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
				}

				$ToDate=(array_key_exists("to_date",$Filter) && $Filter['to_date']!="")?date("Y-m-d",strtotime($Filter['to_date'])):"";
				if($ToDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(sales_invoice_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(sales_invoice_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";	
				}
				if($Sort!="")
				{
					$SortByClause=$Sort;
				}
				else
				{
					$SortByClause="id DESC";
				}
				if(!empty($Limit) && isset($Limit['ul']) && isset($Limit['ll']) && $Limit['ul']!="" && $Limit['ll']!="")
				{
					$LimitClause=" ".$Limit['ul'].",".$Limit['ll'];
				}else{
					$LimitClause="";
				}


				$Sales_invoices=$this->db->rp_getData($this->ctableSalesInvoice,"*",$WhereClause,$SortByClause,0,$LimitClause);
				if($Sales_invoices)
				{
					$Result=array();
					while($Sales_invoice=mysqli_fetch_assoc($Sales_invoices))
					{
						$Sales_invoice['sales_invoice_date']=$this->parseDate($Sales_invoice['sales_invoice_date']);
						$Sales_invoice['path']=ADMINSITEURL."sales_invoice_ajax_genReport.php?id=".$Sales_invoice['id']."&status=1";
						$Sales_invoice['status_slug']=$this->dispatch_status[$Sales_invoice['status']];
						$Result[]=$Sales_invoice;
					}
					$ack=array("ack"=>1,"ack_msg"=>"Sales invoice Found!!","result"=>$Result);
				}
				else
				{
					$ack=array("ack"=>0,"ack_msg"=>"No Sales invoice Found!!");
				}
			}
			else
			{
				$ack=array("ack"=>0,"ack_msg"=>"Customer Branch Not Available Or Temporary Blocked.");
			}
		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"Customer Not Available Or Temporary Blocked.");
		}
		
		return $ack;

	}
	function GetCustomerCreditNotes($Customer,$CustomerBranch,$Filter="",$Sort="",$Limit=array())
	{

		$isCustomerAvailable=$this->isCustomerAvailable($Customer);
		
		if($isCustomerAvailable)
		{
			$isCustomerBranchAvailable=$this->isCustomerBranchAvailable($CustomerBranch);

			if($CustomerBranch=="" || $isCustomerBranchAvailable)
			{
				$WhereClause=" customer_id='".$Customer."' AND isDelete=0 AND isActive=1";
				$SortByClause="";
				$LimitClause="";
				
				if($CustomerBranch!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND customer_branch_id='".$CustomerBranch."'";
					else
					$WhereClause.=" customer_branch_id='".$CustomerBranch."'";	
				}

				$FromDate=(array_key_exists("from_date",$Filter) && $Filter['from_date']!="")?date("Y-m-d",strtotime($Filter['from_date'])):"";
				if($FromDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(note_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(note_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
				}
				$ToDate=$Filter['to_date'];
				//echo $ToDate==(array_key_exists("to_date",$Filter) && $Filter['to_date']!="")?date("Y-m-d",strtotime($Filter['to_date'])):"";
				if($ToDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(note_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(note_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";
				}
				if($Sort!="")
				{
					$SortByClause=$Sort;
				}
				else
				{
					$SortByClause="id DESC";
				}
				if(!empty($Limit) && isset($Limit['ul']) && isset($Limit['ll']) && $Limit['ul']!="" && $Limit['ll']!="")
				{
					$LimitClause=" ".$Limit['ul'].",".$Limit['ll'];
				}else{
					$LimitClause="";
				}


				$Credit_notes=$this->db->rp_getData("credit_note","*",$WhereClause,$SortByClause,0,$LimitClause);
				if($Credit_notes)
				{
					$Result=array();
					while($Credit_note=mysqli_fetch_assoc($Credit_notes))
					{

						$Credit_note['note_date']=$this->parseDate($Credit_note['note_date']);
						$Credit_note['path']=ADMINSITEURL."credit_note_ajax_genReport.php?id=".$Credit_note['id']."&status=1";
						$Credit_note['status_slug']=$this->credit_note_status[$Credit_note['status']];

						$Credit_note['customer_name']=$this->db->rp_getValue("customer","name","id='".$Credit_note['customer_id']."'");
						$Credit_note['customer_name']=($Credit_note['customer_id']!=0)?$Credit_note['customer_name']:"";
						$Credit_note['dispatch_no']=$this->db->rp_getValue("dispatch_info","dispatch_no","id='".$Credit_note['dispatch_id']."'");
						$Credit_note['dispatch_no']=($Credit_note['dispatch_id']!=0)?$Credit_note['dispatch_no']:"";
						$Result[]=$Credit_note;
					}
					$ack=array("ack"=>1,"ack_msg"=>"Credit Note Found!!","result"=>$Result);
				}
				else
				{
					$ack=array("ack"=>0,"ack_msg"=>"No Credit Note Found!!");
				}
			}
			else
			{
				$ack=array("ack"=>0,"ack_msg"=>"Customer Branch Not Available Or Temporary Blocked.");
			}
		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"Customer Not Available Or Temporary Blocked.");
		}
		
		return $ack;

	}
	function GetCustomerRepoVisit($Customer,$CustomerBranch,$Filter="",$Sort="",$Limit=array(),$emp_id="")
	{
		$isCustomerAvailable=$this->isCustomerAvailable($Customer);
		
		if($isCustomerAvailable)
		{
			$isCustomerBranchAvailable=$this->isCustomerBranchAvailable($CustomerBranch);

			if($CustomerBranch=="" || $isCustomerBranchAvailable)
			{
				$WhereClause=" customer_id='".$Customer."' AND isDelete=0 AND isActive=1";
				$SortByClause="";
				$LimitClause="";
				
				if($CustomerBranch!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND customer_branch_id='".$CustomerBranch."'";
					else
					$WhereClause.=" customer_branch_id='".$CustomerBranch."'";	
				}
				$FromDate=(array_key_exists("from_date",$Filter) && $Filter['from_date']!="")?date("Y-m-d",strtotime($Filter['from_date'])):"";
				if($FromDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(created_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(created_date) >= '".date_format(date_create($Filter['from_date']),"Y-m-d")."' ";
				}

				$ToDate=(array_key_exists("to_date",$Filter) && $Filter['to_date']!="")?date("Y-m-d",strtotime($Filter['to_date'])):"";
				if($ToDate!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND DATE(created_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";
					else
					$WhereClause.="DATE(created_date) <= '".date_format(date_create($Filter['to_date']),"Y-m-d")."' ";	
				}

				if($emp_id!="")
				{
					if($WhereClause!="")
					$WhereClause.=" AND sales_repo_id='".$emp_id."' ";
					else
					$WhereClause.=" sales_repo_id='".$emp_id."' ";
				}
				if($Sort!="")
				{
					$SortByClause=$Sort;
				}
				else
				{
					$SortByClause="id DESC";
				}
				if(!empty($Limit) && isset($Limit['ul']) && isset($Limit['ll']) && $Limit['ul']!="" && $Limit['ll']!="")
				{
					$LimitClause=" ".$Limit['ul'].",".$Limit['ll'];
				}else{
					$LimitClause="";
				}


				$Credit_notes=$this->db->rp_getData("sales_repo_visit","*",$WhereClause,$SortByClause,0,$LimitClause);
				if($Credit_notes)
				{
					$Result=array();
					while($Credit_note=mysqli_fetch_assoc($Credit_notes))
					{

						$Credit_note['created_date']=($Credit_note['created_date']!="0000-00-00 00:00:00")?date("d-m-Y H:i:s",strtotime($Credit_note['created_date'])):"";
						//print_r($Credit_note['created_date1']);
						$employeess=$this->db->rp_getData('emp_personal_info',"*","isDelete=0 AND isActive=1 AND admin_type=2 AND id='".$Credit_note['sales_repo_id']."'","",0);
						if($employeess){
							$employees=mysqli_fetch_assoc($employeess);
							$Credit_note['sales_repo_name']=$employees['first_name']." ".$employees['last_name'];
						}else{
							$Credit_note['sales_repo_name']="";
						}
						$Credit_note['customer_name']=$this->db->rp_getValue("customer","name","id='".$Credit_note['customer_id']."'");
						$Credit_note['customer_name']=($Credit_note['customer_id']!=0)?$Credit_note['customer_name']:"";
						$Credit_note['customer_branch_name']=$this->db->rp_getValue("customer_branch","branch_name","id='".$Credit_note['customer_branch_id']."'");
						$Credit_note['customer_branch_name']=($Credit_note['customer_branch_id']!=0)?$Credit_note['customer_branch_name']:"";
						//$Credit_note['path']=ADMINSITEURL."credit_note_ajax_genReport.php?id=".$Credit_note['id']."&status=1";
						$Result[]=$Credit_note;
					}
					$ack=array("ack"=>1,"ack_msg"=>"Sales Repo visit Found!!","result"=>$Result);
				}
				else
				{
					$ack=array("ack"=>0,"ack_msg"=>"Sales Repo visit Note Found!!");
				}
			}
			else
			{
				$ack=array("ack"=>0,"ack_msg"=>"Customer Branch Not Available Or Temporary Blocked.");
			}
		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"Customer Not Available Or Temporary Blocked.");
		}
		
		return $ack;

	}
	function isCustomerAvailable($customer_id){
		$total_record=$this->db->rp_getTotalRecord($this->ctable,"id='".$customer_id."' AND isDelete=0",0);
		if($total_record!=0){
			return true;
		}else{
			return false;
		}
	}
	function isCustomerBranchAvailable($customer_branch_id){
		$total_record=$this->db->rp_getTotalRecord("customer_branch","id='".$customer_branch_id."' AND isDelete=0",0);
		if($total_record!=0){
			return true;
		}else{
			return false;
		}
	}
	function isDispatchAvailable($dispatch_id){
		$total_record=$this->db->rp_getTotalRecord($this->ctableDispatchInfo,"id='".$dispatch_id."' AND isDelete=0",0);
		if($total_record!=0){
			return true;
		}else{
			return false;
		}
	}
	function AddRepoVisit($cid,$cbid,$remarks,$emp_id)
	{
		if($this->isCustomerAvailable($cid))
		{
			if($this->isCustomerBranchAvailable($cbid))
			{
				$Values=array($cid,$cbid,$remarks,$emp_id,date("Y-m-d H:i:s"));
				$Columns=array("customer_id","customer_branch_id","remark","sales_repo_id","created_date");
				$RepoVisitID=$this->rp_insert("sales_repo_visit",$Values,$Columns);
				if($RepoVisitID!="")
				{
					$ack=array("ack"=>1,"ack_msg"=>"Your visit saved!!");
					$Notification=new Notification();
					$CustomerInformation=$this->getCustomerBranchDetail($cbid,"*");
					$customer_name=$CustomerInformation['customer_detail']['name'];
					$customer_branch_name=$CustomerInformation['branch_name'];
					$UsernameFirstname=$this->rp_getValue("emp_personal_info","first_name","id='".$emp_id."'");
					$UsernameLastName=$this->rp_getValue("emp_personal_info","last_name","id='".$emp_id."'");
					$emp_name=$UsernameFirstname." ".$UsernameLastName;
					$Params=array("emp_name"=>$emp_name,"customer_name"=>$customer_name."\'s ".$customer_branch_name,"date"=>date("d-m-Y H:i"));
					$notification_title=$Notification->GetNotificationTitle('SALES_REPO_VISIT_ADMIN',$Params);
					$notification_description=$Notification->GetNotificationDescription('SALES_REPO_VISIT_ADMIN',$Params);
					$notification_type=1;
					$user_id=1;
					$user_type="0";
					$type_slug="admin";
					$respective_date=date("Y-m-d H:i:s");
					$detail=array(
						"user_id"=>$user_id,
						"user_type"=>$user_type,
						"type_slug"=>$type_slug,
						"notification_type"=>$notification_type,
						"notification_title"=>$notification_title,
						"notification_description"=>$notification_description,
						"respective_date"=>$respective_date,
						"reference_id"=>$RepoVisitID,
						"reference_type"=>"sales_repo_visit",
						"created_date"=>date("Y-m-d H:i:s")
					);
					$Notification->addNotification($detail);
				}
				else
				{
					$ack=array("ack"=>0,"ack_msg"=>"Your visit could not be saved please contact your administrator.");
				}
			}
			else
			{
				$ack=array("ack"=>0,"ack_msg"=>"Customer Branch Not Available Or Temporary Blocked.");
			}

		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"Customer Not Available Or Temporary Blocked.");
		}
		return $ack;
	}



	function parseDate($date){
		if($date!="0000-00-00"){
			$date=date('d-m-Y',strtotime($date));
		}else{
			$date="";
		}
		return $date;
	}

	function sendAccountStatement($cid,$customer_name,$email,$from_date,$to_date,$subject,$body)
	{
		$aid=$this->rp_getValue($this->CtableCustomerAccount,"id","cid='".$cid."'");
		$customer_name=$this->rp_getValue($this->ctable,"name","id='".$cid."'");
		$reply=$this->DownloadCustomerAccountInfo(array('from_date'=>$from_date,'to_date'=>$to_date,'aid'=>$aid));
		if($reply['ack']==1)
		{

			 $pdf=$reply['result']['relative_pdf'];
			$Notification=new Notification();
			$System=new System();
			$Settings=$System->GetApplicationSettings();
			
			$Params=array("customer_name"=>$customer_name,"from_date"=>$from_date,"to_date"=>$to_date,"link"=>($reply['result']['pdf']));
			$notification_title=$Notification->GetNotificationTitle('ACCOUNT_STATMENT',$Params);
			$notification_description=$Notification->GetNotificationDescription('ACCOUNT_STATMENT',$Params);
			$notification_type=1;
			$user_id=$cid;
			$user_type="1";
			$type_slug="customer";
			$respective_date=date("Y-m-d H:i:s");
			$detail=array(
				"user_id"=>$user_id,
				"user_type"=>$user_type,
				"type_slug"=>$type_slug,
				"notification_type"=>$notification_type,
				"notification_title"=>$notification_title,
				"notification_description"=>$notification_description,
				"respective_date"=>$respective_date,
				"reference_id"=>$cid,
				"reference_type"=>$this->CtableCustomerAccount,
				"created_date"=>date("Y-m-d H:i:s"),
				"customers"=>array(),
			);
			$reply=$Notification->rp_sendEmail($email,$subject,$body,$Settings['default_cc'],array($pdf));
			$Notification->addCustomerNotification($detail);
			return $reply;
		}
		else
		{
			$ack=array("ack"=>0,"ack_msg"=>"Customer ".$customer_name." Report not generated!!");
			return $reply;			
		}
	}

	function sendPaymentDueNotice($cid,$customer_name,$email,$due_amount,$from_date,$to_date,$subject,$body)
	{
		$Notification=new Notification();
		$System=new System();
		$Settings=$System->GetApplicationSettings();
		$reply=$Notification->rp_sendEmail($email,$subject,$body,$Settings['default_cc'],array($pdf));
		$Params=array("customer_name"=>$customer_name,"due_amount"=>$due_amount);
		$notification_title=$Notification->GetNotificationTitle('PAYMENT_DUE',$Params);
		$notification_description=$Notification->GetNotificationDescription('PAYMENT_DUE',$Params);
		$notification_type=1;
		$user_id=$cid;
		$user_type="1";
		$type_slug="customer";
		$respective_date=date("Y-m-d H:i:s");
		$detail=array(
			"user_id"=>$user_id,
			"user_type"=>$user_type,
			"type_slug"=>$type_slug,
			"notification_type"=>$notification_type,
			"notification_title"=>$notification_title,
			"notification_description"=>$notification_description,
			"respective_date"=>$respective_date,
			"reference_id"=>0,
			"reference_type"=>"payment_due",
			"created_date"=>date("Y-m-d H:i:s"),
			"customers"=>array(),
		);
		$Notification->addCustomerNotification($detail);
		return $reply;
	}

	function AdjustInvoiceItemTaxName()
	{
		$InvoiceItems=$this->db->rp_getData("sales_invoice_item","*","item_tax=0","",0);
		if($InvoiceItems)
		{
			while($Item=mysqli_fetch_assoc($InvoiceItems))
			{
				$DispatchID=$this->db->rp_getValue("sales_invoice_info","dispatch_id","id='".$Item['sales_invoice_id']."'",0);
				$OrderId=$this->db->rp_getValue("dispatch_info","order_id","id='".$DispatchID."'",0);
				$TaxName=$this->db->rp_getValue("order_item","vat_tax_name","order_id='".$OrderId."' AND order_item_id='".$Item['item_id']."'",0);
				if($TaxName=='' || $TaxName=='-')
				{
					$TaxID="0";
				}
				else
				{
					$TaxID=$this->db->rp_getValue("tax","id","tax_name='".$TaxName."'");
					$this->db->rp_update("order_item",array("tax_id"=>$TaxID),"order_id='".$OrderId."' AND order_item_id='".$Item['item_id']."' AND vat_tax_name='".$TaxName."'",0);
					$this->db->rp_update("dipatch_item",array("dispatch_item_tax_id"=>$TaxID),"dispatch_id='".$DispatchID."' AND dispatch_item_id='".$Item['item_id']."'");
					$this->db->rp_update("sales_invoice_item",array("item_tax"=>$TaxID),"sales_invoice_id='".$Item['sales_invoice_id']."' AND item_id='".$Item['item_id']."'");
				}
				
			}
		}
	}
}

?>