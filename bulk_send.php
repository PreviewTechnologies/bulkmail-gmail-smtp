<?php
require "vendor/autoload.php";

$receiviers = "emailone@email.com
emailtwo@email.com";
$receipients = explode("\n", $receiviers);

function sendMail($to)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "";
    $mail->Password = "";
    $mail->setFrom('you@email.com', 'From Name');
    $mail->addReplyTo('replytoemail@email.com', 'Reply to name');
    $mail->addAddress($to);
    $mail->Subject = 'Your Subject';
    $mail->msgHTML(file_get_contents('msg.html'), dirname(__FILE__));
    $mail->AltBody = file_get_contents('msg.txt');
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
}

$i = 0;
foreach ($receipients as $to) {
    sendMail($to);

    echo "\n"."==========================="."\n";
    echo "Finished ". $i. " / ".sizeof($receipients)."\n";
    echo "==========================="."\n";

    $i++;
}