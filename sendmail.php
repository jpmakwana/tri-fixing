<?php

$honeypot = $_POST['honeypot'];

if (!empty($honeypot)) {
    return; //you may add code here to echo an error etc.
} else {
    error_reporting(0);

    if (isset($_POST['fname']) && isset($_POST['email'])) {


        $to = "upedgeglobal@gmail.com";

        $subject = 'GET IN TOUCH';

        $message = '<html>
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

        $message1 = '<html>   
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
                                         <img src="https://upedgeglobal.com/images/updage-logo.png" alt="Updage-logo" style=" width: 100%;
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
                                <h1 style="margin: 0; font-family: Montserrat, sans-serif; font-size: 20px; line-height: 26px; color: #333333; font-weight: bold;text-transform: capitalize;">Dear ' . $_POST['fname'] . ' ' . $_POST['lname'] . ', </h1></td>
                        </tr>
                        
                       
                        <tr style="margin-top:20px;">
                            <td style="padding:0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;margin-top:20px;">
                                <p style="margin: 0;">Thank you for showing interest in Upedge Services.</p>
                            </td>
                        </tr>
                        <tr style="margin-top:20px;">
                            <td style="padding:0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;margin-top:20px;">
                                <p style="margin: 0;">We will be getting in touch with you shortly.</p>
                            </td>
                        </tr>

                        <tr style="margin-top:20px;">
                        <td style="padding:0px 40px 20px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;margin-top:20px;">
                            <p style="margin: 0;">With regards,</p>
                        </td>
                    </tr>

                        <tr>
                                <td style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666;  font-weight:normal;">
                                    <p style="margin: 0;">Email - contact@upedgeglobal.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666;  font-weight:normal;">
                                    <p style="margin: 0;">Website - www.upedgeglobal.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 40px 10px 40px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #666666; font-weight:normal;">
                                    <p style="margin: 0;">Australia No. : <a href="tel:+61-261720720" >+61261720720</a>  </p>
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
                                    <p style="margin: 0;">Copyright ©2023 <b>Upedge Global Pvt. Ltd</p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
               </table>
           </div>
  </center>
</html>';


        $from =  $_POST['email'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <' . $from . '>' . "\r\n";
        $headers .=  'Reply-To:' . $from  . "\r\n" .
            $mail = mail($to, $subject, $message, $headers);

        $headers1 = "MIME-Version: 1.0" . "\r\n";
        $headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers1 .= 'From: <' . $to . '>' . "\r\n";

        $headers1 .=  'Reply-To: ' . $to . "\r\n" .
            $mail1 = mail($from, $subject, $message1, $headers1);
    }
}
//Send the form
