<!--<section class="after-header">-->
  <div class="containers" style="padding-top:20px;">
    <div class="row">
      <div class="col-md-5 col-lg-3 mb-4">
        <div class="list-group card card-news" style="padding:10px 0px;"> 
            <?php $x=0; $y=0; foreach($parent as $val){ ?>
        	<div clas="col-md-12" style="padding-left:20px;">
				<a href="#item-<?=$x?>" style="" class="list" data-toggle="collapse">
					<i class="fas fa-angle-right"></i> <?=$val->kategori_nama?>
				</a>
			</div>
			<div class="list-group collapse col-md-12" id='item-<?php echo"$x"; ?>'>
    			<?php foreach($controller->getSub($val->kategori_id) as $sub){?>
    			<div class="col-md-12" style="">
    				<a style="margin-left:20px; background:;" href='#item-<?php echo "$x-$y"?>' class="list" data-toggle="collapse" style="">
    				    <i class="fas fa-angle-right"></i> <?=$sub->kategori_nama?>
    				</a>
    			</div>
    			<div class="list-group collapse" id="item-<?php echo "$x-$y"; ?>"><div class="col-md-12"></div>
        		  <?php foreach($controller->getProduk($sub->kategori_id) as $produk){ ?>
        			<div class="col-md-12" style="">
                        <a href='<?php echo base_url("lelang/tampil/".$produk->kategori_id); ?>' style="margin-left:40px;" class='list'><li><?=$produk->kategori_nama?></li></a>
        			</div>
        		  <?php } $y++;?>
    			</div>
                <?php } $x++;?>
			</div>
			<hr/>
        	<?php } ?>
        </div>
      </div>
      <div class="card col-md-7 col-lg-9 card-news">
        <div class="row p-4">
            <?=$judul?>
            <div class="col-md-12 bg-dark" style="margin-bottom:20px;"></div>
            <!--<div class="col-md-12">-->
            <!--    <input id="myInput" onkeyup="pencarian(this.id, 'carilelang')" type="text" placeholder="Search..">-->
            <!--</div>-->
              <?php $i=0; foreach($lelang as $l){ ?>
                <div class="col-md-5 col-lg-5 mx-auto mb-5 card rounded-0 card-news" id="carilelang" style="box-shadow:0px 10px 30px 0px rgba(153, 153, 153);">
                  <div class="card-header bg-light border-success" style="border-width:5px; margin-top:15px;">
                      <h5 class="" style="text-transform:capitalize; font-family:Open Sans;"><?=$l->lelang_judul;?></h5>
                  </div>
                  <div class="card-body px-3">
                    <h5 class="card-title pull-right">Rp. <cite><?=number_format($l->lelang_anggaran)?></cite></h5>
                    <span class="pull-right">(<?php echo $pembayaran[$l->lelang_pembayaran]?>)&nbsp;</span>
                    <div class="col-md-12 mt-3"></div>
                    <hr/>
                    <span>
                        <a onclick="tampilproduk(this.id)" id="clickproduk<?=$i?>" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-danger" id="lihatProduk"><?php echo $controller->getJumlahProduk($l->lelang_id); ?></span> Lihat Produk 
                        </a>
                    </span><br/>
                    <span>
                        <?php $jmltaw = $controller->getJumlahTawaran($l->lelang_id); ?>
                        <a onclick="tampiltawaran(this.id)" id="clicktawaran<?=$i?>" class="text-primary" data-jmltaw="<?=$jmltaw?>" data-listtawaran='<?php echo json_encode($controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id, 'tawaran_status'=>3)));?>' data-listp='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-info" id="jumtaw"><?php echo $jmltaw; ?> </span> Lihat Tawaran 
                        </a>
                    </span>
                    <p class="card-text">Deadline : <b><?php echo date_format(new DateTime($l->lelang_tglselesai), 'd M Y'); ?></b></p>
                    <!--Pemilik Lelang : <br/>-->
                    <hr/>
                    <p class="card-text">
                        <a href="#" style="text-transform:capitalize;"><i class="far fa-user"></i>&ensp;<?php echo $controller->getUserDetail($l->lelang_userid)['user_nama']; ?></a><br/>
                        <span style="text-transform:capitalize;"><i class="fas fa-home"></i>&ensp;<?php echo ($l->lelang_alamat)?$l->lelang_alamat:'-'; ?></span> <br/>
                        <b><i class="fas fa-map-marker-alt"></i> &nbsp;
                            <?php $kabprov = $controller->getKabProv($l->lelang_kota); echo "$kabprov->kab, $kabprov->prov";?><br/>
                            <i class="fas fa-phone fa-rotate-90"></i>&ensp;(<?php $telp = $controller->getUserDetail($l->lelang_userid)['user_telpon']; echo ($telp)?$telp:' - '; ?>)
                        </b>
                    </p>
                    <div class="row mx-auto">
                        <a onclick="clickDetail(this.id)" class="linkdetail" id="detaildesk<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
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
                    <?php $p = $controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION["data_user"]["user_id"], 'tawaran_status'=>3)); ?>
                    <button type="button" onclick="tampilpengajuan(this.id)" id="pengajuanlid<?=$i?>" class="btn btn-<?=($p)?'success':'primary'; ?> mt-3 pull-right" data-lid="<?=$l->lelang_id?>" data-tawaranku='<?=($p)?json_encode($p):0?>' data-listp='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                      <?=($p)?'Ubah Penawaran':'Ajukan Penawaran'; ?>
                    </button>
                    <?php } ?>
                  </div>
                </div>          
                <?php $i++;} ?>
            <div class="col-md-12 mx-auto mb-4">
                <?php echo $links; ?>
            </div>
        </div>
      </div>
    </div>
  </div>
<!--</section>-->

<script>
// $(document).ready(function () { 
// $(function() {
// });
    $('.list').on('click', function() {
		$('.fas', this)
		.toggleClass('fas fa-angle-right')
		.toggleClass('fas fa-angle-down');
	});
</script>