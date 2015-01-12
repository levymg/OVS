<?php

class Email_mdl extends MY_Model {
    
    
    public function __construct()
    {
        
        parent::__construct();
        
    }
    
    
    public function send_verify_email($data)
    {
        
        $user_hash = $data;
        
        $message = "
                            <html>
                                <body>
                                <table style='background-color:#000;max-width:600px;width:600px;min-width:600px;border:1px solid #ccc;' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td>
                                            <table style='background-color:#000;border-bottom:3px solid #e01e26' cellpadding='0' cellspacing='0'>
                                                <tr>
                                                    <td style='background-color:#000 !important;'>
                                                            <img src='http://www.generalcarbide.com/images/mobile-logo.gif' alt='Welcome to General Carbide Mobile' title='Welcome to General Carbide Mobile' />
                                                    </td>
                                                </tr>
                                                </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style='background-color:#fff;' cellpadding='4' cellspacing='4'>
                                                    <tr>
                                                        <td style='width:50%;vertical-align=top;' valign='top'>
                                                            <h2 style='color:#e01e26;'>Welcome to General Carbide Mobile " . $data . ",</h2>

                                                             <p style='color:#000;'>
                                                                      You have registered and completed your profile with the General Carbide Toolbox.
                                                             </p>
                                                             
                                                             <p style='color:#000;'>
                                                                Please <a style='color:#e01e26;' href='http://www.generalcarbide.com/api/index.php/verify?token=" . $user_hash . "' target='_blank'>verify your e-mail address.</a>
                                                             </p>

                                                              <h2 style='color:#e01e26;'>General Carbide ToolBox</h2>

                                                              <ul style='color:#000;'>
                                                                  <li>Participate in the General Carbide Q&A; all your questions answered directly from your smartphone</li>
                                                                  <li>Download our grade specifications based on your application needs</li>
                                                                  <li>Do other fun stuff that is cool lorem ipsum whatever</li>
                                                              </ul>
                                                              
                                                              <p style='color:#000;'>
                                                                      Sincerely,<br /><br />
                                                                      The General Carbide Team
                                                              </p>
                                                        </td>
                                                        <td style='width:50%;'>
                                                                <img src='http://www.generalcarbide.com/images/iphone.png' alt='Welcome to General Carbide Mobile' title='Welcome to General Carbide Mobile' />
                                                        </td>
                                                    </tr>
                                                </table>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td style='background-color:#e01e26;vertical-align:middle;height:50px;'>
                                            <center>
                                                <h5 style='color:#fff'>1151 Garden Street • Greensburg, PA 15601-6417 • Tel: 800-245-2465 • Fax: 800-547-2659 • <a style='color:#fff!important;' href='http://www.generalcarbide.com/'>www.genneralcarbide.com</a></h5>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                                </body>
                            </html>
                            
            ";
        
        $this->_sendmail($data, $message);
        
    }
    
     public function welcome_email($data)
    {
        
        $message = "
                            <html>
                                <body>
                                <table style='background-color:#000;max-width:600px;width:600px;min-width:600px;border:1px solid #ccc;' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td>
                                            <table style='background-color:#000;border-bottom:3px solid #e01e26' cellpadding='0' cellspacing='0'>
                                                <tr>
                                                    <td style='background-color:#000 !important;'>
                                                            <img src='http://www.generalcarbide.com/images/mobile-logo.gif' alt='Welcome to General Carbide Mobile' title='Welcome to General Carbide Mobile' />
                                                    </td>
                                                </tr>
                                                </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style='background-color:#fff;' cellpadding='4' cellspacing='4'>
                                                    <tr>
                                                        <td style='width:50%;vertical-align=top;' valign='top'>
                                                            <h2 style='color:#e01e26;'>Welcome to General Carbide Mobile " . $data["first_name"] . ",</h2>

                                                             <p style='color:#000;'>
                                                                      You have registered with the General Carbide Toolbox.  Your username is " . $data["email"] . " and your password is " . $data["password"] . ".  You may login to the General Carbide Toolbox to change your password and account settings.
                                                             </p>
                                                             
                                                              <h2 style='color:#e01e26;'>General Carbide ToolBox</h2>

                                                              <ul style='color:#000;'>
                                                                  <li>Participate in the General Carbide Q&A; all your questions answered directly from your smartphone</li>
                                                                  <li>Download our grade specifications based on your application needs</li>
                                                                  <li>Do other fun stuff that is cool lorem ipsum whatever</li>
                                                              </ul>
                                                              
                                                              <p style='color:#000;'>
                                                                      Sincerely,<br /><br />
                                                                      The General Carbide Team
                                                              </p>
                                                        </td>
                                                        <td style='width:50%;'>
                                                                <img src='http://www.generalcarbide.com/images/iphone.png' alt='Welcome to General Carbide Mobile' title='Welcome to General Carbide Mobile' />
                                                        </td>
                                                    </tr>
                                                </table>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td style='background-color:#e01e26;vertical-align:middle;height:50px;'>
                                            <center>
                                                <h5 style='color:#fff'>1151 Garden Street • Greensburg, PA 15601-6417 • Tel: 800-245-2465 • Fax: 800-547-2659 • <a style='color:#fff!important;' href='http://www.generalcarbide.com/'>www.genneralcarbide.com</a></h5>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                                </body>
                            </html>
                            
            ";
        
        $this->_sendmail($data["email"], $message);
        
    }
    
    
    private function _sendmail($data, $message, $attachments = NULL)
    {
        
           $config = array(
                            'protocol' => 'smtp',
                            'smtp_host' => 'mail.emailsrvr.com',
                            'smtp_port' => 25,
                            'smtp_user' => 'megator@levymg-mailserver.com',
                            'smtp_pass' => 'LmgMEG2014',
                            );

            $this->load->library('email', $config); 
            $this->email->from("noreply@generalcarbide.com", "General Carbide Toolbox");
            $this->email->reply_to("noreply@generalcarbide.com", "Noreply");
            $this->email->to($data);
            $this->email->subject("Welcome to the General Carbide Toolbox!");
            $this->email->message($message);
            $this->email->send();
        
        return true;
        
    }
    
    
}