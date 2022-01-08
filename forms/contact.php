<!-- php mailer for contact form -->



<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;


//Load Composer's autoloader
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
                    
if(isset($_POST['name']) && isset($_POST['email'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $body = $_POST['message'];

  $mail = new PHPMailer();

  //smtp setting
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = "surajnaruka4@gmail.com";
  $mail->Password = "63635787@@";
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";

  //email setting
  $mail->isHTML(true);
  $mail->setFrom($email, $name);
  $mail->addAddress("surajnaruka4@gmail.com");
  $mail->Subject = ("$email ($subject)");
  $mail->Body = $body;

  if($mail->send()){
    $status = "success";
    $response = "email is sent";
  }
  else{
    $status = "failed";
    $response = "Something is wrong: <br>" . $mail->ErrorInfo;
  }
  header("Location: \MyResume\index.html");
  die();
  exit(json_encode(array("status" => $status, "response" => $response)));
}
?>