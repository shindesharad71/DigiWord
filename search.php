<?php

	$title = "Sarch Results";
	require_once('inc/dbconfig.php');
	$key = $_GET['term'];

	$query = "SELECT * FROM blog_posts WHERE postTitle LIKE '%".$_GET['term']."%' OR description LIKE '%".$_GET['term']."%' OR content  LIKE '%".$_GET['term']."%'";
	$result = mysqli_query($con,$query);

	echo '<div class="topspace container-fluid">';

		if(mysqli_num_rows($result) > 0)
		{

			echo '<h3 class="text-center">Search Results for  "<i>'.$_GET['term'].'</i>"</h3>';

			while($row = mysqli_fetch_assoc($result))
			{
				echo '<div class="col-md-9 col-sm-12"><div class="postbox">';
				$search_title = '<h1 id="posttitle"><a href="viewpost.php?id='.$row['id'].'&title='.$row['postTitle'].'">'.$row['postTitle'].'</a></h1>';
				echo preg_replace("/\w*?$key\w*/i", "<mark>$0</mark>", $search_title);
			    
			    $search_auther = '<p id="postdate"><i>Posted on '.date('jS M Y H:i:s', strtotime($row['post_date'])).'</i> by '.$row['auther'];
			    echo preg_replace("/\w*?$key\w*/i", "<mark>$0</mark>", $search_auther);

			    $search_description = '<p><h4 id="description">'.$row['description'].'</h4></p>';
			    echo preg_replace("/\w*?$key\w*/i", "<mark>$0</mark>", $search_description);

			    echo '<p><a class="btn btn-sm btn-primary" href="viewpost.php?id='.$row['id'].'&title='.$row['postTitle'].'">Read More</a></p>';                
			    echo '</div></div>';
			}
		}
  		
  		if(mysqli_num_rows($result) == 0)
  		{
  			echo  '<div class="col-md-9 col-sm-12 topspace"><h4 class="col-md-offset-1 col-md-6 alert alert-warning text-center">sorry, no results found</h4></div>';
  		}

?>

	<div class="col-md-3">
	<?php

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
	?>
	</div>

