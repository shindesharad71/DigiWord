<?php
	$title = 'Edit Category - Admin';
	session_start();
	require_once('../inc/dbconfig.php');
	$auther = $_SESSION['username'];

	if(!isset($_SESSION['username']))
	{
		echo '<script>window.location.href = "../admin/login.php";</script>';
		die();
	}

	$id = $_GET['id'];

	$query = "SELECT catID, catTitle, catSlug FROM blog_cats WHERE catID = '$id'";
				$result = mysqli_query($con,$query);

				if (mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
			            $catTitle = $row['catTitle'];
			            $catSlug = $row['catSlug'];                       
					}
				}
				else
				{
					echo '<div class="alert alert-warning text-center topspace"><h3>error while retriving categories!</h3></div>';
					die();
				}
	
	if (isset($_POST['editcat'])) 
	{

		$catTitle = $_POST['catTitle'];
		$catTitle = stripslashes($catTitle);
		$catTitle = mysqli_real_escape_string($con,$catTitle);

		$catSlug = $_POST['catSlug'];
		$catSlug = stripslashes($catSlug);
		$catSlug = mysqli_real_escape_string($con,$catSlug);

		$query = "UPDATE blog_cats SET catTitle='$catTitle', catSlug='$catSlug' WHERE catID='$id'";
		mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="alert alert-success topspace"><h3>Category edited Sccessfully, Redirecting to categories page</h3></div>';
			echo '<script>setTimeout(function () { window.location.href = "categories.php?action=edited";}, 2000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger topspace"><h3>error while editing Category, try again!</h3></div>';		
		}
			
	}

	mysqli_close($con);

?>
	<div class="container topspace">
		<div class="form-wrapper">
			<form class="" method="post" action="<?php $PHP_SELF ?>">
				<h1 class="form-signin-heading">Edit Category</h1>
				
				<div class="space">
					<label for="catname"><h2>Category Name</h2></label>
					<input type="text" name="catTitle" placeholder="Category Name" value="<?php echo $catTitle; ?>" id="catTitle" class="form-control" required autofocus>
				</div>
				
				<div class="space">
					<label for="slug"><h2>Slug</h2></label>
					<input name="catSlug" placeholder="Category Slug" id="catSlug" value="<?php echo $catSlug; ?>" class="form-control space" required>
				</div>
				
				<div class="space">
					<button class="btn btn-lg btn-primary space" name="editcat" type="submit" id="addcat">Edit Category</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>