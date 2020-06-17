<div class="panel panel-primary form-search">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-a-tab" data-toggle="tab" href="#nav-a" role="tab" aria-controls="nav-a" aria-selected="true">Pemilihan Mitra</a>
        <a class="nav-item nav-link" id="nav-b-tab" data-toggle="tab" href="#nav-b" role="tab" aria-controls="nav-b" aria-selected="false">Pengerjaan</a>
        <a class="nav-item nav-link" id="nav-c-tab" data-toggle="tab" href="#nav-c" role="tab" aria-controls="nav-c" aria-selected="false">Selesai</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
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
                    <hr/>
                    <i class="fas fa-flag"></i>&nbsp; Pemilik Garapan : <br/><a href="#"><?php $u = $controller->getUserDetail($l->lelang_userid); echo $u['user_nama'];?>&nbsp;<b>(<?=$u['user_telpon']?></b>)</a></span><br/>
                    <div class="row mx-auto mt-3">
                        <a onclick="clickDetail(this.id)" class="linkdetail" id="detaildesk<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php $p = $controller->cekTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION['data_user']['user_id'])); ?>
                  </div>
                </div>          
                <?php $i++;} ?>
            <div class="col-md-12 mx-auto mb-4">
                <?php //echo $links; ?>
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
                        <a onclick="tampilproduk(this.id)" id="ppengerjaan<?=$i?>" href="#daftarP" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-danger" id="lihatProduk"><?php echo $controller->getJumlahProduk($l->lelang_id); ?></span> Lihat Produk 
                        </a>
                    <span><br/>
                    <span>
                        <?php $jmltaw = $controller->getJumlahTawaran($l->lelang_id); ?>
                        <a onclick="tampiltawaran(this.id)" id="clicktawaran<?=$i?>" href="#daftartawaran" class="text-primary" data-jmltaw="<?=$jmltaw?>" data-listtawaran='<?php echo json_encode($controller->getDaftarTawaran(array('lelang_id'=>$l->lelang_id, 'tawaran_status'=>3)));?>' data-listp='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
                            <span class="badge badge-info" id="jumtaw"><?php echo $jmltaw; ?> </span> Lihat Tawaran 
                        </a>
                    </span>
                    <p class="card-text">Deadline : <b><?php echo date_format(new DateTime($l->lelang_tglselesai), 'd M Y'); ?></b></p>
                    <hr/>
                    <i class="fas fa-flag"></i>&nbsp; Pemilik Garapan : <br/><a href="#"><?php $u = $controller->getUserDetail($l->lelang_userid); echo $u['user_nama'];?>&nbsp;<b>(<?=$u['user_telpon']?></b>)</a></span><br/>
                    <div class="row mx-auto mt-3">
                        <a onclick="clickDetail(this.id)" class="linkdetail" id="dpengerjaan<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php $p = $controller->cekTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION['data_user']['user_id'])); ?>
                    <!--<button type="button" id="pengajuanlid<?=$i?>" class="btn btn-success bg bg-success mt-3 pull-right">-->
                    <!--  Tentukan Pemenang-->
                    <!--</button>-->
                  </div>
                </div>          
                <?php $i++;} ?>
            <div class="col-md-12 mx-auto mb-4">
                <?php //echo $links; ?>
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
                        <a onclick="tampilproduk(this.id)" id="ppenyerahan<?=$i?>" href="#daftarP" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($l->lelang_id)); ?>'>
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
                    <hr/>
                    <i class="fas fa-flag"></i>&nbsp; Pemilik Garapan : <br/><a href="#"><?php $u = $controller->getUserDetail($l->lelang_userid); echo $u['user_nama'];?>&nbsp;<b>(<?=$u['user_telpon']?></b>)</a></span><br/>
                    <div class="row mx-auto">
                        <a onclick="clickDetail(this.id)" class="linkdetail" id="dpenyerahan<?=$i?>" data-desk="<?=$l->lelang_deskripsi?>"><i class="far fa-list-alt"></i> Lihat Deskripsi</a><br/>&ensp;&ensp;
                        <?php $file = ($l->lelang_fileurl)?base_url("assets/lelangfile/$l->lelang_fileurl"):"#"; ?>
                        <a target="_blank" href="<?=$file?>" class="linkdetail"><i class="far fa-file-alt"></i> Lihat File</a><br />
                    </div>
                    <?php $p = $controller->cekTawaran(array('lelang_id'=>$l->lelang_id, 'user_id'=>$_SESSION['data_user']['user_id'])); ?>
                    <!--<button type="button" id="pengajuanlid<?=$i?>" class="btn btn-success bg bg-success mt-3 pull-right">-->
                    <!--  Tentukan Pemenang-->
                    <!--</button>-->
                  </div>
                </div>          
                <?php $i++;} ?>
            <div class="col-md-12 mx-auto mb-4">
                <?php //echo $links; ?>
            </div>
      </div>
    </div>
