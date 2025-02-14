<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if (isset($_POST['name'])) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'hello@pinkcouch.pk'; // Your Gmail address
        $mail->Password = 'twivyjeomlheszid'; // Your Gmail password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('hello@pinkcouch.pk', 'Pink Couch Technologies');
        $mail->addAddress('hello@pinkcouch.pk');

        //Content
        $mail->isHTML(false);
        $mail->Subject = $_POST['subject'];
        $mail->Body    = "Hi Greetings, A new contact request is submitted from the website. \n"
            . "Name: " . $_POST['name'] . " \n"
            . "Email: " . $_POST['email'] . " \n"
            . "Phone: " . $_POST['phone'] . " \n"
            . "Message: " . $_POST['message'] . " \n";

        $mail->send();
        $responseArray = array('class' => 'alert alert-success', 'message' => 'Message sent successfully. Thank you, will get back to you soon!');
    } catch (Exception $e) {
        $responseArray = array('class' => 'alert alert-danger', 'message' => 'There was an error while submitting the form. Please try again later.');
    }

    // Return JSON response
    $encoded = json_encode($responseArray);
    header('Content-Type: application/json');
    echo $encoded;
} else {
    echo 'silence is golden';
}
