<?php
$page_id = 420;
$page_slug = 'page_loan';
/*
 * @author Snehal Patel
 */
include("connect.php");
include("../include/loan.class.php");
$objLoan = new Loan();

$ctable 	= "loan";
$ctable1 	= "Loan";

$ctable_where = "";
// Get the total number of rows in the table


if (isset($_REQUEST['searchName']) && $_REQUEST['searchName'] != "") {
	$ctable_where .= " (
							name like '%" . $db->clean($_REQUEST['searchName']) . "%'
							OR phone_number like '%" . $db->clean($_REQUEST['searchName']) . "%'
							) AND ";
}

$ctable_where .= " isDelete=0";

$item_per_page =  ($_REQUEST["show"] <> "" && is_numeric($_REQUEST["show"])) ? intval($_REQUEST["show"]) : 100;

if (isset($_REQUEST["page"])) {
	$page_number = filter_var($_REQUEST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
	if (!is_numeric($page_number)) {
		die('Invalid page number!');
	} //incase of invalid page number
} else {
	$page_number = 1; //if there's no page number, set it to 1
}

$get_total_rows = $db->rp_getTotalRecord($ctable, $ctable_where); //hold total records in variable
//break records into pages
$total_pages = ceil($get_total_rows / $item_per_page);

//get starting position to fetch the records
$page_position = (($page_number - 1) * $item_per_page);

$ctable_r = $db->rp_getData($ctable, "*", $ctable_where, "id DESC limit $page_position, $item_per_page", 0);
?>
<form action="" name="frm" id="frm" method="post">
	<table id="dealer_datatable" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>Loan Name</th>
				<th>Phone Number</th>
				<th>Mobile Number</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>

			<?php
			if ($ctable_r) {
				$count = $page_position;

				while ($ctable_d = mysqli_fetch_array($ctable_r)) {

			?>
					<tr id="row<?php echo $ctable_d['id']; ?>">
						<td><?php echo ++$count; ?></td>
						<td><span class="<?php echo ($ctable_d['isActive'] == 0) ? "text-danger" : "text-success"; ?>"><?php echo stripslashes($ctable_d['name']); ?></span></td>
						<td><?php echo stripslashes($ctable_d['phone_number']); ?></td>
						<td><?php echo stripslashes($ctable_d['mobile_number']); ?></td>
						<td><?php echo stripslashes($ctable_d['address']); ?></td>


						<td>
							<?php
							if ($rights['update_flag'] == 1) {
							?>
								<a class="btn btn-info btn-sm" onClick="window.location.href='loan_crud.php?mode=edit&id=<?php echo $ctable_d['id']; ?>'" title="Edit"><i class="fa fa-pencil"></i></a>
							<?php
							}
							if ($rights['delete_flag'] == 1) {
							?>
								<a class="btn btn-danger btn-sm" onClick="del_conf('<?php echo $ctable_d['id']; ?>');" title="Delete"><i class="fa fa-times"></i></a>
							<?php
							}
							if ($rights['view_flag'] == 1) {
							?>

								<div class="btn-group">
									<button aria-expanded="false" data-toggle="dropdown" type="button" class="btn btn-sm green dropdown-toggle">
										More
									</button>
									<ul role="menu" class="dropdown-menu">
										<li>
											<?php
											if ($ctable_d['isActive'] == 1) {
											?>
												<a href="<?php echo $ctable; ?>_crud.php?mode=isActive&id=<?php echo $ctable_d['id']; ?>&status=0" title="Deactivate" disabled><span class="text-danger"><i class="fa fa-circle"></i> &nbsp;Deactivate</span></a>
											<?php
											} else {
											?>
												<a href="<?php echo $ctable; ?>_crud.php?mode=isActive&id=<?php echo $ctable_d['id']; ?>&status=1" title="Aactivate" disabled><span class="text-success"><i class="fa fa-circle-o"></i> &nbsp; Activate </span></a>
											<?php
											}
											?>
										</li>

										<!--<li>
							<a href="#myModal" data-id="<?php echo  stripslashes($ctable_d['id']); ?>" data-toggle="modal" title="View Dealer"><span class="text-success"><i class="fa fa-circle"></i>&nbsp; View Loan</span></a>
							
						</li>
						<li>
<a href="#changePasswordModal" data-id="<?php echo $ctable_d['id']; ?>"  data-toggle="modal" title="Change Password"><span class="text-success"><i class="fa fa-circle"></i>&nbsp; Change Password</span></a>
						</li>-->
									</ul>
								</div>
							<?php
							}
							?>
						</td>
					</tr>
				<?php
				}
				?>

		</tbody>
	</table>
	<div class="row">
		<div class="col-md-2">
			<div class="dataTables_info">
				Show Item Per Page:
				<select id="numRecords" class="form-control mt1" onChange="changeDisplayRowCount(this.value);">
					<option value="100" <?php if ($_REQUEST["show"] == 100 || $_REQUEST["show"] == "") {
											echo ' selected="selected"';
										}  ?>>100</option>
					<option value="500" <?php if ($_REQUEST["show"] == 500) {
											echo ' selected="selected"';
										}  ?>>500</option>
					<option value="1000" <?php if ($_REQUEST["show"] == 1000) {
												echo ' selected="selected"';
											}  ?>>1000</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="dataTables_paginate paging_simple_numbers">
				<ul class="pagination">
					<?php
					echo $db->rp_paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
					?>
				</ul>
			</div>
		</div>
	</div>
<?php
			}
?>
</form>