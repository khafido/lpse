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
					<!--<a href="" data-toggle="modal" data-target="#form_modal" ><i class="fas fa-plus"></i> Tambah Kategori</a>-->
					<a href="<?=base_url()?>admin/kategori/tambah/baru"><i class="fas fa-plus"></i> Tambah Kategori</a>
				</div>
				<div class="card-body">
					<div class="col-md-6">
						<div class="list-group card card-news" style="padding:10px 0px;">
							<?php $x=0; $y=0; foreach($parent as $val){ ?>
							<div clas="col-md-12" style="padding-left:20px;">
							    <div class="col-md-12">
    								<a href="#item-<?=$x?>" style="" class="list" data-toggle="collapse">
    									<i class="fas fa-angle-right"></i> <?=$val->kategori_nama?>
    								</a>
    								<a href="<?=base_url()?>admin/kategori/hapus/<?=$val->kategori_id?>" class="btn btn-danger" style="float:right; margin-right:30px;">Hapus</a>
        							<a href="<?=base_url()?>admin/kategori/ubah/<?=$val->kategori_id?>" class="btn btn-primary mr-1" style="float:right;">Ubah</a>
    							</div>
							</div>
							<div class="list-group collapse col-md-12" id='item-<?php echo"$x"; ?>'>
								<?php foreach($controller->getSub($val->kategori_id) as $sub){?>
								<div class="col-md-12 py-2" style="">
									<div class="col-md-12">
    									<a style="margin-left:20px; background:;" href='#item-<?php echo "$x-$y"?>' class="list" data-toggle="collapse" style="">
    										<i class="fas fa-angle-right"></i> <?=$sub->kategori_nama?>
    									</a>
									    <a href="<?=base_url()?>admin/kategori/hapus/<?=$sub->kategori_id?>" class="btn btn-danger" style="float:right;">Hapus</a>
    									<a href="<?=base_url()?>admin/kategori/ubah/<?=$sub->kategori_id?>" class="btn btn-primary mr-1" style="float:right;">Ubah</a>
									</div>
								</div><hr/>
								<div class="list-group collapse" id="item-<?php echo "$x-$y"; ?>">
									<div class="col-md-12"></div>
									<?php foreach($controller->getProduk($sub->kategori_id) as $produk){ ?>
									<div class="col-md-12 py-2" style="">
									    <div class="col-md-12">
    										<li style="margin-left:40px;" class='list'>
    											<?=$produk->kategori_nama?>
    											<a href="<?=base_url()?>admin/kategori/hapus/<?=$produk->kategori_id?>" class="btn btn-danger" style="float:right;">Hapus</a>
    									        <a href="<?=base_url()?>admin/kategori/ubah/<?=$produk->kategori_id?>" class="btn btn-primary mr-1" style="float:right;">Ubah</a>
    										</li>
									    </div>
									</div><hr>
									<?php } $y++;?>
								</div><hr/>
								<?php } $x++;?>
							</div>
							<hr/>
							<?php } ?>
						</div>
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
		$('.list').on('click', function() {
			$('.fas', this)
				.toggleClass('fas fa-angle-right')
				.toggleClass('fas fa-angle-down');
		});
	</script>
	
</body>

</html>