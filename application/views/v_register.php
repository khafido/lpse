<!--<section class="after-header">-->
  <div class="containers col-md-4">
    <div class="row">
      <div class="panel panel-primary form-search">
        <div class="panel-body">
         <!-- <form method="POST" action="#" role="form"> -->
         <?php echo form_open('register/daftar'); ?>
           <div class="section-intro text-center">
             <div class="section-intro__style">
               <img style="width:50px; height:50px;" src="<?=base_url()?>assets/images/register.png" alt="">
             </div>
             <h2 class="label-form">Daftar</h2>
           </div>
           <div class="form-group">
             <label class="control-label" for="signupName">Nama</label>
             <input id="signupName" name="name" placeholder="Nama" value="<?php echo set_value('name'); ?>" type="text" maxlength="50" class="form-control" required/>
           </div>
           <div class="form-group">
             <label class="control-label" for="signupEmail">Email</label>
             <input id="signupEmail" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" type="email" maxlength="50" class="form-control" required/>
             <span class="text text-danger"><?php echo form_error('email'); ?></span>
           </div>
           <div class="form-group">
             <label class="control-label" for="signupPassword">Password</label>
             <input id="signupPassword" name="pass" placeholder="Password" value="<?php echo set_value('pass'); ?>" type="password" maxlength="25" class="form-control" length="40" required/>
           </div>
           <div class="form-group">
             <label class="control-label" for="signupPasswordagain">Konfirmasi Password</label>
             <input id="signupPasswordagain" name="conf" placeholder="Ulangi Password" value="<?php echo set_value('conf'); ?>" type="password" maxlength="25" class="form-control" required/>
             <span class="text text-danger"><?php echo form_error('conf'); ?></span>
           </div>
           <div class="form-group">
             <button id="signupSubmit" type="submit" class="btn btn-info btn-block">Buat Akun</button>
           </div>
           <p class="form-group">Dengan melakukan proses pendaftaran, anda menyetujui segala  <a href="#">Kebijakan & Ketentuan</a> yang berlaku.</p>
           <hr>
           <p></p>Sudah punya akun? Silahkan <a href="<?=base_url()?>login">Masuk</a></p>
         </form>
       </div>
     </div>
   </div>
   </div>
<!--</section>-->
