<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	<title>INSERT FORM</title>
</head>
<body>
<div class="container">
	<div class="row">
		<h1>PERSONEL ADD</h1>
		<hr>
		<div class="col-md-6">
			<form action="<?=base_url('personel/insert'); ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<labe for="">Personel name</labe>
					<input type="text" name="person_name" class="form-control">
				</div>

				<div class="form-group">
					<labe for="">Email</labe>
					<input type="email" name="email" class="form-control">
				</div>

				<div class="form-group">
					<labe for="">Telefon</labe>
					<input type="text" name="telephon" class="form-control">
				</div>

				<div class="form-group">
					<labe for="">Address</labe>
					<input type="text" name="address" class="form-control">
				</div>

				<div class="form-group">
					<labe for="">Departamen</labe>
					<input type="text" name="departamen" class="form-control">
				</div>
				<div class="form-group">
					<labe for="">User_Image</labe>
					<input type="file" name="img_id">
				</div>


				<button type="submit" class="btn btn btn-success">Save</button>
				<a href="<?=base_url(); ?>" class="btn btn btn-danger">Cancel</a>
			</form>
		</div>
	</div>
</div>

</body>
</html>
