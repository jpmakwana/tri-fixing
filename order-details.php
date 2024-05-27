<?php
require_once("connect.php");
// Include your database connection code here

if (!isset($_SESSION['USER_ID'])) {
    $_SESSION['last_open_url'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $db->flash("msg-error", "Please Login");
    $db->rp_location('login.php');
    exit();
}

$ctable_orders = "orders";
$ctable_orders_where = "id = " . $_REQUEST['order_id'] . " AND isDelete=0";
$ctable_orders_r = $db->rp_getData($ctable_orders, "*", $ctable_orders_where);
$ctable_order_d = mysqli_fetch_assoc($ctable_orders_r);
if ($ctable_order_d['id'] !== $_REQUEST['order_id']) {
    $db->flash("msg-error", "Orders No Found !!");
    $db->rp_location('order-list.php');
    exit();
}

$ctable_user = "user";
$ctable_user_where = "id = " . $ctable_order_d['user_id'] . " AND isDelete=0";
$ctable_user_r = $db->rp_getData($ctable_user, "*", $ctable_user_where);
$ctable_user_d = mysqli_fetch_assoc($ctable_user_r);

$ctable_vendor = "vendor";
$ctable_vendor_where = "id = " . $ctable_order_d['vendor_id'] . " AND isDelete=0";
$ctable_vendor_r = $db->rp_getData($ctable_vendor, "*", $ctable_vendor_where);
$ctable_vendor_d = mysqli_fetch_assoc($ctable_vendor_r);

// $ctable_order_img = "order_problem_image";
// $ctable_order_img_where = "order_id = " . $_REQUEST['order_id'] . " AND isDelete=0";
// $ctable_order_img_r = $db->rp_getData($ctable_order_img, "*", $ctable_order_img_where);
// $ctable_order_d = mysqli_fetch_array($ctable_order_img_r);
// print_r(mysqli_fetch_array($ctable_order_img_r));


?>

<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title>Tri-fixing &#8211; Mobile Device and Electronics Repair </title>
    <link rel="stylesheet" href="css/main-style.css" media="all" />
    <link rel='stylesheet' id='woocommerce-smallscreen-css' href='css/woocommerce-smallscreen.min.css' type='text/css' media='only screen and (max-width: 768px)' />
    <style id="global-styles-inline-css" type="text/css">
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
            --wp--preset--duotone--dark-grayscale: url("#wp-duotone-dark-grayscale");
            --wp--preset--duotone--grayscale: url("#wp-duotone-grayscale");
            --wp--preset--duotone--purple-yellow: url("#wp-duotone-purple-yellow");
            --wp--preset--duotone--blue-red: url("#wp-duotone-blue-red");
            --wp--preset--duotone--midnight: url("#wp-duotone-midnight");
            --wp--preset--duotone--magenta-yellow: url("#wp-duotone-magenta-yellow");
            --wp--preset--duotone--purple-green: url("#wp-duotone-purple-green");
            --wp--preset--duotone--blue-orange: url("#wp-duotone-blue-orange");
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
    <style id="woocommerce-inline-inline-css" type="text/css">
        .woocommerce form .form-row .required {
            visibility: visible;
        }
    </style>
    <style id="tekhfixers-theme-inline-css" type="text/css">
        @media screen and(max-width:991px) {}

        .primary-menu>li>a {
            color: #b3bec8;
        }

        .primary-menu>li>a:hover {
            color: #32eb9a;
        }

        .primary-menu>li.current_page_item>a,
        .primary-menu>li.current-menu-item>a,
        .primary-menu>li.current_page_ancestor>a,
        .primary-menu>li.current-menu-ancestor>a {
            color: #32eb9a;
        }

        #site-header-wrap.header-layout .headroom--pinned:not(.headroom--top) .primary-menu>li>a {
            color: #b3bec8;
        }

        #site-header-wrap.header-layout .headroom--pinned:not(.headroom--top) .primary-menu>li>a:hover {
            color: #32eb9a;
        }

        #site-header-wrap.header-layout .headroom--pinned:not(.headroom--top) .primary-menu>li.current_page_item>a,
        .headroom--pinned:not(.headroom--top) .primary-menu>li.current-menu-item>a,
        .headroom--pinned:not(.headroom--top) .primary-menu>li.current_page_ancestor>a,
        .headroom--pinned:not(.headroom--top) .primary-menu>li.current-menu-ancestor>a {
            color: #32eb9a !important;
        }

        @media screen and(max-width:991px) {
            body #pagetitle {
                padding-top: 16px;
                padding-bottom: 46px;
            }
        }

        @media screen and(min-width:1280px) {
            .content-row {
                margin-left: -25px;
            }

            .content-row {
                margin-right: -25px;
            }

            .content-row #primary,
            .content-row #secondary {
                padding-left: 25px !important;
            }

            .content-row #primary,
            .content-row #secondary {
                padding-right: 25px !important;
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
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#022243", endColorstr="#083260", GradientType=0);
        }
    </style>
    <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>
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
            background: -ms-linear-gradient(0deg, #022243 0%, #083260 100%);
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
        .hh-grayBox {
            background-color: #F8F8F8;
            padding: 35px;
        }

        .pt45 {
            padding-top: 45px;
        }

        .order-tracking {
            text-align: center;
            width: 25%;
            position: relative;
            display: block;
        }

        .order-tracking .is-complete {
            display: block;
            position: relative;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            border: 0px solid #AFAFAF;
            background-color: #f7be16;
            margin: 0 auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
            z-index: 2;
        }

        .order-tracking .is-complete:after {
            display: block;
            position: absolute;
            content: '';
            height: 14px;
            width: 7px;
            top: -2px;
            bottom: 0;
            left: 5px;
            margin: auto 0;
            border: 0px solid #AFAFAF;
            border-width: 0px 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }

        .order-tracking.completed .is-complete {
            border-color: #27aa80;
            border-width: 0px;
            background-color: #27aa80;
        }

        .order-tracking.completed .is-complete:after {
            border-color: #fff;
            border-width: 0px 3px 3px 0;
            width: 7px;
            left: 11px;
            opacity: 1;
        }

        .order-tracking p {
            color: #A4A4A4;
            font-size: 16px;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 20px;
        }

        .order-tracking p span {
            font-size: 14px;
        }

        .order-tracking.completed p {
            color: #000;
        }

        .order-tracking::before {
            content: '';
            display: block;
            height: 3px;
            width: calc(100% - 40px);
            background-color: #f7be16;
            top: 13px;
            position: absolute;
            left: calc(-50% + 20px);
            z-index: 0;
        }

        .order-tracking:first-child:before {
            display: none;
        }

        .order-tracking.completed:before {
            background-color: #27aa80;
        }

        .order-tracking .is-reject {
            display: block;
            position: relative;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            border: 0px solid #AFAFAF;
            background-color: #f7be16;
            margin: 0 auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
            z-index: 2;
        }

        .order-tracking.completed .is-reject {
            border-color: #f24d6a;
            border-width: 0px;
            background-color: #f24d6a;
        }

        .mark1 {
            background-color: #fff;
            position: absolute;
            height: 15px;
            width: 4px;
            display: block;
            top: 0;
            -webkit-transition: all 300ms ease-in-out;
            -moz-transition: all 300ms ease-in-out;
            -ms-transition: all 300ms ease-in-out;
            -o-transition: all 300ms ease-in-out;
            transition: all 300ms ease-in-out;
        }

        .mark1.x {
            margin-top: 7px;
            right: 13px;
            transform: rotate(45deg);
            /* TODO: prefix */
        }

        .mark1.xx {
            margin-top: 7px;
            left: 13px;
            transform: rotate(-45deg);
        }
    </style>
    <style>
        :root {
            --star-primary-color: gold;
        }

        .container1 {
            display: grid;
            /* min-height: 100vh; */
            place-content: center;
        }

        .star-group {
            display: grid;
            font-size: clamp(1.5em, 3vw, 7em);
            grid-auto-flow: column;
        }

        /* reset native input styles */
        .star {
            -webkit-appearance: none;
            align-items: center;
            appearance: none;
            cursor: pointer;
            display: grid;
            font: inherit;
            height: 1.15em;
            justify-items: center;
            margin: 0;
            place-content: center;
            position: relative;
            width: 1.15em;
        }

        @media (prefers-reduced-motion: no-preference) {
            .star {
                transition: all 0.25s;
            }

            .star:before,
            .star:after {
                transition: all 0.25s;
            }
        }

        .star:before,
        .star:after {
            color: var(--star-primary-color);
            position: absolute;
        }

        .star:before {
            content: "☆";
        }

        .star:after {
            content: "✦";
            font-size: 25%;
            opacity: 0;
            right: 20%;
            top: 20%;
        }

        /* The checked radio button and each radio button preceding */
        .star:checked:before,
        .star:has(~ .star:checked):before {
            content: "★";
        }

        #two:checked:after,
        .star:has(~ #two:checked):after {
            opacity: 1;
            right: 14%;
            top: 10%;
        }

        #three:checked:before,
        .star:has(~ #three:checked):before {
            transform: var(--enlarge);
        }

        #three:checked:after,
        .star:has(~ #three:checked):after {
            opacity: 1;
            right: 8%;
            top: 2%;
            transform: var(--enlarge);
        }

        #four:checked:before,
        .star:has(~ #four:checked):before {
            text-shadow: 0.05em 0.033em 0px var(--star-secondary-color);
            transform: var(--enlarge);
        }

        #four:checked:after,
        .star:has(~ #four:checked):after {
            opacity: 1;
            right: 8%;
            top: 2%;
            transform: var(--enlarge);
        }

        #five:checked:before,
        .star:has(~ #five:checked):before {
            text-shadow: 0.05em 0.033em 0px var(--star-secondary-color);
            transform: var(--enlarge);
        }

        #five:checked:after,
        .star:has(~ #five:checked):after {
            opacity: 1;
            right: 8%;
            text-shadow: 0.14em 0.075em 0px var(--star-secondary-color);
            top: 2%;
            transform: var(--enlarge);
        }

        /* .star-group:has(> #five:checked) {
            #one {
                transform: rotate(-15deg);
            }

            #two {
                transform: translateY(-20%) rotate(-7.5deg);
            }

            #three {
                transform: translateY(-30%);
            }

            #four {
                transform: translateY(-20%) rotate(7.5deg);
            }

            #five {
                transform: rotate(15deg);
            }
        } */

        .star:focus {
            outline: none;
        }

        .star:focus-visible {
            border-radius: 8px;
            outline: 2px dashed var(--star-primary-color);
            outline-offset: 8px;
            transition: all 0s;
        }

        textarea {
            height: 115px;
            line-height: 30px;
        }
    </style>
    <script defer type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link rel="stylesheet" href="css/toastr.min.css">
    <link rel="stylesheet" href="js/sweetalert.min.js">
</head>

<body class="device-template-default single single-device postid-1550 theme-tekhfixers woocommerce-no-js visual-composer wpb-js-composer js-comp-ver-6.8.0 vc_responsive">
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
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
        <div class="menu-page-title has-page-title">
            <div class="color-overlay"></div>
            <?php include 'header.php'; ?>
            <div class="page-title-container"></div>
        </div>
        <div id="content" class="site-content">
            <div class="content-inner">
                <svg style="fill: #b8f6db; top: 0px; " id="svg-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="195.875" height="1318.28" viewBox="0 0 195.875 1318.28">
                    <defs>
                        <filter id="gradient-overlay-2" filterUnits="userSpaceOnUse">
                            <feImage x="-829.406" y="0" width="1025.281" height="1318.2800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTAyNS4yODEiIGhlaWdodD0iMTMxOC4yODAwMDAwMDAwMDAyIj48bGluZWFyR3JhZGllbnQgaWQ9ImdyYWQiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB5MT0iMTQ2LjUiIHgyPSIxMDI1LjI4IiB5Mj0iMTE3MS43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMWJkZDg4Ii8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMzJlYjlhIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #b8f6db;" d="M-540.968,20.684 C-540.968,20.684 -687.378,86.487 -694.760,174.843 C-702.142,263.200 -643.186,274.374 -667.132,338.769 C-691.079,403.164 -765.483,413.324 -785.981,496.763 C-807.750,585.376 -722.107,571.956 -727.171,690.819 C-732.235,809.683 -978.187,852.597 -688.556,1167.735 C-398.925,1482.874 -139.906,1235.432 -115.898,1040.448 C-91.891,845.463 42.695,803.563 95.851,754.793 C149.006,706.023 316.246,497.102 46.140,203.210 C-223.966,-90.683 -540.968,20.684 -540.968,20.684 Z" class="cls-2" />
                </svg>
                <svg style=" bottom: 0px;" id="svg-bottom" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="446.28" height="1030.78" viewBox="0 0 446.28 1030.78">
                    <defs>
                        <filter id="gradient-overlay-3" filterUnits="userSpaceOnUse">
                            <feImage x="0" y="0" width="1318.16" height="1030.7800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTMxOC4xNiIgaGVpZ2h0PSIxMDMwLjc4MDAwMDAwMDAwMDIiPjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZCIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIxNDMuNjkiIHgyPSIxMTc0LjQ3IiB5Mj0iMTAzMC43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMDIyMjQzIi8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMDgzMjYwIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #abb8c3;" d="M1299.583,301.566 C1299.583,301.566 1235.945,154.230 1147.697,145.545 C1059.449,136.859 1047.402,195.631 983.361,170.740 C919.320,145.850 910.260,71.319 827.122,49.594 C738.831,26.523 750.985,112.336 632.195,105.517 C513.405,98.698 474.127,-147.810 154.703,137.070 C-164.720,421.950 78.893,684.543 273.525,711.425 C468.157,738.308 508.066,873.470 556.051,927.329 C604.035,981.187 810.485,1151.462 1108.374,885.787 C1406.264,620.113 1299.583,301.566 1299.583,301.566 Z" class="cls-3" />
                </svg>
                <div class="container content-container">
                    <div class="row content-row">
                        <div id="primary" class="content-area col-12">
                            <main id="main" class="site-main">
                                <div class="service-featured-container">
                                    <div class="row">
                                        <div class="notification-booking col-12" style="display: none;">
                                            <div class="box mb-40"></div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-12">
                                            <div class="box mb-40 repair">
                                                <div class="heading">
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                            <h3>+ Your Address +</h3>
                                                            <div class="body">

                                                                <p class="clearfix device">
                                                                    <span class="title"><?php echo $db->rp_getValue('user_address', "address", "id='" . $ctable_order_d['user_address_id'] . "'"); ?></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if ($ctable_order_d['status'] == "2") {
                                                        ?>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                                <h3>+ &nbsp; (PDF) Download &nbsp; +</h3>
                                                                <div class="body">
                                                                    <p class="clearfix device">
                                                                        <a href="<?php echo SITEURL . "pdf/user_invoice/" . $ctable_order_d['order_pdf'] ?>" target="_blank" class="btn btn-default size-default  wpb_bounceInDown bounceInDown">
                                                                            Click Here <i class="fa fa-angle-right"></i>
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="heading">
                                                    <h3>
                                                        + Status :
                                                        <?php if ($ctable_order_d['status'] == "0") { ?>
                                                            <span style="color:#27aa80">Order Placed</span>
                                                        <?php } elseif ($ctable_order_d['status'] == "1") { ?>
                                                            <span style="color:#27aa80">Order Accept</span>
                                                        <?php } elseif ($ctable_order_d['status'] == "2") { ?>
                                                            <span style="color:#27aa80">Order Payment successful.</span>
                                                        <?php } elseif ($ctable_order_d['status'] == "3") { ?>
                                                            <span style="color:#27aa80">Order Reject</span>
                                                        <?php } else {
                                                            echo "<h2 class='box sidebar mb-40 text-center'>Orders no found !</h2>";
                                                        } ?>
                                                        +
                                                    </h3>
                                                    <div class="row">
                                                        <div class="col-12 hh-grayBox pt45 pb20">
                                                            <div class="row justify-content-between">
                                                                <?php

                                                                if ($ctable_order_d['status'] == "0") {
                                                                ?>
                                                                    <div class="order-tracking completed">
                                                                        <span class="is-complete"></span>
                                                                        <p>Order Placed<br></p>
                                                                    </div>
                                                                    <div class="order-tracking ">
                                                                        <span class="is-complete"></span>
                                                                        <p>Accept<br></p>
                                                                    </div>
                                                                    <div class="order-tracking">
                                                                        <span class="is-complete"></span>
                                                                        <p>Payment<br></p>
                                                                    </div>
                                                                    <div class="order-tracking">
                                                                        <span class="is-complete"></span>
                                                                        <p>Delivered<br></p>
                                                                    </div>
                                                                <?php
                                                                } elseif ($ctable_order_d['status'] == "1") {
                                                                ?>
                                                                    <div class="order-tracking completed">
                                                                        <span class="is-complete"></span>
                                                                        <p>Order Placed<br></p>
                                                                    </div>
                                                                    <div class="order-tracking completed">
                                                                        <span class="is-complete"></span>
                                                                        <p>Accept<br></p>
                                                                    </div>
                                                                    <div class="order-tracking">
                                                                        <span class="is-complete"></span>
                                                                        <p>Payment<br></p>
                                                                    </div>
                                                                    <div class="order-tracking">
                                                                        <span class="is-complete"></span>
                                                                        <p>Delivered<br></p>
                                                                    </div>
                                                                <?php } elseif ($ctable_order_d['status'] == "2") { ?>
                                                                    <div class="order-tracking completed">
                                                                        <span class="is-complete"></span>
                                                                        <p>Order Placed<br></p>
                                                                    </div>
                                                                    <div class="order-tracking completed">
                                                                        <span class="is-complete"></span>
                                                                        <p>Accept<br></p>
                                                                    </div>
                                                                    <div class="order-tracking completed">
                                                                        <span class="is-complete"></span>
                                                                        <p>Payment<br></p>
                                                                    </div>
                                                                    <div class="order-tracking">
                                                                        <span class="is-complete"></span>
                                                                        <p>Delivered<br></p>
                                                                    </div>
                                                                <?php } elseif ($ctable_order_d['status'] == "3") { ?>
                                                                    <div class="order-tracking order-tracking1 completed">
                                                                        <span class="is-complete"></span>
                                                                        <p>Order Placed<br></p>
                                                                    </div>

                                                                    <div class="order-tracking order-tracking1 completed">

                                                                        <span class="is-reject">
                                                                            <i class="mark1 x"></i>
                                                                            <i class="mark1 xx"></i>
                                                                        </span>
                                                                        <p>Reject<br></p>
                                                                    </div>
                                                                <?php } else {
                                                                    echo "<h2 class='box sidebar mb-40 text-center'>Orders no found !</h2>";
                                                                    // $db->flash("msg-error", "Please Create Orders !!");
                                                                    // $db->rp_location('index.php');
                                                                    // $db->rp_location(SITEURL);
                                                                } ?>

                                                                <style>
                                                                    .order-tracking1 {
                                                                        width: 50%;
                                                                    }
                                                                </style>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box mb-40 repair">
                                                <div class="heading">
                                                    <h3>+ Pick your preferred store +</h3>
                                                </div>
                                                <div class="body active">
                                                    <ul class="list-options list-repair location">
                                                        <li>
                                                            <div class="select-item">
                                                                <label for="store-1633"><img src="images/arrow-right.png" alt="" style="margin-right: 25px;"> <?php echo stripslashes($ctable_vendor_d['shop_name']); ?></label>
                                                            </div>
                                                            <div class="meta-rp">
                                                                <div class="row">
                                                                    <div class="col-sm-6"><span class="title">Address</span><?php echo stripslashes($ctable_vendor_d['address']); ?></div>
                                                                    <div class="col-sm-6">
                                                                        <span class="title">Opening Times</span>
                                                                        <span class="openingtimes">
                                                                            Mon to Fri: <?php echo stripslashes($ctable_vendor_d['mon_fri_opentime']); ?>-<?php echo stripslashes($ctable_vendor_d['mon_fri_closetime']); ?><br />
                                                                            Sat: <?php echo stripslashes($ctable_vendor_d['satur_opentime']); ?>-<?php echo stripslashes($ctable_vendor_d['satur_closetime']); ?><br />
                                                                            Sun: <?php echo stripslashes($ctable_vendor_d['sun_opentime']); ?>-<?php echo stripslashes($ctable_vendor_d['sun_closetime']); ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-4 col-lg-4 col-md-12 sidebar-featured-page">
                                            <div class="box sidebar">
                                                <div class="heading">
                                                    <h3>Order Id : <?php echo $_REQUEST['order_id'] ?></h3>
                                                </div>
                                                <style>
                                                    .dynamic-image {
                                                        padding: 5px 5px 15px 5px;
                                                        margin-top: 0 !important;
                                                        width: 33.33% !important;
                                                        max-width: 33.33% !important;
                                                        max-height: 100% !important;
                                                    }
                                                </style>
                                                <div>
                                                    <h4 class="service-title">Device Problem Images</h4>
                                                    <div style="display: inline-flex;">
                                                        <?php
                                                        $ctable_r = $db->rp_getData("order_problem_image", "*", "order_id=" . $_REQUEST['order_id'] . " AND isDelete=0 AND isactive=1");
                                                        if (mysqli_num_rows($ctable_r) > 0) {
                                                            while ($ctable_d = mysqli_fetch_array($ctable_r)) {
                                                        ?>
                                                                <img src="<?php echo PROBLEM . $ctable_d['image_path'] ?>" alt="test" class="dynamic-image">
                                                            <?php
                                                            } ?>
                                                        <?php } else {
                                                            echo "<h2>No Images Found.</h2>";
                                                        } ?>
                                                    </div>
                                                </div>
                                                <div class="body">
                                                    <h4 class="service-title"><?php echo $db->rp_getValue('category', "category_name", "id='" . $ctable_order_d['category_id'] . "'"); ?></h4>
                                                    <p class="clearfix device">
                                                        <span class="title"><?php echo $db->rp_getValue('modal', "modal_name", "id='" . $ctable_order_d['modal_id'] . "'"); ?></span>
                                                        <span class="price">
                                                            <img src="<?php echo MODAL . $db->rp_getValue('modal', "image_path", "id='" . $ctable_order_d['modal_id'] . "'"); ?>" alt="device images">
                                                        </span>
                                                    </p>
                                                    <?php
                                                    $ctable_r = $db->rp_getData("user_device_problem", "*", "order_id=" . $_REQUEST['order_id'] . " AND isDelete=0 AND isactive=1");
                                                    if (mysqli_num_rows($ctable_r) > 0) {

                                                    ?>
                                                        <h4>Device Problem</h4>
                                                        <?php
                                                        if ($ctable_r) {
                                                            while ($ctable_d = mysqli_fetch_array($ctable_r)) {
                                                                $ctable_sub_r = $db->rp_getData("sub_device_problem", "*", "id=" . $ctable_d['sub_device_problem_id'] . " AND isDelete=0 AND isactive=1");
                                                                $ctable_sub_d = mysqli_fetch_assoc($ctable_sub_r);
                                                        ?>
                                                                <p class="clearfix repairs">
                                                                    <?php
                                                                    if ($ctable_d['sub_device_problem_id'] > 0) {
                                                                    ?>
                                                                        <span class="title"><?php echo $db->rp_getValue('device_problem', "device_problem_name", "id='" . $ctable_d['device_probem_id'] . "'"); ?> (<?php echo $db->rp_getValue('device_problem_type', "device_problem_type_name", "id='" . $ctable_sub_d['device_problem_type_id'] . "'"); ?>)
                                                                        </span>
                                                                        <span class="price"><i class='fa fa-inr' aria-hidden='true'> </i> <?php echo number_format((float)$db->rp_getValue('sub_device_problem', "amount", "id='" . $ctable_d['sub_device_problem_id'] . "'"), 2, '.', ''); ?>
                                                                        </span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <span class="title"><?php echo $db->rp_getValue('device_problem', "device_problem_name", "id='" . $ctable_d['device_probem_id'] . "'"); ?>
                                                                        </span>
                                                                        <span class="price"><i class='fa fa-inr' aria-hidden='true'> </i> <?php echo number_format((float)$db->rp_getValue('device_problem', "amount", "id='" . $ctable_d['device_probem_id'] . "'"), 2, '.', ''); ?>
                                                                        </span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </p>
                                                    <?php
                                                            }
                                                        }
                                                    } else {
                                                        echo "<h2>No Images Found.</h2>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="footer">
                                                    <p class="clearfix sub-total">
                                                        <span class="title">Sub Total</span>
                                                        <span class="price"><i class='fa fa-inr' aria-hidden='true'> </i> <?php echo number_format((float)$ctable_order_d['sub_total'], 2, '.', ''); ?></span>
                                                    </p>
                                                    <p class=""> <span class="title">Discount</span>
                                                        <span class="price" id='discount'><i class='fa fa-inr' aria-hidden='true'> </i> <?php echo number_format((float)$ctable_order_d['offer_amount'], 2, '.', ''); ?></span>
                                                    </p>
                                                    <p class="clearfix tax">
                                                        <span class="title">Tax</span>
                                                        <span class="price"><i class='fa fa-inr' aria-hidden='true'> </i> <?php echo number_format((float)$ctable_order_d['tax_amount'], 2, '.', ''); ?></span>
                                                    </p>
                                                    <p class="clearfix total">
                                                        <span class="title">Total</span>
                                                        <span class="price" id='total'><i class='fa fa-inr' aria-hidden='true'> </i> <?php echo number_format((float)$ctable_order_d['grand_total'], 2, '.', ''); ?> </span>
                                                    </p>
                                                    <?php
                                                    if ($ctable_order_d['status'] == "1") {
                                                    ?>
                                                        <form>
                                                            <input type="hidden" id="grand_total" name="grand_total" value="<?php echo $ctable_order_d['grand_total'] ?>">
                                                            <input type="hidden" id="user_name" name="user_name" value="<?php echo $ctable_user_d['user_name'] ?>">
                                                            <input type="hidden" id="order_id" name="order_id" value="<?php echo $_REQUEST['order_id'] ?>">
                                                            <input type="hidden" id="logo" name="logo" value="<?php echo SITEURL . USER_IMAGE_F . $ctable_user_d['image_path'] ?>">
                                                            <button type="button" id="payBtn" class="btn btn-default size-default ">
                                                                <span>Secure Payment <i class="fa fa-angle-right"></i></span>
                                                            </button>
                                                        </form>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <input type="hidden" id="payBtn">
                                                <?php
                                                if ($ctable_order_d['status'] == "1") {
                                                ?>
                                                    <div class="mt-3">
                                                        <div class="coupon" id="coupon_form">
                                                            <div class="hide mb-2">
                                                                <label for="coupon_code ">Coupon:</label>
                                                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code" />
                                                                <input type="hidden" id="offer_amount" name="offer_amount" value="<?php echo $ctable_order_d['offer_amount'] ?>">
                                                                <p>If you have a coupon code, please apply it below.</p>
                                                            </div>
                                                            <div class="text-center hide">
                                                                <button type="button" class="btn btn-primary size-default has-icon-border" id="apply_coupon">Apply Coupon</button>
                                                            </div>
                                                            <div class="text-center" id="cancel">
                                                                <button type="button" class="btn btn-default size-default " id="cancel_coupon" style="background: #f6acac;">Cancel Coupon</button>
                                                            </div>
                                                            <div class="mt-3">
                                                                <a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">CHECK COUPON CODE</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                } ?>
                                            </div>
                                            <div class="contact">
                                                <h4>Secure Mail or Deliver Your Device to:</h4>
                                                <p>702, SANTORINI SQUARE, Near by Abhishree Complex, Opp, Star bazaar,
                                                    Jodhpur Village, Ahmedabad, Gujarat 380015</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                    </div>
                </div>
            </div>
            <!-- #content inner -->
        </div>
        <!-- #content -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Offers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <?php
                            $order_d = mysqli_query($conn, "select * from orders where user_id = '" . $_SESSION["USER_ID"] . "' and isDelete=0 and isActive=1");
                            $order_row = mysqli_num_rows($order_d);
                            if ($order_row > 1) {
                                $offers = [];
                                $where = " where isDelete=0 AND isActive=1 AND is_first_order=0";
                                $offers_d = mysqli_query($conn, "select * from offers $where");
                                if (mysqli_num_rows($offers_d) > 0) {
                                    while ($offers_r = mysqli_fetch_assoc($offers_d)) {
                            ?>
                                        <div>
                                            <h5 class="mb-3">Code : <span><?php echo $offers_r['code'] ?></span></h5>
                                            <p><?php echo $offers_r['offers_name'] ?></p>
                                            <hr>
                                        </div>
                                    <?PHP
                                    }
                                } else {
                                    $ack = array("ack" => 0, "ack_msg" => 'No offer(s) found');
                                }
                            } else {
                                $offers = [];
                                $where = " where isDelete=0 AND isActive=1";
                                $offers_d = mysqli_query($conn, "select * from offers $where");
                                if (mysqli_num_rows($offers_d) > 0) {
                                    while ($offers_r = mysqli_fetch_assoc($offers_d)) {
                                    ?>
                                        <div>
                                            <h5 class="mb-3">Code : <span><?php echo $offers_r['code'] ?></span></h5>
                                            <p><?php echo $offers_r['offers_name'] ?></p>
                                            <hr>
                                        </div>
                            <?PHP
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .modal-backdrop {
                position: relative;
            }

            .modal.show .modal-dialog {
                display: grid;
                -ms-flex-align: center;
                align-items: center;
                min-height: calc(100% - 1rem);
            }
        </style>
        <?php include('footer.php') ?>
        <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
    </div>
    <!-- #page -->
    <script src="js/jquery.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/sweetalert.js"></script>
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
    <script>
        $(document).ready(function() {
            var offer_amount = document.getElementById("offer_amount").value;
            if (offer_amount !== '0.00') {
                $(".hide").hide();
            } else {
                $("#cancel").hide();
            }
            $("#apply_coupon").click(function() {
                var couponCode = $("#coupon_code").val();
                var order_id = document.getElementById("order_id").value;
                $.ajax({
                    type: "POST",
                    url: "apply_coupon.php",
                    data: {
                        coupon_code: couponCode,
                        order_id: order_id
                    },
                    success: function(response) {
                        const obj = JSON.parse(response);
                        if (obj.status === 3) {
                            toastr.error(obj.error);
                        }
                        $('#discount').html("<i class='fa fa-inr' aria-hidden='true'> </i> " + obj.discount.toFixed(2));
                        $('#total').html("<i class='fa fa-inr' aria-hidden='true'> </i> " + obj.grand_total.toFixed(2));
                        var grand_totalInput = document.getElementById("grand_total");
                        var data = obj.grand_total.toFixed(2);
                        grand_totalInput.value = data;
                        if (obj.status === 1) {
                            $(".hide").hide();
                            $("#cancel").show();
                            toastr.success(obj.success);
                            // location.reload();
                        }
                    }
                });
            });
            $("#cancel_coupon").click(function() {
                var subtotalInput = $("#subtotalInput").val();
                var order_id = document.getElementById("order_id").value;
                $.ajax({
                    type: "POST",
                    url: "apply_coupon.php",
                    data: {
                        subtotalInput: subtotalInput,
                        order_id: order_id,
                        action: "cancel"
                    },
                    success: function(response) {
                        $(".hide").show();
                        $("#cancel").hide();
                        const obj = JSON.parse(response);
                        $('#discount').html("<i class='fa fa-inr' aria-hidden='true'> </i> " + obj.discount.toFixed(2));
                        $('#total').html("<i class='fa fa-inr' aria-hidden='true'> </i> " + obj.grand_total.toFixed(2));
                        var grand_totalInput = document.getElementById("grand_total");
                        var data = obj.grand_total.toFixed(2);
                        grand_totalInput.value = data;
                        if (obj.status === 2) {
                            toastr.error(obj.error);
                        }
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById("payBtn").addEventListener("click", function() {
            var grand_total = document.getElementById("grand_total").value;
            var user_name = document.getElementById("user_name").value;
            var logo = document.getElementById("logo").value;
            var order_id = document.getElementById("order_id").value;
            var options = {
                key: "rzp_test_01KIdpD0qIbYFn",
                amount: grand_total * 100, // Amount is in paise, so convert to paisa
                currency: "INR",
                name: user_name,
                description: "Payment for a product or service",
                image: logo,
                handler: function(response) {
                    var razorpay_payment_id = response.razorpay_payment_id;
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "payment_insert_data.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var result = JSON.parse(xhr.responseText);
                            if (result.status === "success") {
                                Swal.fire({
                                    title: "Thank you",
                                    text: "Payment successful! Payment ID: " + response.razorpay_payment_id,
                                    icon: "success",
                                    showConfirmButton: true,
                                    allowOutsideClick: false,
                                    showCancelButton: false,
                                    preConfirm: () => {
                                        return Swal.fire({
                                            title: "Rate your experience",
                                            html: `<div class="container container1 mb-4">
                                    <div class="star-group">
                                        <input type="radio" class="star" id="1" name="star_rating" checked>
                                        <input type="radio" class="star" id="2" name="star_rating">
                                        <input type="radio" class="star" id="3" name="star_rating">
                                        <input type="radio" class="star" id="4" name="star_rating">
                                        <input type="radio" class="star" id="5" name="star_rating">
                                    </div>
                                </div>
                            <textarea id="review" placeholder="Write your review here..."></textarea>
                                                `,
                                            showCancelButton: false,
                                            confirmButtonText: "Submit",
                                            cancelButtonText: "Cancel",
                                            allowOutsideClick: false,
                                            preConfirm: () => {
                                                const rating = document.querySelector('input[name="star_rating"]:checked').id;
                                                const review = document.getElementById("review").value;
                                                var order_id = document.getElementById("order_id").value;
                                                return fetch('ajax_user_review.php', {
                                                        method: 'POST',
                                                        body: JSON.stringify({
                                                            rating,
                                                            review,
                                                            order_id
                                                        }),
                                                        headers: {
                                                            'Content-Type': 'application/json'
                                                        }
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.success) {
                                                            Swal.fire({
                                                                title: 'Thank you!',
                                                                text: 'Review submitted successfully',
                                                                icon: 'success',
                                                                showCancelButton: true,
                                                                showCancelButton: false,
                                                                confirmButtonText: 'OK',
                                                                allowOutsideClick: false,

                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    location.reload();
                                                                }
                                                            });
                                                        } else {
                                                            Swal.fire("Error", "Failed to submit review", "error");
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error("Error:", error);
                                                        Swal.fire("Error", "An error occurred while submitting the review", "error");
                                                    });
                                            },
                                        });
                                    },
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // setTimeout(function() {
                                        //     location.reload();
                                        // }, 2000);
                                    }
                                });
                            } else {
                                toastr.success("Payment successful, but data insertion failed.");
                            }
                        }
                    };
                    var data = "grand_total=" + grand_total + "&user_name=" + user_name + "&razorpay_payment_id=" + razorpay_payment_id + "&order_id=" + order_id;
                    // Add more data fields as needed
                    xhr.send(data);
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        });
    </script>
    <script defer src="js/main-js.js">
    </script>
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