<?php
	
	$title = 'New Category - Admin';

	session_start();
	require_once('../inc/dbconfig.php');
	$auther = $_SESSION['username'];

	if(!isset($_SESSION['username']))
	{
		echo '<script>window.location.href = "../admin/login.php";</script>';
		die();
	}
	
	if (isset($_POST['addcat'])) 
	{

		$catname = $_POST['catname'];
		$catname = stripslashes($catname);
		$catname = mysqli_real_escape_string($con,$catname);

		$slug = $_POST['slug'];
		$slug = stripslashes($slug);
		$slug = mysqli_real_escape_string($con,$slug);

		$query = "INSERT INTO blog_cats (catID, catTitle, catSlug) VALUES (NULL, '$catname', '$slug')";
		mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="alert alert-success topspace"><h3>Category added Sccessfully, Redirecting to categories page</h3></div>';
			echo '<script>setTimeout(function () { window.location.href = "categories.php?action=added";}, 2000);</script>';
		}
		else
		{
			echo '<div class="alert alert-danger topspace"><h3>error while adding Category, try again!</h3></div>';		
		}
			
	}

	mysqli_close($con);

?>
	<div class="container topspace">
		<div class="form-wrapper">
			<form class="" method="post" action="<?php $PHP_SELF ?>">
				<h1 class="form-signin-heading">Add New Category</h1>
				
				<div class="space">
					<label for="catname"><h2>Category Name</h2></label>
					<input type="text" name="catname" placeholder="Category Name" id="catname" class="form-control" required autofocus>
				</div>
				
				<div class="space">
					<label for="slug"><h2>Slug</h2></label>
					<input name="slug" placeholder="Category Slug" id="slug" class="form-control" required>
				</div>
				
				<div class="space">
					<button class="btn btn-lg btn-primary space" name="addcat" type="submit" id="addcat">Add Category</button>
				</div>
			</form>
		</div>
	</div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>