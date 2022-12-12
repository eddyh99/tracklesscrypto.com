<?php

function sendmail($php_mailer, $email, $message)
{
    $mail = $php_mailer;

    $mail->isSMTP();
    $mail->Host            = 'mail.tracklessproject.com';
    $mail->SMTPAuth        = true;
    $mail->Username        = 'no-reply@tracklessmail.com';
    $mail->Password        = '';
    $mail->SMTPDebug    = 2;
    $mail->SMTPAutoTLS    = true;
    $mail->SMTPSecure    = "tls";
    $mail->Port            = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->setFrom('no-reply@tracklessmail.com', 'Trackless Crypto');
    $mail->addReplyTo($email);
    $mail->isHTML(true);

    $mail->ClearAllRecipients();

    $mail->Subject = 'About Trackless Crypto';
    $mail->AddAddress('mamugeming00@gmail.com');
    // $mail->AddAddress('m3rc4n73@gmail.com');
    // $mail->AddAddress('roberto.nolfo62@gmail.com');

    $mail->msgHTML($message);
    $mail->send();
}