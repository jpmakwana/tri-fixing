<?php
require_once("timeago.inc.php");
class Media extends Functions
{
	public $detail=array();
	public $db;
	public $ctable="media";
	public static $media_type= array("image","audio","video","file","application");
	public static $media_path=array("product"=>FG_ITEM_IMAGE,"application_settings"=>APPLICATION_INVOICE_IMAGE,"inward_store"=>INWARD_FILES);
	public $allowed_media_exetension= array(array("jpg","jpeg","png","gif","JPG"),array("jpg","jpeg","png","gif","JPG"),array("jpg","jpeg","png","gif","JPG"),array("jpg","pdf","doc","docx","xls","xlsx","vnd.openxmlformats-officedocument.wordprocessingml.document","vnd.openxmlformats-officedocument.spreadsheetml.sheet","vnd.ms-excel"));
	public static $DefaultImage="../images/noimage.png";
	function __construct($id="") 
	{
		$this->db = new Functions();
		$this->conn=$this->db->conn;
		$conn = $this->db->connect();		
    }
	function updateReferenceToMedia($mid,$reference_id,$reference_table)
	{
		return $this->rp_update($this->ctable,array("reference_id"=>$reference_id,"reference_type"=>$reference_table),"id='".$mid."'",0);
	}
	function addMedia($detail,$file)
	{
		
		 $actual_file_name=basename($file["file"]["name"]);
		 $extention=pathinfo($actual_file_name,PATHINFO_EXTENSION);
		 $error=0;
		
		// File Name, Title, Media Type , Reference Type, Reference Id
		if(!empty($detail) && $detail['reference_type']!="" && $detail['reference_id']!="")
		{
			
			// Upload Media to Appropriate Folder
			$root_path=Media::$media_path[$detail['reference_type']];
			if(!in_array($extention,$this->allowed_media_exetension[$detail['media_type']]))
			{
				$error=1;
				$error_msg[]="File type not supported!!";
			}
			
			if($file['file']['size']>5000000)
			{
				$error=1;
				$error_msg[]="File is too large!!";
			}
			if($error==0)
			{
				
				$target_file_name="media_".time().".".$extention;			
				$filepath=$root_path.$target_file_name;
				move_uploaded_file($file["file"]["tmp_name"], $filepath);
				$values=array($target_file_name,$detail['title'],$detail['media_type'],$detail['reference_type'],$detail['reference_id'],date("Y-m-d H:i:s"));
				$columns=array("url","title","media_type","reference_type","reference_id","adate");
				$media_id=$this->db->rp_insert($this->ctable,$values,$columns,0);
				if($media_id!=0)
				{					
					$reply=array("ack"=>1,"developer_msg"=>"Media Detail Added Successfully!!","ack_msg"=>"Media Uploaded Successfully!!","media_id"=>$media_id,"error"=>array());
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid Database Error!!","ack_msg"=>"Internal Error!! Try later","error"=>array("Internal Error!!"));
					return $reply;
				}	
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Invalid Media!!","ack_msg"=>"Invalid Media!! Try again","error"=>$error_msg);
				return $reply;
			}			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid!!","ack_msg"=>"Internal Error!! Try later","error"=>array("Internal Error!!"));
			return $reply;
		}
	}	
	
