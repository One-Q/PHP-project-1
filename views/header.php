<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" >
		<title>IPL Stage</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_VUES ?>css/stages.css" media="all" >
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
		  	<div class="containe-fluid">
		    	<div class="navbar-header">
		    		<?php if(isset($_SESSION['user'])){?>
		    		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		    			<span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			      	</button>
			      	<?php }?>
		      		<a class="navbar-brand" href="<?php echo $_SESSION['home']; ?>">
		        		<img alt="Brand" id="ipl_logo_index" src="<?php echo CHEMIN_VUES ?>images/ipl_logo.png">
		     		</a>
		     		<?php if(isset($_SESSION['user'])){?>
		        		<h4 class="navbar-text"><?php echo $_SESSION['surname'] . " " . $_SESSION['firstname'] ;?></h4>
		        		<?php } ?>
		    	</div>
		    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    		<?php if( isset($_SESSION['user']) && $_SESSION['job'] == 'student' && $_SESSION['internship'] == -1){ ?>
					<ul class="nav navbar-nav" id="menu-list">
						<li><a href="index.php?action=student">Liste des stages</a></li> 
						<li><a href="index.php?action=submission_internship">Demande de stage</a></li>		
					</ul>
					<?php } if(isset($_SESSION['user'])){ ?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php?action=logout"><img alt="Brand" id="disconnect_logo_index" src="<?php echo CHEMIN_VUES ?>images/disconnect.png" class="img-link"></a></li>
					</ul>
					<?php } ?>
				</div>
		  	</div>
		</nav>
		<div class="container">
		