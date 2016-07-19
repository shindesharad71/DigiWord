<?php	
	session_start();
	$title = 'Admin Panel';
	require_once('../inc/dbconfig.php');
	if(!isset($_SESSION['username']))
	{
		echo '<script>setTimeout(function () { window.location.href = "../admin/login.php";}, 5);</script>';
		die();
	}
?>
	<div class="container topspace">
		<div class="text-center">
				<p><a class="btn btn-primary btn-sm" href='new-post.php'>New Post</a></p>
		</div>
			<?php

				$query = "SELECT id, postTitle, description, post_date, auther, catinfo FROM blog_posts ORDER BY id DESC";
				$result = mysqli_query($con,$query);


				if (mysqli_num_rows($result) > 0)
				{
					echo '<table class="table table-hover"><tr class="info"><th>Title</th><th>Category</th><th>Date</th><th>Auther</th><th>Action</th></tr>';
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<tr>';
			                echo '<td><h4><a href="../viewpost.php?id='.$row['id'].'&title='.$row['postTitle'].'">'.$row['postTitle'].'</a></h4></td>';

			//*********************************** category ************************************************************

			        $forcat = "SELECT catID, catTitle, catSlug FROM blog_cats WHERE catID = ".$row['catinfo']."";
						$result1 = mysqli_query($con,$forcat);

						if (mysqli_num_rows($result1) > 0)
						{
							while($row1 = mysqli_fetch_assoc($result1))
							{			
								echo '<td><a href="../viewbycat.php?catid='.$row1['catID'].'&category='.$row1['catTitle'].'">'.$row1['catTitle'].'</a></td>';
							}
						}
						else echo '<td> - </td>';
			//*********************************** category end ************************************************************
			                
			                echo '<td><i>'.date('jS M Y H:i:s', strtotime($row['post_date'])).'</td><td></i>'.$row['auther'].'</td>';
			                ?>

			                <td>
			            <?php               
			                echo '<a href="edit.php?id='.$row['id'].'&title='.$row['postTitle'].'">Edit</a>';
			                echo ' | ';
			                echo '<a href="delete.php?id='.$row['id'].'&title='.$row['postTitle'].'">Delete</a>';              
			            echo '</td>';
			            echo '</tr>';					
					}

					echo '</table>';
				}
				else
				{
					echo '<div class="alert alert-warning text-center"><h3>no posts found, visit after sometime!</h3></div>';
					die();
				}

				mysqli_close($con);

			?>
		</div>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>