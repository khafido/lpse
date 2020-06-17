<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<title><?php echo ucfirst($this->uri->segment(1)) .' - '. ucfirst($this->uri->segment(2)); ?></title>

<!-- Bootstrap core CSS-->
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

<!-- Custom fonts for this template-->
<link href="<?php echo base_url('assets/web/vendors/fontawesome/css/all.min.css') ?>" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="<?php echo base_url('assets/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="<?php echo base_url('assets/css/sb-admin.css') ?>" rel="stylesheet">

 <link rel="icon" href="<?=base_url()?>assets/web/img/favicon.png" type="image/png">
 <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/linericon/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/magnefic-popup/magnific-popup.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/owl-carousel/owl.carousel.min.css">
  
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand navbar-dark bg-success static-top">


    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand mr-1" href="<?php echo site_url('admin') ?>"><?php echo "    Garapan" ?></a>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!--<div class="input-group">-->
        <!--    <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">-->
        <!--    <div class="input-group-append">-->
        <!--        <button class="btn btn-light" type="button">-->
        <!--            <i class="fas fa-search"></i>-->
        <!--        </button>-->
        <!--    </div>-->
        <!--</div>-->
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <!--<li class="nav-item dropdown no-arrow mx-1">-->
        <!--    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"-->
        <!--        aria-expanded="false">-->
        <!--        <i class="fas fa-bell fa-fw"></i>-->
        <!--        <span class="badge badge-danger">9+</span>-->
        <!--    </a>-->
        <!--    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">-->
        <!--        <a class="dropdown-item" href="#">Action</a>-->
        <!--        <a class="dropdown-item" href="#">Another action</a>-->
        <!--        <div class="dropdown-divider"></div>-->
        <!--        <a class="dropdown-item" href="#">Something else here</a>-->
        <!--    </div>-->
        <!--</li>-->

        <!--<li class="nav-item dropdown no-arrow mx-1">-->
        <!--    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"-->
        <!--        aria-expanded="false">-->
        <!--        <i class="fas fa-envelope fa-fw"></i>-->
        <!--        <span class="badge badge-danger">7</span>-->
        <!--    </a>-->
        <!--    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">-->
        <!--        <a class="dropdown-item" href="#">Action</a>-->
        <!--        <a class="dropdown-item" href="#">Another action</a>-->
        <!--        <div class="dropdown-divider"></div>-->
        <!--        <a class="dropdown-item" href="#">Something else here</a>-->
        <!--    </div>-->
        <!--</li>-->

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> Admin
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <!--<a class="dropdown-item" href="#">Settings</a>-->
                <!--<a class="dropdown-item" href="#">Activity Log</a>-->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
        </li>
    </ul>

</nav>

</head>
