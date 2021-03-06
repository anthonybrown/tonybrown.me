<?php
$errors = '';
$myemail = 'tony@tonybrown.me';//<-----Put Your email address here.
if(empty($_POST['name'])  ||
   empty($_POST['email']) ||
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail;
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message";

	$headers = "From: $myemail\n";
	$headers .= "Reply-To: $email_address";

	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: contact-form-thank-you.html');
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Contact form handler</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>
=======
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1250">
<title>Simple PHP Contact Form</title>
<link href="../assets/demo.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="contact">

<?php
		$error		= '';
		$name		= '';
		$email		= '';
		$subject	= '';
		$comments	= '';
		$verify		= '';

		if(isset($_POST['contactus'])) {

		$name		= $_POST['name'];
		$email		= $_POST['email'];
		$subject	= $_POST['subject'];
		$comments	= $_POST['comments'];
		$verify		= $_POST['verify'];


		if(trim($name) == '') {
			$error = '<div class="error_message">Attention! You must enter your name.</div>';
		} else if(trim($email) == '') {
			$error = '<div class="error_message">Attention! Please enter a valid email address.</div>';


		} else if(!isEmail($email)) {
			$error = '<div class="error_message">Attention! You have enter an invalid e-mail address, try again.</div>';
		}

		if(trim($subject) == '') {
			$error = '<div class="error_message">Attention! Please enter a subject.</div>';
		} else if(trim($comments) == '') {
			$error = '<div class="error_message">Attention! Please enter your message.</div>';
		} else if(trim($verify) == '') {
			$error = '<div class="error_message">Attention! Please enter the verification number.</div>';
		} else if(trim($verify) != '4') {
			$error = '<div class="error_message">Attention! The verification number you entered is incorrect.</div>';
		}

		if($error == '') {

			if(get_magic_quotes_gpc()) {
				$comments = stripslashes($comments);
			}



		$address = "tony@tonybrown.me";

		$e_subject = 'You\'ve been contacted by ' . $name . '.';


		$e_body = "You have been contacted by $name with regards to $subject, their additional message is as follows.\r\n\n";
		$e_content = "\"$comments\"\r\n\n";

		$e_reply = "You can contact $name via email, $email";

		$msg = $e_body . $e_content . $e_reply;

		if(mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n"))
		{
			// Email has sent successfully, echo a success page.

			 echo "<div id='succsess_page'>";
			 echo "<h1>Email Sent Successfully.</h1>";
			 echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
			 echo "</div>";
		 } else echo "Error. Mail not sent";

		}
	}

		if(!isset($_POST['contactus']) || $error != '') // Do not edit.
		{
?>

			<h1>Thank you for contacting me.</h1>
			 <p>I will get back to you within 24hrs.</p>

			<?php echo $error; ?>

			<fieldset>

			<legend>Please fill in the following form to contact us</legend>

			<form method="post" action="">

			<label for=name accesskey=U><span class="required">*</span> Your Name</label>
			<input name="name" type="text" id="name" size="30" value="<?php echo $name; ?>" />

			<br />
			<label for=email accesskey=E><span class="required">*</span> Email</label>
			<input name="email" type="text" id="email" size="30" value="<?php echo $email; ?>" />

			<br />
			<label for=subject accesskey=S><span class="required">*</span> Subject</label>
			<select name="subject" id="subject">
				<option value="Support">Support</option>
				<option value="a Sale">Sales</option>
				<option value="a Bug fix">Report a bug</option>
			</select>

			<br />
			<label for=comments accesskey=C><span class="required">*</span> Your comments</label>
			<textarea name="comments" cols="40" rows="3" id="comments"><?php echo $comments; ?></textarea>

			<hr />

			<p><span class="required">*</span> Are you human?</p>

			<label for=verify accesskey=V>&nbsp;&nbsp;&nbsp;3 + 1 =</label>
			<input name="verify" type="text" id="verify" size="4" value="<?php echo $verify; ?>" /><br /><br />

			<input name="contactus" type="submit" class="submit" id="contactus" value="Submit" />

			</form>

			</fieldset>

<?php }

function isEmail($email) { // Email address verification, do not edit.
return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

?>


	</div>

</body>
</html>
