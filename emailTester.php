<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

  $recipient = "Email";
  $mail = new PHPMailer(true);
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "Email";
  $mail->Password   = "Password";

  $mail->IsHTML(false);
  $mail->AddAddress($recipient, "Name");
  $mail->SetFrom("Email", "Name");
  $mail->Subject = "Somebody completed your experiment!";
  $mail->Body = "Results were attached as .csv\nMeta data:"; 
  
  if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
  } else {
    echo "Email sent successfully";
  }
?>
