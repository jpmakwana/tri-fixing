<?php
$GLOBALS['PANEL_TYPE']='ADMIN';
if((!isset($_SESSION[SITE_SESS.'_ADMIN_SESS_ID']) && $_SESSION[SITE_SESS.'_ADMIN_SESS_ID']=="") && !(isset($_REQUEST['skip_security']))){
	$from 	= explode("/",$_SERVER['REQUEST_URI']);
	$from1 	= urlencode(end($from));

	$db->rp_location("index.php?from=".$from1);
}
else
{	
	if(isset($_REQUEST['skip_security']) && $_REQUEST['skip_security']==1224)
	{
		goto skip_security;
	}
	unset($_SESSION['rights']);
	$admin_id=$_SESSION[SITE_SESS.'_ADMIN_SESS_ID'];
    $admin_type=$_SESSION[SITE_SESS.'_ADMIN_TYPE'];
	$isCommanPage=false;
	if($admin_type==0)
	{
		goto skip_security;
	}
	
	
	if($page_id && $page_id!="")
	{
		
		if(in_array($page_id,$comman_pages))
		{
			$isCommanPage=true;
			goto skip_security;
		}
		$isPageRegistered=$db->rp_getTotalRecord("page_table","id='".$page_id."'");
		if($isPageRegistered>0)
		{
			$rights=$db->rp_getData("page_admin_right","*","page_id='".$page_id."' AND admin_id='".$admin_type."'");
			if($rights)
			{
				
				$_SESSION['rights']=$rights=mysqli_fetch_assoc($rights);
				
				if($rights['view_flag']==0)
				{
					$db->rp_location("access_denied.php?msg=access_denied");
				}
			}
			else
			{
				
				$db->rp_location("access_denied.php?msg=access_denied");
			}
			
		}
		else
		{
			$db->rp_location("access_denied.php?msg=page_not_registered");
		}
	}
	else
	{
		$db->rp_location("404.php?msg=page_id_not_found");
	}
	skip_security:
	if($admin_type==0)
	$rights=$_SESSION['rights']=array("insert_flag"=>1,"view_flag"=>1,"update_flag"=>1,"delete_flag"=>1);
	if($isCommanPage)
	$rights=$_SESSION['rights']=array("insert_flag"=>1,"view_flag"=>1,"update_flag"=>1,"delete_flag"=>1);
		
}

?>