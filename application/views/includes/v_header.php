<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?=$title?></title>

  <link rel="icon" href="<?=base_url()?>assets/web/img/favicon.png" type="image/png">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
  <!--<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/bootstrap/bootstrap.min.css">-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/linericon/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/magnefic-popup/magnific-popup.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/owl-carousel/owl.carousel.min.css">
  <!--<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/nice-select/nice-select.css">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!--<link rel="stylesheet" href="<?=base_url()?>assets/web/css/style.css">-->
  
  <style media="screen">
    .wrap{
        background: #F7F7F7;
    }
    .after-header {
      padding-top: 120px;
      padding-bottom: 50px;
      background: #F7F7F7;
      /*background: red;*/
    }
    a:hover {
        cursor: pointer;
    }
    form {
      margin: 0px 10px;
    }
    h2 {
      margin-top: 2px;
      margin-bottom: 2px;
    }
    .containers {
      margin: auto;
      width:80%;
      /*background: #F7F7F7;*/
      /*padding-bottom: 50px;*/
    }
    .divider {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 5px;
    }
    .divider hr {
      margin: 7px 0px;
      width: 35%;
    }
    .left {
      float: left;
    }
    .right {
      float: right;
    }
    .label-form {
      color: #9a9a9a;
    }
    .control-label {
      font-weight: bold;
    }
    
    .user-link{
        color: white;
    }
    .user-link:hover{
        color: #104A5D;
    }
    
    .error-flash{
        background-color: red;
        color: white;
        text-transform: capitalize;
    }
    
    .card-boody {
        padding: 18px 20px 35px 20px;
    }
    
    .value-button {
    /*  display: inline-block;*/
    /*  border: 1px solid #ddd;*/
    /*  margin: 0px;*/
    /*  width: 40px;*/
    /*  height: 20px;*/
    /*  text-align: center;*/
      font-size:30px;
    /*  vertical-align: middle;*/
    /*  padding: 11px 0;*/
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    
    .value-button:hover {
      cursor: pointer;
    }
    
    /*form #decrease {*/
    /*  margin-right: -4px;*/
    /*  border-radius: 8px 0 0 8px;*/
    /*}*/
    
    /*form #increase {*/
    /*  margin-left: -4px;*/
    /*  border-radius: 0 8px 8px 0;*/
    /*}*/
    
    /*form #input-wrap {*/
    /*  margin: 0px;*/
    /*  padding: 0px;*/
    /*}*/
    
    /*input#number {*/
    /*  text-align: center;*/
    /*}*/
    
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        /*-webkit-appearance: none;*/
        margin: 0;
    }
    
    .currency {
      text-align: right;
      direction: ltr;
    }
    
    .linkdetail:hover{
        text-decoration: underline;
    }
    
    label.error{
        color: red;
        font-weight: bold;
    }
    #more {display: none;}
    
    .nav-item a{
        color: white;
    }
    
    #srcBtn:hover {
        border : 1px solid white;
    }
    
    .timepicker {
        margin-top: -400px;
    }
    .dropdown:hover .dropdown-menu {
        display: block;
        
    }
    /*.card {*/
    /*    min-height: 400px;*/
    /*    max-height: 400px;*/
        
    /*    height: 500px;*/
    /*}*/
  </style>
</head>

<body class="wrap">
    
<!--<div id="loader-wrapper">-->
<!--	<div id="loader"></div>-->
<!--	<div class="loader-section section-left"></div>-->
<!--	<div class="loader-section section-right"></div>-->
<!--</div>-->
    
<header class="header_area">
  <div class="header-top">
    <div class="containers py-2">
      <div class="d-flex align-items-center">
        <div id="logo">
          <a href="<?=base_url()?>"><img class="card-img" src="<?=base_url()?>assets/web/img/Logo.png" alt="" title="" /></a>
        </div>
        <!--<div class="ml-auto d-none d-md-block d-md-flex">-->
        <!--  <div class="media header-top-info">-->
        <!--    <span class="header-top-info__icon"><i class="fas fa-phone-volume"></i></span>-->
        <!--    <div class="media-body">-->
        <!--      <p>Have any question?</p>-->
        <!--      <p>Free: <a href="<?=base_url()?>assets/web/tel:+12 365 5233">+12 365 5233</a></p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="media header-top-info">-->
        <!--    <span class="header-top-info__icon"><i class="ti-email"></i></span>-->
        <!--    <div class="media-body">-->
        <!--      <p>Have any question?</p>-->
        <!--      <p>Free: <a href="<?=base_url()?>assets/web/tel:+12 365 5233">+12 365 5233</a></p>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
      </div>
    </div>
  </div>


  <div class="main_menu">
    <!--------------------------------->
    <nav class="navbar navbar-expand-lg" style="">
    <div class="containers">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
        <ul class="nav navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="<?=base_url()?>">Home</a></li>
             <li class="nav-item submenu dropdown">
                 <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Garapan</a>
              <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link" href="<?=base_url()?>lelang/pasang">Pasang</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=base_url()?>lelang/tampil">Lihat</a></li>
              </ul>
              </li>
            <!--<li class="nav-item"><a class="nav-link" href="<?=base_url()?>Mitra">Mitra</a></li>-->
        </ul>
        <form action="<?=site_url('/cari/hasil')?>" method="post" class="form-inline my-3">
          <!--<input class="form-control" type="text" placeholder="Search">-->
          <!--<button class="btn btn-success" type="button">Search</button>-->
            <div class="form-group">
                <div class="input-group">
                    <!--<div class="input-group-prepend">-->
                    <!--    <select name="type" class="form-control rounded-0">-->
                    <!--        <option value="1">Garapan</option>-->
                    <!--        <option value="2">Mitra</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <input type="text" id="word" name="word" placeholder="Cari Garapan. . ." class="form-control" required/>
                    <!--<span class="input-group">-->
                    <div class="input-group-append">
                        <button class="btn" style="background-color:transparent; color:white; border: 1px solid white;" id="srcBtn" type="submit" value="Cari"><i class="fas fa-search"></i></span></button>
                    </div>
                    <!--</span>-->
                </div>                        
            </div>
        </form>
        <?php if(isset($_SESSION['data_user'])){ ?>
            <div class="dropdown" style="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:white; list-style:none;">&nbsp; 
                    <b><?php
                        if(isset($_SESSION['nama'])){
                            echo $_SESSION['nama'];
                        } else {
                            echo $_SESSION['data_user']['user_nama'];
                        }
                    ?></b>
                </a>
                <div class="dropdown-menu" style="">
                    <a href="<?=base_url()?>profil" class="dropdown-item"><i class="fas fa-user"></i>&nbsp; Profil</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?=base_url()?>login/out" class="dropdown-item"><i class="fas fa-door-closed"></i>&nbsp; Keluar</a>
                </div>
            </div>
        <?php } else { ?>
            <div class="dropdown" style="">
                <a class="user-link" href="<?=base_url()?>login">
                    <!--<i class="fas fa-door-open"></i>-->
                    &nbsp; Masuk</a>
                <a class="user-link">&ensp; | &ensp;</a>
                <a class="user-link" href="<?=base_url()?>register">
                    <!--<i class="fas fa-id-card-alt"></i>-->
                    &nbsp; Daftar</a>
            </div>
        <?php } ?>
      </div>
    </div>
    </nav>
    <!--------------------------------->

  </div>
</header>
<div class="col-md-12 after-header"></div>