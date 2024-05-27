<?php
include("connect.php");
// Include your database connection code here
?>
<!doctype html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>About Us &#8211; Tri-fixing &#8211; Mobile Device and Electronics Repair </title>
    <link rel="stylesheet" href="css/main-style.css" media="all" />
    <link rel='stylesheet' id='woocommerce-smallscreen-css' href='css/woocommerce-smallscreen.min.css' type='text/css' media='only screen and (max-width: 768px)' />
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
    <script defer type="text/javascript" src="js/jquery.min.js"></script>
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
    <style id="cms-page-dynamic-css" data-type="redux-output-css">
        #content {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        footer.site-footer {
            background: linear-gradient(90deg, #022243 0%, #083260 100%);
            background: -moz-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -webkit-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -o-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -ms-linear-gradient(0deg, #022243 0%, #083260 100%)
        }
    </style>
    <style type="text/css" data-type="vc_shortcodes-custom-css">
        .vc_custom_1548410731346 {
            border-bottom-width: 1px !important;
            padding-top: 25px !important;
            padding-bottom: 17px !important;
            background-color: #f6f6f6 !important;
            border-bottom-color: #e3e6ea !important;
            border-bottom-style: solid !important;
        }

        .vc_custom_1548411297501 {
            margin-top: 70px !important;
            margin-bottom: 70px !important;
            padding-top: 85px !important;
            padding-bottom: 97px !important;
        }

        .vc_custom_1548411424106 {
            margin-top: 66px !important;
            margin-bottom: 66px !important;
        }

        .vc_custom_1548176129188 {
            margin-bottom: 10px !important;
        }

        .vc_custom_1548412273834 {
            padding-top: 74px !important;
            padding-bottom: 69px !important;
        }

        .vc_custom_1548413243634 {
            margin-top: 6px !important;
            margin-bottom: 100px !important;
        }

        .vc_custom_1548413422387 {
            margin-bottom: 107px !important;
            padding-top: 6px !important;
        }

        .vc_custom_1542788902174 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1542788918496 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1542788928599 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1548240256561 {
            padding-top: 85px !important;
        }

        .vc_custom_1548410880587 {
            padding-top: 1px !important;
        }

        .vc_custom_1547524006290 {
            margin-top: 30px !important;
        }

        .vc_custom_1547524014771 {
            margin-top: -5px !important;
        }

        .vc_custom_1548411031388 {
            padding-top: 20px !important;
        }

        .vc_custom_1548668925244 {
            margin-top: -4px !important;
        }

        .vc_custom_1548295976419 {
            border-bottom-width: 30px !important;
        }

        .vc_custom_1548411097022 {
            margin-top: 32px !important;
        }

        .vc_custom_1547525343455 {
            margin-top: -5px !important;
        }

        .vc_custom_1547533039640 {
            margin-top: 50px !important;
        }

        .vc_custom_1547538666554 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1547538678230 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1547538684623 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1548411966083 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1547537702762 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1548412068344 {
            padding-top: 3px !important;
        }

        .vc_custom_1547537698645 {
            margin-bottom: 30px !important;
        }

        .vc_custom_1548412075083 {
            padding-top: 3px !important;
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-6 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-6 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-6 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-7 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-7 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-7 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-8 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-8 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-8 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-9 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-9 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-9 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-10 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-10 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-10 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-11 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-11 .cms-heading-tag {
                font-size: 20px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-11 .cms-heading-tag {
                font-size: 20px !important;
            }
        }
    </style>
    <noscript>
        <style>
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }
        </style>
    </noscript>
</head>

<body class="page-template-default page page-id-690 theme-tekhfixers woocommerce-no-js visual-composer wpb-js-composer js-comp-ver-6.8.0 vc_responsive">
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
            <?php include 'header.php'; ?>
            <div class="page-title-container">
                <div id="pagetitle" class="page-title page-title-layout1 has-subtitle">
                    <div class="container">
                        <div class="page-title-inner">
                            <div class="page-title-content clearfix"> <span class="back-link">What we’re about</span>
                                <h1 class="page-title ft-heading-b">About Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="site-content">
            <div class="content-inner">
                <div class="container content-container">
                    <div class="row content-row">
                        <div id="primary" class="content-area content-full-width col-12">
                            <main id="main" class="site-main">
                                <article id="post-690" class="post-690 page type-page status-publish hentry">
                                    <div class="entry-content clearfix">
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1548410731346 vc_row-has-fill gray-scale">
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner vc_custom_1542788902174">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_center">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="173" height="32" src="images/all/envato.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="envato" /></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner vc_custom_1542788918496">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_center">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="186" height="34" src="images/all/codecanyon-logo.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="codecanyon-logo" /></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner vc_custom_1542788928599">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_center">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="193" height="49" src="images/all/photodune.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="photodune" /></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_center">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="202" height="52" src="images/all/graphicriver.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="graphicriver" /></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row-full-width vc_clearfix"></div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner vc_custom_1548240256561">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading" class="cms-heading layout1  align-left align-left-md align-left-sm align-left-xs ">
                                                            <p class="subtitle">Professional Device Repair Technicians</p>
                                                            <h3 class="title">The Very Best in<br /> Electrical Device Repairs</h3>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1547524006290 color-87">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                            <div class="wpb_wrapper">
                                                                                <p>We know your device is important to you, so for this reason we aim to get your device back to you within 24 hours of us receiving your device.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1547524014771 color-87">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                            <div class="wpb_wrapper">
                                                                                <p>When you return your device to us, a trained technician will diagnose the issue(s) it has and will immediately begin repairing/replacing what needs to be. Once it has been repaired we will return the device back to you in a fully insured package.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="absolute-image-left wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner vc_custom_1548410880587">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_center">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="580" height="542" src="images/all/iPhoneX.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="iPhoneX" srcset="images/all/iPhoneX.png 580w, images/all/iPhoneX-450x421.png 450w" sizes="(max-width: 580px) 100vw, 580px" /></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-space-64b7e6fd95b2d">
                                                            <style type="text/css">
                                                                @media screen and (min-width: 992px) {
                                                                    #fr-space-64b7e6fd95b2d .fr-space {
                                                                        height: 129px;
                                                                    }
                                                                }

                                                                @media (min-width: 768px) and (max-width: 991px) {
                                                                    #fr-space-64b7e6fd95b2d .fr-space {
                                                                        height: 150px;
                                                                    }
                                                                }

                                                                @media (min-width: 576px) and (max-width: 767px) {
                                                                    #fr-space-64b7e6fd95b2d .fr-space {
                                                                        height: 50px;
                                                                    }
                                                                }
                                                            </style>
                                                            <div class="fr-space"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid off-overflow">
                                            <div class="absolute-image-right wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner vc_custom_1548411031388">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_center  vc_custom_1548295976419">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="780" height="542" src="images/all/google-pixel2-xl-v02.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="google-pixel2-xl v02" srcset="images/all/google-pixel2-xl-v02.png 780w, images/all/google-pixel2-xl-v02-600x417.png 600w, images/all/google-pixel2-xl-v02-768x534.png 768w" sizes="(max-width: 780px) 100vw, 780px" /></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner vc_custom_1548668925244">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-2" class="cms-heading layout1  align-right align-right-md align-right-sm align-right-xs ">
                                                            <p class="subtitle">Quick &amp; Easy Repairs</p>
                                                            <h3 class="title">Most Repairs Returned<br /> Within 24 Hours</h3>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1548411097022 color-87 text-align-right">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                            <div class="wpb_wrapper">
                                                                                <p>We know your device is important to you, so for this reason we aim to get your device back to you within 24 hours of us receiving your device.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1547525343455 color-87 text-align-right">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                            <div class="wpb_wrapper">
                                                                                <p>When you return your device to us, a trained technician will diagnose the issue(s) it has and will immediately begin repairing/replacing what needs to be. Once it has been repaired we will return the device back to you in a fully insured package.</p>
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
                                        <div class="vc_row-full-width vc_clearfix"></div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-space-64b7e6fd97d64">
                                                            <style type="text/css">
                                                                @media screen and (min-width: 992px) {
                                                                    #fr-space-64b7e6fd97d64 .fr-space {
                                                                        height: 130px;
                                                                    }
                                                                }

                                                                @media (min-width: 768px) and (max-width: 991px) {
                                                                    #fr-space-64b7e6fd97d64 .fr-space {
                                                                        height: 100px;
                                                                    }
                                                                }

                                                                @media (min-width: 576px) and (max-width: 767px) {
                                                                    #fr-space-64b7e6fd97d64 .fr-space {
                                                                        height: 50px;
                                                                    }
                                                                }
                                                            </style>
                                                            <div class="fr-space"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1548411297501 background-linear-primary">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-3" class="cms-heading layout1  align-center align-center-md align-center-sm align-center-xs ">
                                                            <p class="subtitle">How it Works</p>
                                                            <h3 class="title" style="color:#ffffff">Our Quick &amp; Easy 3 Stages Process</h3>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1547533039640">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-step" class="fr-steps ">
                                                                            <div class="fr-step-item  wpb_animate_when_almost_visible wpb_fadeIn fadeIn">
                                                                                <div class="fr-step-content">
                                                                                    <h3 class="fr-title"><img width="55" height="55" src="images/all/Vector-Smart-Object.png" class="attachment-full" alt="" loading="lazy" title="Vector Smart Object" />Send Us Your Device</h3>
                                                                                    <p class="fr-content">Once you have selected a <a href='services.php' target='_blank'>service</a> you require and have completed checkout. Securely package your device(s) in an insured box and send to the address shown in tyour invoice.</p>
                                                                                </div>
                                                                            </div> <i class="fa fa-angle-right"></i>
                                                                            <div class="fr-step-item  wpb_animate_when_almost_visible wpb_fadeIn fadeIn">
                                                                                <div class="fr-step-content">
                                                                                    <h3 class="fr-title"><img width="54" height="54" src="images/all/Vector-Smart-Object-1.png" class="attachment-full" alt="" loading="lazy" title="Vector Smart Object 1" />We’ll Get to Work</h3>
                                                                                    <p class="fr-content">Then, once we receive your package a trained technician will begin diagnosing the issues. Once the repair has been completed your package will be mailed back to you.</p>
                                                                                </div>
                                                                            </div> <i class="fa fa-angle-right"></i>
                                                                            <div class="fr-step-item  wpb_animate_when_almost_visible wpb_fadeIn fadeIn">
                                                                                <div class="fr-step-content">
                                                                                    <h3 class="fr-title"><img width="53" height="53" src="images/all/Vector-Smart-Object-2.png" class="attachment-full" alt="" loading="lazy" title="Vector Smart Object 2" />Return Back to You</h3>
                                                                                    <p class="fr-content">When all the necessery repairs/replacements have been made, we then package your device(s) in an insured package and aim to get it with you the very next day!</p>
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
                                        <div class="vc_row-full-width vc_clearfix"></div>
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1548411424106">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-4" class="cms-heading layout1  align-center align-center-md align-center-sm align-center-xs ">
                                                            <p class="subtitle">Our Amazing Team</p>
                                                            <h3 class="title">Our Professional Technicians</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid wpb_animate_when_almost_visible wpb_fadeIn fadeIn vc_custom_1548176129188 vc_row-o-content-middle vc_row-flex">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-3">
                                                <div class="vc_column-inner vc_custom_1547538666554">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-step-2" class="fr-team ">
                                                            <div class="fr-team-item ">
                                                                <div class="avatar">
                                                                    <div class="over-image"> <img width="170" height="170" src="images/all/shutterstock_259548557.png" class="attachment-full" alt="" loading="lazy" title="shutterstock_259548557" /></div>
                                                                </div>
                                                                <h3 class="fr-title">Jeffery Williams</h3>
                                                                <p class="fr-content">CEO</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-3">
                                                <div class="vc_column-inner vc_custom_1547538678230">
                                                    <div class="wpb_wrapper">
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1547537702762">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-step-3" class="fr-team ">
                                                                            <div class="fr-team-item ">
                                                                                <div class="avatar">
                                                                                    <div class="over-image"> <img width="170" height="170" src="images/all/shutterstock_268450499.png" class="attachment-full" alt="" loading="lazy" title="shutterstock_268450499" /></div>
                                                                                </div>
                                                                                <h3 class="fr-title">Paul Roberts</h3>
                                                                                <p class="fr-content">Head of Repairs</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner vc_custom_1548412068344">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-step-4" class="fr-team ">
                                                                            <div class="fr-team-item ">
                                                                                <div class="avatar">
                                                                                    <div class="over-image"> <img width="170" height="170" src="images/all/shutterstock_182229962.png" class="attachment-full" alt="" loading="lazy" title="shutterstock_182229962" /></div>
                                                                                </div>
                                                                                <h3 class="fr-title">Mike Green</h3>
                                                                                <p class="fr-content">Repair Technician</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-3">
                                                <div class="vc_column-inner vc_custom_1547538684623">
                                                    <div class="wpb_wrapper">
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1547537698645">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-step-5" class="fr-team ">
                                                                            <div class="fr-team-item ">
                                                                                <div class="avatar">
                                                                                    <div class="over-image"> <img width="170" height="170" src="images/all/shutterstock_216737515.png" class="attachment-full" alt="" loading="lazy" title="shutterstock_216737515" /></div>
                                                                                </div>
                                                                                <h3 class="fr-title">Alan Hardy</h3>
                                                                                <p class="fr-content">Repair Technician</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner vc_custom_1548412075083">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-step-6" class="fr-team ">
                                                                            <div class="fr-team-item ">
                                                                                <div class="avatar">
                                                                                    <div class="over-image"> <img width="170" height="170" src="images/all/shutterstock_585356294.png" class="attachment-full" alt="" loading="lazy" title="shutterstock_585356294" /></div>
                                                                                </div>
                                                                                <h3 class="fr-title">Melissa Walker</h3>
                                                                                <p class="fr-content">Repair Technician</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-3">
                                                <div class="vc_column-inner vc_custom_1548411966083">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-step-7" class="fr-team ">
                                                            <div class="fr-team-item ">
                                                                <div class="avatar">
                                                                    <div class="over-image"> <img width="170" height="170" src="images/all/shutterstock_255741205.png" class="attachment-full" alt="" loading="lazy" title="shutterstock_255741205" /></div>
                                                                </div>
                                                                <h3 class="fr-title">Anne Harvey</h3>
                                                                <p class="fr-content">Quality Controller</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1548412273834">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-5" class="cms-heading layout1  align-center align-center-md align-center-sm align-center-xs ">
                                                            <p class="subtitle">Don’t be afraid to ask!</p>
                                                            <h3 class="title">Frequently Asked Questions</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-6" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:28px;color:#032549;font-size:20px;letter-spacing:0px;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> My Device Doesn’t Switch On</h3>
                                                            <p class="cms-heading-desc" style="color:#032549;line-height:26px;font-weight:400;margin-bottom:52px;"> An electronic device not switching on can be the result of many things. Most commonly there is a fault with the mainboard or the battery. We can diagnose a range of issues and replace only what's needed to be.</p>
                                                        </div>
                                                        <div id="cms-heading-7" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:28px;color:#032549;font-size:20px;letter-spacing:0px;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> My Touchscreen Doesn’t Work</h3>
                                                            <p class="cms-heading-desc" style="color:#032549;line-height:26px;font-weight:400;margin-bottom:52px;"> Many touchscreens won't work if the device has been a victim to a heavy fall or if the device has previously been 'repaired' and a genuine screen wasn't used in the replacement. All our replacement parts come with a 6 month warranty.</p>
                                                        </div>
                                                        <div id="cms-heading-8" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:28px;color:#032549;font-size:20px;letter-spacing:0px;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> Flushed My Phone Down the Toilet</h3>
                                                            <p class="cms-heading-desc" style="color:#032549;line-height:26px;font-weight:400;margin-bottom:45px;"> That was a bit silly, wasn't it? Some believe putting the device in a bag of rice will solve all your problems. But this isn't true and sometimes the damage has already been done.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-9" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:28px;color:#032549;font-size:20px;letter-spacing:0px;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> What Happens if You Can’t Fix My Device?</h3>
                                                            <p class="cms-heading-desc" style="color:#032549;line-height:26px;font-weight:400;margin-bottom:51px;"> If we can't fix your device we will get in touch with you to discuss your options. We can either offer you a replacement device for a cost, or we can return the device to you and refund your service charge.</p>
                                                        </div>
                                                        <div id="cms-heading-10" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:28px;color:#032549;font-size:20px;line-height:26px;letter-spacing:0px;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> Is The Postage Insured When You Send Back My Device?</h3>
                                                            <p class="cms-heading-desc" style="color:#032549;line-height:26px;font-weight:400;margin-bottom:51px;"> Every device that leaves our store comes with a €1,000 minimum insurance cover, so rest assured you won't be out of pocket if the worst happens. We also recommend insuring the mail to the value of your phone when you send it in for repairs.</p>
                                                        </div>
                                                        <div id="cms-heading-11" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:28px;color:#032549;font-size:20px;letter-spacing:0px;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> Can I Deliver My Device in Person?</h3>
                                                            <p class="cms-heading-desc" style="color:#032549;line-height:26px;font-weight:400;margin-bottom:45px;"> Unfortunately, due to health and safety laws we cannot allow members of the public on our premises so we can only accept mail deliveries of your devices.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1548413243634">
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="cms-button-wrapper  align-right align-right-md align-right-sm align-center-xs  "> <a style="margin-bottom:15px;" href="frequently-asked-questions.php" target="_self" class="btn btn-primary size-default"> <span>All FAQ <i class="fa fa-angle-right"></i></span> </a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="cms-button-wrapper  align-left align-left-md align-left-sm align-center-xs  "> <a href="services.php" target="_self" class="btn btn-default size-default"> <span>Fix My Device <i class="fa fa-angle-right"></i></span> </a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1548413422387 before-carousel-after">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-testimonial-carousel" class="fr-testimonial-carousel default owl-carousel  " data-item-xs=1 data-item-sm=1 data-item-md=1 data-item-lg=1 data-margin=50 data-loop=true data-autoplay=false data-autoplaytimeout=5000 data-smartspeed=250 data-center=true data-arrows=true data-bullets=true data-stagepadding=150 data-rtl=false>
                                                            <div class="fr-testimonial-item ">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">TekhRepair did a fantastic job fixing my iPhone X after I dropped it and smashed the front and back. You can’t tell it’s been replaced!</p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Jefferey Williams</h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item ">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">TekhRepair did a fantastic job fixing my iPhone X after I dropped it and smashed the front and back. You can’t tell it’s been replaced!</p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Jefferey Williams</h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item ">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">TekhRepair did a fantastic job fixing my iPhone X after I dropped it and smashed the front and back. You can’t tell it’s been replaced!</p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Jefferey Williams</h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item ">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">TekhRepair did a fantastic job fixing my iPhone X after I dropped it and smashed the front and back. You can’t tell it’s been replaced!</p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Jefferey Williams</h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item ">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">TekhRepair did a fantastic job fixing my iPhone X after I dropped it and smashed the front and back. You can’t tell it’s been replaced!</p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Jefferey Williams</h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen Replacement</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row-full-width vc_clearfix"></div>
                                    </div><!-- .entry-content -->
                                </article><!-- #post-690 -->
                            </main><!-- #main -->
                        </div><!-- #primary -->
                    </div>
                </div>
            </div><!-- #content inner -->
        </div><!-- #content -->
        <?php include 'footer.php'; ?>
        <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
    </div><!-- #page -->
    <script defer src="js/main-js.js">
    </script>
</body>

</html>