<div class="panel panel-primary form-search">
  <div class="panel-body">
   <!-- <form method="POST" action="#" role="form"> -->
   <?php echo form_open('profil/password'); ?>
   <div class="section-intro text-center col-md-12">
     <h2 class="label-form">Ubah Password</h2>
   </div>
   <?php echo form_open('password'); ?>
     <div class="form-group">
       <label class="control-label" for="OldPassword">Password Lama</label>
       <input id="OldPassword" name="oldpass" placeholder="Password Lama" value="<?php echo set_value('pass'); ?>" type="password" maxlength="25" class="form-control" length="40" required/>
     <span class="text text-danger"><?php echo form_error('oldpass'); ?></span>
     </div>
     <div class="form-group">
       <label class="control-label" for="NewPassword">Password Baru</label>
       <input id="NewPassword" name="pass" placeholder="Password Baru" value="<?php echo set_value('pass'); ?>" type="password" maxlength="25" class="form-control" length="40" required/>
     </div>
     <div class="form-group">
       <label class="control-label" for="NewPasswordagain">Konfirmasi Password Baru</label>
       <input id="NewPasswordagain" name="conf" placeholder="Ulangi Password Baru" value="<?php echo set_value('conf'); ?>" type="password" maxlength="25" class="form-control" required/>
       <span class="text text-danger"><?php echo form_error('conf'); ?></span>
     </div>
     <div class="form-group">
       <button id="Submit" type="submit" class="btn btn-info btn-block">Simpan</button>
     </div>
   </form>
 </div>
</div>