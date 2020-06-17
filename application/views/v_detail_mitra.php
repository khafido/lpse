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
            <!--<div class="col-md-12" style="margin-top:20px;"></div>-->
              <? //foreach($mitra as $m){ ?>
              <!--<div class="row 12">-->
               
                 <div class="col-md-12 col-lg-12 mx-auto mb-3" style="border-shadow: 0px 10px 30px 0px rgba(153, 153, 153);">
                     <div class="">
                         <div class="pad1" style="text-align:center;">
                             <img style="height: 120px; width: 120px; margin: 10px; border: 1px solid rgba(0,0,0,.12);" src="<?=base_url()?>assets/images/register.png" alt="">
                         </div>
                         <div class="pad1" >
                             <div  style="text-align:center;     padding-top: 5px;">Indra Nanda</div>
                             <!--<div  style="text-align:center;"></div>-->
                             <!--<div><i class="fas fa-phone fa-rotate-90"></i> 085645171115</div>-->
                             <div style="text-align:center;" ><i class="fas fa-map-marker-alt"></i> Lamongan</div>
                             <div style="text-align:center;     padding: 10px;" >" Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. " </div>
                             <div></div>
                        <div><a href="#"><?//php echo $m->user_nama?></a><br /></div>
                        <div><label><?//php $kabprov = $controller->getKabProv($m->user_kotaid); echo "$kabprov->kab - $kabprov->prov";?></label></div>
                        <nav style="padding-top: 10px;">
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-d-tab" data-toggle="tab" href="#nav-d" role="tab" aria-controls="nav-d" aria-selected="false">Informasi</a>
                            <a class="nav-item nav-link" id="nav-a-tab" data-toggle="tab" href="#nav-a" role="tab" aria-controls="nav-a" aria-selected="true">Riwayat Lelang</a>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-d" role="tabpanel" aria-labelledby="nav-d-tab">
                                <div class="col-md-12" style="margin-top:0px;"></div>
                                <?//php $this->load->view('./v_tambah_lelang')?>
                            </div>        
                            <div class="tab-pane fade show" id="nav-a" role="tabpanel" aria-labelledby="nav-a-tab">
                                <div class="col-md-12" style="margin-top:20px;"></div>
                                <?//php $i=0; foreach($lelang as $l){ ?>
                                    <div class="col-md-12 mb-5 card rounded-0 card-body">
                                      <div class="card-header bg-light border-success" style="border-width:5px; margin-top:15px;">
                                          <h5 class="" style="text-transform:capitalize; font-family:Open Sans;"><?//=$l->lelang_judul;?></h5>
                                      </div>
                                      <div class="card-body px-3">
                                        <h5 class="card-title pull-right">Rp. <cite><?//=number_format($l->lelang_anggaran)?></cite></h5>
                                        <span class="pull-right">(<?//php echo $pembayaran[$l->lelang_pembayaran]?>)&nbsp;</span>
                                        <div class="col-md-12 mt-3"></div>
                                        <hr/>
                                        <span>
                                            <a onclick="tampilproduk(this.id)" id="clickproduk<?=$i?>" href="#daftarP" class="text-primary" data-listproduk='<?//php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                                                <span class="badge badge-danger" id="lihatProduk"><?//php echo $controller->getJumlahProduk($l->lelang_id); ?></span> Lihat Produk 
                                            </a>
                                        </span><br/>
                                        <span>
                                            <a onclick="pilihmitra(this.id)" id="clicktawaran<?=$i?>" href="#daftartawaran" class="text-primary" data-listtawaran='<?//php echo json_encode($controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id))); ?>' >
                                                <span class="badge badge-info"><?//php echo $controller->getJumlahTawaran($l->lelang_id); ?> </span> Lihat Tawaran 
                                            </a>
                                        </span>
                                        <p class="card-text">Deadline : <b><?//php echo date_format(new DateTime($l->lelang_tglselesai), 'd M Y'); ?></b></p>
                                        <!--Pemilik Lelang : <br/>-->
                                        <hr/>
                                        <!--<p class="card-text">-->
                                        <!--    <a href="#" style="text-transform:capitalize;"><i class="far fa-user"></i>&ensp;<?php //echo $controller->getUserDetail($l->lelang_userid)['user_nama']; ?></a><br/>-->
                                        <!--    <span style="text-transform:capitalize;"><i class="fas fa-home"></i>&ensp;<?php //echo ($l->lelang_alamat)?$l->lelang_alamat:'-'; ?></span> <br/>-->
                                        <!--    <b><i class="fas fa-map-marker-alt"></i> &nbsp;-->
                                        <!--        <?//php $kabprov = $controller->getKabProv($l->lelang_kota); echo "$kabprov->kab, $kabprov->prov";?><br/>-->
                                        <!--        <i class="fas fa-phone fa-rotate-90"></i>&ensp;(<?php //$telp = $controller->getUserDetail($l->lelang_userid)['user_telpon']; echo ($telp)?$telp:' - '; ?>)-->
                                        <!--    </b>-->
                                        <!--</p>-->
                                        <!--Deskripsi : <br/>-->
                                        <!--<hr/>-->
                                        <!--<blockquote class="blockquote mb-0">-->
                                        <!--  <footer class="blockquote-footer">-->
                                        <!--      <p>-->
                                        <!--          <?//=substr($l->lelang_deskripsi, 0, 80)?><span id="dots">...</span><span id="more"><?//=substr($l->lelang_deskripsi, 80)?>-->
                                        <!--      </p>-->
                                        <!--          <a href="#" onclick="myFunction()" id="myBtn">Read more</a>-->
                                        <!--  </footer>-->
                                        <!--</blockquote>-->
                                        <div class="row mx-auto">
                                            <a href="#" class="linkdetail"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                                            <a href="#" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br/>
                                        </div>
                                        <?//php $p = $controller->cekTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION['data_user']['user_id'])); ?>
                                        <!--<button type="button" id="pengajuanlid<?=$i?>" class="btn btn-success bg bg-success mt-3 pull-right">-->
                                        <!--  Tentukan Pemenang-->
                                        <!--</button>-->
                                      </div>
                                    </div>          
                                    <?//php $i++;} ?>
                                <div class="col-md-12 mx-auto mb-4">
                                    <?//php echo $links; ?>
                                </div>
                            </div>
                        </div>
                        </div>
                     </div>
                 </div>
                 
                <?//php } ?>
              <!--</div>-->
            <div class="col-md-12 mx-auto mb-4">
                <?//php echo $links; ?>
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