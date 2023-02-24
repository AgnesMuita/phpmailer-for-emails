<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

require_once __DIR__ . '/vendor/autoload.php';
$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $phonenumber = $_POST['phonenumber'];
   $service = $_POST['service'];
   $message = $_POST['message'];

   if (empty($name)) {
       $errors[] = 'Name is empty';
   }

   if (empty($email)) {
       $errors[] = 'Email is empty';
   } ;
//     else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        $errors[] = 'Email is invalid'
//    }
    
   if (empty($message)) {
       $errors[] = 'Message is empty';
   };

   if (!empty($errors)) {
       $allErrors = join('<br/>', $errors);
       $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
   } else {
       $mail = new PHPMailer(true);


       // specify SMTP credentials
        $mail -> SMTPDebug = SMTP::DEBUG_SERVER;

       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = true;
       $mail->Username = 'myemail@gmail.com';
       $mail->Password = 'fzzjcmjcuibgpkhv';
       $mail->SMTPSecure = 'tls';
       $mail->Port = 528;
       $mail->setFrom($email, $name);
       $mail->addAddress('myemail@gmail.com', 'Jane Doe');
       $mail->Subject = "new message from contact form";

       // Enable HTML if needed
       $mail->isHTML(true);
       $mail->Body = $message;
       echo $body;

       if( $mail->send() ){
          echo "email sent successfully";
       }else{
           $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $mail->ErrorInfo;
       };
        
   };

};

?>