	function removeMedia($detail)
	{
		// Media Id
		if($detail['mid']!="")
		{
			$isUpdated=$this->rp_update($this->ctable,array("isDelete"=>1),"id='".$detail['mid']."'",0);
			if($isUpdated)
			{
				$media_info=$this->rp_getData($this->ctable,"*","id='".$detail['mid']."'",0);
				$media_info=mysqli_fetch_assoc($media_info);
				$this->rp_update($media_info['reference_type'],array("image"=>0),"id='".$media_info['reference_id']."'",0);
				$reply=array("ack"=>1,"developer_msg"=>"Media Detail Removed Successfully!!","ack_msg"=>"Media Removed Successfully!!");
				return $reply;
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid Database Error!!","ack_msg"=>"Internal Error!! Try later");
				return $reply;
			}
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid!!","ack_msg"=>"Internal Error!! Try later");
			return $reply;
		}
	}
	function getMedia($detail,$required_columns=array())
	{
		$required_columns=$this->getRequiredColumns($required_columns);	
		if(!empty($detail) && array_key_exists("mid",$detail) && $detail['mid']!="" && $detail['mid']!=0)
		{
			$mids=$detail['mid'];
			$media_detail=$this->rp_getData("media",$required_columns,"id IN (".$mids.")");// Get Cart detail if there are any cart with In Progress status
			if($media_detail)
			{			
				$media_detail_result=array();
				while($m=mysqli_fetch_assoc($media_detail)){
					
					// Do Modification Here
					
					$m['adate']=$this->formateDate($m['adate']);
					
					$m['full_url']=ADMINSITEURL."".Media::$media_path[$m['reference_type']].$m['url'];
					
					$m['url']=Media::$media_path[$m['reference_type']].$m['url'];
					$media_detail_result=$m;
				}
				
				$reply=array("ack"=>1,"developer_msg"=>"Media Detail Fetched Successfully!!","ack_msg"=>"Media Fetched Successfully!!","result"=>$media_detail_result);
				return $reply;	
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"No media found!!","ack_msg"=>"No media found!!");
				return $reply;
			}
					
		}
		else
		{

			$reply=array("ack"=>0,"developer_msg"=>"media ids not found!!","ack_msg"=>"Internal Error!! Try later");
			return $reply;
		}
	}
	function countMedia($where)
	{		
		$countMedia = $this->db->rp_getTotalRecord($this->ctable,"id",$where,0);
		return $countMedia;	
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
	function getLimit($limit=array())
	{
		$limit=$this->db->getLimit();	
		if(!empty($limit) && array_key_exists("ul",$limit))
		{
			$ul=$limit['ul'];
			if(array_key_exists("ll",$limit) && $limit['ll']!="")
			{
				$ll=$limit['ll'];
			}
			else
			{
				$ll="18446744073709551615";
			}			
			$limit_string="".$ul.",".$ll;
			return $limit_string;
		}
		else
		{
			return "";
		}
	}	
	function formateDate($date)
	{
	
		if($date!="" && $date!="null" && $date!="0000-00-00 00:00:00")
		{
			return date('D, d M Y', strtotime($date));
		}
		else
		{
			return "--";
		}
	}
	
	function updateMediaIdToReference($table,$column,$mid,$reference_id_column,$reference_id)
	{
		return $this->rp_update($table,array($column=>$mid),$reference_id_column."='".$reference_id."'",0);
	}


	public static $ValidMediaType=array(
			'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            "pdf"=>"application/pdf",
            "vnd.openxmlformats-officedocument.wordprocessingml.document"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "vnd.openxmlformats-officedocument.spreadsheetml.sheet"=>"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "vnd.ms-excel"=>"application/vnd.ms-excel"
        );
	public static $AllowedMediaSizeByType=array(
		'jpg' => 5242880,//5MB
        'png' => 5242880,//5MB
        'gif' => 5242880,//5MB
        'pdf'=>5242880,//5MB
        "vnd.openxmlformats-officedocument.wordprocessingml.document"=>5242880,
        "vnd.openxmlformats-officedocument.spreadsheetml.sheet"=>5242880,
        "vnd.ms-excel"=>5242880,
	);
	public static $MediaDirectory=array(
		'jpg' => "resource/images/",
        'png' => "resource/images/",
        'gif' => "resource/images/",
        'pdf' => "resource/files/",
	);
	function RemoveMediaA($detail)
	{

		// Media Id
		if($detail['mid']!="")
		{
			$mediaInfo=$this->GetMediaInfo($detail['mid']);
			if($mediaInfo['ack']==1)
			{
				$mediaInfo=$mediaInfo['result'];
				$isUpdated=$this->rp_update($this->ctable,array("isDelete"=>1),"id='".$detail['mid']."'",0);
				if($isUpdated)
				{
					move_uploaded_file(sprintf(__DIR__."/../".Media::$media_path[$mediaInfo['reference_table']]."/trash/".$mediaInfo['url']),sprintf(__DIR__."/../".Media::$MediaDirectory[$mediaInfo['ext']].$mediaInfo['url']));
					$isUpdated=$this->rp_update($mediaInfo['reference_type'],array($mediaInfo['reference_column']=>''),"id='".$mediaInfo['reference_id']."'",0);
					$reply=array("ack"=>1,"developer_msg"=>"Media Detail Removed Successfully!!","ack_msg"=>"Media Removed Successfully!!");
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid Database Error!!","ack_msg"=>"Internal Error!! Try later");
					return $reply;
				}
			}
			else
			{
				$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid!!","ack_msg"=>"Internal Error!! Try later");
				return $reply;
			}
			
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"Media Detail Not Valid!!","ack_msg"=>"Internal Error!! Try later");
			return $reply;
		}
	}
	function GetMediaInfo($MediaID,$required_columns=array())
	{
		$required_columns=System::getRequiredColumns($required_columns);	
		$MediaDetail=$this->rp_getData($this->ctable,$required_columns,"id ='".$MediaID."' AND isDelete=0");
		if($MediaDetail)
		{			
			$MediaDetail=mysqli_fetch_assoc($MediaDetail);
			if(array_key_exists("url", $MediaDetail))
			{
				$MediaDetail['relative_url']="../".Media::$media_path[$MediaDetail['reference_type']]."/".$MediaDetail['url'];
				$MediaDetail['real_url']=SITEURL.Media::$media_path[$MediaDetail['reference_type']]."/".$MediaDetail['url'];
				$MediaDetail['access_url']=SITEURL.$MediaDetail['id'];
				$MediaDetail['moment_date']= timeAgoInWords($MediaDetail['adate']);
			}
			$reply=array("ack"=>1,"developer_msg"=>"Media Detail Fetched Successfully!!","ack_msg"=>"Media Fetched Successfully!!","result"=>$MediaDetail);
			return $reply;	
		}
		else
		{
			$reply=array("ack"=>0,"developer_msg"=>"No media found!!","ack_msg"=>"No media found!!");
			return $reply;
		}
	}
	public static $MEDIA_UPLOAD_SUCCESS=0;
	public static $BAD_MEDIA=1;
	public static $NO_MEDIA=2;
	public static $TOO_LARGE=3;
	public static $INVALID_MEDIA_TYPE=4;
	public static $INVALID_MEDIA_SIZE=5;
	public static $MEDIA_UPLOAD_FAILED=6;
	public static $MediaErrorMessages=array(
			-1=>'Internal Error',
			0=>'Media Uploaded',
			1=>'Correpted Media',
			2=>'No Media Found',
			3=>'Too Large Media',
			4=>'Invalid Media Type',
			5=>'Invalid Media Size',
			6=>'Media Upload Failed',			
		);

	function UploadMedia($Media,$ReferenceID='',$ReferenceTable='',$TargetColumn='',$ReferenceColumn='')
	{
		$Error=0;
		
    	
			switch ($Media['error']) 
		    {
		        case UPLOAD_ERR_OK:
		            break;
		        case UPLOAD_ERR_NO_FILE:
		            $Error= Media::$NO_MEDIA;
		        case UPLOAD_ERR_INI_SIZE:
		        case UPLOAD_ERR_FORM_SIZE:return 
		        	$Error= Media::$TOO_LARGE;
		        default:
		            $Error= 0;
		    }


		    if (false === $ext = array_search($Media['type'],Media::$ValidMediaType,true)) 
	    	{
	       	  $Error= Media::$INVALID_MEDIA_TYPE;
	    	}

		     //is it Sexy Size?
	    	if($ext)
	    	{
	    		if(array_key_exists($ext, Media::$AllowedMediaSizeByType))
		    	{
	    		 if ($Media['size'] > Media::$AllowedMediaSizeByType[$ext]) {
				       $Error= Media::$INVALID_MEDIA_SIZE;
				    }
		    	}
		    	else
		    	{
		    		 $Error= Media::$INVALID_MEDIA_TYPE;
		    	}
	    	}
	    	else
	    	{
		    		 $Error= Media::$INVALID_MEDIA_TYPE;

	    	}
	    	
		   

		    if($Error==0)
		    {
		    	$MediaTitle=$MediaFileName=sha1_file($Media['tmp_name']);
		    	$real_ext=explode(".",$Media['name']);
		    	
		    	$real_ext=end($real_ext);//$real_ext=$real_ext[];
		    	if (!move_uploaded_file($Media['tmp_name'],sprintf(__DIR__."/../".Media::$media_path[$ReferenceTable].'/%s.%s',$MediaFileName,$real_ext)))
			  	 {
			        $Error= Media::$MEDIA_UPLOAD_FAILED;
			    }
			    else
			    {
			    	$Success=Media::$MEDIA_UPLOAD_SUCCESS;

			    }
		    }
		    if($Error>0)
		    {
		    	return array("ack"=>0,'ack_msg'=>Media::$MediaErrorMessages[$Error],'developer_msg'=>Media::$MediaErrorMessages[$Error]);
		    }
		    else
			{
				// Update Media Table
				$MediaFileName=$MediaFileName.".".$real_ext;
				$MediaType=Media::$ValidMediaType[$ext];
				$UploadDate=date("Y-m-d H:i:s");
				$Values=array($MediaTitle,$MediaFileName,$MediaType,$ext,$UploadDate,$ReferenceID,$ReferenceTable,$TargetColumn);
				$Columns=array("title","url","media_type","ext","adate","reference_id","reference_type","reference_column");
				$MediaID=$this->rp_insert($this->ctable,$Values,$Columns);
				if($MediaID!=0)
				{
					if($ReferenceID!='' && $ReferenceTable!='')
					{
						$this->updateReferenceToMedia($MediaID,$ReferenceID,$ReferenceTable);
						$this->updateMediaIdToReference($ReferenceTable,$TargetColumn,$MediaID,$ReferenceColumn,$ReferenceID);
					}
					$MediaInfo=$this->GetMediaInfo($MediaID);
					return array("ack"=>1,'ack_msg'=>Media::$MediaErrorMessages[0],'developer_msg'=>Media::$MediaErrorMessages[0],'result'=>$MediaInfo['result']);
				}
				else
				{
					return array("ack"=>0,'ack_msg'=>Media::$MediaErrorMessages[-1],'developer_msg'=>Media::$MediaErrorMessages[-1]);
				}
				
			}

		     
		
	}
}
?>