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
			<a href="<?php echo site_url('admin/spesifikasi/tambah/new') ?>"><i class="fas fa-plus"></i> Tambah Spesifikasi</a>
		</div>
		<div class="card-body">

			<div class="table-responsive" >
				<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead style="text-align: center;">
						<tr>
							<th>Kategori</th>
							<th>Ukuran</th>
							<th>Bahan</th>
							<th>Jumlah&nbspSisi</th>
							<th>Laminasi</th>
							<th>Harga</th>
							<th>Satuan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody style="text-align: center;">
						<?php foreach ($spesifikasi as $val): ?>
						<tr>
							<td>
								<?php echo $val->kategori_nama ?>
							</td>
							<td>
								<?php echo $val->specbarang_ukuran ?>
							</td>
							<td>
								<?php echo $val->specbarang_bahan ?>
							</td>							
							<td>
								<?php echo $val->specbarang_jmlsisi ?>
							</td>
							<td>
								<?php echo $val->specbarang_laminasi ?>
							</td>
							<td>
								<?php echo "Rp.&nbsp".number_format($val->specbarang_hargasatuan) ?>
							</td>
							<td>
								<?php echo $val->specbarang_satuan ?>
							</td>
							<td width="180">
								<a href="<?php echo site_url('admin/spesifikasi/ubah/'.$val->specbarang_id) ?>"
								 class="btn btn-small"><i class="fas fa-edit"></i> Ubah</a>
								<a onclick="deleteConfirm('<?php echo site_url('admin/spesifikasi/delete/'.$val->specbarang_id) ?>')"
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
