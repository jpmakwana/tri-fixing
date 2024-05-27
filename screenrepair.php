<?php include("connect.php");
// Include your database connection code here

?>
<!doctype html>
<html lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title>ScreenRepair &#8211; Tri-fixing &#8211; Mobile Device and Electronics Repair </title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <style type="text/css">
        @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/lato/v23/S6uyw4BMUTPHjxAwWw.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/lato/v23/S6u9w4BMUTPHh6UVSwaPHA.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: italic;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOkCnqEu92Fr1Mu51xGIzc.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: italic;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51S7ACc0CsE.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: italic;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TzBic0CsE.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmSU5fChc9.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu7GxP.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmEU9fChc9.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfChc9.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmYUtfChc9.ttf) format('truetype');
        }
    </style>
    <link rel="stylesheet" href="css/main-style.css" media="all" />
    
    
    <link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
    
    
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
    <link rel='stylesheet' id='woocommerce-smallscreen-css' href='css/woocommerce-smallscreen.min.css' type='text/css' media='only screen and (max-width: 768px)' />
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
    <script type='text/javascript' id='wc-add-to-cart-js-extra'>
        /* <![CDATA[ */
        var wc_add_to_cart_params = {
            "ajax_url": "\/themeforest\/wp-tekhfixers\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/themeforest\/wp-tekhfixers\/?wc-ajax=%%endpoint%%",
            "i18n_view_cart": "View cart",
            "cart_url": "https:\/\/demo.cmssuperheroes.com\/themeforest\/wp-tekhfixers\/cart\/",
            "is_cart": "",
            "cart_redirect_after_add": "no"
        };
        /* ]]> */
    </script>
    <link rel="https://api.w.org/" href="wp-json/index.html" />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc0db0.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="wp-includes/wlwmanifest.xml" />
    <meta name="generator" content="WordPress 6.2.2" />
    <meta name="generator" content="WooCommerce 7.7.1" />
    <link rel="canonical" href="index.php" />
    <link rel='shortlink' href='index7b17.html?p=182' />
    <link rel="alternate" type="application/json+oembed" href="wp-json/oembed/1.0/embed1b39.json?url=https%3A%2F%2Fdemo.cmssuperheroes.com%2Fthemeforest%2Fwp-tekhfixers%2Fservices%2Fscreenrepair%2F" />
    <link rel="alternate" type="text/xml+oembed" href="wp-json/oembed/1.0/embed0595?url=https%3A%2F%2Fdemo.cmssuperheroes.com%2Fthemeforest%2Fwp-tekhfixers%2Fservices%2Fscreenrepair%2F&amp;format=xml" />
    <meta name="generator" content="Redux 4.4.1" /> <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>
    <meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress." />
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
    <style id="cms-services-dynamic-css" data-type="redux-output-css">
        #content {
            padding-top: 100px;
            padding-bottom: 50px;
        }
    </style>
    <style type="text/css" data-type="vc_shortcodes-custom-css">
        .vc_custom_1541521972917 {
            margin-bottom: 55px !important;
        }

        .vc_custom_1548644163973 {
            margin-bottom: 59px !important;
        }
    </style><noscript>
        <style>
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }
        </style>
    </noscript>
</head>

