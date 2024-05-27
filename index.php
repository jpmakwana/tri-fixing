<?php
include("connect.php");
// Include your database connection code here
?>
<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <title>Tri-fixing</title>
    <style type="text/css">
        @font-face {
            font-family: "Lato";
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/lato/v23/S6uyw4BMUTPHjxAwWw.ttf) format("truetype");
        }

        @font-face {
            font-family: "Lato";
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/lato/v23/S6u9w4BMUTPHh6UVSwaPHA.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: italic;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xGIzc.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: italic;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51S7ACc0CsE.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: italic;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic0CsE.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmSU5fChc9.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu7GxP.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmEU9fChc9.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfChc9.ttf) format("truetype");
        }

        @font-face {
            font-family: "Roboto";
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmYUtfChc9.ttf) format("truetype");
        }
    </style>
    <link rel="stylesheet" href="css/main-style.css" media="all" />
    <link rel="stylesheet" id="woocommerce-smallscreen-css" href="css/woocommerce-smallscreen.min.css" type="text/css" media="only screen and (max-width: 768px)" />
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
    <script defer type="text/javascript" src="js/jquery.min.js"></script>
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
    <style id="cms-page-dynamic-css" data-type="redux-output-css">
        body #page {
            background-color: #fcfcfc;
        }

        #content {
            padding-top: 0px;
            padding-bottom: 98px;
        }

        footer.site-footer {
            background: linear-gradient(90deg, #022243 0%, #083260 100%);
            background: -moz-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -webkit-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -o-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -ms-linear-gradient(0deg, #022243 0%, #083260 100%);
        }
    </style>
    <style type="text/css" data-type="vc_shortcodes-custom-css">
        .vc_custom_1548666921886 {
            margin-top: 62px !important;
        }

        .vc_custom_1536051606545 {
            margin-top: 100px !important;
        }

        .vc_custom_1548834082409 {
            margin-top: -85px !important;
            background-image: url(images/all/Rounded-Rectangle-28e0bd.png?id=301) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .vc_custom_1548661163582 {
            padding-bottom: 70px !important;
        }

        .vc_custom_1544155726138 {
            padding-top: 70px !important;
            padding-bottom: 70px !important;
        }

        .vc_custom_1548661452955 {
            margin-top: -37px !important;
        }

        .vc_custom_1538558312795 {
            margin-bottom: 20px !important;
            padding-right: 0px !important;
        }

        .vc_custom_1548833688779 {
            padding-top: 8px !important;
        }

        .vc_custom_1548659399614 {
            padding-bottom: 17px !important;
        }

        .vc_custom_1548659559106 {
            padding-top: 8px !important;
        }

        .vc_custom_1538550292798 {
            margin-bottom: 100px !important;
        }

        .vc_custom_1548661147937 {
            margin-top: 83px !important;
            padding-top: 80px !important;
            padding-bottom: 76px !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }
    </style>
    <noscript>
        <style>
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }

            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>
    <style>
        @media screen and (min-width: 992px) {
            #fr-space-64b7726a51bfc .fr-space {
                height: 50px;
            }
        }

        @media screen and (min-width: 992px) {
            #fr-space-64b7726a58249 .fr-space {
                height: 121px;
            }
        }

        @media screen and (min-width: 992px) {
            #fr-space-64b7726a5b436 .fr-space {
                height: 116px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #fr-space-64b7726a5b436 .fr-space {
                height: 50px;
            }
        }

        @media (min-width: 576px) and (max-width: 767px) {
            #fr-space-64b7726a5b436 .fr-space {
                height: 50px;
            }
        }

        @media screen and (max-width: 575px) {
            #fr-space-64b7726a5b436 .fr-space {
                height: 50px;
            }
        }

        @media screen and (min-width: 992px) {
            #fr-space-64b7726a5f156 .fr-space {
                height: 239px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #fr-space-64b7726a5f156 .fr-space {
                height: 120px;
            }
        }

        @media (min-width: 576px) and (max-width: 767px) {
            #fr-space-64b7726a5f156 .fr-space {
                height: 120px;
            }
        }

        @media screen and (max-width: 575px) {
            #fr-space-64b7726a5f156 .fr-space {
                height: 120px;
            }
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
    <link rel="stylesheet" href="css/toastr.min.css">
