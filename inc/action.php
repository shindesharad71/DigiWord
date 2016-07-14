<?php
		
	require_once('dbconfig.php');
	//************************************* login  *****************************************************

	$verify = "SELECT * FROM login";
	$resverify = mysqli_query($con,$verify);
			
	if($resverify)
	{
		$rows = mysqli_affected_rows($con);
		if($rows<1)
		{
			$q = "INSERT INTO login (id, username, password) VALUES (NULL, '$admin', '$adminpass')";
			mysqli_query($con,$q);
			$login = 1;
		}
	}
	else
	{

		$query1 = "CREATE TABLE login (
					id int(10) NOT NULL AUTO_INCREMENT,
					username varchar(25) NOT NULL UNIQUE,
					password varchar(25) NOT NULL,
					PRIMARY KEY (id)
					)";
		$result1 = mysqli_query($con,$query1);

		if($result1)
		{
			$q = "INSERT INTO login (id, username, password) VALUES (NULL, '$admin', '$adminpass')";
			mysqli_query($con,$q);
			$rows = mysqli_affected_rows($con);
			if($rows==1)
			{
				$login = 1;
			}
			else
			{
				echo 'error while inserting admin record';
				die();
			}
		} // end of is-result1-true if
		else
		{
			echo 'error while creating table login';
			die();
		}

	} // end of resverify-else of login

//************************************************* blog_posts  **********************************************

	$verify2 = "SELECT * FROM blog_posts";
	$resverify2 = mysqli_query($con,$verify2);
			
	if($resverify2)
	{	
		$row1hello = mysqli_affected_rows($con);
		if($row1hello<1)
		{
			$hellopost = "INSERT INTO `blog_posts` (`id`, `postTitle`, `description`, `content`, `post_date`, `auther`, `catinfo`) VALUES (NULL, 'Hello World', 'This is a Sample Post for saying blog setup is successfully completed, you good to go for blogging!', 'Good luck!', CURRENT_TIMESTAMP, 'You', '1')";
				mysqli_query($con,$hellopost);
				$rowhello = mysqli_affected_rows($con);
				if($rowhello==1)
				{
					$blog_posts = 1;
				}
				else
				{
					echo 'error while inserting hello-post1';
					die();
				}
		}	
	}
	else
	{

		$query2 = "CREATE TABLE blog_posts (
				id int(11) NOT NULL AUTO_INCREMENT,
				postTitle varchar(200) NOT NULL,
				description text NOT NULL,
				content text NOT NULL,
				post_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				auther varchar(25) NOT NULL,
				catinfo varchar(11),
				PRIMARY KEY (id)
			)";

		$result2 = mysqli_query($con,$query2);

		if($result2)
		{
			$row1hello = mysqli_affected_rows($con);
			if($row1hello<1)
			{
				$hellopost = "INSERT INTO `blog_posts` (`id`, `postTitle`, `description`, `content`, `post_date`, `auther`, `catinfo`) VALUES (NULL, 'Hello World', 'This is a Sample Post for saying blog setup is successfully completed, you good to go for blogging!', 'Good luck!', CURRENT_TIMESTAMP, 'You', '1')";
					mysqli_query($con,$hellopost);
					$rowhello = mysqli_affected_rows($con);
					if($rowhello==1)
					{
						$blog_posts = 1;
					}
					else
					{
						echo 'error while inserting hello-post1';
						die();
					}
			}
			
		} // end of is-result2-true if
		else
		{
			echo 'error creating table blog_posts';
			die();
		}

	} // end of resverify-else of blog_posts

//************************************************** blog cats ****************************************************

	$verify3 = "SELECT * FROM blog_cats";
	$resverify3 = mysqli_query($con,$verify3);
			
	if($resverify3)
	{	
		$rownum = mysqli_affected_rows($con);
		if($rownum<1)
		{
			$q1 = "INSERT INTO blog_cats (catID, catTitle, catSlug) VALUES (NULL, 'Uncategorised', 'uncategorised')";
			mysqli_query($con,$q1);
			$rows1 = mysqli_affected_rows($con);
			if($rows1==1)
			{
				$blog_cats = 1;
			}
			else
			{
				echo 'error while inserting category record';
				die();
			}	
		}
		
	}
	else
	{
		$query3 = "CREATE TABLE blog_cats (
				catID int(11) NOT NULL AUTO_INCREMENT,
				catTitle varchar(200) NOT NULL,
				catSlug varchar(200) NOT NULL,
				PRIMARY KEY (catID)
			)";

		$result3 = mysqli_query($con,$query3);

		if($result3)
		{
			$rowsz = mysqli_affected_rows($con);
			if($rowsz<1)
			{
				$q1 = "INSERT INTO blog_cats (catID, catTitle, catSlug) VALUES (NULL, 'Uncategorised', 'uncategorised')";
				mysqli_query($con,$q1);
				$rows1 = mysqli_affected_rows($con);
				if($rows1==1)
				{
					$blog_cats = 1;
				}
				else
				{
					echo 'error while inserting category record';
					die();
				}
			}		
		} // end of is-result3-true if
		
		else
		{
			echo 'error creating table blog_cats';
			die();
		}

	} // end of resverify-else of blog_cats

$install = 1;
?>