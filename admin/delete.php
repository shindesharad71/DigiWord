<?php
	$title = 'Delete Post - Admin';
	session_start();
	require_once('../inc/dbconfig.php');

	if(!isset($_SESSION['username']))
	{
		echo '<script>window.location.href = "../admin/login.php";</script>';
		die();
	}
	
	$id = $_GET['id'];

	$query = "DELETE FROM blog_posts WHERE id='$id'";
	mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);

				if($rows == 1)
				{
					echo '<div class="topspace alert alert-success"><h3>Post Deleted Sccessfully, Redirecting to Admin Panel</h3></div>';
					echo '<script>setTimeout(function () { window.location.href = "index.php";}, 2000);</script>';
				}
				else
				{
					echo '<div class="topspace alert alert-warning text-center"><h3>error while Deleting post!</h3></div>';
					die();
				}

	mysqli_close($con);
?>

</body>
</html>