</head>

<body class="home page-template-default page page-id-30 theme-tekhfixers woocommerce-no-js visual-composer wpb-js-composer js-comp-ver-6.8.0 vc_responsive">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="
        visibility: hidden;
        position: absolute;
        left: -9999px;
        overflow: hidden;
      ">
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
        <div class="menu-page-title page-title-non-bg transparent">
            <div class="color-overlay"></div>
            <?php include 'header.php'; ?>
            <div class="page-title-container"></div>
        </div>
        <div id="content" class="site-content">
            <div class="content-inner">
                <svg style="fill: #b8f6db; top: 1080px" id="svg-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="195.875" height="1318.28" viewBox="0 0 195.875 1318.28">
                    <defs>
                        <filter id="gradient-overlay-2" filterUnits="userSpaceOnUse">
                            <feImage x="-829.406" y="0" width="1025.281" height="1318.2800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTAyNS4yODEiIGhlaWdodD0iMTMxOC4yODAwMDAwMDAwMDAyIj48bGluZWFyR3JhZGllbnQgaWQ9ImdyYWQiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB5MT0iMTQ2LjUiIHgyPSIxMDI1LjI4IiB5Mj0iMTE3MS43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMWJkZDg4Ii8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMzJlYjlhIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #b8f6db" d="M-540.968,20.684 C-540.968,20.684 -687.378,86.487 -694.760,174.843 C-702.142,263.200 -643.186,274.374 -667.132,338.769 C-691.079,403.164 -765.483,413.324 -785.981,496.763 C-807.750,585.376 -722.107,571.956 -727.171,690.819 C-732.235,809.683 -978.187,852.597 -688.556,1167.735 C-398.925,1482.874 -139.906,1235.432 -115.898,1040.448 C-91.891,845.463 42.695,803.563 95.851,754.793 C149.006,706.023 316.246,497.102 46.140,203.210 C-223.966,-90.683 -540.968,20.684 -540.968,20.684 Z" class="cls-2" />
                </svg>
                <svg style="bottom: 350px" id="svg-bottom" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="446.28" height="1030.78" viewBox="0 0 446.28 1030.78">
                    <defs>
                        <filter id="gradient-overlay-3" filterUnits="userSpaceOnUse">
                            <feImage x="0" y="0" width="1318.16" height="1030.7800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTMxOC4xNiIgaGVpZ2h0PSIxMDMwLjc4MDAwMDAwMDAwMDIiPjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZCIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIxNDMuNjkiIHgyPSIxMTc0LjQ3IiB5Mj0iMTAzMC43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMDIyMjQzIi8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMDgzMjYwIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #abb8c3" d="M1299.583,301.566 C1299.583,301.566 1235.945,154.230 1147.697,145.545 C1059.449,136.859 1047.402,195.631 983.361,170.740 C919.320,145.850 910.260,71.319 827.122,49.594 C738.831,26.523 750.985,112.336 632.195,105.517 C513.405,98.698 474.127,-147.810 154.703,137.070 C-164.720,421.950 78.893,684.543 273.525,711.425 C468.157,738.308 508.066,873.470 556.051,927.329 C604.035,981.187 810.485,1151.462 1108.374,885.787 C1406.264,620.113 1299.583,301.566 1299.583,301.566 Z" class="cls-3" />
                </svg>
                <div class="container content-container">
                    <div class="row content-row">
                        <div id="primary" class="content-area content-full-width col-12">
                            <main id="main" class="site-main">
                                <article id="post-30" class="post-30 page type-page status-publish hentry">
                                    <div class="entry-content clearfix">
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-parallax="1.5" data-vc-parallax-image="images/slide-header.webp" class="vc_row wpb_row vc_row-fluid header-hero vc_row-has-fill vc_general vc_parallax vc_parallax-content-moving bg-primary bg-art rm-padding-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6 vc_col-md-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-space-64b7726a51bfc">
                                                            <div class="fr-space"></div>
                                                        </div>
                                                        <div id="cms-heading" class="cms-heading layout2 align-left align-left-md align-left-sm align-left-xs wpb_animate_when_almost_visible wpb_bounceInDown bounceInDown">
                                                            <h3 class="title wpb_animate_when_almost_visible wpb_bounceInDown bounceInDown">
                                                                Professional<br />
                                                                Device Repairs
                                                            </h3>
                                                            <p class="subtitle wpb_animate_when_almost_visible wpb_bounceInDown bounceInDown">
                                                                Accidents happen, and it’s our job to fix them when it
                                                                comes to damaging your mobile device. It’s never been
                                                                easier to render your device useless after dropping it.
                                                                Our
                                                                trained technicians will diagnose and repair your device
                                                                within 24 hours.
                                                            </p>
                                                            <a href="category.php" target="_self" class="btn btn-default size-default wpb_animate_when_almost_visible wpb_bounceInDown bounceInDown">
                                                                <span>Fix my Device <i class="fa fa-angle-right"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6 vc_col-md-6 vc_hidden-sm vc_hidden-xs">
                                                <div class="vc_column-inner vc_custom_1548661452955">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left wpb_animate_when_almost_visible wpb_bounceInDown bounceInDown hover-parallax">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper hover-parallax vc_box_border_grey">
                                                                    <img width="604" height="737" src="images/all/iPhone-X.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="iPhone X" srcset="
                                                                                images/all/iPhone-X.png         604w,
                                                                                images/all/iPhone-X-600x732.png 600w
                                                                            " sizes="(max-width: 604px) 100vw, 604px" />
                                                                </div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row-full-width vc_clearfix"></div>
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1548666921886 carousel-stretch-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-service-carousel" class="fr-service-carousel-default owl-carousel" data-item-xs="1" data-item-sm="2" data-item-md="3" data-item-lg="4" data-margin="0" data-loop="true" data-autoplay="false" data-autoplaytimeout="5000" data-smartspeed="250" data-center="false" data-arrows="true" data-bullets="false" data-stagepadding="0" data-rtl="false">
                                                            <div class="fr-carousel-item">
                                                                <div id="post-198" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="water-damagerepair.php">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_674357041.png);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <h2 class="entry-title"><span>Water
                                                                                    Damage</span>Repair</h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="water-damagerepair.php">Read
                                                                                More</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="fr-carousel-item">
                                                                <div id="post-194" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="speakerrepair.php">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_405538558.png);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <h2 class="entry-title">
                                                                                <span>Speaker</span>Repair
                                                                            </h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="speakerrepair.php">Read
                                                                                More</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="fr-carousel-item">
                                                                <div id="post-192" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="camerarepair.php">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_619717289.png);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <h2 class="entry-title">
                                                                                <span>Camera</span>Repair
                                                                            </h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="camerarepair.php">Read
                                                                                More</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="fr-carousel-item">
                                                                <div id="post-190" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="batteryreplacement.php">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_271948178-1.png);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <h2 class="entry-title">
                                                                                <span>Battery</span>Replace
                                                                            </h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="batteryreplacement.php">Read
                                                                                More</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="fr-carousel-item">
                                                                <div id="post-182" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="screenrepair.php">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_405538501.png);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <h2 class="entry-title">
                                                                                <span>Screen</span>Repair
                                                                            </h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="screenrepair.php">Read
                                                                                More</a></div>
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
                                                        <div id="fr-space-64b7726a58249">
                                                            <div class="fr-space"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1536051606545">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-2" class="cms-heading layout1 align-left align-left-md align-left-sm align-left-xs">
                                                            <p class="subtitle">How We Can Help</p>
                                                            <h3 class="title">
                                                                We Make<br />
                                                                Mobile Repair<br />
                                                                Stress Free
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-fancybox-layout1" class="fr-service-grid-default">
                                                            <div class="service-item-grid">
                                                                <div class="item-image"><img src="images/all/Icon%403x.png" alt="Icon@3x" /></div>
                                                                <div class="item-holder">
                                                                    <h3 class="item-title">Water Ingress Damage</h3>
                                                                    <div class="item-excerpt">We can often repair water
                                                                        damage from inside the phone, only rare cases
                                                                        where we cannot fix this.</div>
                                                                    <div class="item-readmore">
                                                                        <span>from &#036;19 <sup>.00</sup> </span> <a href="#">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-fancybox-layout1-2" class="fr-service-grid-default">
                                                            <div class="service-item-grid">
                                                                <div class="item-image"><img src="images/all/Icon%403x1.png" alt="Icon@3&#215;1" /></div>
                                                                <div class="item-holder">
                                                                    <h3 class="item-title">Poor Battery Life</h3>
                                                                    <div class="item-excerpt">As devices age, their
                                                                        batteries degrade. With a new battery you can
                                                                        enjoy many more hours of charge.</div>
                                                                    <div class="item-readmore">
                                                                        <span>from &#036;25 <sup>.00</sup> </span> <a href="#">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-fancybox-layout1-3" class="fr-service-grid-default">
                                                            <div class="service-item-grid">
                                                                <div class="item-image"><img src="images/all/Icon%403x4.png" alt="Icon@3&#215;4" /></div>
                                                                <div class="item-holder">
                                                                    <h3 class="item-title">Cracked Screens</h3>
                                                                    <div class="item-excerpt">Our most common repair! We
                                                                        only use genuine parts to avoid voiding your
                                                                        warranty.</div>
                                                                    <div class="item-readmore">
                                                                        <span>from &#036;59 <sup>.00</sup> </span> <a href="#">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-fancybox-layout1-4" class="fr-service-grid-default">
                                                            <div class="service-item-grid">
                                                                <div class="item-image"><img src="images/all/Icon%403x2.png" alt="Icon@3&#215;2" /></div>
                                                                <div class="item-holder">
                                                                    <h3 class="item-title">Bent Chassis</h3>
                                                                    <div class="item-excerpt">Sat on your phone? We can
                                                                        straighten your current chassis or replace it
                                                                        with a factory original.</div>
                                                                    <div class="item-readmore">
                                                                        <span>from &#036;75 <sup>.00</sup> </span> <a href="#">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-fancybox-layout1-5" class="fr-service-grid-default">
                                                            <div class="service-item-grid">
                                                                <div class="item-image"><img src="images/all/Icon%403x3.png" alt="Icon@3&#215;3" /></div>
                                                                <div class="item-holder">
                                                                    <h3 class="item-title">Broken Speakers</h3>
                                                                    <div class="item-excerpt">Many things can cause
                                                                        broken speakers, but we can replace them easily
                                                                        so you can hear again.</div>
                                                                    <div class="item-readmore">
                                                                        <span>from &#036;39 <sup>.00</sup> </span> <a href="#">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-space-64b7726a5b436">
                                                            <div class="fr-space"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid off-overflow">
                                            <div class="wpb_column vc_column_container vc_col-sm-5">
                                                <div class="vc_column-inner vc_custom_1538558312795">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left image-radius">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper image-radius vc_box_border_grey">
                                                                    <img class="vc_single_image-img" src="images/all/Layer-1-485x392.png" width="485" height="392" alt="Layer 1" title="Layer 1" />
                                                                </div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="n-padding-md wpb_column vc_column_container vc_col-sm-7">
                                                <div class="vc_column-inner vc_custom_1548833688779">
                                                    <div class="wpb_wrapper">
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1548659399614">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="cms-heading-3" class="cms-heading layout1 align-left align-left-md align-left-sm align-left-xs">
                                                                            <p class="subtitle">Professional Repair
                                                                                Technicians</p>
                                                                            <h3 class="title">Your Device in Safe Hands
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="wpb_text_column wpb_content_element">
                                                            <div class="wpb_wrapper">
                                                                <p>Here at TekhFixers we repair hundreds of devices a
                                                                    month, so rest assured you&#8217;re in safe hands
                                                                    sending your devices to us for repair.</p>
                                                            </div>
                                                        </div>
                                                        <div class="wpb_text_column wpb_content_element">
                                                            <div class="wpb_wrapper">
                                                                <p>
                                                                    TekhFixers are capable of repairing any electronic
                                                                    device on the market now and those manufactured in
                                                                    the last 10 years. We have all the right tools for
                                                                    the job so we
                                                                    can open up your device, repair it and assemble it
                                                                    all back together without ever knowing it had been
                                                                    touched.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1548659559106">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="cms-button-wrapper align-left align-left-md align-left-sm align-left-xs">
                                                                            <a style="margin-top: 10px;" href="about-us.php" target="_self" class="btn btn-default size-default">
                                                                                <span>Learn More <i class="fa fa-angle-right"></i></span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="image-absolute wpb_column vc_column_container vc_col-sm-12 vc_hidden-sm vc_hidden-xs">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper vc_box_border_grey">
                                                                    <img width="579" height="546" src="images/all/android.png" class="vc_single_image-img attachment-full" alt="" decoding="async" loading="lazy" title="android" srcset="
                                                                                images/android.webp         579w,
                                                                                images/android.webp 450w
                                                                            " sizes="(max-width: 579px) 100vw, 579px" />
                                                                </div>
                                                            </figure>
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
                                                        <div id="fr-space-64b7726a5f156">
                                                            <div class="fr-space"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1548834082409 vc_row-has-fill before-carousel-after">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner vc_custom_1538550292798">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-testimonial-carousel" class="fr-testimonial-carousel default owl-carousel" data-item-xs="1" data-item-sm="1" data-item-md="1" data-item-lg="1" data-margin="50" data-loop="true" data-autoplay="false" data-autoplaytimeout="5000" data-smartspeed="250" data-center="true" data-arrows="true" data-bullets="true" data-stagepadding="150" data-rtl="false">
                                                            <div class="fr-testimonial-item">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">
                                                                        TekhRepair did a fantastic job fixing my iPhone
                                                                        X after<br />
                                                                        I dropped it and smashed the front and back.
                                                                        <br />
                                                                        You can’t tell it’s been replaced!
                                                                    </p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Jefferey Williams
                                                                    </h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen
                                                                        Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">
                                                                        Can’t fault the work TekhRepair carried out on
                                                                        my Samsung after I flushed it down the toilet.
                                                                        They Replaced the internals and dreid out all
                                                                        the wawater
                                                                    </p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Laura Harding</h3>
                                                                    <p class="fr-testimonial-service">Samsung Screen
                                                                        Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">
                                                                        I previously had my phones screen replaced but
                                                                        it was a cheap replacement and after about a
                                                                        week the touch screen started to act faulty.
                                                                        TekhFixers fixed this.
                                                                    </p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Mike Jenkins</h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen
                                                                        Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">
                                                                        TekhRepair did a fantastic job fixing my iPhone
                                                                        X after <br />
                                                                        I dropped it and smashed the front and back.
                                                                        <br />
                                                                        You can’t tell it’s been replaced!
                                                                    </p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Harry Simpson</h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen
                                                                        Replacement</p>
                                                                </div>
                                                            </div>
                                                            <div class="fr-testimonial-item">
                                                                <div class="fr-testimonial-item-inner">
                                                                    <p class="fr-testimonial-content">
                                                                        TekhRepair did a fantastic job fixing my iPhone
                                                                        X after <br />
                                                                        I dropped it and smashed the front and back.
                                                                        <br />
                                                                        You can’t tell it’s been replaced!
                                                                    </p>
                                                                    <p class="fr-testimonial-rating"><i class="star5"></i></p>
                                                                    <h3 class="fr-testimonial-title">Jefferey Williams
                                                                    </h3>
                                                                    <p class="fr-testimonial-service">iPhone Screen
                                                                        Replacement</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">
                                                <div class="vc_column-inner vc_custom_1548661147937">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-video-popup" class="fr-video-popup">
                                                            <div class="fr-video-popup-content">
                                                                <img class="img-bg" src="images/all/shutterstock_331922156.png" alt="shutterstock_331922156" />
                                                                <img class="small-image hover-parallax" src="images/all/Group-25.png" alt="Group 25" style="top: -118px; left: -280px;" />
                                                                <div class="content-button">
                                                                    <div class="hover-effect">
                                                                        <div class="element-holder">
                                                                            <p class="button-text">Watch our Explainer
                                                                                Video</p>
                                                                            <a class="video-autoplay play-video-button" href="https://www.youtube.com/watch?v=sr42GZn3ILU">
                                                                                <i class="fa fa-play"></i> </a>
                                                                            <p class="video-time">1:03</p>
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
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1548661163582">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-4" class="cms-heading layout1 align-center align-center-md align-center-sm align-center-xs">
                                                            <p class="subtitle">Keep up to date with us</p>
                                                            <h3 class="title">Latest News</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="fr-blog-carousel" class="fr-blog-carousel tekhfixers-carousel owl-carousel animation-time" data-item-xs="1" data-item-sm="2" data-item-md="3" data-item-lg="3" data-margin="0" data-loop="false" data-autoplay="false" data-autoplaytimeout="5000" data-smartspeed="250" data-center="false" data-arrows="false" data-bullets="false" data-stagepadding="0" data-rtl="false">
                                                            <div class="cms-carousel-item">
                                                                <div id="post-1" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="our-top-5-iphone-x-cases-reviewed/index.html">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_777073321.jpg);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <a class="blog-post-cat" href="category/product-reviews/index.html">Product
                                                                                Reviews</a>
                                                                            <h2 class="entry-title">Our Top 5 iPhone X
                                                                                Cases Reviewed</h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="our-top-5-iphone-x-cases-reviewed/index.html">Read
                                                                                Story</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cms-carousel-item">
                                                                <div id="post-17" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="why-we-only-use-genuine-parts-in-our-repairs/index.html">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_684391222.png);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <a class="blog-post-cat" href="category/company-news/index.html">Company
                                                                                News</a> ,
                                                                            <a class="blog-post-cat" href="category/tips-tricks/index.html">Tips
                                                                                &amp; Tricks</a>
                                                                            <h2 class="entry-title">Why We Only Use
                                                                                Genuine Parts in our Repairs</h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="why-we-only-use-genuine-parts-in-our-repairs/index.html">Read
                                                                                Story</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cms-carousel-item">
                                                                <div id="post-19" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="what-to-do-after-dropping-your-phone-in-water/index.html">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/shutterstock_674357041.jpg);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <a class="blog-post-cat" href="category/tips-tricks/index.html">Tips
                                                                                &amp; Tricks</a>
                                                                            <h2 class="entry-title">What to Do After
                                                                                Dropping Your Phone in Water</h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="what-to-do-after-dropping-your-phone-in-water/index.html">Read
                                                                                Story</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cms-carousel-item">
                                                                <div id="post-21" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="what-to-beware-of-when-fixing-your-device-yourself/index.html">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/DIY.jpg);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <a class="blog-post-cat" href="category/lastest-news/index.html">Lastest
                                                                                News</a> ,
                                                                            <a class="blog-post-cat" href="category/tips-tricks/index.html">Tips
                                                                                &amp; Tricks</a>
                                                                            <h2 class="entry-title">What to Beware of
                                                                                When Fixing Your Device Yourself</h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="what-to-beware-of-when-fixing-your-device-yourself/index.html">Read
                                                                                Story</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cms-carousel-item">
                                                                <div id="post-60" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="replacing-a-li-ion-battery-yourself/index.html">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/battery.jpg);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <a class="blog-post-cat" href="category/diy/index.html">DIY</a>
                                                                            <h2 class="entry-title">Replacing a Li-Ion
                                                                                Battery Yourself</h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="replacing-a-li-ion-battery-yourself/index.html">Read
                                                                                Story</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="cms-carousel-item">
                                                                <div id="post-65" class="single-hentry-blog-post post-30 page type-page status-publish hentry">
                                                                    <a href="the-5-most-common-reasons-why-screens-break/index.html">
                                                                        <div class="entry-featured">
                                                                            <div class="post-image" style="background: url(images/all/smashed.jpg);">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="overlay"></div>
                                                                    <div class="entry-holder text-center">
                                                                        <div class="post-meta">
                                                                            <a class="blog-post-cat" href="category/lastest-news/index.html">Lastest
                                                                                News</a>
                                                                            <h2 class="entry-title">5 Most Common
                                                                                Reasons Why Screens Break</h2>
                                                                        </div>
                                                                        <div class="entry-more"><a class="read-more" href="the-5-most-common-reasons-why-screens-break/index.html">Read
                                                                                Story</a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1544155726138">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-5" class="cms-heading layout1 align-center align-center-md align-center-sm align-center-xs">
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
                                                        <div id="cms-heading-6" class="cms-heading align-left align-left-md align-left-sm align-left-xs">
                                                            <h3 class="cms-heading-tag" style="
                                                                        margin-bottom: 28px;
                                                                        color: #032549;
                                                                        font-size: 20px;
                                                                        letter-spacing: 0px;
                                                                        text-transform: none;
                                                                        font-weight: 400;
                                                                        font-style: normal;
                                                                        font-family: AktivGrotesk-XBold;
                                                                        display: inline-block;
                                                                    ">
                                                                My Device Doesn’t Switch On
                                                            </h3>
                                                            <p class="cms-heading-desc" style="color: #032549; line-height: 1.9; font-weight: 400; margin-bottom: 55px;">
                                                                An electronic device not switching on can be the result
                                                                of many things. Most commonly there is a fault with the
                                                                mainboard or the battery. We can diagnose a range of
                                                                issues
                                                                and replace only what's needed to be.
                                                            </p>
                                                        </div>
                                                        <div id="cms-heading-7" class="cms-heading align-left align-left-md align-left-sm align-left-xs">
                                                            <h3 class="cms-heading-tag" style="
                                                                        margin-bottom: 28px;
                                                                        color: #032549;
                                                                        font-size: 20px;
                                                                        letter-spacing: 0px;
                                                                        text-transform: none;
                                                                        font-weight: 400;
                                                                        font-style: normal;
                                                                        font-family: AktivGrotesk-XBold;
                                                                        display: inline-block;
                                                                    ">
                                                                My Touchscreen Doesn’t Work
                                                            </h3>
                                                            <p class="cms-heading-desc" style="color: #032549; line-height: 1.9; font-weight: 400; margin-bottom: 55px;">
                                                                Many touchscreens won't work if the device has been a
                                                                victim to a heavy fall or if the device has previously
                                                                been 'repaired' and a genuine screen wasn't used in the
                                                                replacement. All our replacement parts come with a 6
                                                                month warranty.
                                                            </p>
                                                        </div>
                                                        <div id="cms-heading-8" class="cms-heading align-left align-left-md align-left-sm align-left-xs">
                                                            <h3 class="cms-heading-tag" style="
                                                                        margin-bottom: 28px;
                                                                        color: #032549;
                                                                        font-size: 20px;
                                                                        letter-spacing: 0px;
                                                                        text-transform: none;
                                                                        font-weight: 400;
                                                                        font-style: normal;
                                                                        font-family: AktivGrotesk-XBold;
                                                                        display: inline-block;
                                                                    ">
                                                                Flushed My Phone Down the Toilet
                                                            </h3>
                                                            <p class="cms-heading-desc" style="color: #032549; line-height: 1.9; font-weight: 400; margin-bottom: 43px;">
                                                                That was a bit silly, wasn't it? Some believe putting
                                                                the device in a bag of rice will solve all your
                                                                problems. But this isn't true and sometimes the damage
                                                                has already
                                                                been done.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading-9" class="cms-heading align-left align-left-md align-left-sm align-left-xs">
                                                            <h3 class="cms-heading-tag" style="
                                                                        margin-bottom: 28px;
                                                                        color: #032549;
                                                                        font-size: 20px;
                                                                        letter-spacing: 0px;
                                                                        text-transform: none;
                                                                        font-weight: 400;
                                                                        font-style: normal;
                                                                        font-family: AktivGrotesk-XBold;
                                                                        display: inline-block;
                                                                    ">
                                                                What Happens if You Can’t Fix My Device?
                                                            </h3>
                                                            <p class="cms-heading-desc" style="color: #032549; line-height: 1.9; font-weight: 400; margin-bottom: 55px;">
                                                                If we can't fix your device we will get in touch with
                                                                you to discuss your options. We can either offer you a
                                                                replacement device for a cost, or we can return the
                                                                device to
                                                                you and refund your service charge.
                                                            </p>
                                                        </div>
                                                        <div id="cms-heading-10" class="cms-heading align-left align-left-md align-left-sm align-left-xs">
                                                            <h3 class="cms-heading-tag" style="
                                                                        margin-bottom: 28px;
                                                                        color: #032549;
                                                                        font-size: 20px;
                                                                        letter-spacing: 0px;
                                                                        text-transform: none;
                                                                        font-weight: 400;
                                                                        font-style: normal;
                                                                        font-family: AktivGrotesk-XBold;
                                                                        display: inline-block;
                                                                    ">
                                                                Is The Postage Insured When You Send Back My Device?
                                                            </h3>
                                                            <p class="cms-heading-desc" style="color: #032549; line-height: 1.9; font-weight: 400; margin-bottom: 55px;">
                                                                Every device that leaves our store comes with a €1,000
                                                                minimum insurance cover, so rest assured you won't be
                                                                out of pocket if the worst happens. We also recommend
                                                                insuring
                                                                the mail to the value of your phone when you send it in
                                                                for repairs.
                                                            </p>
                                                        </div>
                                                        <div id="cms-heading-11" class="cms-heading align-left align-left-md align-left-sm align-left-xs">
                                                            <h3 class="cms-heading-tag" style="
                                                                        margin-bottom: 28px;
                                                                        color: #032549;
                                                                        font-size: 20px;
                                                                        letter-spacing: 0px;
                                                                        text-transform: none;
                                                                        font-weight: 400;
                                                                        font-style: normal;
                                                                        font-family: AktivGrotesk-XBold;
                                                                        display: inline-block;
                                                                    ">
                                                                Can I Deliver My Device in Person?
                                                            </h3>
                                                            <p class="cms-heading-desc" style="color: #032549; line-height: 1.9; font-weight: 400; margin-bottom: 45px;">
                                                                Unfortunately, due to health and safety laws we cannot
                                                                allow members of the public on our premises so we can
                                                                only accept mail deliveries of your devices.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="cms-button-wrapper align-right align-right-md align-right-sm align-center-xs">
                                                            <a style="margin-bottom: 5px;" href="frequently-asked-questions.php" target="_self" class="btn btn-primary size-default">
                                                                <span>All FAQ <i class="fa fa-angle-right"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="cms-button-wrapper align-left align-left-md align-left-sm align-center-xs">
                                                            <a href="services.php" target="_self" class="btn btn-default size-default">
                                                                <span>Fix My Device <i class="fa fa-angle-right"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .entry-content -->
                                </article>
                                <!-- #post-30 -->
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
        <?php include 'footer.php'; ?>
        <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
    </div>
    <!-- #page -->
    <script src="js/jquery.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script defer src="js/main-js.js"></script>
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