<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  /*height: 100vh;*/
}
#login #login-row #login-column #login-box {
  /*margin-top: 120px;*/
  width: 100%;
  /*height: 320px;*/
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login #login-row #login-column #login-box #login-form {
  /*padding: 20px;*/
}
#login #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
.container {
    padding: 10px;
    width:50%;
    background-color: #EAEAEA;
    margin-top: 15%;
}
    
</style>
<title>Login Admin</title>
<link rel="icon" href="<?=base_url()?>assets/web/img/favicon.png" type="image/png">
<body>
    <div id="login">
        <!--<h4class="text-center pt-5" style="color : #17A2B8;">L</h4>-->
        <div class="container rounded">
            <!--<div id="login-row" class="row justify-content-center align-items-center">-->
            <!--    <div id="login-column" class="col-md-6">-->
            <!--        <div id="login-box" class="col-md-12">-->
                    <div class="col-md-8 mx-auto"></div>
                       <?php echo form_open('admin/login/check'); ?>
                            <h3 class="text-center text-info">Login Admin</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="user" id="user" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="pass" id="pass" class="form-control">
                            </div>
                            <div class="form-group">
                                <!--<label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>-->
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Masuk">
                            <?php if ($this->session->flashdata('login_error')) { ?>
                                <h6 class="text-center text-danger"><?= $this->session->flashdata('login_error') ?> </h6>
                            <?php } ?>
                            </div>
                        </form>
                    </div>
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</body>
