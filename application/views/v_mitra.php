<!--<section class="after-header">-->
  <style media="screen">
    .card-boody {
        padding: 20px 20px 20px 20px;
    }
    .pad1{
        padding-left : 10px;
        padding-right : 10px;
    }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-lg-3 mb-4">
      </div>
      <div class="card col-md-10 col-lg-6 card-news">
        <div class="row p-4">
            <!--<label class="col-md-12 mx-auto">Printing <i class="fas fa-angle-right"></i> Digital Printing <i class="fas fa-angle-right"></i> Kartu Nama</label>-->
            <div class="col-md-12" style="margin-top:20px;"></div>
              <? foreach($mitra as $m){ ?>
              <!--<div class="row 12">-->
               <!--<a href="whatever you want"> <div id="thediv" />ef </a>-->
                 <div class="col-md-12 col-lg-12 mx-auto mb-3 card card-body" style="padding: 13px; border-shadow: 0px 10px 30px 0px rgba(153, 153, 153);">
                     <div class="row">
                         <div class="col-xs-4 pad1">
                             <img style="height : 60px; width : 60px;" src="<?=base_url()?>assets/images/register.png" alt="">
                         </div>
                         <div class="col-xs-8 pad1">
                        <div style="font-weight: bold;"><a href="#"><?php echo $m->user_nama?></a><br /></div>
                        <div><label><?php $kabprov = $controller->getKabProv($m->user_kotaid); echo "$kabprov->kab - $kabprov->prov";?></label></div>
                        </div>
                     </div>
                     <!--<div>Lihat</div>-->
                 </div>
                 
                <?php } ?>
              <!--</div>-->
            <div class="col-md-12 mx-auto mb-4">
                <?php echo $links; ?>
            </div>
        </div>
      </div>
    </div>
          <div class="col-md-5 col-lg-3 mb-4">
              </div>
  </div>
 
<!--</section>-->

<script>
// $(document).ready(function () { 
// $(function() {
// });
</script>