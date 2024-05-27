<?php
//require_once("main.class.php");
require_once("function.class.php");
require_once("class.log.php");
require_once("class.system.php");
require_once("notification.class.php");
class Employee extends Functions
{
	public $db,$log;
	public $etable="employee";
	public $ctable="emp_personal_info";
	public $ectable="emp_company_info";
	public $estable="emp_salary_info";
	public $CtableEmployeeAccount="employee_account";
	public $CtableEmployeeAccountTransaction="employee_account_transcation";
	public $CtableCommissionLog="o_sales_commission_log";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;		   
		$system = new System();
		$this->notification=new Notification();	
		$this->log=new Log();	
		$this->system=$system;			
    } 
	public function InsertEmpPersonalInfo($detail,$file)
	{
		extract($detail);
		$dup_where = "email = '".$email."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
		
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate code","ack_msg"=>"Already Exist this Email!!");
			return $reply;
		}
		else
		{
			//$error="";
				if (isset($file["image_path"]) ) {
					$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
					$temp = explode(".", $file["image_path"]["name"]);
					 $extension = end($temp);
				 
						$fileName 	= $this->db->clean($file["image_path"]["name"]);	
						if($fileName!=""){
						$fileSize 	= round($file["image_path"]["size"]); // BYTES									
						$adate 		= date('Y-m-d H:i:m');
						
						$extension	= end(explode(".", $fileName));				
						$fileName	= 'emp_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/employee/".$fileName;						
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						}
						else{
							$fileName="";
						}
                        if (isset($file["file_document"]) ) {
						$allowedExts1 = array("pdf","xlsx","txt","xls","docx");
						$temp1 = explode(".", $file["file_document"]["name"]);
						 $extension1 = end($temp1);
					 
						
						$fileName_document 	= $this->db->clean($file["file_document"]["name"]);
						if($fileName_document!=""){
						$fileSize 	= round($file["file_document"]["size"]); // BYTES									
						$adate 		= date('Y-m-d H:i:m');
						
						$extension1	= end(explode(".", $fileName_document));				
					    $proof_document	= 'emp_document_'.substr(sha1(time()), 0, 6).".".$extension1;
						$filePath1 	= "../images/employee/document/".$proof_document;
						move_uploaded_file($file['file_document']['tmp_name'], $filePath1);
						}
						else{
							$proof_document="";
						}
						$no=str_pad($this->db->getLastInsertId($this->ctable), 2, 0, STR_PAD_LEFT);
						$emp_code		=EMP_NO.$no;
						
						if($designation==""){
							$designation_slug="";
						}
						else{
							$designation_slug=$this->db->rp_getValue("designation","slug","id='".$designation."'");
						}
						if (isset($file["file_document1"]) ) {
							$allowedExts = array("pdf","xlsx","txt","xls","docx");
							$temp = explode(".", $file["file_document1"]["name"]);
							 $extension = end($temp);
						 
								$proof_document1 	= $this->db->clean($file["file_document1"]["name"]);	
								if($proof_document1!=""){
								$fileSize 	= round($file["file_document1"]["size"]); // BYTES									
								$adate 		= date('Y-m-d H:i:m');
								
								$extension	= end(explode(".", $proof_document1));		
								if(!in_array($extension,$allowedExts))
								{
									$file_error=true;
								}						
								 $proof_document1	= 'image1_'.substr(sha1(time()), 0, 6).".".$extension;
								 $filePath2 	= "../images/employee/document/".$proof_document1;					
								 $file['file_document1']['tmp_name'];
								move_uploaded_file($file['file_document1']['tmp_name'], $filePath2);
								
								$new_image=true;
								}
								else{
									$proof_document1="";
								}
						}
						else
						{
							$new_image=false;
						}
						if (isset($file["file_document2"]) ) {
							$allowedExts = array("pdf","xlsx","txt","xls","docx");
							$temp = explode(".", $file["file_document2"]["name"]);
							 $extension = end($temp);
						 
								$proof_document2 	= $this->db->clean($file["file_document2"]["name"]);	
								if($proof_document2!=""){
								$fileSize 	= round($file["file_document2"]["size"]); // BYTES									
								$adate 		= date('Y-m-d H:i:m');
								
								$extension	= end(explode(".", $proof_document2));		
								if(!in_array($extension,$allowedExts))
								{
									$file_error=true;
								}						
								 $proof_document2	= 'image2_'.substr(sha1(time()), 0, 6).".".$extension;
								 $filePath2 	= "../images/employee/document/".$proof_document2;					
								 $file['file_document2']['tmp_name'];
								move_uploaded_file($file['file_document2']['tmp_name'], $filePath2);
								
								$new_image=true;
								}
								else{
									$proof_document2="";
								}
						}
						else
						{
							$new_image=false;
						}
						if (isset($file["file_document3"]) ) {
							$allowedExts = array("pdf","xlsx","txt","xls","docx");
							$temp = explode(".", $file["file_document3"]["name"]);
							 $extension = end($temp);
						 
								$proof_document3 	= $this->db->clean($file["file_document3"]["name"]);	
								if($proof_document3!=""){
								$fileSize 	= round($file["file_document3"]["size"]); // BYTES									
								$adate 		= date('Y-m-d H:i:m');
								
								$extension	= end(explode(".", $proof_document3));		
								if(!in_array($extension,$allowedExts))
								{
									$file_error=true;
								}						
								 $proof_document3	= 'image3_'.substr(sha1(time()), 0, 6).".".$extension;
								 $filePath2 	= "../images/employee/document/".$proof_document3;					
								 $file['file_document3']['tmp_name'];
								move_uploaded_file($file['file_document3']['tmp_name'], $filePath2);
								
								$new_image=true;
								}
								else{
									$proof_document3="";
								}
						}
						else
						{
							$new_image=false;
						}
						$expire_date=($expire_date!="")?date('Y-m-d',strtotime($expire_date)):"";
						$issue_date=($issue_date!="")?date('Y-m-d',strtotime($issue_date)):"";
						// Update User Profile Image in database
						$adate	= date('Y-m-d H:i:s');
						$rows 	= array(
									"emp_code",
									"first_name",
									"middle_name",
									"last_name",
									"email",
									"password",
									"phone",
									"other_contact",
									"perment_address",
									"residential_address",
									"birth_date",
									"blood_group",
									"remark",
									"identification_proof",
									"proof_document",
									"proof_document1",
									"proof_document2",
									"proof_document3",
									"image",
									"isActive",
									"designation",
									"designation_slug",
									"department",
									"issue_by",
									"issue_date",
									"expire_date",
									"id_no",
									"admin_type",
									"adate"
								);
						$values = array(
									$emp_code,
									$first_name,
									$middle_name,
									$last_name,
									$email,
									md5($password),
									$phone,
									$other_contact,
									$perment_address,
									$residential_address,
									$birth_date,
									$blood_group,
									$remark,
									$identification_proof,
									$proof_document,
									$proof_document1,
									$proof_document2,
									$proof_document3,
									$fileName,
									$isActive,
									$designation,
									$designation_slug,
									$department,
									$issue_by,
									$issue_date,
									$expire_date,
									$id_no,
									$admin_type,
									$adate
								);
								
						$eid = $this->db->rp_insert($this->ctable,$values,$rows,0);
						
						$this->log->insertLog($this->ctable,$eid,"insert",$this->log->slm['EMP_PERSONAL_INFO_INSERT']." : ".$first_name);
						//$var=mysqli_query($this->conn,$emp_img_insert);
					
						
				
				
			}
			if($eid!=0)
			{
				$last_account_id=$this->db->rp_getValue("employee_account","MAX(id)","isDelete=0",0);
														
				$last_account_no=$this->db->rp_getValue("employee_account","account_number","id=".$last_account_id."",0);
				
				if($last_account_no=="")
				{
					$last_account_no="0001";
				}
				else
				{
					 $last_account_no=str_pad($last_account_no+1, 4, 0, STR_PAD_LEFT);
					
				}
				$rows=array("employee_name",
							"eid",
							"add_date",
							"account_number");
				$values=array($first_name,
							$eid,
							$adate,
							$last_account_no);
							
				$account_info_insert=$this->db->rp_insert("employee_account",$values,$rows,0);
				
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMP_PERSONAL_INFO_INSERT',1),"ack_msg"=>$this->log->getMessage('EMP_PERSONAL_INFO_INSERT'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Insert Employee Failed.");
				return $reply;
			}
			}
		}
	 }
	public function UpdateEmpPersonalInfo($detail,$file)
	{
		extract($detail);
		$dup_where = "email = '".$email."' AND id!='".$_REQUEST['id']."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
		if($r){
		$reply=array("ack"=>0,"developer_msg"=>"Duplicate code","ack_msg"=>"Already Exist this Email!!");
			return $reply;

			}else{
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
					
						$fileName	= 'emp_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/employee/".$fileName;						
						move_uploaded_file($file['image_path']['tmp_name'], $filePath);
						$image=$fileName;
						
						unset($detail['old_image_path']);
						
					}
					else
					{
						$image=$detail['old_image_path'];
						
						unset($detail['old_image_path']);
						
					}
				
				if (isset($file["file_document"]) && $file["file_document"]['size']!=0) 
					{
						
						$allowedExts1 = array("jpg","jpeg","png","gif","JPG","JPEG");
						$temp1 = explode(".", $file["file_document"]["name"]);
						$extension1 = end($temp1);
						
						$fileName_document 	= $this->db->clean($file["file_document"]["name"]);
						$fileSize 	= round($file["file_document"]["size"]); // BYTES									
						$adate 		= date('Y-m-d H:i:m');
						
						$extension = end(explode(".", $fileName));
					
						$extension1	= end(explode(".", $fileName_document));				
					    $proof_document	= 'emp_document_'.substr(sha1(time()), 0, 6).".".$extension1;
						$filePath1 	= "../images/employee/document/".$proof_document;
						move_uploaded_file($file['file_document']['tmp_name'], $filePath1);
						
						
						unset($detail['old_file_path']);
						
					}
					else
					{
						$proof_document=$detail['old_file_path'];
						unset($detail['old_file_path']);
					}
					if($designation==""){
						$designation_slug="";
					}
					else{
						$designation_slug=$this->db->rp_getValue("designation","slug","id='".$designation."'");
					}
						if (isset($file["file_document1"]) ) {
							$allowedExts = array("pdf","xlsx","txt","xls","docx");
							$temp = explode(".", $file["file_document1"]["name"]);
							 $extension = end($temp);
						 
								$proof_document1 	= $this->db->clean($file["file_document1"]["name"]);	
								if($proof_document1!=""){
								$fileSize 	= round($file["file_document1"]["size"]); // BYTES									
								$adate 		= date('Y-m-d H:i:m');
								
								$extension	= end(explode(".", $proof_document1));		
								if(!in_array($extension,$allowedExts))
								{
									$file_error=true;
								}						
								 $proof_document1	= 'image1_'.substr(sha1(time()), 0, 6).".".$extension;
								 $filePath2 	= "../images/employee/document/".$proof_document1;					
								 $file['file_document1']['tmp_name'];
								move_uploaded_file($file['file_document1']['tmp_name'], $filePath2);
								
								$new_image=true;
								}
								else{
									$proof_document1="";
								}
						}
						else
						{
							$new_image=false;
						}
						if (isset($file["file_document2"]) ) {
							$allowedExts = array("pdf","xlsx","txt","xls","docx");
							$temp = explode(".", $file["file_document2"]["name"]);
							 $extension = end($temp);
						 
								$proof_document2 	= $this->db->clean($file["file_document2"]["name"]);	
								if($proof_document2!=""){
								$fileSize 	= round($file["file_document2"]["size"]); // BYTES									
								$adate 		= date('Y-m-d H:i:m');
								
								$extension	= end(explode(".", $proof_document2));		
								if(!in_array($extension,$allowedExts))
								{
									$file_error=true;
								}						
								 $proof_document2	= 'image2_'.substr(sha1(time()), 0, 6).".".$extension;
								 $filePath2 	= "../images/employee/document/".$proof_document2;					
								 $file['file_document2']['tmp_name'];
								move_uploaded_file($file['file_document2']['tmp_name'], $filePath2);
								
								$new_image=true;
								}
								else{
									$proof_document2="";
								}
						}
						else
						{
							$new_image=false;
						}
						if (isset($file["file_document3"]) ) {
							$allowedExts = array("pdf","xlsx","txt","xls","docx");
							$temp = explode(".", $file["file_document3"]["name"]);
							 $extension = end($temp);
						 
								$proof_document3 	= $this->db->clean($file["file_document3"]["name"]);	
								if($proof_document3!=""){
								$fileSize 	= round($file["file_document3"]["size"]); // BYTES									
								$adate 		= date('Y-m-d H:i:m');
								
								$extension	= end(explode(".", $proof_document3));		
								if(!in_array($extension,$allowedExts))
								{
									$file_error=true;
								}						
								 $proof_document3	= 'image3_'.substr(sha1(time()), 0, 6).".".$extension;
								 $filePath2 	= "../images/employee/document/".$proof_document3;					
								 $file['file_document3']['tmp_name'];
								move_uploaded_file($file['file_document3']['tmp_name'], $filePath2);
								
								$new_image=true;
								}
								else{
									$proof_document3="";
								}
						}
						else
						{
							$new_image=false;
						}
					$expire_date=($expire_date!="")?date('Y-m-d',strtotime($expire_date)):"";
					$issue_date=($issue_date!="")?date('Y-m-d',strtotime($issue_date)):"";
				$rows 	= array(
							"first_name"		=> $first_name,
							"middle_name"		=> $middle_name,							
							"last_name"			=> $last_name,
							"email"				=> $email,
							"phone"				=> $phone,
							"other_contact"		=> $other_contact,
							"perment_address"	=> $perment_address,
							"residential_address"=> $residential_address,
							"birth_date"		=> $birth_date,
							"blood_group"		=> $blood_group,
							"remark"			=> $remark,
							"image"			=> $image,
							"proof_document"			=> $proof_document,
							"proof_document1"			=> $proof_document1,
							"proof_document2"			=> $proof_document2,
							"proof_document3"			=> $proof_document3,
							"identification_proof"=> $identification_proof,
							"designation"	=> $designation,
							"designation_slug"	=> $designation_slug,
							"department"	=> $department,
							"issue_by"=>$issue_by,
							"issue_date"=>$issue_date,
							"expire_date"=>$expire_date,
							"id_no"=>$id_no,
							"admin_type"=>$admin_type,
						);
				$where	= "id='".$_REQUEST['id']."'";
				$eid=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['EMP_PERSONAL_INFO_UPDATE']." : ".$first_name);
				if($eid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMP_PERSONAL_INFO_UPDATE',1),"ack_msg"=>$this->log->getMessage('EMP_PERSONAL_INFO_UPDATE'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Update Employee Failed.");
					return $reply;
				}
			}	
		}	
	public function getEmpPersonalInfo($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		$result['emp_code']				= htmlentities($ctable_d['emp_code']);
		$result['first_name']			= htmlentities($ctable_d['first_name']);
		$result['email']			= htmlentities($ctable_d['email']);
		$result['middle_name']			= htmlentities($ctable_d['middle_name']);
		$result['last_name']			= stripslashes($ctable_d['last_name']);
		$result['phone']				= stripslashes($ctable_d['phone']);
		$result['other_contact']		= stripslashes($ctable_d['other_contact']);
		$result['perment_address']		= stripslashes($ctable_d['perment_address']);
		$result['residential_address']	= stripslashes($ctable_d['residential_address']);
		$result['birth_date']			= htmlentities(date_format(date_create($ctable_d["birth_date"]),"d-m-Y"));
		$result['blood_group']			= htmlentities($ctable_d['blood_group']);
		$result['image']				= htmlentities($ctable_d['image']);
		$result['remark']				= stripslashes($ctable_d['remark']);
		$result['identification_proof']	= $ctable_d['identification_proof'];
		$result['proof_document']	= $ctable_d['proof_document'];
		$result['proof_document1']	= $ctable_d['proof_document1'];
		$result['proof_document2']	= $ctable_d['proof_document2'];
		$result['proof_document3']	= $ctable_d['proof_document3'];
		$result['designation']			= htmlentities($ctable_d['designation']);
		$result['department']			= htmlentities($ctable_d['department']);
		$result['joining_date']			= htmlentities(date_format(date_create($ctable_d["joining_date"]),"d-m-Y"));
		$result['account_number']		= stripslashes($ctable_d['account_number']);
		$result['bank_name']			= stripslashes($ctable_d['bank_name']);
		$result['id_no']			= stripslashes($ctable_d['id_no']);
		$result['expire_date']			= ($ctable_d['expire_date']!="0000-00-00")?date('d-m-Y',strtotime($ctable_d['expire_date'])):"";
		$result['issue_date']			= ($ctable_d['issue_date']!="0000-00-00")?date('d-m-Y',strtotime($ctable_d['issue_date'])):"";
		$result['issue_by']			= stripslashes($ctable_d['issue_by']);
		$result['sort_code']			= stripslashes($ctable_d['sort_code']);
		$result['ifsc_no']			= stripslashes($ctable_d['ifsc_no']);
		$result['admin_type']			= stripslashes($ctable_d['admin_type']);
		
		$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Update Employee Successfully.","result"=>$result);
		return $reply;
	
	}	
	public function getAllEmpPersonalInfo()
	{		
		$result=array();
		$where = " isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where,"",0);
		while($ctable_d = mysqli_fetch_assoc($ctable_r)){
			$r[]=$ctable_d;
		}
		$result=$r;
		$reply=array("ack"=>1,"ack_msg"=>$this->log->getMessage('SERVICE_SALES_EXECUTIVE_GET_SUCESS',1),
					"developer_msg"=>$this->log->getMessage('SERVICE_SALES_EXECUTIVE_GET_SUCESS'),"result"=>$result);
		return $reply;
	
	}	
	
	public function DeleteEmpPersonalInfo($detail)
	{
		$first_name=$this->db->rp_getValue($this->ctable,"first_name","isDelete=0 AND id='".$detail['id']."'");
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$eid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['EMP_PERSONAL_INFO_DELETE']." : ".$first_name);
			if($eid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMP_PERSONAL_INFO_DELETE',1),"ack_msg"=>$this->log->getMessage('EMP_PERSONAL_INFO_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete Employee Failed.");
				return $reply;
			}
	}

	public function isSalaryInfoAvailable($detail)
	{
		$count=$this->db->rp_getTotalRecord($this->estable,"emp_id='".$detail['emp_id']."'");
		if($count>=1)
		{
			$reply=array("ack"=>1,"developer_msg"=>"Yes Company Info Available!!.","ack_msg"=>"");
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"No Company Info Not Available!!.","ack_msg"=>"");
			return $reply;
		}
		
	}
	public function InsertEmpSalaryInfo($detail) 
	{ 
		extract($detail);
		$first_name=$this->db->rp_getValue("emp_personal_info","first_name","isDelete=0 AND id='".$emp_id."'");
		$dup_where = "emp_id = '".$emp_id."' AND isDelete=0";
		$r = $this->db->rp_dupCheck($this->estable,$dup_where,0);
		
		if($r){
			$reply=array("ack"=>0,"developer_msg"=>"Duplicate id","ack_msg"=>"Already Exist this id!!");
			return $reply;
		}
		else
		{
			 $adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"emp_id",
						"basic",
						"hra",
						"medical",
						"conv",
						"wash",
						"edu",
						"lt",
						"spe",
						"gross",
						"it",
						"pt",
						"pf",
						"net_payable",
						"remark",
						"isActive",
						"adate"
					);
			$values = array(
						$emp_id,
						$basic,
						$hra,
						$medical,
						$conv,
						$wash,
						$edu,
						$lt,
						$spe,
						$gross,
						$it,
						$pt,
						$pf,
						$net_payable,
						$remark,
						$isActive,
						$adate
					);
					
		 	$eid = $this->db->rp_insert($this->estable,$values,$rows,0);
			$this->log->insertLog($this->estable,$eid,"insert",$this->log->slm['EMP_SALARY_INFO_INSERT']." : ".$first_name);
			if($eid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMP_SALARY_INFO_INSERT',1),"ack_msg"=>$this->log->getMessage('EMP_SALARY_INFO_INSERT'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Insert Record Failed.");
				return $reply;
			}
		}
	 }
	public function UpdateEmpSalaryInfo($detail)
	{
			extract($detail);
			$first_name=$this->db->rp_getValue("emp_personal_info","first_name","isDelete=0 AND id='".$emp_id."'");
			$dup_where = "emp_id = '".$emp_id."' AND isDelete=0";
			$r = $this->db->rp_dupCheck($this->estable,$dup_where);
			if($r){
				$this->db->rp_location("add_".$ctable.".php?mode=edit&id=".$_REQUEST['id']."&msg=duplicate");
				die;
			}else{
				$rows 	= array(
							"basic"			=> $basic,
							"hra"			=> $hra,
							"medical"		=> $medical,
							"conv"			=> $conv,
							"wash"			=> $wash,
							"edu"			=> $edu,
							"lt"			=> $lt,
							"spe"			=> $spe,
							"gross"			=> $gross,
							"it"			=> $it,
							"pt"			=> $pt,
							"pf"			=> $pf,
							"net_payable"	=> $net_payable,
							"remark"		=> $remark,
						);
				$where	= "emp_id='".$emp_id."'";
				$eid=$this->db->rp_update($this->estable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['EMP_SALARY_INFO_UPDATE']." : ".$first_name);
				if($eid!=0)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMP_SALARY_INFO_UPDATE',1),"ack_msg"=>$this->log->getMessage('EMP_SALARY_INFO_UPDATE'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Update Record Failed.");
					return $reply;
				}
			}	
		}	
	public function getEmpSalaryInfo($detail)
	{		
		$where = " emp_id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->estable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			$result['basic']			= htmlentities($ctable_d['basic']);
			$result['hra']				= htmlentities($ctable_d['hra']);
			$result['medical']			= stripslashes($ctable_d['medical']);
			$result['conv']				= stripslashes($ctable_d['conv']);
			$result['wash']				= stripslashes($ctable_d['wash']);
			$result['edu']				= stripslashes($ctable_d['edu']);
			$result['lt']				= stripslashes($ctable_d['lt']);
			$result['spe']				= stripslashes($ctable_d['spe']);
			$result['gross']			= stripslashes($ctable_d['gross']);
			$result['it']				= stripslashes($ctable_d['it']);
			$result['pt']				= stripslashes($ctable_d['pt']);
			$result['pf']				= stripslashes($ctable_d['pf']);
			$result['net_payable']		= stripslashes($ctable_d['net_payable']);
			$result['remark']			= stripslashes($ctable_d['remark']);
			
			$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Update Record Successfully.","result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Comapny detail not fetched!!.","ack_msg"=>"Success! Company Info Fetched"	);
			return $reply;
		}
		
	
	}
	public function getSalaryInfo($detail)
	{		
		$where = " emp_id='".$detail['emp_id']."' AND id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->estable,"*",$where,"",0);
		if($ctable_r)
		{
			$ctable_d = mysqli_fetch_array($ctable_r);
			$result=array();
			$result['basic']			= htmlentities($ctable_d['basic']);
			$result['hra']				= htmlentities($ctable_d['hra']);
			$result['medical']			= stripslashes($ctable_d['medical']);
			$result['conv']				= stripslashes($ctable_d['conv']);
			$result['wash']				= stripslashes($ctable_d['wash']);
			$result['edu']				= stripslashes($ctable_d['edu']);
			$result['lt']				= stripslashes($ctable_d['lt']);
			$result['spe']				= stripslashes($ctable_d['spe']);
			$result['gross']			= stripslashes($ctable_d['gross']);
			$result['it']				= stripslashes($ctable_d['it']);
			$result['pt']				= stripslashes($ctable_d['pt']);
			$result['pf']				= stripslashes($ctable_d['pf']);
			$result['net_payable']		= stripslashes($ctable_d['net_payable']);
			$result['remark']			= stripslashes($ctable_d['remark']);
			$result['year']			= stripslashes($ctable_d['year']);
			
			$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Update Record Successfully.","result"=>$result);
			return $reply;
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Comapny detail not fetched!!.","ack_msg"=>"Success! Company Info Fetched"	);
			return $reply;
		}
		
	
	}
	
	public function DeleteEmpsalaryInfo($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		);
			$where	= "id='".$_REQUEST['id']."'";
			$emp_id=$this->db->rp_getValue($this->estable,"emp_id","isDelete=0 AND id='".$_REQUEST['id']."'");
			$first_name=$this->db->rp_getValue("emp_personal_info","first_name","isDelete=0 AND id='".$emp_id."'");
			$eid=$this->db->rp_update($this->estable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['EMP_SALARY_INFO_DELETE']." : ".$first_name);
			if($eid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMP_SALARY_INFO_DELETE',1),"ack_msg"=>$this->log->getMessage('EMP_SALARY_INFO_DELETE'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Delete record Failed.");
				return $reply;
			}
	}
	public function updateEmpImage($file,$id)
	{
				$error="";
				if (isset($file["file"])) {
					$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
					$temp = explode(".", $file["file"]["name"]);
					 $extension = end($temp);
				 
					if($file["file"]["error"]>0) {
						$error .= "Error opening the file. ";
					}
					if($file["file"]["type"]=="application/x-msdownload"){	
						$error .= "Mime type not allowed. ";
					}
					if(!in_array($extension, $allowedExts)){
						$error .= "Extension not allowed. ";
					}
					if($file["file"]["size"] > 26214400){ //26214400 Bytes = 25 MB, 102400 = 100KB
						$error .= "File size shoud be less than 25 MB ";
					}
					if($error=="") { 
						
						$fileName 	= $this->db->clean($file["file"]["name"]);			
						$fileSize 	= round($file["file"]["size"]); // BYTES									
						$adate 		= date('Y-m-d H:i:m');
						
						$extension	= end(explode(".", $fileName));						
						$fileName	= '_emp_image_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/employee/".$fileName;						
						move_uploaded_file($file['file']['tmp_name'], $filePath);
						
						// Update User Profile Image in database
						$values=array("image"=>$fileName);
						$where="id='".$_REQUEST['id']."' ";
						$emp_img_update=$this->db->rp_update("emp_personal_info",$values,$where,0);
						$var=mysqli_query($this->conn,$emp_img_update);
					
						$reply=array("ack"=>1,"developer_msg"=>"image successfully uploaded!!","ack_msg"=>"Image successfully uploaded!!");
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"image type not valid","ack_msg"=>"Invalid image or image not found.");
						return $reply;
					} 
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"image type not valid","ack_msg"=>"Invalid image or image not found.");
					return $reply;
				}
			
	}
	
	public function UpdateEmpDocument($file,$id)
	{
				$error="";
				if (isset($file["file_document"])) {
					$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
					$temp = explode(".", $file["file_document"]["name"]);
					 $extension = end($temp);
				 
					if($file["file_document"]["error"]>0) {
						$error .= "Error opening the file. ";
					}
					if($file["file_document"]["type"]=="application/x-msdownload"){	
						$error .= "Mime type not allowed. ";
					}
					if(!in_array($extension, $allowedExts)){
						$error .= "Extension not allowed. ";
					}
					if($file["file_document"]["size"] > 26214400){ //26214400 Bytes = 25 MB, 102400 = 100KB
						$error .= "File size shoud be less than 25 MB ";
					}
					if($error=="") { 
						
						$fileName 	= $this->db->clean($file["file_document"]["name"]);			
						$fileSize 	= round($file["file_document"]["size"]); // BYTES									
						$adate 		= date('Y-m-d H:i:m');
						
						$extension	= end(explode(".", $fileName));						
						$fileName	= '_emp_document_'.substr(sha1(time()), 0, 6).".".$extension;
						$filePath 	= "../images/employee/document/".$fileName;						
						move_uploaded_file($file['file_document']['tmp_name'], $filePath);
						
						// Update User Profile Image in database
						$values=array("proof_document"=>$fileName);
						$where="id='".$_REQUEST['id']."' ";
						$emp_img_update=$this->db->rp_update("emp_personal_info",$values,$where,0);
						$var=mysqli_query($this->conn,$emp_img_update);
					
						$reply=array("ack"=>1,"developer_msg"=>"image successfully uploaded!!","ack_msg"=>"Employee Successfully Updated!!");
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>"image type not valid","ack_msg"=>"Invalid image or image not found.");
						return $reply;
					} 
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"image type not valid","ack_msg"=>"Invalid image or image not found.");
					return $reply;
				}
		}	
	public function debitAmount($employee_id,$employee_aid,$amount,$remark,$ref_id,$ref_type){
		$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"employee_id", 
						"employee_aid", 
						"type",
						"debit",
						"entry_date",
						"details",
						"reference_id",
						"reference_type",
						"created_date",
					);
			$values = array(
						$employee_id,
						$employee_aid,
						'debit',
						"-".$amount,
						date('Y-m-d'),
						$remark,
						$ref_id,
						$ref_type,
						$adate,
					);
					
		 	$uid = $this->db->rp_insert("employee_account_transcation",$values,$rows,0);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Employee Debit Amount Successfully","ack_msg"=>"Success!Employee Debit Amount Successfully.");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Debit Amount Failed.");
				return $reply;
			}
	}
	function creditAmount($employee_id,$employee_aid,$amount,$remark,$ref_id,$ref_type){
		$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"employee_id", 
						"employee_aid", 
						"reference_id",						
						"reference_type",						
						"type",
						"credit",
						"entry_date",
						"details",
						"created_date",
					);
			$values = array(
						$employee_id,
						$employee_aid,
						$ref_id,
						$ref_type,
						'credit',
						"+".$amount,
						date('Y-m-d'),
						$remark,
						$adate,
					);
					
		 			
		 	$TransactionID = $this->db->rp_insert("employee_account_transcation",$values,$rows,0);
			if($TransactionID!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Employee Debit Amount Successfully","ack_msg"=>"Success!Employee Debit Amount Successfully.","transaction_id"=>$TransactionID);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Debit Amount Failed.");
				return $reply;
			}
	}
	function employeeCreditAmount($cbid,$employee_id,$employee_aid,$amount,$remark,$ref_id,$ref_type,$payment_type){
		
		$adate	= date('Y-m-d H:i:s');
			$rows 	= array(
						"employee_id", 
						"cbid", 
						"employee_aid", 
						"reference_id",						
						"reference_type",						
						"type",
						"credit",
						"entry_date",
						"details",
						"created_date",
						"status",
						"status_slug",
						"payment_type",
					);
			$values = array(
						$employee_id,
						$cbid,
						$employee_aid,
						$ref_id,
						$ref_type,
						'credit',
						"+".$amount,
						date('Y-m-d'),
						$remark,
						$adate,
						0,
						"waiting for apporoval",
						$payment_type,
					);
					
		 			
		 	$uid = $this->db->rp_insert("employee_payment_approved",$values,$rows,0);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>"Employee Credit Amount Successfully","ack_msg"=>"Success!Employee Debit Amount Successfully.","emp_id"=>$uid);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Database error!!","ack_msg"=>"Failed! Credit Amount Failed.");
				return $reply;
			}
	}

	function loginEmployee($detail,$require_column)
    {

		if(!empty($detail))
        {
                $countFromemail=$this->countEmployee("email",$detail['email']);
                if($countFromemail>=1)
                {
					$require_column=$this->system->getRequiredColumns($require_column);
					$detail['password']=md5($detail['password']);
					$employee=$this->db->rp_getData($this->ctable,$require_column,"email='".$detail['email']."' AND password='".$detail['password']."' AND isDelete=0 AND isActive=1",1);
                   	
                   	$closing_amount=0;
					if($employee)
					{
						$employee=mysqli_fetch_assoc($employee);
						$employee['birth_date']=date('d-m-Y',strtotime($employee['birth_date']));
						$employee['joining_date']=date('d-m-Y',strtotime($employee['joining_date']));
						$vehicals=$this->db->rp_getData("vehical","*","driver_id='".$employee['id']."'","",0);
                   		$closing_amount=0;
						if($vehicals)
						{
							$vehical=mysqli_fetch_assoc($vehicals);
							$employee['vehical']=$vehical;
							
							$vehicals_stock=$this->db->rp_getData("vehical_map_stock","*","vehical_id='".$vehical['id']."'","",0);
					   
							if($vehicals_stock)
							{
								$vehicals_stock=mysqli_fetch_assoc($vehicals_stock);
								$employee['vehical_stock']=$vehicals_stock;
							}
							$employees=$this->db->rp_getData("employee_account_transcation","*","employee_id='".$employee['id']."'","",0);
								$closing_amount=0;
								if($employees)
								{
								
									$total_debit=0;
									$total_credit=0;
									while($customer=mysqli_fetch_assoc($employees)){
										
										$total_debit+=$customer['debit'];
										$total_credit+=$customer['credit'];
										
									}
									if($total_debit>$total_credit)
									{
										$closing_amount=$total_debit-$total_credit;
										$closing_amount=round($closing_amount,2);
									}
									if($total_debit<$total_credit)
									{
										$closing_amount=$total_credit-$total_debit;
										$closing_amount=round($closing_amount,2);
									}
									
								}
								
						}else{
							// change by hardip
							$employee['vehical']=array("id"=>"","vehical_name"=>"","vehical_no"=>""); 
							$employee['vehical_stock']="";
						}
						$employee['closing_balance']=$closing_amount;
						$this->db->rp_update($this->ctable,array("imei"=>$detail['imei'],"refreshToken"=>$detail['refreshToken']),"email='".$detail['email']."'");
						if($employee['admin_type']!=0)
						{
							$employee['rights']=array(
								"order"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"invoice"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"credit_note"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"dispatch"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"payment"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"return"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"visit"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"account"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
								"picklist"=>array("view"=>0,"insert"=>0,"delete"=>0,"update"=>0),
							);
							$RightsR=$this->rp_getData("page_admin_right","*","id='".$employee['admin_type']."'");
							if($RightsR)
							{
								$Rights=array();
								while($R=mysqli_fetch_assoc($Rights))
								{
									$Right=array("view"=>$R['view_flag'],'insert'=>$R['insert_flag'],'update'=>$R['update_flag'],'delete'=>$R['delete_flag']);
									if($R['page_id']==414)
									{
										$employee['rights']['order']=$Right;
									}
									else if($R['page_id']==434)
									{
										$employee['rights']['invoice']=$Right;
									}
									else if($R['page_id']==445)
									{
										$employee['rights']['credit_note']=$Right;
									}
									else if($R['page_id']==444)
									{
										$employee['rights']['dispatch']=$Right;
									}
									else if($R['page_id']==447)
									{
										$employee['rights']['payment']=$Right;
									}
									else if($R['page_id']==448)
									{
										$employee['rights']['return']=$Right;
									}
									else if($R['page_id']==462)
									{
										$employee['rights']['visit']=$Right;
									}
									else if($R['page_id']==453)
									{
										$employee['rights']['account']=$Right;
									}
									else if($R['page_id']==460)
									{
										$employee['rights']['picklist']=$Right;
									}
								}
								
							}

						}
						else
						{
							$employee['rights']=array(
								"order"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"invoice"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"credit_note"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"dispatch"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"payment"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"return"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"visit"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"account"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
								"picklist"=>array("view"=>1,"insert"=>1,"delete"=>1,"update"=>1),
							);
						}
						
						$total_record=$this->db->rp_getTotalRecord("refresh_token_executive","imei='".$detail['imei']."'",0);
						if($total_record==0){
							$this->db->rp_insert("refresh_token_executive",array($employee['id'],$detail['imei'],$detail['refreshToken']),array("user_id","imei","refresh_token"),0);
						}else{
							$this->db->rp_update("refresh_token_executive",array("user_id"=>$employee['id'],"refresh_token"=>$detail['refreshToken']),"imei='".$detail['imei']."'");
						}

						$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_SUCESS',1),"ack_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_SUCESS'),"result"=>$employee);
						return $reply;
					}
					else
					{
						$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_FAILED',1),"ack_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_FAILED'));
						return $reply;
					}
                    
                }
                else
                {
                    $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_NOT_REGISTERED',1),"ack_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_NOT_REGISTERED'));
                    return $reply;
                }
        }
        else
        {
            $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_NOT_FOUND',1),"ack_msg"=>$this->log->getMessage('EMPLOYEE_LOGIN_NOT_FOUND'));
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
				$name=$this->db->rp_getValue($this->ctable,"frist_name","email='".$email."'",0);
				$phone=$this->db->rp_getValue($this->ctable,"phone","email='".$email."'",0);
				
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
		$count=$this->countEmployee("email",$email);					
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
	function UpdateEmployeeProfile($detail,$require_column=array())
	{
		extract($detail);
		$count=$this->countEmployee("id",$employee_id);					
		if($count>0)
		{
			$require_column=$this->system->getRequiredColumns($require_column);
			$user_detail=$this->getEmployeeDetail($employee_id,$require_column);
			$dup_where = "email = '".$email."' AND id!='".$employee_id."' AND isDelete=0 AND isActive=1";
			$r = $this->db->rp_dupCheck($this->ctable,$dup_where,0);
			if($r){
				
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND',1),"ack_msg"=>$this->log->getMessage('DUPLICATE_EMAIL_FOUND'),"result"=>$user_detail);
				return $reply;
			}
			else{
				
				$created_date=date('Y-m-d H:i:s');
				$rows 	= array(
						"first_name"	=> $first_name,
						"last_name"		=> $last_name,
						"middle_name"	=> $middle_name,
						"address"		=> $address,
						"phone"			=> $cellphone,
						"email"			=> $email,
					);
				$where	= "id='".$employee_id."'";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where,0);
				$this->log->insertLog($this->ctable,$employee_id,"update",$this->log->slm['EMPLOYEE_PROFILE_UPDATE_SUCESS']." : ".$name);
			
						
				if($isUpdated)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('EMPLOYEE_PROFILE_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('EMPLOYEE_PROFILE_UPDATE_SUCESS'),"result"=>$user_detail);
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('EMPLOYEE_PROFILE_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('EMPLOYEE_PROFILE_UPDATE_FAILED'));
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
	function UploadImageDispatch($detail,$file)
	{
		extract($detail);
		 // check required column validation
		if(!empty($detail))
		{
		
			if (isset($file["signature"]) ) {
				$allowedExts = array("jpg","jpeg","png","gif","JPG","JPEG");
				$temp = explode(".", $file["signature"]["name"]);
				 $extension = end($temp);
			 
					$dispatch_signature 	= $this->db->clean($file["signature"]["name"]);	
					if($dispatch_signature!=""){
					$fileSize 	= round($file["signature"]["size"]); // BYTES									
					$adate 		= date('Y-m-d H:i:m');
					
					$extension	= end(explode(".", $dispatch_signature));		
					if(!in_array($extension,$allowedExts))
					{
						$file_error=true;
					}						
					 $dispatch_signature	= 'signature_'.substr(sha1(time()), 0, 6).".".$extension;
					 $filePath 	= DISPATCH_IMAGES.$dispatch_signature;						
					 $file['signature']['tmp_name'];
					move_uploaded_file($file['signature']['tmp_name'], $filePath);
					
					$new_image=true;
					}
					else{
						$dispatch_signature="";
					}
			}
			else
			{
				$new_image=false;
			}
			$rows=array(
						"dispatch_signature"=>$dispatch_signature,
						"status"=>2,
						);
			$where="id='".$dispatch_id."'";
			$isUpdated=$this->db->rp_update("dispatch_info",$rows,$where,0);
			if($isUpdated)
			{
				$OrderID=$this->rp_getValue("dispatch_info","order_id","id='".$dispatch_id."'");
				$this->UpdateDeliveredOrderItem($OrderID);
				$dispatch_info=$this->db->rp_getData("dispatch_info","*",$where);
				$dispatch_info=mysqli_fetch_assoc($dispatch_info);
				$result['dispatch_signature']=SITEURL.DISPATCH_IMAGES1.$dispatch_info['dispatch_signature'];
				$reply=array("ack"=>1,"developer_msg"=>"Image & Sign Upload Successfully!!","ack_msg"=>"Image & Sign Upload Successfully!!","result"=>$result);
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Image & Sign not Uploaded!!","ack_msg"=>"Image & Sign not Uploaded");
				return $reply;
			}

		}
		else
		{
			$reply=array("ack"=>0,"error"=>$validateKey['error'],"developer_msg"=>"Invalid Key","ack_msg"=>"Detail is empty");
			return $reply;
		}
	
	}
	
	function UpdateDeliveredOrderItem($order_id){
		$OrderItems=$this->rp_getData("order_item","*","order_id='".$order_id."'");
		while($OrderItem=mysqli_fetch_assoc($OrderItems))
		{
			// Get All Dispatch For Given Dispatch
			$ordered_qty=$OrderItem['order_item_qty'];
			$dispatched_item_qty=$this->rp_getValue("dispatch_item","SUM(dispatch_item_qty)","dispatch_item_id='".$OrderItem['order_item_id']."' AND order_id='".$OrderItem['order_id']."'");
			$dispatched_credit_qty=$this->rp_getValue("dispatch_item","SUM(dispatch_item_credit_qty)","dispatch_item_id='".$OrderItem['order_item_id']."' AND order_id='".$OrderItem['order_id']."'");
			$actually_delivered_qty=$dispatched_item_qty-$dispatched_credit_qty;
			$delivered_qty=$dispatched_item_qty;
			if($delivered_qty==$ordered_qty)
			{
				$status=2;
			}
			else
			{
				$status=1;
			}
			$this->rp_update("order_item",array("order_item_delivered"=>$delivered_qty,"order_item_actual_delivered"=>$actually_delivered_qty,"status"=>$status),"id='".$OrderItem['id']."'",0);
		}
		
		$HowManyItemDelivered=$this->rp_getTotalRecord("order_item","order_id='".$order_id."' AND status=2");
		$TotalItems=$this->rp_getTotalRecord("order_item","order_id='".$order_id."'");
		if($HowManyItemDelivered==$TotalItems)
		{
			$OrderStatus=5;
		}
		else
		{
			$OrderStatus=4;
		}
		
		$this->rp_update("order_detail",array("order_status"=>$OrderStatus),"id='".$order_id."'",0);
		return true;
	}
	function getEmployeeDetail($employee_id,$require_column)
	{
		$user_details=$this->db->rp_getData($this->ctable,$require_column,"id='".$employee_id."' AND isDelete=0");
		if($user_details)
		{
			$r=mysqli_fetch_assoc($user_details);
			return $r;
		}	
		else
		{
			return false;
		}	
	}
	function countEmployee($key,$value)
    {
        $countEmployee = $this->db->rp_getTotalRecord($this->ctable,$key."='".$value."'",0);
        return $countEmployee;
    }

    function PayDirectCommission($slab_id,$repo_id,$invoice_id,$invoice_number,$amount){
    	$AccountInfo=$this->GetEmployeeAccountInfo($repo_id);
    	if($AccountInfo)
    	{
    		$remarks="Against Invoice ".$invoice_number;
    		$Transaction=$this->creditAmount($repo_id,$AccountInfo['id'],$amount,$remarks,$invoice_id,"sales_invoice_info");
    		if($Transaction['ack']==1)
    		$LogID=$this->rp_insert($this->CtableCommissionLog,array($repo_id,$slab_id,$amount,$invoice_id,$Transaction['transaction_id'],date("Y-m-d H:i:s")),array("sales_id","slab_id","amount","invoice_id","transaction_id","created_date"),0);

    		return $LogID;
    	}
    	else
    	{
    		return 0;
    	}
    }
    function PayCollectedCommission($slab_id,$repo_id,$invoice_id,$invoice_number,$payment_id,$amount,$target_amount){
    	$AccountInfo=$this->GetEmployeeAccountInfo($repo_id);
    	if($AccountInfo)
    	{
    		$remarks="Against Payment ".$target_amount." of Invoice ".$invoice_number."";
    		$Transaction=$this->creditAmount($repo_id,$AccountInfo['id'],$amount,$remarks,$payment_id,"dispatch_payment_log");
    		if($Transaction['ack']==1)
    		$LogID=$this->rp_insert($this->CtableCommissionLog,array($repo_id,$slab_id,$amount,$invoice_id,$Transaction['transaction_id'],date("Y-m-d H:i:s")),array("sales_id","slab_id","amount","invoice_id","transaction_id","created_date"),0);

    		return $LogID;
    	}
    	else
    	{
    		return 0;
    	}
    }

    public function GetEmployeeAccountInfo($eid)
	{
		$AccountInfo=$this->rp_getData($this->CtableEmployeeAccount,"*","eid='".$eid."'","",0);
		if($AccountInfo)
		{
			$AccountInfo=mysqli_fetch_assoc($AccountInfo);
			$Credit=$this->rp_getValue($this->CtableEmployeeAccountTransaction,"SUM(credit)","employee_id='".$eid."'");
			$Debit=$this->rp_getValue($this->CtableEmployeeAccountTransaction,"SUM(debit)","employee_id='".$eid."'");
			$ClosingBalance=$Credit+$Debit;
			$AccountInfo['overall_closing_balance']=($ClosingBalance>0)?$ClosingBalance:$ClosingBalance;
			return $AccountInfo;
		}
		else
		{
			return false;
		}
	}
	public function GetEmployeeInfo($eid)
	{
		$AccountInfo=$this->rp_getData($this->ctable,"*","id='".$eid."'","",0);
		if($AccountInfo)
		{
			$AccountInfo=mysqli_fetch_assoc($AccountInfo);
			$AccountInfo['name']=$AccountInfo['first_name']." ".$AccountInfo['last_name'];
			$AccountInfo['account']=$this->GetEmployeeAccountInfo($AccountInfo['id']);
			return $AccountInfo;
		}
		else
		{
			return false;
		}
	}
	public function getEmployeeClosingBalance($branch_id)
    {
    	$credit=$this->db->rp_getValue($this->CtableEmployeeAccountTransaction,"SUM(credit)","employee_id='".$branch_id."' AND isDelete=0",0);
    	$debit=$this->db->rp_getValue($this->CtableEmployeeAccountTransaction,"SUM(debit)","employee_id='".$branch_id."' AND isDelete=0");
    	$OutStanding=$credit+$debit;
    	$OutStanding=($OutStanding=="")?0:$OutStanding;
    	return $OutStanding;
    }

 	 function DownloadEmployeeAccountInfo($EmployeeID,$FilterDate="")
	{
			if(!empty($FilterDate) && $FilterDate['from_date']!="" && $FilterDate['to_date'])
			{
				$FilterDate=implode(" to ",$FilterDate);
			}
			else
			{
				$FilterDate="";
			}
			$d=file_get_contents(ADMINSITEURL."employee_account_report_print.php?searchName=".urlencode($EmployeeID)."&FilterDate=".urlencode($FilterDate));
			require("../".ADMINFOLDER.'/mpdf60/mpdf.php');
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

			$mpdf->WriteHTML($d);

			$fileName = "employee_info_".$searchName."-".$FilterDate;

			if(!is_dir("../".ADMINFOLDER."/".EMPLOYEE_FILES.$fileName)){

				mkdir("../".ADMINFOLDER."/".EMPLOYEE_FILES.$fileName);

			}

			$pdf_file_path	= "../".ADMINFOLDER."/".EMPLOYEE_FILES.$fileName."/".$fileName.'.pdf';



			if(file_exists($pdf_file_path)){

				unlink($pdf_file_path);

			}

			$mpdf->Output($pdf_file_path);

			$xl_file_path	= "../".ADMINFOLDER."/".EMPLOYEE_FILES.$fileName."/".$fileName.'.xls';

			if(file_exists($xl_file_path)){

				unlink($xl_file_path);

			}

			file_put_contents($xl_file_path, $d);

			$result=array();
			$result['pdf']=ADMINSITEURL."/".EMPLOYEE_FILES.$fileName."/".$fileName.'.pdf';
			$result['xls']=ADMINSITEURL."/".EMPLOYEE_FILES.$fileName."/".$fileName.'.xls';
			
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CUSTOMER_ACCOUNT_GET_SUCESS',1),"ack_msg"=>$this->log->getMessage('CUSTOMER_ACCOUNT_GET_SUCESS'),"result"=>$result);
			return $reply;
	}
}

?>