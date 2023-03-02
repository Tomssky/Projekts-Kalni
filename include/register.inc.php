<?php 


if (isset($_POST["submit"])) {
	
	$username = $_POST["username"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];
	$pswrepeat = $_POST["pwdrepeat"];

	require_once 'system.php';
	require_once 'register_error_msg.php';
	require_once 'functions.php';
	 

	if (emptyinput($username, $email, $pwd, $pwdrepeat) !== false ) {
		header("location: ../register?error=emptyinput");
		exit();
	}

	if (invaliduser($username) !== false ) {
		header("location: ../register?error=invaliduser");
		exit();
	}

	if (invalidemail($email) !== false ) {
		header("location: ../register?error=invalidemail");
		exit();
	}

	if (pwdmatch($pwdrepeat, $pwd) !== false ) {
		header("location: ../register?error=pwdmatch");
		exit();
	}
	
	if (alreadyexists($conn, $username, $email) !== false ) {
		header("location: ../register?error=alreadyexists");
		exit();
	}

	register($conn, $username, $email, $pwd);

}
else {
	header("location: ../register.php");
	exit();
}
