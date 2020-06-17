<?php
    // var_dump($spesifikasi);
    // var_dump($prod);
    $action = $this->uri->segment(3);
?>
<body id="page-top">
	<div id="wrapper">

		<?php $this->load->view("admin/includes/sidebar.php") ?>

		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("admin/includes/breadcrumb.php") ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url("admin/spesifikasi") ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">
						<!--<form action="<?//php base_url("admin/spesifikasi/update") ?>" method="post" enctype="multipart/form-data">-->
						<?php echo form_open("admin/spesifikasi/$action"); ?>
						     <input type="hidden" name="specbarang_id" value="<?php echo ($spesifikasi)?$spesifikasi->specbarang_id:'' ?>">
						     <input type="hidden" name="specbarang_status" value="3">
                            <div class="form-group">
								<label class="control-label">Kategori Utama :</label>
                                <select onchange="show_sub()" name="kat" id="kat" class="form-control">
                                 <option value="0"></option>
                                 <?php foreach($kat as $val){ ?>
                                        <option value="<?= $val->kategori_id?>" <?php if($prod){echo ($val->kategori_id==$prod->kategori_parentid)?'selected':'';}?> ><?=$val->kategori_nama?></option>
                                 <?php } ?>
                                </select>
							</div>
							<div class="form-group">
								<label class="control-label">Sub Kategori :</label>
                                <select onchange="show_prod()" name="sub" id="sub" class="form-control">
                                </select>
							</div>
							<div class="form-group">
								<label class="control-label">Produk :</label>
                                <select name="produk" id="produk" class="form-control" required>
                                </select>
							</div>
							<div class="form-group">
								<label class="control-label" >Ukuran : </label>
								<input id="ukuran" name="ukuran" placeholder="ukuran" value="<?php echo ($spesifikasi)?$spesifikasi->specbarang_ukuran:'' ?>" type="text" maxlength="30"class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" >Bahan : </label>
								<input id="bahan" name="bahan" placeholder="Bahan" value="<?php echo ($spesifikasi)?$spesifikasi->specbarang_bahan:'' ?>" type="text" maxlength="20"
									class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" >Jumlah Sisi : </label>
								<input id="sisi" name="sisi" placeholder="Jumlah Sisi" value="<?php echo ($spesifikasi)?$spesifikasi->specbarang_jmlsisi:'' ?>" type="text" maxlength="20" class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" >Laminasi : </label>
								<input id="bahan" name="laminasi" placeholder="Laminasi" value="<?php echo ($spesifikasi)?$spesifikasi->specbarang_laminasi:'' ?>" type="text" maxlength="20" class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" >Harga (Rp) : </label>
								<input id="harga" name="harga" placeholder="Harga" value="<?php echo ($spesifikasi)?$spesifikasi->specbarang_hargasatuan:'' ?>" type="text" maxlength="20" class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" >Satuan : </label>
								<input id="satuan" name="satuan" placeholder="satuan" value="<?php echo ($spesifikasi)?$spesifikasi->specbarang_satuan:'' ?>" type="text" maxlength="20" class="form-control" />
							</div>
							<!--<div class="form-group">-->
							<!--  <button id="akunupdate" type="submit" class="btn btn-info btn-block">Simpan</button>-->
							<!--</div>-->
							<!--<input class="btn btn-success" type="submit" name="btn" value="Simpan" />-->
						     <div class="form-group">
                               <button id="$action" type="submit" class="btn btn-info btn-block">Simpan</button>
                             </div>
						</form>
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
			<!-- Sticky Footer -->
			<?php $this->load->view("admin/includes/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?//php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?//php $this->load->view("admin/_partials/modal.php") ?>
	<?//php $this->load->view("admin/includes/js.php") ?>
    <script type="text/javascript">
        var base_url = '<?=base_url()?>';
        // $('#kat').change({});
        
        function show_sub(){
    		var id = $('#kat').val();
            $.ajax({
                // url : "'+<?php echo base_url();?>+'kategori/getSub",
                url : base_url+"kategori/getSub",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '<option value="0"></option>';
                    var i;
                    if(id!==null){
                        html = '';
                        for(i=0; i<data.length; i++){
                            html += '<option value="'+data[i].kategori_id+'">'+data[i].kategori_nama+'</option>';
                        }
                    }
                    $('#sub').html(html);
                    show_prod();
                },
                error: function (response) {
                  console.log(response);
                }
            });
        }
        // $('#sub').change({});
        function show_prod(){
    		var id = $('#sub').val();
    		var selected = '';
            $.ajax({
                url : window.base_url+"kategori/getProduk",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var produk = '';
                    var i;
                    if(id!==null){
                        for(i=0; i<data.length; i++){
                            if(data[i].kategori_id==<?php echo ($prod)?$prod->kategori_id:0; ?>){
                                selected = 'selected';
                            } else {
                                selected = '';
                            }
                            produk += '<option value="'+data[i].kategori_id+'" '+selected+'>'+data[i].kategori_nama+'</option>';
                        }
                    }
                    $('#produk').html(produk);
                },
                error: function (response) {
                  console.log(response);
                }
            });
        }
        <?php if($action=='ubah'){ ?>
        show_sub();
        // show_prod();
        <?php } ?>
    </script>
</body>