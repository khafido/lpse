<!-- Modal Pengajuan Penawaran -->
    <div class="modal fade" id="penawaran" role="dialog" tabindex="-1" aria-labelledby="penawaranModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajukan Penawaranmu!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <?php echo form_open('tawaran/pengajuan'); ?>
          <div class="modal-body">
            <div class="col-md-12 table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Produk</th>
                      <th scope="col" class="text-right">Qty</th>
                      <th scope="col" class="text-right">Harga Satuan</th>
                      <th scope="col" class="text-right">Harga Tawaran Satuan</th>
                    </tr>
                  </thead>
                  <tbody id="ltawaran">
                  </tbody>
                </table>
            </div>
            <input type="hidden" name="lid">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
    <!-- Modal Daftar Produk -->
    <div class="modal fade" id="daftarP" tabindex="-1" role="dialog" aria-labelledby="produkModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Daftar Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-12 card card-body bg-light table-responsive">
                <table class="table table-responsive">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Jml</th>
                      <th scope="col" class="text-right">Biaya</th>
                      <th scope="col">Ukuran</th>
                      <th scope="col">Bahan</th>
                      <th scope="col">Sisi</th>
                      <th scope="col">Laminasi</th>
                      <th scope="col">Catatan</th>
                    </tr>
                  </thead>
                  <tbody id="lproduk">
                      <tr>
                      </tr>
                  </tbody>
                </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Daftar Tawaran -->
    <div class="modal fade" id="daftartawaran" tabindex="-1" role="dialog" aria-labelledby="penawaranModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Daftar Tawaran</h5>
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
  
    <!--Modal Tambah Produk-->
    <div class="modal fade" id="tambahProduk" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="formTambahProduk">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
               <div class="form-group col-md-12">
                 <label for="produk">Produk :</label>
                 <select name="produk" id="produk" class="form-control" required>
                 </select>
               </div>
               <div class="form-group col-md-12" id="showukuran">
                    <label for="text">Ukuran :</label>
                    <div class="" id="isiukuran">
                        <select name="ukuran" id="ukuran">
                        </select>
                    </div>
                    <label id="labelu" style="display:inline;"><input class="mt-2" type="checkbox" name="checku" id="checku" /> Custom Ukuran</label>
               </div>
               <div class="form-group col-md-12" id="showbahan">
                 <label for="text">Bahan :</label>
                    <div class="" id="isibahan">
                        <select name="bahan" id="bahan">
                        </select>
                    </div>
                    <label id="labelb" style="display:inline;"><input class="mt-2" type="checkbox" name="checkb" id="checkb" /> Custom Bahan</label>
               </div>
               <div class="form-group col-md-3" id="isiSisi">
                    <label for="sisi">Sisi :</label><br/>
                    <select class="form-control text-center" name="sisi" id="sisi" required>
                        <option value="N/A">Kosong</option>
                    </select>
                    <!--<label class="radio-inline"><input class="ml-3" type="radio" name="sisi" value="1" checked>&ensp;1 Sisi</label>-->
                    <!--<label class="radio-inline"><input class="ml-3"type="radio" value="2" name="sisi">&ensp;2 Sisi</label>-->
               </div>
               <div class="form-group col-md-5" id="isiLaminasi">
                   <label for="laminasi">Laminasi :</label>
                    <select class="form-control" name="laminasi" id="laminasi" required>
                        <option value="N/A">Kosong</option>
                    </select>
               </div>
               <div class="form-group col-md-4">
                <label for="text">Qty :</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="value-button form-control btn-danger" id="decrease" onclick="decreaseValue()" value="Decrease Value">&nbsp;-&nbsp;</div>
                        </div>
                        <input type="text" id="number" name="jumlah" value="1" onclick="select()" oninput="hitungHPS(this.id)" class="form-control text-center" required/>
                        <div class="input-group-append">
                            <div class="value-button form-control btn-success" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                        </div
                    </div>
                 </div>
               </div>
               <div class="form-group col-md-7">
                 <label for="text">Estimasi Harga Satuan : <b id="satuanb"></b></label>
                 <!--<div class="input-group">-->
                 <!--    <div class="input-group-prepend">-->
                 <!--        <div class="input-group-append">-->
                 <!--           <span class="input-group-text" id="basic-addon1">Rp. </span>-->
                 <!--        </div>-->
                 <!--    </div>-->
                    <input name="hargas" placeholder="0" type="text" id="hargas" onclick="select()" oninput="hitungHPS(this.id)"  class="form-control currency" required disabled/>
                 <!--</div>-->
               </div>
               <div class="form-group col-md-5">
                    <label for="text">Total :</label>
                    <input name="harga" placeholder="0" type="text" id="currency" oninput="setFormat(this.id)"  class="form-control currency" required disabled/>
               </div>
               <div class="form-group col-md-12">
                 <label for="text">Catatan Tambahan :</label>
                 <textarea name="catatan" placeholder="Isi Catatan . . ." id="catatan" style="width:100%; height:100px;" class="form-control catatan"></textarea>
               </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button id="simpanProduk" type="button" class="btn btn-success">Simpan</button>
            <!--<input id="simpanProduk" type="submit" class="btn btn-success" value="Tambah"/>-->
          </div>
        </div>
        </form>
      </div>
    </div>
    
    <!-- Modal Detail Deskripsi -->
    <div class="modal fade" id="modaldesk" role="dialog" tabindex="-1" aria-labelledby="modaldeskModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Deskripsi Lelang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="isidesk"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>    
