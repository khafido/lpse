<div class="panel panel-primary form-search">
  <!-- <div class="panel-body"> -->
    <!--<div class="row">-->
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" id="nav-d-tab" data-toggle="tab" href="#nav-d" role="tab" aria-controls="nav-d" aria-selected="false">Pasang</a>
        <a class="nav-item nav-link active" id="nav-a-tab" data-toggle="tab" href="#nav-a" role="tab" aria-controls="nav-a" aria-selected="true">Pemilihan Mitra</a>
        <a class="nav-item nav-link" id="nav-b-tab" data-toggle="tab" href="#nav-b" role="tab" aria-controls="nav-b" aria-selected="false">Pengerjaan</a>
        <a class="nav-item nav-link" id="nav-c-tab" data-toggle="tab" href="#nav-c" role="tab" aria-controls="nav-c" aria-selected="false">Selesai</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-d" role="tabpanel" aria-labelledby="nav-d-tab">
            <div class="col-md-12" style="margin-top:0px;"></div>
            <?php $this->load->view('./v_tambah_lelang')?>
        </div>        
        <div class="tab-pane fade show active" id="nav-a" role="tabpanel" aria-labelledby="nav-a-tab">
            <div class="col-md-12" style="margin-top:20px;"></div>
            <?php $i=0; foreach($lelang as $l){ ?>
                <div class="col-md-12 mb-5 card rounded-0 card-body">
                  <div class="card-header bg-light border-success" style="border-width:5px; margin-top:15px;">
                      <h5 class="" style="text-transform:capitalize; font-family:Open Sans;"><?=$l->lelang_judul;?></h5>
                  </div>
                  <div class="card-body px-3">
                    <h5 class="card-title pull-right">Rp. <cite><?=number_format($l->lelang_anggaran)?></cite></h5>
                    <span class="pull-right">(<?php echo $pembayaran[$l->lelang_pembayaran]?>)&nbsp;</span>
                    <div class="col-md-12 mt-3"></div>
                    <hr/>
                    <span>
                        <a onclick="tampilproduk(this.id)" id="ppemilihan<?=$i?>" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-danger" id="lihatProduk"><?php echo $controller->getJumlahProduk($l->lelang_id); ?></span> Lihat Produk 
                        </a>
                    </span><br/>
                    <span>
                        <?php $jmltaw = $controller->getJumlahTawaran($l->lelang_id); ?>
                        <a onclick="pilihmitra(this.id)" id="tpemilihan<?=$i?>" class="text-primary" data-jmltaw="<?=$jmltaw?>" data-listtawaran='<?php echo json_encode($controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id, 'tawaran_status'=>3)));?>' data-listp='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-info" id="jumtaw"><?php echo $jmltaw; ?> </span> Lihat Tawaran 
                        </a>
                    </span>
                    <p class="card-text">Deadline : <b><?php echo date_format(new DateTime($l->lelang_tglselesai), 'd M Y'); ?></b></p>
                    <hr/>
                    <div class="row mx-auto">
                        <a href="#" onclick="clickDetail(this.id)" class="linkdetail" id="dpemilihan<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php $p = $controller->cekTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION['data_user']['user_id'])); ?>
                    <button onclick='konfirmasi("lelang/batal/<?=$l->lelang_id?>", "Anda yakin ingin membatalkan Garapan?")' class="btn btn-danger bg bg-danger mt-3 pull-right col-md-3">
                      Batalkan Garapan
                    </button>
                  </div>
                </div>          
                <?php $i++;} ?>
            <div class="col-md-12 mx-auto mb-4">
                <?php echo $links; ?>
            </div>
        </div>
      <div class="tab-pane fade" id="nav-b" role="tabpanel" aria-labelledby="nav-b-tab">
        <div class="col-md-12" style="margin-top:20px;"></div>
        <!--Looping-->
        <?php $i=0; foreach($pengerjaan as $l){ ?>
                <div class="col-md-12 mb-5 card rounded-0 card-body">
                  <div class="card-header bg-light border-success" style="border-width:5px; margin-top:15px;">
                      <h5 class="" style="text-transform:capitalize; font-family:Open Sans;"><?=$l->lelang_judul;?></h5>
                  </div>
                  <div class="card-body px-3">
                    <h5 class="card-title pull-right">Rp. <cite><?=number_format($l->lelang_anggaran)?></cite></h5>
                    <span class="pull-right">(<?php echo $pembayaran[$l->lelang_pembayaran]?>)&nbsp;</span>
                    <div class="col-md-12 mt-3"></div>
                    <hr/>
                    <span>
                        <a onclick="tampilproduk(this.id)" id="ppengerjaan<?=$i?>" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
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
                    <hr/>
                    <span><i class="fas fa-flag"></i>&nbsp; Pemenang Garapan : <br/><a href="#"><?php $u = $controller->getUserDetail($l->lelang_mitraid); echo $u['user_nama'];?>&nbsp;<b>(<?=$u['user_telpon']?></b>)</a></span><br/>
                    <div class="row mx-auto mt-3">
                        <a href="#" onclick="clickDetail(this.id)" class="linkdetail" id="dpengerjaan<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php $p = $controller->cekTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION['data_user']['user_id'])); ?>
                    <button onclick='konfirmasi("lelang/selesai/<?=$l->lelang_id?>", "Anda yakin ingin menyelesaikan Garapan?")' class="btn btn-success bg bg-success mt-3 pull-right col-md-3">
                      Garapan Selesai
                    </button>
                  </div>
                </div>          
                <?php $i++;} ?>
            <div class="col-md-12 mx-auto mb-4">
                <?php echo $links; ?>
            </div>
      </div>
      <div class="tab-pane fade" id="nav-c" role="tabpanel" aria-labelledby="nav-c-tab">
        <div class="col-md-12" style="margin-top:20px;"></div>
        <!--Looping-->
        <?php $i=0; foreach($penyerahan as $l){ ?>
            <div class="col-md-12 mb-5 card rounded-0 card-body">
                  <div class="card-header bg-light border-success" style="border-width:5px; margin-top:15px;">
                      <h5 class="" style="text-transform:capitalize; font-family:Open Sans;"><?=$l->lelang_judul;?></h5>
                  </div>
                  <div class="card-body px-3">
                    <h5 class="card-title pull-right">Rp. <cite><?=number_format($l->lelang_anggaran)?></cite></h5>
                    <span class="pull-right">(<?php echo $pembayaran[$l->lelang_pembayaran]?>)&nbsp;</span>
                    <div class="col-md-12 mt-3"></div>
                    <hr/>
                    <span>
                        <a onclick="tampilproduk(this.id)" id="pselesai<?=$i?>" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
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
                    <hr/>
                    <span><i class="fas fa-flag"></i>&nbsp; Pemenang Garapan : <br/><a href="#"><?php $u = $controller->getUserDetail($l->lelang_mitraid); echo $u['user_nama'];?>&nbsp;<b>(<?=$u['user_telpon']?></b>)</a></span><br/>
                    <div class="row mx-auto mt-3">
                        <a href="#" onclick="clickDetail(this.id)" class="linkdetail" id="dselesai<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php $p = $controller->cekTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION['data_user']['user_id'])); ?>
                  </div>
                </div>          
        <?php $i++;} ?>
        <div class="col-md-12 mx-auto mb-4">
            <?php echo $links; ?>
        </div>
      </div>
    </div>
    <!--</div>-->
  <!-- </div> -->
