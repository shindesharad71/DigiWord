<?php
	$title = $_GET['title'];
	require_once('inc/dbconfig.php');
	$id = $_GET['id'];
?>	

	<div class="container-fluid topspace">
			<?php

				$query = "SELECT id, postTitle, description, content, post_date, auther, catinfo FROM blog_posts WHERE id = '$id'";
				$result = mysqli_query($con,$query);


				if (mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<div class="col-md-9 col-sm-12"><div id="bigpost">';
			                echo '<h1 id="posttitle">'.$row['postTitle'].'</h1>';
			                echo '<p id="postdate"><i>Posted on '.date('jS M Y H:i:s', strtotime($row['post_date'])).'</i> by '.$row['auther'];

			/////////////////////////////////// Post Categoty Code //////////////////////////////////////////////////////
				
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
			                
			                echo '<p><h4 id="description1">'.$row['description'].'</h4></p>';
			                echo '<p><h3 id="content">'.$row['content'].'</h3></p>';                           
			            echo '</div></div>';
			            ?>
			        <div class="col-md-3 col-sm-12">

			    <?php

					} // viewpost while closed

	//********************************************* Recent Posts *****************************************

					$query2 = "SELECT id, postTitle FROM blog_posts ORDER BY id DESC LIMIT 0,5";
					$result2 = mysqli_query($con,$query2);
					if (mysqli_num_rows($result2) > 0)
					{
						echo '<div class="recent"><h2>Recent Posts</h2><ul class="list-group">';
							while($row2 = mysqli_fetch_assoc($result2))
							{
					            echo '<li class="list-group-item"><a href="viewpost.php?id='.$row2['id'].'&title='.$row2['postTitle'].'">'.$row2['postTitle'].'</a></li>';
					        } // recent while closed

					        echo '</ul></div>';

				    } // recent if closed 

	//*********************************************** Categories list ************************************

				   $catq = "SELECT catID, catTitle, catSlug FROM blog_cats";
					$result3 = mysqli_query($con,$catq);
					if (mysqli_num_rows($result3) > 0)
					{
						echo '<div class="recent"><h2>Categories</h2><ul class="list-group">';
							while($row3 = mysqli_fetch_assoc($result3))
							{
					            
								$catnum = "SELECT id, content, catinfo FROM blog_posts WHERE catinfo = ".$row3['catID']."";
								$rescat = mysqli_query($con,$catnum);
								$num = mysqli_num_rows($rescat);

					            echo '<li class="list-group-item"><a href="viewbycat.php?catid='.$row3['catID'].'&category='.$row3['catTitle'].'">'.$row3['catTitle'].'&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">'.$num.'</span></a></li>';
					        
					        } // category while closed

					        echo '</ul></div>';

					} // category if closed

				} // big if closed

				else
				{
					echo '<div class="alert alert-warning text-center"><h3>error while retriving post!</h3></div>';
					die();
				}

			?>
</div>
</div>
</body>
</html>