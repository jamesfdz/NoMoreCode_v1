<?php $root = $_SERVER['DOCUMENT_ROOT']."/"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>No More Code</title>
	
	<?php include($root."assets/shared/css.html"); ?>

    <?php include($root."assets/shared/scripts.html"); ?>
	
	
</head>
<body>	
	<div class="row Absolute-Center is-Responsive">
	  <div class="col-sm-6">
	    <div class="card">
	      <div class="card-body text-center">
	      	<i class="fa fa-plus-circle"></i>
	        <h5 class="card-title">Create New Project</h5>
	        <a href="editor.php" class="btn" data-type="page-transition">CREATE</a>
	      </div>
	    </div>
	  </div>
	  <div class="col-sm-6 pr283">
	    <div class="card">
	      <div class="card-body text-center">
	      	<i class="fa fa-download" aria-hidden="true"></i>
	        <h5 class="card-title">Import Project</h5>
	        <a href="#" class="btn">IMPORT</a>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>