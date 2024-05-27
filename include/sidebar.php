<?php
$Sidebar = array(
	0 => array(
		"page_id" => 400,
		"page_name" => "Dashboard",
		"page_icon" => "<i class='icon-home'></i>",
		"page_url" => "",
		"subitems" => array(),
	),
	1 => array(
		"page_id" => 479,
		"page_name" => "User List",
		"page_icon" => "<i class='icon-users'></i> &nbsp;",
		"page_url" => "user_manage.php",
		"subitems" => array(),
	),
	8 => array(
		"page_id" => 514,
		"page_name" => "Vendor List",
		"page_icon" => "<i class='icon-users'></i> &nbsp;",
		"page_url" => "vendor_manage.php",
		"subitems" => array(),
	),
	2 => array(
		"page_id" => 525,
		"page_name" => "Mobile Repair",
		"page_icon" => "<i class='fa fa-mobile'></i>&nbsp;",
		"page_url" => "",
		"subitems" => array(
			0 => array(
				"page_id" => 525,
				"page_name" => "<i class='fa fa-bars'></i>&nbsp&nbsp Category",
				"page_url" => "category_manage.php",
			),
			1 => array(
				"page_id" => 526,
				"page_name" => "<i class='fa fa-bars'></i>&nbsp&nbsp Brand",
				"page_url" => "brand_manage.php",
			),
			2 => array(
				"page_id" => 527,
				"page_name" => "<i class='fa fa-bars'></i>&nbsp&nbsp Modal",
				"page_url" => "modal_manage.php",
			)

		),
	),
	3 => array(
		"page_id" => 528,
		"page_name" => "Device Problem",
		"page_icon" => "<i class='fa fa-exclamation-triangle'></i>&nbsp;",
		"page_url" => "",
		"subitems" => array(
			0 => array(
				"page_id" => 528,
				"page_name" => "<i class='fa fa-exclamation-circle'></i>&nbsp&nbsp Device Problem",
				"page_url" => "device_problem_manage.php",
			),
			1 => array(
				"page_id" => 530,
				"page_name" => "<i class='fa fa-exclamation-circle'></i>&nbsp&nbsp Sub Device Problem",
				"page_url" => "sub_device_problem_manage.php",
			)
		),
	),
	// 3 => array(
	// 	"page_id" => 528,
	// 	"page_name" => "Device Problem",
	// 	"page_icon" => "<i class='icon-users'></i> &nbsp;",
	// 	"page_url" => "device_problem_manage.php",
	// 	"subitems" => array(),
	// ),
	4 => array(
		"page_id" => 521,
		"page_name" => "Gallery",
		"page_icon" => "<i class='fa fa-file-image-o'></i> &nbsp;",
		"page_url" => "gallery_manage.php",
		"subitems" => array(),
	),
	5 => array(
		"page_id" => 523,
		"page_name" => "User Inquiry",
		"page_icon" => "<i class='icon-users'></i> &nbsp;",
		"page_url" => "userinquiry_manage.php",
		"subitems" => array(),
	),
	6 => array(
		"page_id" => 508,
		"page_name" => "Inquiry",
		"page_icon" => "<i class='icon-users'></i> &nbsp;",
		"page_url" => "inquiry_manage.php",
		"subitems" => array(),
	),
	7 => array(
		"page_id" => 529,
		"page_name" => "Offers",
		"page_icon" => "<i class='fa fa-cubes'></i> &nbsp;",
		"page_url" => "offers_manage.php",
		"subitems" => array(),
	),
	9 => array(
		"page_id" => 531,
		"page_name" => "Orders List",
		"page_icon" => "<i class='icon-list'></i> &nbsp;",
		"page_url" => "orders_manage.php",
		"subitems" => array(),
	),

	// 9 => array(
	// 	"page_id" => 516,
	// 	"page_name" => "Terms",
	// 	"page_icon" => "<i class='fa fa-cubes'></i> &nbsp;",
	// 	"page_url" => "terms_manage.php",
	// 	"subitems" => array(),
	// )
)

?>

<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

			<?php
			foreach ($Sidebar as $key => $SidebarItem) {
				$Active = "";

				if (empty($SidebarItem['subitems']) && $system->hasRights($SidebarItem['page_id']) == -1) {
					continue;
				} else {
					if (!empty($SidebarItem['subitems'])) {
						$Active = "";
						$hasRights = 0;
						foreach ($SidebarItem['subitems'] as $Subitem) {

							if ($page_id == $Subitem['page_id']) {
								$Active = "active";
							}

							if ($system->hasRights($Subitem['page_id']) == -1) {
								continue;
							} else {
								$hasRights = 1;
							}
						}
					} else {
						if ($page_id == $SidebarItem['page_id']) {
							$Active = "active";
						}
						$hasRights = 1;
					}

					if ($hasRights) {


						if ($key == 1) {
			?>
							<li class="heading">
								<h3 class="uppercase">Menu</h3>
							</li>
						<?php
						}
						?>
						<li class="nav-item start <?php echo $Active; ?>">
							<a href="<?php echo ADMINSITEURL; ?><?php echo $SidebarItem['page_url']; ?>" class="nav-link nav-toggle">
								<?php echo $SidebarItem['page_icon']; ?>
								<span class="title"><?php echo $SidebarItem['page_name']; ?></span>
								<span class="selected"></span>
								<?php echo (sizeof($SidebarItem['subitems']) != 0) ? "<span class='arrow'></span>" : ""; ?>
							</a>
							<?php

							if (sizeof($SidebarItem['subitems']) != 0) {
							?>
								<ul class="sub-menu">
									<?php
									$Activepage = "";
									foreach ($SidebarItem['subitems'] as $Subitem) {

										if ($system->hasRights($Subitem['page_id']) == -1) {
											continue;
										}
										$Activepage = "";
										if ($page_id == $Subitem['page_id']) {
											$Activepage = "active";
										}

									?>
										<li class="nav-item <?php echo $Activepage; ?> ">
											<a href="<?php echo $Subitem['page_url']; ?>" class="nav-link ">
												<span class="title"><?php echo $Subitem['page_name']; ?></span>
											</a>
										</li>
									<?php
									}
									?>
								</ul>
							<?php
							}
							?>
						</li>
			<?php
					}
				}
			}
			?>




		</ul>

		<!-- END SIDEBAR MENU -->
	</div>
	<!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->