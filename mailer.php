<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//echo "CHECKPOINT: After uses/requires for PHPMailer<br>"; //For debugging

//PHP requires !empty it seems to populate POST variables. So have at it.
if(!empty($_POST['subject'])){

//POST Variables from index.html for email content
$subject = $_POST['subject'];
$message = $_POST['message'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$company = $_POST['company'];
//echo "CHECKPOINT: Before PHPMailer config/After declaration of POST variables<br>";//For debugging

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
$mail->Body = "<h1><b>Yhteydenotto nettisivuilta</b></h1>
				<br>
				<h2><b>Asiakkaan tiedot:</b></h2><br>
				<b>Puhelinnumero:</b><br>
			   {$phone}<br>
			   <b>Email:</b><br>
			   {$email}<br>
			   <b>Yhtiö/Nimi:</b><br>
			   {$company}<br>
			   <h2><b>Viesti:<br>
			   {$subject}
			   </b></h2>
			   {$message}
			   "; //Concatonates phone/email/subject/company etc. into email body and formats nicely
//$mail->AltBody = $phone;
$mail->AddAddress('jmikkola13@gmail.com'); //TO whom you are sending TO 

//echo "CHECKPOINT: Before Sending Mail<br>";//For debugging
//echo $phone;

//SENDING THE MAIL
if(!$mail->Send())
{
   echo "Viestiä <b>ei</b> voitu lähettää. 
";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

//echo "Message has been sent<br>";//For debugging
echo "<html>"; //Unnecessary probably, but hey, still here.
echo "<body>";
echo "<head>";
echo "<b><h4>Kiitos viestistäsi {$company}, palaamme asiaan mahdollisimman pian!</h4></b>"; //Thank you for the email
echo "<a href=\"javascript:history.go(-1)\">Takaisin sivuille!</a>";//Link to previous page 
echo "</head>";
echo "</body>";
echo "</html>";

//echo $company; //For debugging
} else {
echo "<br>";
echo "vardump for POST:<br>";//For debugging
echo var_dump($_POST);//For debugging
echo "<br>";
echo "<b>POST variables not found it seems. For fucks sake. Something is seriously wrong, try again</b>";//For debugging

}
?>