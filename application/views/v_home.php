<body>
  <!--<style media="screen">
    .after-header {
      padding-top: 170px;
    }
    
    .card-boody {
        padding: 18px 20px 35px 20px;
    }
  </style>-->
  <!--<section class="after-header">-->
  <!--<div class="containers">-->
  <!--  <div class="section-intro text-center pb-80px">-->
  <!--    <div class="section-intro__style">-->
  <!--      <img src="<?=base_url()?>assets/web/img/home/news.png" alt="">-->
  <!--    </div>-->
  <!--    <h2 class="section-intro text-center ">News & Events</h2>-->
  <!--  </div>-->

  <!--  <div class="row">-->
  <!--    <div class="col-md-6 col-lg-4 mb-4 mb-md-0">-->
  <!--      <div class="card card-news">-->
  <!--        <div class="card-news__img">-->
  <!--          <img class="card-img" src="<?=base_url()?>assets/web/img/home/explore1.png" alt="">-->
  <!--        </div>-->
  <!--        <div class="card-body">-->
  <!--          <h4 class="card-news__title"><a href="#">Hotel companies tipped the scales</a></h4>-->
  <!--          <ul class="card-news__info">-->
  <!--            <li><a href="#"><span class="news-icon"><i class="ti-notepad"></i></span> 20th Nov, 2018</a></li>-->
  <!--            <li><a href="#"><span class="news-icon"><i class="ti-comment"></i></span> 03 Comments</a></li>-->
  <!--          </ul>-->
  <!--          <p>Not thoughts all exercise blessing Indulgence way everything joy alteration boisterous the attachment party we years to order</p>-->
  <!--          <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->

  <!--    <div class="col-md-6 col-lg-4 mb-4 mb-md-0">-->
  <!--      <div class="card card-news">-->
  <!--        <div class="card-news__img">-->
  <!--          <img class="card-img" src="<?=base_url()?>assets/web/img/home/explore2.png" alt="">-->
  <!--        </div>-->
  <!--        <div class="card-body">-->
  <!--          <h4 class="card-news__title"><a href="#">Try your hand inaugural industry crossword</a></h4>-->
  <!--          <ul class="card-news__info">-->
  <!--            <li><a href="#"><span class="news-icon"><i class="ti-notepad"></i></span> 20th Nov, 2018</a></li>-->
  <!--            <li><a href="#"><span class="news-icon"><i class="ti-comment"></i></span> 03 Comments</a></li>-->
  <!--          </ul>-->
  <!--          <p>Not thoughts all exercise blessing Indulgence way everything joy alteration boisterous the attachment party we years to order</p>-->
  <!--          <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->

  <!--    <div class="col-md-6 col-lg-4 mb-4 mb-md-0">-->
  <!--      <div class="card card-news">-->
  <!--        <div class="card-news__img">-->
  <!--          <img class="card-img" src="<?=base_url()?>assets/web/img/home/explore3.png" alt="">-->
  <!--        </div>-->
  <!--        <div class="card-body">-->
  <!--          <h4 class="card-news__title"><a href="#">Hoteliers resolve to invest in guests</a></h4>-->
  <!--          <ul class="card-news__info">-->
  <!--            <li><a href="#"><span class="news-icon"><i class="ti-notepad"></i></span> 20th Nov, 2018</a></li>-->
  <!--            <li><a href="#"><span class="news-icon"><i class="ti-comment"></i></span> 03 Comments</a></li>-->
  <!--          </ul>-->
  <!--          <p>Not thoughts all exercise blessing Indulgence way everything joy alteration boisterous the attachment party we years to order</p>-->
  <!--          <a class="card-news__link" href="#">Read More <i class="ti-arrow-right"></i></a>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->
  <!--</section>-->
  <!-- ================ news section end ================= -->
  
  <div id="demo" class="carousel slide" data-ride="carousel" style="margin-top:-20px;">
       <!--Indicators -->
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <!--<li data-target="#demo" data-slide-to="2"></li>-->
      </ul>
    
       <!--The slideshow -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img style="width:100%; height:100%;" src="https://ae01.alicdn.com/kf/HTB1H.xGXsrrK1Rjy1zeq6xalFXap/Big-Size-Modern-HD-Prints-World-Map-Canvas-Painting-Wall-Decor-Plat-Map-Wall-Art-Poster.jpg_q50.jpg" alt="Los Angeles">
        </div>
        <div class="carousel-item">
          <img style="width:100%; height:100%;" src="https://images.unsplash.com/photo-1562184760-a11b3cf7c169?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" alt="New York">
        </div>
      </div>
    
       <!--Left and right controls -->
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
  
  <!-- ================ Daftar Lelang start ================= -->
  <section class="section-padding-small">
    <div class="containers">
      <div class="section-intro text-center"><br><br>
        <div class="section-intro__style">
          <!-- <img src="<?=base_url()?>assets/web/img/home/bed-icon.png" alt=""> -->
        </div>
        <h2> Garapan Terbaru</h2>
      </div>

      <!--<div class="col-md-12 row">-->
      <div class="owl-carousel owl-theme testi-carousel" style="padding: 0px;">
        <?php $i=0; foreach($lelang as $l ){ ?>
        <!--<div class="col-md-6 col-lg-4 mb-4 mb-md-0 rounded-0">-->
        <div class="testi-carousel__item">
           <div class="card card-news"> 
              <div class="card-boody">
                  <div class="card-header bg-light border-success" style="border-width:5px;">
                    <h5 class="" style="text-transform:capitalize; font-family:Open Sans;"><?=$l->lelang_judul;?></h5>
                  </div>
                  <div class="card-boody">
                    <h5 class="card-title pull-right">Rp. <cite><?=number_format($l->lelang_anggaran)?></cite></h5>
                    <span class="pull-right">(<?php echo $pembayaran[$l->lelang_pembayaran]?>)&nbsp;</span>
                    <div class="col-md-12 mt-3"></div>
                    <hr />
                    <span>
                        <a onclick="tampilproduk(this.id)" id="clickproduk<?=$i?>" href="#daftarP" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-danger" id="lihatProduk"><?php echo $controller->getJumlahProduk($l->lelang_id); ?></span> Lihat Produk 
                        </a>
                    </span><br/>
                    <span>
                        <?php $jmltaw = $controller->getJumlahTawaran($l->lelang_id); ?>
                        <a onclick="tampiltawaran(this.id)" id="clicktawaran<?=$i?>" href="#daftartawaran" class="text-primary" data-jmltaw="<?=$jmltaw?>" data-listtawaran='<?php echo json_encode($controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id, 'tawaran_status'=>3)));?>' data-listp='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-info" id="jumtaw"><?php echo $jmltaw; ?> </span> Lihat Tawaran 
                        </a>
                    </span>
                    <p class="card-text">Deadline : <b><?php echo date_format(new DateTime($l->lelang_tglselesai), 'd M Y'); ?></b></p>
                    <!--Pemilik Lelang : <br/>-->
                    <hr />
                    <p class="card-text">
                      <a href="#" style="text-transform:capitalize;"><i class="far fa-user"></i>&ensp;<?php echo $controller->getUserDetail($l->lelang_userid)['user_nama']; ?></a><br />
                      <span style="text-transform:capitalize;"><i class="fas fa-home"></i>&ensp;<?php echo ($l->lelang_alamat)?$l->lelang_alamat:'-'; ?></span> <br/>
                      <b><i class="fas fa-map-marker-alt"></i> &nbsp;
                        <?php $kabprov = $controller->getKabProv($l->lelang_kota); echo "$kabprov->kab, $kabprov->prov";?><br />
                        <i class="fas fa-phone fa-rotate-90"></i>&ensp;(<?php $telp = $controller->getUserDetail($l->lelang_userid)['user_telpon']; echo ($telp)?$telp:' - '; ?>)
                      </b>
                    </p>
                    <div class="row mx-auto">
                        <a href="#" onclick="clickDetail(this.id)" class="linkdetail" id="detaildesk<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php 
                	    if (!$this->session->userdata('data_user')){
                            $status = 0;
                        } else {
                            $data_u = $this->session->userdata('data_user');
                            if(!$data_u['user_status']){
                                $status = 0;
                            } else {
                                $status = 1;
                            }
                        }                   
                        
                        if($status==1){
                    ?>
                    <?php $p = $controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>isset($_SESSION['data_user'])? $_SESSION["data_user"]["user_id"]:0, 'tawaran_status'=>3)); ?>
                    <button type="button" onclick="tampilpengajuan(this.id)" id="pengajuanlid<?=$i?>" class="btn btn-<?=($p)?'success':'primary'; ?> mt-3 pull-right" data-lid="<?=$l->lelang_id?>" data-tawaranku='<?=($p)?json_encode(array_reverse($p)):0?>' data-listp='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                      <?=($p)?'Ubah Penawaran':'Ajukan Penawaran'; ?>
                    </button>
                    <?php } ?>
                  </div>
              </div>
           </div> 
        </div>
        <?php $i++;} ?>
      </div>
      <br>
      <div class="section-padding-small text-center pb-100px">
        <h3><a class="button-lihat" href="https://lelang.agsgroup.co.id/lelang/tampil">Lihat Semua Garapan</a></h3>
      </div><br>
    </div>
    <div class="row">
    </div>
  </section>
  <section class="section-margin--small">
  </section>
  <!-- Modal stop -->
  <div class="modal fade" id="stop" tabindex="-1" role="dialog" aria-labelledby="stopModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <h3 >Silahkan Login Dulu !</h3>
                <br>
                <!--<a href="https://lelang.agsgroup.co.id/login" class="btn btn-submit">Login</a>-->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="location.href='https://lelang.agsgroup.co.id/login';" >Login</button>
        </div>
      </div>
    </div>
    </div>
  <!--</section><br>-->
</body>
<script>
  // $(document).ready(function () { 
  // });
</script>