</div>

    <!-- Modal Daftar Tawaran -->
    <!--<div class="modal fade" id="pilihM" tabindex="-1" role="dialog" aria-labelledby="penawaranModalCenterTitle" aria-hidden="true">-->
    <!--    <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="max-width:300px; overflow-y: auto;">-->
    <!--      <div class="modal-content">-->
    <!--        <div class="modal-header">-->
    <!--          <h5 class="modal-title" id="exampleModalLongTitle">Pilih Mitra</h5>-->
    <!--          <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--            <span aria-hidden="true">&times;</span>-->
    <!--          </button>-->
    <!--        </div>-->
    <!--        <div class="modal-body">-->
    <!--          <?php echo form_open('tawaran/pengajuan'); ?>-->
    <!--              <div class="row-12" id="tampilT">-->
    <!--              </div>-->
    <!--          </form>-->
    <!--        </div>-->
    <!--        <div class="modal-footer">-->
    <!--          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--</div>-->

    <div class="modal fade" id="daftartawaran" tabindex="-1" role="dialog" aria-labelledby="penawaranModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Daftar Mitra</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open('tawaran/pengajuan'); ?>
                  <div class="row-12" id="tampiltawaran">
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    
    <!--Modal Delete-->
    <div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="judulKonfirmasi"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--<div class="modal-body">-->
          <!--  ...-->
          <!--</div>-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <a href="#" class="btn btn-danger" id="btnhapus">Ya</a>
          </div>
        </div>
      </div>
    </div>

