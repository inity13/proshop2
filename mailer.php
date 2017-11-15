<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

echo "CHECKPOINT: After uses/requires for PHPMailer<br>"; //For debugging

//PHP requires !empty it seems to populate POST variables. So have at it.
if(!empty($_POST['subject'])){

//POST Variables from index.html for email content
$subject = $_POST['subject'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$email = $_POST['email'];

echo "CHECKPOINT: Before PHPMailer config/After declaration of POST variables<br>";//For debugging

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();

//USER CONFIGURABLE PARTS

$mail->Username = 'proshopnoreply@gmail.com';
$mail->Password = 'ProShop123'; //CHANGE PASS!
$mail->SetFrom('no-reply@gmail.com'); //Has to be defined, but does not really do anything, the FROM is actually from the Username parameter
$mail->Subject = $subject; //EMAIL SUBJECT
$mail->Body = "Puhelinnumero:<br>
			   {$phone}<br>
			   Email:<br>
			   {$email}<br><br>
			   Viesti:<br>
			   {$message}<br>
			   "; //Concatonates phone/email/subject into email body
//$mail->AltBody = $phone;
$mail->AddAddress('jmikkola13@gmail.com'); //TO whom you are sending TO 

echo "CHECKPOINT: Before Sending Mail<br>";//For debugging
//echo $phone;

//SENDING THE MAIL
if(!$mail->Send())
{
   echo "Message could not be sent. 
";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent<br>";//For debugging
echo "<b><h4>Kiitos viestistäsi, palaamme asiaan mahdollisimman pian!</h4></b>";
} else {
echo "<br>";
echo "vardump for POST:<br>";//For debugging
echo var_dump($_POST);//For debugging
echo "<br>";
echo "<b>POST variables not found it seems. For fucks sake.</b>";//For debugging

}
?>