</div>

            <!--<div class="modal fade" id="tambahProduk" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">-->
            <!--  <div class="modal-dialog modal-dialog-centered" role="document">-->
            <!--    <div class="modal-content">-->
            <!--      <div class="modal-header">-->
            <!--        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Produk</h5>-->
            <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
            <!--          <span aria-hidden="true">&times;</span>-->
            <!--        </button>-->
            <!--      </div>-->
            <!--      <div class="modal-body">-->
            <!--        <?php echo form_open('lelang/tambah'); ?>-->
            <!--        <div class="row">-->
            <!--           <div class="form-group col-md-12">-->
            <!--             <label for="produk">Produk :</label>-->
            <!--             <select name="produk" id="produk" class="form-control" required>-->
            <!--             </select>-->
            <!--           </div>-->
            <!--           <div class="form-group col-md-12">-->
            <!--             <label for="text">Ukuran :</label>-->
            <!--                <div class="input-group" id="gantiUkuran">-->
                                <!--<input type="number" id="ukuran" min="0" name="ukuran[0]" placeholder="100" class="form-control" required>-->
                                <!--<input type="text" value="x" class="form-control text-center col-md-1" disabled>-->
                                <!--<input type="number" id="ukuran" min="0" name="ukuran[1]" placeholder="100" class="form-control" required>-->
                                <!--<div class="input-group-append">-->
            <!--                <input list="ukuran" id="satuan" name="satuan" class="form-control"/>-->
            <!--                <datalist id="ukuran" class="">-->
            <!--                </datalist>-->
                                <!--</div>-->
            <!--                </div>-->
            <!--           </div>-->
            <!--           <div class="form-group col-md-12">-->
            <!--             <label for="text">Bahan :</label>-->
            <!--             <div class="input-group" id="gantiBahan">-->
            <!--                <input list="listB" id="bahan" name="bahan" class="form-control"/>-->
            <!--                <datalist id="listB" class="">-->
            <!--                </datalist>-->
            <!--             </div>-->
            <!--           </div>-->
            <!--           <div class="form-group col-md-12">-->
            <!--            <label for="text">Jumlah :</label>-->
            <!--                <div class="input-group">-->
            <!--                    <div class="input-group-prepend">-->
            <!--                        <div class="value-button form-control btn-danger" id="decrease" onclick="decreaseValue()" value="Decrease Value">&nbsp;-&nbsp;</div>-->
            <!--                    </div>-->
            <!--                    <input type="number" id="number" name="jumlah" value="1" min="1" class="form-control col-md-4 text-center" required>-->
            <!--                    <div class="input-group-append">-->
            <!--                        <div class="value-button form-control btn-success" id="increase" onclick="increaseValue()" value="Increase Value">+</div>-->
            <!--                    </div-->
            <!--                </div>-->
            <!--             </div>-->
            <!--           </div>-->
            <!--           <div class="form-group col-md-12">-->
            <!--             <label for="text">Perkiraan Harga :</label>-->
            <!--             <div class="input-group">-->
            <!--                 <div class="input-group-prepend">-->
            <!--                     <div class="input-group-append">-->
            <!--                         <span class="input-group-text" id="basic-addon1">Rp. </span>-->
            <!--                     </div>-->
            <!--                 </div>-->
            <!--                <input name="harga" placeholder="1,000,000" type="text" id="currency" oninput="setFormat('currency')"  class="form-control harga" required/>-->
            <!--             </div>-->
            <!--           </div>-->
            <!--           <div class="form-group col-md-12">-->
            <!--             <label for="text">Catatan :</label>-->
            <!--             <textarea name="catatan" placeholder="Isi Catatan . . ." id="catatan" style="width:100%; height:100px;" class="form-control catatan"></textarea>-->
            <!--           </div>-->
            <!--        </div>-->
            <!--        </form>-->
            <!--      </div>-->
            <!--      <div class="modal-footer">-->
            <!--        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>-->
            <!--        <button id="simpanProduk" type="button" class="btn btn-success">Tambah</button>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
<script>
</script>