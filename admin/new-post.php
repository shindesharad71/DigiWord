<?php
	$title = 'New Post - Admin';
	session_start();
	require_once('../inc/dbconfig.php');
	if(!isset($_SESSION['username']))
	{
		echo '<script>window.location.href = "../admin/login.php";</script>';
		die();
	}
	
	$auther = $_SESSION['username'];


	if (isset($_POST['publish'])) 
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

		$query = "INSERT INTO blog_posts (id, postTitle, description, content, post_date, auther, catinfo) VALUES (NULL, '$postTitle', '$description', '$content', NOW(), '$auther','$catvalue')";
		mysqli_query($con,$query);
		
		$rows = mysqli_affected_rows($con);

		if($rows == 1)
		{
			echo '<div class="alert alert-success topspace"><h3>Post Published Sccessfully, Redirecting to Admin Panel</h3></div>';
			echo '<script>setTimeout(function () { window.location.href = "index.php";}, 2000);</script>';
		}
		else
		{
			echo '<div class="topspace alert alert-danger"><h3>error while posting, try again!</h3></div>';		
		}

	}

?>

<script>
        $(document).ready(function() {
        $('#content').summernote({
        	height: 300,
        });
    });
</script>

	<div class="container-fluid topspace">
			<form class="" method="post" action="<?php $PHP_SELF ?>">
				<h1 class="text-center"><u>New Post</u></h1>
				<div class="col-md-4" id="new-post-border">

					<div class="">
						<label for="postTitle"><h3>Post Title</h3></label>
						<input type="text" name="postTitle" placeholder="Post Title" class="form-control" required autofocus>
					</div>

					<div class="">
						<label for="description"><h3>Post Description</h3></label>
						<textarea name="description" rows="7" cols="60" maxlength="250" placeholder="Post Description" id="description" class="form-control space" required></textarea>
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
						<textarea name="content" placeholder="Post Content" id="content" class="form-control space" required></textarea>
					</div>
					<div class="text-center">
						<button class="btn btn-lg btn-primary space" name="publish" type="submit" id="publish">Publish Post</button>
				</div>
				</div>		
				
			</form>
	</div>
</body>
</html>