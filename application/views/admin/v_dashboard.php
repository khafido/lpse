<!DOCTYPE html>
<html lang="en">
<body id="page-top">
<div id="wrapper">

	<?php $this->load->view("admin/includes/sidebar.php") ?>

	<div id="content-wrapper">

		<div class="container-fluid">

        <!-- 
        karena ini halaman overview (home), kita matikan partial breadcrumb.
        Jika anda ingin mengampilkan breadcrumb di halaman overview,
        silahkan hilangkan komentar (//) di tag PHP di bawah.
        -->
		<?//php $this->load->view("admin/_partials/breadcrumb.php") ?>

		<!-- Icon Cards-->
		<div class="row">
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-primary o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<!--<i class="fas fa-fw fa-comments"></i>-->
				</div>
				<div class="mr-6"><?php echo $pemilihan?> Status Pemilihan Mitra</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="/admin/garapan/Pemilihan">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-warning o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<!--<i class="fas fa-fw fa-list"></i>-->
				</div>
				<div class="mr-5"><?php echo $pengerjaan?> Status Pengerjaan</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="/admin/garapan/Pengerjaan">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-success o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<!--<i class="fas fa-fw fa-shopping-cart"></i>-->
				</div>
				<div class="mr-5"><?php echo $selesai?> Status Selesai</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="/admin/garapan/Selesai">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-danger o-hidden h-100">
				<div class="card-body">
				<div class="card-body-icon">
					<!--<i class="fas fa-fw fa-life-ring"></i>-->
				</div>
				<div class="mr-5"><?php echo $kedaluarsa?> Status Kedaluarsa</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="/admin/garapan/Kedaluarsa">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
			</div>
		</div>

		<!-- Area Chart Example-->
		<!--<div class="card mb-3">-->
		<!--	<div class="card-header">-->
		<!--	<i class="fas fa-chart-area"></i>-->
		<!--	Visitor Stats</div>-->
		<!--	<div class="card-body">-->
		<!--	<canvas id="myAreaChart" width="100%" height="30"></canvas>-->
		<!--	</div>-->
		<!--	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
		<!--</div>-->

		</div>
		<!-- /.container-fluid -->

		<!-- Sticky Footer -->
		<?php $this->load->view("admin/includes/footer.php") ?>

	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<?//php $this->load->view("admin/_partials/scrolltop.php") ?>
<?php $this->load->view("admin/includes/modal.php") ?>
<?//php $this->load->view("admin/includes/js.php") ?>
    
</body>
</html>
