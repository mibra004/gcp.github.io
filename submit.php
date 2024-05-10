<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "tafa1030@gmail.com"; // Your Gmail email address
    $mail->Password   = "kcwg qrzx xwve llit"; // Your Gmail password

    $mail->IsHTML(true);
    $mail->AddAddress("atifib@gmail.com", "tafa1030@gmail.com"); // Change the email address and recipient name
    $mail->SetFrom($email, $name);
    $mail->AddReplyTo($email, $name);

    $mail->Subject = "New service scheduling request";
    $content = "<b>Name:</b> $name<br>";
    $content .= "<b>Email:</b> $email<br>";
    $content .= "<b>Client Number:</b> $phone<br>";
    $content .= "<b>Date of Service:</b> $date<br>";
    $content .= "<b>Time of Service:</b> $time<br>";
    $content .= "<b>Message:</b> $message";

    $mail->MsgHTML($content); 

    if(!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
    } else {
        echo '<div style="text-align: center;"><i class="fas fa-check-circle" style="font-size: 48px; color: #28a745;"></i><div style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem; display: inline-block;">Email sent successfully</div></div>';
    }
} else {
    http_response_code(403);
}
?>
