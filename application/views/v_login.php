<!--<section class="after-header">-->
  <div class="containers col-md-3">
    <!--<div class="row">-->
      <div class="panel panel-primary form-search">
        <div class="panel-body">
          <?php echo form_open('login/check'); ?>
           <div class="section-intro text-center">
             <div class="section-intro__style">
               <img style="width:50px; height:50px;" src="<?=base_url()?>assets/images/register.png" alt="">
             </div>
             <h2 class="label-form">Masuk</h2>
                        <span style="text-transform:capitalize;" class="<?php echo ($this->session->flashdata('error')!==null?'text-danger':'');?>"> <?php echo $this->session->flashdata('error'); ?></span>
           </div>
           <div class="form-group">
             <label class="control-label" for="signupEmail">Email</label>
             <input id="loginEmail" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" type="email" maxlength="80" class="form-control" required/>
             <span class="text text-danger"><?php echo form_error('email'); ?></span>
           </div>
           <div class="form-group">
             <label class="control-label" for="signupPassword">Password</label>
             <input id="loginPassword" name="pass" placeholder="Password" value="<?php echo set_value('pass'); ?>" type="password" minLength="6" maxlength="25" class="form-control" required/>
           </div>
           <div class="form-group">
             <button id="signupSubmit" type="submit" class="btn btn-info btn-block">Masuk</button>
           </div> 
         </form>
        </div>
      </div>
    </div>
<!--</section>-->