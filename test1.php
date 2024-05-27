<?php
require_once("connect.php");
if (!isset($_SESSION['VENDOR_ID'])) {
    $_SESSION['last_open_url'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $db->flash("msg-error", "Please Login");
    $db->rp_location('login.php');
    exit();
}

include "common.php";
// $common_obj = new Common();
// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['order_form'] == "order_form") {
    $sub_total = $_POST['subtotalInput'];
    $tax_amount = $_POST['taxInput'];
    $offer_amount = "0";
    $grand_total = $_POST['totalInput'];
    $order_id = $_POST['order_id'];
    $device_problem_id = "";
    $order_q = mysqli_query($conn, "select * from orders where id = '" . $order_id . "' and isDelete=0 and isActive=1");
    $order_r = mysqli_fetch_assoc($order_q);
    if ($order_r) {
        $q = mysqli_query($conn, "UPDATE orders set device_problem_id = '" . $device_problem_id . "',sub_total = '" . $sub_total . "',tax_amount = '" . $tax_amount . "',offer_amount = '" . $offer_amount . "',grand_total = '" . $grand_total .
            "' where id = '" . $order_id . "' and isDelete=0 and isActive=1");
        $problem_id = $_POST['options'];
        if ($q) {
            if ($_POST['options'] != "") {
                $device_problem_items = $_POST['options'];
                $where = " where id = '" . $order_id . "' and isDelete=0 and isActive=1";
                $order_d = mysqli_query($conn, "select * from orders" . $where);
                $order_r = mysqli_fetch_assoc($order_d);
                $sql = "DELETE FROM user_device_problem WHERE order_id='" . $order_id . "'";
                mysqli_query($conn, $sql);
                foreach ($device_problem_items as $device_problem_array) {
                    $device_probem_id = $device_problem_array;
                    $sub_device_problem_id = $_POST["type$device_probem_id"];
                    $q1 = mysqli_query($conn, "insert into user_device_problem(device_probem_id,sub_device_problem_id,user_id,vendor_id,order_id,created_date)values('" . $device_probem_id . "','" . $sub_device_problem_id . "','" . $order_r['user_id'] . "','" . $order_r['vendor_id'] . "','" . $order_id . "','" . date("Y-m-d H:i:s") . "')");
                }
            }
            // require_once __DIR__ . '../mpdf/vendor/autoload.php';
            // $mpdf = new \Mpdf\Mpdf();
            // $mpdf->packTableData = true;
            // $mpdf->AddPage();
            // $fileName = "invoice-" . $order_id . '.pdf';
            // $mpdf->WriteHTML(file_get_contents(SITEURL . 'user_invoice_pdf.php?order_id=' . $order_id . ''));
            // $mpdf->Output("../pdf/user_invoice/" . $fileName, \Mpdf\Output\Destination::FILE);
            // $q2 = mysqli_query($conn, "UPDATE orders set order_pdf = '" . $fileName . "' where id = '" . $order_id . "' and isDelete=0 and isActive=1");
            $db->flash("msg", "Order Updated successfully !!");
            $db->rp_location(SITEURL . "orders.php");
        } else {
            $db->flash("msg-error", "Something Went Wrong!!");
        }
    } else {
        $db->flash("msg-error", "No Vendor(s) found !!");
    }
}

$where_order = " id = '" . $_REQUEST["order_id"] . "' and isDelete=0 and isActive=1";
$ctable_order_r = $db->rp_getData("orders", "*", $where_order);
$ctable_order_d = mysqli_fetch_array($ctable_order_r);

$ctable_modal = "modal";
$ctable_modal_where = "id='" . $ctable_order_d["modal_id"] . "' AND isDelete=0";
$ctable_modal_r = $db->rp_getData($ctable_modal, "*", $ctable_modal_where);
$ctable_modal_d = mysqli_fetch_array($ctable_modal_r);

