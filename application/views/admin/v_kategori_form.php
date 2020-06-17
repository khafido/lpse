<?php
var_dump($detail);
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
						<a href="<?php echo site_url("admin/kategori") ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<!--<form action="<?//php base_url("admin/spesifikasi/update") ?>" method="post" enctype="multipart/form-data">-->
						<?php echo form_open("admin/kategori/$action/"); ?>
							<!--<div class="body">-->
								<div class="form-group">
									<label class="col-form-label">Nama Kategori :</label><br>
									<!--<div class="col-md-8">-->
										<input type="text" name="name" id="name" class="form-control" placeholder="Nama Kategori" value="<?php echo ($detail)?$detail->kategori_nama:null; ?>" required />
										<?php echo form_error('name'); ?>
									<!--</div>-->
								</div>
								<div class="form-group" id="parent_group">
									<label class="col-form-label">Kategori Utama :</label><br>
									<!--<div class="col-md-8">-->
										<select onchange="show_sub()" name="kat" id="kat" class="form-control">
										    <option value="0"></option>
										    <?php
										        $selected= '';
										        foreach($kat as $val){
										            $selected = ($detail->kategori_parentid==$val->kategori_id)?'selected':'';
										            echo "<option value='$val->kategori_id' $selected>$val->kategori_nama</option>";
										        }
										    ?>
										</select>
									<!--</div>-->
								</div>
								<div class="form-group" id="sub_group">
									<label class="col-form-label">Sub Kategori</label><br>
									<!--<div class="col-md-8">-->
										<select name="sub" id="sub" class="sub form-control">
											<option value="0"></option>
										</select>
									<!--</div>-->
								</div>
							<!--</div>-->
							<input type="hidden" name="kid" id="kid" value="<?php echo ($detail)?$detail->kategori_id:null; ?>" class="form-control">
							<!--<input type="hidden" name="kategori_parentid" id="kategori_parentid" class="form-control">-->
							<!--<input type="hidden" name="id_sub" id="id_sub" class="form-control">-->
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
    <script>
        var base_url = '<?php echo base_url();?>';
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
                    var selected = '';
                    // if(id!==null){
                        if(data.length>0){
                            for(i=0; i<data.length; i++){
                                if(data[i].kategori_id==<?php echo ($detail)?$detail->kategori_subparentid:0; ?>){
                                    selected = 'selected';
                                } else {
                                    selected = '';
                                }
                                html += '<option value="'+data[i].kategori_id+'" '+selected+'>'+data[i].kategori_nama+'</option>';
                            }
                        }
                    // }
                    $('#sub').html(html);
                },
                error: function (response) {
                  console.log(response);
                }
            });
        }
        if("<?=$action?>"==="ubah"){
            show_sub();
        }
    </script>
</body>