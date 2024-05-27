<?php

require_once("../include/notification.class.php");
class Chat extends Functions
{
	public static $CtableChatRoom="support_ticket";
	public static $CtableChat="support_ticket_reply";
	public static $CtableChatRoomParticipant="support_ticket";
	public static $CtableEmployee="emp_personal_info";
	public static $UserType=array(0=>"Admin",1=>"Normal User");
	public static $MessageType=array(0=>"Text Message",1=>"Image",2=>"Audio",3=>"Video",4=>"Document",5=>"Other");
	public static $ValidMediaExtension=array(
												"image"=>array("jpeg","JPEG","png","PNG","gif","GIF","bmp","BMP"),
												"audio"=>array("mp3"),
												"video"=>array("mp4"),
												"application"=>array("pdf","doc")
											);
	public static $ValidMediaSize=array(
		"image"=>"1024000","audio"=>"1024000",
		"video"=>"1024000","application"=>"1024000");
	
	function __construct($id="") 
	{
		$db = new Functions();
		$conn = $db->connect();
		$this->db=$db;
	}
	public function SendMessage($SupportTicketID,$SenderID,$SenderType,$MessageType,$Message,$date,$Origin='mobile')
	{
			$MessageID=$this->rp_insert(Chat::$CtableChat,array($SupportTicketID,$Message,$MessageType,date("Y-m-d H:i:s"),$SenderID,$SenderType),array("support_ticket_id","message","message_type","datetime","sender_id","sender_type"),0);

						
			$MessageDetail=$this->MessageDetail($MessageID,$Sender,$SenderType);
			$ChatRoomDetail=$this->ChatRoomDetail($SupportTicketID,$Sender,$SenderType);
			$ChatRoomDetail=$ChatRoomDetail['result'];

			$MessageDetail['message_typ']=$MessageDetail['message_type'];
			$SenderID=$MessageDetail['user_id']=$ChatRoomDetail['customer_id'];
			$MessageDetail['notification_type']=3;
			unset($MessageDetail['message_type']);

			if($Origin=='web')
			{
				if($SenderType==0)
				{
					$MessageDetail['isOwnMessage']=1;
				}
			}
			else
			{
				if($SenderType==0 && $SenderID==$MessageDetail['user_id'])
				{
					$MessageDetail['isOwnMessage']=1;
				}
			}
			$Result=$this->SendChatNotification($SenderID,$MessageDetail);
			
			$reply=array("ack"=>1,"ack_msg"=>"Message sent succesfully","developer_msg"=>"SUCCESS_3","result"=>$MessageDetail,"notification_result"=>$Result);
				return $reply;		
						
	}	  

	function SendChatNotification($SenderID,$Data)
	{
		$Notification=new Notification();
		$refresh_tokens=$this->rp_getData("refresh_token_customer","refresh_token","user_id='".$SenderID."'","",0);
		if($refresh_tokens){
			$tokens=array();
			while($refresh_token=mysqli_fetch_assoc($refresh_tokens)){
				$tokens[]=$refresh_token['refresh_token'];
			}
			
			$result=$Notification->send_notification($Data,$tokens,2);

		}
		$reply=array('ack'=>1,"ack_msg"=>"Notification inserted successfully","result"=>$result);
		return $reply;
	}
	
