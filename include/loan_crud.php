<?php
$page_id=481;$page_slug='page_product';
	$ctable 	                    = "loan";
	$ctable1 	                    = "Loan";
	$main_page 	                    = "loan_mgmt";
		$page 		                    = "manage_".$ctable;
$mode                           =isset($_REQUEST['mode'])?$_REQUEST['mode']:"add";
$page_title                     = ucwords($mode)." ".$ctable1;
include("connect.php");
require_once("../include/loan.class.php");

$objLoan     = new Loan();
		
		// Variable Definations
$id='';$url='';$title='';$target='';$description='';$image_path='';


if(isset($_REQUEST['submit'])){
	
	$detail['id']=trim($db->clean($_REQUEST['id']));
$detail['name']=trim($db->clean($_REQUEST['name']));
$detail['phone_number']=trim($db->clean($_REQUEST['phone_number']));
$detail['mobile_number']=trim($db->clean($_REQUEST['mobile_number']));
$detail['mobile_number_2']=trim($db->clean($_REQUEST['mobile_number_2']));
$detail['address']=trim($db->clean($_REQUEST['address']));
$detail['city']=trim($db->clean($_REQUEST['city']));
$detail['location']=trim($db->clean($_REQUEST['location']));
$detail['refrence_by']=trim($db->clean($_REQUEST['refrence_by']));

	if($mode=="add"){
		$db->checkRightFlag("insert_flag");
		$reply =$objLoan->InsertLoan($detail);
		if($reply['ack']==1){
			
		
			$db->addSuccessMessage($reply['ack_msg']);
			$db->rp_location("loan_manage.php?msg =inserted");
		}
		else{
			//if Eroor come in insert at that time all record store in session and refill in that element
			$_SESSION['product']=$_REQUEST;
			$db->addErrorMessage($reply['ack_msg']);
			$db->rp_location("loan_crud.php?mode=add");
		}
		
	}
	else if($mode=="edit"){
		$db->checkRightFlag("update_flag");
		//	print_r($_REQUEST['items']);exit;
		$reply=$objLoan->UpdateLoan($detail);
		if($reply['ack']==1)
		{
			
			$db->addSuccessMessage($reply['ack_msg']);
		$db->rp_location("loan_manage.php?msg=updated");
		}
		else
		{
			//if Eroor come in insert at that time all record store in session and refill in that element
			$_SESSION['product']=$_REQUEST;
			$db->addErrorMessage($reply['ack_msg']);
				$db->rp_location("loan_crud.php?mode=edit&id=".$reply['id']."");
		}
	}
}
if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="edit"){
		$db->checkRightFlag("update_flag");
		$where = " id='".$_REQUEST['id']."' AND isDelete=0";
		$ctable_r = $db->rp_getData($ctable,"*",$where);
			$detail['id']=$_REQUEST['id'];
		$reply=$objLoan->EditLoan($detail);
		if($reply['ack']==1){
			$result=$reply['result'];
			
			extract($result);
			//$mediaInfo=$media->getMedia(array("mid"=>$image));
			
		}
		else{
			
			$db->addErrorMessage($reply['ack_msg']);
			$db->rp_location("loan_manage.php?msg=inserted");
		}
		
}
if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="delete"){
	$db->checkRightFlag("delete_flag");
	$detail['id']=$_REQUEST['id'];
	$reply=$objLoan->DeleteLoan($detail);
		if($reply['ack']==1){
		$db->addSuccessMessage($reply['ack_msg']);
		$db->rp_location("loan_manage.php?msg=inserted");
		}
		else{
			$db->addErrorMessage($reply['ack_msg']);
		}
}
if(isset($_REQUEST['id']) && $_REQUEST['id']>0 && $_REQUEST['mode']=="isActive" && isset($_REQUEST['status'])  && $_REQUEST['status']!=""){
	
	$db->checkRightFlag("update_flag");
	$id = $_REQUEST['id'];
	$status = $_REQUEST['status'];
		$detail 	= array(
					"isActive"	=> $status,
					"id"	=> $id
			);
		$reply=$objLoan->ActiveLoan($detail);
	if($reply['ack']==1){
		$db->addSuccessMessage($reply['ack_msg']);
		$db->rp_location($ctable."_manage.php?msg=inserted");
	}
	else{
		$db->addErrorMessage($reply['ack_msg']);
		}
}

