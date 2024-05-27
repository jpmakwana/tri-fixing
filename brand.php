<?php
require_once("connect.php");
// Include your database connection code here
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require './smtp/vendor/autoload.php';
// Create a new PHPMailer instance
$mail = new PHPMailer(true);

$ctable_category = "category";
$ctable_category_where = "id='" . $_REQUEST["category_id"] . "' AND isDelete=0";
$ctable_category_r = $db->rp_getData($ctable_category, "*", $ctable_category_where);
$ctable_category_d = mysqli_fetch_array($ctable_category_r);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['mail_brand_add'] == "mail_brand_add") {

    $email = "makwanajaydip153@gmail.com";
    $brand_name = $_POST['brand_name'];
    $device_name = $_POST['device_name'];
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Your SMTP server address
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jaydip.tritechno@gmail.com';    // Your SMTP username
        $mail->Password   = 'vvdmwqqkybhopnni';    // Your SMTP password
        $mail->SMTPSecure = 'tls';               // Use 'tls' or 'ssl'
        $mail->Port       = 587;                 // Port for TLS: 587, SSL: 465
        // Recipients
        $mail->setFrom('jaydip.tritechno@gmail.com');
        $mail->addAddress('jaydip.tritechno@gmail.com');
        $mail->addReplyTo($email);
        $mail->isHTML(true);
        $mail->Subject = 'GET IN TOUCH';
        $bodyhtmladmin = '<html>
        <center style="width: 100%; background: #F1F1F1; text-align: left;">
           <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
           </div>
           <div style="max-width: 680px; margin: auto;" class="email-container">
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" class="email-container">
                 <tr>
                    <td background="background.png" bgcolor="#222222" align="center" valign="top" style="text-align: center; background-position: center center !important; background-size: cover !important;">
                       <div>
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:500px; margin: auto;">
                             <tr>
                                <td align="center" valign="middle">
                                   <table>
                                      <tr>
                                         <td valign="top" style="text-align: center; padding: 60px 0 10px 20px;">
                                            <h1 style="margin: 0; font-family: Montserrat, sans-serif; font-size: 30px; line-height: 36px; color: #ffffff; font-weight: bold;">WELCOME Admin</h1>
                                         </td>
                                      </tr>
                                   </table>
                                </td>
                             </tr>
                             <tr>
                                <td height="20" style="font-size:20px; line-height:20px;">&nbsp;</td>
                             </tr>
                          </table>
                       </div>
                    </td>
                 </tr>
                 <tr>
                    <td bgcolor="#ffffff">
                       <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                             <td style="padding: 40px 40px 20px 40px; text-align: left;">
                                <h1 style="margin: 0; font-family: Montserrat, sans-serif; font-size: 20px; line-height: 26px; color: #333333; font-weight: bold;">GET IN TOUCH</h1>
                             </td>
                          </tr>
                          <tr>
                             <td style="padding: 0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:bold;">
                                <p style="margin: 0;"></p>
                             </td>
                          </tr>
                          <tr>
                             <td style="padding: 0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                <p style="margin: 0;">
                                <table border="1">

                                   <tr>
                                      <td> &nbsp; <b>Brand</b> &nbsp; </td>
                                      <td> &nbsp; ' . $brand_name . ' &nbsp; </td>
                                   </tr>
                                   <tr>
                                      <td> &nbsp; <b>Device Name</b> &nbsp; </td>
                                      <td> &nbsp; ' . $device_name . ' &nbsp; </td>
                                   </tr>
                                </table>
                                </p>
                             </td>
                          </tr>
                          <tr style="margin-top:20px;">
                             <td style="padding:0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;margin-top:20px;">
                                <p style="margin: 0;"></p>
                             </td>
                          </tr>
                          <tr>
                             <td align="left" style="padding:0px 40px 20px 40px;">
                                <table width="180" align="left">
                                   <tr>
                                      <td width="110">
                                         <table width="" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                               <td align="left" style="font-family: sans-serif; font-size:14px; line-height:20px; color:#222222; font-weight:bold;" class="body-text">
                                                  <p style="font-family: Montserrat, sans-serif; font-size:14px; line-height:20px; color:#222222; font-weight:bold; padding:0; margin:0;" class="body-text">Tri-Fixing</p>
                                               </td>
                                            </tr>
                                            <tr>
                                               <td align="left" style="font-family: sans-serif; font-size:14px; line-height:20px; color:#666666;" class="body-text">
                                               </td>
                                            </tr>
                                         </table>
                                      </td>
                                   </tr>
                                </table>
                             </td>
                          </tr>
                       </table>
                    </td>
                 </tr>
                 <tr>
                    <td bgcolor="#ffffff">
                       <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                             <td style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; text-align: center; font-weight:normal;">
                                <p style="margin: 0;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim, culpa.</p>
                             </td>
                          </tr>
                          <tr>
                             <td style="padding: 0px 40px 40px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; text-align: center; font-weight:normal;">
                                <p style="margin: 0;">Copyright ©2023 <b>Tri-Fixing</p>
                             </td>
                          </tr>
                       </table>
                    </td>
                 </tr>
              </table>
           </div>
        </center>
        </html>';
        $mail->Body = $bodyhtmladmin;
        // Send the email
        $mail->send();
        $db->flash("msg", "Kindly check back after 24 hours to confirm that your data has been successfully inserted.");
        $db->rp_location($_POST['actual_link']);
    } catch (Exception $e) {
        $db->flash("msg-error", "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}
?>
<!doctype html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title>Tri-fixing &#8211; Mobile Device and Electronics Repair </title>
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
        footer.site-footer {
            background: linear-gradient(90deg, #022243 0%, #083260 100%);
            background: -moz-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -webkit-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -o-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -ms-linear-gradient(0deg, #022243 0%, #083260 100%)
        }
    </style>
    <style type="text/css" data-type="vc_shortcodes-custom-css">
        .vc_custom_1561345237749 {
            padding-top: 30px !important;
            padding-bottom: 30px !important;
        }

        .vc_custom_1541521972917 {
            margin-bottom: 55px !important;
        }

        .vc_custom_1541522086706 {
            margin-bottom: 55px !important;
        }

        .addbrand {
            border: 1px solid #e3e6ea;
            background: #fff;
            border-radius: 25px;
            transition: all ease-in-out 0.3s;
        }

        .add-plus-icon {
            background-color: transparent;
            color: #07305e;
            height: 45px;
            width: 45px;
            font-size: 22px;
            z-index: 999;
            border-radius: 50%;
            border: 1px solid;
        }

        .icon-center {
            left: 0;
            position: sticky;
            right: 0;
            top: 50%;
            transform: translate(0, -50%);
        }
    </style>
    <noscript>
        <style>
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }
        </style>
    </noscript>
    <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>

    <style>
        .custom-css-plus {
            display: inline-block;
            font: normal normal normal 14px/1 "Material-Design-Iconic-Font";
            font-size: 22px;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            padding: 12.5px 17px;
            border: 1px #083260 solid;
            border-radius: 50px;
        }
    </style>
    <script defer type="text/javascript" src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/toastr.min.css">
</head>

<body class="page-template-default page page-id-1462 theme-tekhfixers woocommerce-no-js visual-composer wpb-js-composer js-comp-ver-6.8.0 vc_responsive"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
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
            <?php include("header.php"); ?>
            <div class="page-title-container">
                <div id="pagetitle" class="page-title page-title-layout1 has-subtitle">
                    <div class="container">
                        <div class="page-title-inner">
                            <div class="page-title-content clearfix">
                                <!-- <span class="back-link">Fix Your Mobile Device</span>
                                <h1 class="page-title ft-heading-b"><?php echo $ctable_category_d["category_name"] ?></h1> -->
                                <div class="row">
                                    <div class="col-12 main-bar-custom pt-45 pb-20">
                                        <div class="row justify-content-between">
                                            <div class="select-bar completed-bar">
                                                <span class="is-complete-bar"></span>
                                                <p>Select Repair<br> Category<br></p>
                                            </div>
                                            <div class="select-bar ">
                                                <span class="is-complete-bar"></span>
                                                <p>Select Repair<br> Brand<br></p>
                                            </div>
                                            <div class="select-bar">
                                                <span class="is-complete-bar"></span>
                                                <p>Select Repair<br> Modal<br></p>
                                            </div>
                                            <div class="select-bar">
                                                <span class="is-complete-bar"></span>
                                                <p>Select Repair <br>Problem</p>
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
        <div id="content" class="site-content">
            <div class="content-inner">
                <svg style="fill: #B8F6DB; top:0px;" id="svg-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="195.875" height="1318.28" viewBox="0 0 195.875 1318.28">
                    <defs>
                        <filter id="gradient-overlay-2" filterUnits="userSpaceOnUse">
                            <feImage x="-829.406" y="0" width="1025.281" height="1318.2800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTAyNS4yODEiIGhlaWdodD0iMTMxOC4yODAwMDAwMDAwMDAyIj48bGluZWFyR3JhZGllbnQgaWQ9ImdyYWQiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB5MT0iMTQ2LjUiIHgyPSIxMDI1LjI4IiB5Mj0iMTE3MS43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMWJkZDg4Ii8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMzJlYjlhIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #B8F6DB" d="M-540.968,20.684 C-540.968,20.684 -687.378,86.487 -694.760,174.843 C-702.142,263.200 -643.186,274.374 -667.132,338.769 C-691.079,403.164 -765.483,413.324 -785.981,496.763 C-807.750,585.376 -722.107,571.956 -727.171,690.819 C-732.235,809.683 -978.187,852.597 -688.556,1167.735 C-398.925,1482.874 -139.906,1235.432 -115.898,1040.448 C-91.891,845.463 42.695,803.563 95.851,754.793 C149.006,706.023 316.246,497.102 46.140,203.210 C-223.966,-90.683 -540.968,20.684 -540.968,20.684 Z" class="cls-2" />
                </svg>
                <svg style="bottom:0px" id="svg-bottom" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="446.28" height="1030.78" viewBox="0 0 446.28 1030.78">
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
                        <div id="primary" class="content-area content-full-width col-12">
                            <main id="main" class="site-main">
                                <article id="post-1462" class="post-1462 page type-page status-publish hentry">
                                    <div class="entry-content clearfix">
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-offset-2 vc_col-lg-8 vc_col-md-offset-2 vc_col-md-8">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div id="cms-heading" class="cms-heading  align-left align-left-md align-left-sm align-left-xs ">
                                                            <h3 class="cms-heading-tag     " style="margin-bottom:20px;color:#083260;font-size:54px;letter-spacing:-.016em;text-transform:none;font-weight:400;font-style:normal;display:inline-block;text-transform: capitalize; "> Select your <?php echo $ctable_category_d["category_name"] ?></h3>
                                                        </div>
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <p>Suspendisse porta eros et massa luctus, quis malesuada sapien aliquet. Proin venenatis turpis non felis consequat rhoncus. Maecenas varius nunc sed porttitor lacinia. Aliquam facilisis ipsum vel eros lobortis, non iaculis nibh vulputate. Curabitur sagittis fermentum diam, ut maximus diam dignissim eget.</p>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1561345237749">
                                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div id="fr-grid-device-category" class="cms-grid fr-grid fr-grid-device-category default  ">
                                                                            <div class="row">
                                                                                <?PHP
                                                                                $ctable = "brand";
                                                                                $ctable_cat_where = "category_id='" . $_REQUEST["category_id"] . "' AND isDelete=0";
                                                                                $ctable_r = $db->rp_getData($ctable, "*", $ctable_cat_where);
                                                                                if (mysqli_num_rows($ctable_r) > 0) {
                                                                                    if ($ctable_r) {
                                                                                        while ($ctable_d = mysqli_fetch_array($ctable_r)) {
                                                                                ?>
                                                                                            <div class="repair-item col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                                                                                <div class="image-item">
                                                                                                    <a href="model.php?category_id=<?php echo $ctable_d['category_id']; ?>&brand_id=<?php echo $ctable_d['id']; ?>">
                                                                                                        <img src="<?php echo BRAND_IMAGE_SITE_A . $ctable_d['image_path']; ?>" alt="Iphone">
                                                                                                    </a>
                                                                                                </div>
                                                                                                <h3>
                                                                                                    <a href="model.php?category_id=<?php echo $ctable_d['category_id']; ?>&brand_id=<?php echo $ctable_d['id']; ?>">
                                                                                                        <?php echo stripslashes($ctable_d['brand_name']); ?>
                                                                                                    </a>
                                                                                                </h3>
                                                                                            </div>
                                                                                <?php
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    echo "<h2>No Images Found.</h2>";
                                                                                }
                                                                                ?>
                                                                                <div class="repair-item col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 addbrand text-center d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                                                                                    <div>
                                                                                        <i class="icon-center custom-css-plus zmdi zmdi-plus"></i>
                                                                                        <button type="button" class="btn btn-primary" style="color: #ffffff!important;">Add Brand</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Other Phone (Mail to admin)</h5>
                                                                        <button type="button" class="close bg-transparent" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <style>
                                                                        .error {
                                                                            font-weight: 400;
                                                                            color: #ff0000 !important;
                                                                            text-align: center;
                                                                        }
                                                                    </style>
                                                                    <form method="post" autocomplete="off" id="target" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                                        <div class="modal-body">
                                                                            <div class="container-fluid">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="brand_name" class="col-form-label">Brand : </label>
                                                                                            <input type="text" name="brand_name" class="form-control" id="brand_name">
                                                                                            <div class="error" id="brand_nameError"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="device_name" class="col-form-label">Device name : </label>
                                                                                            <input type="text" name="device_name" class="form-control" id="device_name">
                                                                                            <div class="error" id="device_nameError"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <p>
                                                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis asperiores illo repellat recusandae corrupti natus animi quibusdam? Reiciendis, sit voluptatibus.
                                                                                    </p>
                                                                                    <input type="hidden" id="mail_brand_add" name="mail_brand_add" value="mail_brand_add">

                                                                                    <input type="hidden" id="actual_link" name="actual_link" value="<?php echo "$actual_link" ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary" onclick="return addRefferal()">Send Mail</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <style>
                                                            .modal-backdrop {
                                                                position: relative;
                                                            }

                                                            .modal.show .modal-dialog {
                                                                display: flex;
                                                                -ms-flex-align: center;
                                                                align-items: center;
                                                                min-height: calc(100% - 1rem);
                                                            }
                                                        </style>

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
                                    </div><!-- .entry-content -->
                                </article><!-- #post-1462 -->
                            </main><!-- #main -->
                        </div><!-- #primary -->
                    </div>
                </div>
            </div>
            <!-- #content inner -->
        </div><!-- #content -->
        <?php include("footer.php"); ?> <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
    </div><!-- #page -->
    <script src="js/jquery.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script>
        function addRefferal() {
            var brand_name = $.trim($("#brand_name").val());
            var device_name = $.trim($("#device_name").val());
            $("#brand_nameError").html('');
            $("#device_nameError").html('');

            if (brand_name == '') {
                document.getElementById("brand_nameError").style.marginTop = "-25px";
                $("#brand_nameError").html('Enter Your Brand');
                $("#brand_name").focus();
                return false;
            } else if (device_name == '') {
                document.getElementById("device_nameError").style.marginTop = "-25px";
                $("#device_nameError").html('Enter Your Device');
                $("#device_name").focus();
                return false;
            } else {
                $("#target").submit();
            }
        }
    </script>
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