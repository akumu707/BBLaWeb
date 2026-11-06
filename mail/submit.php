<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
#error_reporting(E_ALL);

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

  function sendMail($arr)
  {
    #header("Location: /contact/thanks.html");
	
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 0;  
    $mail->SMTPAutoTLS = false;
    $mail->SMTPAuth   = TRUE;
    $mail->Port       = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Host       = "mail2.bfp.cz";
    $mail->Username   = "info@bigbandla.com";
    $mail->Password   = "JK424nw";
    $mail->MessageID = "<" . md5('HELLO'.(idate("U")-1000000000).uniqid()).'@bigbandla.com>';

    $mail->IsHTML(true);
    $mail->AddAddress("jaromir.flidr@gmail.com", "recipient-name");
    $mail->SetFrom("info@bigbandla.com");
    $mail->Subject = "zprava z webu";
    $content = "<pre>" . $_REQUEST['name'] . "</pre><br/>";
    $content .= "<pre>" . $_REQUEST['contact'] . "</pre><br/>";
    $content .= "<pre>" . $_REQUEST['message'] . "</pre><br/>";

    $mail->MsgHTML($content); 
    $mail->Send();

    header("Location: /contact/thanks.html");
  }

  if(isset($_POST)) {
    $errorMsg = sendMail($_POST);
  }
?>
