<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>mail</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
	//check if user is coming from A Request
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//identifying variables
		$user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
		$msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

		//for testing uncomment
		//echo $user . ' ' . $email . ' ' . $phone . ' ' . $msg;


		// Creating array of errors
		$formErrors = array();
		if(strlen($user) <= 3) {
			$formErrors[] = 'Server not accepting less than 3 chars';
		}

		if(strlen($msg) <= 10) {
			$formErrors[] = 'Server not accepting less than 10 chars';
		}

		$headers = 'From: '. $email . '\r\n';
		//if no errors send Email [mail(To, Subject, Message, Headers, Parameters)]
		if (empty($formErrors)) {
			mail('banuk@cyber-host.net','Contact Form', $msg, $headers);
			$user = '';
			$email = '';
			$phone = '';
			$msg = '';
			$success = '<span class="alert-success text-center p-2 mb-1 d-block">We have received your message</span>';
		}
	}
?>


<div class="box">

	<div class="container">
		<h1 class="text-center title">Contact Me</h1>

		<form class="contact-me" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
				<?php if (!empty($formErrors)) { ?><small class="alert alert-danger form-text text muted text-center" role="alert"><?php foreach($formErrors as $error){ echo '<li>' . $error . '</li>'; }?>
				</small><?php } ?> <?php if (isset($success)) { echo $success; }?>

			<div class="form-group">
				<input class="form-control pl-5" id="user-field" type="text" name="username" placeholder="Username Here" required="required" value="<?php if (isset($user)) { echo $user; }  ?>">
				<lable class="alert alert-danger name-error">
					Username Must be more than <strong>3</strong> characters!
				</lable>
			</div>


			<div class="form-group">
				<input class="empty form-control pl-5" id="mail-field" type="email" name="email" placeholder="Email Address" required="required" value="<?php if (isset($email)) { echo $email; }  ?>">
				<lable class="error alert alert-danger mail-error"></lable>
			</div>

			<div class="form-group">
				<input class="form-control pl-5" id="phone-field" type="text" name="phone" placeholder="Phone number" required="required" value="<?php if (isset($phone)) { echo $phone; }  ?>">
				<lable class="alert alert-danger phone-error">
					please enter a valid phone number!
				</lable>
			</div>

			<textarea class="form-control" placeholder="Your Message" name="message" value="<?php if (isset($msg)) { echo $msg; }  ?>"></textarea>
			<div>
				<i class="fas fa-paper-plane"></i>
				<input class="btn btn-success pl-5" type="submit" value="Send Message">
			</div>
		</form>
	</div>

</div>




	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/scripts.js"></script>

</body>
</html>
