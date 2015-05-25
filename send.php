<?php 

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];
$phonetic = $_REQUEST['phonetic'];
$prefectures = $_REQUEST['prefectures'];
$age = $_REQUEST['age'];
$phone = $_REQUEST['phone'];
$cellphone = $_REQUEST['cellphone'];
$fax = $_REQUEST['fax'];
$occupation = $_REQUEST['occupation'];

$fullmsg = 'Message: ' .$message. "\n".
           'Phonetic: ' .$phonetic. "\n".
		   'Prefectures: ' .$prefectures. "\n".
		   'Age: ' .$age. "\n".
		   'Phone: ' .$phone. "\n".
		   'Cellphone: ' .$cellphone. "\n".
		   'Fax: ' .$fax. "\n".
		   'Occupation: ' .$occupation;

require_once('class.phpmailer.php');
include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "mail.androbo.jp"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Host       = "mail.androbo.jp"; // sets the SMTP server
  $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "j.jacob@androbo.jp"; // SMTP account username
  $mail->Password   = "pbPD8WiN";        // SMTP account password
  $mail->AddReplyTo('junarjacob@yahoo.com', 'Azreal Administrator');
  $mail->AddAddress('junarjacob@yahoo.com', 'Azreal Administrator');
  $mail->SetFrom($email, $name);
  $mail->AddReplyTo($email, $name);
  $mail->Subject = 'Customer Inquiry';
  //$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  //$mail->MsgHTML(file_get_contents('contents.html'));  
  $mail->Body = $fullmsg;
  //$mail->AddAttachment('images/phpmailer.png');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.png'); // attachment
  $mail->Send();
  //echo "Message Sent OK<p></p>\n";
  echo '<script type="text/javascript">
           window.location = "sent.html"
        </script>';
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>