	function CreateChatRoom($CustomerID,$SalesRepoID,$Subject)
	{
		$ChatRoomID=$this->rp_insert(Chat::$CtableChatRoom,array($Subject,$CustomerID,$SalesRepoID,date("Y-m-d H:i:s")),array("subject","customer_id","sales_repo_id","created_date"));
		$ChatRoomDetailR=$this->ChatRoomDetail($ChatRoomID,"","");
		if($ChatRoomDetailR['ack']==1)
		{
			$ChatRoomDetailR=$ChatRoomDetailR['result'];
			$ChatRoomDetail=array("ack"=>1,"ack_msg"=>"Chat Room Created","developer_msg"=>"CHAT_ROOM_CREATE_SUCCESS_5","result"=>$ChatRoomDetailR);
		}
		
		return $ChatRoomDetail;
	}
	function ChatRoomDetail($ChatRoomID,$RequesterID,$RequesterType)
	{
		$ChatRoomDetail=$this->rp_getData(Chat::$CtableChatRoom,"*","id='".$ChatRoomID."'","",0);
		if($ChatRoomDetail)
		{
			$ChatRoomDetail=mysqli_fetch_assoc($ChatRoomDetail);
			$Title=$this->GetChatRoomTitle($ChatRoomID,$RequesterID,$RequesterType);
			$ChatRoomDetail['title']=($Title!="")?$Title:$ChatRoomDetail['title'];
			$max_msg_id=$this->rp_getValue(Chat::$CtableChat,"MAX(id)","chat_room_id='".$ChatRoomDetail['id']."'");
			$last_message=$this->rp_getValue(Chat::$CtableChat,"message","id='".$max_msg_id."'");
			$ChatRoomDetail['last_message']=($last_message!="")?$last_message:"--";
			$last_seen_message=$tChatRoomDetail['last_seen_message'];
			$new_message_count=$this->rp_getTotalRecord(Chat::$CtableChat,"chat_room_id='".$ChatRoomID."' AND datetime>='".$last_seen_message."'");
			$ChatRoomDetail['new_message_count']=($new_message_count!="")?$new_message_count:"0";
			$reply=array("ack"=>1,"ack_msg"=>"Internal Error!!","developer_msg"=>"CHAT_ROOM_FOUND_SUCCESS_4","result"=>$ChatRoomDetail);
			
		}
		else
		{
			$reply=array("ack"=>0,"ack_msg"=>"Internal Error!!","developer_msg"=>"CHAT_ROOM_NOT_FOUND_ERROR_2");
		}
		
		return $reply;
	}
	function MessageDetail($MessageID,$viewer_id,$ViewerType)
	{
		$MessageDetail=$this->rp_getData(Chat::$CtableChat,"*","id='".$MessageID."'",0);
		if($MessageDetail)
		{
			$MessageDetail=mysqli_fetch_assoc($MessageDetail);
			if($MessageDetail['sender_id']==$viewer_id && $MessageDetail['sender_type']==$ViewerType )
			$MessageDetail['isOwnMessage']=1;
			else
			$MessageDetail['isOwnMessage']=0; 

			if($MessageDetail['sender_type']==0)
			$SenderName=$this->rp_getValue("customer","name","id='".$MessageDetail['sender_id']."'");
			else
			{
				$SenderName=$this->rp_getValue("emp_personal_info","customer_name","id='".$MessageDetail['sender_id']."'");
			
				if($SenderName=="")
				{
					$SenderName=SITETITLE;
				}
			}
			$MessageDetail['sender_name']=$SenderName;
			 $MessageDetail['text']=$Message;
			 $MessageDetail['datetime']=date("d-m-y H:i A",strtotime($MessageDetail['datetime']));
			 if(date("Y-m-d",strtotime($MessageDetail['created_date']))==date("Y-m-d"))
			{
				$MessageDetail['created_date']=date("d M H:i A",strtotime($MessageDetail['created_date']));
			}
			else
			{
				$MessageDetail['created_date']=date("d M H:i A",strtotime($MessageDetail['created_date']));
			} 
		
			
			return $MessageDetail;
			
		}
		else
		{
			return false;
		}
	}
	
