<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="az">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>">

	<title>Login</title>
</head>
<body style="background: #ecf0f1;">
<div class="container">
	<div class="row">

		<div class="col-md-6 col-md-offset-3">
			<h1 class="text-center">Istiifadeci Girisi</h1>
			<hr>

			<?php $alert = $this->session->userdata("alert");
			if($alert){ ?><div class="alert alert-<?=$alert["type"];?>">
				<p><strong><?=$alert["title"];?></strong>&nbsp;<?=$alert["message"];?></p></div>
			<?php } ?>

			<form action="<?=base_url("user/login");?>" method="post">
			<div class="form-group">
					<label for="">E-posta</label>
					<input type="text"  class="form-control" name="email" placeholder="entry user" value="<?=set_value("email");?>">
				</div>

				<div class="form-group">
					<label for="">Password</label>
					<input type="password" autocomplete="off" class="form-control" name="pasw" placeholder="entry user">
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="">Dogrulama Kodu</label>
						<input type="text" name="captcha" placeholder="Entr Code Captcha" class="form-control">
					</div>
					<div class="col-md-3">
				
						<?=$captcha;?>
					</div>
				</div>
				<br>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-md ">Log in</button>
				</div>
			</form>

		</div>
	</div>
</div>

</body>
</html>
