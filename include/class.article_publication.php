<?php
require_once("main.class.php");
require_once("function.class.php");
require_once("class.system.php");
require_once("notification.class.php");

class ArticlePublication extends Functions
{
	public $db;
	public $log;
	public $system;
	public $ctable="article_publication";

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
 
	public function InsertUser($detail,$file) 
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
						"working_hours",
						"isDelete",
						"isActive",
						"isVerified",
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
						$working_hours,
						$isDelete,
						$isActive,
						$isVerified,
						$adate,
						$adate
						
					);
		 	$customer_id = $this->db->rp_insert($this->ctable,$values,$rows,0);
			$this->log->insertLog($this->ctable,$customer_id,"insert",$this->log->slm['VENDOR_INSERT']." : ".$name);
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
		public function UpdateArticlePublication($detail,$file)
	{
		extract($detail);
		
		
				if (isset($file["pdf_file_name"]) && $file["pdf_file_name"]['size']!=0) 
					{
							// Valid file extensions
						$allowedExts = array("pdf");
				
       
						 $temp = explode(".", $file["pdf_file_name"]["name"]);
						 $file_size =$file["pdf_file_name"]["size"];
                         $file_tmp =$file["pdf_file_name"]["tmp_name"];
						 
						$extension = end($temp);
						$error="";
						if($file["pdf_file_name"]["error"]>0) {
							$error .= "Error opening the file. ";
						}
						if($file["pdf_file_name"]["type"]=="application/x-msdownload"){
							$error .= "Mime type not allowed. ";
						}
						
					
						if(in_array($extension, $allowedExts)){
          
                            $file_name= 'article_pdf_'.substr(sha1(time()), 0, 6).".".$extension;
                    			
                                  if($file_size > 2000000){
                                    
                            		  $reply=array("ack"=>0,"ack_msg"=>"File size must be excately 2 MB");
                            		  return $reply;
                                  }else{
                            		  if (move_uploaded_file($file_tmp,ARTICLE_PDF_A.$file_name)) {
                            		      
                            		      
                            		     $pdf_file_name= $file_name;
                            		   	unset($pdf_old_file_name);
                            		  }else{
                            		 
                            		       $reply=array("ack"=>0,"ack_msg"=>"File upload error!!");
                            		     	return $reply;
                            	            }
                            	            
                                  }
                            
                        }else{
                    	   $reply=array("ack"=>0,"ack_msg"=>"Invalid file extension.");
                    		 	return $reply;
                            }
                    
					}else{
					    $pdf_file_name= $pdf_old_file_name;
					}
					  
                            						
                    			
                            						 
                            		      	$rows 	= array(
                            					    "article_title"=>$title,
                            					    "pdf_file_name"=>$pdf_file_name
                            									
                            								);
                            								
                            						$where	= "id='".$id."'";
                            						$cbid=$this->db->rp_update($this->ctable,$rows,$where,0);
                            		    
                            		  	 
                            	        if($cbid!=0)
                            				{
                            						$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('FILE_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('FILE_UPDATE_SUCESS'));
                            			            	return $reply;
                            				
                            				}
                            			else{
                            		 
                            	    	            $reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('FILE_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('FILE_UPDATE_FAILED'));
                            			           	return $reply;
                            		
                            	            }
                    
                            		    
		
	}
	
	

	
	public function EditArticlePublication($detail)
	{		
		$where = " id='".$detail['id']."' AND isDelete=0";
		$ctable_r = $this->db->rp_getData($this->ctable,"*",$where);
		$ctable_d = mysqli_fetch_array($ctable_r);
		$result=array();
		$result		= $ctable_d;
		
		$reply=array("ack"=>1,"developer_msg"=>"User detail fetched!!.","ack_msg"=>"Success! Update User Successfully.","result"=>$result);
		return $reply;
	
	}
	
	
	
		public function DeleteArticlePublication($detail)
	{
		$rows 	= array(
		"isDelete"	=> "1"
		
		);
			$where	= "id='".$detail['id']."'";
			$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
			
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['ITEM_FG_DELETE']." : ");
			
			if($isUpdated)
			{
			$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('FILE_DELETE_SUCESS',1),"ack_msg"=>$this->log->getMessage('FILE_DELETE_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('FILE_DELETE_FAILED',1),"ack_msg"=>$this->log->getMessage('FILE_DELETE_FAILED'));
				return $reply;
			}
	}
	public function ArticlePublicationActive($detail)
	{
		$customer_name=$this->db->rp_getValue($this->ctable,"name","isDelete=0 AND isActive=1 AND id='".$detail['id']."'");
		$rows 	= array(
		"isActive"	=> $detail['status']
		);
			$where	= "id='".$_REQUEST['id']."'";
			$uid=$this->db->rp_update($this->ctable,$rows,$where);
			$this->log->insertLog($this->ctable,$detail['id'],"delete",$this->log->slm['FILE_STATUS_SUCESS']." : ".$customer_name);
			if($uid!=0)
			{
				$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('FILE_STATUS_SUCESS',1),"ack_msg"=>$this->log->getMessage('FILE_STATUS_SUCESS'));
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('FILE_STATUS_FAILED',1),"ack_msg"=>$this->log->getMessage('FILE_STATUS_FAILED'));
				return $reply;
			}
	}
	
	

	
function getUserDetail($uid)
	{
		$user=array();
		$user_r=$this->db->rp_getData("user","*","id='".$uid."'","",0);
		
		while($user_d=mysqli_fetch_assoc($user_r))
		{
			$user[]=$user_d;
		}
		return $user;
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
	function countUser($key,$value)
    {
        $countCustomer = $this->db->rp_getTotalRecord($this->ctable,$key."='".$value."'",0);
        return $countCustomer;
    }



	// function parseDate($date){
	// 	if($date!="0000-00-00"){
	// 		$date=date('d-m-Y',strtotime($date));
	// 	}else{
	// 		$date="";
	// 	}
	// 	return $date;
	// }


}

?>