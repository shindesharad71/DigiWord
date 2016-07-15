<?php
	$title = 'Categories';
	session_start();
	require_once('../inc/dbconfig.php');
	if(!isset($_SESSION['username']))
	{
		echo '<script>setTimeout(function () { window.location.href = "../admin/login.php";}, 5);</script>';
		die();
	}
?>
		<div class="container col-md-offset-3 col-md-6 topspace">
			<div class="text-center">
				<p><a class="btn btn-primary btn-sm" href='add-category.php'>Add Category</a></p>
			</div>

			<?php
		    	if(isset($_GET['action']))
				{ 
        			echo '<h3>Category '.$_GET['action'].'.</h3>'; 
    			} 

		    	$query = "SELECT catID, catTitle, catSlug FROM blog_cats ORDER BY catTitle DESC";
				$result = mysqli_query($con,$query);
				if (mysqli_num_rows($result) > 0)
				{
					echo '<table class="table table-hover"><tr class="info"><th>Title</th><th>Action</th></tr>';
					while($row = mysqli_fetch_assoc($result))
					{    
						
						echo '<tr>';
						echo '<td>'.$row['catTitle'].'</td>';
						?>
						<td>
                    		<a href="edit-category.php?id=<?php echo $row['catID'];?>">Edit</a> | 
                    		<a href="delcat.php?id=<?php echo $row['catID'];?>">Delete</a>
                		</td>

                		<?php
                		echo '</tr>';

					}

					echo '</table>';
				}
				else
				{
					echo '<div class="alert alert-warning text-center"><h3>no categories found!</h3></div>';
					die();
				}
		?>
	</div>
</body>
</html>