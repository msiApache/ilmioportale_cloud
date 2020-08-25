<?php

namespace Ilmioportale\PhpMailer;

class Mail
{
    /**
     * @var mixed
     */
    private $dataMail;

    /**
     * Mail constructor.
     */
    public function __construct()
    {
        $this->dataMail = include_once __DIR__ . '/../../../Common/dataMail.php';
    }

    public function sendEmail($message)
    {
        $serverName = $_SERVER['SERVER_NAME'];
        $setting = $this->dataMail['setting'];
        $address = $this->dataMail['address'];
        $body = $this->dataMail['body'];
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = $setting['smtpHost'];                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = $setting['usernameProvider'];             // SMTP username
            $mail->Password = $setting['passwordProvider'];                     // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            if ($serverName == 'localhost') {
                $mail->Port = $setting['port1'];                                 // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above 587
            } else {
                $mail->Port = $setting['port2'];
            }
            //Adress
            $mail->setFrom($address['fromMailGianluca'], $address['fromNameGianluca']);
            $mail->addAddress($address['toMailGianluca'], $address['toNameGianluca']);     // Add a recipient
            $mail->addAddress($address['toMailDaniela'], $address['toNameDaniela']);     // Add a recipient
            $mail->addAddress($address['toMailAntonio'], $address['toNameAntonio']);     // Add a recipient

            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $body['subject'];
            $mail->Body = $message;
            $mail->AltBody = $body['messageOther'];
            $mail->send();
            /*echo 'Message has been sent';*/
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}