<?php

class Email_mdl extends MY_Model {
    
    
    public function __construct()
    {
        
        parent::__construct();
        
    }
    
    public function reset_password($data)
    {
        
        $email = $data["email"];
        
        $new_password = $data["new_password"];
        
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
                                                            <h2 style='color:#e01e26;'>General Carbide Toolbox Password Reset Request,</h2>

                                                             <p style='color:#000;'>
                                                                      You have requested a password reset from the General Carbide Toolbox.
                                                             </p>
                                                             
                                                             <p style='color:#000;'>
                                                               Your new password is <span style='color:#e01e26;'>" . $new_password . ".</span>
                                                             </p>
                                                             
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
        
        $subject = "General Carbide Toolbox Password Reset Request";
        
        $this->_sendmail($email, $subject, $message);
        
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
        
        $subject = "Explore the General Carbide Toolbox";
        
        $this->_sendmail($data, $subject, $message);
        
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
        
        $subject = "Welcome to the General Carbide Toolbox!";
        
        $this->_sendmail($data["email"], $subject, $message);
        
    }
    
    public function send_gradesheets($data, $gradesheets, $selections = NULL)
    {
        
        if($selections)
        {
            
            $print_selections = implode(",", $selections);
            
            $print_grades = implode(",",$gradesheets);
        
        }
        
        else
        {
            
            $print_selections = "Requested from your account homepage.";
            
            $print_grades = implode(",",$gradesheets);
            
        }
        
        foreach($selections as $key => $selection)
        {
            
            if($key === 0)
            {
                
                $this->db->select("industry_name");
                
                $this->db->where("resource_id", $selection);
                
                $query = $this->db->get("gc_industries");
                
                $row = $query->row();
                
                $print_selections = "<table style='border:1px solid #ccc;'><tr><th style='background-color:#000;color:#fff;font-weight:800;padding:8px;'>" . $row->industry_name . "</th></tr>";
                
            }
            
            if($key === 1 || $key === 2 || $key === 3)
            {
                
                switch($key)
                {
                    case 1:
                        
                        $key = "Impact Resistance";
                        
                        break;
                    
                    case 2:
                        
                        $key = "Corrosion Resistance";
                        
                        break;
                    
                    case 3:
                        
                        $key = "Gall/Adhesive Resistance";
                        
                        break;
                    
                    case 5:
                        
                        $key = "Wire/WEDM";
                        
                        break;
                }
                
                switch($selection)
                {
                    
                    case 1:
                        
                        $selection = "Not Important";
                        
                        break;
                    
                    case 2:
                        
                        $selection = "Somewhat Important";
                        
                        break;
                    
                    case 3:
                        
                        $selection = "Very Important";
                        
                        break;
                    
                    case 4:
                        
                        $key = "Wire/WEDM";
                        
                        $selection = "Yes";
                        
                        break;
                    
                    case 5:
                        
                        $key = "Wire/WEDM";
                        
                        $selection = "No";
                }
                
                $print_selections .= "<tr><td><strong>" . $key . "</strong>: " . $selection . "</td></tr>";
                
            }
           
        }
        
        $print_selections .= "</table>";
        
        $message = "<html>
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
                                                            <h2 style='color:#e01e26;'>General Carbide Toolbox,</h2>

                                                             <p style='color:#000;'>
                                                                 A request has been made for the gradesheets: <strong> " . $print_grades . " </strong>
                                                             </p>
                                                             
                                                             <p style='color:#000;'>You have made the following selections:</p>
                                                             
                                                             " . $print_selections . "
                                                             
                                                             <p style='color:#000;'>
                                                                The application data is attahced to this e-mail in PDF format.
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
                                                                <img src='http://www.generalcarbide.com/images/iphone-gs.png' alt='Welcome to General Carbide Mobile' title='Welcome to General Carbide Mobile' />
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
                            </html>";
        
        $subject = "General Carbide Gradesheet Request: " . $print_grades;
        
        $this->_sendmail($data, $subject, $message, $gradesheets);
        
    }
    
    public function send_user_gradesheets($email, $gradesheets)
    {
        
        $print_selections = "Requested from your account homepage.";
            
        $print_grades = implode(",", $gradesheets);
        
        $message = "<html>
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
                                                            <h2 style='color:#e01e26;'>General Carbide Toolbox,</h2>

                                                             <p style='color:#000;'>
                                                                 A request has been made for the gradesheets: <strong> " . $print_grades . " </strong>
                                                             </p>
                                                             
                                                             <p style='color:#000;'>You have made the following selections:</p>
                                                             
                                                             " . $print_selections . "
                                                             
                                                             <p style='color:#000;'>
                                                                The application data is attahced to this e-mail in PDF format.
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
                                                                <img src='http://www.generalcarbide.com/images/iphone-gs.png' alt='Welcome to General Carbide Mobile' title='Welcome to General Carbide Mobile' />
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
                            </html>";
        
        $subject = "General Carbide Gradesheet Request: " . $print_grades;
        
        if($this->_sendmail($email, $subject, $message, $gradesheets))
        {
            
            return TRUE;
            
        }
        else
        {
            
            return FALSE;
            
        }
        
    }
    
    
    private function _sendmail($data, $subject, $message, $attachments = NULL)
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
            $this->email->subject($subject);
            
            if($attachments)
             {
                 foreach($attachments as $gradesheet)
                 {

                     $this->email->attach(realpath(APPPATH."assets/gs/GCC-GradeDataSheets-" . $gradesheet . ".pdf"));

                 }

             }
             
             $this->email->message($message);
            
            $this->email->send();
        
        return TRUE;
        
    }
    
    
}