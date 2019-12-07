<?php
// Check for empty fields


$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = "dewkiti@gmail.com"; // Add your email address inbetween the "" replacing dewkiti@gmail.com - This is where the form will send a message to.
$subject = "Website Contact Form:  $name";
$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
$header = "From: dewkiti@gmail.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$header .= "Reply-To: $email";	

//add start
include_once('PHPMailer/PHPMailerAutoload.php');

function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
{
      if ($type != 1) $content = nl2br($content);
      // type : text=0, html=1, text+html=2
      $mail = new PHPMailer(); // defaults to using php "mail()"
      $mail->IsSMTP();
         //   $mail->SMTPDebug = 2;
      $mail->SMTPSecure = "ssl";
      $mail->SMTPAuth = true;
      $mail->Host = "smtp.naver.com";
      $mail->Port = 465;
      $mail->Username = "";
      $mail->Password = "";
      $mail->CharSet = 'UTF-8';
      $mail->From = $fmail;
      $mail->FromName = $fname;
      $mail->Subject = $subject;
      $mail->AltBody = ""; // optional, comment out and test
      $mail->msgHTML($content);
      $mail->addAddress($to);
      if ($cc)
            $mail->addCC($cc);
      if ($bcc)
            $mail->addBCC($bcc);
      if ($file != "") {
            foreach ($file as $f) {
                  $mail->addAttachment($f['path'], $f['name']);
            }
      }
      if ( $mail->send() ) echo "성공";
      else echo "실패";
}



//mailer("발송자명","발송자 주소","수신자 주소","제목","내용" );
mailer($to,$to,$to,$subject,$body );

//add end



//if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//  http_response_code(500);
//  exit();
//}


//if(!mail($to, $subject, $body, $header))
//  http_response_code(500);

?>