<body class="services-template-default single single-services postid-182 theme-tekhfixers woocommerce-no-js visual-composer wpb-js-composer js-comp-ver-6.8.0 vc_responsive"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
            <?php include 'header.php'; ?>
            <div class="page-title-container">
                <div id="pagetitle" class="page-title page-title-layout1 ">
                    <div class="container">
                        <div class="page-title-inner">
                            <div class="page-title-content clearfix"> <a href="category.php" class="back-link">Back to Services</a>
                                <h1 class="page-title ft-heading-b"><span>Screen</span>Repair</h1>
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
                    <div class="row">
                        <div id="primary" class="content-area col-12">
                            <main id="main" class="site-main">
                                <div class="post-type-inner">
                                    <div class="post-type-content">
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-4">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="cms-service-menu  ">
                                                            <div id="fr-service-menu" class="fr-accordion  ">
                                                                <div class="content">
                                                                    <div class="card">
                                                                        <div class="card-header" id="heading-2"> <a data-toggle="collapse" data-target="#collapse-fr-service-menu2" aria-expanded="false" aria-controls="collapse-2"> Mobile Services <i class="zmdi zmdi-chevron-down"></i> </a></div>
                                                                        <div id="collapse-fr-service-menu2" class="collapse  " aria-labelledby="heading-2" data-parent="#fr-service-menu">
                                                                            <div class="card-body">
                                                                                <ul class="list-menu-service">
                                                                                    <li class=""><a href="water-damagerepair.php"> <i class="zmdi zmdi-chevron-right"></i> <span>Water Damage</span>Repair </a></li>
                                                                                    <li class="active"><a href="index.php"> <i class="zmdi zmdi-chevron-right"></i> <span>Screen</span>Repair </a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="card">
                                                                        <div class="card-header" id="heading-4"> <a data-toggle="collapse" data-target="#collapse-fr-service-menu4" aria-expanded="false" aria-controls="collapse-4"> PC &amp; Mac Services <i class="zmdi zmdi-chevron-down"></i> </a></div>
                                                                        <div id="collapse-fr-service-menu4" class="collapse  " aria-labelledby="heading-4" data-parent="#fr-service-menu">
                                                                            <div class="card-body">
                                                                                <ul class="list-menu-service">
                                                                                    <li class=""><a href="home-buttonrepair/index.html"> <i class="zmdi zmdi-chevron-right"></i> <span>Home Button</span>Repair </a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                                                                    <div class="card">
                                                                        <div class="card-header" id="heading-7"> <a data-toggle="collapse" data-target="#collapse-fr-service-menu7" aria-expanded="false" aria-controls="collapse-7"> Smartwatch Services <i class="zmdi zmdi-chevron-down"></i> </a></div>
                                                                        <div id="collapse-fr-service-menu7" class="collapse  " aria-labelledby="heading-7" data-parent="#fr-service-menu">
                                                                            <div class="card-body">
                                                                                <ul class="list-menu-service">
                                                                                    <li class=""><a href="speakerrepair.php"> <i class="zmdi zmdi-chevron-right"></i> <span>Speaker</span>Repair </a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header" id="heading-9"> <a data-toggle="collapse" data-target="#collapse-fr-service-menu9" aria-expanded="false" aria-controls="collapse-9"> Tablet Services <i class="zmdi zmdi-chevron-down"></i> </a></div>
                                                                        <div id="collapse-fr-service-menu9" class="collapse  " aria-labelledby="heading-9" data-parent="#fr-service-menu">
                                                                            <div class="card-body">
                                                                                <ul class="list-menu-service">
                                                                                    <li class=""><a href="camerarepair.php"> <i class="zmdi zmdi-chevron-right"></i> <span>Camera</span>Repair </a></li>
                                                                                    <li class=""><a href="batteryreplacement.php"> <i class="zmdi zmdi-chevron-right"></i> <span>Battery</span>Replace </a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-8 vc_col-md-8">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:20px;color:#083260;font-size:54px;letter-spacing:-.016em;text-transform:none;font-weight:400;font-style:normal;display:inline-block; "> Genuine Screen Repair Services</h3>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid color-66">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                            <div class="wpb_wrapper">
                                                                                <p>The vast majority of mobile devices in production today use glass on their outer layer. Even though this glass is the toughest glass used on mobile devices, it is still prone to cracking and breaking when falling onto a hard surface.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid color-66">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                            <div class="wpb_wrapper">
                                                                                <p>At TekhFixers we replace the whole panel of broken glass and use a direct factory replacement to ensure it looks like it did when it came out of the factory. We also use genuine parts so your phone functions like new.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid color-66">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                            <div class="wpb_wrapper">
                                                                                <p>Most screen repairs are done using cheap replacement screens, that may work in the short term but you&#8217;ll always notice problems with the touch screen and pressure sensitive touches. Most new devices these days know whether or not a genuine screen has been repaired and can actually switch off and not come back on again unless a genuine screen has been used. At TekhFixers all our repairs use genuine parts and carry a 12 month warranty.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-fancybox-carousel" class="service-option-container  ">
                                                                            <h3>Water Damage Services</h3>
                                                                            <div class="service-options">
                                                                                <div class="repair-carousel owl-carousel" data-item-xs=1 data-item-sm=2 data-item-md=3 data-item-lg=3 data-margin=30 data-loop=true data-autoplay=false data-autoplaytimeout=5000 data-smartspeed=250 data-center=false data-arrows=false data-bullets=true data-stagepadding=0 data-rtl=false>
                                                                                    <div class="repair-item">
                                                                                        <div class="image-item"> <img src="images/all/Icon%403x.png" alt="Icon@3x"></div>
                                                                                        <h3>Front Screen Replacement</h3>
                                                                                        <p class="content">We can often repair water damage from inside the phone, only rare cases where we.</p>
                                                                                        <div class="meta"> <span>only
                                                                                                &#036;39 <sup>.00</sup> </span> <a href="#">Choose Service</a></div>
                                                                                    </div>
                                                                                    <div class="repair-item">
                                                                                        <div class="image-item"> <img src="images/all/Icon%403x3.png" alt="Icon@3&#215;3"></div>
                                                                                        <h3>Rear Glass Replacement</h3>
                                                                                        <p class="content">We can often repair water damage from inside the phone, only rare cases where we.</p>
                                                                                        <div class="meta"> <span>only
                                                                                                &#036;69 <sup>.00</sup> </span> <a href="#">Choose Service</a></div>
                                                                                    </div>
                                                                                    <div class="repair-item">
                                                                                        <div class="image-item"> <img src="images/all/Icon%403x1.png" alt="Icon@3&#215;1"></div>
                                                                                        <h3>Battery Replacement</h3>
                                                                                        <p class="content">We can often repair water damage from inside the phone, only rare cases where we.</p>
                                                                                        <div class="meta"> <span>only
                                                                                                &#036;25 <sup>.00</sup> </span> <a href="#">Choose Service</a></div>
                                                                                    </div>
                                                                                    <div class="repair-item">
                                                                                        <div class="image-item"> <img src="images/all/Icon%403x2.png" alt="Icon@3&#215;2"></div>
                                                                                        <h3>Broken Speakers</h3>
                                                                                        <p class="content">We can often repair water damage from inside the phone, only rare cases where we.</p>
                                                                                        <div class="meta"> <span>only
                                                                                                &#036;49 <sup>.00</sup> </span> <a href="#">Choose Service</a></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                                <div class="vc_column-inner vc_custom_1541521972917">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="cms-heading-2" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                                            <h3 class="cms-heading-tag     " style="margin-bottom:25px;font-size:22px;letter-spacing:-.016em;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> Only Genuine Parts Used</h3>
                                                                            <p class="cms-heading-desc" style="color:#032549;line-height:1.85;font-weight:500;"> Our repairs and replacement parts will last the life of the phone. We only use genuine parts in our repairs. All our repairs come with a 12 month warranty.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                                <div class="vc_column-inner vc_custom_1548644163973">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="cms-heading-3" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                                            <h3 class="cms-heading-tag     " style="margin-bottom:25px;font-size:22px;letter-spacing:-.016em;text-transform:none;font-weight:400;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> 12 Months Peace of Mind Warranty</h3>
                                                                            <p class="cms-heading-desc" style="color:#032549;line-height:1.85;font-weight:500;"> A 12 months warranty comes with all our repairs unless states otherwise. If the repair in the device fails, we will fix it at no cost to you. We'll give you a free shipping label to get it back to us.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-accordion" class="fr-accordion layout2  ">
                                                                            <div class="content">
                                                                                <div class="card ">
                                                                                    <div class="card-header" id="heading-0"> <a data-toggle="collapse" data-target="#collapse-fr-accordion0" aria-expanded="false" aria-controls="collapse-0"> My Device Doesn’t Switch On <i class="zmdi zmdi-plus"></i> </a></div>
                                                                                    <div id="collapse-fr-accordion0" class="collapse  " aria-labelledby="heading-0" data-parent="#fr-accordion">
                                                                                        <div class="card-body"> An electronic device not switching on can be the result of many things. Most commonly there is a fault with the mainboard or the battery. We can diagnose a range of issues and replace only what's needed to be.</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card active">
                                                                                    <div class="card-header" id="heading-1"> <a data-toggle="collapse" data-target="#collapse-fr-accordion1" aria-expanded="true" aria-controls="collapse-1"> My Touchscreen Doesn’t Work <i class="zmdi zmdi-plus"></i> </a></div>
                                                                                    <div id="collapse-fr-accordion1" class="collapse  show" aria-labelledby="heading-1" data-parent="#fr-accordion">
                                                                                        <div class="card-body"> Many touchscreens won't work if the device has been a victim to a heavy fall or if the device has previously been 'repaired' and a genuine screen wasn't used in the replacement. All our replacement parts come with a 6 month warranty.</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card ">
                                                                                    <div class="card-header" id="heading-2"> <a data-toggle="collapse" data-target="#collapse-fr-accordion2" aria-expanded="false" aria-controls="collapse-2"> I Flushed My Device Down The Toilet <i class="zmdi zmdi-plus"></i> </a></div>
                                                                                    <div id="collapse-fr-accordion2" class="collapse  " aria-labelledby="heading-2" data-parent="#fr-accordion">
                                                                                        <div class="card-body"> That was a bit silly, wasn't it? Some believe putting the device in a bag of rice will solve all your problems. But this isn't true and sometimes the damage has already been done.</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card ">
                                                                                    <div class="card-header" id="heading-3"> <a data-toggle="collapse" data-target="#collapse-fr-accordion3" aria-expanded="false" aria-controls="collapse-3"> Can I Deliver My Device in Person? <i class="zmdi zmdi-plus"></i> </a></div>
                                                                                    <div id="collapse-fr-accordion3" class="collapse  " aria-labelledby="heading-3" data-parent="#fr-accordion">
                                                                                        <div class="card-body"> Unfortunately, due to health and safety laws we cannot allow members of the public on our premises so we can only accept mail deliveries of your devices.</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="cms-heading-4" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-top:65px;margin-bottom:35px;font-size:22px;letter-spacing:-.016em;text-transform:none;font-weight:500;font-style:normal;font-family:AktivGrotesk-Bold;display:inline-block; "> Gallery</h3>
                                                        </div>
                                                        <div id="fr-gallery-grid" class="fr-gallery-grid service-gallery default images-light-box  ">
                                                            <div class="row">
                                                                <div class="grid-item col-sm-6 col-md-6 col-lg-3"> <a class="light-box" href="images/all/shutterstock_405538501.png">
                                                                        <div class="overlay-item"> <i class="fa fa-search"></i></div> <img class="" src="images/all/shutterstock_405538501-170x170.png" width="170" height="170" alt="shutterstock_405538501" title="shutterstock_405538501" />
                                                                    </a></div>
                                                                <div class="grid-item col-sm-6 col-md-6 col-lg-3"> <a class="light-box" href="images/all/shutterstock_271948178.png">
                                                                        <div class="overlay-item"> <i class="fa fa-search"></i></div> <img class="" src="images/all/shutterstock_271948178-170x170.png" width="170" height="170" alt="shutterstock_271948178" title="shutterstock_271948178" />
                                                                    </a></div>
                                                                <div class="grid-item col-sm-6 col-md-6 col-lg-3"> <a class="light-box" href="images/all/shutterstock_405538558.png">
                                                                        <div class="overlay-item"> <i class="fa fa-search"></i></div> <img class="" src="images/all/shutterstock_405538558-170x170.png" width="170" height="170" alt="shutterstock_405538558" title="shutterstock_405538558" />
                                                                    </a></div>
                                                                <div class="grid-item col-sm-6 col-md-6 col-lg-3"> <a class="light-box" href="images/all/shutterstock_275208287.png">
                                                                        <div class="overlay-item"> <i class="fa fa-search"></i></div> <img class="" src="images/all/shutterstock_275208287-170x170.png" width="170" height="170" alt="shutterstock_275208287" title="shutterstock_275208287" />
                                                                    </a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main><!-- #main -->
                        </div><!-- #primary -->
                    </div>
                </div>
            </div><!-- #content inner -->
        </div><!-- #content -->
        <?php include 'footer.php'; ?>
        <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
    </div><!-- #page -->
    <style id='style-heading-inline-css' type='text/css'>
        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading .cms-heading-tag {
                font-size: 54px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading .cms-heading-tag {
                font-size: 40px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading .cms-heading-tag {
                font-size: 40px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-2 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-2 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-2 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-3 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-3 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-3 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 1200px) {
            #cms-heading-4 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #cms-heading-4 .cms-heading-tag {
                font-size: 22px !important;
            }
        }

        @media screen and (max-width: 767px) {
            #cms-heading-4 .cms-heading-tag {
                font-size: 22px !important;
            }
        }
    </style>
    <script type='text/javascript' id='service-options-js-extra'>
        /* <![CDATA[ */
        var service_option_ajax = {
            "ajax_url": "https:\/\/demo.cmssuperheroes.com\/themeforest\/wp-tekhfixers\/wp-admin\/admin-ajax.php",
            "nonce": "4fc1fcb589",
            "services": {
                "198": "Water DamageRepair",
                "196": "Home ButtonRepair",
                "194": "SpeakerRepair",
                "192": "CameraRepair",
                "190": "BatteryReplace",
                "182": "ScreenRepair"
            },
            "repairs": {
                "1605": "Keyboard Repair",
                "1604": "Touchpad",
                "1603": "OS Restore",
                "1602": "Button Issue Repair",
                "1601": "Tech 21 Protection Package Plus",
                "1599": "Data Recovery Diagnostics",
                "1598": "Other Issue Diagnostics",
                "1597": "Signal Issue Repair",
                "1596": "Charging Dock Repair",
                "1595": "Rear Camera Repair",
                "1594": "Front Camera Repair",
                "1593": "Audio Issue Repair",
                "1592": "Liquid Diagnostics",
                "1591": "Battery Replacement",
                "1590": "Rear Glass Replacement",
                "1589": "Screen Replacement"
            },
            "price_symbol": "$",
            "warranties": {
                "170": "18 months",
                "169": "12 months",
                "168": "6 months"
            }
        };
        var repair_options = {
            "1605": "Keyboard Repair",
            "1604": "Touchpad",
            "1603": "OS Restore",
            "1602": "Button Issue Repair",
            "1601": "Tech 21 Protection Package Plus",
            "1599": "Data Recovery Diagnostics",
            "1598": "Other Issue Diagnostics",
            "1597": "Signal Issue Repair",
            "1596": "Charging Dock Repair",
            "1595": "Rear Camera Repair",
            "1594": "Front Camera Repair",
            "1593": "Audio Issue Repair",
            "1592": "Liquid Diagnostics",
            "1591": "Battery Replacement",
            "1590": "Rear Glass Replacement",
            "1589": "Screen Replacement"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' id='contact-form-7-js-extra'>
        /* <![CDATA[ */
        var wpcf7 = {
            "api": {
                "root": "https:\/\/demo.cmssuperheroes.com\/themeforest\/wp-tekhfixers\/wp-json\/",
                "namespace": "contact-form-7\/v1"
            },
            "cached": "1"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' id='timetable_main-js-extra'>
        /* <![CDATA[ */
        var tt_config = [];
        tt_config = {
            "ajaxurl": "https:\/\/demo.cmssuperheroes.com\/themeforest\/wp-tekhfixers\/wp-admin\/admin-ajax.php"
        };;
        /* ]]> */
    </script>
    <script type='text/javascript' id='woocommerce-js-extra'>
        /* <![CDATA[ */
        var woocommerce_params = {
            "ajax_url": "\/themeforest\/wp-tekhfixers\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/themeforest\/wp-tekhfixers\/?wc-ajax=%%endpoint%%"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' id='wc-cart-fragments-js-extra'>
        /* <![CDATA[ */
        var wc_cart_fragments_params = {
            "ajax_url": "\/themeforest\/wp-tekhfixers\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/themeforest\/wp-tekhfixers\/?wc-ajax=%%endpoint%%",
            "cart_hash_key": "wc_cart_hash_cebf2917c0ca323a219bf86e7cae31cd",
            "fragment_name": "wc_fragments_cebf2917c0ca323a219bf86e7cae31cd",
            "request_timeout": "5000"
        };
        /* ]]> */
    </script>
    <script defer src="js/main-js.js"></script>
</body>
<!-- Mirrored from demo.cmssuperheroes.com/themeforest/wp-tekhfixers/services/screenrepair/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Jul 2023 06:40:30 GMT -->

</html>