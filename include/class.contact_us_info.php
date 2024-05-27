<?php
require_once("main.class.php");
require_once("function.class.php");
class ContactUSInfo extends Functions
{
	public $db;
	public $log;
	public $ctable="contact_us_info";
	function __construct($id="") 
	{
		$db = new Functions();
		$conn =$db->connect();
		$this->db=$db;	
		$log	= new Log();		
		$this->log=$log;		
    } 
 
	public function UpdateContactinfo($detail)
	{
			extract($detail);
		
				$created_date=date('Y-m-d H:i:s');
			
				$rows 	= array(
						"address"				=> $address,
						"phone"				=> $phone,
						"email"				=> $email,
							"description"				=> $description,
						"created_date"				=> $created_date,
						);
				$where	= "id=1";
				$isUpdated=$this->db->rp_update($this->ctable,$rows,$where);
				$this->log->insertLog($this->ctable,$_REQUEST['id'],"update",$this->log->slm['CATEGORY_UPDATE_SUCESS']." : ".$category_name);
				if($isUpdated)
				{
					$reply=array("ack"=>1,"developer_msg"=>$this->log->getMessage('CATEGORY_UPDATE_SUCESS',1),"ack_msg"=>$this->log->getMessage('CATEGORY_UPDATE_SUCESS'));
					return $reply;
				}
				else
				{
					$reply=array("ack"=>0,"developer_msg"=>$this->log->getMessage('CATEGORY_UPDATE_FAILED',1),"ack_msg"=>$this->log->getMessage('CATEGORY_UPDATE_FAILED'));
					return $reply;
				}
			
		}	

	
}

?>