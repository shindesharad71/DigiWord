<?php
	$title = "BLOG";
	require_once('inc/dbconfig.php');
?>

	<div class="container-fluid topspace">
			<?php

				$query = "SELECT id, postTitle, description, post_date, auther, catinfo FROM blog_posts ORDER BY id DESC";
				$result = mysqli_query($con,$query);

				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<div class="col-md-9 col-sm-12"><div class="postbox">';
			                echo '<h1 id="posttitle"><a href="viewpost.php?id='.$row['id'].'&title='.$row['postTitle'].'">'.$row['postTitle'].'</a></h1>';
			                echo '<p id="postdate"><i>Posted on '.date('jS M Y H:i:s', strtotime($row['post_date'])).'</i> by '.$row['auther'];

			///////////////////////////////////  Categoty Code //////////////////////////////////////////////////////
				
						$forcat = "SELECT catID, catTitle, catSlug FROM blog_cats WHERE catID = ".$row['catinfo']."";
						$result1 = mysqli_query($con,$forcat);
						if (mysqli_num_rows($result1) > 0)
						{
							while($row1 = mysqli_fetch_assoc($result1))
							{			
								echo ' in <a href="viewbycat.php?catid='.$row1['catID'].'&category='.$row1['catTitle'].'">'.$row1['catTitle'].'</a></p>';
							}
						}
							

			/////////////////////////////////// Categoty Code end //////////////////////////////////////////////////////

			                echo '<p><h4 id="description">'.$row['description'].'</h4></p>';                
			                echo '<p><a class="btn btn-sm btn-primary" href="viewpost.php?id='.$row['id'].'&title='.$row['postTitle'].'">Read More</a></p>';                
			            	echo '</div></div>';
					} // Post list while closed.		

	//**************************************************** Category list  ***************************************

					$catq = "SELECT catID, catTitle, catSlug FROM blog_cats";
					$result3 = mysqli_query($con,$catq);
					if (mysqli_num_rows($result3) > 0)
					{
						echo '<div class="col-md-3 col-sm-12"><div class="recent"><h2>Categories</h2><ul class="list-group">';
							while($row3 = mysqli_fetch_assoc($result3))
							{
					            
								$catnum = "SELECT id, content, catinfo FROM blog_posts WHERE catinfo = ".$row3['catID']."";
								$rescat = mysqli_query($con,$catnum);
								$num = mysqli_num_rows($rescat);

					            echo '<li class="list-group-item"><a href="viewbycat.php?catid='.$row3['catID'].'&category='.$row3['catTitle'].'">'.$row3['catTitle'].'&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">'.$num.'</span></a></li>';
					        
					        } // category while closed

					        echo '</ul></div></div>';

					} // category if closed

		//**************************************************** Category list closed ***************************************	

				} // Post list if closed.
				else
				{
					echo '<div class="alert alert-warning text-center col-md-offset-4 col-md-4 col-sm-12"><h3>no posts found, visit after sometime!</h3></div>';
					die();
				}

				mysqli_close($con);

			?>
		</div>
</body>
</html>
