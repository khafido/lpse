<?php
    // $action = $this->uri->segment(3);
?>
<body id="page-top">
	<div id="wrapper">

		<?php $this->load->view("admin/includes/sidebar.php") ?>

		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("admin/includes/breadcrumb.php") ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url("admin/lelang") ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<form action="<?php base_url('admin/lelang/edit') ?>" method="post" enctype="form-data">
						<?//php echo form_open("admin/lelang/$action"); ?>
						     <input type="hidden" name="lelang_id" value="<?php echo ($lelang)?$lelang->lelang_id:'' ?>">
							<div class="form-group">
                              <label for="text">Nama Lelang :</label>
                              <input type="text" id="judul" name="judul" placeholder="Nama Lelang" maxlength="40" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="text">Tanggal Selesai :</label>
                                <input size="16" class="bg-transparent" type="text" name="tglselesai" id="tglselesai" value="" readonly required>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="parent">Pembayaran :</label>
                              <select name="pembayaran" id="pembayaran" class="form-control" required>
                                 <?php 
                                     foreach($pembayaran as $key => $value){
                                        echo "<option value='$key'>$value</option>";
                                    }
                                ?>
                             </select>
                           </div>
							<!--<div class="form-group">-->
							<!--	<label class="control-label" for="signupTelp">Nomor Telepon : </label>-->
							<!--	<input id="signupTelp" name="telp" placeholder="Telepon" value="<?php echo ($lelang)?$lelang->lelang_telpon:'' ?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="15"-->
							<!--		class="form-control" />-->
							<!--</div>-->
							<!--<div class="form-group">-->
							<!--	<label class="control-label" for="parent">Provinsi :</label>-->
       <!--                         <select name="prov" id="prov" class="form-control">-->
       <!--                          <option value="0"></option>-->
       <!--                          <?php foreach($prov as $val){ ?>-->
       <!--                                 <option value="<?=$val->id?>" <?php echo ($val->id==$provid)?'selected':''; ;?>><?=$val->nama?></option>-->
       <!--                          <?php } ?>-->
       <!--                         </select>-->
							<!--</div>-->
							<!--<div class="form-group">-->
							<!--	<label class="control-label" for="kota">Kabupaten / Kota :</label>-->
							<!--	<select name="kota" id="kota" class="form-control">-->
							<!--	</select>-->
							<!--</div>-->
							<label class="control-label" for="text">Alamat :</label>
							<div class="form-group">
								<textarea name="alamat" id="alamat" style="width:100%; height:70px;"><?php echo ($lelang)?$lelang->lelang_alamat:'';?></textarea>
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
	<?php $this->load->view("admin/includes/modal.php") ?>
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