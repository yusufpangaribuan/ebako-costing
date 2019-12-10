<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Login Form</title>
        <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body style="background: #c7dcd7;">
        <center>
            <div style="width: 400px;height: 220px;margin-top: 150px;border-radius: 5px;background: #009B78;">                
                <table border="0" width="100%" style="margin-top: 20px" cellpadding="0" cellspacing="0">
                    <tr>                        
                        <td width="100%" style="border-bottom: 1px #FFFFFF solid;" align="center">
                            <span style="font-size: 32px;text-shadow: inherit; color: #f7ff1d; font-weight: bold;font-family: Georgia,'Times New Roman',Times,serif;letter-spacing:5px">ERP</span><br/>
                            <span style="color: #f7ff1d;font-size: 13px;font-style:inherit;font-weight: bold;">Ebako Resources Planning</span>
                        </td>                        
                    </tr>                    
                    <tr>
                        <td align="center" style="padding-top: 5px;"><span style="color: #FFFFFF;font-size: 14px;letter-spacing: 3px;font-weight: bold;">PT. EBAKO NUSANTARA</span></td>                        
                    </tr>
                </table>
                <div style="width:80%;border-radius: 5px;background: #f8f8f8;">
                    <form name="login-form" class="login-form" action="<?php echo base_url() ?>index.php/home/login" method="post">
                        <table width="100%" cellpadding="1" cellspacing="2" style="margin-top: 15px;padding-top: 10px;">
                            <tr>
                                <td colspan="2" align="center" style="color: red">&nbsp;<?php echo $this->session->userdata('msg') ?></td>
                            </tr>
                            <tr>
                                <td width="30%" align="right"><label class="labelelement">Username : </label></td>
                                <td width="70%"><input name="username" type="text" class="input username" style="width: 80%"/></td>
                            </tr>
                            <tr>
                                <td align="right"><label class="labelelement">Password : </label></td>
                                <td><input name="password" type="password" value="" style="width: 80%"/></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><button style="margin-top: 10px;margin-bottom: 10px">Login</button></td>
                            </tr>
                        </table>            
                    </form>
                </div>
            </div>        
        </center>
    </body>
</html>