	function GetMyChatRooms($SenderID,$SenderType)
	{
		$ChatRooms=$this->rp_getData(Chat::$CtableChatRoomParticipant,"DISTINCT (id) as id","id='".$SenderID."'");
		if(!$ChatRooms)
		{
			$Participants=array();
			$Participants[]=array("id"=>1,"type"=>0);
			$Participants[]=array("id"=>$SenderID,"type"=>$SenderType);
			 // print_r($Participants); exit;
			$RoomTitle=$this->generateRoomTitle($Participants);
			$this->CreateChatRoom($Participants,$RoomTitle);
			$ChatRooms=$this->rp_getData(Chat::$CtableChatRoomParticipant,"DISTINCT (chat_room_id)","participant_id='".$SenderID."' AND participant_type='".$SenderType."'","",0);
		}
		
		
		$ChatRoomDetails=array();
		while($ChatRoom=mysqli_fetch_assoc($ChatRooms))
		{
			$ChatRoomDetail=$this->ChatRoomDetail($ChatRoom['chat_room_id'],$SenderID,$SenderType);
			if($ChatRoomDetail['ack']==1)
			$ChatRoomDetails[]=$ChatRoomDetail['result'];
			
		}
		
		$reply=array("ack"=>1,"ack_msg"=>"Chat Room Found!!","developer_msg"=>"MY_CHAT_ROOM_FOUND_SUCCESS_6","result"=>$ChatRoomDetails);
		return $reply;
	}
	
	
	function GetChatRoomConversation($support_ticket_id,$viewer_id,$viewer_type,$limit)
	{
		$Messages=$this->rp_getData(Chat::$CtableChat,"id,message","support_ticket_id='".$support_ticket_id."'","id desc",0,$limit);
		if($Messages)
		{
			// print_r($Messages);exit;
			$MessageDetails=array();
			while($Message=mysqli_fetch_assoc($Messages))
			{
				// echo $Message['id']; exit;
				$MessageDetail=$MessageDetail=$this->MessageDetail($Message['id'],$viewer_id,$viewer_type);
				$MessageDetails[]=$MessageDetail;
				
			}
			// print_r($MessageDetails);
			
			
			$reply=array("ack"=>1,"ack_msg"=>"Chat Room Found!!","developer_msg"=>"MESSAGES_FOUND_SUCCESS_6","result"=>$MessageDetails); 
			
		}
		else
		{
			$reply=array("ack"=>0,"ack_msg"=>"End of conversation!!","developer_msg"=>"MESSAGE_NOT_FOUND_ERROR_2");
		}
		$this->rp_update(Chat::$CtableChatRoom,array("last_seen_message"=>date("Y-m-d H:i:s")),"id='".$support_ticket_id."'",0);
		return $reply;
	}
	function GetChatRoomNewConversation($ChatRoomID,$CheckTime,$SenderID,$SenderType,$limit)
	{
		$Messages=$this->rp_getData(Chat::$CtableChat,"id","support_ticket_id='".$ChatRoomID."' AND datetime>'".$CheckTime."'","id desc",0,$limit);
		if($Messages)
		{
			$MessageDetails=array();
			while($Message=mysqli_fetch_assoc($Messages))
			{
				$MessageDetail=$this->MessageDetail($Message['id'],$SenderID,$SenderType);
				$MessageDetails[]=$MessageDetail;
				
			}
			$reply=array("ack"=>1,"ack_msg"=>"Chat Room Found!!","developer_msg"=>"MESSAGES_FOUND_SUCCESS_6","result"=>$MessageDetails,"check_time"=>date("Y-m-d H:i:s"));
			
		}
		else
		{
			$reply=array("ack"=>0,"ack_msg"=>"End of conversation!!","developer_msg"=>"MESSAGE_NOT_FOUND_ERROR_2","check_time"=>date("Y-m-d H:i:s"));
		}
		
		return $reply;
	}
	public function CheckMedia($Attachment)
	{
		$AttachmentType=explode("/",$Attachment['type']);
		$AttachmentSize=$Attachment['size'];// bytes
		if(array_key_exists($AttachmentType[0],Chat::$ValidMediaExtension) && array_key_exists($AttachmentType[1],Chat::$ValidMediaExtension[$AttachmentType[0]]))
		{
			if(array_key_exists($AttachmentType[0],Chat::$ValidMediaSize) && Chat::$ValidMediaSize[$AttachmentType[0]]>=$AttachmentSize)
			{
				$reply=array("ack"=>1,"ack_msg"=>"Valid Attachment","developer_msg"=>"ATTACHMENT_VALID_SUCCESS_2");
			}
			else
			{
				$reply=array("ack"=>0,"ack_msg"=>"Internal Error!!","developer_msg"=>"TOO_LARGE_FILE_ERROR_5");
			}
			
		}
		else
		{
			$reply=array("ack"=>0,"ack_msg"=>"Internal Error!!","developer_msg"=>"FILE_TYPE_NOT_VALID_ERROR_4");
		}
		return $reply;
	}
	
	
	public function generateRoomTitle($Participants)
	{
		
		
		$ConversationName=array();
		foreach($Participants as $Participant)
		{
			
			$ConversationName[]=$this->rp_getValue("sales_invoice_info","customer_name","id='".$Participant['id']."'");
			
		}
		
		return implode(" & ",$ConversationName);
		
	}
	public function GetChatRoomTitle($ChatRoomID,$RequesterID,$RequesterType)
	{
		$Participants=$this->rp_getData(Chat::$CtableChatRoomParticipant,"*"," id='".$ChatRoomID."'","",0);
		if($Participants)
		{
			while($Participant=mysqli_fetch_assoc($Participants))
			{
				
					$ConversationName[]=$this->rp_getValue("sales_invoice_info","name","id='".$Participant['sales_rapo_id']."'");
				
			}
			
			return implode(" & ",$ConversationName);
		}
		else
		{
			return "";
		}
		
	}


