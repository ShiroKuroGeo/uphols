<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Assets/Plugins/vendor/PHPMailer/src/Exception.php');
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Assets/Plugins/vendor/PHPMailer/src/PHPMailer.php');
include($_SERVER['DOCUMENT_ROOT'] . '/uphols/Assets/Plugins/vendor/PHPMailer/src/SMTP.php');

$mail = new PHPMailer(true);
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'inocgeorgealfeser@gmail.com';
$mail->Password   = 'ugupkxvksgggeijh';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->isHTML(true);
return $mail;
