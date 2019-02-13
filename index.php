<?php
	error_reporting(0);
    $msg = "";
	use PHPMailer\PHPMailer\PHPMailer;
	include_once "PHPMailer/PHPMailer.php";
	include_once "PHPMailer/Exception.php";
	include_once "PHPMailer/SMTP.php";

	if (isset($_POST['submit'])) {
		$dest = $_POST['dest'];
		$subject = $_POST['subject'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$name = $_POST['name'];

		if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != "") {
			$file = "attachment/" . basename($_FILES['attachment']['name']);
			move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
		} else
			$file = "";

		$mail = new PHPMailer();

		//if we want to send via SMTP
		/*$mail->Host = "smtp.gmail.com";
		//$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->Username = "senaidbacinovic@gmail.com";
		$mail->Password = "5C1bcnPkDI4Wd%#";
		$mail->SMTPSecure = "ssl"; //TLS
		$mail->Port = 465; //587*/

		$mail->addAddress($dest);
		$mail->setFrom($email,$name);
		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mail->Body = $message;
		$mail->addAttachment($file);

		if ($mail->send())
		    $msg = "Your email has been sent, thank you!";
		else
			$msg = "Please try again!";
			
			unlink($file);
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<style>
		img[alt="www.000webhost.com"]
        {
            display: none;
        }
	</style>
</head>
<body>
	<div class="jumbotron text-center">
		<h2 class="display-3"> PHP e-mail system </h1>
	</div>
		<div class="container">
               <div class="row">
					<div class="col-md-9">
					<form method="post" action="index.php" enctype="multipart/form-data">
						<input class="form-control" name="dest" type="email" placeholder="Send to..."><br>
						<input class="form-control" name="subject" placeholder="Subject..."><br>
						<div class="row">
							<div class="col-md-6">
							<input class="form-control" name="email" type="email" placeholder="Your email...">
							</div>
							<div class="col-md-6">
							<input class="form-control" name="name" type="text" placeholder="Name...">
							</div>
						</div><br>
						<textarea placeholder="Message..." class="form-control" name="message"></textarea><br>
						<input class="form-control" type="file" name="attachment"><br>
						<input class="btn btn-primary" name="submit" type="submit" value="Send Email">
					</form>
					</div>
					<div class="col-md-3">
						<h4 class="lead"><?php if ($msg != "") echo "$msg<br><br>"; ?> </h4>
					</div>
			   </div>
		</div>
</body>
</html>






