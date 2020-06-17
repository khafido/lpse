<!DOCTYPE html>
<html lang="en">
<body id="page-top">
<div id="wrapper">

	<?php $this->load->view("admin/includes/sidebar.php") ?>

	<div id="content-wrapper">
	  <div class="container-fluid">
	<?php $this->load->view("admin/includes/breadcrumb.php") ?>
	    
		<div class="card mb-3">
		<div class="card-header">
			<a href="<?php echo site_url('register') ?>"><i class="fas fa-plus"></i> Tambah Pengguna</a>
		</div>
		<div class="card-body">

			<div class="table-responsive">
				<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Telepon</th>
							<th>Alamat</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
						<tr>
							<td>
								<img src="<?php echo base_url('assets/images/foto/'.$user->user_imgurl) ?>" width="64" />
							</td>
							<td>
								<?php echo $user->user_nama ?>
							</td>
							<td>
								<?php echo $user->user_email ?>
							</td>							
							<td>
								<?php echo $user->user_telpon ?>
							</td>
							<td>
								<?php echo $user->user_alamat ?>
							</td>
							<td width="180">
								<a href="<?php echo site_url('admin/pengguna/ubah/'.$user->user_id) ?>"
								 class="btn btn-small"><i class="fas fa-edit"></i> Ubah</a>
								<a onclick="deleteConfirm('<?php echo site_url('admin/pengguna/delete/'.$user->user_id) ?>')"
								 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
							</td>
						</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>

		<!-- Sticky Footer -->
		<?php $this->load->view("admin/includes/footer.php") ?>

	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<?//php $this->load->view("admin/_partials/scrolltop.php") ?>
<?php $this->load->view("admin/includes/modal.php") ?>
<?//php $this->load->view("admin/includes/js.php") ?>
<script>
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
	</script>
    
</body>
</html>
