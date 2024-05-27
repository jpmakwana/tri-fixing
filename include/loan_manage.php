<?php
$page_id = 420;
$page_slug = 'page_loan';
$ctable 	= "loan";
$ctable1 	= "Loan";
$main_page 	= $ctable;
$page 		= "manage_" . $ctable;
$page_title = "Manage " . $ctable1;
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
	<meta charset="utf-8" />
	<title><?php echo $page_title; ?> | <?php echo SITETITLE; ?></title>
	<?php include("include_css.php"); ?>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
	<?php include("header.php"); ?>
	<!-- BEGIN HEADER & CONTENT DIVIDER -->
	<div class="clearfix"> </div>
	<!-- END HEADER & CONTENT DIVIDER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<?php include("../include/sidebar.php"); ?>
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<!-- BEGIN CONTENT BODY -->
			<div class="page-content">
				<!-- BEGIN PAGE BASE CONTENT -->
				<!-- BEGIN DASHBOARD STATS 1-->

				<div class="clearfix"></div>
				<!-- END DASHBOARD STATS 1-->
				<div class="row">
					<div class="col-md-12">
						<?php $db->printErrorMessage(); ?>
						<?php $db->printSuccessMessage(); ?>
						<div class="portlet light portlet-fit full-height-content full-height-content-scrollable bordered">
							<div class="portlet-title">
								<div class="caption">
									<span class="caption-subject font-green bold uppercase h2 "><a href="dashboard.php" class="btn btn-default btn-square "><i class="fa fa-arrow-left"></i></a>&nbsp;<?php echo $page_title; ?></span>
								</div>
								<div class="actions">
									<?php

									echo $db->getAddButton($ctable);
									?>
								</div>
							</div>
							<div class="portlet-body">
								<div class="row">
									<div class="col-md-6">

									</div>
									<div class="col-md-4 pull-right">
										<form action="#" onSubmit="return searchByName();">

											<div class="input-group">

												<input type="text" class="form-control" name="searchName" id="searchName" value="" placeholder="Enter Loan Name" />
												<span class="input-group-btn">
													<input class="btn btn-success" type="submit" value="search" onClick="searchByName()">
												</span>
												<span class="input-group-btn">
													<input class="btn btn-danger" type="button" value="clear" onClick="clearSearchByName();">
												</span>
											</div>

										</form>
									</div>
								</div>
								<div id="results" class="tablecontainer"></div>
							</div>
						</div>
					</div>
				</div>


				<!-- END PAGE BASE CONTENT -->
			</div>
			<!-- END CONTENT BODY -->
		</div>
		<!-- END CONTENT -->

	</div>

	<!-- change by Grishma -->
	<div id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="">
				<div class="modal-body portlet box blue modal-lg">
					<div class="portlet-title">
						<div class="caption">
							View Loan Information </div>
						<div class="tools">

							<a href="javascript:;" id="requesting_ajax" data-load="true" data-url="" class="reload" data-original-title="" title=""><i class="fa fa-reload"></i> </a>

							<a href="javascript:;" data-original-title="" title="" data-dismiss="modal" style="color:white;"> <i class="fa fa-close"></i></a>
						</div>
					</div>
					<div class="portlet-body portlet-empty">
					</div>
				</div>

			</div>
		</div>
	</div>
	<div id="changePasswordModal" class="modal fade" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="">
				<div class="modal-body portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							Change Password </div>
						<div class="tools">

							<a href="javascript:;" id="" data-load="true" data-url="" class="reload" data-original-title="" title=""><i class="fa fa-reload"></i> </a>

							<a href="javascript:;" data-original-title="" title="" data-dismiss="modal" style="color:white;"> <i class="fa fa-close"></i></a>
						</div>
					</div>
					<div class="portlet-body portlet-empty">
						<form action="#" id="changePasswordForm">
							<div class="modal-body">
								<div class="form-body row">
									<div class="form-group col-sm-6">
										<label>New Password</label>
										<input type="password" name="nPassword" id="nPassword" class="form-control" value="" placeholder="New Password">
										<p class="help-block text-danger"></p>
									</div>
									<div class="form-group col-sm-6">
										<label>Re-type new Password</label>
										<input type="password" name="nRPassword" id="nRPassword" class="form-control" value="" placeholder="Re-type New Password">
										<p class="help-block text-danger"></p>
										<input type="hidden" name="userId" id="userId" class="form-control" value="">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input class="btn btn-success" type="submit" value="Update password">
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php include("footer.php"); ?>
	<!-- END FOOTER -->
	<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
	<?php include("include_js.php"); ?>
	<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#changePasswordModal').on('shown.bs.modal', function(event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var userId = button.data('id')
				var modal = $(this)
				modal.find('input[type=hidden][name=userId]').val(userId);
			});
			$('#changePasswordModal').on('hidden.bs.modal', function(event) {
				var modal = $(this)
				modal.find('input[type=hidden][name=userId]').val("");
				modal.find('input[name=nRPassword]').val("");
				modal.find('input[name=nPassword]').val("");
				modal.find('p.help-block').html("");
			});
			$('#changePasswordForm').on('submit', function(e) {

				var error = 0;
				e.preventDefault();
				if ($('#nPassword').val() == "") {
					error = 1;
					$('#nPassword').parent('div.form-group').find('p.help-block').html("*Please Enter Password.");
				} else {
					error = 0;
					$('#nPassword').parent('div.form-group').find('p.help-block').html("");
				}
				if ($('#nRPassword').val() == "" || $('#nPassword').val() != $('#nRPassword').val()) {
					error = 1;
					$('#nRPassword').parent('div.form-group').find('p.help-block').html("*It Must be match with password field !!");
				} else {
					error = 0;
					$('#nRPassword').parent('div.form-group').find('p.help-block').html("");
				}
				if ($('#userId').val() == "") {
					error = 1;
					alert('Internal Error Please Try Again !!');
					$('#changePasswordModal').modal('hide');
				}
				if (error == 0) {
					var nPassword = $('#nPassword').val();
					var userId = $('#userId').val();
					$.ajax({
						type: "POST",
						url: "change_password_system_user.php",
						data: {
							nPassword: nPassword,
							userId: userId
						},
						success: function(data) {
							var json_obj = $.parseJSON(data);
							if (json_obj['data']['ack'] == 1) {
								toastr.success(json_obj['data']['ack_msg']);
								$('#changePasswordModal').modal('hide');
								displayRecords(10, 1);
							} else {
								toastr.error(json_obj['data']['ack_msg']);
								$('#nPassword').val("");
								$('#nRPassword').val("");
							}
						}
					});
				}
			});
		});


		$('#myModal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var requesting_id = button.data("id");
			//alert("sd"+requesting_id);
			$("#requesting_ajax").attr("data-url", "loan_information_get_ajax.php?id=" + requesting_id);
			$("#requesting_ajax").click();
		})
		var searchName = "";
		var data_url = "loan_get_ajax.php";

		function searchByName() {
			searchName = $("#searchName").val();
			displayRecords(100, 1);
			return false;
		}

		function clearSearchByName() {
			searchName = "";
			$("#searchName").val("");
			displayRecords(100, 1);
		}
		$("#searchName").keyup(function(event) {
			if (event.keyCode == 13) {
				$("#searchByName").click();
			}

		});

		function loadDataTable() {
			$('#dealer_datatable').dataTable({
				"bPaginate": false,
				"bFilter": false,
				"bInfo": false,
				"bAutoWidth": false,
				"aoColumns": [{
						"sWidth": "5%"
					},
					{
						"sWidth": "5%"
					},
					{
						"sWidth": "5%"
					},
					{
						"sWidth": "5%"
					},
					{
						"sWidth": "5%"
					},
					{
						"sWidth": "15%",
						"bSortable": false
					}
				],
				"language": {
					"emptyTable": "<h1 class='text-center'>No Loan Found</h1>"
				}
			});
		}

		function displayRecords(numRecords) {
			var searchName = $("#searchName").val();
			searchName = encodeURIComponent(searchName.trim());
			$("#results").html("");
			$("#results").load(data_url + "?show=" + numRecords + "&searchName=" + searchName, function() {
				loadDataTable();
			}); //load initial records

			//executes code below when user click on pagination links
			$("#results").on("click", ".paging_simple_numbers a", function(e) {
				e.preventDefault();
				var numRecords = $("#numRecords").val();
				$(".loading-div").show(); //show loading element
				var page = $(this).attr("data-page"); //get page number from link
				$("#results").load(data_url + "?show=" + numRecords + "&searchName=" + searchName, {
					"page": page
				}, function() { //get content from PHP page
					$(".loading-div").hide(); //once done, hide loading element
					loadDataTable();
				});

			});
			$("#results").on("change", "#numRecords", function(e) {
				e.preventDefault();
				var numRecords = $("#numRecords").val();
				$(".loading-div").show(); //show loading element
				var page = $(this).attr("data-page"); //get page number from link
				$("#results").load(data_url + "?show=" + numRecords + "&searchName=" + searchName, {
					"page": page
				}, function() { //get content from PHP page
					$(".loading-div").hide(); //once done, hide loading element
					loadDataTable();
				});

			});
		}

		// used when user change row limit
		function changeDisplayRowCount(numRecords) {
			displayRecords(numRecords, 1);
		}

		$(document).ready(function() {
			displayRecords(100, 1);
		});






		function del_conf(id) {
			var r = confirm("Are you sure you want to delete?");
			if (r) {
				$.ajax({
					type: "POST",
					url: "ajax_function_delete.php",
					data: 'mode=delete_loan&cid=' + id,
					success: function(result) {
						json = $.parseJSON(result);
						msg = json.ack_msg;
						if (json.ack == 1) {
							toastr.success(msg);
							$("#row" + id).fadeOut(1200);
						} else {
							toastr.error(msg);
						}

					}
				});
			}
		}

		function genReport(did) {
			var rc = encodeURIComponent($("#print_info").html());

			$.ajax({
				type: "POST",
				url: "dealer_ajax_genReport.php",
				data: 'did=' + did,
				beforeSend: function() {
					$(".transCover").fadeIn(800);
					$("#loading-modal").modal('show');
				},
				success: function(result) { //alert(result);
					setTimeout(function() {
						$(".transCover").fadeOut(100);
						$("#loading-modal").modal('hide');
						//window.location.href=result;
						window.open(result, '_blank');
					}, 1500);
				}
			});
		}

		function printPDF(id) {
			// var myWindow = window.open('','','width=700,height=800')
			// myWindow.document.write("<style>th,tr,td{border:1px solid #000; padding:10px;}</style>"+$("#print_info").html());
			// myWindow.print();
			var printWindow = window.open('print_dealer_info.php?id=' + id + "&p=1", '', 'width=800,height=800')
		}
	</script>
</body>

</html>