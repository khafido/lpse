<?php
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
						<a href="<?php echo site_url("admin/pengguna") ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">
						<!--<form action="<?//php base_url("admin/users/update") ?>" method="post" enctype="multipart/form-data">-->
						<?php echo form_open_multipart("admin/pengguna/$action"); ?>
						     <input type="hidden" name="user_id" value="<?php echo ($users)?$users->user_id:'' ?>">
							<div class="form-group">
								<div class="col-xs-12">
									<label for="photo">Photo Profile</label>

									<input type="file" name="file" accept="image/*" class="form-control" />
								</div>
								<label class="control-label" for="signupName">Nama : </label>
								<input id="signupName" name="name" placeholder="Nama" value="<?php echo ($users)?$users->user_nama:'' ?>" type="text" maxlength="50" class="form-control" />
							</div>
							<?php if($this->uri->segment(3)==='add'){ ?>
                            <div class="form-group">
                                <label class="control-label" for="signupEmail">Email</label>
                                <input id="signupEmail" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" type="email" maxlength="50" class="form-control" required/>
                            <span class="text text-danger"><?php echo form_error('email'); ?></span>
                               </div>
							<?php } ?>
							
							<div class="form-group">
								<label class="control-label" for="signupTelp">Nomor Telepon : </label>
								<input id="signupTelp" name="telp" placeholder="Telepon" value="<?php echo ($users)?$users->user_telpon:'' ?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="15"
									class="form-control" />
							</div>
							<div class="form-group">
								<label class="control-label" for="parent">Provinsi :</label>
                                <select name="prov" id="prov" class="form-control">
                                 <option value="0"></option>
                                 <?php foreach($prov as $val){ ?>
                                        <option value="<?=$val->id?>" <?php echo ($val->id==$provid)?'selected':''; ;?>><?=$val->nama?></option>
                                 <?php } ?>
                                </select>
							</div>
							<div class="form-group">
								<label class="control-label" for="kota">Kabupaten / Kota :</label>
								<select name="kota" id="kota" class="form-control">
								</select>
							</div>
							<label class="control-label" for="text">Alamat :</label>
							<div class="form-group">
								<textarea name="alamat" id="alamat" style="width:100%; height:70px;"><?php echo ($users)?$users->user_alamat:'';?></textarea>
							</div>
							<!--<div class="form-group">-->
							<!--  <button id="akunupdate" type="submit" class="btn btn-info btn-block">Simpan</button>-->
							<!--</div>-->
							<!--<input class="btn btn-success" type="submit" name="btn" value="Simpan" />-->
						     <div class="form-group">
                               <button id="update" type="submit" class="btn btn-info btn-block">Simpan</button>
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

</body>
<script>
$(document).ready(function(){
    
    $('#prov').change(function(){
      show_kota();
    });
    
    $('#prov').trigger("change");
    
    function show_kota(){
	    var id = $('#prov').val();
        $.ajax({
            url : "<?php echo base_url();?>indonesia/getKota",
            method : "POST",
            data : {provinsi_id: id},
            async : false,
            dataType : 'json',
            success: function(data){
                console.log(data);
                var html = '';
                var sel = '';
                var i;
                for(i=0; i<data.length; i++){
                    var kotaid = <?php echo ($kotaid)?$kotaid:0?>;
                    sel = (data[i].id==kotaid)?'selected':'';
                    html += '<option value="'+data[i].id+'" '+sel+'>'+data[i].nama+'</option>';
                }
                $('#kota').html(html);
            },
            error: function (response) {
              console.log(response);
            }
        });
    }
});
</script>