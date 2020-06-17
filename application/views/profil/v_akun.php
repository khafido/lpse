<div class="panel panel-primary form-search">
  <div class="panel-body">
   <!-- <form method="POST" action="#" role="form"> -->
      <?//php echo $error;?>
                  <? 
                  //echo "<pre>";
                    //print_r($this->session->all_userdata());
                    //echo "</pre>";?>
   <?php echo form_open_multipart('profil/akunupdate'); ?>
     <div class="form-group">
         <div class="col-xs-12">
      <label for="photo">Photo Profile</label>

      <input type="file" name="file" accept="image/*" class="form-control" />
    </div>
       <label class="control-label" for="signupName">Nama : </label>
       <input id="signupName" name="name" placeholder="Nama" value="<?php echo ($datacontent)?$datacontent->user_nama:'' ?>" type="text" maxlength="50" class="form-control" required/>
     </div>
    <div class="form-group">
       <label class="control-label" for="signupTelp">Nomor Telepon : </label>
       <input id="signupTelp" name="telp" placeholder="Telepon" value="<?php echo ($datacontent)?$datacontent->user_telpon:'' ?>" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="15" class="form-control" required/>
    </div>
    <div class="form-group">
    <label class="control-label" for="parent">Provinsi :</label>
        <select name="prov" id="prov" class="form-control" required>
         <option value="null"></option>
         <?php foreach($prov as $val){ ?>
                <option value="<?=$val->id?>" <?php echo ($val->id==$provid)?'selected':''; ;?>><?=$val->nama?></option>
         <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="kota">Kabupaten / Kota :</label>
            <select name="kota" id="kota" class="form-control" required>
        </select>
    </div>
     <label class="control-label" for="text">Alamat :</label>
    <div class="form-group">
        <textarea name="alamat" id="alamat" style="width:100%; height:70px;" required><?php echo ($datacontent)?$datacontent->user_alamat:'';?></textarea>
    </div>
     <div class="form-group">
       <button id="akunupdate" type="submit" class="btn btn-info btn-block">Simpan</button>
     </div>
   </form>
 </div>
</div>
<script>
$(document).ready(function(){
    
    $('#prov').change(function(){
      var data= $(this).val();
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
                var html = '';
                var sel = '';
                var i;
                for(i=0; i<data.length; i++){
                    sel = (data[i].id==<?=$kotaid?>)?'selected':'';
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