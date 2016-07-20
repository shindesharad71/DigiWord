<?php
	$title = 'Edit Post - Admin';
	session_start();
	require_once('../inc/dbconfig.php');

	if(!isset($_SESSION['username']))
	{
		echo '<script>window.location.href = "../admin/login.php";</script>';
		die();
	}
?>

<script>
        $(document).ready(function() {
        $('#content').summernote({
        	height: 300,
        });
    });
</script>

<?php
	
	$id = $_GET['id'];

	$query = "SELECT id, postTitle, description, content, post_date, catinfo FROM blog_posts WHERE id = '$id'";
				$result = mysqli_query($con,$query);

				if (mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
			            $postTitle = $row['postTitle'];
			            $description = $row['description'];
			            $content = $row['content'];                       
					}
				}
				else
				{
					echo '<div class="alert alert-warning text-center topspace"><h3>error while retriving post!</h3></div>';
					die();
				}


	if (isset($_POST['update'])) 
	{
		$postTitle = $_POST['postTitle'];
		$postTitle = stripslashes($postTitle);
		$postTitle = mysqli_real_escape_string($con,$postTitle);

		$description = $_POST['description'];
		$description = stripslashes($description);
		$description = mysqli_real_escape_string($con,$description);

		$content = $_POST['content'];
		$content = stripslashes($content);
		$content = mysqli_real_escape_string($con,$content);

		$catvalue = $_POST['cats'];
		$catvalue = stripslashes($catvalue);

		$query = "UPDATE blog_posts SET postTitle='$postTitle',description='$description',content='$content',post_date=NOW() ,catinfo='$catvalue' WHERE id='$id'";

		mysqli_query($con,$query);

		$rows = mysqli_affected_rows($con);

			if($rows == 1)
			{
				echo '<div class="alert alert-success topspace"><h3>Post Edited Sccessfully, Redirecting to Edited Post</h3></div>';
				echo '<script>setTimeout(function () { window.location.href = "index.php";}, 2000);</script>';
			}
			else
			{
				echo '<script>
				var id = <?php echo $id; ?>;
				setTimeout(function () { window.location.href = "edit.php";}, 2000);</script>';
				die('error in posting');
				
			}
	}

?>

<div class="container-fluid topspace">
			<form class="" method="post" action="<?php $PHP_SELF ?>">
				<h1 class="text-center"><u>Edit Post</u></h1>
				<div class="col-md-4" id="new-post-border">

					<div class="">
						<label for="postTitle"><h3>Post Title</h3></label>
						<input type="text" name="postTitle" placeholder="Post Title" value="<?php echo $postTitle; ?>" class="form-control" required autofocus>
					</div>

					<div class="">
						<label for="description"><h3>Post Description</h3></label>
						<textarea name="description" rows="7" cols="60" maxlength="250" placeholder="Post Description" id="description" class="form-control space" required><?php echo $description; ?></textarea>
					</div>

					<div class="">
						<label for="content"><h3>Post Category</h3></label><br>
						<?php
							$query1 = "SELECT catID, catTitle FROM blog_cats";
							$result1 = mysqli_query($con,$query1);
							echo mysqli_error($con);
							if (mysqli_num_rows($result1) > 0)
							{
								while($row1 = mysqli_fetch_assoc($result1))
								{	
									echo '<div class="radio">
	  								<label><input type="radio" name="cats" value="'.$row1['catID'].'"><b>'.$row1['catTitle'].'</b></label>
									</div>';
								}
							}
						?>
					</div>
				</div>
				
				<div class="col-md-8">
					<div class="">
						<label for="content"><h3>Post Content</h3></label>
						<textarea name="content" placeholder="Post Content" id="content" class="form-control space" required><?php echo $content; ?></textarea>
					</div>
					<div class="text-center">
						<button class="btn btn-lg btn-primary" name="update" type="submit" id="update">Update Post</button>
					</div>
				</div>		
				
			</form>
	</div>
</body>
</html>