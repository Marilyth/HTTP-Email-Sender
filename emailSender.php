<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

  $content = json_decode(file_get_contents('php://input'), true);
  $recipient = $content['sendTo'];
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 2;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "EmailAddress";
  $mail->Password   = "EmailPassword";

  $mail->IsHTML(false);
  $mail->AddAddress($recipient);
  $mail->SetFrom($mail->Username);
  $mail->Subject = $content["subject"];
  $mail->Body = $content["body"];

  if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($content);
  } else {
    echo "Email sent successfully";
  }
?>
