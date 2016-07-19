<?php
require_once('dbconfig.php');
echo '

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
	<link rel="stylesheet" href="./css/styles.css">	
</head>
<body>
	<header>
		<nav class="navbar navbar-fixed-top navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span> 
     				 </button>
      				<a class="navbar-brand" id="navtitle" href="./">'.BLOG.'</a>
    			</div>
    			<div class="collapse navbar-collapse" id="myNavbar">
	    			<ul class="nav navbar-nav navbar-right">';
	    			if(isset($_SESSION['username']))
	    			{
	  
	    				echo '<li><a href="#" id="session">'.$_SESSION['username'].'</a></li>
		    				<li><a href="index.php">Admin Home</a></li>
		    				<li><a href="new-post.php">New Post</a></li>
		    				<li><a href="categories.php">Categories</a></li>
		     				<li><a href="logout.php" id="logout">Logout</a></li>';
	    			}
				echo '</ul></div></div></nav></header>';
?>