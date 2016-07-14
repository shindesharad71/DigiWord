<?php
$title = 'redirecting...';
require_once('../inc/dbconfig.php');
session_start();
unset($_SESSION['username']);
session_destroy();

	if(isset($_SESSION['username']))
	echo '<br><br><div class="container"><h3 class="topspace text-center alert alert-danger">error in logout<h3></div>';
	else
	{
		echo '<br><br><div class="topspace text-center container"><h1>Thank you!<h1><br><br><h3 class="alert alert-info">logout successfully! redirecting you to login page</h3></div>';
		echo '<script>setTimeout(function () { window.location.href = "login.php";}, 2000);</script>';
	}

?>