$ctable_category = "category";
$ctable_category_where = "id='" . $ctable_order_d["category_id"] . "' AND isDelete=0";
$ctable_category_r = $db->rp_getData($ctable_category, "*", $ctable_category_where);
$ctable_category_d = mysqli_fetch_array($ctable_category_r);

$ctable_u_p_problem = "user_device_problem";
$ctable_u_p_problem_where = "order_id='" . $_REQUEST["order_id"] . "' AND isDelete=0";
$ctable_u_p_problem_r = $db->rp_getData($ctable_u_p_problem, "*", $ctable_u_p_problem_where);
$ctable_u_p_problem_d = mysqli_fetch_assoc($ctable_u_p_problem_r);

// while ($ctable_u_p_problem_d = mysqli_fetch_assoc($ctable_u_p_problem_r)) {
//     print_r($ctable_u_p_problem_d['id']);
//     $checkboxId = "checkbox_" . $row['id'];
//     $checked = $row['checked'] ? 'checked' : ''; // Check the checkbox if 'checked' field is true
//     echo "<input type='checkbox' id='$checkboxId' name='checkboxes[]' value='{$row['id']}' $checked>";
//     echo "<label for='$checkboxId'>{$row['name']}</label><br>";
//     exit;
// }



?>

<!doctype html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Iphone X &#8211; Tri-fixing &#8211; Mobile Device and Electronics Repair </title>
    <link rel="stylesheet" href="../css/main-style.css" media="all" />
    <link rel='stylesheet' id='woocommerce-smallscreen-css' href='../css/woocommerce-smallscreen.min.css' type='text/css' media='only screen and (max-width: 768px)' />
    <script defer type="text/javascript" src="../js/jquery.min.js"></script>
    <style id='global-styles-inline-css' type='text/css'>
        body {
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--duotone--dark-grayscale: url('#wp-duotone-dark-grayscale');
            --wp--preset--duotone--grayscale: url('#wp-duotone-grayscale');
            --wp--preset--duotone--purple-yellow: url('#wp-duotone-purple-yellow');
            --wp--preset--duotone--blue-red: url('#wp-duotone-blue-red');
            --wp--preset--duotone--midnight: url('#wp-duotone-midnight');
            --wp--preset--duotone--magenta-yellow: url('#wp-duotone-magenta-yellow');
            --wp--preset--duotone--purple-green: url('#wp-duotone-purple-green');
            --wp--preset--duotone--blue-orange: url('#wp-duotone-blue-orange');
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
            --wp--preset--spacing--20: 0.44rem;
            --wp--preset--spacing--30: 0.67rem;
            --wp--preset--spacing--40: 1rem;
            --wp--preset--spacing--50: 1.5rem;
            --wp--preset--spacing--60: 2.25rem;
            --wp--preset--spacing--70: 3.38rem;
            --wp--preset--spacing--80: 5.06rem;
            --wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
            --wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);
            --wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);
        }

        :where(.is-layout-flex) {
            gap: 0.5em;
        }

        body .is-layout-flow>.alignleft {
            float: left;
            margin-inline-start: 0;
            margin-inline-end: 2em;
        }

        body .is-layout-flow>.alignright {
            float: right;
            margin-inline-start: 2em;
            margin-inline-end: 0;
        }

        body .is-layout-flow>.aligncenter {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        body .is-layout-constrained>.alignleft {
            float: left;
            margin-inline-start: 0;
            margin-inline-end: 2em;
        }

        body .is-layout-constrained>.alignright {
            float: right;
            margin-inline-start: 2em;
            margin-inline-end: 0;
        }

        body .is-layout-constrained>.aligncenter {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        body .is-layout-constrained> :where(:not(.alignleft):not(.alignright):not(.alignfull)) {
            max-width: var(--wp--style--global--content-size);
            margin-left: auto !important;
            margin-right: auto !important;
        }

        body .is-layout-constrained>.alignwide {
            max-width: var(--wp--style--global--wide-size);
        }

        body .is-layout-flex {
            display: flex;
        }

        body .is-layout-flex {
            flex-wrap: wrap;
            align-items: center;
        }

        body .is-layout-flex>* {
            margin: 0;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important;
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important;
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important;
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important;
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important;
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important;
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important;
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important;
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important;
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important;
        }

        .wp-block-navigation a:where(:not(.wp-element-button)) {
            color: inherit;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        .wp-block-pullquote {
            font-size: 1.5em;
            line-height: 1.6;
        }
    </style>
    <style id='woocommerce-inline-inline-css' type='text/css'>
        .woocommerce form .form-row .required {
            visibility: visible;
        }
    </style>
    <style id='tekhfixers-theme-inline-css' type='text/css'>
        @media screen and(max-width:991px) {}

        .primary-menu>li>a {
            color: #b3bec8
        }

        .primary-menu>li>a:hover {
            color: #32eb9a
        }

        .primary-menu>li.current_page_item>a,
        .primary-menu>li.current-menu-item>a,
        .primary-menu>li.current_page_ancestor>a,
        .primary-menu>li.current-menu-ancestor>a {
            color: #32eb9a
        }

        #site-header-wrap.header-layout .headroom--pinned:not(.headroom--top) .primary-menu>li>a {
            color: #b3bec8
        }

        #site-header-wrap.header-layout .headroom--pinned:not(.headroom--top) .primary-menu>li>a:hover {
            color: #32eb9a
        }

        #site-header-wrap.header-layout .headroom--pinned:not(.headroom--top) .primary-menu>li.current_page_item>a,
        .headroom--pinned:not(.headroom--top) .primary-menu>li.current-menu-item>a,
        .headroom--pinned:not(.headroom--top) .primary-menu>li.current_page_ancestor>a,
        .headroom--pinned:not(.headroom--top) .primary-menu>li.current-menu-ancestor>a {
            color: #32eb9a !important
        }

        @media screen and(max-width:991px) {
            body #pagetitle {
                padding-top: 16px;
                padding-bottom: 46px
            }
        }

        @media screen and(min-width:1280px) {
            .content-row {
                margin-left: -25px
            }

            .content-row {
                margin-right: -25px
            }

            .content-row #primary,
            .content-row #secondary {
                padding-left: 25px !important
            }

            .content-row #primary,
            .content-row #secondary {
                padding-right: 25px !important
            }
        }

        @media screen and(min-width:992px) {}

        .site-footer {
            background: #022243;
            background: -moz-linear-gradient(to right, #022243, #083260);
            background: -webkit-linear-gradient(to right, #022243, #083260);
            background: -o-linear-gradient(to right, #022243, #083260);
            background: -ms-linear-gradient(to right, #022243, #083260);
            background: linear-gradient(to right, #022243, #083260);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#022243", endColorstr="#083260", GradientType=0)
        }
    </style>
    <style>
        .woocommerce-product-gallery {
            opacity: 1 !important;
        }
    </style>
    <style id="cms_theme_options-dynamic-css" title="dynamic-css" class="redux-options-output">
        body .primary-menu>li>a,
        body .primary-menu .sub-menu li a {
            font-display: swap;
        }

        .site-footer {
            background: linear-gradient(90deg, #022243 0%, #083260 100%);
            background: -moz-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -webkit-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -o-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -ms-linear-gradient(0deg, #022243 0%, #083260 100%)
        }

        .site-footer .bottom-footer .footer-widget-title,
        .site-footer .top-footer .footer-widget-title {
            font-display: swap;
        }

        a {
            color: #b3bec8;
        }

        a:hover {
            color: #27e491;
        }

        a:active {
            color: #27e491;
        }

        body {
            font-display: swap;
        }

        h1,
        .h1,
        .text-heading {
            font-display: swap;
        }

        h2,
        .h2 {
            font-display: swap;
        }

        h3,
        .h3 {
            font-display: swap;
        }

        h4,
        .h4 {
            font-display: swap;
        }

        h5,
        .h5 {
            font-display: swap;
        }

        h6,
        .h6 {
            font-display: swap;
        }
    </style>
    <noscript>
        <style>
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }
        </style>
    </noscript>
    <style>
        #round {
            border-radius: 50%;
        }
    </style>
    <link rel="stylesheet" href="../css/toastr.min.css">
</head>

<body class="device-template-default single single-device postid-1526 theme-tekhfixers woocommerce-no-js visual-composer wpb-js-composer js-comp-ver-6.8.0 vc_responsive">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-dark-grayscale">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 0.49803921568627" />
                    <feFuncG type="table" tableValues="0 0.49803921568627" />
                    <feFuncB type="table" tableValues="0 0.49803921568627" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-grayscale">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 1" />
                    <feFuncG type="table" tableValues="0 1" />
                    <feFuncB type="table" tableValues="0 1" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-purple-yellow">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.54901960784314 0.98823529411765" />
                    <feFuncG type="table" tableValues="0 1" />
                    <feFuncB type="table" tableValues="0.71764705882353 0.25490196078431" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-blue-red">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 1" />
                    <feFuncG type="table" tableValues="0 0.27843137254902" />
                    <feFuncB type="table" tableValues="0.5921568627451 0.27843137254902" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-midnight">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0 0" />
                    <feFuncG type="table" tableValues="0 0.64705882352941" />
                    <feFuncB type="table" tableValues="0 1" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-magenta-yellow">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.78039215686275 1" />
                    <feFuncG type="table" tableValues="0 0.94901960784314" />
                    <feFuncB type="table" tableValues="0.35294117647059 0.47058823529412" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-purple-green">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.65098039215686 0.40392156862745" />
                    <feFuncG type="table" tableValues="0 1" />
                    <feFuncB type="table" tableValues="0.44705882352941 0.4" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
        <defs>
            <filter id="wp-duotone-blue-orange">
                <feColorMatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 " />
                <feComponentTransfer color-interpolation-filters="sRGB">
                    <feFuncR type="table" tableValues="0.098039215686275 1" />
                    <feFuncG type="table" tableValues="0 0.66274509803922" />
                    <feFuncB type="table" tableValues="0.84705882352941 0.41960784313725" />
                    <feFuncA type="table" tableValues="1 1" />
                </feComponentTransfer>
                <feComposite in2="SourceGraphic" operator="in" />
            </filter>
        </defs>
    </svg>
    <div id="page" class="site">
        <div id="cms-loadding" class="cms-loader">
            <div class="loading-spin">
                <div class="spinner">
                    <div class="right-side">
                        <div class="bar"></div>
                    </div>
                    <div class="left-side">
                        <div class="bar"></div>
                    </div>
                </div>
                <div class="spinner color-2">
                    <div class="right-side">
                        <div class="bar"></div>
                    </div>
                    <div class="left-side">
                        <div class="bar"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-page-title has-page-title ">
            <div class="color-overlay"></div>
            <?php include('header.php'); ?>
            <div class="page-title-container">
                <div id="pagetitle" class="page-title page-title-layout1 ">
                    <div class="container">
                        <div class="page-title-inner">
                            <div class="page-title-content clearfix">
                                <h1 class="page-title ft-heading-b"><?php echo $ctable_modal_d["modal_name"] ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="site-content">
            <div class="content-inner"> <svg style="fill: #B8F6DB; top:0px;" id="svg-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="195.875" height="1318.28" viewBox="0 0 195.875 1318.28">
                    <defs>
                        <filter id="gradient-overlay-2" filterUnits="userSpaceOnUse">
                            <feImage x="-829.406" y="0" width="1025.281" height="1318.2800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTAyNS4yODEiIGhlaWdodD0iMTMxOC4yODAwMDAwMDAwMDAyIj48bGluZWFyR3JhZGllbnQgaWQ9ImdyYWQiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB5MT0iMTQ2LjUiIHgyPSIxMDI1LjI4IiB5Mj0iMTE3MS43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMWJkZDg4Ii8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMzJlYjlhIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #B8F6DB" d="M-540.968,20.684 C-540.968,20.684 -687.378,86.487 -694.760,174.843 C-702.142,263.200 -643.186,274.374 -667.132,338.769 C-691.079,403.164 -765.483,413.324 -785.981,496.763 C-807.750,585.376 -722.107,571.956 -727.171,690.819 C-732.235,809.683 -978.187,852.597 -688.556,1167.735 C-398.925,1482.874 -139.906,1235.432 -115.898,1040.448 C-91.891,845.463 42.695,803.563 95.851,754.793 C149.006,706.023 316.246,497.102 46.140,203.210 C-223.966,-90.683 -540.968,20.684 -540.968,20.684 Z" class="cls-2" />
                </svg> <svg style="bottom:0px" id="svg-bottom" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="446.28" height="1030.78" viewBox="0 0 446.28 1030.78">
                    <defs>
                        <filter id="gradient-overlay-3" filterUnits="userSpaceOnUse">
                            <feImage x="0" y="0" width="1318.16" height="1030.7800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTMxOC4xNiIgaGVpZ2h0PSIxMDMwLjc4MDAwMDAwMDAwMDIiPjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZCIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIxNDMuNjkiIHgyPSIxMTc0LjQ3IiB5Mj0iMTAzMC43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMDIyMjQzIi8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMDgzMjYwIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #ABB8C3;" d="M1299.583,301.566 C1299.583,301.566 1235.945,154.230 1147.697,145.545 C1059.449,136.859 1047.402,195.631 983.361,170.740 C919.320,145.850 910.260,71.319 827.122,49.594 C738.831,26.523 750.985,112.336 632.195,105.517 C513.405,98.698 474.127,-147.810 154.703,137.070 C-164.720,421.950 78.893,684.543 273.525,711.425 C468.157,738.308 508.066,873.470 556.051,927.329 C604.035,981.187 810.485,1151.462 1108.374,885.787 C1406.264,620.113 1299.583,301.566 1299.583,301.566 Z" class="cls-3" />
                </svg>
                <div class="container content-container">
                    <div class="row content-row">
                        <div id="primary" class="content-area col-12">
                            <main id="main" class="site-main">
                                <div class="service-featured-container">
                                    <form role="form" id="target" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout" id="validation">
                                            <ul class="woocommerce-error" role="alert">
                                                <img src="../images/error-message.png" alt="" class="error-icon">
                                                <li data-id="billing_first_name" style="margin-left: 1.5% !important;">
                                                    <span id="checkboxError" class="error"></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <style>
                                            .error {
                                                font-weight: 400;
                                                color: #f24d6a !important;
                                            }

                                            .woocommerce-error::before {
                                                display: none;

                                            }

                                            .error-icon {
                                                display: inline-block;
                                                position: absolute;
                                                top: 1em;
                                                left: 1.5em;
                                            }

                                            .error-icon::before {
                                                display: inline-block;
                                                position: absolute;
                                                top: 1em;
                                                left: 1.5em;
                                            }

                                            .sub-radio-buttons {
                                                display: none;
                                                margin-left: 40px;
                                            }
                                        </style>
                                        <div class="row">
                                            <div class="notification-booking col-12" style="display: none">
                                                <div class="box mb-40"></div>
                                            </div>


                                            <div class="col-xl-8 col-lg-8 col-md-12">
                                                <div class="choose-service-repair"> <input type="hidden" name="device" id="device" value="1526">
                                                    <div class="box mb-40 addition">
                                                        <div class="heading">
                                                            <h3>Select Your Repair</h3>
                                                        </div>
                                                        <div class="body active">
                                                            <!-- <ul class="list-options list-extras">
                                                                <?PHP
                                                                $ctable = "device_problem";
                                                                $ctable_cat_where = "modal_id='" . $ctable_order_d["modal_id"] . "' AND isDelete=0";
                                                                $ctable_r = $db->rp_getData($ctable, "*", $ctable_cat_where);
                                                                if (mysqli_num_rows($ctable_r) > 0) {
                                                                    if ($ctable_r) {
                                                                        while ($ctable_d = mysqli_fetch_array($ctable_r)) { ?>
                                                                            <li>
                                                                                <div class="select-item">
                                                                                    <input type="checkbox" name="options[]" data-name="<?php echo stripslashes($ctable_d['device_problem_name']); ?>" data-value="<?php echo stripslashes($ctable_d['amount']); ?>" value="<?php echo stripslashes($ctable_d['id']); ?>" id="<?php echo stripslashes($ctable_d['id']); ?>">
                                                                                    <label for="<?php echo stripslashes($ctable_d['id']); ?>">
                                                                                        <span id="round"></span><?php echo stripslashes($ctable_d['device_problem_name']); ?>
                                                                                    </label>
                                                                                    <span> <i class="fa fa-inr" aria-hidden="true"> </i>
                                                                                        <?php echo stripslashes($ctable_d['amount']); ?>
                                                                                        <sup></sup>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="meta-rp"></div>
                                                                            </li>
                                                                <?php
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "<h2>No Repair Service</h2>";
                                                                }
                                                                ?>
                                                            </ul> -->

                                                            <ul class="list-options list-extras">
                                                                <?PHP
                                                                $ctable = "device_problem";
                                                                $ctable_cat_where = "modal_id='" . $ctable_order_d["modal_id"] . "' AND isDelete=0";
                                                                $ctable_r = $db->rp_getData($ctable, "*", $ctable_cat_where);
                                                                if (mysqli_num_rows($ctable_r) > 0) {
                                                                    if ($ctable_r) {
                                                                        while ($ctable_d = mysqli_fetch_array($ctable_r)) { ?>
                                                                            <li>
                                                                                <div class="select-item">
                                                                                    <input type="checkbox" name="options[]" data-name="<?php echo stripslashes($ctable_d['device_problem_name']); ?>" data-value="<?php echo stripslashes($ctable_d['amount']); ?>" value="<?php echo stripslashes($ctable_d['id']); ?>" id="<?php echo stripslashes($ctable_d['id']); ?>" onchange="toggleProblemType(<?php echo stripslashes($ctable_d['id']); ?>)">
                                                                                    <label for="<?php echo stripslashes($ctable_d['id']); ?>">
                                                                                        <span id="round"></span><?php echo stripslashes($ctable_d['device_problem_name']); ?>
                                                                                    </label>
                                                                                    <span> <i class="fa fa-inr" aria-hidden="true"> </i>
                                                                                        <span id="amount<?php echo stripslashes($ctable_d['id']); ?>"><?php echo stripslashes($ctable_d['amount']); ?></span>
                                                                                        <sup></sup>
                                                                                    </span>
                                                                                </div>
                                                                                <div id="problemtype<?php echo stripslashes($ctable_d['id']); ?>" class="sub-radio-buttons">
                                                                                    <?php
                                                                                    $sub_device_problem_r = $db->rp_getData("sub_device_problem", "*", "device_problem_id='" . $ctable_d['id'] . "' AND isDelete=0");
                                                                                    while ($sub_device_problem_d = mysqli_fetch_assoc($sub_device_problem_r)) {
                                                                                        $device_problem_type_name = $db->rp_getValue('device_problem_type', "device_problem_type_name", "id='" . $sub_device_problem_d['device_problem_type_id'] . "'");
                                                                                    ?>
                                                                                        <label class="select-item-type">
                                                                                            <input type="radio" name="type<?php echo stripslashes($ctable_d['id']); ?>" value="<?php echo stripslashes($sub_device_problem_d['id']); ?>" id="<?php echo stripslashes($ctable_d['id']); ?>" data-amount="<?php echo stripslashes($sub_device_problem_d['amount']); ?>"> <?php echo stripslashes($device_problem_type_name); ?>
                                                                                        </label>
                                                                                        <!-- Add more radio buttons as needed -->
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <!-- <div class="meta-rp"></div> -->
                                                                            </li>
                                                                <?php
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "<h2>No Repair Service</h2>";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $_REQUEST['order_id'] ?>">
                                                    <input type="hidden" id="order_form" name="order_form" value="order_form">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12 sidebar-featured-page">
                                                <div class="box sidebar">
                                                    <div class="heading">
                                                        <h3>Order Summary</h3>
                                                    </div>
                                                    <div class="body">
                                                        <h4 class="service-title"><?php echo $ctable_category_d["category_name"] ?></h4>
                                                        <p class="clearfix device"> <span class="title"><?php echo $ctable_modal_d["modal_name"] ?></span>
                                                            <span class="price"> <img src="<?php echo MODAL_IMAGE_SITE_A . $ctable_modal_d['image_path']; ?>" alt="<?php echo $ctable_brand_d["brand_name"] ?>"> </span>
                                                        </p>
                                                        <h4 class="service-title extra-title">Extras</h4>
                                                        <span id="content-extra"></span>
                                                    </div>
                                                    <div class="footer">
                                                        <p class=""> <span class="title">Sub Total</span>
                                                            <span class="price" id='subtotal'><i class='fa fa-inr' aria-hidden='true'> </i> 00.00 </span>
                                                            <input type="hidden" id="subtotalInput" name="subtotalInput" value="0">
                                                        </p>
                                                        <p class=""> <span class="title">Tax</span>
                                                            <span class="price" id='tax'><i class='fa fa-inr' aria-hidden='true'> </i> 00.00 </span>
                                                            <input type="hidden" id="taxInput" name="taxInput" value="0">
                                                        </p>
                                                        <p class=""> <span class="title">Total</span>
                                                            <span class="price" id='total'><i class='fa fa-inr' aria-hidden='true'> </i> 00.00 </span>
                                                            <input type="hidden" id="totalInput" name="totalInput" value="0">
                                                        </p>
                                                        <button type="submit" class="btn btn-default" onclick="return addRefferal()">
                                                            <span>Order Update <i class="fa fa-angle-right"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="contact">
                                                    <h4> Secure Mail or Deliver Your Device to:</h4>
                                                    <p>702, SANTORINI SQUARE, Near by Abhishree Complex, Opp, Star bazaar,
                                                        Jodhpur Village, Ahmedabad, Gujarat 380015</p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </main><!-- #main -->
                        </div><!-- #primary -->
                    </div>
                </div>
            </div><!-- #content inner -->
        </div><!-- #content -->
        <?php include('footer.php'); ?>
        <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/toastr.min.js"></script>
    <script type="text/javascript">
        $("#validation").hide();

        function Backtotop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        };

        function addRefferal() {
            $("#validation").hide();
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            $("#checkboxError").html('');
            if (checkboxes.length === 0) {
                $("#validation").show();
                $("#checkboxError").html('Please select at least one problem.');
                Backtotop();
                event.preventDefault();
            } else {
                $("#target").submit();
            }
        }
    </script>
    <!-- <script>
        function calculate() {
            var arr = $.map($('input:checkbox:checked'), function(e, i) {
                return '<p class="clear-all extra"> <span class="title">' + e.dataset.name + "</span> " +
                    '<span class="price">' + parseFloat(e.dataset.value, 10) + "</span> " + "</p>"
            });
            $('#content-extra').html(arr);
        }
        jQuery(document).ready(function($) {
            var sum = 0;
            $('.select-item :checkbox').click(function() {
                sum = 0;
                $('.select-item :checkbox:checked').each(function(idx, elm) {
                    sum += parseFloat(elm.dataset.value, 10);
                });
                calculate();
                $('.select-item').delegate('input:checkbox', 'click', calculate);
                $subtotal = "<i class='fa fa-inr' aria-hidden='true'> </i> " + sum.toFixed(2);
                $tax = "<i class='fa fa-inr' aria-hidden='true'> </i> " + parseFloat(sum * 10 / 100)
                    .toFixed(2);
                $total = "<i class='fa fa-inr' aria-hidden='true'> </i> " + (sum + parseFloat(sum * 10 /
                    100)).toFixed(2);
                $('#subtotal').html($subtotal);
                document.getElementById("subtotalInput").value = sum.toFixed(2);
                $('#tax').html($tax);
                document.getElementById("taxInput").value = parseFloat(sum * 10 / 100).toFixed(2);
                $('#total').html($total);
                document.getElementById("totalInput").value = (sum + parseFloat(sum * 10 / 100)).toFixed(2);
            });
        });
    </script> -->
    <script>
        function toggleProblemType(mainCheckbox) {
            var problemtypeDiv = document.getElementById("problemtype" + mainCheckbox);
            if (document.getElementById(mainCheckbox).checked) {
                problemtypeDiv.style.display = "block";
            } else {
                problemtypeDiv.style.display = "none";
            }
        }
        jQuery(document).ready(function($) {
            var sum = 0;
            // Function to update totals when radio button is clicked
            function updateTotals() {
                sum = 0;
                var selectedItems = $('.select-item :checkbox:checked');
                selectedItems.each(function(idx, elm) {
                    sum += parseFloat(elm.dataset.value, 10);
                });
                var arr = $.map(selectedItems, function(e, i) {
                    return '<p class="clear-all extra"> <span class="title">' + e.dataset.name + "</span> " +
                        '<span class="price">' + parseFloat(e.dataset.value, 10) + "</span> " + "</p>";
                });
                $('#content-extra').html(arr);

                $subtotal = "<i class='fa fa-inr' aria-hidden='true'> </i> " + sum.toFixed(2);
                $tax = "<i class='fa fa-inr' aria-hidden='true'> </i> " + parseFloat(sum * 10 / 100).toFixed(2);
                $total = "<i class='fa fa-inr' aria-hidden='true'> </i> " + (sum + parseFloat(sum * 10 / 100)).toFixed(2);
                $('#subtotal').html($subtotal);
                document.getElementById("subtotalInput").value = sum.toFixed(2);
                $('#tax').html($tax);
                document.getElementById("taxInput").value = parseFloat(sum * 10 / 100).toFixed(2);
                $('#total').html($total);
                document.getElementById("totalInput").value = (sum + parseFloat(sum * 10 / 100)).toFixed(2);
            }
            $('.select-item-type :radio').each(function() {
                var radioName = $(this).attr('name');
                if ($('input[name=' + radioName + ']:checked').length === 0) {
                    $(this).prop('checked', true);
                }
            });
            // Event handler for radio button click
            $('.select-item-type :radio').click(function() {
                // Retrieve value and ID of the clicked radio button
                // var radioValue = $(':radio:checked').attr('data-value-redio');
                // var radioValue = $(this).val();
                var radioId = $(this).attr('id');
                var abcd = 'type' + radioId;
                var radioValue = $('input[name=' + abcd + ']:checked').data('amount');

                $('#amount' + radioId).text(radioValue);
                $('#' + radioId).attr('data-value', radioValue);
                var dataValue = $('#' + radioId).attr('data-value');
                // Call the function to update totals
                updateTotals();
            });
            // Event handler for checkbox click
            $('.select-item :checkbox').click(function() {
                // Call the function to update totals
                updateTotals();
            });
        });
    </script>
    <script defer src="../js/main-js.js"></script>
    <script>
        <?php if (isset($_SESSION['msg-error'])) : ?>
            toastr.error("<?php echo $db->flash('msg-error') ?>");
        <?php endif ?>
        <?php if (isset($_SESSION['msg'])) : ?>
            toastr.success("<?php echo $db->flash('msg') ?>");
        <?php endif ?>
    </script>
</body>

</html>