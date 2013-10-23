<?php
	
require_once('class.phpmailer.php');
require_once('class.smtp.php');
require_once('class.pop3.php');



$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.qq.com';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 25;
$mail->Username = 'service@joneto.com';
$mail->Password = 'usual..6156635';
$mail->setFrom('service@joneto.com', '囧途网');
$mail->addReplyTo('service@joneto.com', '囧途网');

$mail->Subject = "PHPMailer Simple database mailing list test";

$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
$mail->msgHTML("To view the message, please use an HTML compatible email viewer!");
$mail->addAddress("536464346@qq.com", "536464346");
// $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg'); //Assumes the image data is stored in the DB

if (!$mail->send()) {
    echo  $mail->ErrorInfo;
} else {
    echo "success";
}
// Clear all addresses and attachments for next loop
$mail->clearAddresses();
//$mail->clearAttachments();
