<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	<title>Welcome to CodeIgniter</title>


</head>
<body>

<div class="container">
	<div class="row">

			<h1 class="text-center">Personal List</h1>
			<hr>
		
				<?php
				if(isset($list))
				{
					 ?>
					 <?php $alert = $this->session->userdata("alert");
		if($alert){ ?>
			<div class="alert alert-<?=$alert["type"];?>">
			<p><strong><?=$alert["title"];?></strong>&nbsp;<?=$alert["message"];?></p></div>
		     <?php } ?>
		     <a href="<?=base_url('personel/insert_form'); ?>" class="btn btn-primary btn-sm">New Add</a>
			
					 <table class="table table-bordered table-hover table-striped">
				<thead>
				<th>#ID</th>
				<th>Foto</th>
				<th>
					Ad/Soy <a href="<?=base_url('personel/order_by/person_name/ASC'); ?>">[a-Z]</a>
					<a href="<?=base_url('personel/order_by/person_name/DESC'); ?>">[Z-a]</a>
				</th>

				<th>
					E-mail <a href="<?=base_url('personel/order_by/email/ASC'); ?>">[a-Z]</a>
					<a href="<?=base_url('personel/order_by/email/DESC'); ?>">[Z-a]</a>
				</th>

				<th>
					Telefon <a href="<?=base_url('personel/order_by/telephon/ASC'); ?>">[0-9]</a>
					<a href="<?=base_url('personel/order_by/telephon/DESC'); ?>">[9-0]</a>
				</th>

				<th>
					Departamed <a href="<?=base_url('personel/order_by/departamen/ASC'); ?>">[a-Z]</a>
					<a href="<?=base_url('personel/order_by/departamen/DESC'); ?>">[Z-a]</a>
				</th>

				<th>
					Address <a href="<?=base_url('personel/order_by/address/ASC'); ?>">[a-Z]</a>
					<a href="<?=base_url('personel/order_by/address/DESC'); ?>">[Z-a]</a>
				</th>
				<th>view</th>
				<th>view in pdf</th>
				<th>ayarlar</th>
				</thead>
				<tbody>

					 <?php
					foreach($list as $row)
					{
						echo '
						<tr>
							<td>'.$row->id.'</td>
							<td><img style="width: 60px" src="'.base_url().'uploads/'.$row->img_id.'" alt=""></td>
							<td>'.$row->person_name.'</td>
							<td>'.$row->email.'</td>
							<td>'.$row->telephon.'</td>
							<td>'.$row->departamen.'</td>
							<td>'.$row->address.'</td>
							<td><a href="'.base_url().'personel/details/'.$row->id .'">view</a></td>
							<td><a href="'.base_url().'personel/pdfdetails/'.$row->id .'">view in pdf</a></td>
							<td>
								<a href="'.base_url().'personel/update_form/'.$row->id.'" class="btn btn-xs btn-warning">Duzenle</a>
								<a href="'.base_url().'personel/delete/'.$row->id.'" class="btn btn-xs btn-danger">Sil</a>
							</td>
						</tr><br>
                        ';

					}
					?>

				</tbody>
			</table>
	</div>
	<?php
				}
				if(isset($vt_details))
				{
					echo $vt_details;
				}
				?>
			
</div>
<?php
		$user = $this->session->userdata("user");
		if ($user){?>
		<span ><strong style="color: #2c3e50; font-size: 20px;"><?=$user['user_name'];?> </strong>: Olarak oturum acildi <a href="<?=base_url("user/logout");?>">Loguot</a> </span>
		<?php } ?>
</body>
</html>
