<?php $root = $_SERVER['DOCUMENT_ROOT']."/"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>No More Code</title>
		<?php include($root."assets/shared/css.html"); ?>
		<?php include($root."assets/shared/scripts.html"); ?>
	</head>
	<body id="home">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body text-center pb0">
							<i class="fa fa-plus-circle"></i>
							<h5 class="card-title">Create New Project</h5>
							<!-- <div>
								<a href="editor.php" class="btn" data-type="page-transition">CREATE</a>
								</div> -->
						</div>
						<div class="card-footer">
							<a href="#" class="btn" data-type="page-transition" data-toggle="modal" data-target="#createProjectModal">CREATE</a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body text-center">
							<i class="fa fa-download" aria-hidden="true"></i>
							<h5 class="card-title">Import Project</h5>
							<!-- <div class="card-button">
								<a href="#" class="btn">IMPORT</a>
								</div> -->
						</div>
						<div class="card-footer pt1">
							<a href="#" class="btn">IMPORT</a>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body text-center">
							<i class="fa fa-download" aria-hidden="true"></i>
							<h5 class="card-title">Open Project</h5>
							<!-- <div>
								<a href="#" class="btn">Open</a>
								</div> -->
						</div>
						<div class="card-footer pt1">
							<a href="#" class="btn" data-type="page-transition" data-toggle="modal" data-target="#openProjectModal">OPEN</a>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php require_once($root."components/modals.php") ?>

	</body>
</html>