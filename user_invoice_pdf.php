<?php

include("connect.php");
// Include your database connection code here

include("include/no_to_word.php");
$order_id = $_REQUEST['order_id'];

$order_detail_r = $db->rp_getData("orders", "*", "id='" . $order_id . "'");
$order_detail_d = mysqli_fetch_array($order_detail_r);

$user_id = $order_detail_d['user_id'];
$user_detail_r = $db->rp_getData("user", "*", "id='" . $user_id . "'");
$user_detail_d = mysqli_fetch_assoc($user_detail_r);

$vendor_id = $order_detail_d['vendor_id'];
$vendor_detail_r = $db->rp_getData("vendor", "*", "id='" . $vendor_id . "'");
$vendor_detail_d = mysqli_fetch_assoc($vendor_detail_r);

$user_addr_id = $order_detail_d['user_address_id'];
$user_addr_detail_r = $db->rp_getData("user_address", "*", "id='" . $user_addr_id . "'");
$user_addr_detail_d = mysqli_fetch_assoc($user_addr_detail_r);

// print_r($user_addr_detail_d);
// exit;

$ctable_where1	= "order_id	='" . $order_id . "' AND isDelete=0";
$order_items = $db->rp_getData("user_device_problem", "*", $ctable_where1, "", 0);

?>
<!DOCTYPE html>
<html>

<head>
	<title>Purchase Order</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			font-family: Arial;
			font-size: 10pt;
			color: #000;
		}

		body {
			width: 100%;
			font-family: Arial;
			font-size: 9pt;
			margin: 0;
			padding: 0;
		}

		p {
			margin: 0;
			padding: 0;
		}


		table {
			border-spacing: 0;
			border-collapse: collapse;

		}

		table td {
			padding: 2mm;
		}

		h1.heading {
			font-size: 14pt;
			color: #000;
			font-weight: normal;
		}

		h2.heading {
			font-size: 9pt;
			color: #000;
			font-weight: normal;
		}

		hr {
			color: #ccc;
			background: #ccc;
		}

		.invoice table,
		.invoice td,
		.invoice tr {
			border: 1px dashed #ccc;
		}

		#invoice_body {
			margin-bottom: 2mm;
		}

		#invoice_body,
		#invoice_total {
			width: 100%;
		}

		#invoice_body table,
		#invoice_total table {
			width: 100%;
			border-spacing: 0;
			border-collapse: collapse;
			margin-top: 5mm;
		}

		#invoice_body table td,
		#invoice_total table td {
			text-align: center;
			font-size: 9pt;
			padding: 2mm 0;
		}

		#invoice_body table td.rp_right,
		#invoice_total table td.rp_right {
			text-align: right;
			padding-right: 2mm;
			font-size: 9pt;
		}

		#footer {
			width: 185mm;
			margin: 0 15mm;
			padding-bottom: 3mm;
		}

		#footer table {
			width: 100%;
			border-left: 1px solid #000000;
			border-top: 1px solid #000000;
			background: #eee;
			border-spacing: 0;
			border-collapse: collapse;
		}

		#footer table td {
			width: 25%;
			text-align: center;
			font-size: 9pt;
			border-right: 1px solid #000000;
			border-bottom: 1px solid #000000;
		}

		.lineThrClass {
			text-decoration: line-through;
		}
	</style>
</head>

<body>
	<table style="width:100%">
		<tr>
			<td style="width:70%"><img src="<?php echo SITEURL; ?>images/logo-blue.png" style="width:30%;"></td>
			<td style="width:30%">
				<p>Order number :-<?php echo $_REQUEST['order_id']; ?><br />Date and time :-<?php echo  date('d-m-Y', strtotime($order_detail_d['created_date'])); ?><br><?php echo  date('H:i:s', strtotime($order_detail_d['created_date'])); ?></p>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center">
				<h3> Order Guide </h3>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<div class="invoice" style=" border:1px solid #000;padding:2mm;">
		<table style="width:100%">
			<tbody>
				<tr>
					<td colspan="2" style="text-align:center">
						<p><strong><u>ADDRESS</u></strong></p>
					</td>
				</tr>
				<tr>
					<td class="center">
						<p><strong>USER ADDRESS</strong></p>
					</td>
					<td class="center">
						<p><strong>VENDOR ADDRESS </strong></p>
					</td>
				</tr>
				<tr>
					<td class="center"><?php echo $user_addr_detail_d['address']; ?></td>
					<td class="center"><?php echo $vendor_detail_d['address']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="invoice" style="margin-top:20px;border:1px solid #000;padding:2mm;">
		<table style="width:100%">
			<tbody>
				<tr>
					<td colspan="3" style="text-align:center">
						<p><strong><u>DEVICE PROBLEM DETAILS </u></strong></p>
					</td>
				</tr>
				<tr>
					<td class="center"><strong>Sr. No</strong></td>
					<td class="center">
						<p><strong>PROBLEM NAME</strong></p>
					</td>
					<td class="center">
						<p><strong>AMOUNT </strong></p>
					</td>
				</tr>

				<?php
				$count = 0;
				while ($order_item = mysqli_fetch_array($order_items)) {
					$count++;
				?>
					<tr>
						<td class="center"><?php echo $count; ?></td>
						<td><?php echo $db->rp_getValue('device_problem', "device_problem_name", "id='" . $order_item['device_probem_id'] . "'"); ?></td>
						<td><?php echo number_format((float)$db->rp_getValue('device_problem', "amount", "id='" . $order_item['device_probem_id'] . "'"), 2, '.', ''); ?></td>
					</tr>
				<?php
				}
				?>

				<tr>
					<td colspan="2" class="center">
						<p><strong>SUB TOTAL</strong></p>
					</td>
					<td class="center"><?php echo $order_detail_d['sub_total'] ?></td>
				</tr>
				<tr>
					<td colspan="2" class="center">
						<p><strong>TAX</strong></p>
					</td>
					<td class="center"><?php echo $order_detail_d['tax_amount'] ?></td>
				</tr>
				<tr>
					<td colspan="2" class="center">
						<p><strong>OFFER DISCOUNT</strong></p>
					</td>
					<td class="center"><?php echo $order_detail_d['offer_amount'] ?></td>
				</tr>
				<tr>
					<td colspan="2" class="center">
						<p><strong>GRAND TOTAL</strong></p>
					</td>
					<td class="center"><?php echo $order_detail_d['grand_total'] ?></td>
				</tr>

			</tbody>
		</table>
	</div>

	<htmlpagefooter name="footer">
		<table style="width:100%">
			<tr>
				<td style="text-align:right">
					<p style="text-align:center"><strong>Thank you !</strong></p>
				</td>
				<td style="text-align:right"><img src="<?php echo SITEURL; ?>images/logo-blue.png" style="width:20%;"></td>
			</tr>
		</table>
		<hr />
		<div id="footer">
			<table>
				<tr>
					<td><strong>THIS IS A SYSTEM GENERATED DOCUMENT AND DOES NOT REQUIRE SIGNATURE</strong></td>
				</tr>
			</table>
			<p style="text-align:center">Powered by TRI-FIXING.COM</p>
		</div>
	</htmlpagefooter>
	<sethtmlpagefooter name="footer" value="on" />

</body>

</html>