<!--</section>-->
<!-- ================ start footer Area ================= -->
<footer class="footer-area section-gap" style="margin-top:50px;">
    
<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/fontawesome/css/all.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/themify-icons/themify-icons.css">
<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/linericon/style.css">
<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/magnefic-popup/magnific-popup.css">
<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/owl-carousel/owl.theme.default.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/owl-carousel/owl.carousel.min.css">
<!--<link rel="stylesheet" href="<?=base_url()?>assets/web/vendors/nice-select/nice-select.css">-->

<link rel="stylesheet" href="<?=base_url()?>assets/web/css/style.css">
  <div class="container">
    <div class="row">
      <div class="col-xl-4 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
        <h4>Informasi</h4>
        <ul>
          <li><a href="#">Tentang Ayo lelang</a></li>
          <li><a href="#">Syarat dan Ketentuan</a></li>
          <li><a href="#">kebijakan Privasi</a></li>
        </ul>
      </div>
      <div class="col-xl-4 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
        <h4>Hubungi Kami</h4>
        <ul>
          <!--<li><i class="fas fa-map-marker-alt"> </i><a style="margin-left:10px;" href="#">Komplek Ketapang Indah <br> Blok B3 No. 8-9. Jl. KH.Zainul Arifin <br>Krukut Tamansari, Jakarta </a></li>-->
          <li><i class="fas fa-mobile-alt"> </i><a style="margin-left:10px;" href="#">0856 4517 1115</a></li>
          <li><i class="far fa-envelope"> </i><a style="margin-left:10px;" href="#">ayolelang@email.com</a></li>
        </ul>
      </div>
      <div class="col-xl-4 col-md-8 mb-4 mb-xl-0 single-footer-widget">
        <h4>Newsletter</h4>
        <p>Anda bisa mempercayai kami. kami akan mengirim penawaran promo ke email anda</p>
        <div class="form-wrap" id="mc_embed_signup">
          <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
            <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" required="" type="email">
            <button class="click-btn btn btn-default text-uppercase">subscribe</button>
            <div style="position: absolute; left: -5000px;">
              <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
            </div>

            <div class="info"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="footer-bottom row align-items-center text-center text-lg-left">
      <p class="footer-text m-0 col-lg-8 col-md-12" style="display:none;">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
      <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-dribbble"></i></a>
        <a href="#"><i class="fab fa-behance"></i></a>
      </div>
    </div>
  </div>
<!-- ================ End footer Area ================= -->


<!--<script src="<?=base_url()?>assets/web/vendors/bootstrap/bootstrap.bundle.min.js"></script>-->
<script src="<?=base_url()?>assets/web/vendors/magnefic-popup/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url()?>assets/web/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?=base_url()?>assets/web/vendors/easing.min.js"></script>
<script src="<?=base_url()?>assets/web/vendors/superfish.min.js"></script>
<!--<script src="<?=base_url()?>assets/web/vendors/nice-select/jquery.nice-select.min.js"></script>-->
<script src="<?=base_url()?>assets/web/vendors/jquery.ajaxchimp.min.js"></script>
<script src="<?=base_url()?>assets/web/vendors/mail-script.js"></script>
<script src="<?=base_url()?>assets/web/js/main.js"></script>
<script>
    window.base_url = "<?php echo base_url(); ?>";
    // $("#tglselesai").datetimepicker({datepicker("setDate", new Date()});
    
    
    $("#tglselesai").datepicker({
        uiLibrary: 'bootstrap4',
        minDate: 0,
        // startDate: new Date(),
        // new Date(2019, 10 - 1, 25)
        autoclose: true
    });
    
    $("#jamselesai").timepicker({
        uiLibrary: 'bootstrap4',
        orientation: 'bottom',
        autoclose: true
    });
    
    // $('#jamselesai').click(function(){
    // var popup =$(this).offset();
    // var popupTop = popup.top - 40;
    // $('.jamselesai').css({
    // //   'top' : popupTop
    // marginbottom: 300
    //  });
// });
</script>
<script src="<?=base_url()?>assets/web/js/myjs.js"></script>
</footer>
</body>