<?php
	$title = 'Delete Category - Admin';
	session_start();
	require_once('../inc/dbconfig.php');

	if(!isset($_SESSION['username']))
	{
		echo '<script>window.location.href = "../admin/login.php";</script>';
		die();
	}

	$id = $_GET['id'];
    $catID = $row['catID'];
	$q = "DELETE FROM blog_cats WHERE catID = '$id'";
	$result = mysqli_query($con,$q);
	if(mysqli_affected_rows($con)==1)
	{
		header('Location: categories.php?action=deleted');		
	}
	else
	{
		echo '<div class="alert alert-warning topspace"><h3>error while deleting category</h3></div>';
	}

?>