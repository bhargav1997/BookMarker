<?php

session_start();
if (isset($_POST['name'])) {
	if (isset($_SESSION['bookmarks'])) {
		$_SESSION['bookmarks'][$_POST['name']]=$_POST['url'];
	}else{
		$_SESSION['bookmarks']=Array($_POST['name']=>$_POST['url']);
	}
}
if (isset($_GET['action'])&&$_GET['action']=='clear') {
	session_unset();	
	session_destroy();
	header("Location:index.php");
}

if (isset($_GET['action'])&&$_GET['action']=='delete') {
	unset($_SESSION['bookmarks'][$_GET['name']]);
	header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bookmarker</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
	  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
<style type="text/css">

	.delete{
		color:gray;
		padding-left:16px;
	}
</style>
</head>
<body> 
	<nav class="navbar navbar-expand-md navbar-inverse bg-dark m-auto">
		      <a class="navbar-brand" href="#">Bookmarker</a>
			       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			        <span class="navbar-toggler-icon"></span>
			      </button>


		      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
			       <ul class="navbar-nav mr-auto">
			          <li class="nav-item">
			            <a class="nav-link" href="index.php">Home</a>
			          </li>
			      </ul>
			      <ul class="navbar-nav navbar-right">
			          <li class="nav-item">
			            <a class="nav-link" href="index.php?action=clear">Clear All</a>
			          </li>
			      </ul>
		      </div>
    </nav>
    <div class="container">
    	<div class="row">
    		<div class="col-md-7">
    			<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
    				<div class="form-group mt-2">
    					<label>
    						Website Name
    					</label>
    					<input type="text" name="name" class="form-control"/>
    				</div>
    				<div class="form-group">
    					<label>
    						Website URL
    					</label>
    					<input type="text" name="url" class="form-control"/>
    				</div>
    			<input type="submit" class="btn btn-default" value="submit">
    			</form>
    		</div>
    		<div class="col-md-5 mt-4">
    			<?php if(isset($_SESSION['bookmarks'])):?>
    				<ul class="list-group">
    					<?php foreach($_SESSION['bookmarks'] as $name => $url):?>
    						<li class="list-group-item">
    						<a href="<?php echo $url; ?>">
    						<?php
    						echo $name;
    						?>
    						</a>
    						<a href="index.php?action=delete&name=<?php echo $name;?>" class="delete">
    							Delete
    						</a>
    						</li>
    					<?php endforeach;?>
    				</ul>
    			<?php endif;?>
    		</div>
    	</div>
    </div>

  <footer id="main-footer" class="text-white mt-4 p-5 bg-primary fixed-bottom">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; 2018-19 BookMarker</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>