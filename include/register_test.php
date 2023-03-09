<?php 

	require_once 'system.php';
	require_once 'register_test.php';

if (isset($_POST["regsubmit"])) {
	
	$username = $_POST["username"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];
	$pswrepeat = $_POST["pwdrepeat"];

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
	
	if (alreadyexists($this->conn, $username, $email) !== false ) {
		header("location: ../register?error=alreadyexists");
		exit();
	}

	register($db->conn, $username, $email, $pwd);

}
else {
	header("location: ../register.php");
	exit();
}






<?php

function emptyinput($username, $email, $pwd, $pwdrepeat) {
  $result;
  if (empty($username) || empty($email) || empty($pwd) || empty($pwdrepeat)) {
	$result = true;
  }
  else {
	$result = false;
  }
return $result;
} 

function invaliduser($username) {
  $result;
  if (preg_match("/^[a-zA-Z0-9]*$/", $username)) {
	$result = true;
  }
  else {
	$result = false;
  }
return $result;
} 

function invalidemail($email) {
  $result;
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$result = true;
  }
  else {
	$result = false;
  }
return $result;
} 

function pwdmatch($pwdrepeat, $pwd) {
  $result;
  if ($pwd !== $pwdrepeat) {
	$result = true;
  }
  else {
	$result = false;
  }
return $result;
} 

function alreadyexists($this->conn, $username, $email) {
 $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
 $stmt = mysqli_stmt_init($this->conn);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("location: ../register?error=stmtfailed");
	exit();
}

mysqli_stmt_bind_param($stmt, "ss", $username, $email);
mysqli_stmt_execute($stmt);

$resultdata = mysqli_stmt_get_result($stmt);


if (mysqli_fetch_assoc($resultdata)) {
	$result = true; 
}
else {
 $result = false;
 return $result;
}

mysqli_stmt_close($stmt);

} 

function register($this->conn, $username, $email, $pwd) {
 $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
 $stmt = mysqli_stmt_init($this->conn);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("location: ../register?error=stmtfailed");
	exit();
}

$hashpwd = password_hash($pwd, PASSWORD_DEFAULT);


mysqli_stmt_bind_param($stmt, "sss",  $username, $email, $hashpwd);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("location: ../register?error=none");
exit();


} 