?>
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $page_title; ?> | <?php echo SITETITLE; ?></title>
		<?php include("include_css.php");?>
		
		<link href="assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />

		<link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
		
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
       <?php include("header.php");?>
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <?php include("../include/sidebar.php");?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>
									<?php
									if($_REQUEST['mode']=="edit")
									{
										echo "Edit Loan - ". $name=$db->rp_getValue($ctable,"name","id='".$_REQUEST['id']."'");
									}
									else
									{
										echo $page_title;
									}
							?></h1>
									
                        </div>
                        <!-- END PAGE TITLE -->
                        
                    </div>
                    <!-- END PAGE HEAD-->
                    
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <!-- BEGIN DASHBOARD STATS 1-->
                    
                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
			<div class="row">
				<div class="col-md-12">		
							<?php $db->printErrorMessage(); ?>
							<?php $db->printSuccessMessage(); ?>				
					<div class="portlet box">
						<div class="portlet-body">
							<div class="row">	
								<div class="col-sm-12">
									<div class="tabbable-linned">
										<div class="tab-content">
											<div class="tab-pane active" id="tab_super_stockist_info">
												<form id="loan_form"  onSubmit="return check_form();" method="post">
												<div class="row">
													<div class="col-md-8">
														<div class="portlet light">
															<div class="portlet-title">
																<div class="caption">
																   Loan Details
																</div>
															</div>
															<div class="portlet-body">
															   
																<div class="row">
																	<div class="col-md-12">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="form-group">
																				<label>Loan Name<code>*</code></label>
																				<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" autofocus>
																				<p class="help-block"></p>
																			</div>
																		</div>
																			<div class="col-md-12">
																		<div class="form-group">
																			<label>Phone Number</label>
																			<input type="text" class="form-control nagative" name="phone_number" id="phone_number" value="<?php echo $phone_number; ?>" autofocus  minlength="10" maxlength="10" onkeypress="return event.charCode > 47 && event.charCode < 58;"  >
																			<p class="help-block"></p>
																		</div>
																		</div>
																		
																		<div class="col-md-12">
																			<div class="form-group">
																				<label>Mobile Number</label>
																			<input type="text" class="form-control nagative" name="mobile_number" id="mobile_number" value="<?php echo $mobile_number; ?>" autofocus  minlength="10" maxlength="10" onkeypress="return event.charCode > 47 && event.charCode < 58;"  >
																		<p class="help-block"></p>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="form-group">
																				<label>Mobile Number 2</label>
																			<input type="text" class="form-control nagative" name="mobile_number_2" id="mobile_number_2" value="<?php echo $mobile_number_2; ?>" autofocus  minlength="10" maxlength="10" onkeypress="return event.charCode > 47 && event.charCode < 58;"  >
																		<p class="help-block"></p>
																			</div>
																		</div>
																		
																			
																		<div class="col-md-12">
																			<div class="form-group">
																				<label>Address</label>
																				<textarea type="text" class="form-control" name="address" id="address"><?php echo $address; ?></textarea>
																				<p class="help-block"></p>
																			</div>
																		</div>
																	
																	<div class="col-md-6">
																			<div class="form-group">
																				<label>City</label>
																				<input type="text" class="form-control" name="city" id="city" value="<?php echo $city; ?>" autofocus>
																				<p class="help-block"></p>
																			</div>
																		</div>
																	<div class="col-md-6">
																			<div class="form-group">
																				<label>Location</label>
																				<input type="text" class="form-control" name="location" id="location" value="<?php echo $location; ?>" autofocus>
																				<p class="help-block"></p>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="form-group">
																				<label>Refrence by</label>
																				<input type="text" class="form-control" name="refrence_by" id="refrence_by" value="<?php echo $refrence_by; ?>" autofocus>
																				<p class="help-block"></p>
																			</div>
																		</div>
																	</div>
																		
																	</div>
																</div>
															</div>
														</div>
													</div>

												</div>
												
												
											
												<div class="row">
													<div class="col-sm-12 col-lg-12 col-xs-12 form-group " style="padding-right:30px;">&nbsp;&nbsp;
														<button type="submit" id="submit" name="submit" class="btn green">Submit</button>&nbsp;&nbsp;
														<button type="button" class="btn btn-default" onClick="window.location.href='loan_manage.php'">Back</button>
													</div>
												</div>	
												</form>
											</div>
										
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>




        <!-- END CONTAINER -->
        <?php include("footer.php");?>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<?php include("include_js.php");?>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script src="js/jquery.datetimepicker.js"></script>

<script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="js/jquery.numeric.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script> 
<script src="js/jquery.datetimepicker.js"></script> 
<script src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script> 
<script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 


</body>

</html>