	public function CountNewerMessageCount($cid)
	{
		$count=0;
		$Tickets=$this->rp_getData(Chat::$CtableChatRoom,"*","customer_id='".$cid."'");
		if($Tickets)
		{
			while($Ticket=mysqli_fetch_assoc($Tickets))
			{
				$last_seen_message=$Ticket['last_seen_message'];
				$count+=$this->rp_getTotalRecord(Chat::$CtableChat,"datetime>='".$last_seen_message."' AND support_ticket_id='".$Ticket['id']."'");
			}
		}

		return array("ack"=>1,"ack_msg"=>"","count"=>$count) ;
	}
	public function CountTicketNewerMessageCount($tid)
	{
		$count=0;
		$Tickets=$this->rp_getData(Chat::$CtableChatRoom,"*","id='".$tid."'");
		if($Tickets)
		{
			while($Ticket=mysqli_fetch_assoc($Tickets))
			{
				$last_seen_message=$Ticket['last_seen_message'];
				$count+=$this->rp_getTotalRecord(Chat::$CtableChat,"datetime>='".$last_seen_message."' AND support_ticket_id='".$Ticket['id']."'");
			}
		}

		return array("ack"=>1,"ack_msg"=>"","count"=>$count) ;
	}

	public function GetSupportTicket($CustomerID,$FilterDate,$Limit)
	{
		$ctable_where="";
		if(!empty($FilterDate))
		{
			if(array_key_exists("from_date", $FilterDate) && $FilterDate['from_date']!="")
			{
				$ctable_where .= "DATE(created_date)>='".date("Y-m-d",strtotime($FilterDate['from_date']))."'";
			}

			if(array_key_exists("from_date", $FilterDate) && $FilterDate['to_date']!="")
			{
				if($ctable_where!="")
				$ctable_where.=" AND DATE(created_date)<='".date("Y-m-d",strtotime($FilterDate['to_date']))."'";
				else	
				$ctable_where.="  DATE(created_date)<='".date("Y-m-d",strtotime($FilterDate['to_date']))."'";
				
			}
		}
		if($ctable_where!="")	
		$ctable_where .= " AND customer_id='".$CustomerID."' AND isDelete=0";
		else
		$ctable_where .= " customer_id='".$CustomerID."' AND isDelete=0";

		if(!empty($Limit) && array_key_exists("ul", $Limit) && $Limit['ul']!="" && array_key_exists("ll", $Limit) && $Limit['ll']!="")
		{
				$Limit=$Limit['ul'].",".$Limit['ll'];

		}
		else
		{
			$Limit="";
		}

		$ctable_r = $this->db->rp_getData(Chat::$CtableChatRoom,"id",$ctable_where,"id DESC",0,$Limit);
		if($ctable_r)
		{
			while($ctable_d=mysqli_fetch_assoc($ctable_r))
			{
				$ChatRoom=$this->ChatRoomDetail($ctable_d['id'],"","");
				if($ChatRoom['ack']==1)
				$Tickets[]=$ChatRoom['result'];

			}
			return array("ack"=>1,"ack_msg"=>"Tickets Found!!","result"=>$Tickets) ;
		}
		else
		{
			return array("ack"=>0,"ack_msg"=>"No Ticket Found!!") ;
		}

	}
}
?>