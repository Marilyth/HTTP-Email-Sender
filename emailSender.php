<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

 function jsonToCSV($jfilename, $cfilename)
{
    if (($json = file_get_contents($jfilename)) == false)
        die('Error reading json file...');
    $data = json_decode($json, true);
    $fp = fopen($cfilename, 'w');
    $header = false;
    foreach ($data as $row)
    {
        if (empty($header))
        {
            $header = array_keys($row);
            fputcsv($fp, $header);
            $header = array_flip($header);
        }
        fputcsv($fp, array_merge($header, $row));
    }
    fclose($fp);
    return;
}
  
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

  $content = json_decode(file_get_contents('php://input'), true);
  $recipient = $content['sendTo'];
  $jsonAttachment = fopen("attachment.json", "w") or die(error_get_last()['message']);
  fwrite($jsonAttachment, json_encode($content['results']));
  jsonToCSV("attachment.json", "attachment.csv");
  $mail = new PHPMailer();
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
  $mail->Subject = "Text";
  $mail->AddAttachment("attachment.csv");
  $mail->Body = "Text" . json_encode($content[meta]); 
  
  if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
    var_dump($content);
  } else {
    echo "Email sent successfully";
  }
?>