<script>
// 	function pilihmitra(id){
// 	    var datat = $('#'+id).data('listtawaran');
// 	    var html = '';
// 	    if(datat.length==0){
// 	        html = '<label class="mx-auto">Belum ada Tawaran</label>';    
// 	    } else {
//     	   	for(var i = 0; i < datat.length; i++){
//     	html += '<div class="card card-body" style="margin-bottom: 10px;">'+
//     	            '<div class="row">'+
//     	                '<div class="col-md-4 pad1 pl-2">'+
//                         // '<img style="height : 60px; width : 60px;" src="<?=base_url()?>assets/images/'+datat[i].foto+'" alt="">'+
//                             '<img style="height : 60px; width : 60px;" src="<?=base_url()?>assets/images/register.png" alt="">'+
//                         '</div>'+
//                         '<div class="col-md-8 pad1">'+
//                             '<div><a href="#" class="linkdetail"> '+datat[i].nama+'</a><br /></div>'+
//                             '<div>Rp '+parseInt(datat[i].hps).toLocaleString()+'</div>'+
//                         '</div><br/>'+
//                         '<div class="col-md-12">'+
//                             '<a href="<?=base_url('lelang/pilih/')?>'+datat[i].lid+'/'+datat[i].uid+'" class="col-md-8 pull-right btn btn-success mt-2">Pilih</a>'+
//                         '</div>'+
//                     '</div>'+
//                 '</div>';
//     	    }
// 	    }
// 	    $('#tampilT').html(html);
// 	    $("#pilihM").modal("show");
// 	}    
	
	$('#prov').change(function show_kota(){
	    var id = $('#prov').val();
        $.ajax({
            url : window.base_url+"indonesia/getKota",
            method : "POST",
            data : {provinsi_id: id},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].id+'">'+data[i].nama+'</option>';
                }
                $('#kota').html(html);
            },
            error: function (response) {
              console.log(response);
            }
        });
    });
    
    function pilihmitra(id){
	    var datat = $('#'+id).data('listtawaran');
	    var datap = $('#'+id).data('listp');
	    var jmltaw = $('#'+id).data('jmltaw');
	    var html = '';
	    var skip = 0;
	    console.log(datat);
	    console.log(datap);
	   // var flag = 0;
	    if(datat.length===0){
	        html = '<label class="mx-auto">Belum ada Tawaran</label>';    
	    } else {
    for(var i = 0; i < parseInt(jmltaw); i++){
	    html += '<div class="card card-body bg-light" style="margin-bottom: 10px;"><div class="row"><div class="col-xs-4 pad1 pl-2">'+
                    '<img style="height : 60px; width : 60px;" src="'+window.base_url+'assets/images/foto/'+datat[skip].foto+'" alt="">'+
                    // '<img style="height : 60px; width : 60px;" src="'+window.base_url+'assets/images/register.png" alt="">'+
                '</div>'+
                '<div class="col-md-6 pad1 pl-3">'+
                    '<div><a href="#" class="linkdetail"> '+datat[skip].unama+'</a><br /></div>'+
                    '<div class="">Total: <b>Rp '+formatNumber(datat[skip].total)+'</b></div>'+
                '</div>'+
                '<div class="col-md-4">'+
                    '<a href="<?=base_url('lelang/pilih/')?>'+datat[skip].lid+'/'+datat[skip].uid+'" class="col-md-8 pull-right btn btn-success mt-2">Pilih</a>'+
                '</div>'+
                '<div class="col-md-12 pad1">'+
                '<table class="table mt-2">'+
                '<thead>'+
                    '<tr>'+
                        '<th scope="col">#</th>'+
                        '<th scope="col">Nama</th>'+
                        '<th scope="col">Qty</th>'+
                        '<th scope="col">Tawaran Satuan</th>'+
                        '<th scope="col">Sub Total</th>'+
                    '</tr>'+
                '</thead>'+
                    '<tbody>';
                        var flag = 0;
                        for(var k=0; k < datap.length * parseInt(jmltaw); k++){
                            if(datap.length>k){
                                html += '<tr>';
                                html += '<th>'+(k+1)+'</th>';
                                html += '<th>'+datap[flag].nama+'</th>';
                                html += '<th>'+formatNumber(datap[flag].jumlah)+'</th>';
                                html += '<th>Rp. '+formatNumber(datat[skip].hargap / datap[flag].jumlah)+'</th>';
                                html += '<th>Rp. '+formatNumber(datat[skip].hargap)+'</th>';
                                html += '</tr>';
                                skip++;
                            }
                            flag++;
                        }
                html += '</tbody>'+
                '</table>'+
                '</div>'+
                '</div></div>';
    	    }
	    }
	    $('#tampiltawaran').html(html);
	    $("#daftartawaran").modal("show");
	}   
	
	 function konfirmasi(url, pesan){
	    url = "<?=base_url()?>"+url;
	    console.log(url);
	    $('#judulKonfirmasi').html(pesan);
        $('#btnhapus').attr('href', url);
        $('#modalhapus').modal();
     }
     
    //  function selesaiConfirm(url, pesan){
	   //  url = "<?=base_url()?>lelang/selesai/"+url;
	   //  console.log(url);
    //   $('#btnhapus').attr('href', url);
    //   $('#modalhapus').modal();
    //  }
</script>