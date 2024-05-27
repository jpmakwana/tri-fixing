<?php
include("connect.php");
// Include your database connection code here
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require './smtp/vendor/autoload.php';
// Create a new PHPMailer instance
$mail = new PHPMailer(true);
$usermail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $logo = SITEURL . 'images/logo-blue.png';
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
                                      <td> &nbsp; <b>Name</b> &nbsp; </td>
                                      <td> &nbsp; ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' &nbsp;</td>
                                   </tr>
                                   <tr>
                                      <td> &nbsp; <b>Email</b> &nbsp; </td>
                                      <td> &nbsp; ' . $_POST['email'] . ' &nbsp; </td>
                                   </tr>
                                   <tr>
                                      <td> &nbsp; <b>Phone Number</b> &nbsp; </td>
                                      <td> &nbsp; ' . $_POST['phone'] . ' &nbsp; </td>
                                   </tr>
                                   <tr>
                                      <td> &nbsp; <b>Message</b> &nbsp; </td>
                                      <td> &nbsp; ' . $_POST['message'] . ' &nbsp; </td>
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
        $db->flash("msg", "Mail Send Successfully.");
    } catch (Exception $e) {
        $db->flash("msg-error", "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
    try {
        // Server settings
        $usermail->isSMTP();
        $usermail->Host       = 'smtp.gmail.com'; // Your SMTP server address
        $usermail->SMTPAuth   = true;
        $usermail->Username   = 'jaydip.tritechno@gmail.com';    // Your SMTP username
        $usermail->Password   = 'vvdmwqqkybhopnni';    // Your SMTP password
        $usermail->SMTPSecure = 'tls';               // Use 'tls' or 'ssl'
        $usermail->Port       = 587;                 // Port for TLS: 587, SSL: 465
        // Recipients
        $usermail->setFrom($email);
        $usermail->addAddress($email);
        $usermail->addReplyTo('jaydip.tritechno@gmail.com');
        $usermail->isHTML(true);
        $usermail->Subject = 'GET IN TOUCH';
        $bodyhtmluser = '<html>
        <center style="width: 100%; background: #F1F1F1; text-align: left;">
            <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            </div>
            <div style="max-width: 680px; margin: auto;" class="email-container">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" class="email-container">
                    <tr>
                        <td background="background.png" bgcolor="#ffffff" align="center" valign="top" style="text-align: center; background-position: center center !important; background-size: cover !important;">
                            <div>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:500px; margin: auto;">
                                    <tr>
                                        <td align="center" valign="middle">
                                            <table>
                                                <tr>
                                                    <td valign="top" style="text-align: center; padding: 60px 0 10px 20px;">
                                                        <img src="' . $logo . '" alt="trifixing-logo" style=" width: 100%;
                                                                height: auto;">
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
                                        <h1 style="margin: 0; font-family: Montserrat, sans-serif; font-size: 20px; line-height: 26px; color: #333333; font-weight: bold;text-transform: capitalize;">Dear ' . $first_name . ' ' . $last_name . ', </h1>
                                    </td>
                                </tr>
                                <tr style="margin-top:20px;">
                                    <td style="padding:0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;margin-top:20px;">
                                        <p style="margin: 0;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci quam ex quo exercitationem ipsam, veritatis excepturi magnam enim alias iste.</p>
                                    </td>
                                </tr>
                                <tr style="margin-top:20px;">
                                    <td style="padding:0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;margin-top:20px;">
                                        <p style="margin: 0;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci quam ex quo exercitationem ipsam, veritatis excepturi magnam enim alias iste.</p>
                                    </td>
                                </tr>
                                <tr style="margin-top:20px;">
                                    <td style="padding:0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;margin-top:20px;">
                                        <p style="margin: 0;">With regards,</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666;  font-weight:normal;">
                                        <p style="margin: 0;">Email - demo@gamil.com</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666;  font-weight:normal;">
                                        <p style="margin: 0;">Website - http://tri-fixing.com/</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; font-weight:normal;">
                                        <p style="margin: 0;">India No. : <a href="tel:+61-0000000000">+0000000000</a> </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
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
        $usermail->Body = $bodyhtmluser;
        // Send the email
        $usermail->send();
        // $db->flash("msg", "Mail Send Successfully.");
    } catch (Exception $e) {
        $db->flash("msg-error", "Message could not be sent. Mailer Error: {$usermail->ErrorInfo}");
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <title>Contact Us &#8211; Tri-fixing &#8211; Mobile Device and Electronics Repair </title>
    <link rel="stylesheet" href="css/main-style.css" media="all" />

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
    <link rel="stylesheet" id="woocommerce-smallscreen-css" href="css/woocommerce-smallscreen.min.css" type="text/css" media="only screen and (max-width: 768px)" />
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
    <style id="cms-page-dynamic-css" data-type="redux-output-css">
        footer.site-footer {
            background: linear-gradient(90deg, #022243 0%, #083260 100%);
            background: -moz-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -webkit-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -o-linear-gradient(0deg, #022243 0%, #083260 100%);
            background: -ms-linear-gradient(0deg, #022243 0%, #083260 100%);
        }
    </style>
    <style type="text/css" data-type="vc_shortcodes-custom-css">
        .vc_custom_1548669921817 {
            margin-bottom: 51px !important;
        }

        .vc_custom_1543398798675 {
            margin-bottom: 50px !important;
        }
    </style>
    <noscript>
        <style>
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }
        </style>
    </noscript>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/toastr.min.css">
</head>

<body class="page-template-default page page-id-38 theme-tekhfixers woocommerce-no-js visual-composer wpb-js-composer js-comp-ver-6.8.0 vc_responsive">
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
            <div class="page-title-container">
                <div id="pagetitle" class="page-title page-title-layout1">
                    <div class="container">
                        <div class="page-title-inner">
                            <div class="page-title-content clearfix">
                                <h1 class="page-title ft-heading-b">Contact Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="site-content">
            <div class="content-inner">
                <svg style="fill: #b8f6db; top: 0px;" id="svg-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="195.875" height="1318.28" viewBox="0 0 195.875 1318.28">
                    <defs>
                        <filter id="gradient-overlay-2" filterUnits="userSpaceOnUse">
                            <feImage x="-829.406" y="0" width="1025.281" height="1318.2800000000002" preserveAspectRatio="none" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTAyNS4yODEiIGhlaWdodD0iMTMxOC4yODAwMDAwMDAwMDAyIj48bGluZWFyR3JhZGllbnQgaWQ9ImdyYWQiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB5MT0iMTQ2LjUiIHgyPSIxMDI1LjI4IiB5Mj0iMTE3MS43OCI+CiAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjMWJkZDg4Ii8+CiAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMzJlYjlhIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=" />
                            <feComposite operator="in" in2="SourceGraphic" />
                            <feBlend in2="SourceGraphic" result="gradientFill" />
                        </filter>
                    </defs>
                    <path style="fill: #b8f6db;" d="M-540.968,20.684 C-540.968,20.684 -687.378,86.487 -694.760,174.843 C-702.142,263.200 -643.186,274.374 -667.132,338.769 C-691.079,403.164 -765.483,413.324 -785.981,496.763 C-807.750,585.376 -722.107,571.956 -727.171,690.819 C-732.235,809.683 -978.187,852.597 -688.556,1167.735 C-398.925,1482.874 -139.906,1235.432 -115.898,1040.448 C-91.891,845.463 42.695,803.563 95.851,754.793 C149.006,706.023 316.246,497.102 46.140,203.210 C-223.966,-90.683 -540.968,20.684 -540.968,20.684 Z" class="cls-2" />
                </svg>
                <div class="container content-container">
                    <div class="row content-row">
                        <div id="primary" class="content-area content-full-width col-12">
                            <main id="main" class="site-main">
                                <article id="post-38" class="post-38 page type-page status-publish hentry">
                                    <div class="entry-content clearfix">
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-8 vc_col-md-8">
                                                <div class="vc_column-inner vc_custom_1543398798675">
                                                    <div class="wpb_wrapper">
                                                        <div class="fr-contact-form fr-contact-form-default">
                                                            <h3>Get In Touch</h3>
                                                            <div class="wpcf7 no-js" lang="en-US" dir="ltr">
                                                                <style>
                                                                    .wpcf7-response-output-1 {
                                                                        margin: 2em 0.5em 1em;
                                                                        padding: 0.2em 1em;
                                                                        border: 2px solid #46b450;
                                                                        text-align: center;
                                                                        font-style: italic;
                                                                    }

                                                                    .wpcf7-response-output-2 {
                                                                        margin: 2em 0.5em 1em;
                                                                        padding: 0.2em 1em;
                                                                        border: 2px solid #ffb900;
                                                                        text-align: center;
                                                                        font-style: italic;
                                                                    }


                                                                    .error {
                                                                        color: #ff0000;

                                                                    }

                                                                    .fr-contact-form-default .wpcf7-form input:focus,
                                                                    .fr-contact-form-default .wpcf7-form textarea:focus {
                                                                        border-color: red;
                                                                    }
                                                                </style>

                                                                <form method="post" id="target" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="wpcf7-form init" aria-label="Contact form" novalidate="novalidate" data-status="init">
                                                                    <p>
                                                                        <span class="wpcf7-form-control-wrap" data-name="first_name">
                                                                            <input size="40" class="wpcf7-form-control wpcf7-text" aria-required="true" aria-invalid="false" placeholder="First Name" value="" type="text" name="first_name" id="first_name" />
                                                                        </span>
                                                                        <span class="wpcf7-form-control-wrap" data-name="last_name">
                                                                            <input size="40" class="wpcf7-form-control wpcf7-text" aria-required="true" aria-invalid="false" placeholder="Last Name" value="" type="text" name="last_name" id="last_name" />
                                                                        </span>
                                                                        <span class="wpcf7-form-control-wrap" data-name="email">
                                                                            <input size="40" class="wpcf7-form-control wpcf7-text wpcf7-email" aria-required="true" aria-invalid="false" placeholder="Email Address" value="" type="email" name="email" id="email" />
                                                                        </span>
                                                                        <span class="wpcf7-form-control-wrap" data-name="phone">
                                                                            <input type="text" placeholder="Enter Your Number" value="" aria-required="true" aria-invalid="false" minlength="10" maxlength="10" name="phone" id="phone" data-name="Phone" onkeypress='return isNumberKey(event)' class="wpcf7-form-control wpcf7-text wpcf7-tel" />

                                                                        </span>
                                                                        <span class="wpcf7-form-control-wrap" data-name="message">
                                                                            <textarea class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Your Message" id="message" name="message" style="height: 60px;"></textarea>
                                                                        </span>

                                                                        <a type="submit" onclick="return addRefferal()" target="_self" class="wpcf7-submit btn btn-default size-default  wpb_bounceInDown bounceInDown">
                                                                            Send Message <i class="fa fa-angle-right"></i>
                                                                        </a>
                                                                    </p>
                                                                    <div class="wpcf7-response-output-1">
                                                                        Thank you for your message. It has been sent.
                                                                    </div>
                                                                    <div class="wpcf7-response-output-2">
                                                                        <label id="first_nameError"></label>
                                                                        <label id="last_nameError"></label>
                                                                        <label id="emailError"></label>
                                                                        <label id="phoneError"></label>
                                                                        <label id="messageError"></label>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-4 vc_col-md-4">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="fr-contact-info-default">
                                                            <div class="content">
                                                                <h3>Find Us</h3>
                                                                <h4>TekhFixers</h4>
                                                                <p>
                                                                    Tri-Techno IT HUB 702, SANTORINI SQUARE, Prernatirth Derasar Rd, near Abhishree Complex, Jodhpur Village, Ahmedabad, Gujarat 380015
                                                                </p>
                                                                <h4>Open Hours</h4>
                                                                <table>
                                                                    <tr>
                                                                        <td>Mon-Fri</td>
                                                                        <td>8:30am - 5:30pm</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sat</td>
                                                                        <td>10:00am - 3:30pm</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sun</td>
                                                                        <td>Appointment Only</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <ul class="cms-social">
                                                                <li>
                                                                    <a href="#"><i class="zmdi zmdi-facebook"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="zmdi zmdi-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="zmdi zmdi-youtube"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><i class="fa fa-snapchat-ghost"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1548669921817">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="fr-call-to-action default style2">
                                                            <div class="fr-cta-content">
                                                                <h3>Are You Sending a Device to Us?</h3>
                                                                <p>Please remember to insure your package as we cannot accept responsibility for any devices that are lost in transit.</p>
                                                            </div>
                                                            <div class="fr-cta-button">
                                                                <a href="#" target="_self" class="btn"> Frequent Questions <i class="fa fa-angle-right"></i> </a>
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
                                                        <div class="fr-google-map style-default">
                                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14687.747333044208!2d72.52375!3d23.0260914!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e857698be7afd%3A0x33bddd9603bdf357!2sTri-Techno%20IT%20HUB!5e0!3m2!1sen!2sin!4v1692166556259!5m2!1sen!2sin" width="100%" height="390" style="border:0;    margin-bottom: -7px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .entry-content -->
                                </article>
                                <!-- #post-38 -->
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


    <script>
        $(".wpcf7-response-output-1").hide();
        $(".wpcf7-response-output-2").hide();

        function addRefferal() {
            var first_name = $.trim($("#first_name").val());
            var last_name = $.trim($("#last_name").val());
            var email = $.trim($("#email").val());
            var phone = $.trim($("#phone").val());
            var message = $.trim($("#message").val());
            $("#first_nameError").html('');
            $("#last_nameError").html('');
            $("#phoneError").html('');
            $("#emailError").html('');
            $("#messageError").html('');
            if (first_name == '') {
                $("#first_nameError").html('Please enter your First Name');
                $("#first_name").focus();
                $(".wpcf7-response-output-2").show('#first_nameError');
                return false;
            } else if (last_name == '') {
                $("#last_nameError").html('Please enter your Last Name');
                $("#last_name").focus();
                $(".wpcf7-response-output-2").show('#last_nameError');
                return false;
            } else if (email == '') {
                $("#emailError").html('Please Enter your Email');
                $("#email").focus();
                $(".wpcf7-response-output-2").show('#emailError');
                return false;
            } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
                $("#emailError").html('You have entered a valid email address!');
                $("#email").focus();
                $(".wpcf7-response-output-2").show('#emailError');
                return false;
            } else if (phone.length < 10) {
                $("#phoneError").html('You have entered a valid phone number!');
                $("#phone").focus();
                $(".wpcf7-response-output-2").show('#phoneError');
                return false;
            } else if (message == '') {
                $("#messageError").html('Please Enter your message');
                $("#message").focus();
                $(".wpcf7-response-output-2").show('#messageError');
                return false;
            } else {
                $("#target").submit();
                // var data = {
                //     first_name: $("#first_name").val(),
                //     last_name: $("#last_name").val(),
                //     email: $("#email").val(),
                //     phone: $("#phone").val(),
                //     message: $("#message").val()
                // };
                // jQuery.ajax({
                //     url: "sendmail.php",
                //     data: data,
                //     type: "POST",
                //     success: function(data) {
                //         $(".wpcf7-response-output-2").hide();
                //         $(".wpcf7-response-output-1").show();
                //         setTimeout(function() {
                //             location.reload(true);
                //         }, 4000);
                //     },
                //     error: function() {}
                // });
            }
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9YKb-KmokX_b8Ea6hKRVpKhdtjIXq3h8&amp;ver=3.0.0" id="maps-googleapis-js"></script>
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